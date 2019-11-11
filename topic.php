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

<section class="mt-4">
	<div class="container">
		<div class="row">
			<h3><?php echo $thread->get_thread_title(); ?></h3>

		</div>
		<div class="row text-center"><hr></div>
		<div class="row">
			<p class="col-6"><?php echo "<a href='" . $WEB_ROOT . "/user?name=" . $author['name'] . "' class='text-danger'><img src='./assets/img/".$author['id'].".jpg' class='rounded-circle col-3 col-sm-2 col-md-2' />".$author['name']."</a>"; ?></p>
		</div>
		<div class="row">
			<p class="py-sm-3 py-xs-1"><?php echo $thread->get_thread_body(); ?></p>
		</div>
		
		<div class="row">
			<div class="col-6">
				<code class="bg-info text-light py-1 px-2 rounded"><?php echo $thread->get_thread_primary_tag(); ?></code>
			</div>
			<div class="col-6 text-right">
				<small><strong><?php echo humanTiming(strtotime($thread->get_thread_create_time())) . " ago"; ?></small></strong>
			</div>
		</div>
		<hr class="col-12 p-0">
	</div>
</section>

<section>
	<div class="container">		
<?php	
	foreach ($postList as $post) {			
			echo "<div class='row' id='".$post['postID']."'>";
			echo "<div class='col-xs-6'><a href='" . $WEB_ROOT . "/user?name=" . $post['username'] . "' class='text-danger'><img src='./assets/img/".$post['userID'].".jpg' class='rounded-circle col-xs-3 col-sm-2 col-md-2' />".$post['username']."</a></div>";
			echo "</div>";
			echo "<div class='row'>";
			echo "<p class='py-sm-3 py-xs-1'>".$post['postBody']."</p>";
			echo "</div>";
			echo "<div class='row'>";
			echo "<div class='col-12 text-right'><small><strong>". humanTiming(strtotime($post['time'])) ." ago</small></strong></div>";
			
			echo "</div>";
			echo "<hr class='col-12 p-0'>";		
	}
?>		
	</div>
</section>

<section>
	<div class="container">
		<div class="row">
			<h4>Reply To This Thread:</h4>
		</div>
<?php
	if(bhg_session::isLoggedIn()) {		
?>
		<div class="row">
			<form action="scripts/postReply.php" method="post">
			<div class="col-sm-1">&nbsp;</div>		
					<textarea id ="bihagtextarea" class="col-sm-8" rows="5" name="replyPost" placeholder="Type Your Post Here" required> </textarea>
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

			<form action="./scripts/loginAuthenticate.php" class="mt-sm-3" method="post">
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
