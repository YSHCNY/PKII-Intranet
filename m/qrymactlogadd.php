<?php

require '../includes/dbh.php';

// Sanitize input variables
$actdetails = mysqli_real_escape_string($dbh, $actdetails);
$actdate = mysqli_real_escape_string($dbh, $actdate);
$endactdate = mysqli_real_escape_string($dbh, $endactdate);
$employeeid = mysqli_real_escape_string($dbh, $employeeid);
$timeend = mysqli_real_escape_string($dbh, $timeend);
$timestart = mysqli_real_escape_string($dbh, $timestart);
$projcode = mysqli_real_escape_string($dbh, $projcode);
$idlogin = (int)$idlogin;

if ($timestart == ""){
    $timestart='0000-00-00 00:00:00';
}


if ($timeend == ""){
    $timeend='0000-00-00 00:00:00';
}


$current_date = $actdate;

while (strtotime($current_date) <= strtotime($endactdate)) {
	$checked = 0;
	$checkid = '';

    if (empty($projcode)) {
        $projcode_value = '';
    } else {
        // Fetch project details
        $proj_query = "SELECT proj_code, proj_name FROM tblprojassign WHERE proj_code = '$projcode' AND employeeid = '$employeeid' LIMIT 1";
        $proj_result = $dbh->query($proj_query);

        if ($proj_result->num_rows > 0) {
            $proj_data = $proj_result->fetch_assoc();
            $projcode_value = "{$proj_data['proj_code']} - {$proj_data['proj_name']},";
        } else {
            $projcode_value = "$projcode,";
        }
    }

    // Check if the record already exists
    $checker_query = "SELECT employeeid FROM tblhractlog WHERE date='$current_date' AND employeeid='$employeeid' LIMIT 1";
    $checker_result = $dbh->query($checker_query);
	if($checker_result->num_rows>0){
		while($rows = $checker_result->fetch_assoc()){
			$checked = 1;
			$checkid = $rows['employeeid'];
		}
	};
	

    if ($checked == 1 && $checkid != '') {
        // Record exists, update it
        $update_query = "UPDATE tblhractlog 
                         SET activity = CONCAT(activity, '\n', '$actdetails'), 
                             projcode = CONCAT(IFNULL(projcode, ''), '\n', '$projcode_value'), 
                             timeend='$timeend' 
                         WHERE date='$current_date' AND employeeid='$employeeid'";

        if ($dbh->query($update_query)) {
            echo "Updated: $current_date <br>";
        } else {
            echo "Error updating record: " . $dbh->error . "<br>";
        }
    } else {
        // Insert new record
        $insert_query = "INSERT INTO tblhractlog (timestamp, loginid, date, employeeid, activity, projcode, timestart, timeend) 
                         VALUES (NOW(), $idlogin, '$current_date', '$employeeid', '$actdetails', '$projcode_value', '$timestart', '$timeend')";

        if ($dbh->query($insert_query)) {
            $idinsert = mysqli_insert_id($dbh);
            echo "Inserted: $current_date <br>";



        } else {
            echo "Error inserting record: " . $dbh->error . "<br>";
        }
    }



			
    // Move to the next date
    $current_date = date("Y-m-d", strtotime("+1 day", strtotime($current_date)));
}

// Close database connection
$dbh->close();

?>
