<?php
	include('inc/config.php');
	include('inc/core.php');

	$username = $_GET['name'];

	$user = new bhg_user($username);

	require_once('header.php');
?>

<section>
	<div class="container">
		<div class="row">
			<h3><?php echo $user->get_user_name(); ?></h3>
		</div>
		<div class="row text-center"><hr></div>
		<div class="row">
			<p></p>
		</div>
		<div class="row text-center"><hr></div>
		<div class="row">
			<div class="col-sm-6">
				<h4>Recent Threads</h4>
				<p></p>
			</div>
			<div class="col-sm-6">
				<h4>Recent Posts</h4>
			</div>
		</div>
	</div>
</section>

<?php
	require_once('footer.php');
?>