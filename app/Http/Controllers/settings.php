<?php 

	// Settings for customer to configure
	$tenant = "olenaolena";
	$clientID = "efb2ce32-272a-4705-97f4-d67988ad4354";
	$client_secret = "2FY71Wq5pD&D[79]";
	$redirect_uri = urlencode("//olenablog.azurewebsites.net/"); 
	$response_type = "id_token"; // either id_token or code, depending on whether your application has enabled/disabled implicit flow
	$response_mode = "form_post"; // can also be query_string or fragment, but this code works with form_post
	$scope = "openid"; // currently, just openid supported
	
	// Policies
	$generic_policy = "b2c_1_sign_in_or_sign_up";
	$admin_policy = "b2c_1_admin_sign_in_or_sign_up";
	$edit_profile_policy = "b2c_1_edit_profile";
	
	// List of admins' email addresses
	$admins = array("olenah@umich.edu");
	
	// Database
	$servername = "localhost";
	$username = "olena";
	$password = "Personas12";
	$dbname = "myDB";
	
	//////////////////////////////////////////////////////
	$metadata_endpoint_begin = 'https://login.microsoftonline.com/'.
						 $tenant.
						 '.onmicrosoft.com/v2.0/.well-known/openid-configuration?p=';
						 

?>