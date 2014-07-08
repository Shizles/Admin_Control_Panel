<?php
include ('assets/scripts/config.php');
include ('assets/scripts/checkSession.php');



function whitelistPlayer($playerUID) {
    include ('assets/scripts/config.php');
    $visitorIP = $_SERVER["REMOTE_ADDR"];
    $user = $_SESSION['UserID'];
    mysql_connect($dbhost, $dbuser, $dbpassword);
    mysql_select_db($db);
    
    $result = mysql_query("UPDATE players SET coplevel = '2' WHERE playerid = '$playerUID'");
    $getPlayer = mysql_query("SELECT name FROM players WHERE playerid = '$playerUID' LIMIT 1");
    mysql_select_db($webdb);
    $log = mysql_query("INSERT INTO log (user, ip, action, affecteduser) VALUES ('$user', '$visitorIP', '1', '$playerUID');");
    mysql_select_db($db);
    $playerName = mysql_result($getPlayer, 0);
    
    if($result) {
        echo "<p style='color:green; font-weight: bold; top: -300px;'> Player " . $playerName . " has been whitelisted.</p>";
    } else {
        echo "<p style='color:red; font-weight: bold;'> Error occurred while whitelisting player: </p>".mysql_error();
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["SOMEHIDDENVARIABLE"])){
        whitelistPlayer($_POST['SOMEHIDDENVARIABLE']);
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
    <title>Control Panel - Player Management</title>

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
	<br>
	

	
	<!-- Player info -->
	<!-- filter -->
	<!-- panel box -->
	<div class="panel panel-default">
		<div class="panel-body">
			<br>
	  
	<form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	
	<div class="form-group">
		<label class="sr-only" for="exampleInputPassword2">Username</label>
		<input type="Username" class="form-control" name="search" type="text" onfocus="if(this.value==this.defaultValue) this.value='';" placeholder="Username">
	</div>
	
	<button type="submit" value="Search" class="btn btn-default">Search</button>
		  
	  <div class="checkbox">
		<label>
		  <input type="checkbox" name="whitelist" value="1"> Whitelisted?
		</label>
	  </div>
	</form>
	
	
	<!-- filter end -->
	<br>
	<br>
	<!-- results -->
			<div class="table-responsive">
				<?php
                    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
                        mysql_connect($dbhost, $dbuser, $dbpassword);
                        mysql_select_db($db);
                        $search = $_POST['search'];
                        if (empty($_POST['search'])) {
                            echo "You must type a player name";
                         }
                         
                        
                        if(@$_POST['whitelist'] == 1) {
                            $result = mysql_query("SELECT uid, playerid, coplevel, name, bankacc FROM players WHERE name LIKE '%$search%' ORDER BY name ASC");
                        } else {
                           $result = mysql_query("SELECT uid, playerid, coplevel, name, bankacc FROM players WHERE name LIKE '%$search%' AND coplevel = '0' ORDER BY name ASC"); 
                        }
						
						
						if(mysql_num_rows($result) > 0) {
                            $number = mysql_num_rows($result);
                            echo "<p class='counter'>Number of results: $number</p>";
                            echo "<table id='playerTable' class='table table-bordered'>";
                            echo "<thead>";
                            echo "<tr>";
                                echo "<th>PLAYER ID</th>";
                                echo "<th>USERNAME</th>";
                                echo "<th>BANK BALANCE</th>";
                                echo "<th>COP RANK</th>";
								echo "<th>QUICK WHITELIST</th>";
                                echo "<th>LINK</th>";  
                                
                            echo "</tr>";
                            echo "</thead>";
                                echo "<tbody>";   
                                while($row = mysql_fetch_array($result)){
                                    $id = $row["playerid"];
                                    $name = $row["name"];
                                    $aliases = @$row["aliases"];
                                    $money = $row['bankacc'];
                                    $money = number_format($money,0,".",",");
                                    $coplevel = copLevelToRank($row['coplevel']);
                                    @$rowNum++;
                                    echo "<tr>";
                                        echo "<td>$id</td>";
                                        echo "<td>$name</td>";
                                        echo "<td>$$money</td>";
                                        echo "<td>$coplevel</td>";                                      
                                        echo "<td><form action=" . $_SERVER["PHP_SELF"] . " method='post' id='submitForm'><input type='hidden' name='SOMEHIDDENVARIABLE' value='$id' /><button id='btnWhitelist' class='btn btn-link' type='submit'>Whitelist player</button></form></td>";                                      
                                        echo "<td><a class='viewProfile' href='viewPlayer.php?do=view&id=".$row['uid']."'>View Profile</a></td>";
                                        echo "</tr>";
                                }
                                    echo "</tbody>";
                                    echo "</table>";
                        } else {
                                echo 'No results found.';
                        }
                    }
                    //}
                ?>
			</div>
		</div>
	</div>
				
				
				
				 <!-- /#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/ -->
				
	<!-- title line --
			<thead> 
			 <tr>
			  <th>PLAYER ID</th>
			  <th>USERNAME</th> 
			  <th>BANK BALANCE</th>
			  <th>COP RANK</th>
			  <th>LINK</th>
			 </tr>
			</thead>
		<!-- title end --
			 
			 <tr>
			  <td>76561198008923925</td>
			  <td>[MG] Shizles <span class="label label-danger">SWAG</span></td> 
			  <td>$23,770,600</td>
			  <td>Officer</td>
			  <td><a href="#">View Player</a></td>
			 </tr>
			
			 <tr>
			  <td>76561198056418381</td>
			  <td>[MG] Wayward [SM]</td> 
			  <td>$34,223,648</td>
			  <td>Officer</td>
			  <td><a href="#">View Player</a></td>
			 </tr>
			
			 <tr>
			  <td>76561198041799448</td>
			  <td>Otis</td> 
			  <td>$2,646,478</td>
			  <td>Officer</td>
			  <td><a href="#">View Player</a></td>
			 </tr>
	  </table>
	</div>
	</div>
		</div>
	<!-- results end -->
	<!-- Player info end -->
	
				 <!-- /#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/#/ -->

				 
				 
				 
				 
				 
	<?php include ('assets/scripts/footer.php'); ?>
	

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	</center>
  </body>
</html>