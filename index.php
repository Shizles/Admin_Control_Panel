<?php
@session_start();
include ('assets/scripts/config.php');
include ('assets/scripts/checkSession.php');
?>
<!DOCTYPE html>
<!-- Bootstrap Template, Created by Shizles -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
    <title>Control Panel - Home</title>

    <!-- css -->
    <link href="css/bootstrap.css" rel="stylesheet">
	
	<!-- fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
  <body>
	<?php include ('assets/scripts/navbar.php'); ?>
	
	<!-- star of nav
	<nav class="navbar navbar-default" role="navigation">
	  <div class="container-fluid">
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
			<li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			<li><a href="players.php">Player Management</a></li>
			<li><a href="servercontrol.php">Server Control</a></li>
			<li><a href="satistics.php">Statistics</a></li>
		  </ul>
		  
		  <!-- logout/account 
		  <ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li><a href="#">Change Password</a></li>
				<li class="divider"></li>
				<li><a href="logout.php">Logout</a></li>
			  </ul>
			</li>
		  </ul>
		</div>
	  </div>
	</nav>
	end of nav -->
	
	
	<!-- main -->
	<center>
		<div class="jumbotron">
		  <h1>Hello, Welcome to Metro-Control</h1>
		  <p>...</p>
		  <!-- Button trigger modal -->
			<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
			  Learn more
			</button>
			
		  <!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">What is Metro-Control?</h4>
				  </div>
				  <div class="modal-body">
					<p>
					First of all Congratulations on gaining access to the Metro-Control Panel!
					</p>
					
					<br>
					<br>
					
					<p>
					So, What can I do on Metro-Control? 
					</p>
					The main goal is for staff to be able to use an interface quickly to search player data and change player data.
					
					<br>
					<br>
					
					<p>
					Control Panel Breakdown
					</p>
					Player Management - Search the Database for players and lookup there data such as Bank Balance, Player ID And Whitelist Rank
					<br>
					Server Control - Says it in the title really.. Things are due to change on this panel ranging from what servers we have. But it will be main server access/data.
					<br>
					Statistics - Lookup the top 25 richest players and other Database info such as amount of Database entry's.
					
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Thanks! I'm Done!</button>
				  </div>
				</div>
			  </div>
			</div>
		</div>
	
	
	<!-- messages panel -->
	<div class="alert alert-success alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  <strong>Yay!</strong> Welcome to the new control panel! Any bugs/errors report to Shizles. Thank you.
	</div>
	
	<div class="alert alert-info alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  <strong>Info</strong> All helpers and staff, please ensure you are up-to-date regarding the new Rules and Tests.
	</div>
	
	<!-- 
	<div class="alert alert-warning alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  <strong>Warning!</strong> This should be used for a major notice to all staff.
	</div>
	
	<div class="alert alert-danger alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  <strong>Error!</strong> This should be used for a major error or to avoid doing an action
	</div>
	-->	
	<!-- messages panel -->

	
	<?php include ('assets/scripts/footer.php'); ?>
	

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	</center>
  </body>
</html>