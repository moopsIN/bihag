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

	$threads = $statHandler->get_list_of_threads($token);

	require_once ('admin-header.php');
?>
<section class="py-3">
	<div class="container">
		<h3 class="col-10 col-sm-8 col-md-6 mx-auto text-center">Stats - <span class="text-info"><?php echo $siteName; ?></span></h3>
	</div>

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

<section class="py-2">
	<div class="container">
		<div class="row">
			<div class="col-10 col-md-8 mx-auto d-inline-block vh-100 overflow-auto">
				<h4 class="text-center">All Threads</h4>
<?php foreach ($threads as $thread) { ?>
				<div class="row px-2 py-1">
					<?php echo "<p><span class='border rounded py1 px-2 bg-secondary text-white'>" . $thread['threadPrimaryTag'] . "</span> " . $thread['threadTitle'] . "</p>";  ?> 
				</div>	
<?php } ?>
			</div>
			<div class="col-10 col-md-4 mx-auto text-center d-inline-block border-left">
				<h4>All Users</h4>
			</div>
		</div>
	</div>	
</section>


<?php  require_once ('admin-footer.php'); ?>