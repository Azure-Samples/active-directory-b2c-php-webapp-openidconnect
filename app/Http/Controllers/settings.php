<?php 

	////////////////////////////////////////////////////////////////////////////////
	// TODO: Please follow the instructions to configure the settings for your use case
	
	// Create an Azure AD B2C application in the Azure Portal, then configure the following settings
	$tenant = "olenaolena"; // the name of the tenant you used in the portal
	$clientID = "efb2ce32-272a-4705-97f4-d67988ad4354"; // the clientID for B2C application that you created
	$client_secret = "2FY71Wq5pD&D[79]"; // the client secret for B2C application that you created
	$redirect_uri = urlencode("https://olenablog.azurewebsites.net/"); 
	
	// Decide which authentication flow you would like to follow
	$response_type = "id_token"; // either id_token or code, depending on whether your application has enabled/disabled implicit flow
	$response_mode = "form_post"; // can also be query_string or fragment, but this code works with form_post
	$scope = "openid"; // currently, just openid supported
	
	// Create one or more B2C policies in the Azure Portal. 
	// This example code uses 3 policies - 
	// 1. a generic sign in or sign up policy (no MFA)
	// 2. an optional administrator sign in or sign up policy (with MFA)
	// 3. a profile editing policy
	$generic_policy = "b2c_1_sign_in_or_sign_up";
	$admin_policy = "b2c_1_admin_sign_in_or_sign_up";
	$edit_profile_policy = "b2c_1_edit_profile";
	
	// List of admins' email addresses. You can also leave this empty.
	$admins = array("olenah@umich.edu");
	
	// Create a database in the Azure Portal and configure the settings here
	$servername = "us-cdbr-azure-west-c.cloudapp.net";
	$username = "b8aa8e5629b408";
	$password = "5d4e9efb";
	$dbname = "olenablog";
	
	///////////////////////////////////////////////////////////////////////////////
	$metadata_endpoint_begin = 'https://login.microsoftonline.com/'.
						 $tenant.
						 '.onmicrosoft.com/v2.0/.well-known/openid-configuration?p=';
						 

?>