<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","krusej-db","cNVk3SAKmS2mK3ZE","krusej-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <meta charset="UTF-8">
  <title>Overwatch Database: Animated Shorts</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
  
</head>
<body>
<div class='header_bar'>
	<h1>Overwatch Database: Animated Shorts</h1>
</div>

<div class='nav_bar'>
	<ul>
		<li><a href='index.html'>Main Menu</a></li>
		<li><a href='1_heroes.php'>Heroes</a></li>
		<li><a href='5_counter_heroes.php'>Counter Heroes</a></li>
		<li><a href='2_players.php'>Players</a></li>
		<li><a href='3_players_heroes.php'>Players' Heroes</a></li>
		<li><a href='4_maps.php'>Maps</a></li>
		<li><a href='6_animated_shorts.php' class='active'>Animated Shorts</a></li>
		<li><a href='7_animated_shorts_heroes.php'>Animated Shorts-Heroes</a></li>
	<ul>
</div>

<div>
	<!--http://overwatch.guide/!-->
	<table class='entity_tbl'>
		<tr>
			<th>Title</th>
			<th>Description</th>
			<th>Location</th>
			<th>Duration</th>
			<th>Release Date</th>
		</tr>

<?php
if(!($stmt = $mysqli->prepare("SELECT ow_animated_shorts.title, ow_animated_shorts.description, ow_maps.name, TIME_FORMAT(ow_animated_shorts.duration, '%i min %s sec'), DATE_FORMAT(ow_animated_shorts.release_date,'%M %d, %Y') FROM ow_animated_shorts INNER JOIN ow_maps ON ow_animated_shorts.location = ow_maps.id ORDER BY ow_animated_shorts.release_date ASC"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($title, $description, $location, $duration, $release)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>" . $title . "</td><td>" . $description . "</td><td>" . $location . "</td><td>" . $duration . "</td><td>" . $release ."</td></tr>";
}
$stmt->close();
?>

	</table>
</div>

<div>
	<form method="post" action="6_animated_shorts_add.php"> 

		<fieldset>
			<legend>New Animated Short Information</legend>
			<p>Title: <input type="text" name="Title" /></p>
			<p>Description: <input type="text" name="Description" style="width:100%"/></p>
			<p><select name="Location">
					
					<?php
					if(!($stmt = $mysqli->prepare("SELECT ow_maps.id, ow_maps.name FROM ow_maps"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value="'. $id . '"> ' . $name . '</option>\n';
					}
					$stmt->close();
					?>
					
			</select></p>
			<fieldset>
				<legend>Duration</legend>
				<p>Minutes: <input type="number" name="Minutes" value='0' min="0" max="59"/></p>
				<p>Seconds: <input type="number" name="Seconds" value='0' min="0" max="59"/></p>
			</fieldset>
			<p>Release Date: <input type="date" name="Release"/></p>
			
			<p><input type="submit" value='Add Animated Short'/></p>
		</fieldset>
	</form>
</div>

<div>
	<form method="post" action="6_animated_shorts_update.php">
		<fieldset>
			<legend>Animated Short to Update from Table</legend>
				<p><select name="ID">
					
					<?php
					if(!($stmt = $mysqli->prepare("SELECT ow_animated_shorts.id, ow_animated_shorts.title FROM ow_animated_shorts"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $title)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value="'. $id . '"> ' . $title . '</option>\n';
					}
					$stmt->close();
					?>
					
				</select></p>
				<p>Description: <input type="text" name="Description" style="width:100%"/></p>
				<p><select name="Location">
					
					<?php
					if(!($stmt = $mysqli->prepare("SELECT ow_maps.id, ow_maps.name FROM ow_maps"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value="'. $id . '"> ' . $name . '</option>\n';
					}
					$stmt->close();
					?>
					
			</select></p>
			<fieldset>
				<legend>Duration</legend>
				<p>Minutes: <input type="number" name="Minutes" value='0' min="0" max="59"/></p>
				<p>Seconds: <input type="number" name="Seconds" value='0' min="0" max="59"/></p>
			</fieldset>
			<p>Release Date: <input type="date" name="Release"/></p>
		<p><input type="submit" value='Update Animated Short'/></p>				
		</fieldset>		
	</form>
</div>

<div>
	<form method="post" action="6_animated_shorts_delete.php">
		<fieldset>
			<legend>Animated Short to Delete from Table</legend>
				<p><select name="ID">
					
					<?php
					if(!($stmt = $mysqli->prepare("SELECT ow_animated_shorts.id, ow_animated_shorts.title FROM ow_animated_shorts"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $title)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value="'. $id . '"> ' . $title . '</option>\n';
					}
					$stmt->close();
					?>
					
				</select></p>
			<p><input type="submit" value='Delete Animated Short'/></p>
		</fieldset>		
	</form>
</div>

</body>
</html>