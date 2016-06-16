<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "blog_layout.php" ?>
</head>

<body>

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
	
	<!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
				
                <!-- Blog Post -->
				<?php foreach($blog_posts as $post) { ?>
					<!-- Title -->
					<h1><?php echo $post['title']?></h1>
					<span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post['reg_date']?> <p>
					<!-- Post Content -->
					<p class="lead"><?php echo $post['content']?>
					<hr>
				<?php } ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
			
                <!-- Side Widget Well -->
                <div class="well">
                    <h4>About</h4>
                    <p>Hi, I'm Olena, and this is my summer intern project. Blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah</p>
                </div>
            </div>
			
        </div>
        <!-- /.row -->

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

</body>

</html>
