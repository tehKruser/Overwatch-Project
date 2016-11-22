<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","krusej-db","cNVk3SAKmS2mK3ZE","krusej-db");
	if(!$mysqli || $mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
	
	$duration = "'00:" . $_POST['Minutes'] . ":" . $_POST['Seconds'] . ".0000000'";
	
	if(!($stmt = $mysqli->prepare("UPDATE ow_animated_shorts SET description = ?, location = ?, duration = ". $duration .", release_date = ? WHERE ow_animated_shorts.id = ?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("sisi",$_POST['Description'],$_POST['Location'],$_POST['Release'],$_POST['ID']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Updated " . $stmt->affected_rows . " animated short details in ow_animated_shorts.";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <meta charset="UTF-8">
  <title>Overwatch Database: Animated Shorts (Update)</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
</head>

<body>
	<h3><a href='6_animated_shorts.php'>Back to Animated Shorts</a></h3>
</body>

</html>