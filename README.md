---
services: active-directory-b2c
platforms: php
author: t-olhuan
---

# PHP Web Application with Azure AD B2C
This repo contains code for a PHP blogging application that demonstrates the use of several B2C policies: general sign-in/sign-up without multifactor authetication, sign-in/sign-up with multifactor authentication, and profile editing. Users designated as administrators must login with the administrator policy requiring multifactor authentication. Administrators have the ability to create new blog posts. The application also illustrates how to receive and verify id-tokens from the B2C endpoint following the OpenID Connect standard. 

The instructions below show you how to run/deploy your own blogging application using PHP (with the framework Laravel) and IIS on Windows.

## Pre-requisites
+ Install [PHP](http://php.net/manual/en/install.php). 
+ Install [Laravel](https://laravel.com/docs/5.2), the PHP Web framework you'll be using.

## Create B2C App and Policies
+ Navigate to your account in the Azure Portal and open up the B2C blade.
+ Create a web application. Make sure to remember the clientID and client secret.
+ Create a sign-in/sign-up policy and an edit profile policy. Create a separate policy for admins if you want admins to authenticate with a different policy. For more detailed instructions, see [here](https://azure.microsoft.com/en-us/documentation/articles/active-directory-b2c-reference-policies/).

## Configuring your PHP app settings
+ Clone the source code from github: `git clone https://github.com/Azure-Samples/active-directory-b2c-php-webapp-openidconnect.git`
+ Download the latest version of the [php security library](http://phpseclib.sourceforge.net/index.html) and place the download in your repo in the folder "app/Http/Controllers/phpseclib".
+ In your app folder, open up "app/Http/Controllers/settings.php" and follow the instructions in the comments to configure the settings for your app.
+ There will be two flow options: Implicit Flow and Confidential Client Flow. For now, Implicit Flow is the recommended and default setting. Confidential Client Flow is included for future support of access tokens. 
+ In the terminal, type "composer install" to install the necessary dependencies.

## Running and Deploying your App

### To run your app locally
In the terminal, type the command "php artisan serve" and navigate to http://localhost:8000/ to see your website in action.

### To deploy this sample to Azure
If you get stuck at any point, try taking a look at these [instructions](https://azure.microsoft.com/en-gb/documentation/articles/app-service-web-php-get-started/).

##### Create an Azure website in the Portal
+ Login to the Azure Portal.
+ Click New and select Web App from the MarketPlace.
+ Fill in the name of your app and select your Subscription, Resource Group, and AppService Plan.

##### Use the Azure Portal to Finish Set Up
+ Once you app has been successfully created, open the app up. Click App Services > your-app's-name > Tools > Extensions > Add
+ Select Composer in the Choose extension blade.
+ Click OK in the Accept legal terms blade. Click OK in the Add extension blade.
+ Back in your web app's blade, click Settings > Application Settings.
+ Check that the PHP version is up to date.
+ Scroll to the bottom of the blade and change the root virtual directory to point to site\wwwroot\public instead of site\wwwroot.

##### Push your code to the Azure website.
+ Now set up deployment settings. Click on Deployment Source in your settings blade and select Local Git Repository.
+ Then click Deployment Credentials and set up your username and password for deployment.
+ Last, open up the Properties blade. Copy down the git URL.
+ In the terminal, use the commands `git init` and `git remote add azure [deployment URL]` to set up deployment to Azure.
+ Commit using normal git commands.
+ Use `git push azure master` to deploy online.

## About the code
The main logic is in "app/Http/routes.php." Helper functions and classes are located in "app/Http/Controllers". In particular, if you are interested in the token verification logic, see "app/Http/Controllers/TokenChecker.php".  The rest of the code is mainly associated with the Laravel framework. 

## More information
A PHP web application that authenticates users with Azure AD B2C using OpenID Connect. B2C is an identity management service for both web applications and mobile applications. Developers can rely on B2C for consumer sign up and sign in, instead of relying on their own code. Consumers can sign in using brand new credentials or existing accounts on various social platforms (Facebook, for example). 

Learn more about B2C here: https://azure.microsoft.com/en-us/services/active-directory-b2c/
