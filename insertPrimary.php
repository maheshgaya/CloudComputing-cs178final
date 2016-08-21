 
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="updatepage.css">
    <title>Add Records Form</title>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="jquery.js"></script>
    <script type='text/javascript' src='jquery.autocomplete.js'></script>
    <link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>


    <nav class="navbar navbar-fixed-top navbar-dark bg-primary">
        <a class="navbar-brand" href="index.html">CAB Admin</a>
        <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="insertRecords.html">Add Program<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="update.html">Update Program</a>
            </li>
        </ul>
        </div>
      </nav>
<?php
/*
Attempt MySQL server connection. Assuming you are running MySQL
server with user 'YOURID#' and password "password" and database named "YOURID#db_gamma"
Jenny Steffens
*/
$link = mysqli_connect("localhost", "root", "root", "drakedb");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}



$first_name = mysqli_real_escape_string($link, $_POST['fname']);
$middle_name= mysqli_real_escape_string($link, $_POST['mname']);
$last_name = mysqli_real_escape_string($link, $_POST['lname']);
$phone_num = mysqli_real_escape_string($link, $_POST['num']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$address = mysqli_real_escape_string($link, $_POST['address']);
$city = mysqli_real_escape_string($link, $_POST['city']);
$state = mysqli_real_escape_string($link, $_POST['state']);
$zip = mysqli_real_escape_string($link, $_POST['zip']);

// attempt insert query execution
$sql = "INSERT INTO primary_contact (firstname, middlename, lastname, phonenum, email, mailing_address, city, state, zip) 
                VALUES ('$first_name', '$middle_name', '$last_name', '$phone_num', '$email', '$address', '$city', '$state', '$zip');";
$sql .= "UPDATE cab SET pc_id = (Select max(pc_id) from primary_contact) WHERE pc_id = 1 and cab_id > 1";

if(mysqli_multi_query($link, $sql)){
        ?>

    <div class="jumbotron">
        <h1>Success!</h1>
        <p>Your organization's program has been added successfully</p>
    </div>

    <p>Adding a secondary contact is optional. If you'd like to do so, continue on to the secondary contact page.</p>
<?php
}
    ?>
<br></br>

    <a class="btn btn-primary btn-lg" href="index.html" role="button">Return to Homepage</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a class="btn btn-primary btn-lg" href="insertSecondary.html" role="button">Add Secondary Contact</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
<a class="btn btn-primary btn-lg" href="insertRecords.html" role="button">Add Another Program</a>
    <br></br>
    <br></br>

    <p>Need help? Email <a href="mailto:drakeservicecab@gmail.com">drakeservicecab@gmail.com</a> if you have any questions about what potential volunteers will see.</p>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
