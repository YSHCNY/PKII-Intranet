<?php

	if($employeeid != "") {
	echo "<tr><td colspan=\"2\">";

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

	echo "<div class = 'shadow border p-4 my-3 '><p class = 'text-secondary mb-0 pb-0'>Input additional income for</p><h4 class = ' mt-0 pt-0'>".strtoupper($name_last14).",&nbsp;".strtoupper($name_first14)."&nbsp;".strtoupper($name_middle14)." ($employeeid)</h4></div>";



	// add income screen
	echo "<form action=\"hrtimeattincadd.php?loginid=$loginid&idpg=$idpaygroup\" method=\"post\" name=\"modhrtaincadd\">";
	echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
	echo "<input type=\"hidden\" name=\"filesrc\" value=\"$filesrc\">";
	echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"$tabinctyp\">";

	// 20200204 for projassignid dropdown


	echo "<div class=\"  shadow border p-4 mb-4\">";
	
	echo "<div class=\"\">";
	echo "<input type=\"radio\" onclick='toggleDivs()' class = '' name=\"rdinctyp\" value=\"projallow\" checked=\"checked\"> ";
	echo "<label for = 'input'>From Allowances</label>";
	echo "</div>";

	echo "<div id = 'div1' class = ' '>";
	echo "<select name=\"projassignid\" class = 'GlobalSelectWx w-100'>";
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
   	echo "</div>";
   	echo "</div>";

	


	// 20200204
	echo "<div class = ' px-4 py-5 mb-4 shadow border'>";
	
	echo "<div class = ' mb-4'>";
	echo "<input type=\"radio\" class = 'm-1' onclick='toggleDivs()' name=\"rdinctyp\" value=\"manual\" >";
	echo "<label for = 'input'>Custom Allowance</label>";
	echo "</div>";

	echo "<div id = 'div2' class ='thishide'>";

	echo "<div class='row mb-3 px-1'>";
	echo "<div class = '  col'>";
	echo "<label for = 'input'>Name of Allowance</label>";
	echo "<input name=\"incomename\" class='form-control' placeholder=\"name of income\">";
	echo "</div>";

	
	echo "<div class = '  col '>";
	echo "<label for = 'select'>Type of Allowance</label>";
	echo "<select class = 'form-select h5 ' name = 'typeofallow'>
	<option value='FA'> Fixed Allowance </option>
	<option value='IA'> Incentive Allowance </option>
	<option value='PA'> Project Allowance </option>
	<option value='FA'> Field Allowance </option>
	<option value='AA'> Accommodation Allowance  </option>
	<option value='TA'> Transportation Allowance  </option>
	<option value='CA'> Communication Allowance  </option>
	<option value='PD'>Per Diem</option>
	<option value='EC1'> ECOLA 1 </option>
	<option value='EC2'> ECOLA 2 </option>
	
	</select>
	";
	echo "</div>";

	echo "</div>";


	echo "<div class = ' mb-4'>";
	echo "<label for = 'input'>Amount of Allowance</label>";
	echo "<input type=\"currency\" name=\"amount\" class='form-control' placeholder=\"0.00\">";
	echo "</div>";


	echo"<div class = 'row m-1'>";
	
	echo"<div class = 'col'>";
	echo "<label for = 'input'>From</label>";
	echo "<input type=\"date\" name=\"datestart\" class='form-control' value=\"$datenow\">";
	echo "</div>";

	echo"<div class = 'col'>";
	echo "<label for = 'input'>To</label>";
	echo "<input type=\"date\" name=\"dateend\" class='form-control' value=\"$datenow\">";
	echo "</div>";

	echo "</div>";
	

	echo "</div>";

	echo "</div>";


  // row1
	echo "<div class = 'shadow border px-5 py-4'><h4>Common options</h4>";
	echo "<div class ='row mt-4' >
<div class='col'>
        <input type='checkbox' class='mx-1' id='lumpsumCheckbox' name='lumpsumsw' value='on'>
        <label for='lumpsumCheckbox'>For lumpsum, please input total and balance</label>
      </div>";

echo "<div id='lumpsumInputs'  class = 'col' style='display: none;'>
 <div class='row'>
        <div class='col'>
          <label for='amtlumpsumtotal'>Total</label>
          <input type='text' id='amtlumpsumtotal' name='amtlumpsumtotal' value='0.00'>
        </div>
        <div class='col'>
          <label for='amtlumpsumbal'>Balance</label>
          <input type='text' id='amtlumpsumbal' name='amtlumpsumbal' value='0.00'>
        </div>
        </div>

      </div>";
	echo "</div>";
  // row2
	echo "<div class = 'row  my-4'><div class = 'col'>";
	echo "<input type=\"checkbox\" name=\"nontaxable\"> <label name = 'input'>Non-taxable</label>";
	echo "</div>";

	echo "<div class = 'col'>";
	echo "<input type=\"checkbox\" name=\"vatinclusive\"> <label name = 'input'>VAT inclusive</label>";


	echo "</div>";


	echo "<div class = 'col'>";
	echo "<label name = 'input'>Schedule</label> <select name=\"schedule\" >";
	echo "<option value=\"all\">all</option>";
	echo "<option value=\"15th\">15th only</option>";
	echo "<option value=\"30th\">30th only</option>";
	echo "</select>";
	echo "</div>";

	echo "<div class = 'col'>";
	echo "<input type=\"checkbox\" name=\"status\" checked> <label name = 'input'>Active status</label>";
	echo "</div>";

	echo "</div>";


	echo "<div class = 'text-end'>";
	// echo "<input type=\"submit\" value=\"Add income\">";
	echo "<button type=\"submit\" class=\"btn bg-success text-white\">Add income</button>";
	echo "</div></div>";
	echo "</form>";
	echo "</table>";

echo "<div class = 'text-center my-5'><h2 class = 'text-secondary'>LIST OF ALLOWANCE</h2></div>";


echo "<div class = 'row '>";

	echo "<div class = 'mb-5 py-3 px-4   bg-white shadow border  rounded-3'><h4 class = 'mb-5 fw-bold' >Taxable income</h4>";
	echo "<table class = 'table table-bordered table-hover table-striped '>";

	echo "
	<thead>
		<tr>
			<th>Allowance Name</th>
			<th>Reference Number</th>
			<th>Project</th>
			<th>Date</th>
			<th>Amount</th>
			<th>Action</th>

		</tr>
	</thead>
	<tbody>
	";
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
		echo "<tr><td> <b>$name15</b><br>";
		echo "<i class = 'text-secondary'>";
		if($vatinclusive15 == 1) { echo "VAT inclusive"; }
		echo "</i>";
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
		echo "<td><b>$ref_no17</b></td>";

		} // if
		echo "</td>";
		
		echo "<td><b>$proj_code17-$proj_name17</b></td>";
		echo "<td align=\"center\"><b>".date("F d Y", strtotime($datestart15))." to ".date("F d Y", strtotime($dateend15))."</b><br><i class = 'text-secondary'>schedule:";
		echo "<b> $schedule15</b>";
		echo "</i>";
		if($lumpsumsw15=='on') {
			echo "<br><br><b>".number_format($amtlumpsumtotal15, 2)."</b><br><i class = 'text-secondary'>Lump sum total</i>";
		} // if
		echo "</td>";
		
		echo "<td align=\"right\"><b>".number_format($amount15, 2)."</b><br><i>status:</i>";
		if($status15 == 1) { echo "<i class = 'text-danger'> active</i>"; } else { echo "<i class = 'text-success'> inactive</i>"; }
		echo "<br>";
		if($lumpsumsw15=='on') {
			echo "<br><b>".number_format($amtlumpsumbalance15, 2)."</b><br><i class = 'text-secondary'>Lump sum balance</i>";
		} // if
		echo "</td>";
		
		echo "<td>";
		echo "<a class=\"m-1 btn text-white btn-warning\" href=\"hrtimeattincomeedit.php?loginid=$loginid&empincid=$idhrtaempincome15&fsrc=$filesrc&idpg=$idpaygroup&tab=$tab\">Edit</a>";
	
		echo "<a class=\"m-1 btn text-white btn-danger\" href=\"hrtimeattincomedel.php?loginid=$loginid&empincid=$idhrtaempincome15&fsrc=$filesrc&idpg=$idpaygroup&tab=$tab\">Delete</a>";
		echo "</td></tr>";
		}
	}

	// end column01

	// start column02
	
	echo "</tbody></table>";

