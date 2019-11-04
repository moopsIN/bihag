<?php
	include_once("../inc/session.php");
	include_once("../inc/core.php");

	if (bhg_session::isLoggedIn()) {
		bhg_session::end();
		header("Location: ../login?message=Successfully%20Logged%20Out");
		exit();
	} else {
		bhg_session::end();
		header("Location: ../login?message=Session%20Invalid");
		exit();
	}
?>