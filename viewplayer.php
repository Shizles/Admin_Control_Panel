<?php
session_start();
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
		
	<!-- fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
		<script>
            // Numeric only control handler
            $(document).ready(function() {
                $("#compmoney").keydown(function (e) {
                    // Allow: backspace, delete, tab, escape, enter and .
                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                         // Allow: Ctrl+A
                        (e.keyCode == 65 && e.ctrlKey === true) || 
                         // Allow: home, end, left, right
                        (e.keyCode >= 35 && e.keyCode <= 39)) {
                             // let it happen, don't do anything
                             return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
            });
            function updateRank() {
                // I am using jquery for ajax
                $.post("ajaxUpdate.php", $("#rankform").serialize());
                $('#copRankUpdate').fadeIn().delay(1500).fadeOut(300);
                $('#copRankUpdate').style.display = 'inline';
            }
            function updateDonator() {
                $.post("ajaxUpdate.php", $("#donatorlevelform").serialize());
                $('#donatorLevelUpdate').fadeIn().delay(1500).fadeOut(300);
                //document.getElementById('#donatorLevelUpdate').style.display = 'inline';
                $("#donatorLevelUpdate").css("display", "inline");
            }
            function updateBlacklist() {
                $.post("ajaxUpdate.php", $("#blacklistform").serialize());
                $('#blacklistUpdate').fadeIn().delay(1500).fadeOut(300);
                $("#blacklistUpdate").css("display", "inline");
            }
            function updateRebel() {
                $.post("ajaxUpdate.php", $("#rebelwhitelist").serialize());
                $('#rebelUpdate').fadeIn().delay(1500).fadeOut(300);
                $("#rebelUpdate").css("display", "inline");
            }
            function updateMedic() {
                $.post("ajaxUpdate.php", $("#medicwhitelist").serialize());
                $('#medicUpdate').fadeIn().delay(1500).fadeOut(300);
                $("#medicUpdate").css("display", "inline");
            }
        </script>
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
			 
			<?php
				if($_GET['do'] == "view" && isset($_GET['id'])) {
					$connect = mysql_connect($dbhost, $dbuser, $dbpassword);
					if(!$connect) {
						die ('Connect failed');
					}
					$select = mysql_select_db($db);
					if(!$select) {
						die ('Select failed');
					}
					$id = stripslashes(trim(htmlspecialchars($_GET['id'])));
					
					$getPID = mysql_query("SELECT playerid FROM players WHERE uid = '$id'");
					$pid = mysql_result($getPID, 0);
					$query = mysql_query("SELECT * FROM players WHERE uid = '$id';");
					$fetchVehs = mysql_query("SELECT * FROM vehicles WHERE pid = '$pid' AND alive = '1' ORDER BY side, type");
					if(!$query || !$fetchVehs) {
						die ('Query failed');
					}
					$vehData = mysql_fetch_array($fetchVehs);
					$data = mysql_fetch_array($query);
					$user = $data['name'];
					$id = $data['playerid'];
					$timeEntered = $data['dateRegistered'];
					mysql_select_db($webdb);
					$log = mysql_query("INSERT INTO log (user, ip, action, affecteduser) VALUES ('$uid', '$visitorIP', '4', '$id');"); // Log the view action.
					mysql_select_db($db);
					//var_dump($data); // DEBUG
					//echo '<title>Viewing profile for ' . $user . ' - Metro Gaming Control Panel</title>';		//USING NEW ECHO BELOW
				} else {
					echo '<title>Error</title>';
					echo '<title>Error</title>';
				}
				
				if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['compmoney']) && isset($_POST['pid'])) {
					// Comp button pressed.
					if($_SESSION['Privilege'] >=  1) {
						$c = $_POST['compmoney'];
						$c = preg_replace("/[^0-9,.]/", "", $c);
						if(is_numeric($c)) {
							$pid = $_POST['pid'];
							$fetchMoney = mysql_query("SELECT bankacc FROM players WHERE playerid = '$pid'");
							$currentMoney = mysql_result($fetchMoney, 0);
							//echo $currentMoney;
							$compMoney = $c;
							$newMoney = $currentMoney + $compMoney;
							$addMoneyQuery = mysql_query("UPDATE players SET bankacc = '$newMoney' WHERE playerid = '$pid'");
							// switch db
							mysql_select_db($webdb);
							$staffUID = $_SESSION['UserID'];
							$staffIP = $_SERVER["REMOTE_ADDR"];
							$logAction = mysql_query("INSERT INTO log (user, ip, action, amount, affecteduser) VALUES ('$staffUID', '$staffIP', '3', '$compMoney', '$pid')");
							echo "<br>Player sent  $".$compMoney." compensation.";
						} else {
							echo '<br>You did not enter a valid number.';
						}
					} else {
						echo 'You are not allowed to do this.';
					}
				}
			?>
			
			<h1>Viewing profile of <B><?php echo $user; ?></b></h1>
			<title>Control Panel - Player <?php echo $user; ?></title>
			<!-- filter end -->
			<br>
			<br>
			<!-- results -->
			<div class="table-responsive">
				<table class="table table-bordered" id="playerTable">
			<!-- title line -->
					<thead> 
						<tr>
							<th>OPTION</th>
							<th>VALUE</th> 
						</tr>
					</thead>
			<!-- title end -->
					<tr>
						<td>Aliases</td>
						<td>
							<?php
								//echo $data['aliases'];
								$aliases = $data['aliases'];
								$aliases = str_replace("[", "", $aliases);
								$aliases = str_replace("]", "", $aliases);
								$aliases = str_replace('"', '', $aliases);
								$aliases = str_replace('`', '', $aliases);
								$aliases = str_replace(',', ', ', $aliases);
								echo $aliases;
							?>
						</td> 
					</tr>
					<tr>
						<td>Time Entered</td>
                        <td>
                            <?php 
                                echo date('d/M/Y H:i:s', strtotime($timeEntered));
                            ?>
                            <b>(Server Time)</b>
                        </td>
					</tr>
					<tr>
						<td>Bank Account</td>
						<td>
							<?php echo "$".number_format($data['bankacc'],0,".",","); ?>
						</td> 
					</tr>
					<tr>
						<td>Cash</td>
						<td>
							<?php echo "$".number_format($data['cash'],0,".",","); ?>
						</td>
					</tr>
					<tr>
					
						<td>Cop Rank</td>
						<td>
							<form id="rankform">
							<input type="hidden" value="<?php echo $data['playerid']; ?>" name="pid" />
								<select class="form-control" name="copRank" id="copRank" onchange="updateRank()" <?php if($_SESSION['Privilege'] <= 1) { echo 'disabled'; } // Only allows above mod to change cop rank. ?> >
									<option value="0" <?php if($data['coplevel'] == 0) { echo "selected"; } ?>>Non Whitelisted</option>
							<!-- 	<option value="1" <?php if($data['coplevel'] == 1) { echo "selected"; } ?>>Trainee</option>		-->
									<option value="2" <?php if($data['coplevel'] == 2) { echo "selected"; } ?>>Officer</option>
							<!--   	<option value="3" <?php if($data['coplevel'] == 3) { echo "selected"; } ?>>Detective</option>		-->
									<option value="4" <?php if($data['coplevel'] == 4) { echo "selected"; } ?>>Sergeant</option>
							<!--	<option value="5" <?php if($data['coplevel'] == 5) { echo "selected"; } ?>>Lieutenant</option>		-->
							<!-- 	<option value="6" <?php if($data['coplevel'] == 6) { echo "selected"; } ?>>Captain</option>		-->
								</select>
							</form>
						</td>
						<div style="display: none;" id="copRankUpdate"><font color="GREEN" />Saved</font></div>
					</tr>
					
					<tr>
						<td>Cop Blacklisted</td>
						<td>
							<form id="blacklistform">
							<input name="pid" type="hidden" value="<?php echo $data['playerid']; ?>" />
							<select class="form-control" name="blacklisted" id="blacklisted" onchange="updateBlacklist()" <?php if($_SESSION['Privilege'] <= 1) { echo "disabled"; } if($data['blacklist']) { echo "checked"; } // Only allows above mod to change. ?> >
								<option value="0" <?php if($data['blacklist'] == 0) { echo "selected"; } ?>>Not Blacklisted</option>
								<option value="1" <?php if($data['blacklist'] == 1) { echo "selected"; } ?>>Blacklisted</option>
							</select>
							</form>
							<div style="display: none;" id="blacklistUpdate"><font color="GREEN" />Saved</font></div>
						</td>
					 </tr>
					<tr>
					
						<td>Rebel Whitelist</td>
						<td>
							<form id="rebelwhitelist">
							<input name="pid" type="hidden" value="<?php echo $data['playerid']; ?>" />
							<select class="form-control" name="rebel" id="rebel" onchange="updateRebel()" <?php if($_SESSION['Privilege'] <= 5) { echo "disabled"; } if($data['rebellevel']) { echo "checked"; } // Peivilege is 6 as the rebel whitelisted has been removed. ?> > 
								<option value="0" <?php if($data['rebellevel'] == 0) { echo "selected"; } ?>>Not Whitelisted</option>
								<option value="1" <?php if($data['rebellevel'] == 1) { echo "selected"; } ?>>Whitelisted</option>
							</select>
							</form>
						<div style="display: none;" id="blacklistUpdate"><font color="GREEN" />Saved</font></div>
						</td>
					</tr>
					
					<tr>
						<td>Medic Whitelist</td>
						<td>
							<form id="medicwhitelist">
							<input name="pid" type="hidden" value="<?php echo $data['playerid']; ?>" />
							<select class="form-control" name="medic" id="medic" onchange="updateMedic()" <?php if($_SESSION['Privilege'] <= 0) { echo "disabled"; } if($data['mediclevel']) { echo "checked"; } // Peivilege is 6 as the rebel whitelisted has been removed. ?> > 
								<option value="0" <?php if($data['mediclevel'] == 0) { echo "selected"; } ?>>Not Whitelisted</option>
								<option value="1" <?php if($data['mediclevel'] == 1) { echo "selected"; } ?>>Whitelisted</option>
							</select>
							</form>
						<div style="display: none;" id="medicUpdate"><font color="GREEN" />Saved</font></div>
						</td>
					</tr>
					
					<tr>
						<td>Donator Level</td>
						<td>
							<form id="donatorlevelform">
							<input type="hidden" value="<?php echo $data['playerid']; ?>" name="pid" />
							<select class="form-control" name="donatorLevel" id="donatorLevel" onchange="updateDonator()" <?php if($_SESSION['Privilege'] < 4) { echo 'disabled'; } ?> >
								<option value="0" <?php if($data['donatorlvl'] == 0) { echo "selected"; } ?>>Non Donator</option>
								<option value="1" <?php if($data['donatorlvl'] == 1) { echo "selected"; } ?>>Level 1</option>
								<option value="2" <?php if($data['donatorlvl'] == 2) { echo "selected"; } ?>>Level 2</option>
								<option value="3" <?php if($data['donatorlvl'] == 3) { echo "selected"; } ?>>Level 3</option>
							</select>
							</form>				
							<div style="display: none;" id="donatorLevelUpdate"><font color="GREEN" />Saved</font></div>
						</td>
					</tr>
					
					<tr>
						<td>Compensation Grant</td>
						<td>		
							<form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" >
								<input type="hidden" name="pid" value="<?php echo $data['playerid'];?>"/>
								<div class="input-group">
									<input id="compmoney" name="compmoney" type="text" class="form-control" placeholder="Example: 12500 (12.5k)" <?php if($_SESSION['Privilege'] <= 1) { echo 'disabled'; } ?> />
									<span class="input-group-btn">
									<button type="submit" class="btn btn-default" <?php if($_SESSION['Privilege'] <= 1) { echo 'disabled'; } ?> >Send Compensation</button>
									</span>
								</div>
							</form>						
						</td>
					</tr>
					
				</table>
			  
				<h1>Vehicles</h1>
				<h5><?php echo mysql_num_rows($fetchVehs) . " vehicles found"; ?></h5>
				
				<div style="display: none;" id="deleteUpdate"><font color="GREEN" />Saved</font></div>
			  
			<!-- vehicles -->
				<div class="table-responsive">
					<table class="table table-bordered"  id="playerTable">
				<!-- title line -->
						<thead> 
							<tr>
								<th>FACTION</th>
								<th>VEHICLE TYPE</th> 
								<th>VEHICLE</th>
								<th>STATE</th>
							</tr>
						</thead>
					<!-- title end -->
						<?php
							while($veh = mysql_fetch_array($fetchVehs)) {
								$vehPlate = $veh['plate'];
								$privilege = $_SESSION['Privilege'];
								$disabled = 'disabled';
								//var_dump($veh); // Debug
								echo "<tr>";
									echo "<td>";
									echo $veh['side'];
									echo "</td>";
									
									echo "<td>";
									echo $veh['type'];
									echo "</td>";
									
									echo "<td>";
									echo vehClassToName($veh['classname']);
									echo "</td>";
									
									echo "<td>";
									if($veh['active'] == 1) {
										echo "Active";
									} else {
										echo "Stored";
									}
									echo "</td>";
							}
						?>
					</table>
				</div>
			</div>
			<!-- vehicles end -->
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