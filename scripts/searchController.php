<?php
	require_once("inc/session.php");
	require_once('inc/config.php');
	require_once('inc/core.php');

	function searchResult($term) {		
		$searchHandler = new bhg_search($term);
		$results = $searchHandler->search_topic_title();
		return $results;
	}
?>