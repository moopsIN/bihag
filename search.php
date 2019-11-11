<?php
	require_once('scripts/searchController.php');
	$results = searchResult($_GET['query']);

	require_once("header.php");

	if ($results !== NULL) {
		$message = "Displaying Search Results for <span class='text-info'>'".$_GET['query']."'</span>";
	} else {
		$message = "No Search Results Found for <span class='text-info'>'".$_GET['query']."'</span>";
	}


?>

<section class="mt-4">
	<div class="container">
		<div class="row">
			<h2 class="text-secondary col-12 col-sm-10 mx-auto"><?php echo $message; ?></h2>
		</div>
		<div class="row"><hr></div>

<?php
	if($results !== NULL) {
		foreach ($results as $result) {
			echo "<div class='row pl-3 my-3'>";
				echo "<div class='col-12 col-sm-10 mx-auto'>";
				echo "<h5><a class='text-danger' href='". $WEB_ROOT ."/topic?id=". $result['threadID'] ."'>" . $result['threadTitle'] . "</a></h5>";
				echo "</div>";
			echo "</div>";
		}
	}
?>
	</div>
</section>
	
<?php
	require_once("footer.php");
?>