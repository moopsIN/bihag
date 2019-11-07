<?php
	include_once('inc/session.php');
	include_once('inc/config.php');
	include_once('inc/core.php');

	if (!bhg_session::isValid()) bhg_session::start();	

	$id = $_GET['id'];

	$thread = new bhg_single_thread($id);
	$author = $thread->get_thread_author_metadata();

	$postHandler = new bhg_post;
	$postList = $postHandler->get_all_posts_from_thread($id);

	require_once('header.php');
?>

<section>
	<div class="container">
		<div class="row">
			<h3><?php echo $thread->get_thread_title(); ?></h3>

		</div>
		<div class="row text-center"><hr></div>
		<div class="row">
			<p><?php echo $thread->get_thread_body(); ?></p>
		</div>
		
		<div class="row">
			<div class="col-xs-6">
				<p><?php echo $thread->get_thread_primary_tag(); ?></p>
			</div>
			<div class="col-xs-6 text-right">
				<p><?php echo "<a href='" . $WEB_ROOT . "user?name=" . $author['name'] . "'><img src='./assets/img/default-avatar.jpg' class='img-circle col-xs-3 col-sm-2 col-md-2' />".$author['name']."</a>"; ?></p>
			</div>
		</div>
		<div class="row text-center"><hr></div>
	</div>
</section>

<section>
	<div class="container">
		<div class="row">
<?php	
	foreach ($postList as $post) {			
			echo "<div class='row' id='".$post['postID']."'>";
			echo "<p>".$post['postBody']."</p>";
			echo "</div>";
			echo "<div class='row'>";
			echo "<div class='col-xs-6'>".$post['time']."</div>";
			echo "<div class='col-xs-6 text-right'><a href='" . $WEB_ROOT . "user?name=" . $post['username'] . "'><img src='./assets/img/default-avatar.jpg' class='img-circle col-xs-3 col-sm-2 col-md-2' />".$post['username']."</a></div>";
			echo "</div>";
			echo "<div class='row'><hr/></div>";		
	}
?>
			
		</div>
	</div>
</section>

<section>
	<div class="container">
		<div class="row">
			<h5>Reply To This Thread:</h5>
		</div>
<?php
	if(bhg_session::isLoggedIn()) {		
?>
		<div class="row">

			<form action="scripts/postReply.php" method="post">
			<div class="col-sm-1">&nbsp;</div>		
					<textarea class="col-sm-8" name="replyPost" placeholder="Type Your Post Here" required></textarea>
					<input type="hidden" name="user" value="<?php echo $_SESSION['userID']; ?>">
					<input type="hidden" name="thread" value="<?php echo $id; ?>">
					<input class="col-sm-2" type="submit" value="Post">
			<div class="col-sm-1">&nbsp;</div>
			</form>
		</div>
<?php
	} else {
?>

		<div class="row">
			<div class="col-sm-12 text-center"><h4>You Must Login First</h4></div>

			<form action="./scripts/loginAuthenticate.php" method="post">
					<div class="row"><input type="text" name="username" placeholder="Username" required/></div><br>
					<div class="row"><input type="password" name="passcode" placeholder="Password" required/></div><br>
					<input type="hidden" name="redirect" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
					<div class="row"><input type="submit" value="Login"/></div>
			</form>

		</div>
		
<?php
	}
?>

	</div>	
</section>

<?php
	require_once('footer.php');
?>
