<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">    
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="resultpage.css">
	<title>Volunteer Opportunities - Drake University</title>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="jquery.js"></script>
	<script type='text/javascript' src='jquery.autocomplete.js'></script>
	<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php
// Author: Alexis Kulash
// Purpose: Query db to produce search results from user input
// DB login details
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "drakedb";

// Create DB connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_errno) {
   die("Connection to database failed. Error: " . $conn->connect_error);
}

// Get user input from form & use escape_string to avoid security issues
$general= mysqli_real_escape_string($conn, $_GET['general']);
$issue = mysqli_real_escape_string($conn, $_GET['issue']);

if (empty($general)){
    if (empty($issue)) {
        // User did not enter any filters
        $toquery = "SELECT distinct cab_id, program_name, issue_area, mission_desc, 
        primary_contact.firstname as pfname, primary_contact.lastname as plname, primary_contact.email as pemail, primary_contact.phonenum as pnum,
        secondary_contact.firstname as sfname, secondary_contact.lastname as slname, secondary_contact.email as semail, secondary_contact.phonenum as snum
        FROM programs JOIN cab ON programs.prog_id = cab.prog_id LEFT JOIN primary_contact ON cab.pc_id = primary_contact.pc_id
        LEFT JOIN secondary_contact ON cab.sc_id = secondary_contact.sc_id";
       // $result = $conn->query($toquery);
    }
    else {
        // User is only filtering for an issue
        $toquery = "SELECT distinct cab_id, program_name, issue_area, mission_desc, 
        primary_contact.firstname as pfname, primary_contact.lastname as plname, primary_contact.email as pemail, primary_contact.phonenum as pnum, secondary_contact.firstname as sfname, secondary_contact.lastname as slname, secondary_contact.email as semail, secondary_contact.phonenum as snum
        FROM programs JOIN cab ON programs.prog_id = cab.prog_id LEFT JOIN primary_contact ON cab.pc_id = primary_contact.pc_id
        LEFT JOIN secondary_contact ON cab.sc_id = secondary_contact.sc_id WHERE issue_area LIKE '%{$issue}%'";
        //$result = $conn->query($toquery);
    }
}

else {
    if (empty($issue)) {
        // User is only filtering for search terms
        $toquery = "SELECT distinct cab_id, program_name, issue_area, mission_desc, 
            primary_contact.firstname as pfname, primary_contact.lastname as plname, primary_contact.email as pemail, primary_contact.phonenum as pnum,
            secondary_contact.firstname as sfname, secondary_contact.lastname as slname, secondary_contact.email as semail, secondary_contact.phonenum as snum 
 			FROM programs JOIN cab ON programs.prog_id = cab.prog_id LEFT JOIN primary_contact ON cab.pc_id = primary_contact.pc_id
            LEFT JOIN secondary_contact ON cab.sc_id = secondary_contact.sc_id WHERE program_name LIKE '%{$general}%' OR issue_area LIKE '%{$general}%' OR mission_desc 
            LIKE '%{$general}%'";
       // $result = $conn->query($toquery);
    }
    else {
        // User is filtering for both search terms & an issue
        $toquery = "SELECT distinct cab_id, program_name, issue_area, mission_desc, 
            primary_contact.firstname as pfname, primary_contact.lastname as plname, primary_contact.email as pemail, primary_contact.phonenum as pnum, secondary_contact.firstname as sfname, secondary_contact.lastname as slname, secondary_contact.email as semail, secondary_contact.phonenum as snum
            FROM programs JOIN cab ON programs.prog_id = cab.prog_id LEFT JOIN primary_contact ON cab.pc_id = primary_contact.pc_id
            LEFT JOIN secondary_contact ON cab.sc_id = secondary_contact.sc_id WHERE (program_name LIKE '%{$general}%' OR issue_area LIKE '%{$general}%' OR mission_desc 
            LIKE '%{$general}%') AND issue_area LIKE '%{$issue}%'";
       //$result = $conn->query($toquery);
    }
}

// Print tables of results
if ($result = $conn->query($toquery))
    {
    echo "<table><tr><th>ID</th><th>Program</th><th>Category</th><th>Description</th><th>Primary Contact</th><th>Email</th><th>Phone Number</th><th>Secondary Contact</th><th>Email</th><th>Phone Number</th></tr>";
    while($row = $result->fetch_array()) {
	echo "<tr><td>" . $row['cab_id'] . "</td><td>" . $row['program_name'] . "</td><td>" . $row['issue_area'] . "</td><td>" . $row['mission_desc'] .
        "</td><td>" . $row['pfname'] . " " . $row['plname'] . "</td><td>" . $row['pemail'] . "</td><td>" . $row['pnum'] .
        "</td><td>" . $row['sfname'] . " " . $row['slname'] . $row['semail'] . $row['snum'] . "</td></tr>";
    }
    echo "</table>";
    $result->free();
    }
else {
    echo "0 programs were found matching your search criteria.";
     }

// Close DB connection

$conn->close();
?>
</body>
</html>

