<html>
<head>
<title>Results: cab</title>
	<link rel="stylesheet" type="text/css" href="resultpage.css">
</head>
<body>
<?php
/*
* Drake University
* author: Mahesh Gaya
* date: May 4, 2016;
* desc: CS178 final project::cab_form.php
* 
*/
$link = mysqli_connect("localhost", "root", "root", "drakedb");

//check connection
if ($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

//print_r($_GET);
	echo "<h2>Results for Other Information</h2>";
	//cab
	$cab_id = mysqli_real_escape_string($link, filter_var($_GET['cab_id_cab'], FILTER_SANITIZE_STRING));
	$prog_id = mysqli_real_escape_string($link, filter_var($_GET['prog_id_cab'], FILTER_SANITIZE_STRING));
	$pc_id = mysqli_real_escape_string($link, filter_var($_GET['pc_id_cab'], FILTER_SANITIZE_STRING));
	$sc_id = mysqli_real_escape_string($link, filter_var($_GET['sc_id_cab'], FILTER_SANITIZE_STRING));
	$site_visit = mysqli_real_escape_string($link, filter_var($_GET['site_visit_cab'], FILTER_SANITIZE_STRING));
	$orientation = mysqli_real_escape_string($link, filter_var($_GET['orientation_cab'], FILTER_SANITIZE_STRING));
	$insurance = mysqli_real_escape_string($link, filter_var($_GET['insurance_cab'], FILTER_SANITIZE_STRING));
	$notes = mysqli_real_escape_string($link, filter_var($_GET['notes_cab'], FILTER_SANITIZE_STRING));

	$sql = "SELECT * FROM cab where ";
	$sqlchanged = false;

	if ($cab_id !== ''){
		$sql .= "cab_id LIKE '%".$cab_id."%' AND ";
		$sqlchanged = true;
	}

	if ($prog_id !== ''){
		$sql .= "prog_id LIKE '%".$prog_id."%' AND ";
		$sqlchanged = true;
	}

	if ($pc_id !== ''){
		$sql .= "pc_id LIKE '%".$pc_id."%' AND ";
		$sqlchanged = true;
	}

	if ($sc_id !== ''){
		$sql .= "sc_id LIKE '%".$sc_id."%' AND ";
		$sqlchanged = true;
	}

	if ($site_visit !== ''){
		$sql .= "(site_visit LIKE '%".$site_visit."%' OR site_visit IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($orientation !== ''){
		$sql .= "(orientation LIKE '%".$orientation."%' OR orientation IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($insurance !== ''){
		$sql .= "(insurance LIKE '%".$insurance."%' OR insurance IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($notes !== ''){
		$sql .= "(notes LIKE '%".$notes."%' OR notes IS NULL) AND ";
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
	$result = mysqli_query($link,"SELECT DISTINCT * from cab 
		where (cab_id = '$cab_id' OR
		prog_id '$prog_id' OR
		pc_id '$pc_id' OR
		sc_id '$sc_id') OR
		((site_visit LIKE '%".$site_visit."%' OR site_visit IS NULL) AND
		(orientation = '%".$orientation."%' OR orientation IS NULL) AND
		(insurance = '%".$insurance."%' OR insurance IS NULL) AND
		(notes = '%".$notes."%' OR notes IS NULL))");
*/
	echo "<table><tr>
		<th>cab_id</th>
		<th>prog_id</th>
		<th>pc_id</th>
		<th>sc_id</th>
		<th>Site Visit</th>
		<th>Orientation</th>
		<th>Insurance</th>
		<th>Notes</th>
		</tr>";
	while ($row = $result -> fetch_assoc()){
		echo "<tr><td>" . $row["cab_id"] . "</td>
			<td>" . $row["prog_id"] . "</td>
			<td>" . $row["pc_id"] . "</td>
			<td>" . $row["sc_id"] . "</td>
			<td>" . $row["site_visit"] . "</td>
			<td>" . $row["orientation"] . "</td>
			<td>" . $row["insurance"] . "</td>
			<td>" . $row["notes"] . "</td>
			</tr>";
	}
	echo "</table>";


mysqli_close($link);
?>
</body>
</html>