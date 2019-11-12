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
<section class="py-3">
	<div class="container">
		<h3 class="col-10 col-sm-8 col-md-6 mx-auto text-center">Stats - <span class="text-info"><?php echo $siteName; ?></span></h3>
	</div>

	<div class="container">
		<table class="table text-center col-12 col-sm-10 col-md-8 col-lg-6 mx-auto my-4">
			<thead>
				<tr>
					<th scope="col">Users</th>
					<th scope="col">Threads</th>
					<th scope="col">Replies</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $statHandler->get_total_users($token); ?></td>
					<td><?php echo $statHandler->get_total_threads($token); ?></td>
					<td><?php echo $statHandler->get_total_posts($token); ?></td>
				</tr>
			</tbody>
		</table>	
	</div>
</section>


<?php  require_once ('admin-footer.php'); ?>