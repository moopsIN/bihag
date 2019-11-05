<?php
	include_once('../inc/config.php');
	include_once('../inc/session.php');

	if(bhg_session::isLoggedIn()) {
		header("Location: ./dash");
		exit();
	}

	if(isset($_POST) && !empty($_POST) && strlen($_POST['username']) > 5 && strlen($_POST['passcode']) > 5) {

		include_once('../inc/regUser.php');
		$result = bhg_register_user::register($_POST['username'], $_POST['passcode']);

		if ($result) {
			header("Location:".$WEB_ROOT."login");
		} else {
			header("Location:".$WEB_ROOT."register?message=Something%20Went%20Wrong");
		}

	} else {
		header("Location:".$WEB_ROOT."register?message=Invalid%20Data");
	}
?>
