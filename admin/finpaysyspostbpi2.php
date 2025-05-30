<?php
//
// finpaysyspostbpi2.php 20250117
// incl. fr finpaysyspostbpi.php
//
?>
<!-- 
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("#exportToExcel").click(function() {
            var data='<table>' + $("#ReportTable").html().replace(/<a\/?[^>]+>/gi,'')+'</table>';
            $('body').prepend("<form method='post' action='exportexcel.php' style='display:none' id='ReportTableData'><input type='text' name='tableData' value='"+data+"'></form>");
            $('#ReportTableData').submit().remove();
    });
});
</script> -->

 <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
  function exportToExcel() {
    const table = document.getElementById("ReportTable");
     const tableClone = table.cloneNode(true);
  

  tableClone.deleteRow(2);
  
  const wb = XLSX.utils.book_new();
  const ws = XLSX.utils.table_to_sheet(tableClone, { raw: true });



    const range = XLSX.utils.decode_range(ws["!ref"]);
    for (let R = range.s.r + 1; R <= range.e.r; ++R) {
      const cellAddress = XLSX.utils.encode_cell({ r: R, c: 0 }); // column 0 = A
      const cell = ws[cellAddress];
      if (cell && typeof cell.v === "string" && /^0\d+/.test(cell.v)) {
        cell.t = 's'; 
        cell.s = {
          font: { bold: true, color: { rgb: "FF0000" } },
          alignment: { horizontal: "center" },
          border: {
            top: { style: "thin", color: { rgb: "000000" } },
            bottom: { style: "thin", color: { rgb: "000000" } }
          }
        };
      }
    }

    // Set column widths (A: 20 chars, B: 30 chars)
    ws["!cols"] = [{ wch: 3 }, { wch: 25 }, { wch: 15 }, { wch: 15 }, { wch: 15 }, { wch: 15 }, { wch: 15 }, { wch: 15 }, { wch: 8 }, { wch: 15 }, { wch: 11 }];

    XLSX.utils.book_append_sheet(wb, ws, "StyledSheet");
    XLSX.writeFile(wb, "PayrollSummary(<?php echo $payrollDate?>).xlsx");
  }
</script>
<?php

echo "<p><a href=\"#\" class = 'btn btn-success' onclick=\"exportToExcel()\">Excel</a></p>";
echo "<table id=\"ReportTable\" border='1' class=\"table table-bordered table-striped table-hovered\">";

echo "<thead>";
echo "<tr>";
echo "<th>H</th>";
echo "<th>Payroll Date</th>";
echo "<td>".date('m/d/Y', strtotime($payrollDatefin))."</td>";
echo "<th>Payroll Time</th>";
echo "<th></th>";


// query total Amount & Total count
$res19query=""; $result19=""; $found19=0; $ctr19=0; $net_pay19=0; $totalAmount=0;
// if($idpaygroup==0) {
// $res19query="SELECT tblemppayroll.employeeid, tblemppayroll.net_pay FROM tblemppayroll WHERE tblemppayroll.cut_start=\"$idcutoff\" AND tblemppayroll.fk_idhrtapaygrp=0 AND tblemppayroll.fk_idhrtacutoff=0";
// } else {
$res19query="SELECT tblemppayroll.employeeid, tblemppayroll.net_pay FROM tblemppayroll WHERE tblemppayroll.cut_start=\"$cut_start21\" AND tblemppayroll.fk_idhrtapaygrp=$idpaygroup AND tblemppayroll.fk_idhrtacutoff=$idcutoff";
// $res19query="SELECT tblemppayroll.employeeid, SUM(tblemppayroll.net_pay) AS totalnetpay FROM tblemppayroll WHERE tblemppayroll.cut_start=\"$cut_start21\" AND tblemppayroll.fk_idhrtapaygrp=$idpaygroup AND tblemppayroll.fk_idhrtacutoff=$idcutoff";
// $res19query="SELECT tblemppayroll.employeeid, tblemppayroll.net_pay FROM tblemppayroll WHERE tblemppayroll.fk_idhrtapaygrp=$idpaygroup AND tblemppayroll.fk_idhrtacutoff=$idcutoff";
// } //if-else
$result19=$dbh2->query($res19query);
if($result19->num_rows>0) {
	while($myrow19=$result19->fetch_assoc()) {
		$found19=1; $ctr19++;
		$employeeid19= $myrow19['employeeid'];
		$net_pay19 = $myrow19['net_pay'];
		$totalnetpay19 = $myrow19['totalnetpay'];
		$totalAmount += $net_pay19;
	} //while
} //if

echo "<th>Total Amount</th>";
echo "<td>";
// echo "$res19query<br>$totalAmount|$totalnetpay19<br>";
echo "$totalAmount</td>";

echo "<th>Total Count</th>";
echo "<td>$ctr19</td>";


