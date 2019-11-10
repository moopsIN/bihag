<?php
	include_once('../inc/config.php');
	include_once('../inc/session.php');
	include_once('../inc/core.php');

	if(!bhg_session::isLoggedIn()) {
		header("Location: ". $WEB_ROOT ."/login?message=Login%20Expired");
		exit();
	}

	if(!isset($_POST['mode']) && !isset($_POST['postID']) && !isset($_POST['postBody'])) {
		header("Location:" . $WEB_ROOT . "/dash");
		exit();
	} 

	$success = false;
	$postHandler = new bhg_post;

	if($_POST['mode'] === "update") {
		$success = $postHandler->update_post($_POST['postID'], $_POST['postBody']);
		if($success) {
			header("Location:".$WEB_ROOT."/topic?id=".$_POST['redirect']);
			exit();
		} else {
			header("Location:".$WEB_ROOT."/topic?id=".$_POST['redirect']);
			exit();
		}
	}
?>