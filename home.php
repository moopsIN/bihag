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
			<h3>Recent Posts</h3>
		</div>
		<div class="row text-center"><hr></div>

<?php
	foreach ($threads as $thread) {
			echo "<div class='row'>";
				echo "<div class='col-xs-12'>";
					echo "<h4><a href='" . $WEB_ROOT . "/topic?id=" . $thread['threadID'] . "'>" . $thread['threadTitle'] . "</a></h4>";
				echo "</div>";
				echo "<div class='col-xs-12'>";
					echo "<div class='col-xs-6 text-left'>";
						echo "<a href='#'>" . strtoupper($thread['threadPrimaryTag']) . "</a>";
					echo "</div>";
					echo "<div class='col-xs-6 text-right'>";
						echo  date('d-M-Y',strtotime($thread['time']));
					echo "</div>";
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