<?php
	include_once('../inc/config.php');
	include_once('../inc/session.php');	

	if(!bhg_session::isLoggedIn()) {
		header("Location: ./login?message=Login%20Expired");
		exit();
	}

	if(isset($_POST) && !empty($_POST) && strlen($_POST['threadTitle']) > 5) {
		include_once('../inc/core.php');

		$title = $_POST['threadTitle'];
		$body = $_POST['threadBody'];

		$newThreadHandle = new bhg_new_thread($title, $body, $_SESSION['userID']);

		$writeResult = $newThreadHandle->writeThread();

		if($writeResult === NULL) {
			die("Mar Gaya Yaar");
		} else {
			header("Location:".$WEB_ROOT."/topic?id=".$writeResult);
		}
	}
?>