$res20query=""; $result20=""; $found20=0; $ctr20=0;
$res20query="SELECT compacctnumber FROM tblbpipayrollfilespec WHERE bpipayrollfilespecid=1 LIMIT 1";
$result20=$dbh2->query($res20query);
if($result20->num_rows>0) {
	while($myrow20=$result20->fetch_assoc()) {
		$found20=1; $ctr20++;
		$compacctnumber20 = $myrow20['compacctnumber'];
	} //while
} //if
echo "<th>Funding Account</th>";
// echo "<td>$payrollAcctNumBPIPKII</td>";
echo "<td>"; print str_pad($compacctnumber20, 10, "0", STR_PAD_LEFT); echo "</td>";

echo "</tr>";
echo "</thead>";

echo "<body>";
// insert blank line
echo "<tr class='exclude-from-export'><td colspan = '9'></tr>";
echo "<tr><th></th><th>Name</th>
<th>Account Number</th>
<th>Net Pay</th>
</tr>";

// query employee salary
$res18query=""; $result18=""; $found18=0; $ctr18=0;
/*
if($idpaygroup==0) {
	
$res18query="SELECT tblemppayroll.employeeid, tblemppayroll.net_pay, tblbankacct.acct_num, tblcontact.name_last, tblcontact.name_first FROM tblemppayroll LEFT JOIN tblbankacct ON tblemppayroll.employeeid=tblbankacct.employeeid LEFT JOIN tblcontact ON tblemppayroll.employeeid=tblcontact.employeeid WHERE tblemppayroll.cut_start=\"$cut_start15\" AND tblbankacct.payrolldflt=1 AND tblcontact.contact_type=\"personnel\" AND tblemppayroll.fk_idhrtapaygrp=0 AND tblemppayroll.fk_idhrtacutoff=0 ORDER BY tblemppayroll.emp_dep ASC, tblcontact.name_last ASC, tblcontact.name_first ASC";	

} else {
	
$res18query="SELECT tblemppayroll.employeeid, tblemppayroll.net_pay, tblbankacct.acct_num, tblcontact.name_last, tblcontact.name_first FROM tblemppayroll LEFT JOIN tblbankacct ON tblemppayroll.employeeid=tblbankacct.employeeid LEFT JOIN tblcontact ON tblemppayroll.employeeid=tblcontact.employeeid WHERE tblemppayroll.cut_start=\"$cut_start15\" AND tblbankacct.payrolldflt=1 AND tblcontact.contact_type=\"personnel\" AND tblemppayroll.fk_idhrtapaygrp=$idpaygroup AND tblemppayroll.fk_idhrtacutoff=$idcutoff ORDER BY tblemppayroll.emp_dep ASC, tblcontact.name_last ASC, tblcontact.name_first ASC";

} //if-else
*/
$res18query="SELECT tblemppayroll.employeeid, tblemppayroll.net_pay, tblbankacct.acct_num, tblcontact.name_last, tblcontact.name_first FROM tblemppayroll LEFT JOIN tblbankacct ON tblemppayroll.employeeid=tblbankacct.employeeid LEFT JOIN tblcontact ON tblemppayroll.employeeid=tblcontact.employeeid WHERE tblemppayroll.cut_start=\"$cut_start21\" AND tblbankacct.payrolldflt=1 AND tblcontact.contact_type=\"personnel\" AND tblemppayroll.fk_idhrtapaygrp=$idpaygroup AND tblemppayroll.fk_idhrtacutoff=$idcutoff ORDER BY tblemppayroll.emp_dep ASC, tblcontact.name_last ASC, tblcontact.name_first ASC";
$result18=$dbh2->query($res18query);
if($result18->num_rows>0) {
	while($myrow18=$result18->fetch_assoc()) {
		$found18=1; $ctr18++;
    $employeeid18 = $myrow18['employeeid'];
	$net_pay18 = $myrow18['net_pay'];
	$acct_num18 = $myrow18['acct_num'];
	$name_last18 = $myrow18['name_last'];
	$name_first18 = $myrow18['name_first'];
	echo "<tr>";
	echo "<td>D</td>";
	echo "<td>".htmlspecialchars($name_first18)." ".htmlspecialchars($name_last18)."</td>";
	echo "<td class='text-center'>";
	// echo "<td class='text-center'>".strval(str_replace("-", "", str_replace(" ", "", $acct_num18)))."</td>";
	// print str_pad(htmlspecialchars(strval(str_replace("-", "", str_replace(" ", "", $acct_num18)))), 10, "0", STR_PAD_LEFT);
	print substr(strval(str_replace("-", "", str_replace(" ", "", $acct_num18))), -10);
	echo "</td>";
	echo "<td class='text-right'>$net_pay18</td>";
	// echo "<td colspan=7></td>";
	echo "</tr>";
	} //while
} //if

// echo "<tr><td colspan='11'>test $res18query<br></td></tr>";

echo "</body>";
echo "</table>";
?>