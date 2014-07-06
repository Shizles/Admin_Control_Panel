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
</head>
  <body>
  	<?php include ('assets/scripts/navbar.php'); ?>
	
	<!-- main -->
	<center>
			
			
			
			
	<div class="panel panel-default">
		<div class="panel-body">
			<h5>Arma 3 BE Log</h5>
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
						echo "<p>Unable to open the Script Log. It is either unreadable or unavailable</p>";
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