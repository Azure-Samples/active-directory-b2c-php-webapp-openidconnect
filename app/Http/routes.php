<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

function checkUserIsAdmin() {
	
	require app_path()."/Http/Controllers/settings.php";
	
	if (!isset($_COOKIE['email'])) {
		return 'You are not logged in and do not have permission';
	}
	
	if (!in_array($_COOKIE['email'], $admins)) {
		return 'You are not an admin and do not have permission';
	}
	return true;
}

function fetchBlogPosts() {
	require_once app_path()."/Http/Controllers/Database.php";
	$database = new Database();
	$blog_posts = $database->fetchBlogPosts();
	return $blog_posts;
}

function fetchBlogPostById($id) {
	require_once app_path()."/Http/Controllers/Database.php";
	$database = new Database();
	$blog_post = $database->fetchBlogPostById($id);
	return $blog_post;
}

function createNewBlogPost() {
	require_once app_path()."/Http/Controllers/Database.php";
	
	// Check that the user just created a blog post
	if (isset($_POST['new_blog_post'])) {
		// Put into database
		$database = new Database();
		$database->newBlogPost($_POST['title'], $_POST['content']);
	}
}

function createNewComment() {
	require_once app_path()."/Http/Controllers/Database.php";
	$database = new Database();
	$database->newComment($_GET['id'], $_POST['content'], $_POST['author']);
}

function fetchComments() {
	require_once app_path()."/Http/Controllers/Database.php";
	$database = new Database();
	$comments = $database->fetchComments($_GET['id']);
	return $comments;
}

Route::get('/', function() {
	
	require app_path()."/Http/Controllers/create_database.php";
	
	// User not authenticated - show login page
	if (!isset($_COOKIE['user'])) {
		return view('please_login');
	}
	// Existing session - show homepage
	else if (isset($_COOKIE['user'])) {
		
		$given_name = $_COOKIE['user'];
		$blog_posts = fetchBlogPosts();
		return view('home', ['blog_posts'=>$blog_posts,
							'given_name'=>$given_name]);
	}
	
});

Route::post('/', function () {
	
	require app_path()."/Http/Controllers/settings.php";
	require app_path()."/Http/Controllers/TokenChecker.php";
	
	// User just signed in, must verify token/authorization code
	if (!isset($_POST['id_token']) && !isset($_POST['code'])) {
		return 'ERROR - only id_token or code supported';
	}
		
	// Get state and verify it's the same as the state set in the cookie
	$state = explode(" ", $_POST['state']);
	$action = $state[0];
	$state_cookie = $state[1];
	if ($state_cookie != $_COOKIE['state']) {
		return view('error', ['error_msg'=>"Returned state does not match cookie state"]);
	}
		
	// Check which authorization policy was used
	if ($action == "generic") $policy = $generic_policy;
	if ($action == "admin") $policy = $admin_policy;
	if ($action == "edit_profile") $policy = $edit_profile_policy;

	// Check the response type
	if (isset($_POST['code'])) {
		$resp = $_POST['code'];
		$resp_type = "code";
	}
	else if (isset($_POST['id_token'])) {
		$resp = $_POST['id_token'];
		$resp_type = "id_token";
	}
	
	// Verify token
	$tokenChecker = new TokenChecker($resp, $resp_type, $clientID, $client_secret, $policy);
	$verified = $tokenChecker->authenticate();
	if ($verified == false) {
		return view('error', ['error_msg'=>"Token validation error"]);
	}
		
	// Fetch user's email and check if admin 
	$email = $tokenChecker->getClaim("emails");
	if (in_array($email, $admins)) {
		$acr = $tokenChecker->getClaim("acr");
			
		// If user did not authenticate with admin_policy, redirect to admin policy
		if ($acr != $admin_policy) {
			$endpoint_handler = new EndpointHandler($admin_policy);
			$authorization_endpoint = $endpoint_handler->getAuthorizationEndpoint()."&state=admin";
			
			// Set cookie for state
			$state = rand();
			setcookie("state", $state);
			$authorization_endpoint = $authorization_endpoint . "+" . $state;
						
			// Redirect to sign up/sign in page for admins
			header('Location: '.$authorization_endpoint);
		}	
	}
		
	// Set cookies
	setcookie("email", $email);
	$given_name = $tokenChecker->getClaim("given_name");
	setcookie("user", $given_name);
			
	// Fetch blog posts from database	
	$blog_posts = fetchBlogPosts();
	return view('home', ['blog_posts'=>$blog_posts, 
						'given_name'=>$given_name]);
		
});

Route::get('/login', function () {
    require app_path()."/Http/Controllers/settings.php";
	require app_path()."/Http/Controllers/EndpointHandler.php";
	
	// Set cookie for state
	$state = rand();
	setcookie("state", $state);
	
	// Redirect to sign up/sign in page
	$endpoint_handler = new EndpointHandler($generic_policy);
	$authorization_endpoint = $endpoint_handler->getAuthorizationEndpoint()."&state=generic"."+". $state;
	return redirect($authorization_endpoint);
});

Route::get('/logout', function () {
	
	// User not authenticated
	if (!isset($_POST['id_token']) && !isset($_POST['code']) && !isset($_COOKIE['user'])) {
		return view('error', ['error_msg'=>'Trying to log out when not logged in']);
	}
	else {
		require app_path()."/Http/Controllers/settings.php";
		require app_path()."/Http/Controllers/EndpointHandler.php";
		
		// Delete cookies
		setcookie("user", "", time() - 3600);
		setcookie("email", "", time() - 3600);
		
		// Redirect to logout page
		$signout_endpoint_handler = new EndpointHandler($generic_policy);
		$signout_uri = $signout_endpoint_handler->getEndSessionEndpoint();
		return redirect($signout_uri);
	} 
});

Route::get('/edit_profile', function () {
    require app_path()."/Http/Controllers/settings.php";
	require app_path()."/Http/Controllers/EndpointHandler.php";
	
	// Set cookie for state
	$state = rand();
	setcookie("state", $state);
	
	// Redirect to sign up/sign in page
	$endpoint_handler = new EndpointHandler($edit_profile_policy);
	$authorization_endpoint = $endpoint_handler->getAuthorizationEndpoint()."&state=edit_profile"."+".$state;
	return redirect($authorization_endpoint);
});

// A page that allows the user to create a new blog post
Route::get('/new_post', function () {
	
	$userIsAdmin = checkUserIsAdmin();
	if (is_string($userIsAdmin)) return view('error', ['error_msg'=>$userIsAdmin]);
	return view('blog_post_create');
});

// A page that inserts a new blog post into the database, then shows the homepage
Route::post('/new_post', function() {
	
	$userIsAdmin = checkUserIsAdmin();
	if (is_string($userIsAdmin)) return view('error', ['error_msg'=>$userIsAdmin]);
	createNewBlogPost();
	$blog_posts = fetchBlogPosts();
	return view('home', ['blog_posts'=>$blog_posts, 
						'given_name'=>$_COOKIE['given_name']]);
	
});

Route::get('/blog_post', function () {
	
	$blog_id = $_GET['id'];
	$blog_posts = fetchBlogPostById($blog_id);
	$comments = fetchComments();
	return view('blog_post_view', ['blog_posts'=>$blog_posts,
									'comments'=>$comments]);
	
});

Route::post('/blog_post', function () {
	
	createNewComment();
	
	
	$blog_id = $_GET['id'];
	$blog_posts = fetchBlogPostById($blog_id);
	$comments = fetchComments();
	return view('blog_post_view', ['blog_posts'=>$blog_posts,
									'comments'=>$comments]);
	
});
