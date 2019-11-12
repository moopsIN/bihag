<?php
	include_once('../inc/config.php');
	include_once('../inc/session.php');
	include_once('../inc/core.php');

	if(!bhg_session::isLoggedIn()) {
		header("Location: ../login?message=Login%20Required");
		exit();
	} else {
		$user = new bhg_user($_SESSION['userName']);

		if ($user->get_user_level() === 99) {
			header("Location: ./manage");
			exit();
		} else {
			header("Location: ../dash");
			exit();
		}
		
	}
?>