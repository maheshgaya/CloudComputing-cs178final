<html>
<head>
<title>Results: secondary contact</title>
	<link rel="stylesheet" type="text/css" href="resultpage.css">
</head>
<body>
<?php
/*
* Drake University
* author: Mahesh Gaya
* date: May 4, 2016;
* desc: CS178 final project::sc_form.php
* 
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


	$sql = "SELECT * FROM secondary_contact where ";
	$sqlchanged = false;

	if ($sc_id_s !== ''){
		$sql .= "sc_id LIKE '%".$sc_id_s."%' AND ";
		$sqlchanged = true;
	}

	if ($pc_id_s !== ''){
		$sql .= "pc_id LIKE '%".$pc_id_s."%' AND ";
		$sqlchanged = true;
	}

	if ($firstname_s !== ''){
		$sql .= "(firstname LIKE '%".$firstname_s."%' OR firstname IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($middlename_s !== ''){
		$sql .= "(middlename LIKE '%".$middlename_s."%' OR middlename IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($lastname_s !== ''){
		$sql .= "(lastname LIKE '%".$lastname_s."%' OR lastname IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($phonenum_s !== ''){
		$sql .= "(phonenum LIKE '%".$phonenum_s."%' OR phonenum IS NULL) AND ";
		$sqlchanged = true;
	}

	if ($email_s !== ''){
		$sql .= "(email LIKE '%".$email_s."%' OR email IS NULL) AND ";
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
	$result = mysqli_query($link, "SELECT DISTINCT * FROM secondary_contact WHERE 
		(sc_id = '$sc_id_s' OR
		pc_id = '$pc_id_s') OR
		((firstname LIKE '%".$firstname_s."%' OR firstname IS NULL) AND
		(middlename = '%".$middlename_s."%' OR middlename IS NULL) AND
		(lastname = '%".$lastname_s."%' OR lastname IS NULL) AND
		(phonenum = '%".$phonenum_s."%' OR phonenum IS NULL) AND
		(email = '%".$email_s."%' OR email IS NULL))");
*/
	echo "<table><tr>
		<th>sc_id</th>
		<th>pc_id</th>
		<th>First Name</th>
		<th>Middle Name</th>
		<th>Last Name</th>
		<th>Phone Number</th>
		<th>Email</th>
		</tr>";
	while ($row = $result -> fetch_assoc()){
		echo "<tr><td>" . $row["sc_id"] . "</td>
			<td>" . $row["pc_id"] . "</td>
			<td>" . $row["firstname"] . "</td>
			<td>" . $row["middlename"] . "</td>
			<td>" . $row["lastname"] . "</td>
			<td>" . $row["phonenum"] . "</td>
			<td>" . $row["email"] . "</td>
			</tr>";
	}
	echo "</table>";


mysqli_close($link);
?>
</body>
</html>