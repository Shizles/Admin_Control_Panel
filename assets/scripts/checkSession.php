<?php
@session_start();
include('assets/scripts/config.php');
//echo $dbhost . '-' . $dbuser . '-' . $dbpassword . '-' . $db . '-' . $webdb;

$checkLockedConn = mysql_connect($dbhost, $dbuser, $dbpassword);
if(!$checkLockedConn) {
    die ('Error connecting: ' .mysql_error());
}
$checkLockedSelect = mysql_select_db($webdb, $checkLockedConn);
$uid = $_SESSION['UserID'];
$visitorIP = $_SERVER["REMOTE_ADDR"];
$checkLockedQuery = mysql_query("SELECT * FROM users WHERE uid = '$uid';");

if($checkLockedQuery) {
    $checkData = mysql_fetch_array($checkLockedQuery);
} else {
    die ('Error checking information: '.mysql_error());
}


$locked = $checkData['locked'];
$currentRank = $checkData['privilege'];


if($currentRank != $_SESSION['Privilege']) {
    $_SESSION['Privilege'] = $currentRank; // Updates the session stored rank if it has been changed.
}

if($locked == 1) {
    Header('Location: logout.php');
}

if(!isset($_SESSION['Username']) && !isset($_SESSION['Privilege']) && !isset($_SESSION['UserID'])) {
    Header('Location: login.php');
}
?>

