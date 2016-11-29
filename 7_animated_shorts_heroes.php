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
  <title>Overwatch Database: Animated Shorts-Heroes</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
  
</head>
<body>
	<div class='header_bar'>
		<h1>Overwatch Database: Animated Shorts-Heroes</h1>
	</div>


	<div class='nav_bar'>
		<ul>
			<li><a href='index.html'>Main Menu</a></li>
			<li><a href='1_heroes.php'>Heroes</a></li>
			<li><a href='5_counter_heroes.php'>Counter Heroes</a></li>
			<li><a href='2_players.php'>Players</a></li>
			<li><a href='3_players_heroes.php'>Players' Heroes</a></li>
			<li><a href='4_maps.php'>Maps</a></li>
			<li><a href='6_animated_shorts.php'>Animated Shorts</a></li>
			<li><a href='7_animated_shorts_heroes.php' class='active'>Animated Shorts-Heroes</a></li>
		<ul>
	</div>

	<div class='content_container'>
		<div>
			<!--http://overwatch.guide/!-->
			<table class='entity_tbl'>
				<tr>
					<th>Animated Short</th>
					<th>Hero</th>
				</tr>

		<?php
		if(!($stmt = $mysqli->prepare("SELECT ow_animated_shorts.title, ow_heroes.name FROM ow_animated_shorts_heroes INNER JOIN ow_animated_shorts ON 
		ow_animated_shorts.id = ow_animated_shorts_heroes.asid INNER JOIN ow_heroes ON ow_heroes.id = ow_animated_shorts_heroes.hid"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}

		if(!$stmt->execute()){
			echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!$stmt->bind_result($asname, $hname)){
			echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		while($stmt->fetch()){
		 echo "<tr>\n<td>" . $asname . "</td><td>" . $hname . "</td></tr>";
		}
		$stmt->close();
		?>

			</table>
		</div>

		<div>
			<form method="post" action="7_animated_shorts_heroes_add.php"> 

				<fieldset>
					<legend>New Animated Short-Hero Relationship Information</legend>
						<p>Animated Short Title: <select name="Asid">
							
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
						<p>Hero Name: <select name="Hid">
							
							<?php
							if(!($stmt = $mysqli->prepare("SELECT ow_heroes.id, ow_heroes.name FROM ow_heroes"))){
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
					<p><input type="submit" value='Add Animated Short-Hero Relationship'/></p>
				</fieldset>			
			</form>
		</div>

		<div>
			<form method="post" action="7_animated_shorts_heroes_update.php">
				<fieldset>
					<legend>Update Animated Short-Hero Relationship Data</legend>
						<p>Animated Short Title: <select name="Asid">
							
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
						<p>Hero Name: <select name="Hid">
							
							<?php
							if(!($stmt = $mysqli->prepare("SELECT ow_heroes.id, ow_heroes.name FROM ow_heroes"))){
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
							<legend>New Hero Name: </legend>
							
								<p>Hero Name: <select name="Nhid">
								
								<?php
								if(!($stmt = $mysqli->prepare("SELECT ow_heroes.id, ow_heroes.name FROM ow_heroes"))){
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
						
						</fieldset>
						
						<p><input type="submit" value='Update Animated Short-Hero Relationship'/></p>
				</fieldset>
				
				
			</form>
		</div>

		<div>
			<form method="post" action="7_animated_shorts_heroes_delete.php">
				<fieldset>
					<legend>Delete Animated Short-Hero Relationship from Table</legend>
						<p>Animated Short Title: <select name="Asid">
							
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
						<p>Hero Name: <select name="Hid">
							
							<?php
							if(!($stmt = $mysqli->prepare("SELECT ow_heroes.id, ow_heroes.name FROM ow_heroes"))){
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
						
						<p><input type="submit" value='Delete Animated Short-Hero Relationship'/></p>
				</fieldset>
				
				
			</form>
		</div>
	</div>
</body>
</html>