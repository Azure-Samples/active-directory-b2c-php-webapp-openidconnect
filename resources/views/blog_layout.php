<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <title>B2C PHP Web App</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo asset("/theme/style.css")?>" rel="stylesheet" type="text/css">

</head>

<body>

	<div id="container">
  <div id="banner">
    <h1>B2C PHP Web App</h1>
  </div>
  <div id="navcontainer">
    <ul id="navlist">
      <li id="active"><a id="current" href="/">Home</a></li>
	  <li><a href="https://github.com/Azure-Samples/active-directory-b2c-php-webapp-openidconnect">View Source Code on Github</a></li>
	    <?php if ($user_logged_in) {
		  if ($user_is_admin) echo '<li><a href="new_post">New Blog Post</a></li>';
		  echo '<li><a href="edit_profile">Edit Profile</a></li>';
		  echo '<li><a href="logout">Logout</a></li>';
		}
		else echo '<li><a href="login">Sign In or Sign Up</a></li>';
		?>
    </ul>
  </div>
  
  <?php if ($user_logged_in) {
	  echo '<h2>You have successfully logged in with B2C!</h2>';
	  echo '<div class="roundcont">';
	  echo '<div class="roundtop"><img src="theme/img/tl.gif" alt="tl img"  width="10" height="10" class="corner"  style="display: none" /> </div>';
	  echo '<p>Details:</p>';
	  echo '<p>Given name: '.$given_name.'</p>';
	  echo '<p>Is Admin? ';
	  if ($user_is_admin) echo 'Yes';
	  else echo 'No';
	  echo '</p>';
				
				
	  echo '<div class="roundbottom"><img src="<?php echo asset("theme/img/bl.gif")?>" alt="bl img" width="10" height="10" class="corner" style="display: none" /></div>';
	  echo '</div>';
  }
  else echo '<h1>You are not logged in. Please try logging in.</h1>'; ?>
  
	
</body>

</html>