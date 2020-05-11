<?php 

	////////////////////////////////////////////////////////////////////////////////
	// TODO: Please follow the instructions to configure the settings for your use case
	
	// Create an Azure AD B2C application in the Azure Portal, then configure the following settings
	$tenant = "name of your Active Directory tenant";
	$clientID = "client ID of your B2C application in the portal";
	$client_secret = ""; // the client secret for B2C application that you created, only fill this in if you want to use confidential client flow
	$redirect_uri = urlencode("http://localhost:8000"); 
	
	// Decide which authentication flow you would like to follow
	// To use Implicit Flow (recommended), set response_type to "id_token"
	// To use Confidential Client Flow (supported for future flexibility), set response_type "to code"
	$response_type = "id_token"; 
	$response_mode = "form_post"; 
	$scope = "openid"; 
	
	// Create one or more B2C policies in the Azure Portal. 
	// This example code uses 3 policies - 
	// 1. a generic sign in or sign up policy (no MFA)
	// 2. an optional administrator sign in or sign up policy (with MFA)
	// 3. a profile editing policy
	$generic_policy = "b2c_1_sign_in_or_sign_up";
	$admin_policy = "b2c_1_admin_sign_in_or_sign_up";
	$edit_profile_policy = "b2c_1_edit_profile";
	
	// List of admins' email addresses. You can also leave this empty.
	$admins = array("");

	// END OF CONFIGURABLE SETTINGS /////////////////////////////////////////////////////////////////////////////
	$metadata_endpoint_begin = 'https://'.
						$tenant.
						'.b2clogin.com/'.
						 $tenant.
						 '.onmicrosoft.com/v2.0/.well-known/openid-configuration?p=';
						 

?>