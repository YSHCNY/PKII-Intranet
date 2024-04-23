<?php
//
// vpayslipsumm.php
// fr: vc/index.php

?>


	<div class="row">
		<div class="col-md-12"><h3>My Payslip Summary</h3></div>
	</div>

	<div class="row">
	
	
		
		
<table class="table" align="left" border="1">

<?php
	// query tblemployee, tblcontact
	 
	 include ("../m/qpayrollsumm.php");
	
	  
	 echo"<tr><th colspan=16><font size=1>Payslip Summary</font></th></tr>";
	 echo "<tr><th colspan=16> $name_last, $name_first $name_middle - $position</font></th></tr>";
	
	
	 echo "<tr><th align=center>start</th><th align=center>end</th><th align=center>rate</th><th align=center>lateabsent</th><th align=center>netbasicpay</th><th align=center>totalovertime</th><th align=center>otherincometaxable</th><th align=center>otherincome</th><th align=center>grosspay</th><th align=center>wtax</th><th align=center>deduction</th><th align=center>philhealth</th><th align=center>pagibig</th><th align=center>otherdeductions</th><th align=center>totaldeductions</th><th align=center>netpay</th></tr>";
		
	
	
	  echo "<tr><td>$cut_start</td><td>$cut_end</td><td align=right>$payrate</td><td align=right>$totallateabsent</td><td align=right>$netbasicpay</td><td align=right>$totalovertime</td><td align=right>$otherincometaxable</td><td align=right>$otherincome</td><td align=right>$grosspay</td><td align=right>$tax</td><td align=right>$deduction</td><td align=right>$philemp</td><td align=right>$pagibig</td><td align=right>$otherdeduction</td><td align=right>$deductionstotal</td><td align=right>$net_pay</td></tr>";
	
	
	  echo"<table>";
	
	
?>	
	

	
	</tbody>
</table>

		<div class="col-md-3"></div>
	</div>