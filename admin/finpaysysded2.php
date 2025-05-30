<?php

	if($employeeid != "") {


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
	

	echo "<div class = 'my-5 text-start'>";
	echo "<p class = 'text-secondary'>Details of deductions for personnel:<br><span class = 'h4 text-dark'> ".strtoupper($name_last14).",&nbsp;".strtoupper($name_first14)."&nbsp;".strtoupper($name_middle14)." ($employeeid)</span></p>";
	echo "</div>";


	// add income screen

	echo "<form action=\"finpaysysdedadd.php?loginid=$loginid&idpg=$idpaygroup\" method=\"post\" name=\"finpaysysdedadd\">";
	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"filesrc\" value=\"$filesrc\">";
	echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"$tabinctyp\">";

	echo "<div class = ''>";
	

	echo "<label for = 'deductname'>Deduction Name : </label> <input name=\"deductname\" class = 'form-control'  placeholder = 'Title of deduction' value=\"\" required>";

	echo "</div>";



echo "<div class = 'row my-5'>";

	echo "<div class = 'col-lg-4 col-12'><label for = 'deducttotal'>Total Deduction : </label> <input type=\"currency\" name=\"deducttotal\" class = 'form-control' placeholder ='0.00' value=\"\" required></div>";
	
	echo "<div class = 'col-lg-4 col-12'><label for = 'deductamount'>Amount For Deduction : </label><input type=\"currency\" name=\"deductamount\" class = 'form-control' placeholder ='0.00' value=\"\" required></div>";

	echo "<div class = 'col-lg-4 col-12'><label for = 'deductbalance'>Balance : </label><input type=\"currency\" name=\"deductbalance\" class = 'form-control' placeholder ='0.00' value=\"\" required></div>";

	echo "</div>";

echo "<div class = 'row my-5'>";
		echo "<div class = 'col-lg-3 col-12'>";
		echo "<label for = 'datestart'>From : </label> <input type=\"date\" name=\"datestart\" class = 'form-control' value=\"$datenow\">";
		echo "</div>";
	
		echo "<div class = 'col-lg-3 col-12'>";
		echo "<label for = 'dateend'>To : </label><input type=\"date\" name=\"dateend\" class = 'form-control' value=\"$datenow\">";
		echo "</div>";

		echo "<div class = 'col-lg-3 col-12'>";
		echo "<label for = 'schedule'>Schedule: </label><select name=\"schedule\" class = 'form-control'>";
		echo "<option value=\"all\">all</option>";
		echo "<option value=\"15th\">15th only</option>";
		echo "<option value=\"30th\">30th only</option>";
		echo "</select>";
		echo "</div>";

		?>

	<div class="col-lg-3 col-12 pt-5">
	<label for="status">Active Deduction</label>
	 <input type="checkbox" class = '' name="status" checked>

	</div>
	</div>
	<?php

	echo "<div class = 'text-end'><input type=\"submit\" class = 'btn bg-primary text-white' value=\"Add new deduction\"></div>";

	echo "</div>";

	echo "</form>";


	echo "<div class = 'mt-5 table-responsive shadow border p-5'>";
	echo "<table class=\"table table-bordered table-hover table-striped\" width = '100%'>";
	// query tblfinpaysysdeduc
	?>
	<captions class = 'text-start'><h4>Deduction List of <span class = 'fw-semibold'><?php echo "$name_last14, $name_first14 ($employeeid)</span>";?></h4></captions>
	<thead>
		<tr>
			<td>Deduction Name</td>
			<td>Total Deduction</td>
			<td>Total Amount</td>
			<td>Deduction Balance</td>

			<td>Deduction Duration</td>
			<td>Schedule</td>
			<td>Status</td>
			<td colspan="2">Action</td>
			
		
		</tr>
	</thead>
	<tbody>
	<?php
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
		if($status15==1) { echo "<td align=\"center\"><span class = 'text-danger'>Active</span></td>"; }
		else if($status15==0) { echo "<td><span class = 'text-success'>Completed</span></td>"; }
		echo "<td>";
		echo "<a href=\"finpaysysdededt.php?loginid=$loginid&fpdid=$idtblfinpaydeduct15&fsrc=$filesrc&idpg=$idpaygroup&tab=$tab0\" class = 'text-white btn bg-success'><i class='bi bi-pencil'></i></a>";
		echo "</td><td>";
		echo "<a href=\"finpaysysdeddel.php?loginid=$loginid&fpdid=$idtblfinpaydeduct15&eid=$employeeid&fsrc=$filesrc&idpg=$idpaygroup&tab=$tab0\" onclick=\"return confirm('Are you sure you want to delete this item?');\" class=\"text-white btn bg-danger\"><i class='bi bi-trash'></i></a>";

		echo "</td></tr>";
		}
	}
	echo "</tbody>";

	// echo "</td></tr>";
	echo "</table>";

	echo "</div>";
	} // if($employeeid!="")

?>
