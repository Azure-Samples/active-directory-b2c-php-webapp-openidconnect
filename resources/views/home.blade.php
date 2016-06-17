<!DOCTYPE html>
<html lang="en">

<head>
    <?php /*include "blog_layout.php"*/ ?>
</head>

<body>
	
	<h1>Hello, <?php if (isset($given_name)) echo $given_name?>!</h1>
	<h1>please work, {{ given_name }}!</h1>
  <blockquote>I'm Olena and I'm an intern on the B2C (Business to Consumer) team at Microsoft. 
				B2C is a really exciting product that lets developers use Microsoft to authenticate users. 
				This way, developers don't have to worry about the complicated security issues associated 
				with user authentication, since Microsoft already does that really well.<br />
				To find out more about B2C, visit 
				<a href="https://azure.microsoft.com/en-us/services/active-directory-b2c/">the website</a>.
	</blockquote>
  <p><img class="img" src="<?php echo asset("theme/img/blank.jpg")?>" alt="blank" title="blank" width="60" height="60" /> 
	As part of my intern project, I'm creating a PHP web application 
	that uses B2C for authentication. In fact, you're on a live demo 
	of the site right now! I encourage you to explore this site and 
	try out B2C for yourself by signing up/signing in and editing your profile.<br><br><br></p>
																														
  <div id="sidebar-a">
	<h2>About this site</h2>
		<p>This website was built using PHP and the framework Laravel using IIS on Windows.</p>
		<p>Check out the <a href="https://github.com/Azure-Samples/active-directory-b2c-php-webapp-openidconnect">source code on github</a> 
			to get the technical details on how the site integrates with B2C. 
			You'll also find instructions on how to deploy your own website that integrates with B2C, so try it out!</p>
		<p>Additionally, the repo contains code that demonstrates the use of several B2C policies: general sign-in/sign-up 
			without multifactor authetication, sign-in/sign-up with multifactor authentication, and profile editing. Users 
			designated as administrators must login with the administrator policy requiring multifactor authentication. 
			Administrators have the ability to create new blog posts. The application also illustrates how to receive and verify id-tokens 
			from the B2C endpoint following the OpenID Connect standard. </p>
    <h2>Thanks to</h2>
    <ul>
	  <li>the entire B2C team for being super helpful</li>
	  <li><a href="http://www.mitchinson.net">www.mitchinson.net</a> for the blog theme design</li>
    </ul>
  </div>
  <div id="content">
  
	
	<!-- Display all Blog Posts -->
	@foreach(blog_posts as post)
		<!-- Title -->
		<h2><a href="blog_post?id={{ post->id }}">{{ post->title }}</a></h2>
		<div class="roundcont">
			<div class="roundtop"><img src="<?php echo asset("theme/img/tl.gif")?>" alt="tl img"  width="10" height="10" class="corner"  style="display: none" /> </div>
				<!-- Post Content -->
				<p>{{ post->content }}</p>
				<!-- Post date/time -->
				<span class="glyphicon glyphicon-time"></span> Posted on {{ post->reg_date }}<p>
			<div class="roundbottom"><img src="<?php echo asset("theme/img/bl.gif")?>" alt="bl img" width="10" height="10" class="corner" style="display: none" /></div>
		</div>
	@endforeach

</body>

</html>
