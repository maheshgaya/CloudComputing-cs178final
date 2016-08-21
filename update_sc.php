<html>
<head>
<title>Results: update secondary contact</title>
</head>
<body>
<?php
/*
* Drake University
* author: Mahesh Gaya
* date: May 4, 2016;
* desc: CS178 final project::update_sc.php
*/
$link = mysqli_connect("localhost", "root", "root", "drakedb");

//check connection
if ($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

//print_r($_GET);
//Secondary table
	echo "<h2>Results for Secondary Contact</h2>";
	//secondary contact
	$sc_id_s = mysqli_real_escape_string($link, filter_var($_GET['sc_id_secondary'], FILTER_SANITIZE_STRING));
	$pc_id_s = mysqli_real_escape_string($link, filter_var($_GET['pc_id_secondary'], FILTER_SANITIZE_STRING));
	$firstname_s = mysqli_real_escape_string($link, filter_var($_GET['firstname_secondary'], FILTER_SANITIZE_STRING));
	$middlename_s = mysqli_real_escape_string($link, filter_var($_GET['middlename_secondary'], FILTER_SANITIZE_STRING));
	$lastname_s = mysqli_real_escape_string($link, filter_var($_GET['lastname_secondary'], FILTER_SANITIZE_STRING));
	$phonenum_s = mysqli_real_escape_string($link, filter_var($_GET['phonenum_secondary'], FILTER_SANITIZE_STRING));
	$email_s = mysqli_real_escape_string($link, filter_var($_GET['email_secondary'], FILTER_SANITIZE_STRING));

$sql = "UPDATE secondary_contact
	SET pc_id = '$pc_id_s',
	firstname = '$firstname_s',
	middlename = '$middlename_s',
	lastname = '$lastname_s',
	phonenum = '$phonenum_s',
	email = '$email_s'
	WHERE sc_id = '$sc_id_s'";

if (mysqli_query($link, $sql) AND $sc_id_s !== '' AND $pc_id_s AND $firstname_s !== '' AND $lastname_s !== '' AND $phonenum_s !== ''){
	echo "Record updated successfully";
} else {
	echo "ERROR: Could not update the record. " . mysqli_error($link);
}




mysqli_close($link);
?>
</body>
</html>