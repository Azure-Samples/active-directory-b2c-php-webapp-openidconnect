# active-directory-b2c-php-webapp-openidconnect
A PHP web application that authenticates users with Azure AD B2C using OpenID Connect. B2C is an identity management service for both web applications and mobile applications. Developers can rely on B2C for consumer sign up and sign in, instead of relying on their own code. Consumers can sign in using brand new credentials or existing accounts on various social platforms (Facebook, for example). Learn more about B2C here: https://azure.microsoft.com/en-us/services/active-directory-b2c/

A live version of this application is available here: https://olenablog.azurewebsites.net/ 

The instructions below show you how to run/deploy your own blogging application using PHP (with the framework Laravel) and IIS on Windows.

## Pre-requisites
1. Install PHP for Windows: http://www.iis.net/learn/application-frameworks/install-and-configure-php-on-iis/install-and-configure-php
2. Install CURL: https://curl.haxx.se/download.html
3. Install mySQL: https://dev.mysql.com/downloads/installer/
4. In your PHP.ini file, make sure to enable these extensions: openssl, curl, mysql

## Use the Azure Portal
1. Create a database in the Azure Portal
2. Create B2C policies in the Azure 

## Running this sample locally
1. Clone the code from github and put it into your "wwwroot" folder
2. Download the latest version of the php security library from http://phpseclib.sourceforge.net/index.html and place the download in your repo in the folder "app/Http/Controllers/phpseclib"
3. In your app folder, open up "app/Http/Controllers/settings.php" and follow the instructions in the comments to configure the settings for your app
4. In the terminal, type the command "php artisan serve" and navigate to http://localhost:8000/ to see your website in action

## Deploy this sample to Azure
Coming soon...
## About the code
Coming soon...
## More information
Coming soon...
