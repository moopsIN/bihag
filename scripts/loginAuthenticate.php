<?php

	include_once('../inc/config.php');

	if(isset($_POST) && !empty($_POST) && strlen($_POST['username']) > 5 && strlen($_POST['passcode']) > 5) {
		
		include_once('../inc/loginAuth.php');

		$isAuthentic = false;
		
		$isAuthentic = bhg_login::authenticate($_POST['username'], $_POST['passcode']);

		if ($isAuthentic['valid']) {
			include_once('../inc/session.php');
			bhg_session::initialize($_POST['username'],$isAuthentic['id']);
			$redirectUrl = $_POST['redirect'];
			header("Location:..".$redirectUrl);

		} else {
			header("Location: ../login?message=Invalid%20Credentials");
		}
	} else {
			header("Location: ../login?message=Invalid%20Credentials");
	}


?>