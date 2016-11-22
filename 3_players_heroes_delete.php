<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","krusej-db","cNVk3SAKmS2mK3ZE","krusej-db");
	if(!$mysqli || $mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
	$pid = "(SELECT ow_players.id FROM ow_players WHERE ow_players.name = '" . $_POST['Pname'] ."')";
	//echo $pid;
	$hid = "(SELECT ow_heroes.id FROM ow_heroes WHERE ow_heroes.name = '" . $_POST['Hname'] . "')";
	//echo $hid;
	
	//Delete player-hero relationship
	if(!($stmt = $mysqli->prepare("DELETE FROM ow_players_heroes WHERE ow_players_heroes.pid = " . $pid . " AND ow_players_heroes.hid = " . $hid))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	/*
	if(!($stmt->bind_param("s",$_POST['Name']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	*/
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Deleted " . $stmt->affected_rows . " player-hero relationship from ow_players_heroes.";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <meta charset="UTF-8">
  <title>Overwatch Database: Players Heroes (DELETE)</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
</head>

<body>
	<h3><a href='3_players_heroes.php'>Back to Players Heroes</a></h3>
</body>

</html>