<?php
	include_once('inc/config.php');
	include_once('inc/session.php');
	include_once('inc/core.php');

	if(!bhg_session::isLoggedIn()) {
		header("Location: ./login?message=Login%20Expired");
		exit();
	}

	require_once("header.php");
?>
<section>
	<div class="container">
		<div class="row text-center">
			<a href="./write"><input type="button" value="Write a New Post"></a>
		</div>
	</div>
</section>

<?php require_once("footer.php"); ?>