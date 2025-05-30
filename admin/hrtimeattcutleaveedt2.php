<?php
session_start();
include("db1.php");

$loginid = isset($_GET['loginid']) ? $_GET['loginid'] : '';

$found = 0;

if ($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("db1.php");

    $conn = new mysqli($hostname, $dbuser, $dbuserpass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected successfully<br>";
    }


    function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    // Store the random string in a variable
    $randomString = generateRandomString();

    $durationfrom_date = isset($_POST['durationfrom']) ? $_POST['durationfrom'] : '';
    $durationfrom_time = isset($_POST['durationfromh']) ? $_POST['durationfromh'] : '';
    $durationto_date = isset($_POST['durationto']) ? $_POST['durationto'] : '';
    $durationto_time = isset($_POST['durationtoh']) ? $_POST['durationtoh'] : '';
    $leavetype = isset($_POST['leavetype']) ? $_POST['leavetype'] : '';
    $idpaygroup = isset($_POST['idpaygroup']) ? $_POST['idpaygroup'] : '';
    $employeeid = isset($_POST['employeeid']) ? $_POST['employeeid'] : '';



    $reason = isset($_POST['reason']) ? $_POST['reason'] : '';
    $idhrtalvreq = isset($_POST['idhrtalvreq']) ? $_POST['idhrtalvreq'] : '';

    $durationfrom = $durationfrom_date . ' ' . $durationfrom_time;
    $durationto = $durationto_date . ' ' . $durationto_time;


    
$origleavedate = isset($_POST['origleavedate']) ? $_POST['origleavedate'] : '';
$origenddate = isset($_POST['origenddate']) ? $_POST['origenddate'] : '';


// $interval1 = $start1->diff($end1);
// $interval2 = $start2->diff($end2);
// // original


$start2 = new DateTime($origleavedate);
$end2 = new DateTime($origenddate);

$start1 = new DateTime($durationfrom);
$end1 = new DateTime($durationto);

function getWeekdayDifference($startDate, $endDate) {
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);
    $interval = new DateInterval('P1D');  // 1-day interval
    $dateRange = new DatePeriod($start, $interval, $end->modify('+1 day'));  // Include end date

    $weekdayCount = 0;
    foreach ($dateRange as $date) {
        // Check if the day is a weekday (1-5 are weekdays)
        if ($date->format('N') < 6) {
            $weekdayCount++;
        }
    }

    return $weekdayCount;
}

// Example usage

$interval1 = getWeekdayDifference($start1->format('Y-m-d'), $end1->format('Y-m-d'));
$interval2 = getWeekdayDifference($start2->format('Y-m-d'), $end2->format('Y-m-d'));

echo "Weekday difference (EDITED DATE): $interval1 days <br>";
echo "Weekday difference (ORIGINAL DATE): $interval2 days <br>";


// Calculate the intervals








    // $leavetype = trim($leavetype);
    // var_dump($leavetype, "<br>");
	$res14query="SELECT * FROM tblhrtaleavectg WHERE `idhrtaleavectg` = '$leavetype' ";
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$name14 = $myrow14['name'];
		$lcode = $myrow14['code'];
		$idhrtaleavectg = $myrow14['idhrtaleavectg'];
		} // while
	} // if


    $res141query="SELECT * FROM leavesaver WHERE (leavestart = '$durationfrom_date' OR leaveend = '$durationto_date') and empid = '$employeeid'";
	$result141=$dbh2->query($res141query);
	if($result141->num_rows>0) {
		while($myrow141=$result141->fetch_assoc()) {
		$lidentifier = $myrow141['identifier'];

		} // while
	}
    
 
   

// var_dump($lidentifier, "this");

    // Compare the intervals in days
