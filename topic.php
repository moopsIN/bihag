<?php
	include_once('inc/session.php');
	include_once('inc/config.php');
	include_once('inc/core.php');

	bhg_session::start();	

	$id = $_GET['id'];

	$thread = new bhg_single_thread($id);
	$author = $thread->get_thread_author_metadata();

	$postHandler = new bhg_post;
	$postList = $postHandler->get_all_posts_from_thread($id);

	require_once('header.php');
?>

<section class="mt-4 px-2">
	<div class="container">
		<div class="row my-4">
			<h3><code class="bg-info text-light px-2 mx-2 font-weight-light rounded"><small><?php echo $thread->get_thread_primary_tag(); ?></small></code><?php echo $thread->get_thread_title(); ?></h3>

		</div>
		
		<div class="row pr-3 align-text-bottom">
			<div class="col-6">
				<?php echo "<a href='" . $WEB_ROOT . "/user?name=" . $author['name'] . "' class='text-danger'><img src='./assets/img/".$author['id'].".jpg' class='rounded-circle col-3 col-sm-3 col-md-3 col-lg-2' />".$author['name']."</a>"; ?>
			</div>
			<div class="col-6 text-right">
				<small><strong><?php echo humanTiming(strtotime($thread->get_thread_create_time())) . " ago"; ?></small></strong>
			</div>
		</div>
		<div class="row">
			<p class="py-sm-3 py-xs-1"><?php echo $thread->get_thread_body(); ?></p>
		</div>

		<?php if ($_SESSION['userID'] === $author['id']) { ?>

		<div class="row">
			<p class="text-right"><a href="#">edit</a></p>
		</div>

		<?php }	?>
		
		
		<hr class="col-12 p-0">
	</div>
</section>

<section class="mt-4 px-2">
	<div class="container">		
<?php	
	foreach ($postList as $post) {			
			echo "<div class='row pr-3' id='".$post['postID']."'>";
			echo "<div class='col-6'><a href='" . $WEB_ROOT . "/user?name=" . $post['username'] . "' class='text-danger'><img src='./assets/img/".$post['userID'].".jpg' class='rounded-circle col-3 col-sm-3 col-md-3 col-lg-2' />".$post['username']."</a></div>";
			echo "<div class='col-6 text-right'><small><strong>". humanTiming(strtotime($post['time'])) ." ago</small></strong></div>";
			echo "</div>";
			echo "<div class='row'>";
			echo "<p class='py-sm-3 py-1'>".$post['postBody']."</p>";
			echo "</div>";
			echo "<div class='row'>";

			if ($_SESSION['userID'] === $post['userID']) {

			echo "<div class='row'>";
			echo "<p class='col-10 mx-auto text-right'><a href='#'>edit</a></p>";
			echo "</div>";

		}
			
			
			echo "</div>";
			echo "<hr class='col-12 p-0'>";

		
		
	}
?>		
	</div>
</section>

<section class="mt-4 px-2">
	<div class="container">
		<div class="row">
			
		</div>
<?php
	if(bhg_session::isLoggedIn()) {		
?>
		<div class="row">
			
			<form action="scripts/postReply.php" method="post" class="col-12 col-sm-10 col-md-10 mx-auto mt-3">

				<h4 class="mb-2">Reply To This Thread:</h4>
				
					<textarea id ="bihagtextarea" rows="5" name="replyPost" placeholder="Type Your Post Here" required> </textarea>
					<input type="hidden" name="user" value="<?php echo $_SESSION['userID']; ?>">
					<input type="hidden" name="thread" value="<?php echo $id; ?>">
					<input type="submit" value="Post">
			
			</form>
		</div>
<?php
	} else {
?>

		<div class="row text-center">
		
			<div class="col-12 col-sm-8 col-md-4 mx-auto my-4">
				<form action="<?php echo $WEB_ROOT; ?>/scripts/loginAuthenticate.php" method="post">

						<strong>You Must Login To Reply</strong>
						
					<div class="row my-3"><input class="mx-auto col-10 border border-warning py-2 rounded" type="text" name="username" placeholder="Username" required/></div>

					<div class="row my-3"><input class="mx-auto col-10 border border-warning py-2 rounded" type="password" name="passcode" placeholder="Password" required/></div>

					<input type="hidden" name="redirect" value="<?php echo $_SERVER['REQUEST_URI']; ?>">

					<div class="row my-3"><input class="mx-auto col-6" type="submit" value="Login"/></div>
				</form>
			</div>
			
		</div>
		
<?php
	}
?>

	</div>	
</section>

<?php
	require_once('footer.php');
?>
