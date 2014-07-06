<?php
include ('assets/scripts/config.php');
include ('assets/scripts/checkSession.php');

$conn = mysql_connect($dbhost, $dbuser, $dbpassword);
$select = mysql_select_db($db);
$query = mysql_query("SELECT COUNT(*) FROM players WHERE coplevel = '1'");
$trainee = mysql_result($query, 0);

$query2 = mysql_query("SELECT COUNT(*) FROM players WHERE coplevel >= '2'");
$nontrainee = mysql_result($query2, 0);

$query3 = mysql_query("SELECT name, cash+bankacc FROM players ORDER BY cash+bankacc DESC LIMIT 25");

$query4 = mysql_query("SELECT count(*) FROM players");
$total = mysql_result($query4, 0);
?>
<!DOCTYPE html>
<!-- Bootstrap, Metro-Gaming Admin Control Panel Created by Shizles & Zixtyy -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
    <title>Control Panel - Satistics</title>

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
	<!-- Database stats -->
	<div class="panel panel-default">
		<div class="panel-body">
	<h4>Database Info</h4>
        <p>There are a total of <?php echo $total; ?> players in the database.</p>
        <p>There are currently <?php echo $trainee; ?> trainee officers.</p>
        <p>There are currently <?php echo $nontrainee; ?> officers above Constable.</p>

	
	
	</div>
		</div>
	<!-- panel box -->
	<div class="panel panel-default">
	  <div class="panel-body">
	<!-- database stats end -->
	<!-- player count -->
	<h4>Richest 25 Players</h4>
	<table class="table table-condensed">
	<!-- title line -->
			<thead>
			  <tr>
				<th>RANK</th>
				<th>USERNAME</th>
				<th>BANK BALANCE</th>
			  </tr>
			</thead>
	<!-- title line end -->
	<!-- rank list start -->
            <?php
            $begin = 1;
            while($data = mysql_fetch_array($query3)) {
                echo "<tr>";
                    echo "<td>" . $begin . "</td>";
                    echo "<td>" .  $data['name'] . "</td>";
                    echo "<td>$" . number_format($data['cash+bankacc'],0,".",",") . "</td>";
                echo "</tr>";
                $begin++;
            }
            ?>
	</table>
	<!-- rank list end -->
	<!-- player count end -->	
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