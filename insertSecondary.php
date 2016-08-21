<?php
/*
Jenny Steffens

Attempt MySQL server connection. Assuming you are running MySQL
server with user 'YOURID#' and password "password" and database named "YOURID#db_gamma"
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


// attempt insert query execution
$sql = "INSERT INTO secondary_contact (pc_id, firstname, middlename, lastname, phonenum, email) 
		VALUES (1, '$first_name', '$middle_name', '$last_name', '$phone_num', '$email');";
$sql .= "UPDATE secondary_contact SET pc_id = (select max(pc_id) from primary_contact) WHERE pc_id = 1 and sc_id > 1;";
$sql .= "UPDATE cab SET sc_id = (select max(sc_id) from secondary_contact) WHERE sc_id is NULL and pc_id in (select s.pc_id from secondary_contact as s);";
if(mysqli_multi_query($link, $sql)){
	?>
	<html>
    <body>
    	<p>Records added successfully.</p>
    	<!--  <form>
    	 <p>Add information about a secondary contact</p>
    	 <p><input type="button" value="Add Secondary Contact" onclick="redirect2()"></p>
    	</form>  -->
    	
    <script>
    	window.location = "insertEnd.html"
    </script>
    </html>
    
    <?php
	} 

else{
    echo "ERROR: not able to execute $sql. Try again. " . mysqli_error($link);
    sleep(3);
    ?>
    <script type= "text/javascript">
    
    window.location = "insertSecondary.html";
    </script>
    <?php
	}
 
// close connection
mysqli_close($link);
?>
