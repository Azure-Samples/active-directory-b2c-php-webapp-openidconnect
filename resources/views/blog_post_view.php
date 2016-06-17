<!DOCTYPE html>
<html lang="en">

<head>
    <?php /*include "blog_layout.php" */?>
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
			
			<!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="content"></textarea>
                        </div>
						<input type="hidden" name="author" value="Olena">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
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
