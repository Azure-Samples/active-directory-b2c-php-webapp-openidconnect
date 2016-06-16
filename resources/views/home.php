<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "blog_layout.php" ?>
</head>

<body>
	
	<!-- Page Content -->
    <div class="container">

        <div class="row">
		<div class="row">
		<div class="row">
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
