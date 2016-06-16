# active-directory-b2c-php-webapp-openidconnect
This repo contains code for a PHP blogging application that demonstrates the use of several B2C policies: general sign-in/sign-up without multifactor authetication, sign-in/sign-up with multifactor authentication, and profile editing. Users designated as administrators must login with the administrator policy requiring multifactor authentication. Administrators have the ability to create new blog posts. The application also illustrates how to receive and verify id-tokens from the B2C endpoint following the OpenID Connect standard. 

A live version of this application is available here: https://olenablog.azurewebsites.net/ 

The instructions below show you how to run/deploy your own blogging application using PHP (with the framework Laravel) and IIS on Windows.

## Pre-requisites
1. Install PHP for Windows: http://www.iis.net/learn/application-frameworks/install-and-configure-php-on-iis/install-and-configure-php
2. Install CURL: https://curl.haxx.se/download.html
3. Install mySQL: https://dev.mysql.com/downloads/installer/
4. In your PHP.ini file, make sure to enable these extensions: openssl, curl, mysql
5. Install Laravel. See the section entitled "Create a PHP (Laravel) app on your dev machine" on this page: https://azure.microsoft.com/en-gb/documentation/articles/app-service-web-php-get-started/

## Use the Azure Portal
1. Create a database in the Azure Portal. See the section "Create a MySQL database in Azure portal" on this page:  https://azure.microsoft.com/en-gb/documentation/articles/store-php-create-mysql-database/
2. Create B2C policies in the Azure. See this page https://azure.microsoft.com/en-us/documentation/articles/active-directory-b2c-reference-policies/

## Running this sample locally
1. Clone the code from github and put it into the working directory where you created your Laravel app
2. Download the latest version of the php security library from http://phpseclib.sourceforge.net/index.html and place the download in your repo in the folder "app/Http/Controllers/phpseclib"
3. In your app folder, open up "app/Http/Controllers/settings.php" and follow the instructions in the comments to configure the settings for your app
4. In the terminal, type the command "php artisan serve" and navigate to http://localhost:8000/ to see your website in action

## Deploy this sample to Azure
1. Use these instructions: https://azure.microsoft.com/en-gb/documentation/articles/app-service-web-php-get-started/

## About the code
The main logic is in "app/Http/routes.php." Helper functions and classes are located in "app/Http/Controllers". In particular, if you are interested in the token verification logic, see "app/Http/Controllers/TokenChecker.php".  The rest of the code is mainly associated with the Laravel framework. 

## More information
A PHP web application that authenticates users with Azure AD B2C using OpenID Connect. B2C is an identity management service for both web applications and mobile applications. Developers can rely on B2C for consumer sign up and sign in, instead of relying on their own code. Consumers can sign in using brand new credentials or existing accounts on various social platforms (Facebook, for example). 

Learn more about B2C here: https://azure.microsoft.com/en-us/services/active-directory-b2c/
