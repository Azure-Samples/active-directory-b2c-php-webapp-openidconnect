<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <title>Olena's Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo asset("/theme/style.css")?> rel="stylesheet" type="text/css">

</head>

<body>

	<div id="container">
  <div id="banner">
    <h1>Olena's Blog - blogging about my internship at Microsoft</h1>
  </div>
  <div id="navcontainer">
    <ul id="navlist">
      <li id="active"><a id="current" href="#">Home</a></li>
      <li><a href="#">New Blog Post</a></li>
      <li><a href="#">Edit Profile</a></li>
      <li><a href="#">Logout</a></li>
    </ul>
  </div>
  <h1>Hello, <?php echo $given_name?>!</h1>
  <blockquote>I'm Olena and I'm an intern on the B2C (Business to Consumer) team at Microsoft. B2C is a really exciting product that lets developers use Microsoft to authenticate users. This way, developers don't have to worry about the complicated security issues associated with user authentication, since Microsoft already does that really well.<br />
    To find out more about B2C visit <a href="https://azure.microsoft.com/en-us/services/active-directory-b2c/">the website</a>.</blockquote>
  <p><img class="img" src="img/blank.jpg" alt="blank" title="blank" width="60" height="60" /> As part of my intern project, I'm creating a PHP web application that uses B2C for authentication. In fact, you're on a live demo of the site right now! Check out the <a href="https://github.com/Azure-Samples/active-directory-b2c-php-webapp-openidconnect">source code on github</a>. The repo contains code for a PHP blogging application that demonstrates the use of several B2C policies: general sign-in/sign-up without multifactor authetication, sign-in/sign-up with multifactor authentication, and profile editing. Users designated as administrators must login with the administrator policy requiring multifactor authentication. Administrators have the ability to create new blog posts. The application also illustrates how to receive and verify id-tokens from the B2C endpoint following the OpenID Connect standard. Additionally, I encourage you to explore this site and try out B2C for yourself! Try signing up!</p>
  <div id="sidebar-a">
	<h2>About this site</h2>
		<p>This website was built using PHP and the framework Laravel using IIS on Windows.</p>
    <h2>Click on the links to learn more!</h2>
    <ul>
      <li><a href="https://github.com/Azure-Samples/active-directory-b2c-php-webapp-openidconnect">Source code on Github</a></li>
      <li><a href="https://azure.microsoft.com/en-us/services/active-directory-b2c/">B2C</a></li>
      <li><a href="http://openid.net/specs/openid-connect-core-1_0.html">OpenID Connect authentication protocol</a></li>
    </ul>
  </div>
  <div id="content">
    <h2>Colour Resources</h2>
    <div class="roundcont">
      <div class="roundtop"><img src="img/tl.gif" alt="tl img"  width="10" height="10" class="corner"  style="display: none" /> </div>
      <p><a href="#">www.colourlovers.com</a><br />
        <a href="#">www.draac.com/</a><br />
        <a href="#">www.nutrocker.co.uk/</a><br />
        <a href="#">www.colorcombo.com</a> <br />
        <a href="#">www.colorwhore.com</a><br />
        <a href="#">www.limov.com</a><br />
        <a href="#">www.wellstyled.com</a><br />
        <a href="#">www.colormixers.com/</a></p>
      <div class="roundbottom"><img src="img/bl.gif" alt="bl img" width="10" height="10" class="corner" style="display: none" /></div>
    </div>
	
	<div id="footer"> Design by <a href="http://www.mitchinson.net"> www.mitchinson.net</a></div>

	<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?php if (isset($given_name)) echo "Hello, ".$given_name."!"?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
					<li>
                        <a href="new_post">New Blog Post</a>
                    </li>
                    <li>
                        <a href="edit_profile">Edit Profile</a>
                    </li>
                    <li>
                        <a href="logout">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	
</body>

</html>