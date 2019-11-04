<?php

	include('inc/config.php');
	include('inc/core.php');

	$id = $_GET['id'];

	$thread = new bhg_single_thread($id);
	$author = $thread->get_thread_author_metadata();

	require_once('header.php');
?>

<section>
	<div class="container">
		<div class="row">
			<h3><?php echo $thread->get_thread_title(); ?></h3>
		</div>
		<div class="row text-center"><hr></div>
		<div class="row">
			<p><?php echo $thread->get_thread_body(); ?></p>
		</div>
		<div class="row text-center"><hr></div>
		<div class="row">
			<div class="col-xs-6">
				<p><?php echo $thread->get_thread_primary_tag(); ?></p>
			</div>
			<div class="col-xs-6 text-right">
				<p><?php echo "<a href='" . $WEB_ROOT . "user?name=" . $author['name'] . "'>".$author['name']."</a>"; ?></p>
			</div>
		</div>
	</div>
</section>

<?php
	require_once('footer.php');
?>
