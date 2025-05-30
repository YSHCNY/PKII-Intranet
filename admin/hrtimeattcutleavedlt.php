<?php
session_start();
include("db1.php");

$loginid = isset($_GET['loginid']) ? $_GET['loginid'] : '';

$found = 0;

if ($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {

    $idhrtalvreq = isset($_GET['idhrtalvreq']) ? $_GET['idhrtalvreq'] : '';
    $idhrtaleavectg = isset($_GET['idhrtaleavectg']) ? $_GET['idhrtaleavectg'] : '';
    $employeeid = isset($_GET['employeeid']) ? $_GET['employeeid'] : '';
    $lname = isset($_GET['lname']) ? $_GET['lname'] : '';
    $idpaygroup = isset($_GET['idpaygroup']) ? $_GET['idpaygroup'] : '';
    $froms = isset($_GET['froms']) ? $_GET['froms'] : '';
    $tos = isset($_GET['tos']) ? $_GET['tos'] : '';
    



    $res147query="SELECT * FROM  tblhrtapaygrp WHERE idtblhrtapaygrp = $idpaygroup";
	$result147 = $dbh2->query($res147query);
	if($result147->num_rows>0) {
		while($myrow147=$result147->fetch_assoc()) {
		$found147=1;
        $grpname = $myrow147['paygroupname'];
		} // while
	} 

    $res14query="SELECT * FROM tblhrtaleavectg WHERE name = '$lname'";
	$result14 = $dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14=1;
        $lcode = $myrow14['code'];
		} // while
	} 


    $res142query = "SELECT SUM(count) as counters 
    FROM leavesaver 
    WHERE leavecode = '$lcode' 
    AND leaveid = $idhrtaleavectg 
    AND leavestart = '$froms' 
    AND leaveend = '$tos'
    AND empid = '$employeeid'";


    $result142 = $dbh2->query($res142query);

    if ($result142->num_rows > 0) {
    while ($myrow142 = $result142->fetch_assoc()) {
    $found142 = 1;
    $lcount = $myrow142['counters'];

    }
    } else {
    $lcount = 0; // Optional: Initialize if no rows are found
    }
echo "$res142query <br>";

    $res1423query = "SELECT *
    FROM leavesaver 
    WHERE leavecode = '$lcode' 
    AND leaveid = $idhrtaleavectg 
    AND leavestart = '$froms' 
    AND leaveend = '$tos'
    AND empid = '$employeeid'";


    $result1423 = $dbh2->query($res1423query);

    if ($result1423->num_rows > 0) {
    while ($myrow1423 = $result1423->fetch_assoc()) {
    $found1423 = 1;
    $lidentifier = $myrow1423['identifier'];
    $log_date = $myrow1423['leavedays'];

    }
    } else {
    $lcount = 0; // Optional: Initialize if no rows are found
    }

    

echo "code: $lcode, <br> Points to deduct: $lcount";

  




//  $sql2 = "UPDATE tblemployee
// SET 
//     vacation = CASE 
//         WHEN '$lcode' = 'hdv' THEN vacation + $lcount
//         WHEN '$lcode' = 'vacation' THEN vacation + $lcount 
//         ELSE vacation 
//     END,
//     sick = CASE 
//         WHEN '$lcode' = 'hds' THEN sick + $lcount
//         WHEN '$lcode' = 'sick' THEN sick + $lcount 
//         ELSE sick 
//     END,
//     paternity = CASE 
//         WHEN '$lcode' = 'paternity' THEN paternity + $lcount 
//         ELSE paternity 
//     END,
//     maternityn = CASE 
//         WHEN '$lcode' = 'maternityn' THEN maternityn + $lcount 
//         ELSE maternityn 
//     END,
//     maternityc = CASE 
//         WHEN '$lcode' = 'maternityc' THEN maternityc + $lcount 
//         ELSE maternityc 
//     END,
//     special = CASE 
//         WHEN '$lcode' = 'special' THEN special + $lcount 
//         ELSE special 
//     END
// WHERE 
//     employeeid = $employeeid
//     AND '$lcode' IN ('vacation', 'sick', 'paternity', 'maternityn', 'special', 'maternityc', 'hdv', 'hds')";
$sql2 = "UPDATE tblemployee SET ";

