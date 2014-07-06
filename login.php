<?php
session_start();
include ('assets/scripts/config.php');
if(!isset($_SESSION['FailedLogins'])) {
    $_SESSION['FailedLogins'] = 0;
}
if(@$_SESSION['FailedLogins'] >= 2) {
    echo('<center><div width="80%" class="alert alert-danger">Failed login three times. Contact a Developer to be unblocked.</div></center>');
}

?>
<!DOCTYPE html>
<!-- Bootstrap Template, Created by Shizles -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
    <title>Login</title>

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
	
        <?php
        
        if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['username']) && !empty($_POST['password'])) {
            $connect = mysql_connect($dbhost, $dbuser, $dbpassword);
            $select = mysql_select_db($webdb);
            include ('assets/scripts/config.php');
            
            $username = htmlspecialchars($_POST['username']);
            $password = hash("sha512", stripslashes(trim(htmlspecialchars($_POST['password']))));
           
            $connect = mysql_connect($dbhost, $dbuser, $dbpassword);
            $select = mysql_select_db($webdb);
            if(!$connect && $select) {
                die ('Error connecting to MySQL:' .mysql_error());
            }
            $query = mysql_query("SELECT * FROM `users` WHERE username = '$username' AND password = '$password' AND privilege > 0 AND locked = 0");
            if(!$query) {
                die ('Error querying database:' .mysql_error());
            }
            
            if(mysql_num_rows($query) == 1) {
                $results = mysql_fetch_array($query);
                // Found a match.
                Header('Refresh: 3; url=index.php');
                echo '<center><div width="500" class="alert alert-success">Login Successful... Redirecting</div></center>';
                $_SESSION["UserID"] = $results['uid'];
                $_SESSION["Username"] = $username;
                $_SESSION["Privilege"] = $results['privilege'];
                $_SESSION["FailedLogins"] = 0;
            } else {
                $visitorIP = $_SERVER["REMOTE_ADDR"];
                // No match. Invalid login.
                @$_SESSION['FailedLogins']++;
                $logFailed = mysql_query("INSERT INTO logins (username, ip, status) VALUES ('$username', '$visitorIP', '1');");
                echo "<center><div width='500' class='alert alert-danger'>Login failed. <br> " . $_SESSION['FailedLogins'] . " logins failed.</div></center>";
                }
        }
        ?>
	
	
</head>
  <body>
		<!-- main -->
	<center>
	
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		
		<h1>Metro-Control Panel Login</h1>
		
		<br>
		
		
		<style>
		.panel {
		margin-left: 34%;
		margin-right: 34%;
		}
		</style>
	</center>
		<div class="panel panel-default">
			<div class="panel-body">
			

		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-group">
		  <div class="form-group"> 
			<label>Username</label>
			<input type="text" name="username" class="form-control" placeholder="Username" autofocus>
		  </div>
		  <div class="form-group">
			<label>Password</label>
			<input type="password" name="password" class="form-control" placeholder="Password">
		  </div>
		  <div class="form-group">
			<button <?php if($_SESSION['FailedLogins'] >= 2) { echo "disabled"; } ?> type="submit" class="btn btn-default">Login</button>
		  </div>
		</form>
		
		
			</div>
		</div>
		
		<center>
			<div id="footer">
      <div class="container">
        <?php include('assets/scripts/footer.php'); ?>
      </div>
    </div>
		</center>
		
		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>