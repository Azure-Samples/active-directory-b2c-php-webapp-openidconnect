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

Route::match(['get', 'post'], '/', 'HomeController@index');

Route::get('/', 'HomeController@index');

Route::post('/', 'HomeController@index');

/* {
	
	require app_path()."/Http/Controllers/settings.php";
	require app_path()."/Http/Controllers/EndpointHandler.php";
	require app_path()."/Http/Controllers/TokenChecker.php";
	
	// User not authenticated
	if (!isset($_POST['id_token']) && !isset($_POST['code']) && !isset($_COOKIE['user'])) {
		return view('intro');
	}
	// User just signed in, must verify token/authorization code
	else if (isset($_POST['id_token']) || isset($_POST['code'])) {
		
		
		// Get state and verify it's the same as the state set in the cookie
		$state = explode(" ", $_POST['state']);
		$action = $state[0];
		$state_cookie = $state[1];
			
		if ($state_cookie != $_COOKIE['state']) {
			$error_msg = "Returned state does not match cookie state";
			require_once('views/pages/error.php');
			return;
		}
		
		// Check which authorization policy was used
		if ($action == "generic") $policy = $generic_policy;
		if ($action == "admin") $policy = $admin_policy;
		if ($action == "edit_profile") $policy = $edit_profile_policy;
			
		if (isset($_POST['code'])) {
			$resp = $_POST['code'];
			$resp_type = "code";
		}
		else if (isset($_POST['id_token'])) {
			$resp = $_POST['id_token'];
			$resp_type = "id_token";
		}
		else {
			$error_msg = "response from B2C was not code or id_token";
			require_once('views/pages/error.php');
		}
				
		$tokenChecker = new TokenChecker($resp, $resp_type, $clientID, $client_secret, $policy);
		$verified = $tokenChecker->authenticate();
		if ($verified == false) {
			$error_msg = "Invalid token";
			require_once 'views/pages/error.php';
			return;
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
						
				// Redirect to sign up/sign in page
				header('Location: '.$authorization_endpoint);
			}
			
		}
		
		// Set cookies
		setcookie("email", $email);
		$given_name = $tokenChecker->getClaim("given_name");
		setcookie("user", $given_name);
			
		$signout_uri = $tokenChecker->getEndSessionEndpoint();
		$edit_profile_endpoint_handler = new EndpointHandler($edit_profile_policy);
		$edit_profile_uri = $edit_profile_endpoint_handler->getAuthorizationEndpoint()."&state=edit_profile";
			
		//$database = new Database();
		//$blog_posts = $database->fetchBlogPosts();
		$blog_posts = array();
			
		return view('home', ['blog_posts'=>$blog_posts]);
		
	}
	// Existing session
	else if (isset($_COOKIE['user'])) {
		
		$given_name = $_COOKIE['user'];
		
		$signout_endpoint_handler = new EndpointHandler($generic_policy);
		$signout_uri = $signout_endpoint_handler->getEndSessionEndpoint();
		
		$edit_profile_endpoint_handler = new EndpointHandler($edit_profile_policy);
		$edit_profile_uri = $edit_profile_endpoint_handler->getAuthorizationEndpoint()."&state=edit_profile";
		
		//$database = new Database();
		//$blog_posts = $database->fetchBlogPosts();
		$blog_posts = array();
		
		return view('home', ['blog_posts'=>$blog_posts]);
	}
	
    
});
*/
Route::match(['get', 'post'], '/login', function () {
    require app_path()."/Http/Controllers/settings.php";
	require app_path()."/Http/Controllers/EndpointHandler.php";
		
	$endpoint_handler = new EndpointHandler($generic_policy);
	$authorization_endpoint = $endpoint_handler->getAuthorizationEndpoint()."&state=generic";
		
	// Set cookie for state
	$state = rand();
	setcookie("state", $state);
	$authorization_endpoint = $authorization_endpoint . "+" . $state;
			
	// Redirect to sign up/sign in page
	return redirect($authorization_endpoint);
});

Route::get('/logout', function () {
// User not authenticated
	if (!isset($_POST['id_token']) && !isset($_POST['code']) && !isset($_COOKIE['user'])) {
		
		//require_once 'pages/views/error.php';
	}
	else {
		require app_path()."/Http/Controllers/settings.php";
		require app_path()."/Http/Controllers/EndpointHandler.php";
		
		// Delete cookies
		setcookie("user", "", time() - 3600);
		
		// Redirect to logout page
		$signout_endpoint_handler = new EndpointHandler($generic_policy);
		$signout_uri = $signout_endpoint_handler->getEndSessionEndpoint();
		return redirect($signout_uri);
	} 
});

Route::match(['get', 'post'], '/edit_profile', function () {
    require app_path()."/Http/Controllers/settings.php";
	require app_path()."/Http/Controllers/EndpointHandler.php";
		
	$endpoint_handler = new EndpointHandler($edit_profile_policy);
	$authorization_endpoint = $endpoint_handler->getAuthorizationEndpoint()."&state=edit_profile";
			
	// Set cookie for state
	$state = rand();
	setcookie("state", $state);
	$authorization_endpoint = $authorization_endpoint . "+" . $state;
				
	// Redirect to sign up/sign in page
	return redirect($authorization_endpoint);
});








//Route::auth();

//Route::get('/home', 'HomeController@index');
