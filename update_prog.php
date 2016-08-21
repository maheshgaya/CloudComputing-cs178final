<html>
<head>
<title>Results: update program</title>
</head>
<body>
<?php
/*
* Drake University
* author: Mahesh Gaya
* date: May 4, 2016;
* desc: CS178 final project::update_prog.php
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


$sql = "UPDATE programs
	SET relationship = '$relationship_prog',
	program_name = '$name_prog',
	issue_area = '$issue_area_prog',
	mission_desc = '$mission_desc_prog'
	WHERE prog_id = '$prog_id_prog' ";

//checking for required fields and if query was done correctly
if (mysqli_query($link, $sql) AND $prog_id_prog !== ''){
	echo "Record updated successfully";
} else {
	echo "ERROR: Could not update the record. " . mysqli_error($link);
}


mysqli_close($link);
?>
</body>
</html>