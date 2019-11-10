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
    			plugins: ["autolink codesample hr link lists wordcount"],
    			toolbar: 'undo redo | h2 h3 | bold underline subscript superscript strikethrought | codesample hr | bullist numlist | link unlink | wordcount',
    			width: '80%',
    			min_width: '300px'
  			});
  		</script>

		  <!--
		  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		  <script src="https://kit.fontawesome.com/a6b1dc0fc2.js" crossorigin="anonymous"></script> -->

	</head>

	<body>
		<header>
			<div class="container">
				
				<div class="row">
					<div class="col-sm-3">
						<h3><a href="<?php echo $WEB_ROOT; ?>"><?php echo $siteName; ?></a> </h3>
					</div>
					<div class="col-sm-5">
						<form action="search.php" method="get" id="search">
							<input type="text" name="query" placeholder="Search Bihag" class="col-xs-8" required/>
							<input type="submit" class="col-xs-4" value="SEARCH">
						</form>
					</div>				
					<div class="col-sm-4 text-right">

						<h4>
						<a href="./">Home</a>&nbsp;
					<?php if(isset($_SESSION['validate']) && $_SESSION['validate']) { ?>
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