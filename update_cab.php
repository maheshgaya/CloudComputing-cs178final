<html>
<head>
<title>Results: update cab</title>
</head>
<body>
<?php
/*
* Drake University
* author: Mahesh Gaya
* date: May 4, 2016;
* desc: CS178 final project::update_cab.php
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


$sql = "UPDATE cab
	SET prog_id = '$prog_id',
	pc_id = '$pc_id',
	sc_id = '$sc_id',
	site_visit = '$site_visit',
	orientation = '$orientation',
	insurance = '$insurance',
	notes = '$notes'
	WHERE cab_id = '$cab_id' ";

if (mysqli_query($link, $sql) AND $cab_id !== '' AND $prog_id !== '' AND $pc_id !== '' AND $sc_id !== ''){
	echo "Record updated successfully";
} else {
	echo "ERROR: Could not update the record. " . mysqli_error($link);
}


mysqli_close($link);
?>
</body>
</html>