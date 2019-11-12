<!doctype html>

<html lang="en">
	<head>
  		<meta charset="utf-8">
		  <title>Manage - Moops Bihag</title>
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
				<nav class="navbar navbar-expand-lg navbar-light bg-dark py-2">
  					<div class="row px-2">
  						<strong class="text-white">Hello <span class="text-danger"><?php echo $_SESSION['userName']; ?></span>! </strong> &emsp;
  						<a class="text-white" href="./">Manage</a> &emsp;
  						<a class="text-white" href="./stats">Stats</a> &emsp;
  						<a class="text-warning" href="/"><?php echo $siteName; ?></a>
  					</div>
				</nav>
		</header>