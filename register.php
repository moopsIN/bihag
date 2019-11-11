<?php
	include_once('inc/config.php');
	include_once('inc/session.php');

	if(bhg_session::isLoggedIn()) {
		header("Location: ./dash");
		exit();
	}

	$message = $_GET['message'];

	require_once("header.php");
?>

<section class="mt-3">
	<div class="container">
		<div class="row text-center">
			<h3 class="col-12">Register At <?php echo $siteName; ?></h3>
			<span  class="col-12 text-danger font-weight-bold"><?php echo $message; ?></span>
		</div>

		<div class="row text-center">
			
			<div class="col-12 col-sm-8 col-md-4 mx-auto my-4">
				<form action="./scripts/registerUser.php" method="post">
					<div class="row my-3"><input class="mx-auto col-10 border border-warning py-2 rounded" type="text" name="username" placeholder="Username" required/></div>
					<div class="row my-3"><input class="mx-auto col-10 border border-warning py-2 rounded" type="email" name="email" placeholder="Email Address" required/></div>
					<div class="row my-3"><input class="mx-auto col-10 border border-warning py-2 rounded" type="password" name="passcode" placeholder="Password" required/></div>
					<div class="row my-2"><input class="mx-auto col-6" type="submit" value="Register"/></div>
				</form>
			</div>
			
		</div>

		<div class="row text-center">
			<div class="col-12 col-sm-8 col-md-4 mx-auto my-1">
				<h2>-OR-</h2>
				<a href="/login" class="shadow border border-success rounded py-2 px-3 text-info">Login</a>
			</div>
		</div>
	</div>
</section>

<?php require_once("footer.php"); ?>