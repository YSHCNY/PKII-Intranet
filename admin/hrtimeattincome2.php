<?php

	if($employeeid != "") {
	echo "<tr><td colspan=\"2\">";
	echo "<table width=\"100%\" class=\"fin\">";
	// query personnel
	$res14query = "SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblhrtapaygrpemplst.idhrtapayshiftctg, tblhrtapaygrpemplst.bankacctid, tblhrtapaygrpemplst.restday FROM tblhrtapaygrpemplst LEFT JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.employeeid=\"$employeeid\" AND tblcontact.contact_type=\"personnel\"";
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

	echo "<tr><th colspan=\"2\">Input additional income for personnel:<br>$employeeid - ".strtoupper($name_last14).",&nbsp;".strtoupper($name_first14)."&nbsp;".strtoupper($name_middle14)."</th></tr>";

	echo "<tr><td colspan=\"2\">";

	// add income screen
	echo "<form action=\"hrtimeattincadd.php?loginid=$loginid&idpg=$idpaygroup\" method=\"post\" name=\"modhrtaincadd\">";
	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"filesrc\" value=\"$filesrc\">";
	echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"$tabinctyp\">";

	// 20200204 for projassignid dropdown
	echo "<table class=\"fin\">";
	echo "<tr><td colspan=\"3\">";
	echo "<input type=\"radio\" name=\"rdinctyp\" value=\"projallow\">&nbsp;from Allowances";
	echo "</td></tr>";
    echo "<tr><td colspan=\"3\">";
	echo "<select name=\"projassignid\">";
  // query tblprojassign
	$res16qry=""; $result16=""; $found16=0; $ctr16=0;
	$res16qry="SELECT projassignid, ref_no, proj_code, proj_name, allow_inc, allow_inc_currency, allow_inc_paytype, allow_proj, allow_proj_currency, allow_proj_paytype, ecola1, ecola1_currency, ecola2, ecola2_currency, allow_field_currency, allow_field_paytype, allow_field, allow_accomm, allow_accomm_currency, allow_accomm_paytype, allow_transpo, allow_transpo_currency, allow_transpo_paytype, allow_comm, allow_comm_currency, allow_comm_paytype, perdiem, perdiem_currency, durationfrom, durationto, durationfrom2, durationto2, net_of_tax, allow_fixed, allow_fixed_currency, allow_fixed_paytype FROM tblprojassign WHERE employeeid=\"$employeeid\" AND (allow_inc<>0 OR allow_proj<>0 OR ecola1<>0 OR ecola2<>0 OR allow_field<>0 OR allow_accomm<>0 OR allow_transpo<>0 OR allow_comm<>0 OR perdiem<>0 OR allow_fixed<>0) ORDER BY durationfrom DESC";
	$result16=$dbh2->query($res16qry);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
			$found16=1;
			$ctr16=$ctr16+1;
			$projassignid16 = $myrow16['projassignid'];
			$ref_no16 = $myrow16['ref_no'];
			$proj_code16 = $myrow16['proj_code'];
			$proj_name16 = $myrow16['proj_name'];
			$allow_inc16 = $myrow16['allow_inc'];
			$allow_inc_currency16 = $myrow16['allow_inc_currency'];
			$allow_inc_paytype16 = $myrow16['allow_inc_paytype'];
			$allow_proj16 = $myrow16['allow_proj'];
			$allow_proj_currency16 = $myrow16['allow_proj_currency'];
			$allow_proj_paytype16 = $myrow16['allow_proj_paytype'];
			$ecola116 = $myrow16['ecola1'];
			$ecola1_currency16 = $myrow16['ecola1_currency'];
			$ecola216 = $myrow16['ecola2'];
			$ecola2_currency16 = $myrow16['ecola2_currency'];
			$allow_field_currency16 = $myrow16['allow_field_currency'];
			$allow_field_paytype16 = $myrow16['allow_field_paytype'];
			$allow_field16 = $myrow16['allow_field'];
			$allow_accomm16 = $myrow16['allow_accomm'];
			$allow_accomm_currency16 = $myrow16['allow_accomm_currency'];
			$allow_accomm_paytype16 = $myrow16['allow_accomm_paytype'];
			$allow_transpo16 = $myrow16['allow_transpo'];
			$allow_transpo_currency16 = $myrow16['allow_transpo_currency'];
			$allow_transpo_paytype16 = $myrow16['allow_transpo_paytype'];
			$allow_comm16 = $myrow16['allow_comm'];
			$allow_comm_currency16 = $myrow16['allow_comm_currency'];
			$allow_comm_paytype16 = $myrow16['allow_comm_paytype'];
			$perdiem16 = $myrow16['perdiem'];
			$perdiem_currency16 = $myrow16['perdiem_currency'];
			$durationfrom16 = $myrow16['durationfrom'];
			$durationto16 = $myrow16['durationto'];
			$durationfrom216 = $myrow16['durationfrom2'];
			$durationto216 = $myrow16['durationto2'];
			$net_of_tax16 = $myrow16['net_of_tax'];
			$allow_fixed16 = $myrow16['allow_fixed'];
			$allow_fixed_currency16 = $myrow16['allow_fixed_currency'];
			$allow_fixed_paytype16 = $myrow16['allow_fixed_paytype'];
            echo "<option value=\"$projassignid16\">$ref_no16 - $proj_code16 - ";
			if($proj_name16!='') {
				echo "$proj_name16";
			} // if
      echo "&nbsp;>";
			if($allow_inc16!=0) {
				echo "Income: $allow_inc16&nbsp;$allow_inc_currency16&nbsp;$allow_inc_paytype16&nbsp;|";
			} // if
			if($allow_proj16!=0) {
				echo "&nbsp;Project: $allow_proj16&nbsp;$allow_proj_currency16&nbsp;$allow_proj_paytype16&nbsp;|";
			} // if
			if($ecola116!=0) {
				echo "&nbsp;ecola1: $ecola116&nbsp;$ecola1_currency16&nbsp;|";
			} // if
			if($ecola216!=0) {
				echo "&nbsp;ecola2: $ecola216&nbsp;$ecola2_currency16&nbsp;|";
			} // if
			if($allow_field16!=0) {
				echo "&nbsp;Field: $allow_field16&nbsp;$allow_field_currency16&nbsp;$allow_field_paytype16&nbsp;|";
			} // if
			if($allow_accomm16!=0) {
				echo "&nbsp;Accommodation: $allow_accomm16&nbsp;$allow_accomm_currency16&nbsp;$allow_accomm_paytype16&nbsp;|";
			} // if
			if($allow_transpo16!=0) {
				echo "&nbsp;Transportation: $allow_transpo16&nbsp;$allow_transpo_currency16&nbsp;$allow_transpo_paytype16&nbsp;|";
			} // if
			if($allow_comm16!=0) {
				echo "&nbsp;Communication: $allow_comm16&nbsp;$allow_comm_currency16&nbsp;$allow_comm_paytype16&nbsp;|";
			} // if
			if($perdiem16!=0) {
				echo "&nbsp;perdiem: $perdiem16&nbsp;$perdiem_currency16&nbsp;|";
			} // if
			if($allow_fixed16!=0) {
				echo "&nbsp;Fixed: $allow_fixed16&nbsp;$allow_fixed_currency16&nbsp;$allow_fixed_paytype16&nbsp;";
			} // if
			echo "&nbsp;$durationfrom16 -to- $durationto16";
			if($durationfrom2!='' && $durationto2!='') {
				echo "&nbsp;$durationfrom216 -to- $durationto216";
			} // if
			if($net_of_tax16=='on') {
				echo "&nbsp;-&nbsp;Net of tax";
			}
			echo "</option>";
		} // while
	} // if
	echo "</select>";
    echo "</td></tr>";	
	echo "</table>";
	
	// for manual/custom entry
	echo "<table class=\"fin\">";
	// 20200204
	echo "<tr><td colspan=\"3\">";
	echo "<input type=\"radio\" name=\"rdinctyp\" value=\"manual\" checked=\"checked\">&nbsp;Custom";
	echo "</td></tr>";
	echo "<tr><td>";
	echo "Name&nbsp;<input name=\"incomename\" size=\"30\" value=\"name of income\">";
	echo "</td>";
	echo "<td>";
	echo "Amount&nbsp;<input type=\"currency\" name=\"amount\" size=\"10\" value=\"0.00\">";
	echo "</td>";
	echo "<td>";
	echo "<input type=\"date\" name=\"datestart\" size=\"10\" value=\"$datenow\">";
		?>
	  <a href="javascript:show_calendar('document.modhrtaincadd.datestart', document.modhrtaincadd.datestart.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
	  <?php
	echo "From";
	echo "<br>";
	echo "<input type=\"date\" name=\"dateend\" size=\"10\" value=\"$datenow\">";
		?>
	  <a href="javascript:show_calendar('document.modhrtaincadd.dateend', document.modhrtaincadd.dateend.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
	  <?php
	echo "To";
	echo "</td></tr>";
  echo "</table>";

  // common options
	echo "<table class=\"fin\">";
  // row1
  echo "<tr><th colspan=\"3\">Common options</th></tr>";
  echo "<tr><td><input type=\"checkbox\" name=\"lumpsumsw\" value=\"on\">For lumpsum, pls input total and balance</td>";
  echo "<td>Total<input type=\"currency\" name=\"amtlumpsumtotal\" size=\"10\" value=\"0.00\"></td>";
  echo "<td>Balance<input type=\"currency\" name=\"amtlumpsumbal\" size=\"10\" value=\"0.00\"></td>";
  echo "</tr>";
  // row2
	echo "<tr><td>";
	echo "<input type=\"checkbox\" name=\"nontaxable\">Non-taxable";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<input type=\"checkbox\" name=\"vatinclusive\">VAT inclusive";
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
	echo "<tr><td colspan=\"3\">";
	// echo "<input type=\"submit\" value=\"Add income\">";
	echo "<button type=\"submit\" class=\"btn btn-success\">Add income</button>";
	echo "</td></tr";
	echo "</form>";
	echo "</table>";

	echo "</td></tr>";

	echo "<tr><td>";
	// start column01
	echo "<table width=\"100%\" class=\"fin2\">";
	echo "<tr><th colspan=\"5\">Taxable income</th></tr>";
	$res15query = "SELECT idhrtaempincome, name, amount, datestart, dateend, nontaxable, vatinclusive, status, schedule, projassignid, allowtyp, lumpsumsw, amtlumpsumtotal, amtlumpsumbalance FROM tblhrtaempincome WHERE idpaygroup=$idpaygroup AND employeeid=\"$employeeid\" AND (nontaxable='' OR nontaxable=0) ORDER BY dateend DESC, datestart DESC";
	$result15=""; $found15=0; $ctr15=0;
	/*
	$result15 = mysql_query("", $dbh);
	if($result15 != "") {
		while($myrow15 = mysql_fetch_row($result15)) {
	*/
	$result15 = $dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15 = $result15->fetch_assoc()) {
		$found15 = 1;
		$idhrtaempincome15 = $myrow15['idhrtaempincome'];
		$name15 = $myrow15['name'];
		$amount15 = $myrow15['amount'];
		$datestart15 = $myrow15['datestart'];
		$dateend15 = $myrow15['dateend'];
		$nontaxable15 = $myrow15['nontaxable'];
		$vatinclusive15 = $myrow15['vatinclusive'];
		$status15 = $myrow15['status'];
		$schedule15 = $myrow15['schedule'];
		$projassignid15 = $myrow15['projassignid'];
		$allowtyp15 = $myrow15['allowtyp'];
		$lumpsumsw15 = $myrow15['lumpsumsw'];
		$amtlumpsumtotal15 = $myrow15['amtlumpsumtotal'];
		$amtlumpsumbalance15 = $myrow15['amtlumpsumbalance'];
		echo "<tr><td><b>$name15</b><br>";
		echo "<font size=\"1\"><i>";
		if($vatinclusive15 == 1) { echo "VAT inclusive"; }
		echo "</i></font>";
		// query tblprojassign if projassignid!=0
		if($projassignid15!=0) {
			//query projcode and projname
			$res17qry=""; $result17=""; $found17=0;
			$res17qry="SELECT ref_no, proj_code, proj_name FROM tblprojassign WHERE projassignid=$projassignid15 AND employeeid=\"$employeeid\"";
			$result17=$dbh2->query($res17qry);
			if($result17->num_rows>0) {
				while($myrow17=$result17->fetch_assoc()) {
					$found17=1;
					$ref_no17 = $myrow17['ref_no'];
					$proj_code17 = $myrow17['proj_code'];
					$proj_name17 = $myrow17['proj_name'];
				} // while
			} // if
		echo "<br><i>Ref#:</i><b>$ref_no17</b>&nbsp;<i>Proj:</i><b>$proj_code17-$proj_name17</b>";
		} // if
		echo "</td>";
		
		echo "<td align=\"center\">".date("Y-M-d", strtotime($datestart15))."&nbsp;-to-&nbsp;".date("Y-M-d", strtotime($dateend15))."<br><font size=\"1\"><i>schedule:";
		echo "$schedule15";
		echo "</i></font>";
		if($lumpsumsw15=='on') {
			echo "<br><b>".number_format($amtlumpsumtotal15, 2)."</b><br><font size=\"1\"><i>Lump sum total</i></font>";
		} // if
		echo "</td>";
		
		echo "<td align=\"right\"><b>".number_format($amount15, 2)."</b><br><font size=\"1\"><i>status:";
		if($status15 == 1) { echo "active"; } else { echo "inactive"; }
		echo "</i></font>";
		if($lumpsumsw15=='on') {
			echo "<br><b>".number_format($amtlumpsumbalance15, 2)."</b><br><font size=\"1\"><i>Lump sum balance</i></font>";
		} // if
		echo "</td>";
		
		echo "<td>";
		echo "<button type=\"button\" class=\"btn btn-warning\"><a href=\"hrtimeattincomeedit.php?loginid=$loginid&empincid=$idhrtaempincome15&fsrc=$filesrc&idpg=$idpaygroup&tab=$tab\">Edit</a></button>";
		echo "</td>";
		
		echo "<td>";
		echo "<button type=\"button\" class=\"btn btn-danger\"><a href=\"hrtimeattincomedel.php?loginid=$loginid&empincid=$idhrtaempincome15&fsrc=$filesrc&idpg=$idpaygroup&tab=$tab\">Del</a></button>";
		echo "</td></tr>";
		}
	}
	echo "</table>";
	echo "</td>";
	// end column01

	// start column02
	echo "<td>";
	echo "<table width=\"100%\" class=\"fin2\">";
	echo "<tr><th colspan=\"5\">Non-taxable income</th></tr>";
	$res15query = "SELECT idhrtaempincome, name, amount, datestart, dateend, nontaxable, vatinclusive, status, schedule, projassignid, allowtyp, lumpsumsw, amtlumpsumtotal, amtlumpsumbalance FROM tblhrtaempincome WHERE idpaygroup=$idpaygroup AND employeeid=\"$employeeid\" AND nontaxable=1 ORDER BY dateend DESC, datestart DESC";
	$result15=""; $found15=0; $ctr15=0;
	/*
	$result15 = mysql_query("", $dbh);
	if($result15 != "") {
		while($myrow15 = mysql_fetch_row($result15)) {
	*/
	$result15 = $dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15 = $result15->fetch_assoc()) {
		$found15 = 1;
		$idhrtaempincome15 = $myrow15['idhrtaempincome'];
		$name15 = $myrow15['name'];
		$amount15 = $myrow15['amount'];
		$datestart15 = $myrow15['datestart'];
		$dateend15 = $myrow15['dateend'];
		$nontaxable15 = $myrow15['nontaxable'];
		$vatinclusive15 = $myrow15['vatinclusive'];
		$status15 = $myrow15['status'];
		$schedule15 = $myrow15['schedule'];
		$projassignid15 = $myrow15['projassignid'];
		$allowtyp15 = $myrow15['allowtyp'];
		$lumpsumsw15 = $myrow15['lumpsumsw'];
		$amtlumpsumtotal15 = $myrow15['amtlumpsumtotal'];
		$amtlumpsumbalance15 = $myrow15['amtlumpsumbalance'];

		echo "<tr><td><b>$name15</b><br><font size=\"1\"><i>";
		if($vatinclusive15 == 1) { echo "VAT inclusive"; }
		echo "</i></font>";
		// query tblprojassign if projassignid!=0
		if($projassignid15!=0) {
			//query projcode and projname
			$res17qry=""; $result17=""; $found17=0;
			$res17qry="SELECT ref_no, proj_code, proj_name FROM tblprojassign WHERE projassignid=$projassignid15 AND employeeid=\"$employeeid\"";
			$result17=$dbh2->query($res17qry);
			if($result17->num_rows>0) {
				while($myrow17=$result17->fetch_assoc()) {
					$found17=1;
					$ref_no17 = $myrow17['ref_no'];
					$proj_code17 = $myrow17['proj_code'];
					$proj_name17 = $myrow17['proj_name'];
				} // while
			} // if
		echo "<br><i>Ref#:</i><b>$ref_no17</b>&nbsp;<i>Proj:</i><b>$proj_code17-$proj_name17</b>";
		} // if
		echo "</td>";
		
		echo "<td align=\"center\">".date("Y-M-d", strtotime($datestart15))."&nbsp;-to-&nbsp;".date("Y-M-d", strtotime($dateend15))."<br><font size=\"1\"><i>schedule:";
		echo "$schedule15";
		echo "</i></font>";
		if($lumpsumsw15=='on') {
			echo "<br><b>".number_format($amtlumpsumtotal15, 2)."</b><br><font size=\"1\"><i>Lump sum total</i></font>";
		} // if
		echo "</td>";
		
		echo "<td align=\"right\"><b>".number_format($amount15, 2)."</b><br><font size=\"1\"><i>status:";
		if($status15 == 1) { echo "active"; } else { echo "inactive"; }
		echo "</i></font>";
		if($lumpsumsw15=='on') {
			echo "<br><b>".number_format($amtlumpsumbalance15, 2)."</b><br><font size=\"1\"><i>Lump sum balance</i></font>";
		} // if
		echo "</td>";
		
		echo "<td>";
		echo "<button type=\"button\" class=\"btn btn-warning\"><a href=\"hrtimeattincomeedit.php?loginid=$loginid&empincid=$idhrtaempincome15&fsrc=$filesrc&idpg=$idpaygroup&tab=$tab\">Edit</a></button>";
		echo "</td>";
		
		echo "<td>";
		echo "<button type=\"button\" class=\"btn btn-danger\"><a href=\"hrtimeattincomedel.php?loginid=$loginid&empincid=$idhrtaempincome15&fsrc=$filesrc&idpg=$idpaygroup&tab=$tab\">Del</a></button>";
		echo "</td></tr>";
		}
	}
	echo "</table>";
	// end column02

	echo "</td></tr>";
	echo "</table>";

	echo "</td></tr>";
	}

?>