if ($lcode == 'hdv' || $lcode == 'vacation') {
    $sql2 .= "vacation = vacation + $lcount, ";
}

if ($lcode == 'hds' || $lcode == 'sick') {
    $sql2 .= "sick = sick + $lcount, ";
}

if ($lcode == 'paternity') {
    $sql2 .= "paternity = paternity + $lcount, ";
}

if ($lcode == 'maternityn') {
    $sql2 .= "maternityn = maternityn + $lcount, ";
}

if ($lcode == 'maternityc') {
    $sql2 .= "maternityc = maternityc + $lcount, ";
}

if ($lcode == 'special') {
    $sql2 .= "special = special + $lcount, ";
}

// Remove trailing comma and space if any updates were added
$sql2 = rtrim($sql2, ", ");

$sql2 .= " WHERE employeeid = $employeeid";

echo "$sql2";
    if ($dbh2->query($sql2) === TRUE) {
        $message = "Leave Retracted!";
        $_SESSION['success_message'] = $message;
        echo "Record deleted successfully from leavesaver <br>";

        // header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
            } else {
                        
        $message = "Something's Wrong";
        $_SESSION['warning_message'] = $message;
        echo "Error deleting record from leavesaver: " . $dbh2->error . "<br>";

        
        // header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
        
            }


    $res21423query = "SELECT *
    FROM leavesaver 
    WHERE leavecode = '$lcode' 
    AND identifier = '$lidentifier'";

$result21423 = $dbh2->query($res21423query);
echo "<br> $res21423query<br> ";

$log_dates = []; 

if ($result21423->num_rows > 0) {
    while ($myrow21423 = $result21423->fetch_assoc()) {
        $log_dates[] = $myrow21423['leavedays'];
    }
} 

foreach ($log_dates as $date) {
   echo "<br> $date <br> ";
    $inserttracker = "UPDATE tblhrtaemptimelog SET coltrack = 0 WHERE logdate = '$date' AND employeeid = '$employeeid'";
    $inserttrackerquery = $dbh2->query($inserttracker);
    if ($dbh2->query($inserttracker) === TRUE) {
        $message = "Leave Deleted!";
        $_SESSION['success_message'] = $message;
        echo "Record deleted successfully from leavesaver <br>";

        // header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
            } else {
                        
        $message = "Something's Wrong";
        $_SESSION['warning_message'] = $message;
        echo "Error deleting record from leavesaver: " . $dbh2->error . "<br>";

        
        // header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
        
            }

} 





    $sql2 = "UPDATE SET tblrmpl WHERE idhrtaleavectg = '$idhrtaleavectg'";
    if ($dbh2->query($sql2) === TRUE) {
        echo "<br> Record UPDATE successfully from tblrmpl <br>";
    } else {
        echo "Error UPDATE record from tblrmpl: " . $dbh2->error  . "<br>";
    }


    // [[[[[[[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]]]]]]

    $sql3 = "DELETE FROM leavesaver WHERE identifier = '$lidentifier' AND empid = '$employeeid'";
    if($dbh2->query($sql3)=== TRUE){
		
        $message = "Leave Deleted!";
        $_SESSION['success_message'] = $message;
        echo "Record deleted successfully from leavesaver <br>";

        // header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
            } else {
                        
        $message = "Something's Wrong";
        $_SESSION['warning_message'] = $message;
        echo "Error deleting record from leavesaver: " . $dbh2->error . "<br>";

        
        // header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
        
            }

    // Execute the first SQL query to delete from tblhrtalvreq

    $sql1 = "DELETE FROM tblhrtalvreq WHERE idhrtalvreq = '$idhrtalvreq'  AND durationfrom = '$froms' AND durationto = '$tos' AND employeeid = '$employeeid' ";
    if ($dbh2->query($sql1) === TRUE) {
        $message = "Leave Deleted!";
        $_SESSION['success_message'] = $message;
        echo "Record deleted successfully from leavesaver <br>";

        header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
            } else {
                        
        $message = "Something's Wrong";
        $_SESSION['warning_message'] = $message;
        echo "Error deleting record from leavesaver: " . $dbh2->error . "<br>";

        
        header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
        
            }

    // Redirect back to hrtimeattcutleave.php
    
    exit(); 
} else {
    include("logindeny.php");
}
?>
