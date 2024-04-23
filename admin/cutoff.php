<?php 

require_once("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeetype = (isset($_POST['employeetype'])) ? $_POST['employeetype'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> Employees' payslip email notifier</font></p>";

     echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th width=700>Employees' Payslip</th></tr>";

		// custom cutoff
		echo "<tr><th>";
		echo "Custom cutoff period";
		echo "</th></tr>";
		echo "<tr><td>";
		echo "<table class='fin'>";
		echo "<tr>";
		echo "<form action='emppaycutoffcrea.php?loginid=$loginid' method='POST' name='emppaycutoffcrea'>";	
		echo "<td><button type='submit' class='btn btn-primary'>Create cutoff</button></td>";
		echo "</form>";		
		echo "<form action='emppaycutoffaddremove.php?loginid=$loginid' method='POST' name='emppaycutoffaddremove'>";	
		echo "<td><button type='submit' class='btn btn-primary'>Add/Remove personnel</button></td>";
		echo "</form>";		
		echo "<form action='emppaycutoffedt.php?loginid=$loginid' method='POST' name='emppaycutoffedt'>";	
		echo "<td><button type='submit' class='btn btn-primary'>Edit summary</button></td>";
		echo "</form>";		
		echo "<form action='emppaycutoffsubt.php?loginid=$loginid&t=int' method='POST' name='emppaycutoffsubt'>";
		echo "<td><button type='submit' class='btn btn-primary'>Edit nontaxable income</button></td>";
		echo "</form>";		
		echo "<form action='emppaycutoffsubt.php?loginid=$loginid&t=it' method='POST' name='emppaycutoffsubt'>";	
		echo "<td><button type='submit' class='btn btn-primary'>Edit taxable income</button></td>";
		echo "</form>";		
		echo "<form action='emppaycutoffsubt.php?loginid=$loginid&t=od' method='POST' name='emppaycutoffsubt'>";	
		echo "<td><button type='submit' class='btn btn-primary'>Edit other deductions</button></td>";
		echo "</form>";		
		echo "</tr>";
		echo "</table>";
		echo "</td></tr>";
		// re-computation buttons for 2018
		echo "<tr><th>";
		echo "Re-computations for 2018";
		echo "</th></tr>";
		echo "<tr><td>";
		echo "<table>";
		echo "<tr>";
		echo "<form action=\"emppaycmpwtaxphlhlth2018.php?loginid=$loginid\" method=\"POST\" name=\"emppaycmpwtaxphlhlth2018\">";
		// echo "<td><input type=\"submit\" value=\"2018 WTAX & Philhealth + SSS 2019\"></td>";
    echo "<td><button type=\"submit\" class=\"btn btn-primary\">2020 WTAX & Philhealth + SSS>=2019</button></td>";
		echo "</form>";
		echo "</tr>";
		echo "</table>";
		echo "</td></tr>";

		echo "<tr><th>";
		echo "Reports Generation";
		echo "</th></tr>";
		// reports buttons
		echo "<tr><td>";
		echo "<table>";
		echo "<tr>";
		echo "<form action=\"emppayrptbasic.php?loginid=$loginid\" method=\"post\" name=\"basic\">";
		// echo "<td align=\"center\"><input type=\"submit\" value=\"basic\"></td></form>";
    echo "<td><button type=\"submit\" class=\"btn btn-primary\">basic</button></td>";
		/*
		echo "<form action=\"emppayrptbasicallow.php?loginid=$loginid\" method=\"post\" name=\"basic_allow\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"basic allow\"></td></form>";
		echo "<form action=\"emppayrptbasicvouch.php?loginid=$loginid\" method=\"post\" name=\"basic_voucher\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"basic voucher\"></td></form>";
		*/
		echo "<form action=\"emppayrptovertime.php?loginid=$loginid\" method=\"post\" name=\"overtime\">";
		// echo "<td align=\"center\"><input type=\"submit\" value=\"overtime\"></td></form>";
    echo "<td><button type=\"submit\" class=\"btn btn-primary\">overtime</button></td>";
		/*
		echo "<form action=\"emppayrptotallow.php?loginid=$loginid\" method=\"post\" name=\"ot_allow\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"ot allow\"></td></form>";
		echo "<form action=\"emppayrptotvouch.php?loginid=$loginid\" method=\"post\" name=\"ot_voucher\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"ot voucher\"></td></form>";
		echo "</tr><tr>";
		*/
		echo "<form action=\"emppayrptincentive.php?loginid=$loginid\" method=\"post\" name=\"incentive\">";
		// echo "<td align=\"center\"><input type=\"submit\" value=\"incentive\"></td></form>";
    echo "<td><button type=\"submit\" class=\"btn btn-primary\">incentive</button></td>";
		/*
		echo "<form action=\"emppayrptincentvouch.php?loginid=$loginid\" method=\"post\" name=\"incentive_voucher\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"incentive voucher\"></td></form>";
		echo "<form action=\"emppayrptproject.php?loginid=$loginid\" method=\"post\" name=\"project\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"project\"></td></form>";
		echo "<form action=\"emppayrptprojvouch.php?loginid=$loginid\" method=\"post\" name=\"project_voucher\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"project voucher\"></td></form>";
		echo "<form action=\"emppayrptcola.php?loginid=$loginid\" method=\"post\" name=\"cola\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"cola\"></td></form>";
		echo "<form action=\"emppayrptcolavouch.php?loginid=$loginid\" method=\"post\" name=\"cola_voucher\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"cola voucher\"></td></form>";
		echo "</tr><tr>";
		*/
		echo "<form action=\"emppayrpttax.php?loginid=$loginid\" method=\"post\" name=\"tax\">";
		// echo "<td align=\"center\"><input type=\"submit\" value=\"tax\"></td></form>";
    echo "<td><button type=\"submit\" class=\"btn btn-primary\">tax</button></td>";
		/*
		echo "<form action=\"emppayrptbonus.php?loginid=$loginid\" method=\"post\" name=\"bonus\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"bonus\"></td></form>";
		echo "<form action=\"emppayrptleave.php?loginid=$loginid\" method=\"post\" name=\"leave\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"leave\"></td></form>";
		echo "<form action=\"emppayrptfinalpay.php?loginid=$loginid\" method=\"post\" name=\"final_pay\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"final pay\"></td></form>";
		*/
		echo "<form action=\"emppayrptsss.php?loginid=$loginid\" method=\"post\" name=\"sss\">";
		// echo "<td align=\"center\"><input type=\"submit\" value=\"sss\"></td>";
    echo "<td><button type=\"submit\" class=\"btn btn-primary\">sss</button></td>";
    echo "</form>";
		echo "<form action=\"emppayrptphilhealth.php?loginid=$loginid\" method=\"post\" name=\"philhealth\">";
		// echo "<td align=\"center\"><input type=\"submit\" value=\"philhealth\"></td>";
    echo "<td><button type=\"submit\" class=\"btn btn-primary\">philhealth</button></td>";
    echo "</form>";
		// 20180125 cutoff summary
		echo "<form action=\"emppayrptcutoffsumm.php?loginid=$loginid\" method=\"post\" name=\"emppayrptcutoffsumm\">";
		// echo "<td align=\"center\"><input type=\"submit\" value=\"cut-off summary\"></td>";
    echo "<td><button type=\"submit\" class=\"btn btn-primary\">cut-off summary</button></td>";
    echo "</form>";
		// 20200118 2020 recomputation
		echo "<form action=\"emppayrptrecompute.php?loginid=$loginid\" method=\"post\" name=\"emppayrptrecompute\">";
    echo "<td><button type=\"submit\" class=\"btn btn-primary\">2020 re-computations</button></td>";
    echo "</form>";
    echo "</tr>";
		echo "</table>";
		echo "</td></tr>";
	
	// 20190413 bpi bizlink file export
	echo "<tr><th>BPI BizLink File Format</th></tr>";
    echo "<form action=\"bpibzlnkfmt01.php?loginid=$loginid\" method=\"POST\" name=\"bpibizlink\">";
	echo "<input type=\"hidden\" name=\"\" value=\"\">";
	echo "<tr><td>";
	echo "<select name=\"cutoff\">";
		$resquery = "SELECT DISTINCT cut_start, cut_end FROM tblemppayroll ORDER BY cut_start DESC";
		$result="";
		$result=$dbh2->query($resquery);
		if($result->num_rows>0) {
			while($myrow=$result->fetch_assoc()) {
			$cut_start = $myrow['cut_start'];
			$cut_end = $myrow['cut_end'];
			echo "<option value='$cut_start $cut_end'>$cut_start to $cut_end</option>";			
			} // while($myrow=$result->fetch_assoc())
		} // if($result->num_rows>0)
	echo "</select>";
	// echo "<input type=\"submit\" value=\"Submit\">";
  echo "<button type=\"submit\" class=\"btn btn-success\">Submit</button>";
	echo "</td></tr></form>";
	
     echo "<tr><th width=1000>Email Notifier</th></tr>";
     echo "<form action=emailnotifier.php?loginid=$loginid method=POST target=frame>";
    
     echo "<tr><td>Select Payroll Period<br>";   
     echo "<select name=cutoff>";
		$resquery = "SELECT DISTINCT cut_start, cut_end FROM tblemppayroll ORDER BY cut_start DESC";
		$result="";
		$result=$dbh2->query($resquery);
		if($result->num_rows>0) {
			while($myrow=$result->fetch_assoc()) {
			$cut_start = $myrow['cut_start'];
			$cut_end = $myrow['cut_end'];
			echo "<option value='$cut_start $cut_end'>$cut_start to $cut_end</option>";			
			} // while($myrow=$result->fetch_assoc())
		} // if($result->num_rows>0)
     echo "</select>";

     // echo "<input type=submit value=Go><br>";
    echo "<button type=\"submit\" class=\"btn btn-success\">Go</button><br>";
   
     echo "Check All<input type=checkbox name=checkall value=yes CHECKED>";

     echo "</form></td></tr>";

     echo "<tr><td><iframe src=blank.htm width=100% height=400 name=frame><iframe></td></tr>";
     echo "</table>";

      include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
