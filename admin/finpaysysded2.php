<?php

	if($employeeid != "") {
	echo "<tr><td colspan=\"2\">";
	echo "<table width=\"100%\" class=\"fin\">";
	// query personnel
	$res14query = "SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblhrtapaygrpemplst.idhrtapayshiftctg, tblhrtapaygrpemplst.bankacctid, tblhrtapaygrpemplst.restday FROM tblhrtapaygrpemplst INNER JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.employeeid=\"$employeeid\" AND tblcontact.contact_type=\"personnel\"";
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
		$name_last14 = $myrow14['name_last'];
		$name_first14 = $myrow14['name_first'];
		$name_middle14 = $myrow14['name_middle'];
		$contact_gender14 = $myrow14['contact_gender'];
		$idhrtapayshiftctg14 = $myrow14['idhrtapayshiftctg'];
		$bankacctid14 = $myrow14['bankacctid'];
		$restday14 = $myrow14['restday'];
		}
	}

	echo "<tr><th colspan=\"2\">Details of deductions for personnel:<br>$employeeid - ".strtoupper($name_last14).",&nbsp;".strtoupper($name_first14)."&nbsp;".strtoupper($name_middle14)."</th></tr>";

	echo "<tr><td colspan=\"2\" align=\"center\">";

	// add income screen
	echo "<table class=\"fin\">";
	echo "<form action=\"finpaysysdedadd.php?loginid=$loginid&idpg=$idpaygroup\" method=\"post\" name=\"finpaysysdedadd\">";
	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"filesrc\" value=\"$filesrc\">";
	echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"$tabinctyp\">";
	echo "<tr><td>";
	echo "Name&nbsp;<input name=\"deductname\" size=\"30\" value=\"name of deduction\">";
	echo "</td>";
	echo "<td>";
	echo "</td>";
	echo "<td>";
	echo "</td>";
	echo "</tr>";
	echo "<tr><td>";
	echo "Total&nbsp;amount&nbsp;<input type=\"currency\" name=\"deducttotal\" size=\"10\" value=\"0.00\">";
	echo "</td>";
	echo "<td>";
	echo "Amount&nbsp;for&nbsp;deduction&nbsp;<input type=\"currency\" name=\"deductamount\" size=\"10\" value=\"0.00\">";
	echo "</td>";
	echo "<td>";
	echo "Balance&nbsp;<input type=\"currency\" name=\"deductbalance\" size=\"10\" value=\"0.00\">";
	echo "</td>";
	echo "</tr>";
	echo "<tr><td>";
echo "<input type=\"date\" name=\"datestart\" size=\"10\" value=\"$datenow\">";
		?>
	  <a href="javascript:show_calendar('document.finpaysysdedadd.datestart', document.finpaysysdedadd.datestart.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
	  <?php
	echo "From";
	echo "<br>";
	echo "<input type=\"date\" name=\"dateend\" size=\"10\" value=\"$datenow\">";
		?>
	  <a href="javascript:show_calendar('document.finpaysysdedadd.dateend', document.finpaysysdedadd.dateend.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
	  <?php
	echo "To";
	echo "</td>";
	echo "<td>";
	echo "Schedule&nbsp;<select name=\"schedule\">";
	echo "<option value=\"all\">all</option>";
	echo "<option value=\"15th\">15th only</option>";
	echo "<option value=\"30th\">30th only</option>";
	echo "</select>";
	echo "</td>";
	echo "<td>";
	echo "<input type=\"checkbox\" name=\"status\" checked>Active status";
	echo "</td>";
	echo "</tr>";
	echo "<tr><td colspan=\"3\" align=\"center\">";
	echo "<input type=\"submit\" value=\"Add new deduction\">";
	echo "</td></tr";
	echo "</form>";
	echo "</table>";

	echo "</td></tr>";

	echo "<tr><td colspan=\"2\">";
	echo "<table width=\"100%\" class=\"fin2\">";
	echo "<tr><th colspan=\"9\">Deductions</th></tr>";
	// query tblfinpaysysdeduct
	$res15query = "SELECT idtblfinpaydeduct, deductname, deductamount, deducttotal, deductbalance, datestart, dateend, status, schedule FROM tblfinpaydeduct WHERE idpaygroup=$idpaygroup AND employeeid=\"$employeeid\" ORDER BY dateend DESC, datestart DESC";
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
		echo "<tr><td><b>$deductname15</b></td>";
		echo "<td align=\"right\">".number_format($deducttotal15, 2)."<br><font size=\"1\"><i>Total</i></font></td>";
		echo "<td align=\"right\"><b>".number_format($deductamount15, 2)."</b><br><font size=\"1\"><i>Amount</i></font></td>";
		echo "<td align=\"right\">".number_format($deductbalance15, 2)."<br><font size=\"1\"><i>Balance</i></font></td>";
		echo "<td align=\"center\">".date("Y-M-d", strtotime($datestart15))."&nbsp;-to-&nbsp;".date("Y-M-d", strtotime($dateend15))."<br><font size=\"1\"><i>Duration</i></font></td>";
		echo "<td align=\"center\">$schedule15</td>";
		if($status15==1) { echo "<td align=\"center\">Active</td>"; }
		else if($status15==0) { echo "<td></td>"; }
		echo "<td>";
		echo "<a href=\"finpaysysdededt.php?loginid=$loginid&fpdid=$idtblfinpaydeduct15&fsrc=$filesrc&idpg=$idpaygroup&tab=$tab0\">Edit</a>";
		echo "</td><td>";
		echo "<a href=\"finpaysysdeddel.php?loginid=$loginid&fpdid=$idtblfinpaydeduct15&eid=$employeeid&fsrc=$filesrc&idpg=$idpaygroup&tab=$tab0\">Del</a>";
		echo "</td></tr>";
		}
	}
	echo "</table>";

	// echo "</td></tr>";
	echo "</table>";

	echo "</td></tr>";
	} // if($employeeid!="")

?>
