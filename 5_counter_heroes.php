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
  <title>Overwatch Database: Hero-Counter Hero</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
  
</head>
<body>
	<div class='header_bar'>
		<h1>Overwatch Database: Hero-Counter Hero</h1>
	</div>


	<div class='nav_bar'>
		<ul>
			<li><a href='index.html'>Main Menu</a></li>
			<li><a href='1_heroes.php'>Heroes</a></li>
			<li><a href='5_counter_heroes.php' class='active'>Counter Heroes</a></li>
			<li><a href='2_players.php'>Players</a></li>
			<li><a href='3_players_heroes.php'>Players' Heroes</a></li>
			<li><a href='4_maps.php'>Maps</a></li>
			<li><a href='6_animated_shorts.php'>Animated Shorts</a></li>
			<li><a href='7_animated_shorts_heroes.php'>Animated Shorts-Heroes</a></li>
		<ul>
	</div>

	<div class='content_container'>
		<div>
			<!--http://overwatch.guide/!-->
			<table class='entity_tbl'>
				<tr>
					<th>Hero</th>
					<th>Counter Hero</th>
				</tr>

		<?php
		
		if(!($stmt = $mysqli->prepare("SELECT h.name, ch.name FROM ow_counter_heroes 
		INNER JOIN ow_heroes as h on h.id = ow_counter_heroes.hid 
		INNER JOIN ow_heroes as ch on ch.id = ow_counter_heroes.chid"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}
		
		if(!$stmt->execute()){
			echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!$stmt->bind_result($hname, $chname)){
			echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		while($stmt->fetch()){
		 echo "<tr>\n<td>" . $hname . "</td><td>" . $chname . "</td></tr>";
		}
		$stmt->close();
		?>

			</table>
		</div>

		<div>
			<form method="post" action="5_counter_heroes_add.php"> 

				<fieldset>
					<legend>New Player-Counter Hero Relationship Information</legend>
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
						<p>Counter Hero Name: <select name="Chid">
							
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
					<p><input type="submit" value='Add Hero-Counter Hero Relationship'/></p>
				</fieldset>			
			</form>
		</div>

		<div>
			<form method="post" action="5_counter_heroes_update.php">
				<fieldset>
					<legend>Update Hero-Counter Hero Relationship Data</legend>
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
						<p>Counter Hero Name: <select name="Chid">
							
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
							<legend>New Counter Hero</legend>
							
							<p>Counter Hero Name: <select name="Nchid">
							
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
						
						<p><input type="submit" value='Update Hero-Counter Hero Relationship'/></p>
				</fieldset>
				
				
			</form>
		</div>

		<div>
			<form method="post" action="5_counter_heroes_delete.php">
				<fieldset>
					<legend>Delete Hero-Counter Hero Relationship from Table</legend>
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
						<p>Counter Hero Name: <select name="Chid">
							
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
						
						<p><input type="submit" value='Delete Hero-Counter Hero Relationship'/></p>
				</fieldset>
				
				
			</form>
		</div>
	</div>
</body>
</html>