<?php 
include 'assets/scripts/config.php'; 

        if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['code']) && !empty($_POST['username']) && !empty($_POST['password']) && $_POST['password'] == $_POST['confirmpassword']) {
            
            if($_POST['password'] != $_POST['confirmpassword']) {
                die ('Your passwords do not match.');
            }
            if(empty($_POST['username'])) {
                die ('The username field was left empty.');
            }
            if(empty($_POST['code'])) {
                die ('No code was provided.');
            }
            mysql_connect($dbhost, $dbuser, $dbpassword);
            mysql_select_db($webdb);
            $code = $_POST['code'];
            $getPrivilege = mysql_query("SELECT privilege FROM regcodes WHERE code = '$code'");
            
            if(mysql_num_rows($getPrivilege == 0)) {
                die ('Invalid code entered.');
            }
            
            $privilege = mysql_result($getPrivilege, 0);
            if($privilege == 0) {
                die ('Invalid code entered.');
            }
            
            $username = htmlspecialchars($_POST['username']);
            $password = hash("sha512", stripslashes(trim(htmlspecialchars($_POST['password']))));
            
            $query = mysql_query("INSERT INTO users (username, password, privilege, locked) VALUES ('$username', '$password', '$privilege', 0);");
            if($query) {
                Header('Refresh: 3; url=logout.php');
                echo $username . " successfully registered!";
            } else {
                echo 'Query failed:' .mysql_error();
            }
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
		
		<h1>Please register to use the control panel</h1>
		
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
			
		<?php	if($_SERVER["REQUEST_METHOD"] == "GET") {
                echo '
		<form action=' . $_SERVER["PHP_SELF"] . ' method="POST" />
		  <div class="form-group">
			<label for="exampleInputUsername1">Reg Code</label>
			<input type="username" name="code" class="form-control" id="exampleInputUsername1" placeholder="Reg Code">
		  </div>
		  
		  <div class="form-group">
			<label for="exampleInputUsername1">Desired Username</label>
			<input type="username" name="username" class="form-control" id="exampleInputUsername1" placeholder="Username">
		  </div>
		  
		  <div class="form-group">
			<label for="exampleInputPassword1">Desired Password</label>
			<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
		  </div>
		  
		  <div class="form-group">
			<label for="exampleInputPassword1">Confirm Password</label>
			<input type="password" name="confirmpassword" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
		  </div>
		  
		  <div class="form-group">
		  <input type="submit" value="Register" />
		  </div>
		</form>';
			}
		?>
		
		
			</div>
		</div>

		
		<center>
	<div id="footer">
      <div class="container">
        <p class="text-muted">&copy Metro Gaming control panel by Shizles & Zixtyy 2014</p>
      </div>
    </div>
		</center>
		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>