<?php

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$yrmonthavlbl = (isset($_POST['yrmonthavlbl'])) ? $_POST['yrmonthavlbl'] :'';
$dd1ticktyp = (isset($_POST['dd1ticktyp'])) ? $_POST['dd1ticktyp'] :'';
$dd2deptcd = (isset($_POST['dd2deptcd'])) ? $_POST['dd2deptcd'] :'';
$classreqtyp = (isset($_POST['classreqtyp'])) ? $_POST['classreqtyp'] :'';

$orderbydate = (isset($_POST['orderbydate'])) ? $_POST['orderbydate'] :'';
$sortby = (isset($_POST['sortby'])) ? $_POST['sortby'] :'';

if($yrmonthavlbl == '') {
  $selyear = $yearnow;
  $selmonth = date("F", mktime(0, 0, 0, $monthnow));
  $yrmonthavlbl = $selyear." ".$selmonth;
}
// if($dd1ticktyp=='') { $dd1ticktyp="0"; }
if($dd1ticktyp=='') { $dd1ticktyp="2"; }
if($dd2deptcd=='') { $dd2deptcd="ALL"; }
if($classreqtyp=='') { $classreqtyp=5; }

$found = 0;
$accesslevel11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

	echo "<table class=\"table table-striped\">";
	// table title
	echo "<tr><th colspan=\"15\">Tech Support Request Summary</th></tr>";
	// dropdown filters
	echo "<form class='form-inline' method=\"POST\" action=\"itadmsuppreq.php?loginid=$loginid\" name=\"itadmsuppreq\">";
  echo "<div class='form-group'>";
	echo "<tr><td colspan=\"15\" align=\"center\">";
	// echo "<table class='table'>";
	// dropdown headers
	// echo "<tr><th>year-month</th><th>ticket type</th><th>department</th><th>classification</th><th></th></tr>";
	// dropdowns
	// echo "<tr><td>";
	// echo "<div class='form-group'>";
  echo "<label for='year-month'>year-month";
	echo "<select class='form-control' name=\"yrmonthavlbl\">";
	echo "<option>Year-Month</option>";
  $res18query = "SELECT DISTINCT DATE_FORMAT(datecreated, '%Y %M') as yyyymonth FROM tblitsupportreq ORDER BY datecreated DESC";
	$result18=""; $found18=0; $ctr18=0;
	$result18 = $dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18 = $result18->fetch_assoc()) {
		$found18 = 1;
		$ctr18 = $ctr18 + 1;
		$yyyymonth = $myrow18['yyyymonth'];
		if($yrmonthavlbl=="$yyyymonth") { $yrmonthsel="selected"; } else { $yrmonthsel=""; }
		echo "<option value=\"$yyyymonth\" $yrmonthsel>$yyyymonth</option>";
		} // while($myrow18 = $result18->fetch_assoc())
	} // if($result18->num_rows>0)
	echo "</select>";
  // echo "</div>";
	// echo "</td><td>";
	// echo "<div class='form-group'>";
  echo "</label>";

  echo "<label for='ticket_type'>ticket type";
	echo "<select class='form-control' name=\"dd1ticktyp\">";
	if($dd1ticktyp==0) {
		$dd1ticktyp0sel="selected"; $dd1ticktyp1sel=""; $dd1ticktypallsel="";
	} else if($dd1ticktyp==1) {
		$dd1ticktyp0sel=""; $dd1ticktyp1sel="selected"; $dd1ticktypallsel="";
	} else if($dd1ticktyp==2) {
		$dd1ticktyp0sel=""; $dd1ticktyp1sel=""; $dd1ticktypallsel="selected";
	}
	echo "<option value=\"0\" $dd1ticktyp0sel>OPEN</option>";
	echo "<option value=\"1\" $dd1ticktyp1sel>CLOSED</option>";
	echo "<option value=\"2\" $dd1ticktypallsel>ALL</option>";
	echo "</select>";
  // echo "</div>";
	// echo "</td><td>";
  echo "</label>";

	// echo "<div class='form-group'>";
  echo "<label for='department'>department";
	echo "<select class='form-control' name=\"dd2deptcd\">";
	$res12query = "SELECT DISTINCT deptcd FROM tblitsupportreq";
	$result12=""; $found12=0; $ctr12=0;
	$result12 = $dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12 = $result12->fetch_assoc()) {
		$found12 = 1;
		$ctr12 = $ctr12 + 1;
		$deptcd12 = $myrow12['deptcd'];
		if($deptcd12!='') {
			if($deptcd12==$dd2deptcd) { $dd2deptcdsel="selected"; $dd2deptcdallsel=""; } else { $dd2deptcdsel=""; $dd2deptcdallsel=""; }
		echo "<option value=\"$deptcd12\" $dd2deptcdsel>$deptcd12</option>";
		} // if($deptcd12!='')
		} // while($myrow12 = $result12->fetch_assoc())
	} // if($result12->num_rows>0)
	if($dd2deptcd=="ALL") { $dd2deptcdallsel="selected"; $dd2deptcdsel=""; }
	echo "<option value=\"ALL\" $dd2deptcdallsel>ALL Depts</option>";
	echo "</select>";
  // echo "</div>";
	// echo "</td><td>";
  echo "</label>";

	// echo "<div class='form-group'>";
  echo "<label for='classification'>classification";
	echo "<select class='form-control' name='classreqtyp'>";
	if($classreqtyp==0) {
		$classreqtypsel0="selected"; $classreqtypsel1=""; $classreqtypsel2=""; $classreqtypsel3=""; $classreqtypsel5="";  $classreqtypesel7="";
	} elseif($classreqtyp==1) {
		$classreqtypsel0=""; $classreqtypsel1="selected"; $classreqtypsel2=""; $classreqtypsel3=""; $classreqtypsel5="";  $classreqtypesel7="";	
	} elseif($classreqtyp==2) {
		$classreqtypsel0=""; $classreqtypsel1=""; $classreqtypsel2="selected"; $classreqtypsel3=""; $classreqtypsel5="";  $classreqtypesel7="";
	} elseif($classreqtyp==3) {
		$classreqtypsel0=""; $classreqtypsel1=""; $classreqtypsel2=""; $classreqtypsel3="selected"; $classreqtypsel5="";  $classreqtypesel7="";
	} elseif($classreqtyp==5) {
		$classreqtypsel0=""; $classreqtypsel1=""; $classreqtypsel2=""; $classreqtypsel3=""; $classreqtypsel5="selected";  $classreqtypesel7="";
	} elseif($classreqtyp==7) {
		$classreqtypsel0=""; $classreqtypsel1=""; $classreqtypsel2=""; $classreqtypsel3=""; $classreqtypsel5=""; $classreqtypesel7="selected";
	}//if-elseif
	echo "<option value=0 $classreqtypsel0>Unclassified</option>";
	echo "<option value=1 $classreqtypsel1>Technical</option>";
	echo "<option value=2 $classreqtypsel2>Administrative</option>";
	echo "<option value=3 $classreqtypsel3>Repair</option>";
	echo "<option value=5 $classreqtypsel5>ALL</option>";
  echo "<option><hr></option>";
  echo "<option value=7 $classreqtypesel7>Allowed duration</option>";
	echo "</select>";
  // echo "</div>";
	// echo "</td><td>";
  echo "</label>";

    if($orderbydate!="") {
        if($orderbydate=="REQ") {
            $orderbydatefield="tblitsupportreq.stamprequest"; 
            $reqsel="selected"; $appsel=""; $clssel=""; $dursel="";
        } else if($orderbydate=="APP") {
            $orderbydatefield="tblitsupportreq.approvestamp"; 
            $reqsel=""; $appsel="selected"; $clssel=""; $dursel="";
        } else if($orderbydate=="CLS") {
            $orderbydatefield="tblitsupportreq.closestamp"; 
            $reqsel=""; $appsel=""; $clssel="selected"; $dursel="";
        } else if($orderbydate=="DUR") {
            $orderbydatefield="tblitsupportreq.apprdurationdt"; 
            $reqsel=""; $appsel=""; $clssel=""; $dursel="selected";
        } //if-else
    } else {
        $orderbydatefield="tblitsupportreq.approvestamp"; 
        $orderbydate="APP"; $reqsel=""; $appsel="selected"; $clssel=""; $dursel="";        
    } //if-else
    echo "<label for='order_by_date'>order by date";
    echo "<select class='form-control' name=\"orderbydate\">";
    echo "<option value='REQ' $reqsel>requested date</option>";
    echo "<option value='APP' $appsel>approved date</option>";
    echo "<option value='CLS' $clssel>closed date</option>";
    echo "<option value='DUR' $dursel>duration date</option>";
    echo "</select>";
    echo "</label>";

    if($sortby!="") {
        if($sortby=="ASC") {
            $sortbyascsel="selected"; $sortbydescsel="";
        } else if($sortby=="DESC") {
            $sortbyascsel=""; $sortbydescsel="selected";
        } //if-else
    } else {
        $sortby="DESC"; $sortbyascsel=""; $sortbydescsel="selected";
    } //if-else
    echo "<label for='sortby'>sort by";
    echo "<select class='form-control' name=\"sortby\">";
    echo "<option value='ASC' $sortbyascsel>ascending</option>";
    echo "<option value='DESC' $sortbydescsel>descending</option>";
    echo "</select>";
    echo "</label>";

	echo "<button type=\"submit\" class='btn btn-primary'>Submit</button>";
	// echo "</td></tr>";
	// echo "</table>";
	echo "</td></tr>";
	echo "</div></form>";
	// column headers
	echo "<tr><th>#</th><th>request date</th><th>ticket no.</th><th>request type</th><th>details</th><th>dept</th><th>classification</th><th>requestor</th><th>allowed duration</th><th>approval status</th><th>action taken</th><th>score</th><th>ticket status</th><th>duration</th>";
	echo "<th>action";
  // echo "<br>$orderbydate $orderbydatefield $sortby";
  echo "</th>";
	echo "</tr>";
	// start contents
	// query tblitsupportreq
	if($dd1ticktyp==2) {
		if($dd2deptcd=="ALL") {
			if($classreqtyp!=5) {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" AND tblitsupportreq.classreqtyp=\"$classreqtyp\" ORDER BY $orderbydatefield $sortby";				
			} else {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" ORDER BY $orderbydatefield $sortby";
			} //if-else

		} else {
			if($classreqtyp!=5) {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.deptcd=\"$dd2deptcd\" AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" AND tblitsupportreq.classreqtyp=\"$classreqtyp\" ORDER BY $orderbydatefield $sortby";			
			} else {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.deptcd=\"$dd2deptcd\" AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" ORDER BY $orderbydatefield $sortby";
			} //if-else

		} // if($dd2deptcd=="ALL")
	} else if($dd1ticktyp==0) {
		if($dd2deptcd=="ALL") {
			if($classreqtyp!=5) {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw=$dd1ticktyp AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" AND tblitsupportreq.classreqtyp=\"$classreqtyp\" ORDER BY $orderbydatefield $sortby";				
			} else {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw=$dd1ticktyp AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" ORDER BY $orderbydatefield $sortby";
			} //if-else

		} else {
			if($classreqtyp!=5) {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw=$dd1ticktyp AND tblitsupportreq.deptcd=\"$dd2deptcd\" AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" AND tblitsupportreq.classreqtyp=\"$classreqtyp\" ORDER BY $orderbydatefield $sortby";				
			} else {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw=$dd1ticktyp AND tblitsupportreq.deptcd=\"$dd2deptcd\" AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" ORDER BY $orderbydatefield $sortby";
			} //if-else

		} // if($dd2deptcd=="ALL")
	} else if($dd1ticktyp>=1) {
		if($dd2deptcd=="ALL") {
			if($classreqtyp!=5) {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw>=$dd1ticktyp AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" AND tblitsupportreq.classreqtyp=\"$classreqtyp\" ORDER BY $orderbydatefield $sortby";				
			} else {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw>=$dd1ticktyp AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" ORDER BY $orderbydatefield $sortby";
			}

		} else {
			if($classreqtyp!=5) {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw>=$dd1ticktyp AND tblitsupportreq.deptcd=\"$dd2deptcd\" AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" AND tblitsupportreq.classreqtyp=\"$classreqtyp\" ORDER BY $orderbydatefield $sortby";				
			} else {
			$res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE tblitsupportreq.closeticketsw>=$dd1ticktyp AND tblitsupportreq.deptcd=\"$dd2deptcd\" AND DATE_FORMAT(tblitsupportreq.datecreated, '%Y %M')=\"$yrmonthavlbl\" ORDER BY $orderbydatefield $sortby";				
			} //if-else

		} // if($dd2deptcd=="ALL")
	} // if($dd1ticktyp=="ALL")


    if($orderbydate=="DUR") {
    $res11query="SELECT tblitsupportreq.iditsupportreq, tblitsupportreq.ticketnum, tblitsupportreq.stamprequest, tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.requestctr, tblitsupportreq.approvectr, tblitsupportreq.approveid, tblitsupportreq.approveempid, tblitsupportreq.approvestamp, tblitsupportreq.actionctr, tblitsupportreq.actionctg, tblitsupportreq.actionid, tblitsupportreq.actionempid, tblitsupportreq.closeticketsw, tblitsupportreq.closestamp, tblitsupportreq.scoreval, tblitsupportreq.classreqtyp, tblitsupportreq.apprdurationsw, tblitsupportreq.apprdurationdt FROM tblitsupportreq WHERE DATE_FORMAT(tblitsupportreq.apprdurationdt, '%Y %M')=\"$yrmonthavlbl\" ORDER BY $orderbydatefield $sortby";
    } //if

	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);

