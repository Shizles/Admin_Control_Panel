<?php
include ('assets/scripts/config.php');
@session_start();
function copLevelToRank($level) {
    switch($level) {
        case 0:
            return "Non Whitelisted";
            break;
        case 1:
            return "Trainee";
            break;
        case 2:
            return "Officer";
            break;
        case 3:
            return "Detective"; 
            break;
        case 4:
            return "Sergeant"; 
            break;
        case 5:
            return "Lieutenant"; 
            break;
        case 6:
            return "Captain"; 
            break;     
    }
}

function vehClassToName($class) {
    switch($class) {
        case "C_Offroad_01_F":
            return "Offroad";
            break;
        case "B_Truck_01_box_F":
            return "HEMTT Box";
            break;
        case "O_Heli_Light_02_unarmed_F":
            return "PO-30 Orca";
            break;
        case "B_Heli_Light_01_F":
            return "MH-9 Hummingbird";
            break;
        case "B_Truck_01_transport_F":
            return "HEMTT Transport";
            break;
        case "I_Heli_Transport_02_F":
            return "CH-49 Mohawk";
            break;
        case "B_MRAP_01_F":
            return "Hunter";
            break;
        case "C_Hatchback_01_F":
            return "Hatchback";
            break;
        case "C_Hatchback_01_sport_F";
            return "Hatchback Sport";
            break;
        case "B_G_Offroad_01_F":
            return "Offroad";
            break;
        case "C_Boat_Civil_01_police_F":
            return "Police Motorboat";
            break;
        case "B_Heli_Transport_01_F":
            return "UH-80 Ghost Hawk";
            break;
        case "B_Heli_Transport_01_Camo_F":
            return "UH-80 Ghost Hawk - Camo - Armed";
            break;
        case "C_SUV_01_F":
            return "SUV";
            break;
        case "C_Van_01_fuel_F":
            return "Fuel Truck";
            break;
        case "B_Quadbike_01_F":
            return "Quadbike";
            break;
        case "B_SDV_01_F":
            return "SDV";
            break;
        case "C_Boat_Civil_01_F":
            return "Motorboat";
            break;
        case "C_Rubberboat":
            return "Rescue Boat";
            break;
        case "B_Boat_Transport_01_F":
            return "Assault Boat";
            break;
        case "B_Boat_Armed_01_minigun_F":
            return "Speedboat Minigun";
            break;
        case "O_MRAP_02_F":
            return "Ifrit";
            break;
        case "C_Van_01_box_F":
            return "Truck Boxer";
            break;
        case "I_Truck_02_transport_F":
            return "Zamak Transport";
            break;
        case "I_Truck_02_covered_F":
            return "Zamak Transport (Covered)";
            break;
		case "O_Plane_CAS_02_F":
            return "To-199 Neophron";
		// NEW VEHICLES ADDED.. KARTS AND TRUCKS.. 04/07/2014
			break;  
		case "C_Kart_01_Red_F":
            return "Kart (Redstone)";
            break;
		case "C_Kart_01_Blu_F":
            return "Kart (Bluking)";
            break;
		case "C_Kart_01_Fuel_F":
            return "Kart (Fuel)";
            break;
		case "C_Kart_01_Vrana_F":
            return "Kart (Vrana)";
            break;
		case "I_Truck_02_medical_F":
            return "Zamak Medical";
            break;
		case "O_Truck_03_medical_F":
            return "Tempest Medical";
            break;
		case "B_Truck_01_medical_F":
            return "HEMTT Medical";
            break;
		case "O_Truck_03_transport_F":
            return "Tempest";
            break;
        default:
            return $class;
            break;
    }
}


// DUE TO CHANING NAV BAR I LEFT THIS HERE BUT ITS NOW JUST PUT ABOVE THE STATMENT ON PLAYERS.PHP

//function whitelistPlayer($playerUID) {
//    include ('assets/scripts/config.php');
//    $visitorIP = $_SERVER["REMOTE_ADDR"];
//    $user = $_SESSION['UserID'];
//    mysql_connect($dbhost, $dbuser, $dbpassword);
//    mysql_select_db($db);
//    
//    $result = mysql_query("UPDATE players SET coplevel = '1' WHERE playerid = '$playerUID'");
//    $getPlayer = mysql_query("SELECT name FROM players WHERE playerid = '$playerUID' LIMIT 1");
//    mysql_select_db($webdb);
//    $log = mysql_query("INSERT INTO log (user, ip, action, affecteduser) VALUES ('$user', '$visitorIP', '1', '$playerUID');");
//    mysql_select_db($db);
//    $playerName = mysql_result($getPlayer, 0);
//    
//    if($result) {
//        echo "<p style='color:green; font-weight: bold; top: -300px;'> Player " . $playerName . " has been whitelisted.</p>";
//    } else {
//        echo "<p style='color:red; font-weight: bold;'> Error occurred while whitelisting player: </p>".mysql_error();
//    }
//}

function unWhitelistPlayer($playerUID){
            
    mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($db);
    
    $result = mysql_query("UPDATE players SET coplevel = '0' WHERE playerid = $playerUID");
    $getplayer = mysql_query("SELECT name FROM players WHERE playerid = '$playerUID' LIMIT 1");
    $playerName = mysql_result($getPlayer);
    
    if($result) {
        echo "<p style='color:green; font-weight: bold; top: -300px;'> Player " . $playerName . " has been de-Whitelisted.</p>";
    } else {
        echo "<p style='color:red; font-weight: bold;'> Error occurred while de-Whitelisting the player: </p>".mysql_error();
    }
}

function checkInStr($check) {
    if (strpos($_SERVER["PHP_SELF"], $check) !== FALSE) {
    echo 'class="active"';
    }
}

function money($money) {
    return "$".number_format($money,0,".",",");
}