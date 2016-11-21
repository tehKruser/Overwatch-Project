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
  <title>Overwatch Database: Heroes</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
  
</head>
<body>
<div class='header_bar'>
	<h1>Overwatch Database: Heroes</h1>
</div>

<div class='nav_bar'>
	<ul>
		<li><a href='index.html'>Main Menu</a></li>
		<li><a href='heroes.php' class='active'>Heroes</a></li>
		<li><a href='players.php'>Players</a></li>
	<ul>
</div>

<div>
	<!--http://overwatch.guide/!-->
	<table class='entity_tbl'>
		<tr>
			<th>Name</th>
			<th>Occupation</th>
			<th>Role</th>
			<th>Skill Difficulty</th>
		</tr>

<?php
if(!($stmt = $mysqli->prepare("SELECT ow_heroes.name, ow_heroes.occupation, ow_heroes.role, ow_heroes.skill FROM ow_heroes"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name, $occupation, $role, $skill)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>" . $name . "</td><td>" . $occupation . "</td><td>" . $role . "</td><td>" . $skill . "</td></tr>";
}
$stmt->close();
?>

	</table>
</div>

<div>
	<form method="post" action="heroes_add.php"> 

		<fieldset>
			<legend>Hero Details</legend>
			<p>Name: <input type="text" name="Name" /></p>
			<p>Occupation: <input type="text" name="Occupation" /></p>
			<p>Role:<select name='Role'>
				<option value='Offense'>Offense</option>
				<option value='Defense'>Defense</option>
				<option value='Tank'>Tank</option>
				<option value='Support'>Support</option>
			</select></p>
			<p>Skill:<select name='Skill'>
				<option value='1'>1</option>
				<option value='2'>2</option>
				<option value='3'>3</option>
			</select></p>
		</fieldset>

		<p><input type="submit" value='Add Hero'/></p>
	</form>
</div>

<div>
	<form method="post" action="heroes_update.php">
		<fieldset>
			<legend>Hero to Update from Table</legend>
				<p><select name="Name">
					
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
				<fieldset>
					<legend>Hero Details</legend>
					<p>Name: <input type="text" name="NameNew" /></p>
					<p>Occupation: <input type="text" name="Occupation" /></p>
					<p>Role: <select name='Role'>
						<option value='Offense'>Offense</option>
						<option value='Defense'>Defense</option>
						<option value='Tank'>Tank</option>
						<option value='Support'>Support</option>
					</select></p>
					<p>Skill: <select name='Skill'>
						<option value='1'>1</option>
						<option value='2'>2</option>
						<option value='3'>3</option>
					</select></p>
				</fieldset>
				
		</fieldset>
		
		<p><input type="submit" value='Update Hero'/></p>
	</form>
</div>

<div>
	<form method="post" action="heroes_delete.php">
		<fieldset>
			<legend>Hero to Delete from Table</legend>
				<select name="Name">
					
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
				</select>
		</fieldset>
		
		<p><input type="submit" value='Delete Hero'/></p>
	</form>
</div>

<!--
<div>
	<form method="post" action="HTMLexample.html">
		<fieldset>
			<legend>Planet Name</legend>
			<p>Planet Name: <input type="text" name="PName" /></p>
		</fieldset>
		<fieldset>
			<legend>Planet Populations</legend>
			<p>Planet Population: <input type="text" name="PPopulation" /></p>
		</fieldset>
		<fieldset>
			<legend>Laguage</legend>
			<p>Official Language: <input type="text" name="PLanguage" /></p>
		</fieldset>
		<input type="submit" name="add" value="Add Planet" />
		<input type="submit" name="update" value="Update Planet" />
	</form>
</div>
!-->

</body>
</html>