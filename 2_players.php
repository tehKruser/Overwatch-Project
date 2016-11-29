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
  <title>Overwatch Database: Players</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
  
</head>
<body>
<div class='header_bar'>
	<h1>Overwatch Database: Players</h1>
</div>

<div class='nav_bar'>
	<ul>
		<li><a href='index.html'>Main Menu</a></li>
		<li><a href='1_heroes.php'>Heroes</a></li>
		<li><a href='5_counter_heroes.php'>Counter Heroes</a></li>
		<li><a href='2_players.php' class='active'>Players</a></li>
		<li><a href='3_players_heroes.php'>Players' Heroes</a></li>
		<li><a href='4_maps.php'>Maps</a></li>
		<li><a href='6_animated_shorts.php'>Animated Shorts</a></li>
		<li><a href='7_animated_shorts_heroes.php'>Animated Shorts-Heroes</a></li>
	<ul>
</div>

<div>
	<!--http://overwatch.guide/!-->
	<table class='entity_tbl'>
		<tr>
			<th>Gamer Tag</th>
			<th>Wins</th>
			<th>Losses</th>
			<th>Eliminations</th>
			<th>Deaths</th>
		</tr>

<?php
if(!($stmt = $mysqli->prepare("SELECT ow_players.name, ow_players.wins, ow_players.losses, ow_players.eliminations, ow_players.deaths FROM ow_players"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name, $wins, $losses, $eliminations, $deaths)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>" . $name . "</td><td>" . $wins . "</td><td>" . $losses . "</td><td>" . $eliminations . "</td><td>" . $deaths . "</td></tr>";
}
$stmt->close();
?>

	</table>
</div>

<div>
	<form method="post" action="2_players_add.php"> 

		<fieldset>
			<legend>New Player Information</legend>
			<p>Gamer Tag: <input type="text" name="Name" /></p>
			<p>Wins: <input type="number" name="Wins" value='0' min="0"/></p>
			<p>Losses: <input type="number" name="Losses" value='0' min="0"/></p>
			<p>Eliminations: <input type="number" name="Eliminations" value='0' min="0"/></p>
			<p>Deaths: <input type="number" name="Deaths" value='0' min="0"/></p>
			<p><input type="submit" value='Add Player'/></p>
		</fieldset>
	</form>
</div>

<div>
	<form method="post" action="2_players_update.php">
		<fieldset>
			<legend>Player to Update from Table</legend>
				<p><select name="Name">
					
					<?php
					if(!($stmt = $mysqli->prepare("SELECT ow_players.name FROM ow_players"))){
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
					<legend>Player Details</legend>
					<p>Gamer Tag: <input type="text" name="NameNew" /></p>
					<p>Wins: <input type="number" name="Wins" value='0' min="0"/></p>
					<p>Losses: <input type="number" name="Losses" value='0' min="0"/></p>
					<p>Eliminations: <input type="number" name="Eliminations" value='0' min="0"/></p>
					<p>Deaths: <input type="number" name="Deaths" value='0' min="0"/></p>
				</fieldset>
			<p><input type="submit" value='Update Player'/></p>
		</fieldset>		
	</form>
</div>

<div>
	<form method="post" action="2_players_delete.php">
		<fieldset>
			<legend>Hero to Delete from Table</legend>
				<select name="Name">
					
					<?php
					if(!($stmt = $mysqli->prepare("SELECT ow_players.name FROM ow_players"))){
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
			<p><input type="submit" value='Delete Player'/></p>
		</fieldset>		
	</form>
</div>

</body>
</html>