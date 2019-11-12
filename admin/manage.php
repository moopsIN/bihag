<?php
	include_once('../inc/config.php');
	include_once('../inc/session.php');
	include_once('../inc/core.php');

	if(!bhg_session::isLoggedIn()) {
		header("Location: ../login?message=Login%20Required");
		exit();
	} else {
		$user = new bhg_user($_SESSION['userName']);

		if ($user->get_user_level() !== 99) {
			header("Location: ../dash");
			exit();
		} 		
	}

	include_once('../inc/admin.php');

	$statHandler = new bhg_admin_stats($user->get_user_id());
	$token = $statHandler->get_admin_token($user->get_user_id());

	require_once ('admin-header.php');
?>

<section class="py-4">
	<div class="container">
		<table class="table col-12 col-sm-6 col-md-4 col-lg-3 px-1">
			<thead>
				<tr>
					<h3 class="text-info">Mini Stats</h3>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">Users</th>
					<td><?php echo $statHandler->get_total_users($token); ?></td>
				</tr>
				<tr>
					<th scope="row">Threads</th>
					<td><?php echo $statHandler->get_total_threads($token); ?></td>
				</tr>
				<tr>
					<th scope="row">Posts</th>
					<td><?php echo $statHandler->get_total_posts($token); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</section>


<?php  require_once ('admin-footer.php'); ?>