echo "</div>";







echo "<div class = ' py-3 px-4  bg-white shadow border  rounded-3'><h4  class = 'mb-5 fw-bold'>Non-taxable income</h4>";


	echo "<table class = 'table table-bordered table-hover table-striped '>";
	
	echo "
	<thead>
		<tr>
			<th>Allowance Name</th>
			<th>Reference Number</th>
			<th>Project</th>
			<th>Date</th>
			<th>Amount</th>
			<th>Action</th>

		</tr>
	</thead>
	<tbody>
	";
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

		echo "<tr><td> <b>$name15</b><br>";
		echo "<i class = 'text-secondary'>";

		if($vatinclusive15 == 1) { echo "VAT inclusive"; }
		echo "</i>";
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
			echo "<td><b>$ref_no17</b></td>";

		} // if
		echo "</td>";
		echo "<td><b>$proj_code17-$proj_name17</b></td>";
		
		echo "<td align=\"center\"><b>".date("F d Y", strtotime($datestart15))." to ".date("F d Y", strtotime($dateend15))."</b><br><i class = 'text-secondary'>schedule:";
		echo "<b> $schedule15</b>";
		echo "</i>";
	
		if($lumpsumsw15=='on') {
			echo "<br><br><b>".number_format($amtlumpsumtotal15, 2)."</b><br><i class = 'text-secondary'>Lump sum total</i>";
		} // if
		echo "</td>";
		
		echo "<td align=\"right\"><b>".number_format($amount15, 2)."</b><br><i>status:</i>";
		if($status15 == 1) { echo "<i class = 'text-danger'> active</i>"; } else { echo "<i class = 'text-success'> inactive</i>"; }
		echo "<br>";
		if($lumpsumsw15=='on') {
			echo "<br><b>".number_format($amtlumpsumbalance15, 2)."</b><br><i class = 'text-secondary'>Lump sum balance</i>";
		} // if
		echo "</td>";
		
		echo "<td>";
		echo "<a class=\"m-1 btn text-white btn-warning\" href=\"hrtimeattincomeedit.php?loginid=$loginid&empincid=$idhrtaempincome15&fsrc=$filesrc&idpg=$idpaygroup&tab=$tab\">Edit</a>";
	
		echo "<a class=\"m-1 btn text-white btn-danger\" href=\"hrtimeattincomedel.php?loginid=$loginid&empincid=$idhrtaempincome15&fsrc=$filesrc&idpg=$idpaygroup&tab=$tab\">Delete</a>";
		echo "</td></tr>";
		}
	}
	echo "</tbody></table>";
	echo "</div>";

echo "</div>";


	}

?>
    <style>
        .thishide {
            display: none;
        }
		
		th,td{
			text-align: center !important;
		}

		th{
			color: grey !important;
		}
    </style>


<script>
        function toggleDivs() {
            const div1 = document.getElementById('div1');
            const div2 = document.getElementById('div2');
            const selectedValue = document.querySelector('input[name="rdinctyp"]:checked').value;

            // Show/hide the appropriate divs
			if (selectedValue === 'manual') {
            div2.classList.remove('thishide');
            div1.classList.add('thishide');
        } else if (selectedValue === 'projallow') {
            div1.classList.remove('thishide');
            div2.classList.add('thishide');
        }
        }
</script>


<script>
  document.getElementById('lumpsumCheckbox').addEventListener('change', function() {
    const inputs = document.getElementById('lumpsumInputs');
    if (this.checked) {
      inputs.style.display = 'block';
    } else {
      inputs.style.display = 'none';
    }
  });
</script>