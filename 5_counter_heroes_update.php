<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","krusej-db","cNVk3SAKmS2mK3ZE","krusej-db");
	if(!$mysqli || $mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	//Update row
	if(!($stmt = $mysqli->prepare("UPDATE ow_counter_heroes SET chid = ? WHERE ow_counter_heroes.hid = ? AND 
	ow_counter_heroes.chid = ?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	
	if(!($stmt->bind_param("iii",$_POST['Nchid'],$_POST['Hid'],$_POST['Chid']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Updated " . $stmt->affected_rows . " Hero-Counter Hero relationship in ow_counter_heroes.";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <meta charset="UTF-8">
  <title>Overwatch Database: Heroes-Counter Heroes (Update)</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
</head>

<body>
	<h3><a href='5_counter_heroes.php'>Back to Heroes-Counter Heroes</a></h3>
</body>

</html>