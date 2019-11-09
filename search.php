<?php
	require_once('scripts/searchController.php');
	$results = searchResult($_GET['query']);

	require_once("header.php");

	if ($results !== NULL) {
		$message = "Displaying Search Results for '".$_GET['query']."'";
	} else {
		$message = "No Search Results Found for '".$_GET['query']."'";
	}


?>

<section>
	<div class="container">
		<div class="row text-center">
			<h2><?php echo $message; ?></h2>
		</div>
		<div class="row"><hr></div>

<?php
	if($results !== NULL) {
		foreach ($results as $result) {
			echo "<div class='row'>";
				echo "<div class='col-xs-12'>";
				echo "<h4><a href='". $WEB_ROOT ."/topic?id=". $result['threadID'] ."'>" . $result['threadTitle'] . "</a></h4>";
				echo "</div>";
			echo "</div>";
			echo "<div class='row'><hr></div>";
		}
	}
?>
	</div>
</section>
	
<?php
	require_once("footer.php");
?>