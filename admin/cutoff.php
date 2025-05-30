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

    //  echo "<p><font size=1>Modules >> Employees' payslip email notifier</font></p>";

    //  echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";

    //  echo "<table class=\"\" border=1 spacing=0 cellspacing=0 cellpadding=0>";

	?>
<div class = 'container mx-auto my-4 flex '>
	<div class="shadow p-5">

<?php
     echo "<h3 class = 'fw-bold'>Employees' Payslip</h3>";
	 echo "<p class = 'text-secondary'>Create and customize employees' payslip</p>";

		// custom cutoff
	
		echo "<div class = 'border my-2 p-4 '>";
		
		echo "<p class = ''>Custom cutoff period</p>";
		echo "<div class = 'row text-center '>";

		echo "<div class = 'col-sm'>";
		echo "<form action='emppaycutoffcrea.php?loginid=$loginid' method='POST' name='emppaycutoffcrea'>";	
		echo "<button type='submit' class='btn btn-lg mainbtnclr text-white'>Create cutoff</button>";
		echo "</form>";		
		echo "</div>";

		echo "<div class = 'col-sm'>";		
		echo "<form action='emppaycutoffaddremove.php?loginid=$loginid' method='POST' name='emppaycutoffaddremove'>";	
		echo "<button type='submit' class='btn btn-lg mainbtnclr text-white'>Add/Remove personnel</button>";
		echo "</form>";		
		echo "</div>";

		echo "<div class = 'col-sm'>";		
		echo "<form action='emppaycutoffedt.php?loginid=$loginid' method='POST' name='emppaycutoffedt'>";	
		echo "<button type='submit' class='btn btn-lg mainbtnclr text-white'>Edit summary</button>";
		echo "</form>";		
		echo "</div>";

		echo "<div class = 'col-sm'>";		
		echo "<form action='emppaycutoffsubt.php?loginid=$loginid&t=int' method='POST' name='emppaycutoffsubt'>";
		echo "<button type='submit' class='btn btn-lg mainbtnclr text-white'>Edit nontaxable income</button>";
		echo "</form>";		
		echo "</div>";

		echo "<div class = 'col-sm'>";		
		echo "<form action='emppaycutoffsubt.php?loginid=$loginid&t=it' method='POST' name='emppaycutoffsubt'>";	
		echo "<button type='submit' class='btn btn-lg mainbtnclr text-white'>Edit taxable income</button>";
		echo "</form>";		
		echo "</div>";

		echo "<div class = 'col-sm'>";		
		echo "<form action='emppaycutoffsubt.php?loginid=$loginid&t=od' method='POST' name='emppaycutoffsubt'>";	
		echo "<button type='submit' class='btn btn-lg mainbtnclr text-white'>Edit other deductions</button>";
		echo "</form>";	
		echo "</div>";
		
		echo "</div>";
		echo "</div>";


		// re-computation buttons for 2018
		echo "<div class = 'border my-2 p-4 '>";
		echo "<p>Re-computations for 2018</p>";
		echo "<div class = 'text-center'>";
		echo "<form action=\"emppaycmpwtaxphlhlth2018.php?loginid=$loginid\" method=\"POST\" name=\"emppaycmpwtaxphlhlth2018\">";
		// echo "<td><input type=\"submit\" value=\"2018 WTAX & Philhealth + SSS 2019\"></td>";
    	echo "<button type=\"submit\" class='btn btn-lg mainbtnclr text-white' >2020 WTAX & Philhealth + SSS>=2019</button>";
		echo "</form>";
		echo "</div>";
		echo "</div>";




		// reports buttons
		echo "<div class = 'border my-2 p-4 '>";

		echo "<p>Reports Generation</p>";
		echo "<div class = 'row px-4 '>";

		echo "<div class = ''>";
		echo "<form action=\"emppayrptbasic.php?loginid=$loginid\" method=\"post\" name=\"basic\">";
        echo "<button type=\"submit\" class=\"btn btn-lg mainbtnclr text-white\">basic</button>";
   		 echo "</form>";
			echo "</div>";
			echo "<div class = ''>";
		echo "<form action=\"emppayrptovertime.php?loginid=$loginid\" method=\"post\" name=\"overtime\">";
       echo "<button type=\"submit\" class=\"btn btn-lg mainbtnclr text-white\">overtime</button>";
    		echo "</form>";

			echo "</div>";
			echo "<div class = ''>";
		echo "<form action=\"emppayrptincentive.php?loginid=$loginid\" method=\"post\" name=\"incentive\">";
      	 echo "<button type=\"submit\" class=\"btn btn-lg mainbtnclr text-white\">incentive</button>";
   		echo "</form>";

		   echo "</div>";
		   echo "<div class = ''>";
		echo "<form action=\"emppayrpttax.php?loginid=$loginid\" method=\"post\" name=\"tax\">";
        echo "<button type=\"submit\" class=\"btn btn-lg mainbtnclr text-white\">tax</button>";
   		 echo "</form>";
			echo "</div>";

			echo "<div class = ''>";
		echo "<form action=\"emppayrptsss.php?loginid=$loginid\" method=\"post\" name=\"sss\">";
    echo "<button type=\"submit\" class=\"btn btn-lg mainbtnclr text-white\">sss</button>";
    echo "</form>";
	echo "</div>";

	echo "<div class = ''>";
		echo "<form action=\"emppayrptphilhealth.php?loginid=$loginid\" method=\"post\" name=\"philhealth\">";
    echo "<button type=\"submit\" class=\"btn btn-lg mainbtnclr text-white\">philhealth</button>";
    echo "</form>";
	echo "</div>";

	echo "<div class = ''>";
		echo "<form action=\"emppayrptcutoffsumm.php?loginid=$loginid\" method=\"post\" name=\"emppayrptcutoffsumm\">";
    echo "<button type=\"submit\" class=\"btn btn-lg mainbtnclr text-white\">cut-off summary</button";
    echo "</form>";
	echo "</div>";

	echo "<div class = ''>";
		echo "<form action=\"emppayrptrecompute.php?loginid=$loginid\" method=\"post\" name=\"emppayrptrecompute\">";
    echo "<button type=\"submit\" class=\"btn btn-lg mainbtnclr text-white\">2020 re-computations</button>";
    echo "</form>";
	echo "</div>";

	echo "</div>";
	echo "</div>";




		

		// echo "<td align=\"center\"><input type=\"submit\" value=\"basic\"></td></form>";
		/*
		echo "<form action=\"emppayrptbasicallow.php?loginid=$loginid\" method=\"post\" name=\"basic_allow\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"basic allow\"></td></form>";
		echo "<form action=\"emppayrptbasicvouch.php?loginid=$loginid\" method=\"post\" name=\"basic_voucher\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"basic voucher\"></td></form>";
		*/
		// echo "<td align=\"center\"><input type=\"submit\" value=\"overtime\"></td></form>";
		/*
		echo "<form action=\"emppayrptotallow.php?loginid=$loginid\" method=\"post\" name=\"ot_allow\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"ot allow\"></td></form>";
		echo "<form action=\"emppayrptotvouch.php?loginid=$loginid\" method=\"post\" name=\"ot_voucher\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"ot voucher\"></td></form>";
		echo "</tr><tr>";
		*/
		// echo "<td align=\"center\"><input type=\"submit\" value=\"incentive\"></td></form>";
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
		// echo "<td align=\"center\"><input type=\"submit\" value=\"tax\"></td></form>";
		/*
		echo "<form action=\"emppayrptbonus.php?loginid=$loginid\" method=\"post\" name=\"bonus\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"bonus\"></td></form>";
		echo "<form action=\"emppayrptleave.php?loginid=$loginid\" method=\"post\" name=\"leave\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"leave\"></td></form>";
		echo "<form action=\"emppayrptfinalpay.php?loginid=$loginid\" method=\"post\" name=\"final_pay\">";
		echo "<td align=\"center\"><input type=\"submit\" value=\"final pay\"></td></form>";
		*/
		// echo "<td align=\"center\"><input type=\"submit\" value=\"sss\"></td>";
		// echo "<td align=\"center\"><input type=\"submit\" value=\"philhealth\"></td>";
		// 20180125 cutoff summary
		// echo "<td align=\"center\"><input type=\"submit\" value=\"cut-off summary\"></td>";
		// 20200118 2020 recomputation
	
	// 20190413 bpi bizlink file export
	echo "<div class = 'border my-2 p-4 '>";

	echo "<p>BPI BizLink File Format</p>";


    echo "<form action=\"bpibzlnkfmt01.php?loginid=$loginid\" method=\"POST\" name=\"bpibizlink\">";
	echo "<div class = 'row'>";
	echo "<input type=\"hidden\" name=\"\" value=\"\">";

    echo "<div class = 'col-1 text-center'>";
     echo "Select Payroll Period";  
	 echo "</div>";

	echo "<div class = 'col'>";
	echo "<select class='form-select form-select-lg mb-3' aria-label='.form-select-lg example' name=\"cutoff\">";
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
	echo "</div>";

	// echo "<input type=\"submit\" value=\"Submit\">";
	echo "<div class = 'col'>";
  echo "<button type=\"submit\" class=\"btn btn-lg btn-success\">Submit</button>";
	echo "</div>";

	echo "</div>";
	echo "</form>";

	

	



  
     echo "<form action=emailnotifier.php?loginid=$loginid method=POST target=frame>";
	 echo "<p>Email Notifier</p>";
	 echo "<div class = 'row mb-2 px-2'>";
	
     echo "<div class = 'col-1 text-center'>";
     echo "Select Payroll Period";  
	 echo "</div>";


	 echo "<div class = 'col'>";
     echo "<select  class='form-select form-select-lg mb-3' aria-label='.form-select-lg example' name=cutoff>";
		$resquery = "SELECT DISTINCT cut_start, cut_end FROM tblemppayroll ORDER BY cut_start DESC";
		$result="";
		$result=$dbh2->query($resquery);
		if($result->num_rows>0) {
			while($myrow=$result->fetch_assoc()) {
			$cut_start = $myrow['cut_start'];
			$cut_end = $myrow['cut_end'];
			echo "<option class = 'h5' value='$cut_start $cut_end'>$cut_start to $cut_end</option>";			
			} // while($myrow=$result->fetch_assoc())
		} // if($result->num_rows>0)
     echo "</select>";
	 echo "</div>";

     // echo "<input type=submit value=Go><br>";
	 echo "<div class = 'col'>";
    echo "<button type=\"submit\" class=\"btn btn-lg btn-success\">Submit</button><br>";
    //  echo "Check All<input type=checkbox name=checkall value=yes CHECKED>";
	echo "</div>";
	echo "</div>";


	echo "<div class='custom-control custom-checkbox'>";
	echo "<input type='checkbox' class='h5 custom-control-input'  name=checkall value=yes id='customCheck1' CHECKED>";
	echo " <label class='h5 custom-control-label' for='customCheck1'>Check All</label>";
   	echo "</div>";
   
     echo "</form>";
	 echo "</div>";

	 echo "<div class = 'border my-2'>";
     echo "<iframe src=blank.htm width=100% height=400 name=frame><iframe>";
	echo "</div>";

	 ?>
	</div>
	</div>
	 <?php

      include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
