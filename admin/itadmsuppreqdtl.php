<?php
// from itadmsuppreq.php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$iditsupportreq = (isset($_GET['its'])) ? $_GET['its'] :'';

$found = 0;
$accesslevel11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

	$res15query="SELECT tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.comments, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actiondetails, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.scorestamp, tblitsupportreq.scoreempid, tblitsupportreq.scoreremarks, tblitctgsuppreq.name, tblitctgsuppreq.ctgtype, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq LEFT JOIN tblitctgsuppreq ON tblitsupportreq.requestctg=tblitctgsuppreq.code WHERE tblitsupportreq.iditsupportreq=$iditsupportreq";
	$result15=""; $ctr15=0; $found15=0;
	$result15 = $dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15 = $result15->fetch_assoc()) {
		$found15 = 1;
		$ctr15 = $ctr15 + 1;
		$ticketnum15 = $myrow15['ticketnum'];
		$stamprequest15 = $myrow15['stamprequest'];
		$employeeid15 = $myrow15['employeeid'];
		$deptcd15 = $myrow15['deptcd'];
		$requestctg15 = $myrow15['requestctg'];
		$details15 = $myrow15['details'];
		$comments15 = $myrow15['comments'];
		$requestctr15 = $myrow15['requestctr'];
		$approvectr15 = $myrow15['approvectr'];
		$approveid15 = $myrow15['approveid'];
		$approveempid15 = $myrow15['approveempid'];
		$approvestamp15 = $myrow15['approvestamp'];
		$actionctr15 = $myrow15['actionctr'];
		$actionctg15 = $myrow15['actionctg'];
		$actiondetails15 = $myrow15['actiondetails'];
		$actionid15 = $myrow15['actionid'];
		$actionempid15 = $myrow15['actionempid'];
		$closeticketsw15 = $myrow15['closeticketsw'];
		$closestamp15 = $myrow15['closestamp'];
		$scoreval15 = $myrow15['scoreval'];
		$scorestamp15 = $myrow15['scorestamp'];
		$scoreempid15 = $myrow15['scoreempid'];
		$scoreremarks15 = $myrow15['scoreremarks'];
		$itsrctgname15 = $myrow15['name'];
		$itsrctgtype15 = $myrow15['ctgtype'];
		$classreqtyp15 = $myrow15['classreqtyp'];
    if($scorestamp15=='') { $scorestamp15=$datenow; }

    $apprdurationsw15 = $myrow15['apprdurationsw'];
    $apprdurationdt15 = $myrow15['apprdurationdt'];
		} // while($myrow15 = $result15->fetch_assoc())
	} // if($result15->num_rows>0)

	// display support request details
	echo "<table class=\"fin\" border=\"1\">";
	echo "<tr><th colspan=\"2\">TECHNICAL SUPPORT DETAILS</th></tr>";
	$res11query="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.email1, tblempdetails.empdepartment, empposition FROM tbllogin LEFT JOIN tblcontact ON tbllogin.employeeid=tblcontact.employeeid LEFT JOIN tblempdetails ON tbllogin.employeeid=tblempdetails.employeeid WHERE tblcontact.employeeid=\"$employeeid15\"";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$name_last11 = $myrow11['name_last'];
		$name_first11 = $myrow11['name_first'];
		$name_middle11 = $myrow11['name_middle'];
		$email111 = $myrow11['email1'];
		$empdepartment11 = $myrow11['empdepartment'];
		$empposition11 = $myrow11['empposition'];
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)
	echo "<tr><td align=\"right\">Ticket no.</td>";
	if($ticketnum15==0) {
		echo "<form action=\"itadmsuppreqnewtick.php?loginid=$loginid\" method=\"POST\" name=\"itadmsuppreqnewtick\">";
		echo "<input type=\"hidden\" name=\"iditsupportreq\" value=\"$iditsupportreq\">";
		echo "<td><button type=\"submit\" class='btn btn-primary'>Assign new ticket</button></td>";
		echo "</form>";
	} else if($ticketnum15!=0) {
		echo "<td><b>$ticketnum15</b></td>";
	} // if($ticketnum15==0)
	echo "<tr><td align=\"right\">Request date</td><td>".date("Y-M-d H:i:s", strtotime($stamprequest15))."</td></tr>";
	echo "<tr><td align=\"right\">Requested by</td><td><b>".strtoupper($name_last11).", ".strtoupper($name_first11)."</b>, $empposition11, $empdepartment11</td></tr>";
	echo "<tr><td align=\"right\">Request/s</td><td>";
	// provide for loop below, query tblitctgsuppreq
	$res12query="SELECT idtblctgsuppreq, code, name FROM tblitctgsuppreq WHERE ctgtype=\"REQ\"";
	$result12=""; $found12=0; $ctr12=0;
	$result12 = $dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12 = $result12->fetch_assoc()) {
		$found12 = 1;
		$ctr12 = $ctr12 + 1;
		$iditsr12 = $myrow12['idtblctgsupreq'];
		$code12 = $myrow12['code'];
		$name12 = $myrow12['name'];
		if(preg_match("/$code12/", "$requestctg15")) {
		echo "$name12<br>";
		} // if(preg_match("/$code12/", "$requestctg15"))
		} // while($myrow12 = $result12->fetch_assoc())
	} // if($result12->num_rows>0)
	echo "</td></tr>";
	echo "<tr><td align=\"right\">Details</td><td>".nl2br($details15)."</td></tr>";

	echo "<tr><td align=\"right\">Approval status</td><td>";
	if($approvectr15==0) {
		echo "Pending approval";
	} else if($approvectr15==1) {
		echo "<font color=\"green\">Request Approved</font><br>$approvestamp15";
	}
	echo "</td></tr>";

    //20240327
    echo "<tr><td align=\"right\">Allowed duration of request</td><td>";
    if($apprdurationsw15==1) {
    echo date('Y-M-d', strtotime($apprdurationdt15));
    } //if
    echo "</td></tr>";


	echo "<tr><td align=\"right\">Approver</td><td>";
	if($approvectr15==1) {
	// query tblcontact for approveempid15
	$res14aquery="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.email1, tblempdetails.empposition, tblempdetails.empdepartment FROM tblcontact LEFT JOIN tblempdetails ON tblcontact.employeeid=tblempdetails.employeeid WHERE tblcontact.employeeid=\"$approveempid15\"";
	$result14a=""; $found14a=0; $ctr14a=0;
	$result14a = $dbh2->query($res14aquery);
	if($result14a->num_rows>0) {
		while($myrow14a = $result14a->fetch_assoc()) {
		$found14a = 1;
		$ctr14a = $ctr14a + 1;
		$name_last14a = strtoupper($myrow14a['name_last']);
		$name_first14a = strtoupper($myrow14a['name_first']);
		$name_middle14a = $myrow14a['name_middle'];
		$email114a = $myrow14a['email1'];
		$empposition14a = $myrow14a['empposition'];
		$empdepartment14a = $myrow14a['empdepartment'];
		} // while($myrow14a = $result14a->fetch_assoc())
	} // if($result14a->num_rows>0)
	echo "$name_last14a, $name_first14a - $empposition14a";
	} else if($approvectr15==0) {
	if($employeeid15==$employeeid) {
	echo "<form method=\"POST\" action=\"itsuppreq2.php?loginid=$loginid\" name=\"itsuppreq2\">";
	echo "<input type=\"hidden\" name=\"iditsupportreq\" value=\"$iditsupportreq\">";
	echo "<select name=\"approver\">";
	$res14query="SELECT tblitsupportapprover.iditsupportapprover, tblitsupportapprover.approver1empid, tblitsupportapprover.approver2empid  FROM tblitsupportapprover WHERE tblitsupportapprover.deptcd=\"$deptcd15\"";
	$result14=""; $found14=0; $ctr14=0;
	$result14 = $dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14 = $result14->fetch_assoc()) {
		$found14 = 1;
		$ctr14 = $ctr14 + 1;
		$iditsupportapprover14 = $myrow14['iditsupportapprover'];
		$approver1empid14 = $myrow14['approver1empid'];
		$approver2empid14 = $myrow14['approver2empid'];
		if($approver1empid14!='') {
		// query names in tblcontact
		$res14aquery="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.email1, tblempdetails.empposition, tblempdetails.empdepartment FROM tblcontact LEFT JOIN tblempdetails ON tblcontact.employeeid=tblempdetails.employeeid WHERE tblcontact.employeeid=\"$approver1empid14\"";
		$result14a=""; $found14a=0; $ctr14a=0;
		$result14a = $dbh2->query($res14aquery);
		if($result14a->num_rows>0) {
			while($myrow14a = $result14a->fetch_assoc()) {
			$found14a = 1;
			$ctr14a = $ctr14a + 1;
			$name_last14a = strtoupper($myrow14a['name_last']);
			$name_first14a = strtoupper($myrow14a['name_first']);
			$name_middle14a = $myrow14a['name_middle'];
			$email114a = $myrow14a['email1'];
			$empposition14a = $myrow14a['empposition'];
			$empdepartment14a = $myrow14a['empdepartment'];
			} // while($myrow14a = $result14a->fetch_assoc())
		} // if($result14a->num_rows>0)
		echo "<option value=\"$approver1empid14\">$name_last14a, $name_first14a $name_middle14a[0]. - $empposition14a, $empdepartment14a</option>";
		} // if($approver1empid14!='')
		if($approver2empid14!='') {
		// query names in tblcontact
		$res14bquery="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.email1, tblempdetails.empposition, tblempdetails.empdepartment FROM tblcontact LEFT JOIN tblempdetails ON tblcontact.employeeid=tblempdetails.employeeid WHERE tblcontact.employeeid=\"$approver2empid14\"";
		$result14b=""; $found14b=0; $ctr14b=0;
		$result14b = $dbh2->query($res14bquery);
		if($result14b->num_rows>0) {
			while($myrow14b = $result14b->fetch_assoc()) {
			$found14b = 1;
			$ctr14b = $ctr14b + 1;
			$name_last14b = strtoupper($myrow14b['name_last']);
			$name_first14b = strtoupper($myrow14b['name_first']);
			$name_middle14b = $myrow14b['name_middle'];
			$email114b = $myrow14b['email1'];
			$empposition14b = $myrow14b['empposition'];
			$empdepartment14b = $myrow14b['empdepartment'];
			} // while($myrow14b = $result14b->fetch_assoc())
		} // if($result14b->num_rows>0)
		echo "<option value=\"$approver2empid14\">$name_last14b, $name_first14b $name_middle14b[0]. - $empposition14b, $empdepartment14b</option>";
		} // if($approver2empid14!='')
		} // while($myrow14 = $result14->fetch_assoc())
	} // if($result14->num_rows>0)
	echo "</select>";
	} else if($approveempid15==$employeeid) {
		// display approver readonly
		$res14aquery="SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.email1, tblempdetails.empposition, tblempdetails.empdepartment FROM tblcontact LEFT JOIN tblempdetails ON tblcontact.employeeid=tblempdetails.employeeid WHERE tblcontact.employeeid=\"$approveempid15\"";
		$result14a=""; $found14a=0; $ctr14a=0;
		$result14a = $dbh2->query($res14aquery);
		if($result14a->num_rows>0) {
			while($myrow14a = $result14a->fetch_assoc()) {
			$found14a = 1;
			$ctr14a = $ctr14a + 1;
			$name_last14a = strtoupper($myrow14a['name_last']);
			$name_first14a = strtoupper($myrow14a['name_first']);
			$name_middle14a = $myrow14a['name_middle'];
			$email114a = $myrow14a['email1'];
			$empposition14a = $myrow14a['empposition'];
			$empdepartment14a = $myrow14a['empdepartment'];
			} // while($myrow14a = $result14a->fetch_assoc())
		} // if($result14a->num_rows>0)
		echo "$name_last14a, $name_first14a - $empposition14a";
	} // if($employeeid15==$employeeid)
	} // if($approvectr15==1)

	echo "</td></tr>";
	echo "<form method=\"POST\" action=\"itadmsuppreqact.php?loginid=$loginid\" name=\"itadmsuppreqact\">";
	echo "<input type=\"hidden\" name=\"iditsupportreq\" value=\"$iditsupportreq\">";
	echo "<tr><td align=\"right\">Classification</td><td>";
	echo "<select name='classreqtyp'>";
	if($classreqtyp15==0) {
		$classreqtyp15sel0="selected"; $classreqtyp15sel1=""; $classreqtyp15sel2=""; $classreqtyp15sel3="";
	} elseif($classreqtyp15==1) {
		$classreqtyp15sel0=""; $classreqtyp15sel1="selected"; $classreqtyp15sel2=""; $classreqtyp15sel3="";
	} elseif($classreqtyp15==2) {
		$classreqtyp15sel0=""; $classreqtyp15sel1=""; $classreqtyp15sel2="selected"; $classreqtyp15sel3="";
	} elseif($classreqtyp15==3) {
		$classreqtyp15sel0=""; $classreqtyp15sel1=""; $classreqtyp15sel2=""; $classreqtyp15sel3="selected";
	} //if-elseif
	echo "<option value=0 $classreqtyp15sel0>Unclassified</option>";
	echo "<option value=1 $classreqtyp15sel1>Technical</option>";
	echo "<option value=2 $classreqtyp15sel2>Administrative</option>";
	echo "<option value=3 $classreqtyp15sel3>Repair</option>";
	echo "</select>";
	echo "</td></tr>";
	echo "<tr><td align=\"right\">Action taken</td><td>";
	// if($closeticketsw15==0) {
	echo "<select name=\"actionctg\">";
	if($actionctg15=='') {
	echo "<option value=''>-</option>";
	} // if($actionctg15=='')
	$res16query="SELECT idtblctgsuppreq, code, name FROM tblitctgsuppreq WHERE ctgtype=\"ACT\"";
	$result16=""; $found16=0; $ctr16=0;
	$result16 = $dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16 = $result16->fetch_assoc()) {
		$found16 = 1;
		$ctr16 = $ctr16 + 1;
		$idtblctgsuppreq16 = $myrow16['idtblctgsuppreq'];
		$code16 = $myrow16['code'];
		$name16 = $myrow16['name'];
		if($code16==$actionctg15) { $actionctgsel="selected"; } else { $actionctgsel=""; }
		echo "<option value=\"$code16\" $actionctgsel>$name16</option>";
		} // while($myrow16 = $result16->fetch_assoc())
	} // if($result16->num_rows>0)
	echo "</select>";
	echo "<br><textarea rows=5 cols=70 name=\"actiondetails\">$actiondetails15</textarea>";
	echo "<br><button type=\"submit\" class='btn btn-primary'>Update</button>";
	echo "</form>";
	/*
	} else if($closeticketsw15==1) {
	$res16query="SELECT name FROM tblitctgsuppreq WHERE ctgtype=\"ACT\" AND code=\"$actionctg15\"";
	$result16=""; $found16=0; $ctr16=0;
	$result16 = $dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16 = $result16->fetch_assoc()) {
		$found16 = 1;
		$ctr16 = $ctr16 + 1;
		$name16 = $myrow16['name'];
		echo "$name16";
		} // while($myrow16 = $result16->fetch_assoc())
	} // if($result16->num_rows>0)
	} // if($closeticketsw15==0)
	*/
	if($actiondetails15!='') { echo "<br>$actiondetails15"; }
	echo "</td></tr>";
	echo "<tr><td align=\"right\">Ticket status</td>";
	if($closeticketsw15==0) {
		if($ticketnum15==0) {
		echo "<td></td>";
		} else {
		echo "<form action=\"itadmsuppreqclose.php?loginid=$loginid&its=$iditsupportreq\" method=\"POST\" name=\"itadmsuppreqclose\">";
		echo "<input type=\"hidden\" name=\"ticketnum\" value=\"$ticketnum15\">";
		echo "<input type=\"hidden\" name=\"emailreq\" value=\"$email111\">";
		echo "<td>OPEN&nbsp;";
		echo "<button type=\"submit\" class='btn btn-danger'>Close ticket</button>";
		echo "</td>";
		echo "</form>";
		} // if($ticketnum15==0)
	} else if($closeticketsw15==1) {
		// echo "<td><b>CLOSED</b><br>";
			echo "<td><font color=\"green\">CLOSED</font><br>".date("Y-M-d H:i:s", strtotime($closestamp15))."";
			// display closer
			$res16query="SELECT name_last, name_first FROM tblcontact WHERE employeeid=\"$actionempid15\"";
			$result16=""; $found16=0; $ctr16=0;
			$result16 = $dbh2->query($res16query);
			if($result16->num_rows>0) {
				while($myrow16 = $result16->fetch_assoc()) {
				$found16 = 1;
				$ctr16 = $ctr16 + 1;
				$name_last16 = $myrow16['name_last'];
				$name_first16 = $myrow16['name_first'];
				$closerinfo = "by: $actionempid15 - $name_last16, $name_first16";
				} // while($myrow12 = $result12->fetch_assoc())
			} // if($result12->num_rows>0)
			echo "<br>$closerinfo";
			// echo "</td>";



// dev start
/*
    echo "<br>";
    echo "<form action=\"itadmsuppreqchgdtclstck.php?loginid=$loginid&its=$iditsupportreq\" method=\"POST\" name=\"itadmsuppreqchgdtclstck\">";
    echo "<input type=\"datetime-local\" name=\"newclosestamp\" value=\"$closestamp15\">";
    echo "<button type=\"submit\" class='btn btn-success'>Update date-time</button>";
    echo "</form>"; 
*/
// dev end
// -OR-
// production start
   echo "$closestamp15";
// production end

    echo "</td>";
	} // if($closeticketsw15==0)
	// compute hrs duration if closed ticket
	if($closeticketsw15==1 && $approvectr15==1) {
		$durstart = new DateTime($approvestamp15);
		$durend = new DateTime($closestamp15);
		$duration = $durend->diff($durstart);
		// $durstart = strtotime($approvestamp15);
		// $durend = strtotime($closestamp15);
		// $duration = $durend - $durstart;
		echo "<tr><td align=\"right\">Duration</td><td>";
		if($duration->format("%d")!='') {
			if($duration->format("%d")!=0) {
			echo "".$duration->format("%d days, ")."";
			} // if($duration->format("%d")!=0)
		} // if($duration->format("%d")!='')
		echo "".$duration->format("%H:%I hrs:min")."</td></tr>";
	} // if($closeticketsw15==1)
	
	echo "</tr>";

	/*
	if($employeeid15==$employeeid) {
		if($approvectr15==0) {
		echo "<input type=\"hidden\" name=\"ctgactor\" value=\"$actor\">";
		echo "<input type=\"hidden\" name=\"requestctr\" value=\"1\">";
		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Re-submit for approval\"></td></tr>";
		echo "</form>";
		} // if($approvectr15==0)
	} // if($employeeid15==$employeeid)

	if($approveempid15==$employeeid) {
		if($approvectr15==0) {
		echo "<form method=\"POST\" action=\"itsuppreq2.php?loginid=$loginid\" name=\"itsuppreq2\">";
		echo "<input type=\"hidden\" name=\"iditsupportreq\" value=\"$iditsupportreq\">";
		echo "<input type=\"hidden\" name=\"ctgactor\" value=\"$actor\">";
		echo "<input type=\"hidden\" name=\"approvectr\" value=\"1\">";
		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Approve and Send Support Request\"></td></tr>";
		echo "</form>";
		} // if($approvectr15==0)
	} // if($approveempid15==$employeeid)
	*/

	//
	// satisfaction rating score area
	echo "<tr><td align=\"right\">Satisfaction rating</td>";
	// retain in production
	if($scoreval15!=0) {
		if($scoreval15==1) {
		$scorepct="20%"; $scoreclr="red";
		} else if($scoreval15==2) {
		$scorepct="40%"; $scoreclr="orange";
		} else if($scoreval15==3) {
		$scorepct="60%"; $scoreclr="orange";
		} else if($scoreval15==4) {
		$scorepct="80%"; $scoreclr="orange";
		} else if($scoreval15==5) {
		$scorepct="100%"; $scoreclr="green";
		} // if($scoreval15==1)
		echo "<td><font color=\"$scoreclr\"><b>$scoreval15&nbsp;stars&nbsp;($scorepct)</b></font></td>";
//
// start retain in production
} else {
  echo "<td></td>";
    // echo "";
} // if($scoreval15!=0)
// end retain in production
//

	// remove in production:
	// start score edit
