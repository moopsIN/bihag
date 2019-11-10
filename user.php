<?php
	include('inc/config.php');
	include_once('inc/session.php');

	bhg_session::start();
	include('inc/core.php');

	$username = $_GET['name'];

	$user = new bhg_user($username);

	if (isset($_SESSION['userID']) && !empty($_SESSION['userID']) && $_SESSION['userID'] === $user->get_user_id() ) {
		header("Location: ./dash");
		exit();
	}

	$threads = new bhg_list_threads();
	$threadList = $threads->get_thread_list($user->get_user_id());

	$postHandler = new bhg_post;
	$postList = $postHandler->get_all_posts_from_user($user->get_user_id());

	require_once('header.php');
?>

<section>
	<div class="container">
		<div class="row">
			<img src="./assets/img/<?php echo $user->get_user_id(); ?>.jpg" class="col-xs-2 col-md-1 img-circle" style="">
			<div class="col-xs-3"><h3><?php echo $user->get_user_name(); ?></h3></div>
		</div>
		<div class="row text-center"><hr></div>
		<div class="row">
			<p></p>
		</div>
		<div class="row text-center"><hr></div>
		<div class="row">
			<div class="col-sm-6">
				<h3>Recent Threads</h3>
<?php
	
	foreach ($threadList as $thread) {
			echo "<div class='row'><hr /> </div>";
			echo "<div class='row'>";
			echo "<a href='./topic?id=".$thread['threadID']."'>".$thread['threadTitle']."</a>";
			echo "</div>";			
	}
?>
			</div>
			<div class="col-sm-6">
				<div class="row">
					<h3>Recent Posts</h3>
				</div>
<?php
	
	foreach ($postList as $post) {
			echo "<div class='row'><hr /> </div>";
			echo "<div class='row'>";

			echo "<a href='./topic?id=".$post['threadID']."#".$post['postID']."'>". strip_tags(substr($post['postBody'], 0, 100))."...</a>";
			echo "</div>";			
	}
?>
			</div>
		</div>
	</div>
</section>

<?php
	require_once('footer.php');
?>