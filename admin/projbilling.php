<?php 

require("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$orderby = 'tblcontract.fk_projcode';
$orderto = 'DESC';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
} // if

if($found == 1 && substr($level, -33, 1) == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Modules >> Project Billing</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

	// title head
	echo "<tr><th colspan=\"2\">Project Billing</th></tr>";
	
  echo "<tr><td colspan=\"2\">";

	// for encoders
  if($accesslevel >= 3) {
	echo "<table class='fin'>";
	// add button > new contract
	echo "<form action='projbillcontrnew.php?loginid=$loginid' method='POST' name='projbillcontrnew'>";
	echo "<tr><th><button type='submit' class='btn btn-primary'>Add new contract</button></th></tr>";
	echo "</form>";
	echo "</table>";
	// dropdowns

	echo "<table class='fin table-striped' border='1'>";
	// header
	echo "<tr><th>Project Code</th><th>Title</th><th>Duration</th><th>Type</th><th>Total Contract Cost</th><th>Paid</th><th>Balance</th><th colspan='2'>Action</th></tr>";
	// query tblcontract
	// $res11query="SELECT contract_id, contract_title, contract_num, contract_start, contract_end, contract_type, contract_datemob, contract_totcost_balance, contract_totcost_paid, contract_totcost_directcost, contract_totcost_tax, contract_totcost_remuneration, fk_projcode FROM tblcontract ORDER BY $orderby $orderto";
	$res11query="SELECT tblcontract.contract_id, tblcontract.contract_title, tblcontract.contract_num, tblcontract.contract_type, tblcontract.contract_totcost_balance, tblcontract.contract_totcost_paid, tblcontract.contract_totcost_directcost, tblcontract.contract_totcost_tax, tblcontract.contract_totcost_remuneration, tblcontract.fk_projcode, tblproject1.date_start AS date_start, tblproject1.date_end AS date_end, tblproject1.date_mob AS date_mob FROM tblcontract LEFT JOIN tblproject1 ON tblcontract.fk_projcode=tblproject1.proj_code ORDER BY $orderby $orderto";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$ctr11=$ctr11+1;
		$contract_id11 = $myrow11['contract_id'];
		$contract_title11 = $myrow11['contract_title'];
		$contract_num11 = $myrow11['contract_num'];
		// $contract_start11 = $myrow11['contract_start'];
		// $contract_end11 = $myrow11['contract_end'];
		$contract_type11 = $myrow11['contract_type'];
		// $contract_datemob11 = $myrow11['contract_datemob'];
		$contract_totcost_balance11 = $myrow11['contract_totcost_balance'];
		$contract_totcost_paid11 = $myrow11['contract_totcost_paid'];
		$contract_totcost_directcost11 = $myrow11['contract_totcost_directcost'];
		$contract_totcost_tax11 = $myrow11['contract_totcost_tax'];
		$contract_totcost_remuneration11 = $myrow11['contract_totcost_remuneration'];
		$fk_projcode11 = $myrow11['fk_projcode'];
    $date_start11 = $myrow11['date_start'];
    $date_end11 = $myrow11['date_end'];
    $date_mod11 = $myrow11['date_mob'];

		$contract_totcost = $contract_totcost_directcost11 + (($contract_totcost_directcost11*$contract_totcost_tax11)/100) + $contract_totcost_remuneration11;

    // bypass contract_totcost_balance11 from tblcontract
    $contract_totcost_balance = $contract_totcost - $contract_totcost_paid11;

		echo "<tr><td>$fk_projcode11</td><td>$contract_title11</td><td>";
    if($date_start11=="" || $date_start11=="0000-00-00") {
    // if(strtotime($date_start11)>strtotime(0)) {
    } else {
        echo date('Y-M-d', strtotime($date_start11));
    } //if-else
		if($date_end11=="" || $date_end11=="0000-00-00") {
    // if(strtotime($date_end11)>strtotime(0)) {
    } else {
        echo "<br>to<br>".date('Y-M-d', strtotime($date_end11))."";
    } //if-else
		echo "</td><td>$contract_type11</td>";
		echo "<td class='text-right'>".number_format($contract_totcost)."</td><td class='text-right'>".number_format($contract_totcost_paid11)."</td><td class='text-right'>".number_format($contract_totcost_balance)."</td>";
		echo "<form action='projbilldtls.php?loginid=$loginid' method='POST' name='projbilldtls'>";
		echo "<input type='hidden' name='contractid' value='$contract_id11'>";
		echo "<input type='hidden' name='projcode' value='$fk_projcode11'>";
		echo "<td><button type='submit' class='btn btn-primary'>Manage</button></td>";
		echo "</form>";
		echo "<form action='projectManagement.php?loginid=$loginid&projcode=$fk_projcode11&contractid=$contract_id11' method='POST' name='projmanagement'>";
		echo "<td><button type='submit' class='btn btn-primary'>Details</button></td>";
		echo "</form>";
		echo "</tr>";
		// reset variables
		$contract_totcost=0; $date_start11=""; $date_end11="";
		} // while
	} // if
	echo "</table>";
  } // (if accesslevel >= 3)

	// for supervisors+
	if($accesslevel >= 4) {

	} // (if accesslevel >= 4)

  echo "</td></tr>";

// end contents here...

     echo "</table>";

     echo "<p><div id='redir_back2'><a href='index2.php?loginid=$loginid' class='btn btn-primary'>Back</a></div></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();

/**
 * Check if the value is a valid date
 *
 * @param mixed $value
 *
 * @return boolean
 */
function isDate($date_end11) 
{
    if (!$date_end11) {
        return false;
    }

    try {
        new \DateTime($date_end11);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}
?>
