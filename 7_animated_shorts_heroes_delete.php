<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","krusej-db","cNVk3SAKmS2mK3ZE","krusej-db");
	if(!$mysqli || $mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
	
	//Delete animated short-hero relationship
	if(!($stmt = $mysqli->prepare("DELETE FROM ow_animated_shorts_heroes WHERE ow_animated_shorts_heroes.asid = ? AND ow_animated_shorts_heroes.hid = ?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	
	if(!($stmt->bind_param("ii",$_POST['Asid'],$_POST['Hid']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Deleted " . $stmt->affected_rows . " animated short-hero relationship from ow_animated_shorts_heroes.";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <meta charset="UTF-8">
  <title>Overwatch Database: Animated Shorts-Heroes (DELETE)</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
</head>

<body>
	<h3><a href='7_animated_shorts_heroes.php'>Back to Animated Shorts-Heroes</a></h3>
</body>

</html>