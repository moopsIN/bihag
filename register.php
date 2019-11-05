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

<section>
	<div class="container">
		<div class="row text-center">
			<h3>Register at <?php echo $siteName; ?></h3>
			<p style="color:red"><?php echo $message; ?></p>
		</div>
		
		<div class="row text-center"><hr></div>
		<div class="row text-center">
			<div class="col-sm-4 col-xs-1">&nbsp;</div>
			<div class="col-sm-4 col-xs-10">
				<form action="./scripts/registerUser.php" method="post">
					<div class="row"><input type="text" name="username" placeholder="Username" required/></div><br>
					<div class="row"><input type="password" name="passcode" placeholder="Password" required/></div><br>
					<div class="row"><input type="submit" value="Register"/></div>
				</form>
			</div>
			<div class="col-sm-4 col-xs-1">&nbsp;</div>
		</div>
	</div>
</section>

<?php require_once("footer.php"); ?>