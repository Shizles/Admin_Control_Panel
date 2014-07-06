<?php
include ('assets/scripts/config.php');
include ('assets/scripts/checkSession.php');
mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($db);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['copRank']) && isset($_POST['pid'])) {
        $pid = mysql_real_escape_string($_POST['pid']);
        $copRank = mysql_real_escape_string($_POST['copRank']);
        $query = mysql_query("UPDATE players SET coplevel = '".$copRank."' WHERE playerid = '".$pid."';");
        mysql_select_db($webdb);
        $log = mysql_query("INSERT INTO log (user, ip, action, affecteduser) VALUES ('$uid', '$visitorIP', '2', '$pid');");
        mysql_select_db($db);
    }
    
    if(isset($_POST['donatorLevel']) && isset($_POST['pid'])) {
        $pid = mysql_real_escape_string($_POST['pid']);
        $donatorRank = mysql_real_escape_string($_POST['donatorLevel']);
        $query = mysql_query("UPDATE players SET donatorlvl = '".$donatorRank."' WHERE playerid = '".$pid."';");
		if($query) { echo mysql_error(); }
        mysql_select_db($webdb);
        $log = mysql_query("INSERT INTO log (user, ip, action, affecteduser) VALUES ('$uid', '$visitorIP', '5', '$pid');");
        mysql_select_db($db);
    }
    
    if(isset($_POST['blacklisted']) && isset($_POST['pid'])) {
        $pid = mysql_real_escape_string($_POST['pid']);
        $blacklisted = mysql_real_escape_string($_POST['blacklisted']);
        $query = mysql_query("UPDATE players SET blacklist = '$blacklisted' WHERE playerid = '".$pid."';");
        mysql_select_db($webdb);
        $log = mysql_query("INSERT INTO log (user, ip, action, affecteduser) VALUES ('$uid', '$visitorIP', '6', '$pid');");
        mysql_select_db($db);
    }
    if(isset($_POST['rebel']) && isset($_POST['pid'])) {
        $pid = mysql_real_escape_string($_POST['pid']);
        $rebel = mysql_real_escape_string($_POST['rebel']);
        $query = mysql_query("UPDATE players SET rebellevel = '$rebel' WHERE playerid = '".$pid."';");
        mysql_select_db($webdb);
        $log = mysql_query("INSERT INTO log (user, ip, action, affecteduser) VALUES ('$uid', '$visitorIP', '7', '$pid');");
        mysql_select_db($db);
    }
    if(isset($_POST['medic']) && isset($_POST['pid'])) {
        $pid = mysql_real_escape_string($_POST['pid']);
        $medic  = mysql_real_escape_string($_POST['medic']);
        $query = mysql_query("UPDATE players SET mediclevel = '$medic' WHERE playerid = '".$pid."';");
        mysql_select_db($webdb);
        $log = mysql_query("INSERT INTO log (user, ip, action, affecteduser) VALUES ('$uid', '$visitorIP', '8', '$pid');");
        mysql_select_db($db);
    }
}

?>

