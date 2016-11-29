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
  <title>Overwatch Database: Maps</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
  
</head>
<body>
<div class='header_bar'>
	<h1>Overwatch Database: Maps</h1>
</div>

<div class='nav_bar'>
	<ul>
		<li><a href='index.html'>Main Menu</a></li>
		<li><a href='1_heroes.php'>Heroes</a></li>
		<li><a href='5_counter_heroes.php'>Counter Heroes</a></li>
		<li><a href='2_players.php'>Players</a></li>
		<li><a href='3_players_heroes.php'>Players' Heroes</a></li>
		<li><a href='4_maps.php' class='active'>Maps</a></li>
		<li><a href='6_animated_shorts.php'>Animated Shorts</a></li>
		<li><a href='7_animated_shorts_heroes.php'>Animated Shorts-Heroes</a></li>
	<ul>
</div>

<div>
	<!--http://overwatch.guide/!-->
	<table class='entity_tbl'>
		<tr>
			<th>Name</th>
			<th>Gametype</th>
			<th>Terrain</th>
		</tr>

<?php
if(!($stmt = $mysqli->prepare("SELECT ow_maps.name, ow_maps.gametype, ow_maps.terrain FROM ow_maps"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name, $gametype, $terrain)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>" . $name . "</td><td>" . $gametype . "</td><td>" . $terrain . "</td></tr>";
}
$stmt->close();
?>

	</table>
</div>

<div>
	<form method="post" action="4_maps_add.php"> 

		<fieldset>
			<legend>Map Details</legend>
			<p>Name: <input type="text" name="Name" /></p>
			<p>Gametype: <select name='Gametype'>
				<option value='Escort'>Escort</option>
				<option value='Assault'>Assault</option>
				<option value='Hybrid'>Hybrid</option>
				<option value='Control'>Control</option>
				<option value='Arena'>Arena</option>
			</select></p>
			<p>Terrain: <input type="text" name="Terrain" /></p>
			<p><input type="submit" value='Add Map'/></p>
		</fieldset>
	</form>
</div>

<div>
	<form method="post" action="4_maps_update.php">
		<fieldset>
			<legend>Map to Update from Table</legend>
				<p><select name="Name">
					
					<?php
					if(!($stmt = $mysqli->prepare("SELECT ow_maps.name FROM ow_maps"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value="'. $name . '"> ' . $name . '</option>\n';
					}
					$stmt->close();
					?>
					
				</select></p>
				<fieldset>
					<legend>Map Details</legend>
					<p>Name: <input type="text" name="NameNew" /></p>
					<p>Gametype: <select name='Gametype'>
						<option value='Escort'>Escort</option>
						<option value='Assault'>Assault</option>
						<option value='Hybrid'>Hybrid</option>
						<option value='Control'>Control</option>
					</select></p>
					<p>Terrain: <input type="text" name="Terrain" /></p>
				</fieldset>
			<p><input type="submit" value='Update Map'/></p>	
		</fieldset>		
	</form>
</div>

<div>
	<form method="post" action="4_maps_delete.php">
		<fieldset>
			<legend>Map to Delete from Table</legend>
				<select name="Name">
					
					<?php
					if(!($stmt = $mysqli->prepare("SELECT ow_maps.name FROM ow_maps"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value="'. $name . '"> ' . $name . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
			<p><input type="submit" value='Delete Map'/></p>
		</fieldset>		
	</form>
</div>

</body>
</html>