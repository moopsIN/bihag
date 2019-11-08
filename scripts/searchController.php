<?php

	include_once('../inc/session.php');
	include_once('../inc/config.php');
	include_once('../inc/core.php');

	$query = $_GET['query'];

	

	header("Location:../search?q=".$query)
?>