//echo "<tr><td colspan='14'>$res11query</td></tr>";

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
		} //if-elseif

    // 20240327
    $apprdurationsw11 = $myrow11['apprdurationsw'];
    $apprdurationdt11 = $myrow11['apprdurationdt'];

		echo "<tr><td>$ctr11</td><td>".date("Y-M-d H:i:s", strtotime($stamprequest11))."</td>";
		if($ticketnum11==0) {
			echo "<td><font color=\"red\">$ticketnum11</font></td>";
		} else {
			echo "<td><b>$ticketnum11</b></td>";
		} // if($ticketnum11==0)
		echo "<td>";
		// explode function
		$arritsrctg = explode("|", $requestctg11);
		foreach($arritsrctg as $val => $n) {
			if($n!='') {
				$res17query="SELECT name FROM tblitctgsuppreq WHERE code=\"$n\"";
				$result17=""; $found17=0; $ctr17=0;
				$result17 = $dbh2->query($res17query);
				if($result17->num_rows>0) {
					while($myrow17 = $result17->fetch_assoc()) {
					$found17 = 1;
					$ctr17 = $ctr17 + 1;
					$ctgname17 = $myrow17['name'];
					echo "- $ctgname17<br>";
					} // while()
				} // if()
			} // if()
		} // for()
		echo "</td><td>".nl2br($details11)."</td><td>$deptcd11</td><td>$classreqtyp11fin</td>";
		// requestor detais
		$res14query="SELECT name_last, name_first FROM tblcontact WHERE employeeid=\"$employeeid11\"";
		$result14=""; $found14=1; $ctr14=0;
		$result14 = $dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14 = $result14->fetch_assoc()) {
			$found14 = 1;
			$ctr14 = $ctr14 + 1;
			$name_last14 = $myrow14['name_last'];
			$name_first14 = $myrow14['name_first'];
			} // while($myrow14 = $result14->fetch_assoc())
		} // if($result14->num_rows>0)
		echo "<td>$employeeid11 - $name_last14, $name_first14</td>";
		// approver details
		if($approvectr11==0) {
			$approvestatstr="Pending approval";
			// query approver's name based on empid
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
				} // while($myrow12 = $result12->fetch_assoc())
			} // if($result12->num_rows>0)
			echo "<td>$approvestatstr";
			echo "<br>$approverinfo</td>";
		} else if($approvectr11>=1) {
			$approvestatstr="Request Approved";
			// query approver's name based on empid
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
				} // while($myrow12 = $result12->fetch_assoc())
			} // if($result12->num_rows>0)

    //20240327
    if($apprdurationsw11==1) {
    echo "<td>".date('Y-M-d', strtotime($apprdurationdt11))."</td>";
    } else {
    echo "<td></td>";
    } //if-else

			echo "<td><font color=\"green\">$approvestatstr</font><br>".date("Y-M-d H:i:s", strtotime($approvestamp11))."<br>$approverinfo</td>";
		} // if($approvectr11==0)
		// action taken (actionctr)
		if($actionctr11==0) {
			echo "<td><font color=\"red\">$actionctr11</font></td>";			
		} else if($actionctr11>=1) {
			// query actionctg
			$res15query="SELECT name FROM tblitctgsuppreq WHERE ctgtype=\"ACT\" AND code=\"$actionctg11\"";
			$result15=""; $found15=0; $ctr15=0;
			$result15 = $dbh2->query($res15query);
			if($result15->num_rows>0) {
				while($myrow15 = $result15->fetch_assoc()) {
				$found15=1;
				$ctr15 = $ctr15 + 1;
				$actctgname15 = $myrow15['name'];
				} // while($myrow15 = $result15->fetch_assoc())
			} // if($result15->num_rows>0)
			echo "<td>$actctgname15</td>";
		} // if($actionctr11==0)

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
		echo "<td><font color=\"$scoreclr\">$scoreval11&nbsp;stars&nbsp;($scorepct)</font></td>";
		} else {
		echo "<td></td>";
		} // if($scoreval11!=0)

		// ticket status
		if($closeticketsw11==0) {
			echo "<td>OPEN</td>";
		} else if($closeticketsw11==1) {
			echo "<td><font color=\"green\">CLOSED</font><br>".date("Y-M-d H:i:s", strtotime($closestamp11))."";
			// display closer
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
			echo "<br>$closerinfo";
			echo "</td>";
		} // if($closeticketsw11==0)
		// duration column
		if($closeticketsw11==1 && $approvectr11==1) {
			$durstart = new DateTime($approvestamp11);
			$durend = new DateTime($closestamp11);
			$duration = $durend->diff($durstart);
			echo "<td>";
			if($duration->format("%d")!='') {
				if($duration->format("%d")!=0) {
				echo "".$duration->format("%d days, ")."";
				} // if($duration->format("%d")!=0)
			} // if($duration->format("%d")!='')
			echo "".$duration->format("%H:%I hrs:min")."</td>";
		} else {
			echo "<td></td>";
		} // if($closeticketsw15==1)
		echo "<form action=\"itadmsuppreqdtl.php?loginid=$loginid&its=$iditsupportreq11\" method=\"POST\" name=\"itadmsuppreqdtl\">";
		echo "<td>";
		// echo "<input type=\"submit\" value=\"Details\">";
		echo "<button type='submit' class='btn btn-primary'>Details</button>";
		echo "</td>";
		echo "</form>";
		echo "</tr>";
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)
	echo "</table>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result = $dbh2->query($resquery);
     include ("footer.php");

} else {
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
