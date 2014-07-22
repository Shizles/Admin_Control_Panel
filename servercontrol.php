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
    <title>Control Panel - Server Control</title>

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
 <script>
	function play(){
		 var audio = document.getElementById("audio");
		 audio.play();
	}
</script>

	
	</head>
  <body>
	<script>
		var warning = true;
		window.onbeforeunload = function() {  
		  if (warning) {  
			return "WHY U HEF TO LEAVE? U KILL DEH SERVER DEN LEAVE?! U MAKE US CYI EVRY TYIME... >.<";  
			}  
		}

		$('form').submit(function() {
		   window.onbeforeunload = null;
		});
	</script>
  	<?php include ('assets/scripts/navbar.php'); ?>
	
	<!-- main -->
	<center>
			
			
			
			
	<div class="panel panel-default">
		<div class="panel-body">
			<h5>Current Server Status:<br>
			Altis Life
			<?php
			 
			function getStatus($ip,$port){
			   $socket = @fsockopen($ip, $port, $errorNo, $errorStr, 3);
			   if(!$socket) return "<font color='RED' />Offline</font>";
				 else return "<font color='GEREN' />Online</font>";
			}
			 
			echo getStatus("127.0.0.1", "2302");
			?>
			</h5>
						
		<br>
		
		<!-- Start the server if it is not online -->
		<button type="button" class="btn btn-success" <?php if($_SESSION['Privilege'] <= 4) { echo 'disabled'; } ?> >Start</button>

		<!-- Announced save and restart -->
		<button type="button" class="btn btn-info" <?php if($_SESSION['Privilege'] <= 4) { echo 'disabled'; } ?> >Restart</button>

		<!-- Stops the server after a pause -->
		<button type="button" class="btn btn-warning" <?php if($_SESSION['Privilege'] <= 4) { echo 'disabled'; } ?> >Stop</button>

		<!-- KILLS THE SERVER AWMMGGG!!! -->
		<button type="button" class="btn btn-danger" onclick="play()" <?php if($_SESSION['Privilege'] <= 0) { echo 'disabled'; } ?> >Kill Task</button>
		<audio id="audio" src="http://217.23.2.242/control/assets/sounds/taskkill.mp3" ></audio>
		
		<br>
		<br>
		
			<?php
				$file = "C:\Program Files (x86)\Steam\SteamApps\common\Arma 3\TADST\Life\BattlEye\scripts.log";
				if (file_exists($file) && is_readable($file)){
					$read = fopen($file, "r");
					while(!feof($read))
					{
					echo fgets($read)."<br>";
					}
					fclose($read);
				}
				else{
					echo "<p height='550px' overflow='scroll'>Unable to open the Script Log. It is either unreadable or unavailable</p>";
				}
			?>
			
	</div>
		</div>
	
	
	<?php include ('assets/scripts/footer.php'); ?>
	

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	</center>
  </body>
</html>