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
<section>
	<div class="container">
	<?php
	
	foreach ($threadList as $thread) {
			echo "<div class='row py-3 px-3'>";
			echo "<a href='./topic?id=".$thread['threadID']."' class='text-danger'><code class='bg-info text-white px-1 mr-1  rounded'><small>". $thread['threadPrimaryTag'] . "</small></code>" .$thread['threadTitle']."</a>";
			echo "</div>";			
	}
?>
	</div>
	
</section>


<?php
	require_once('footer.php');
?>