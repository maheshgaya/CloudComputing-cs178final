<html>
<head>
<title>Results: primary contact</title>
	<link rel="stylesheet" type="text/css" href="resultpage.css">
</head>
<body>
<?php
/*
* Drake University
* author: Mahesh Gaya
* date: May 4, 2016;
* desc: CS178 final project::pc_form.php
* 
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

	$sql = "SELECT * FROM primary_contact where ";
	$sqlchanged = false;

	if ($pc_id_p !== ''){
		$sql .= "pc_id LIKE '%".$pc_id_p."%' AND ";
		$sqlchanged = true;
	}

	if ($firstname_p !== ''){
		$sql .= "(firstname LIKE '%".$firstname_p."%' OR firstname IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($middlename_p !== ''){
		$sql .= "(middlename LIKE '%".$middlename_p."%' OR middlename IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($lastname_p !== ''){
		$sql .= "(lastname LIKE '%".$lastname_p."%' OR lastname IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($phonenum_p !== ''){
		$sql .= "(phonenum LIKE '%".$phonenum_p."%' OR phonenum IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($email_p !== ''){
		$sql .= "(email LIKE '%".$email_p."%' OR email IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($mailing_address_p !== ''){
		$sql .= "(mailing_address LIKE '%".$mailing_address_p."%' OR mailing_address IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($city_p !== ''){
		$sql .= "(city LIKE '%".$city_p."%' OR city IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($state_p !== ''){
		$sql .= "(state LIKE '%".$state_p."%' OR state IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($zip_p !== ''){
		$sql .= "(zip LIKE '%".$zip_p."%' OR zip IS NULL) AND ";
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
	/* //test: does not work the proper way if done all at once
	$result = mysqli_query($link,"SELECT DISTINCT * from primary_contact 
		where pc_id = '$pc_id_p' OR
		((firstname LIKE '%".$firstname_p."%' OR firstname IS NULL) AND
		(middlename LIKE '%".$middlename_p."%' OR middlename IS NULL) AND
		(lastname LIKE '%".$lastname_p."%' OR lastname IS NULL) AND
		(phonenum LIKE '%".$phonenum_p."%' OR phonenum IS NULL) AND
		(email LIKE '%".$email_p."%' OR email IS NULL) AND
		(mailing_address LIKE '%".$mailing_address_p."%' OR mailing_address IS NULL) AND
		(city LIKE '%".$city_p."%' OR city IS NULL) AND
		(state LIKE '%".$state_p."%' OR state IS NULL) AND
		(zip LIKE '%".$zip_p."%' OR zip IS NULL))");
	*/
//test
//select distinct * from primary_contact where pc_id='' AND firstname LIKE '%a%' AND middlename='' AND lastname='' AND phonenum='' AND email='' AND mailing_address='' AND city='' AND state='' AND zip='';

	echo "<table><tr>
		<th>pc_id</th>
		<th>First Name</th>
		<th>Middle Name</th>
		<th>Last Name</th>
		<th>Phone Number</th>
		<th>Email</th>
		<th>Mailing Address</th>
		<th>City</th>
		<th>State</th>
		<th>Zip</th>
		</tr>";
	while ($row = $result -> fetch_assoc()){
		echo "<tr><td>" . $row["pc_id"] . "</td>
			<td>" . $row["firstname"] . "</td>
			<td>" . $row["middlename"] . "</td>
			<td>" . $row["lastname"] . "</td>
			<td>" . $row["phonenum"] . "</td>
			<td>" . $row["email"] . "</td>
			<td>" . $row["mailing_address"] . "</td>
			<td>" . $row["city"] . "</td>
			<td>" . $row["state"] . "</td>
			<td>" . $row["zip"] . "</td>
			</tr>";
	}
	echo "</table>";


mysqli_close($link);
?>
</body>
</html>
