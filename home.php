<?php
	require_once('inc/config.php');
	require_once('inc/session.php');

	bhg_session::start();
	require_once('inc/core.php');

	$threadListHandler = new bhg_list_threads();
	$threads = $threadListHandler->get_thread_list("all");

	require_once('header.php');
?>

<section>
	<div class="container">
		<div class="row text-center">
			<div class="col-12">
				<h2>Recent Posts</h2>
			</div>			
		</div>
		<div class="row text-center"><hr></div>

<?php
	foreach ($threads as $thread) {
			echo "<div class='container'>";
				echo "<div class='row'>";
					echo "<div class='col-6 text-left'>";
						echo "<a href='#' class='bg-info text-light px-1 rounded'><code>" . strtoupper($thread['threadPrimaryTag']) . "</code></a>";
					echo "</div>";
					echo "<div class='col-6 text-right'><small><strong class='text-info'>";
						echo  humanTiming(strtotime($thread['time']));
					echo " ago</strong></small></div>";
				echo "</div>";

				echo "<div class='row'>";
					echo "<h5><a href='" . $WEB_ROOT . "/topic?id=" . $thread['threadID'] . "' class='text-danger'>" . $thread['threadTitle'] . "</a></h5>";
				echo "</div>";
				
				echo "<div class='row'>";
					echo "<p class='lead pl-xs-2 pl-sm-3'>". substr($thread['threadBody'], 0, 180) ."...</p>";
				echo "</div>";
			echo "</div>";
			echo "<div class='row text-center'><hr></div>";
	}
?>	

	</div>
</section>

<?php
	require_once('footer.php');
?>