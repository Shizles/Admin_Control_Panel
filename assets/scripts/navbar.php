<?php
include ('assets/scripts/functions.php');
?>
	<nav class="navbar navbar-default" role="navigation">
	  <div class="container-fluid">
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
			<li <?php checkInStr('index.php'); ?>>					<a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			<li <?php checkInStr('players.php'); ?>>				<a href="players.php">Player Management</a></li>
			<li <?php checkInStr('servercontrol.php'); ?>>			<a href="servercontrol.php">Server Control</a></li>
			<li <?php checkInStr('statistics.php'); ?>>				<a href="statistics.php">Statistics</a></li>
		  </ul>
		  <?php $uid = $_SESSION['Username'];  ?>
		  <!-- logout/account -->
		  <ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $uid; ?> <b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li><a href="#">Change Password</a></li>
				<li class="divider"></li>
				<li><a href="logout.php">Logout</a></li>
			  </ul>
			</li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
