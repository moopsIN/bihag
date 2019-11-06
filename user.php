<?php
	include('inc/config.php');
	include('inc/core.php');

	$username = $_GET['name'];

	$user = new bhg_user($username);

	$threads = new bhg_list_threads();
	$threadList = $threads->get_thread_list($user->get_user_id());

	require_once('header.php');
?>

<section>
	<div class="container">
		<div class="row">
			<img src="./assets/img/default-avatar.jpg" class="col-xs-2 img-circle" style="">
			<div class="col-xs-3"><h3><?php echo $user->get_user_name(); ?></h3></div>
		</div>
		<div class="row text-center"><hr></div>
		<div class="row">
			<p></p>
		</div>
		<div class="row text-center"><hr></div>
		<div class="row">
			<div class="col-sm-6">
				<h4>Recent Threads</h4>
<?php
	
	foreach ($threadList as $thread) {
			echo "<div class='row'><hr /> </div>";
			echo "<div class='row'>";
			echo "<a href='./topic?id=".$thread['threadID']."'>".$thread['threadTitle']."</a>";
			echo "</div>";			
	}
?>
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