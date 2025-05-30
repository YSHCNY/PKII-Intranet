<?php
session_start();
//
// ./qryhrtalvrequpdid.php
// fr ./mhrlvfrmreq3.php
//
include '../includes/dbh.php';

function generateRandomString($length = 6) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[mt_rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

// Example usage
$identifier = generateRandomString();


  $res12query=""; $result12=""; $found12=0;
  $res12query="UPDATE tblhrtalvreq SET timestamp=\"$now\", loginid=$loginid, daysapproved=$daysapproved, approvectr=$apprctr, approvestamp=\"$now\", approverid=$loginid, approverempid=\"$employeeid0\", statusta=$statusta WHERE idhrtalvreq=$id";
  $result12=$dbh->query($res12query);



  $current_date = new DateTime($leavedate);
	$end_date = new DateTime($endleave);
	$minusday = 1.0;

	if ($lcode == 'hdv' || $lcode == 'hds'){
        $minusday = 0.5;
        } else {
        $minusday = 1.0;
    
        }
	
	while ($current_date <= $end_date) {
		// Check if the current day is a weekday (Monday-Friday)
		$day_of_week = $current_date->format('N'); // 'N' gives day of the week (1 = Monday, 7 = Sunday)
	
		// Skip weekends (Saturday and Sunday)
		if ($day_of_week < 6) {
			$log_date = $current_date->format('Y-m-d');
			$res124query = "INSERT INTO leavesaver (leavestart, leaveend, leavedays, count, leaveid, leavecode, empid, identifier) VALUES ('$leavedate', '$endleave', '$log_date', '$minusday', '$leaveid', '$lcode', '$requestorid', '$identifier')";
			$result124 = $dbh->query($res124query);
		}
	
		// Move to the next date
		$current_date->modify('+1 day');
	}









	$res1221querys = "UPDATE tblemployee
	SET 
		vacation = CASE 
			WHEN '$lcode' = 'hdv' THEN vacation - 0.5
			WHEN '$lcode' = 'vacation' THEN vacation - $leavedur 
			ELSE vacation 
		END,
		sick = CASE 
			WHEN '$lcode' = 'hds' THEN sick - 0.5
			WHEN '$lcode' = 'sick' THEN sick - $leavedur 
			ELSE sick 
		END,
		paternity = CASE 
			WHEN '$lcode' = 'paternity' THEN paternity - $leavedur 
			ELSE paternity 
		END,
		maternityn = CASE 
			WHEN '$lcode' = 'maternityn' THEN maternityn - $leavedur 
			ELSE maternityn 
		END,
		maternityc = CASE 
			WHEN '$lcode' = 'maternityc' THEN maternityc - $leavedur 
			ELSE maternityc 
		END,
		special = CASE 
			WHEN '$lcode' = 'special' THEN special - $leavedur 
			ELSE special 
		END
	WHERE 
		employeeid = $requestorid
		AND '$lcode' IN ('vacation', 'sick', 'paternity', 'maternityn', 'special', 'maternityc', 'hdv', 'hds')";
  
	$res1221querys = mysqli_query($dbh, $res1221querys);
  
  if (!$res1221querys) {
	  echo "Error: " . mysqli_error($dbh);
  } else {
	  echo "Query executed successfully.";
  }
	

// close db conn
$dbh->close();
?>