/*
} else {
         echo "<br>";
	echo "<form method=\"POST\" action=\"itadmsuppreqscore.php?loginid=$loginid\" name=\"itadmsuppreqscore\">";
	echo "<input type=\"hidden\" name=\"its\" value=\"$iditsupportreq\">";
	echo "<input type=\"hidden\" name=\"scoreempid\" value=\"$employeeid15\">";
        echo "<td>";
	echo "<select name=\"scoreval\">";
	if($scoreval15>=1) {
		if($scoreval15==1) {
		$scorevalsel1="selected"; $scorevalsel2=""; $scorevalsel3=""; $scorevalsel4=""; $scorevalsel5=""; $scorevalselnone="";
		} else if($scoreval15==2) {
		$scorevalsel1=""; $scorevalsel2="selected"; $scorevalsel3=""; $scorevalsel4=""; $scorevalsel5=""; $scorevalselnone="";
		} else if($scoreval15==3) {
		$scorevalsel1=""; $scorevalsel2=""; $scorevalsel3="selected"; $scorevalsel4=""; $scorevalsel5=""; $scorevalselnone="";
		} else if($scoreval15==4) {
		$scorevalsel1=""; $scorevalsel2=""; $scorevalsel3=""; $scorevalsel4="selected"; $scorevalsel5=""; $scorevalselnone="";
		} else if($scoreval15==5) {
		$scorevalsel1=""; $scorevalsel2=""; $scorevalsel3=""; $scorevalsel4=""; $scorevalsel5="selected"; $scorevalselnone="";
		} // if($scoreval15==1)
	} else {
		$scorevalsel1=""; $scorevalsel2=""; $scorevalsel3=""; $scorevalsel4=""; $scorevalsel5=""; $scorevalselnone="selected";
	echo "<option value='0' $scorevalselnone>-</option>";
	} // if($scoreval15>=1)
	echo "<option value=\"0\" $scorevalselnone>-</option>";
	echo "<option value=\"5\" $scorevalsel5>5 stars (100%)</option>";
	echo "<option value=\"4\" $scorevalsel4>4 stars (80%)</option>";
	echo "<option value=\"3\" $scorevalsel3>3 stars (60%)</option>";
	echo "<option value=\"2\" $scorevalsel2>2 stars (40%)</option>";
	echo "<option value=\"1\" $scorevalsel1>1 stars (20%)</option>";
	echo "</select>";
	echo "<br>";
	if($scorestamp15=='') {
	echo "<input size=12 type=\"date\" name=\"scorestamp\" value=\"$approvestamp15\">";
	} else {
	echo "<input size=12 type=\"date\" name=\"scorestamp\" value=\"$scorestamp15\">";
	} // if($scorestamp15=='')
	echo "<br>";
	echo "empid:$employeeid15";
	echo "<br>";
	echo "<textarea rows=5 cols=70 name=\"scoreremarks\">$scoreremarks15</textarea>";
	echo "<br>";
	echo "<button type=\"submit\" class='btn btn-primary'>Submit score</button>";
	echo "</form>";
// end score edit
//

        echo "</td>";

} 
        echo "</tr>";
	
// start delete support request button

  echo "<form method=\"POST\" action=\"itadmsuppreqdel.php?loginid=$loginid\" name=\"itadmsuppreqdel\">";
  echo "<input type='hidden' name='idits' value='$iditsupportreq'>";
  echo "<button type='submit' class='btn btn-danger'>Delete this support request</button>";
  echo "</form>";

// end delete support request button

*/
  // end remove in production
//

	//
	// display comments/clarifications textarea field, then display contents below submit button
	//
	echo "<tr><th colspan=\"2\">comments / clarification area</th></tr>";
	if($closeticketsw15!=1) {
	echo "<form method=\"POST\" action=\"itadmsuppreqcomments.php?loginid=$loginid\" name=\"itadmsuppreqcomm\">";
	echo "<input type=\"hidden\" name=\"iditsupportreq\" value=\"$iditsupportreq\">";
	echo "<input type=\"hidden\" name=\"ctgactor\" value=\"$actor\">";
	echo "<tr><td colspan=\"2\" align=\"center\"><textarea rows=5 cols=70 name=\"comments\"></textarea>";
	echo "<br><button type=\"submit\" class='btn btn-primary'>Submit comments/clarifications</button></td></tr>";
	echo "</form>";
	} // if($closeticketsw15!=1)
	echo "<tr><td colspan=\"2\">".nl2br($comments15)."</td></tr>";
	echo "</table>";

	echo "<p><a href=\"itadmsuppreq.php?loginid=$loginid\" class='btn btn-default' role='button'>back</a></p>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result = $dbh2->query($resquery);
     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
