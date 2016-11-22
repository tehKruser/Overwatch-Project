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
  <title>Overwatch Database: Players' Heroes</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
  
</head>
<body>
	<div class='header_bar'>
		<h1>Overwatch Database: Players' Heroes</h1>
	</div>


	<div class='nav_bar'>
		<ul>
			<li><a href='index.html'>Main Menu</a></li>
			<li><a href='1_heroes.php'>Heroes</a></li>
			<li><a href='2_players.php'>Players</a></li>
			<li><a href='3_players_heroes.php' class='active'>Players' Heroes</a></li>
			<li><a href='4_maps.php'>Maps</a></li>
			<li><a href='5_hero_maps.php'>Hero Map Locations</a></li>
			<li><a href='6_animated_shorts.php'>Animated Shorts</a></li>
		<ul>
	</div>

	<div class='content_container'>
		<div>
			<!--http://overwatch.guide/!-->
			<table class='entity_tbl'>
				<tr>
					<th>Gamer Tag</th>
					<th>Hero</th>
					<th>Eliminations</th>
					<th>Deaths</th>
					<th>Time Played</th>
				</tr>

		<?php
		if(!($stmt = $mysqli->prepare("SELECT ow_players.name, ow_heroes.name, ow_players_heroes.eliminations, ow_players_heroes.deaths, TIME_FORMAT(ow_players_heroes.playtime, '%H hr %i min') FROM ow_players_heroes INNER JOIN ow_players ON ow_players.id = ow_players_heroes.pid INNER JOIN ow_heroes ON ow_heroes.id = ow_players_heroes.hid"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}

		if(!$stmt->execute()){
			echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!$stmt->bind_result($pname, $hname, $elims, $deaths, $playtime)){
			echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		while($stmt->fetch()){
		 echo "<tr>\n<td>" . $pname . "</td><td>" . $hname . "</td><td>" . $elims . "</td><td>" . $deaths . "</td><td>" . $playtime ."</td></tr>";
		}
		$stmt->close();
		?>

			</table>
		</div>

		<div>
			<form method="post" action="3_players_heroes_add.php"> 

				<fieldset>
					<legend>New Player-Hero Relationship Information</legend>
						<p>Player Name: <select name="Pname">
							
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
						<p>Hero Name: <select name="Hname">
							
							<?php
							if(!($stmt = $mysqli->prepare("SELECT ow_heroes.name FROM ow_heroes"))){
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
						<p>Eliminations: <input type="number" name="Eliminations" value='0' min="0"/></p>
						<p>Deaths: <input type="number" name="Deaths" value='0' min="0"/></p>
						<fieldset>
							<legend>Time Played on Hero</legend>
							<p>Hours: <input type="number" name="Hours" value='0' min="0"/></p>
							<p>Minutes: <input type="number" name="Minutes" value='0' min="0" max="59"/></p>
						</fieldset>
					<p><input type="submit" value='Add Player-Hero Relationship'/></p>
				</fieldset>			
			</form>
		</div>

		<div>
			<form method="post" action="3_players_heroes_update.php">
				<fieldset>
					<legend>Update Player-Hero Relationship Data</legend>
						<p>Player Name: <select name="Pname">
							
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
						<p>Hero Name: <select name="Hname">
							
							<?php
							if(!($stmt = $mysqli->prepare("SELECT ow_heroes.name FROM ow_heroes"))){
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
						<p>Eliminations: <input type="number" name="Eliminations" value='0' min="0"/></p>
						<p>Deaths: <input type="number" name="Deaths" value='0' min="0"/></p>
						<fieldset>
							<legend>Time Played on Hero</legend>
							<p>Hours: <input type="number" name="Hours" value='0' min="0"/></p>
							<p>Minutes: <input type="number" name="Minutes" value='0' min="0" max="59"/></p>
						</fieldset>
						
						<p><input type="submit" value='Update Player-Hero Relationship'/></p>
				</fieldset>
				
				
			</form>
		</div>

		<div>
			<form method="post" action="3_players_heroes_delete.php">
				<fieldset>
					<legend>Delete Player-Hero Relationship from Table</legend>
						<p>Player Name: <select name="Pname">
							
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
						<p>Hero Name: <select name="Hname">
							
							<?php
							if(!($stmt = $mysqli->prepare("SELECT ow_heroes.name FROM ow_heroes"))){
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
						
						<p><input type="submit" value='Delete Player-Hero Relationship'/></p>
				</fieldset>
				
				
			</form>
		</div>
	</div>
</body>
</html>