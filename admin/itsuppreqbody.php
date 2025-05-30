|<?php
include("db1.php");

date_default_timezone_set('Asia/Manila'); 
$currentDateTime = date('Y-m-d'); 




$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$res11query="SELECT 
tblitsupportreq.*,
tblcontact.*,
GROUP_CONCAT(tblitctgsuppreq.name ORDER BY tblitctgsuppreq.code SEPARATOR '<br>- ') AS categnames
FROM 
tblitsupportreq
LEFT JOIN 
tblcontact ON tblitsupportreq.employeeid = tblcontact.employeeid
LEFT JOIN 
tblitctgsuppreq ON tblitsupportreq.requestctg LIKE CONCAT('%', tblitctgsuppreq.code, '|%')
WHERE
tblitsupportreq.datecreated = '$currentDateTime'
GROUP BY 
tblitsupportreq.iditsupportreq, tblcontact.employeeid
ORDER BY 
tblitsupportreq.stamprequest DESC";

$result11=""; $found11=0; $ctr11=0;
$result11 = $dbh2->query($res11query);

if($result11->num_rows>0) {
    while($myrow11 = $result11->fetch_assoc()) {
    $found11 = 1;
    $ctr11 = $ctr11 + 1;
    $iditsupportreq11 = $myrow11['iditsupportreq'];
    $ticketnum11 = $myrow11['ticketnum'];
    $stamprequest11 = $myrow11['stamprequest'];
    $employeeid11 = $myrow11['employeeid'];
    $deptcd11 = $myrow11['deptcd'];
    $requestctg11 = $myrow11['requestctg'];
    $details11 = $myrow11['details'];
    $requestctr11 = $myrow11['requestctr'];
    $approvectr11 = $myrow11['approvectr'];
    $approveid11 = $myrow11['approveid'];
    $approveempid11 = $myrow11['approveempid'];
    $approvestamp11 = $myrow11['approvestamp'];
    $actionctr11 = $myrow11['actionctr'];
    $actionctg11 = $myrow11['actionctg'];
    $actionid11 = $myrow11['actionid'];
    $actionempid11 = $myrow11['actionempid'];
    $closeticketsw11 = $myrow11['closeticketsw'];
    $closestamp11 = $myrow11['closestamp'];
    $scoreval11 = $myrow11['scoreval'];
    $classreqtyp11 = $myrow11['classreqtyp'];
    if($classreqtyp11==0) {
        $classreqtyp11fin="Unclassified";
    } elseif($classreqtyp11==1) {
        $classreqtyp11fin="Technical";
    } elseif($classreqtyp11==2) {
        $classreqtyp11fin="Administrative";
    } elseif($classreqtyp11==3) {
        $classreqtyp11fin="Repair";
    }

    // fetch name
    $name_last14 = $myrow11['name_last'];
    $name_first14 = $myrow11['name_first'];

    
    // fetch categorie
    $ctgname17 = $myrow11['categnames'];

    $apprdurationsw11 = $myrow11['apprdurationsw'];
    $apprdurationdt11 = $myrow11['apprdurationdt'];

    $res12query="SELECT name_last, name_first FROM tblcontact WHERE employeeid=\"$approveempid11\"";
        $result12=""; $found12=0; $ctr12=0;
        $result12 = $dbh2->query($res12query);
        if($result12->num_rows>0) {
            while($myrow12 = $result12->fetch_assoc()) {
            $found12 = 1;
            $ctr12 = $ctr12 + 1;
            $name_last12 = $myrow12['name_last'];
            $name_first12 = $myrow12['name_first'];
            $approverinfo = "by: $approveempid11 - $name_last12, $name_first12";
            }
        }

        $res15query="SELECT name FROM tblitctgsuppreq WHERE ctgtype=\"ACT\" AND code=\"$actionctg11\"";
        $result15=""; $found15=0; $ctr15=0;
        $result15 = $dbh2->query($res15query);
        if($result15->num_rows>0) {
            while($myrow15 = $result15->fetch_assoc()) {
            $found15=1;
            $ctr15 = $ctr15 + 1;
            $actctgname15 = $myrow15['name'];
            }
        }


        $res16query="SELECT name_last, name_first FROM tblcontact WHERE employeeid=\"$actionempid11\"";
        $result16=""; $found16=0; $ctr16=0;
        $result16 = $dbh2->query($res16query);
        if($result16->num_rows>0) {
            while($myrow16 = $result16->fetch_assoc()) {
            $found16 = 1;
            $ctr16 = $ctr16 + 1;
            $name_last16 = $myrow16['name_last'];
            $name_first16 = $myrow16['name_first'];
            $closerinfo = "by: $actionempid11 - $name_last16, $name_first16";
            } // while($myrow12 = $result12->fetch_assoc())
        } // if($result12->num_rows>0)



	echo "<tr  class='clickable-row' data-href='itadmsuppreqdtl.php?loginid=$loginid&its=$iditsupportreq11' target='_blank'>";
		echo" <td>".date("Y F d  (H:i:s)", strtotime($stamprequest11))."</td>";
		if($ticketnum11==0) {
			echo "<td class = 'text-danger fw-semibold'>Unassigned</td>";
		} else {
			echo "<td class = 'text-dark'><b class='poppins'>$ticketnum11</b></td>";
		}

		echo "<td>";
        echo "$ctgname17<br>";
		
		echo "</td>";
		
		echo"<td>$deptcd11</td>";
		echo"<td>$classreqtyp11fin</td>";
	
		echo "<td>$name_last14, $name_first14</td>";

		$requestDate = new DateTime($stamprequest11);
		$currentDate = new DateTime();
		$currentDateMinus15days = (new DateTime())->modify('-15 days');
		$output = ($requestDate >= $currentDateMinus15days);

		if($approvectr11>=1) {
			$approvestatstr="Request Approved";
			
			
		echo "<td><span class='text-success fw-medium'>$approvestatstr</span><br>".date("Y-M-d H:i:s", strtotime($approvestamp11))."<br>$approverinfo</td>";

		} elseif (!$output) {
			$approvestatstr = "Request Expired";
		
		echo "<td class='text-danger fw-medium'>$approvestatstr</td>";
	
		} elseif($approvectr11==0) {
			$approvestatstr="Pending Approval";
           

		echo "<td class='fw-medium' style='color: #ff4d00;'>$approvestatstr</td>";

		}

		if($actionctr11>=1) {
			

			if ($actctgname15 == "Accomplished") {
				echo "<td class='text-success fw-medium'>$actctgname15</td>";
			} elseif ($actctgname15 == "Request Denied") {
				echo "<td class='text-danger fw-medium'>$actctgname15</td>";
			} elseif ($actctgname15 == "Recommendation/Others") {
				echo "<td class='text-primary fw-medium'>$actctgname15</td>";
			} elseif ($actctgname15 == "Pending") {
				echo "<td class='fw-medium' style='color: #ff4d00;'>$actctgname15</td>";
			} else {
				echo "<td class='fw-medium'>$actctgname15</td>";
			}

		} elseif (!$output) {
		
		echo "<td class='text-danger fw-medium'>Expired</td>";
	
		} elseif($actionctr11==0) {

			echo "<td class='fw-medium' style='color: #ff4d00;'>Pending</td>";
		}

		// satisfaction rating score
		if($scoreval11!='') {
			if($scoreval11==1) {
			$scorepct="20%"; $scoreclr="red";
			} else if($scoreval11==2) {
			$scorepct="40%"; $scoreclr="orange";
			} else if($scoreval11==3) {
			$scorepct="60%"; $scoreclr="orange";
			} else if($scoreval11==4) {
			$scorepct="80%"; $scoreclr="orange";
			} else if($scoreval11==5) {
			$scorepct="100%"; $scoreclr="green";
			} // if($scoreval11==1)
		} // if($scoreval11!='')
		if($scoreval11!=0) {
		echo "<td class='fw-medium'><font color=\"$scoreclr\"><br> $scoreval11 stars  ($scorepct)</font></td>";
		} else {
		echo "<td class='text-danger fw-medium'>No Rate</td>";
		} // if($scoreval11!=0)

		// ticket status
		if($closeticketsw11==0) {
			echo "<td class='text-danger fw-medium'>OPEN</td>";
		} else if($closeticketsw11==1) {
			echo "<td><font color=\"green\">CLOSED</font><br>".date("Y-M-d H:i:s", strtotime($closestamp11))."";
			// display closer
			
			echo "<br>$closerinfo";
			echo "</td>";
		} // if($closeticketsw11==0)
		if ($closeticketsw11 == 1 && $approvectr11 == 1) {
			$durstart = new DateTime($approvestamp11);
			$durend = new DateTime($closestamp11);
			$duration = $durend->diff($durstart);
			echo "<td>";
			echo $duration->format("%d days, %H hours, %I minutes, %S seconds");
			echo "</td>";
		} else {
			echo "<td>None</td>";
		}
		
	

		echo "<td>";
			if($apprdurationsw11==1) {
				echo date('M d (Y)', strtotime($apprdurationdt11));
			} else {
				echo "No Approval Date";
			}
		echo "</td>";

		echo "</tr>";


    } // while($myrow11 = $result11->fetch_assoc())
} // if($result11->num_rows>0)
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var rows = document.querySelectorAll(".clickable-row");
    rows.forEach(function(row) {
        row.addEventListener("click", function() {
            window.location.href = this.dataset.href;
        });
    });
});

