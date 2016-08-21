
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
 


// Program
$program_name = mysqli_real_escape_string($link, $_POST['programname']);
$relationship = mysqli_real_escape_string($link, $_POST['relationship']);
$issue_area = mysqli_real_escape_string($link, $_POST['issuearea']);
$mission_desc = mysqli_real_escape_string($link, $_POST['mission_desc']);
$site_visit = mysqli_real_escape_string($link, $_POST['sitevisit']);
$orientation = mysqli_real_escape_string($link, $_POST['orientation']);
$insurance = mysqli_real_escape_string($link, $_POST['insurance']);
$notes = mysqli_real_escape_string($link, $_POST['notes']);



//secondary_contact


// attempt insert query execution
$sql = "INSERT INTO programs (program_name, relationship, issue_area, mission_desc) VALUES ('$program_name', '$relationship', '$issue_area', '$mission_desc');";
$sql .= "INSERT INTO cab (prog_id, pc_id, sc_id, site_visit, orientation, insurance, notes) VALUES (1, 1, NULL, '$site_visit', '$orientation', '$insurance', '$notes');";
$sql .= "UPDATE cab SET prog_id= (Select max(prog_id) from programs) WHERE prog_id = 1 and cab_id > 1";
if(mysqli_multi_query($link, $sql)){
  //$lastentryprogID = mysql_query($link, "SELECT max(prog_id) FROM programs");

  //if(!$lastentryprogID){die('Cannot get the progID' . mysql_error();}
    
  //$result = mysql_result($lastentryprogID, 0);

	//echo $result;
 // $addToCab = mysql_query($link, "INSERT INTO cab (prog_id, pc_id, site_visit, orientation, insurance, notes) VALUES ((int)$result, -1, '$site_visit', '$orientation', '$insurance', '$notes')");

    mysqli_close($link);
    echo "Records added successfully. Redirecting...";
    

    ?>
    <script type= "text/javascript">
    window.location = "insertPrimary.html";
    </script>
    <?php
	} 

else{
    echo "ERROR: Could not able to execute $sql. Try again. " . mysqli_error($link);
    mysqli_close($link);
    sleep(5);
    ?>
    <script type= "text/javascript">
    sleep()
    window.location = "https://data.drake.edu/~100181836/insertRecords.html";
    </script>
    <?php
	}
 
// close connection
//mysqli_close($link);
?>
