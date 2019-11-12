<!doctype html>

<html lang="en">
	<head>
  		<meta charset="utf-8">
		  <title>Moops Bihag</title>
		  <meta name="description" content="A Bihag Power Demonstration">
		  <meta name="author" content="Moops Design">
		  <meta name="viewport" content="width=device-width, initial-scale=1.0">

		  <link rel="stylesheet" href="<?php echo $WEB_ROOT;?>/assets/styles/bootstrap/bootstrap.min.css">
		  <link rel="stylesheet" href="assets/styles/custom.css">
		  <script src="<?php echo $WEB_ROOT; ?>/assets/js/tinymce/tinymce.min.js"></script>
		  <script>
  			tinymce.init({
    			selector: '#bihagtextarea',
    			menubar: false,
    			plugins: ["autolink codesample hr link lists wordcount preview"],
    			toolbar: 'undo redo | h2 h3 | bold underline subscript superscript strikethrought hr | bullist numlist | link unlink | preview',
    			contextmenu: false
  			});
  		</script>

		  <!--
		  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		  <script src="https://kit.fontawesome.com/a6b1dc0fc2.js" crossorigin="anonymous"></script> -->

	</head>

	<body>
		<header class="shadow-sm bg-light pb-0 p-0 m-0">

<?php if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) { ?>
		
	<nav class="navbar navbar-expand-lg navbar-light bg-dark py-2">
  		<div class="row px-2">
  			<strong class="text-white">Hello <span class="text-danger"><?php echo $_SESSION['userName']; ?></span>! </strong> &emsp;
  			<a class="text-white" href="./admin/">Manage</a> &emsp;
  			<a class="text-white" href="./admin/">Stats</a>
  		</div>
	</nav>

<?php } ?>
			<div class="container">				
				<div class="row pt-2">
					<div class="col-12 col-sm-4 text-center text-sm-left">
						<h3><a class="text-info font-weight-bold" href="<?php echo $WEB_ROOT; ?>"><?php echo $siteName; ?></a> </h3>
					</div>
					<div class="col-12 col-sm-4">
						<form action="search.php" method="get" id="search">
							<input class="col-12 py-2 mx-auto border border-success rounded" type="text" name="query" placeholder="Search <?php echo $siteName; ?>"  required/>
							<input type="submit" value="SEARCH" style="position: absolute; left: -9999px">
						</form>
					</div>				
					<div class="col-12 col-sm-4 text-center text-sm-right pt-2">
						<h6>
						<a class="text-danger" href="./">Home</a>&nbsp;
					<?php if(isset($_SESSION['validate']) && $_SESSION['validate']) { ?>
						<a class="text-danger" href="./dash"><?php echo $_SESSION['userName']; ?></a>&nbsp;
						<a class="text-danger" href="./scripts/logout">Logout</a>&nbsp;
					<?php } else { ?>
						<a class="text-danger" href="./login">Login</a>&nbsp;
					<?php } ?>
						</h6>
					</div>	
				</div>
				<div class="row"><hr></div>
			</div>
		</header>