</script>

<!-- // $arritsrctg = explode("|", $requestctg11);
		// foreach($arritsrctg as $val => $n) {
		// 	if($n!='') {
		// 		$res17query="SELECT name FROM tblitctgsuppreq WHERE code=\"$n\"";
		// 		$result17=""; $found17=0; $ctr17=0;
		// 		$result17 = $dbh2->query($res17query);
		// 		if($result17->num_rows>0) {
		// 			while($myrow17 = $result17->fetch_assoc()) {
		// 			$found17 = 1;
		// 			$ctr17 = $ctr17 + 1;
		// 			$ctgname17 = $myrow17['name'];
		// 			echo "- $ctgname17<br>";
		// 			} // while()
		// 		} // if()
		// 	} // if()
		// } // for()

// requestor detais
		// $res14query="SELECT name_last, name_first FROM tblcontact WHERE employeeid=\"$employeeid11\"";
		// $result14=""; $found14=1; $ctr14=0;
		// $result14 = $dbh2->query($res14query);
		// if($result14->num_rows>0) {
		// 	while($myrow14 = $result14->fetch_assoc()) {
		// 	$found14 = 1;
		// 	$ctr14 = $ctr14 + 1;
		// 	$name_last14 = $myrow14['name_last'];
		// 	$name_first14 = $myrow14['name_first'];
		// 	} // while($myrow14 = $result14->fetch_assoc())
		// } // if($result14->num_rows>0) -->




<!-- $res16query="SELECT name_last, name_first FROM tblcontact WHERE employeeid=\"$actionempid11\"";
			$result16=""; $found16=0; $ctr16=0;
			$result16 = $dbh2->query($res16query);
			if($result16->num_rows>0) {
				while($myrow16 = $result16->fetch_assoc()) {
				$found16 = 1;
				$ctr16 = $ctr16 + 1;
				$name_last16 = $myrow16['name_last'];
				$name_first16 = $myrow16['name_first'];
				$closerinfo = "by: $actionempid11 - $name_last16, $name_first16";
				} // while($myrow12 = $result12->fetch_assoc())
			} // if($result12->num_rows>0) -->







































            