if ($interval1 > $interval2) {
    echo "The first duration is longer. $interval1, > ,$interval2 <br>";
    $showme = $interval1 - $interval2;

    $sql10 = "DELETE FROM leavesaver WHERE empid = '$employeeid' AND identifier = '$lidentifier'";


    if ($conn->query($sql10) === TRUE) {

        


                    echo "Record deleted successfully from leavesaver <br>";
                    $current_date = new DateTime($durationfrom_date);
                    $end_date = new DateTime($durationto_date);
                    if ($lcode == 'hdv' || $lcode == 'hds'){
                    $minusday = 0.5;
                    } else {
                    $minusday = 1.0;
                
                    }

                    while ($current_date <= $end_date) {
                        $day_of_week = $current_date->format('N');
                        if ($day_of_week < 6) {
                            $log_date = $current_date->format('Y-m-d');
                            $res124query = "INSERT INTO leavesaver (leavestart, leaveend, leavedays, count, leaveid, leavecode, empid, grpid, identifier) VALUES ('$durationfrom_date', '$durationto_date', '$log_date',' $minusday',' $idhrtaleavectg', '$lcode','$employeeid', '$idpaygroup', '$randomString')";
                        
                            if ($conn->query($res124query) === TRUE) {
                                $last_id = $conn->insert_id;  // Get the last inserted ID
                            
                                // Query to fetch other columns (including $lidentifier) for the last inserted row
                                $selectQuery = "SELECT *
                                    FROM leavesaver 
                                    WHERE leavecode = '$lcode' 
                                    AND leaveid = $idhrtaleavectg 
                                    AND leavestart = '$durationfrom' 
                                    AND leaveend = '$durationto'
                                    AND id = '$last_id'";
                                $result = $conn->query($selectQuery);
                            
                                if ($result->num_rows > 0) {
                                    // Fetch the data as an associative array
                                    $row = $result->fetch_assoc();
                                    
                                    // Access the columns, for example:
                                        $laststart = $row['leavestart'];
                                        $lastend = $row['leaveend'];

                                    $lidentifier = $row['identifier'];
                                    $lcount = $row['counters'];
                                    echo "Record inserted successfully. Identifier: " . $lidentifier;
                                } else {
                                    echo "No record found.";
                                }
                            } else {
                                echo "Error: " . $res124query . "<br>" . $conn->error;
                            }

                        }

                        $current_date->modify('+1 day');
                                }
                            
                        echo "<br>$selectQuery <-------<br>";

                        $selectQuerys = "SELECT SUM(count) as counters
                        FROM leavesaver 
                        WHERE leavecode = '$lcode' 
                        AND leaveid = $idhrtaleavectg 
                        AND leavestart = '$durationfrom' 
                        AND leaveend = '$durationto'";
                        $results = $conn->query($selectQuerys);
                        if ($results->num_rows > 0) {
                            // Fetch the data as an associative array
                            $rows = $results->fetch_assoc();
                            
                            // Access the columns, for example:
                        
                            $lcounter = $rows['counters'];
                            echo "Record inserted successfully. Identifier: " . $lcounter;
                        } else {
                            echo "No record found.";
                        }






                            } else {
                                echo "Error deleting record from leavesaver: " . $dbh2->error;
                            }


                            echo "<h1>$lcounter, $lidentifier, $durationfrom, $durationto</h1> <br> $selectQuerys <br>";



                                $res12query=""; $result12=""; $found12=0;
                                $res12query = "UPDATE tblemployee
                            SET 
                            vacation = CASE 
                                WHEN '$lcode' = 'hdv' THEN vacation - $showme
                                WHEN '$lcode' = 'vacation' THEN vacation - $showme 
                                ELSE vacation 
                            END,
                            sick = CASE 
                                WHEN '$lcode' = 'hds' THEN sick - $showme
                                WHEN '$lcode' = 'sick' THEN sick - $showme 
                                ELSE sick 
                            END,
                            paternity = CASE 
                                WHEN '$lcode' = 'paternity' THEN paternity - $showme 
                                ELSE paternity 
                            END,
                            maternityn = CASE 
                                WHEN '$lcode' = 'maternityn' THEN maternityn - $showme 
                                ELSE maternityn 
                            END,
                            maternityc = CASE 
                                WHEN '$lcode' = 'maternityc' THEN maternityc - $showme 
                                ELSE maternityc 
                            END,
                            special = CASE 
                                WHEN '$lcode' = 'special' THEN special - $showme 
                                ELSE special 
                            END
                            WHERE 
                            employeeid = $employeeid
                            AND '$lcode' IN ('vacation', 'sick', 'paternity', 'maternityn', 'special', 'maternityc', 'hdv', 'hds')";

                            if($dbh2->query($res12query)=== TRUE){
                            echo "<br> goodies $res12query";
                            $message = "Record updated successfully";
                            $_SESSION['success_message'] = $message;
                             header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
                            
                                            

                            }else {
                                echo "<br> na uh $res12query";
                                $message = "Something's Wrong";
                                $_SESSION['warning_message'] = $message;
                            header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");

                            }


                            $stmt = "UPDATE tblhrtalvreq SET durationfrom = '$durationfrom', durationto = '$durationto', reason = '$reason' WHERE idhrtalvreq = '$idhrtalvreq'";
                            if ($conn->query($stmt) === TRUE) {
                               
                                $_SESSION['success_message'] = "Record updated successfully";
                                header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
                            } else {
                                $_SESSION['success_message'] = "No changes";
                                 header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
                            }
                        
                        
                            var_dump($stmt);
// [[[[[[[[[[[[[[[[[[[[[[END IF ]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]][[[[[[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]]]]]

} elseif ($interval1 < $interval2) {
    echo "The second duration is longer. $interval1, < ,$interval2 <br>";
    $lcounternew = $interval2 - $interval1;

    // $secondquerys = "SELECT *
    // FROM leavesaver 
    // WHERE leavecode = '$lcode' 
    // AND leaveid = $idhrtaleavectg 
    // AND identifier = '$lidentifier'";

    // $newresults = $conn->query($secondquerys);
    // if ($newresults->num_rows > 0) {
    //     // Fetch the data as an associative array
    //     $rows2s = $newresults->fetch_assoc();
        
    //     // Access the columns, for example:
    
    //     $datecounter = $rows2s['leavestart'];
    //     $datecounterend = $rows2s['leaveend'];

    //     echo "Record inserted successfully. Identifier: " . $lcounternew;
    // } else {
    //     echo "No record found.";
    // }



    // $secondquery = "SELECT SUM(count) as counters
    // FROM leavesaver 
    // WHERE leavecode = '$lcode' 
    // AND leaveid = $idhrtaleavectg 
    // AND leavestart = '$datecounter'
    // AND leaveend = '$datecounterend'
    // AND identifier = '$lidentifier'";

    // $newresult = $conn->query($secondquery);
    // if ($newresult->num_rows > 0) {
    //     // Fetch the data as an associative array
    //     $rows2 = $newresult->fetch_assoc();
        
    //     // Access the columns, for example:
    
    //     $lcounternew = $rows2['counters'];
    //     echo "Record inserted successfully. Identifier: " . $lcounternew;
    // } else {
    //     echo "No record found.";
    // }


    

    // echo "<br><br><br><br> $secondquery <br><br>  $lcounternew<br> $datecounter, $datecounterend<br>";

    
    $res12query = "UPDATE tblemployee
    SET 
    vacation = CASE 
        WHEN '$lcode' = 'hdv' THEN vacation + $lcounternew
        WHEN '$lcode' = 'vacation' THEN vacation + $lcounternew 
        ELSE vacation 
    END,
    sick = CASE 
        WHEN '$lcode' = 'hds' THEN sick + $lcounternew
        WHEN '$lcode' = 'sick' THEN sick + $lcounternew 
        ELSE sick 
    END,
    paternity = CASE 
        WHEN '$lcode' = 'paternity' THEN paternity + $lcounternew 
        ELSE paternity 
    END,
    maternityn = CASE 
        WHEN '$lcode' = 'maternityn' THEN maternityn + $lcounternew 
        ELSE maternityn 
    END,
    maternityc = CASE 
        WHEN '$lcode' = 'maternityc' THEN maternityc + $lcounternew 
        ELSE maternityc 
    END,
    special = CASE 
        WHEN '$lcode' = 'special' THEN special + $lcounternew 
        ELSE special 
    END
    WHERE 
    employeeid = $employeeid
    AND '$lcode' IN ('vacation', 'sick', 'paternity', 'maternityn', 'special', 'maternityc', 'hdv', 'hds')";
    
    if($dbh2->query($res12query)=== TRUE){
    echo "goodies $res12query";
    
    $sql10 = "DELETE FROM leavesaver WHERE empid = '$employeeid' AND identifier = '$lidentifier'";


    if ($dbh2->query($sql10) === TRUE) {

        


                    echo "Record deleted successfully from leavesaver <br>";
                    $current_date = new DateTime($durationfrom_date);
                    $end_date = new DateTime($durationto_date);
                    if ($lcode == 'hdv' || $lcode == 'hds' || $lcode = 'hsd'){
                    $minusday = 0.5;
                    } else {
                    $minusday = 1.0;
                
                    }

                    while ($current_date <= $end_date) {
                        $day_of_week = $current_date->format('N');
                        if ($day_of_week < 6) {
                            $log_date = $current_date->format('Y-m-d');
                            $res124query = "INSERT INTO leavesaver (leavestart, leaveend, leavedays, count, leaveid, leavecode, empid, grpid, identifier) VALUES ('$durationfrom_date', '$durationto_date', '$log_date',' $minusday',' $idhrtaleavectg', '$lcode','$employeeid', '$idpaygroup', '$randomString')";
                        
                            if ($dbh2->query($res124query) === TRUE) {
                                $last_id = $dbh2->insert_id;  // Get the last inserted ID
                            
                                // Query to fetch other columns (including $lidentifier) for the last inserted row
                                $selectQuery = "SELECT *
                                    FROM leavesaver 
                                    WHERE leavecode = '$lcode' 
                                    AND leaveid = $idhrtaleavectg 
                                    AND leavestart = '$durationfrom' 
                                    AND leaveend = '$durationto'
                                    AND id = '$last_id'";
                                $result = $dbh2->query($selectQuery);
                            
                                if ($result->num_rows > 0) {
                                    // Fetch the data as an associative array
                                    $row = $result->fetch_assoc();
                                    
                                    // Access the columns, for example:
                                        $laststart = $row['leavestart'];
                                        $lastend = $row['leaveend'];

                                    $lidentifier = $row['identifier'];
                                    $lcount = $row['counters'];
                                    echo "Record inserted successfully. Identifier: " . $lidentifier;
                                } else {
                                    echo "No record found.";
                                }
                            } else {
                                echo "Error: " . $res124query . "<br>" . $dbh2->error;
                            }

                        }

                        $current_date->modify('+1 day');
                                }
                            } else {
                                echo "error";
                            }
    $message = "Record updated successfully";
$_SESSION['success_message'] = $message;
header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
    }else {
        echo "na uh $res12query";
        $message = "Something's Wrong";
        $_SESSION['warning_message'] = $message;
     header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
    
    }


    $stmt = "UPDATE tblhrtalvreq SET durationfrom = '$durationfrom', durationto = '$durationto', reason = '$reason' WHERE idhrtalvreq = '$idhrtalvreq'";
    if ($conn->query($stmt) === TRUE) {
       
        $_SESSION['success_message'] = "Record updated successfully";
         header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
    } else {
        $_SESSION['success_message'] = "No changes";
        header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
    }


    var_dump($stmt);
} else {
    echo "Both durations are the same length. <br>";
    $_SESSION['success_message'] = "Record updated successfully";
    header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
}



		
  
    // header("Location: hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid");
    
     



// echo "$lcode, $leavedur, $employeeid";

    // GET paygroupcode
    




    // $stmt->close();
    $conn->close();
}

} else {
    include("logindeny.php");
}

?>