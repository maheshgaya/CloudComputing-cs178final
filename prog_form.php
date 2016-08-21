<html>
<head>
<title>Results: program</title>
	<link rel="stylesheet" type="text/css" href="resultpage.css">
</head>
<body>
<?php
/*
* Drake University
* author: Mahesh Gaya
* date: May 4, 2016;
* desc: CS178 final project::prog_form.php
* 
*/
$link = mysqli_connect("localhost", "root", "root", "drakedb");

//check connection
if ($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

//print_r($_GET);
	echo "<h2>Results for Program</h2>";
	//program
	$prog_id_prog = mysqli_real_escape_string($link, filter_var($_GET['prog_id_program'], FILTER_SANITIZE_STRING));
	$relationship_prog = mysqli_real_escape_string($link, filter_var($_GET['relationship_program'], FILTER_SANITIZE_STRING));
	$name_prog = mysqli_real_escape_string($link, filter_var($_GET['name_program'], FILTER_SANITIZE_STRING));
	$issue_area_prog = mysqli_real_escape_string($link, filter_var($_GET['issue_area_program'], FILTER_SANITIZE_STRING));
	$mission_desc_prog = mysqli_real_escape_string($link, filter_var($_GET['mission_desc_program'], FILTER_SANITIZE_STRING));

	$sql = "SELECT * FROM programs where ";
	$sqlchanged = false;

	if ($prog_id_prog !== ''){
		$sql .= "prog_id LIKE '%".$prog_id_prog."%' AND ";
		$sqlchanged = true;
	}

	if ($relationship_prog !== ''){
		$sql .= "(relationship LIKE '%".$relationship_prog."%' OR relationship IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($name_prog !== ''){
		$sql .= "(program_name LIKE '%".$name_prog."%' OR program_name IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($issue_area_prog !== ''){
		$sql .= "(issue_area LIKE '%".$issue_area_prog."%' OR issue_area IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($mission_desc_prog !== ''){
		$sql .= "(mission_desc LIKE '%".$mission_desc_prog."%'	OR mission_desc IS NULL) AND ";
		$sqlchanged = true;
	}


	//trimmed last "AND" or "where"
	if ($sqlchanged){
		$sqltrimmed = chop($sql, "AND ");
	} else {
		$sqltrimmed = chop($sql, "where ");
	}

	//output sqltrimmed
	//echo $sqltrimmed;

	$result = mysqli_query($link, $sqltrimmed);

/*
	$result = mysqli_query($link,"SELECT DISTINCT * from programs 
		where prog_id = '$prog_id_prog' OR
		((relationship LIKE '%".$relationship_prog."%' OR relationship IS NULL) AND
		(program_name = '%".$name_prog."%' OR program_name IS NULL) AND
		(issue_area = '%".$issue_area_prog."%' OR issue_area IS NULL) AND
		(mission_desc = '%".$mission_desc_prog."%'	OR mission_desc IS NULL))");
*/
	echo "<table><tr>
		<th>prod_id</th>
		<th>Relation</th>
		<th>Program Name</th>
		<th>Issue Area</th>
		<th>Mission Description</th>
		</tr>";
	while ($row = $result -> fetch_assoc()){
		echo "<tr><td>" . $row["prog_id"] . "</td>
			<td>" . $row["relationship"] . "</td>
			<td>" . $row["program_name"] . "</td>
			<td>" . $row["issue_area"] . "</td>
			<td>" . $row["mission_desc"] . "</td>
			</tr>";
	}
	echo "</table>";


mysqli_close($link);
?>
</body>
</html>