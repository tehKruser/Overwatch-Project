<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","krusej-db","cNVk3SAKmS2mK3ZE","krusej-db");
if($_POST['Title'] != ""){
	if(!$mysqli || $mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		
	$duration = "'00:" . $_POST['Minutes'] . ":" . $_POST['Seconds'] . ".0000000'";
	
	if(!($stmt = $mysqli->prepare("INSERT INTO ow_animated_shorts(title, description, location, duration, release_date) VALUES (?,?,?," . $duration . ",?)"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("ssis",$_POST['Title'],$_POST['Description'],$_POST['Location'],$_POST['Release']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Added " . $stmt->affected_rows . " new animated short to ow_animated_shorts.";
	}
}else{
	echo "One or more fields were not filled in! Please try again.";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <meta charset="UTF-8">
  <title>Overwatch Database: Animated Shorts (INSERT)</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
</head>

<body>
	<h3><a href='6_animated_shorts.php'>Back to Animated Shorts</a></h3>
</body>

</html>