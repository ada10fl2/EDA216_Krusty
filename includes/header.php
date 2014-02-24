<?php
	require_once('./database/database.inc.php');
	require_once("./database/mysql_connect_data.inc.php");
	
	$db = new Database($host, $userName, $password, $database);
	$db->openConnection();
	if (!$db->isConnected()) {
		//header("Location: errors/cannotConnect.html");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</head>
	<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	    <span class="sr-only">Toggle navigation</span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="#">Krusty Cookies AB - Mangagment Console</a>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li <?= (!isset($page) || $page === "home") ? "class='active'" : "" ?> ><a href="index.php">Home</a></li>
			<li <?= ( isset($page) && $page === "pallets") ? "class='active'" : "" ?> ><a href="pallets.php">Pallets</a></li>
			<li <?= ( isset($page) && $page === "about") ? "class='active'" : "" ?> ><a href="about.php">About</a></li>
		</ul>
	</div><!--/.nav-collapse -->
	</div>
	</div>

    <div class="container" style="margin-top: 60px;">
      <div class="starter-template">
      <!-- content goes here -->