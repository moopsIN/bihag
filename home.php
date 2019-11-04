<?php
	include('inc/config.php');
	include('inc/core.php');

	$threadList = new bhg_list_threads();

	require_once('header.php');
?>

<section>
	<div class="container">
		<div class="row text-center">
			<h3>Recent Posts</h3>
		</div>
		<div class="row text-center"><hr></div>

	<?php	$threadList->display_thread_list($num_of_threads_on_home); ?>

	</div>
</section>

<?php
	require_once('footer.php');
?>