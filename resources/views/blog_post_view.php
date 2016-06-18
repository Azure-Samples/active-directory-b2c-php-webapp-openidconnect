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
				
			<!-- Display the Blog Post -->
			<?php foreach($blog_posts as $post) { ?>
				<!-- Title -->
				<h2><?php echo $post['title']?></a></h2>
				<span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post['reg_date']?>
				<div class="roundcont">
					<div class="roundtop"><img src="<?php echo asset("theme/img/tl.gif")?>" alt="tl img"  width="10" height="10" class="corner"  style="display: none" /> </div>
						<!-- Post Content -->
						<p><?php echo $post['content']?></p>
						<!-- Post date/time -->
						<span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post['reg_date']?> <p>
					<div class="roundbottom"><img src="<?php echo asset("theme/img/bl.gif")?>" alt="bl img" width="10" height="10" class="corner" style="display: none" /></div>
				</div>
			<?php } ?>
			
			<!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
					<?php if ($user_logged_in) {
						echo '<form method="post" role="form">'.
								'<div class="form-group">'.
									'<textarea class="form-control" rows="3" name="content"></textarea>'.
								'</div>'.
								'<input type="hidden" name="author" value="'.$given_name.'">'.
								'<button type="submit" class="btn btn-primary">Submit</button>'.
						'	  </form>';
					}
                    else {
						echo 'Sorry, you must be logged in to leave a comment';
					}?>
                </div>

                <hr>

                <!-- Posted Comments -->
				<?php foreach($comments as $comment) { ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment['author']?>
                            <small><?php echo $comment['reg_date']?></small>
                        </h4>
						<?php echo $comment['content']?>
                    </div>
                </div>
				<?php } ?>

</body>

</html>
