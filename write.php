<?php
	include_once('inc/config.php');
	include_once('inc/session.php');
	include_once('inc/core.php');

	if(!bhg_session::isLoggedIn()) {
		header("Location: ./login?message=Login%20Expired");
		exit();
	}

	require_once("header.php");
?>

<section>
	<div class="container">
		<div class="row text-center">
			<h3>Start A New Thread!</h3>
		</div>
		
		<div class="row text-center"><hr></div>
		<div class="row text-center">
			<div class="col-sm-2 col-xs-1">&nbsp;</div>
			<div class="col-sm-8 col-xs-10">
				<form action="./scripts/newThread.php" method="post">
					<div class="row"><input class="col-sm-12" type="text" name="threadTitle" placeholder="Thread Title" required/></div><br>
					<div class="row"><textarea class="col-sm-12" rows="8" placeholder="Thread Description" name="threadBody" id="bihagtextarea" required/> </textarea></div><br>
					<div class="row"><input class="col-sm-4" type="submit" value="Post Thread"/></div>
				</form>
			</div>
			<div class="col-sm-2 col-xs-1">&nbsp;</div>
		</div>
	</div>
</section>

<?php require_once("footer.php"); ?>