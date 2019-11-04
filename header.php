<!doctype html>

<html lang="en">
	<head>
  		<meta charset="utf-8">
		  <title><?php echo $pageTitle; ?></title>
		  <meta name="description" content="A Bihag Power Demonstration">
		  <meta name="author" content="Moops Design">
		  <meta name="viewport" content="width=device-width, initial-scale=1.0">

		  <link rel="stylesheet" href="<?php echo $WEB_ROOT;?>assets/styles/bootstrap/bootstrap.min.css">
		  <link rel="stylesheet" href="assets/styles/custom.css">

		  <!--
		  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		  <script src="https://kit.fontawesome.com/a6b1dc0fc2.js" crossorigin="anonymous"></script> -->

	</head>

	<body>
		<header>
			<div class="container">
				
				<div class="row">
					<div class="col-sm-6">
						<h3><a href="<?php echo $WEB_ROOT; ?>"><?php echo $siteName; ?></a></h3>
					</div>				
					<div class="col-sm-6 text-right">
						<h4>
						<a href="./">Home</a>&nbsp;
					<?php if($_SESSION['validate']) { ?>
						<a href="./dash"><?php echo $_SESSION['userName']; ?></a>&nbsp;
						<a href="./scripts/logout">Logout</a>&nbsp;
					<?php } else { ?>
						<a href="./login">Login</a>&nbsp;
					<?php } ?>
						</h4>
					</div>	
				</div>
				<div class="row"><hr></div>
			</div>
		</header>