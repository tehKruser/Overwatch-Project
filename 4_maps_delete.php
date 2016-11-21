<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","krusej-db","cNVk3SAKmS2mK3ZE","krusej-db");
if($_POST['Name'] != ""){
	if(!$mysqli || $mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		
	if(!($stmt = $mysqli->prepare("DELETE FROM ow_maps WHERE ow_maps.name = ?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("s",$_POST['Name']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Deleted " . $stmt->affected_rows . " player from ow_maps.";
	}
}else{
	echo "No map selected for deletion.";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <meta charset="UTF-8">
  <title>Overwatch Database: Maps (DELETE)</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
</head>

<body>
	<h3><a href='4_maps.php'>Back to Maps</a></h3>
</body>

</html>