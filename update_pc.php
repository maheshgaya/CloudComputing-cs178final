<html>
<head>
<title>Results: update primary contact</title>
</head>
<body>
<?php
/*
* Drake University
* author: Mahesh Gaya
* date: May 4, 2016;
* desc: CS178 final project::update_pc.php
*/
$link = mysqli_connect("localhost", "root", "root", "drakedb");

//check connection
if ($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

//Primary table
//print_r($_GET);
	echo "<h2>Results for Primary Contact</h2>";
	//primary contact
	$pc_id_p = mysqli_real_escape_string($link, filter_var($_GET['pc_id_primary'], FILTER_SANITIZE_STRING));
	$firstname_p = mysqli_real_escape_string($link, filter_var($_GET['firstname_primary'], FILTER_SANITIZE_STRING));
	$middlename_p = mysqli_real_escape_string($link, filter_var($_GET['secondary_primary'], FILTER_SANITIZE_STRING));
	$lastname_p = mysqli_real_escape_string($link, filter_var($_GET['lastname_primary'], FILTER_SANITIZE_STRING));
	$phonenum_p = mysqli_real_escape_string($link, filter_var($_GET['phonenum_primary'], FILTER_SANITIZE_STRING));
	$email_p = mysqli_real_escape_string($link, filter_var($_GET['email_primary'], FILTER_SANITIZE_STRING));
	$mailing_address_p = mysqli_real_escape_string($link, filter_var($_GET['mailing_address_primary'], FILTER_SANITIZE_STRING));
	$city_p = mysqli_real_escape_string($link, filter_var($_GET['city_primary'], FILTER_SANITIZE_STRING));
	$state_p = mysqli_real_escape_string($link,filter_var($_GET['state_primary'], FILTER_SANITIZE_STRING));
	$zip_p = mysqli_real_escape_string($link,filter_var($_GET['zip_primary'],FILTER_SANITIZE_STRING));


$sql = "UPDATE primary_contact
	SET firstname = '$firstname_p',
	middlename = '$middlename_p',
	lastname = '$lastname_p',
	phonenum = '$phonenum_p',
	email = '$email_p',
	mailing_address = '$mailing_address_p',
	city = '$city_p',
	state = '$state_p',
	zip = '$zip_p'
	WHERE pc_id = '$pc_id_p'";

if (mysqli_query($link, $sql) AND $pc_id !== '' AND $firstname_p !== '' AND $lastname_p !== '' AND $phonenum_p !== ''){
	echo "Record updated successfully";
} else {
	echo "ERROR: Could not update the record. " . mysqli_error($link);
}

mysqli_close($link);
?>
</body>
</html>