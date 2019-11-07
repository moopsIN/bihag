<?php

	include_once('../inc/config.php');
	include_once('../inc/session.php');	

	if(!bhg_session::isLoggedIn()) {
		header("Location: ./login?message=Login%20Expired");
		exit();
	}

	if (isset($_POST['replyPost']) && !empty($_POST['replyPost']) && strlen($_POST['replyPost']) > 1 && isset($_POST['user']) && !empty($_POST['user']) && isset($_POST['thread']) && !empty($_POST['thread'])) {

		include_once('../inc/core.php');

		$isPosted = false;

		$postHandler = new bhg_post;
		$isPosted = $postHandler->new_post($_POST['thread'], $_POST['user'], $_POST['replyPost']);

		if ($isPosted) {
			header("Location:".$WEB_ROOT."topic?id=".$_POST['thread']);
			exit();
		} else {
			die("Can't Post Check error log for db errors.");
		}

	} else {
		die("Info Missing");
	}
?>