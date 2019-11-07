<?php
	include_once('inc/config.php');
	include_once('inc/session.php');
	include_once('inc/core.php');

	if(!bhg_session::isLoggedIn()) {
		header("Location: ./login?message=Login%20Expired");
		exit();
	}

	$threads = new bhg_list_threads();
	$threadList = $threads->get_thread_list($_SESSION['userID']);

	$postHandler = new bhg_post;
	$postList = $postHandler->get_all_posts_from_user($_SESSION['userID']);

	require_once("header.php");
?>
<section>
	<div class="container">
		<div class="row">
			<img src="./assets/img/default-avatar.jpg" class="col-xs-2 col-md-1 img-circle" style="">
			<div class="col-xs-4"><h3><?php echo $_SESSION['userName']; ?></h3></div>
			<div class="col-xs-3">
				<form action="scripts/profileEdit.php" method="post" enctype="multipart/form-data">
        				<input type="file" name="fileToUpload" id="fileToUpload" required/>
        				<input type="hidden" name="token" value="0">
    					<input type="submit" value="Upload New Profile Image" name="submit">
				</form>
			</div>
		</div>
		<div class="row text-center">
			<a href="./write"><input type="button" value="Start A New Thread"></a>
		</div>
	</div>
</section>

<section>
	<div class="container">
		<div class="row">

			<div class="col-sm-6">
				<div class="row">
					<h3>Threads By You</h3>
				</div>
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
			echo "<a href='./topic?id=".$post['threadID']."#".$post['postID']."'>".$post['postBody']."</a>";
			echo "</div>";			
	}
?>
			</div>

		</div>
	</div>
</section>

<?php require_once("footer.php"); ?>