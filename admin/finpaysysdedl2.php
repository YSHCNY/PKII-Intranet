<?php

	if($idpaygroup != "") {
	echo "<tr><td colspan=\"2\">";
	echo "<table width=\"100%\" class=\"fin\">";
	// query personnel
	$res14query = "SELECT DISTINCT tblfinpaydeduct.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblfinpaydeduct LEFT JOIN tblcontact ON tblfinpaydeduct.employeeid=tblcontact.employeeid WHERE tblfinpaydeduct.idpaygroup=$idpaygroup AND tblcontact.contact_type=\"personnel\"";
	$result14=""; $found14=0;
	/*
	$result14 = mysql_query("", $dbh);
	if($result14 != "") {
		while($myrow14 = mysql_fetch_row($result14)) {
	*/
	$result14 = $dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14 = $result14->fetch_assoc()) {
		$found14 = 1;
		$employeeid14 = $myrow14['employeeid'];
		$name_last14 = $myrow14['name_last'];
		$name_first14 = $myrow14['name_first'];
		$name_middle14 = $myrow14['name_middle'];

		echo "<form method=\"post\" action=\"finpaysysdeda.php?loginid=$loginid&idpg=$idpaygroup\" name=\"finpaysysdedl2\">";
		echo "<input type=\"hidden\" name=\"empid\" value=\"$employeeid14\">";
		echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"$tabinctyp\">";
		echo "<tr><th align=\"left\">$employeeid14</th><th colspan=\"6\" align=\"left\">$name_last14, $name_first14 $name_middle14[0]</th><th><input type=\"submit\" value=\"modify\"></th></tr>";
		echo "</form>";

		// query tblfinpaysysdeduct
	$res15query = "SELECT idtblfinpaydeduct, deductname, deductamount, deducttotal, deductbalance, datestart, dateend, status, schedule FROM tblfinpaydeduct WHERE idpaygroup=$idpaygroup AND employeeid=\"$employeeid14\" ORDER BY dateend DESC, datestart DESC";
	$result15=""; $found15=0; $ctr15=0;
	$result15 = $dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15 = $result15->fetch_assoc()) {
		$found15 = 1;
		$idtblfinpaydeduct15 = $myrow15['idtblfinpaydeduct'];
		$deductname15 = $myrow15['deductname'];
		$deductamount15 = $myrow15['deductamount'];
		$deducttotal15 = $myrow15['deducttotal'];
		$deductbalance15 = $myrow15['deductbalance'];
		$datestart15 = $myrow15['datestart'];
		$dateend15 = $myrow15['dateend'];
		$status15 = $myrow15['status'];
		$schedule15 = $myrow15['schedule'];
		echo "<tr><td></td><td><b>$deductname15</b></td>";
		echo "<td align=\"right\">".number_format($deducttotal15, 2)."<br><font size=\"1\"><i>Total</i></font></td>";
		echo "<td align=\"right\"><b>".number_format($deductamount15, 2)."</b><br><font size=\"1\"><i>Amount</i></font></td>";
		echo "<td align=\"right\">".number_format($deductbalance15, 2)."<br><font size=\"1\"><i>Balance</i></font></td>";
		echo "<td align=\"center\">".date("Y-M-d", strtotime($datestart15))."&nbsp;-to-&nbsp;".date("Y-M-d", strtotime($dateend15))."<br><font size=\"1\"><i>Duration</i></font></td>";
		echo "<td align=\"center\">$schedule15</td>";
		if($status15==1) { echo "<td align=\"center\">Active</td>"; }
		else if($status15==0) { echo "<td></td>"; }
		} // while($myrow15 = $result15->fetch_assoc())
	} // if($result15->num_rows>0)

		} // while($myrow14 = $result14->fetch_assoc())
	} // if($result14->num_rows>0)

	echo "</table>";

	echo "</td></tr>";
	} // if($idpaygroup != "")

?>
