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
		<div class="row mt-3">
			<img src="./assets/img/<?php echo $_SESSION['userID']; ?>.jpg" class="col-2 col-sm-2 col-md-1 rounded-circle" style="">
			<div class="col-md-6"><h3><?php echo $_SESSION['userName']; ?></h3></div>		
			<div class="col-4 col-md-5">
				<form action="scripts/profileEdit.php" method="post" enctype="multipart/form-data">
        				<input type="file" name="fileToUpload" id="fileToUpload" required/>
        				<input type="hidden" name="token" value="0">
    					<input type="submit" value="Upload New Profile Image" name="submit">
				</form>
			</div>
		</div>
		<div class="row text-center my-3">
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

			echo "<div class='row py-3 px-3'>";
			echo "<a href='./topic?id=".$thread['threadID']."' class='text-danger'><code class='bg-info text-white px-1 mr-1  rounded'><small>". $thread['threadPrimaryTag'] . "</small></code>" .$thread['threadTitle']."</a>";
			echo "</div>";			
	}
?>
			</div>
			<div class="col-12 col-md-6 col-lg-6">
				<div class="row">
					<h3>Recent Posts</h3>
				</div>
<?php
	
	foreach ($postList as $post) {
			
			echo "<div class='row py-3 px-3'>";
			echo "<a href='./topic?id=".$post['threadID']."#".$post['postID']."' class='text-info'>". strip_tags(substr($post['postBody'], 0, 100))."...</a>";
			echo "</div>";			
	}
?>
			</div>

		</div>
	</div>
</section>

<?php require_once("footer.php"); ?>