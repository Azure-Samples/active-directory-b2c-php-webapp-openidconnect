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

// Returns true if the user is logged in
function checkUserLoggedIn() {
	return isset($_COOKIE['user']);
}

// Returns true if the user is an admin
function checkUserIsAdmin() {
	
	require app_path()."/Http/Controllers/settings.php";
	
	if (!isset($_COOKIE['email'])) return false;
	if (!in_array($_COOKIE['email'], $admins)) return false;
	return true;
}

// Returns the given name of the current user
// Returns an empty string if the user is not authenticated
function getGivenName() {
	if (!checkUserLoggedIn()) return "";
	return $_COOKIE['user'];
}

// Register for the general homepage
Route::get('/', function() {
	
	require_once app_path()."/Http/Controllers/settings.php";

	return view('blog_layout', ['user_logged_in'=>checkUserLoggedIn(),
						'user_is_admin'=>checkUserIsAdmin(),
						'given_name'=>getGivenName()]);
});

// Register the homepage when an ID Token or Code is posted to the page from B2C
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
	$email = $email[0];
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
			
	// Render homepage view	
	return view('blog_layout', ['user_logged_in'=>true,
						'user_is_admin'=>in_array($email, $admins),
						'given_name'=>$given_name]);
		
});

// Register the login route
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

// Register the logout route
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

// Register the edit profile route
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


