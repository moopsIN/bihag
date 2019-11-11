<?php
	require_once('inc/config.php');
	require_once('inc/session.php');

	bhg_session::start();
	require_once('inc/core.php');

	$threadListHandler = new bhg_list_threads;
	$threadList = NULL;

	if (isset($_GET['tag']) && !empty($_GET['tag']) && strlen($_GET['tag']) > 1) {
			$threadList = $threadListHandler->list_thread_by_tag($_GET['tag']);
	}	

	require_once('header.php');
?>
<section class="my-4">
	<div class="container">
		<div class="row">
			<h2 class="text-secondary col-12 col-sm-10 mx-auto">Showing Threads with Primary Tag <span class="text-info">'<?php echo $_GET['tag']; ?>'</span></h2>
		</div>
	<?php
	
	foreach ($threadList as $thread) {
			echo "<div class='row py-3 px-3 col-12 col-sm-10 px-3 mx-auto'>";
				echo "<a href='./topic?id=".$thread['threadID']."' class='text-danger'><code class='bg-info text-white px-1 mr-1  rounded'><small>". strtoupper($thread['threadPrimaryTag']) . "</small></code>" .$thread['threadTitle']."</a>";
			echo "</div>";			
	}
?>
	</div>
	
</section>


<?php
	require_once('footer.php');
?>