<?php
//
// finpaysyspostpayslip2.php 20250122
// incl fr finpaysyspostpayslip.php
//
?>
<div class = 'container mx-auto my-4 flex '>
	<div class="shadow p-5">
<?php
?>
<div class='table'><table class='table'>
<thead>
<tr><th>ctr</th><th>EmpID</th><th>Name</th><th>email</th><th>NetPay</th></tr>
</thead>
<body>
<?php
echo "<div class='form'><form action=\"finpaysyspostpayslip3.php?loginid=$loginid\" method=\"POST\" name=\"finpaysyspostpayslip3\">";
echo "<div class='form-group'>";
echo "<input type=\"hidden\" name=\"idpaygroup\" value=\"$idpaygroup\">";
echo "<input type=\"hidden\" name=\"idcutoff\" value=\"$idcutoff\">";

	echo "<div class='custom-control custom-checkbox'>";
	echo "<input type='checkbox' class='h5 custom-control-input'  name='checkall' value='yes' id='customCheck1' CHECKED>";
	echo "<label class='h5 custom-control-label' for='customCheck1'>Check All</label>";
   	echo "</div>";

// query tblemppayroll based idpaygroup and idcutoff
$res16query=""; $result16=""; $found16=0; $ctr16=0;
$res16query="SELECT `tblemppayroll`.`emppayrollid`, `tblemppayroll`.`employeeid`, `tblemppayroll`.`net_pay`, `tblcontact`.`name_last`, `tblcontact`.`name_first`, `tblcontact`.`name_middle`, `tblcontact`.`email1`, `tblcontact`.`email2` FROM `tblemppayroll` LEFT JOIN `tblcontact` ON `tblemppayroll`.`employeeid`=`tblcontact`.`employeeid` WHERE `tblemppayroll`.`fk_idhrtapaygrp`=$idpaygroup AND `tblemppayroll`.`fk_idhrtacutoff`=$idcutoff AND `tblcontact`.`contact_type`=\"personnel\" ORDER BY `tblemppayroll`.`projcode` ASC, `tblcontact`.`name_last` ASC, `tblcontact`.`name_first` ASC";
$result16=$dbh2->query($res16query);
if($result16->num_rows>0) {
	while($myrow16=$result16->fetch_assoc()) {
		$found16=1; $ctr16++;
		$emppayrollid16 = $myrow16['emppayrollid'];
		$employeeid16 = $myrow16['employeeid'];
		$net_pay16 = $myrow16['net_pay'];
		$name_last16 = $myrow16['name_last'];
		$name_first16 = $myrow16['name_first'];
		$name_middle16 = $myrow16['name_middle'];
		$email116 = $myrow16['email1'];
		$email216 = $myrow16['email2'];
		echo "<tr><td>$ctr16</td>";
		// if($checkall=="yes") {
		    echo "<td><input type=\"checkbox\" class='form-check' name=\"employeeid[]\" value=\"$employeeid16\" CHECKED>$employeeid16</td>";			
		// } else {
		    // echo "<td><input type=\"checkbox\" class='form-check' name=\"employeeid[]\" value=\"$employeeid16\">$employeeid16</td>";
		// } //if-else
		echo "<td>$name_last16, $name_first16 $name_middle16[0]</td><td>$email116</td><td>".number_format($net_pay16, 2)."</td>";
		echo "</tr>";
	} //while
} //if
?>
</table></div>
<div class='table'><table class='table'>
<?php
// query tblemailnotifier for the email template
$res17query=""; $result17=""; $found17=0; $ctr17=0;
$res17query="SELECT `from`, `subject`, `header`, `footer`, `notes` FROM `tblemailnotifier` WHERE `notifierid`=0;";
$result17=$dbh2->query($res17query);
if($result17->num_rows>0) {
    while($myrow17 =$result17->fetch_assoc()) {
		$found17=1;
		$from17 = $myrow17['from'];
		$subject17 = $myrow17['subject'];
		$header17 = $myrow17['header'];
		$footer17 = $myrow17['footer'];
		$notes17 = $myrow17['notes'];
		
	} //while
} //if
if($found17==1) {
	//display email template
	echo "<tr><th>From</th><td><input class='form-control' name=\"from\" value=\"$from17\"></td></tr>";
  echo "<tr><th>Subject</th><td><input class='form-control' name=\"subject\" value=\"$subject17\"></td></tr>";
  echo "<tr><th>Header</th><td><textarea class='form-control' name=\"header\" rows=\"3\" cols=\"50\">$header17</textarea></td></tr>";
  echo "<tr><th>Salary Details</th><td><textarea class='form-control' name=\"salary\" rows=\"5\" cols=\"50\">{Payroll sysem shall generate salary details here...}</textarea></td></tr>";
  echo "<tr><th>Footer</th><td><textarea class='form-control' name=\"footer\" rows=\"5\" cols=\"50\">$footer17</textarea></td></tr>";
  echo "<tr><th>Notes</th><td><textarea class='form-control' name=\"notes\" rows=\"5\" cols=\"50\">$notes17</textarea></td></tr>";
  echo "<tr><td colspan='2'><button type=\"submit\" class='btn btn-success' role='button'>Send</button></td></tr>";
} //if
echo "</div>";
echo "</form></div>";
?>
	</div>
</div>
</body>
</table></div>
<?php
// echo "<p>$res16query</p>";
?>