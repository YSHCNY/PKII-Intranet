<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$groupname = $_GET['groupname'];
$cutstart = $_GET['cutstart'];
$cutend = $_GET['cutend'];

$found = 0;

if($loginid != "")
{
     $result = mysql_query("SELECT * FROM tbladminlogin WHERE adminloginid=$loginid", $dbh); 

     while ($myrow = mysql_fetch_row($result))
     {
          $found = 1;
     }
}

if ($found == 1)
{

     header("Content-Type: text/csv");
     header("Content-Disposition: inline; filename=$groupname-$cutstart-$cutend.csv ");

     echo "PHILKOEI INTERNATIONAL INC.\n";
     echo "Payroll Summary - General Admin\n";
     echo "$cutstart -to- $cutend\n\n";

     echo "EmpID,Name,NetBasicPay,OtherIncome,NonTaxableIncome,GrossPay,WithholdingTax,SSS,Philhealth,PagIBIG,OtherDeductions,TotalDeductions,NetPay\n";

     $result = mysql_query("SELECT tblconfipayroll.confipayrollid, tblconfipayroll.employeeid, tblconfipayroll.groupname, tblconfipayroll.cutstart, tblconfipayroll.cutend, tblconfipayroll.netbasicpay, tblconfipayroll.otherincome, tblconfipayroll.otherincomenontaxable, tblconfipayroll.grosspay, tblconfipayroll.withholdingtax, tblconfipayroll.sssee,  tblconfipayroll.ssser, tblconfipayroll.philhealthee, tblconfipayroll.philhealther, tblconfipayroll.pagibiger, tblconfipayroll.pagibigee, tblconfipayroll.otherdeductions, tblconfipayroll.totaldeductions, tblconfipayroll.netpay, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblconfipayroll, tblcontact WHERE groupname = '$groupname' AND cutstart = '$cutstart' AND cutend = '$cutend' AND tblconfipayroll.employeeid = tblcontact.employeeid", $dbh);

     while ($myrow = mysql_fetch_row($result))
     {
	$found = 1;
	$confipayrollid = $myrow[0];
	$employeeid = $myrow[1];
	$groupname= $myrow[2];
	$cutstart = $myrow[3];
	$cutend = $myrow[4];
	$netbasicpay = $myrow[5];
	$otherincome = $myrow[6];
	$otherincomenontaxable = $myrow[7];
	$grosspay = $myrow[8];
	$withholdingtax = $myrow[9];
	$sssee = $myrow[10];
	$ssser = $myrow[11];
	$philhealthee = $myrow[12];
	$philhealther = $myrow[13];
	$pagibiger = $myrow[14];
	$pagibigee = $myrow[15];
	$otherdeductions = $myrow[16];
	$totaldeductions = $myrow[17];
	$netpay = $myrow[18];
	$employeeid2 = $myrow[19];
	$name_last = $myrow[20];
	$name_first = $myrow[21];
	$name_middle = $myrow[22];

	echo "$employeeid,$name_last $name_first $name_middle,$netbasicpay,$otherincome,$otherincomenontaxable,$grosspay,$withholdingtax,$sssee,$philhealthee,$pagibigee,$otherdeductions,$totaldeductions,$netpay\n";

     }

     $result11 = mysql_query("SELECT * FROM tblconfipayrolltotal WHERE groupname = '$groupname' AND cutstart = '$cutstart' AND cutend = '$cutend'", $dbh);

     while ($myrow11 = mysql_fetch_row($result11))
     {
	$found11 = 1;
	$totalnetbasic = $myrow11[6];
	$totalincome = $myrow11[7];
	$totalincomenontax = $myrow11[8];
	$totalgross = $myrow11[9];
	$totalwtax = $myrow11[10];
	$totalsssee = $myrow11[11];
	$totalssser = $myrow11[12];
	$totalsssecer = $myrow11[13];
	$totalsssec = $myrow11[14];
	$totalsss = $myrow11[15];
	$totalphilhealthee = $myrow11[16];
	$totalphilhealther = $myrow11[17];
	$totalphilhealth = $myrow11[18];
	$totalpagibigee = $myrow11[19];
	$totalpagibiger = $myrow11[20];
	$totalpagibig = $myrow11[21];
	$totalotherdeductions = $myrow11[22];
	$totaldeductions2 = $myrow11[23];
	$totalnetpay = $myrow11[24];
     }
     echo ",Total,$totalnetbasic,$totalincome,$totalincomenontax,$totalgross,$totalwtax,$totalsssee,$totalphilhealthee,$totalpagibigee,$totalotherdeductions,$totaldeductions2,$totalnetpay\n";

     echo "\n\n";


// start deductions summary here

     echo "PHILKOEI INTERNATIONAL INC.\n";
     echo "Deduction Summary - General Admin\n";
     echo "$cutstart -to- $cutend\n\n";

     echo "EmpID,Name,TypeOfDeduction,Amount\n";

     $result2 = mysql_query("SELECT tblconfipayrolldeduct.confipayrolldeductid, tblconfipayrolldeduct.employeeid, tblconfipayrolldeduct.groupname, tblconfipayrolldeduct.cutstart, tblconfipayrolldeduct.cutend, tblconfipayrolldeduct.namededuct, tblconfipayrolldeduct.deductamount, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblconfipayrolldeduct, tblcontact WHERE tblconfipayrolldeduct.groupname = '$groupname' AND tblconfipayrolldeduct.cutstart = '$cutstart' AND tblconfipayrolldeduct.cutend = '$cutend' AND tblconfipayrolldeduct.employeeid = tblcontact.employeeid", $dbh);

     while ($myrow2 = mysql_fetch_row($result2))
     {
	$found2 = 1;
	$confipayrolldeductid = $myrow2[0];
	$employeeid = $myrow2[1];
	$groupname = $myrow2[2];
	$cutstart = $myrow2[3];
	$cutend = $myrow2[4];
	$namededuct = $myrow2[5];
	$deductamount = $myrow2[6];
	$employeeid2 = $myrow2[7];
	$name_last = $myrow2[8];
	$name_first = $myrow2[9];
	$name_middle = $myrow2[10];

	echo "$employeeid,$name_last $name_first $name_middle,$namededuct,$deductamount\n";
     }

	$result21 = mysql_query("SELECT * FROM tblconfipayrolltotal WHERE groupname = '$groupname' AND cutstart = '$cutstart' AND cutend = '$cutend'", $dbh);

	while ($myrow21 = mysql_fetch_row($result21))
	{
		$found21 = 1;
		$totalotherdeductions = $myrow21[22];

		echo ",,Total,$totalotherdeductions\n";
	}

     echo "\n\n";


// start additional income summary here taxable

     echo "PHILKOEI INTERNATIONAL INC.\n";
     echo "Other Income Summary - General Admin\n";
     echo "$cutstart -to- $cutend\n\n";

     echo "EmpID,Name,OtherIncomeType,Amount\n";

     $result4 = mysql_query("SELECT confipayrolladdid, employeeid, groupname, cutstart, cutend, nameadd, addamount, nontaxable FROM tblconfipayrolladd WHERE groupname = '$groupname' AND cutstart = '$cutstart' AND cutend = '$cutend' AND  nontaxable != 'yes'", $dbh);

     while ($myrow4 = mysql_fetch_row($result4))
     {
	$found4 = 1;
	$confipayrolladdid = $myrow4[0];
	$employeeid = $myrow4[1];
	$groupname = $myrow4[2];
	$cutstart = $myrow4[3];
	$cutend = $myrow4[4];
	$nameadd = $myrow4[5];
	$addamount = $myrow4[6];
	$nontaxable = $myrow4[7];

	$result41 = mysql_query("SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);

	while ($myrow41 = mysql_fetch_row($result41))
	{
		$found41 = 1;
		$employeeid2 = $myrow41[0];
		$name_first = $myrow41[1];
		$name_middle = $myrow41[2];
		$name_last = $myrow41[3];

		echo "$employeeid,$name_last $name_first $name_middle,$nameadd,$addamount\n";
	}
     }

	$result42 = mysql_query("SELECT * FROM tblconfipayrolltotal WHERE groupname = '$groupname' AND cutstart = '$cutstart' AND cutend = '$cutend'", $dbh);

	while ($myrow42 = mysql_fetch_row($result42))
	{
		$found42 = 1;
		$totalincome = $myrow42[7];

		echo ",,Total,$totalincome\n";
	}

     echo "\n\n";


// start additional income summary here nontaxable

     echo "PHILKOEI INTERNATIONAL INC.\n";
     echo "Non-Taxable Income Summary - General Admin\n";
     echo "$cutstart -to- $cutend\n\n";

     echo "EmpID,Name,OtherIncomeType,Amount,NonTaxable\n";

     $result5 = mysql_query("SELECT confipayrolladdid, employeeid, groupname, cutstart, cutend, nameadd, addamount, nontaxable FROM tblconfipayrolladd WHERE groupname = '$groupname' AND cutstart = '$cutstart' AND cutend = '$cutend' AND  nontaxable = 'yes'", $dbh);

     while ($myrow5 = mysql_fetch_row($result5))
     {
	$found5 = 1;
	$confipayrolladdid = $myrow5[0];
	$employeeid = $myrow5[1];
	$groupname = $myrow5[2];
	$cutstart = $myrow5[3];
	$cutend = $myrow5[4];
	$nameadd = $myrow5[5];
	$addamount = $myrow5[6];
	$nontaxable = $myrow5[7];

	$result51 = mysql_query("SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);

	while ($myrow51 = mysql_fetch_row($result51))
	{
		$found51 = 1;
		$employeeid2 = $myrow51[0];
		$name_first = $myrow51[1];
		$name_middle = $myrow51[2];
		$name_last = $myrow51[3];

		echo "$employeeid,$name_last $name_first $name_middle,$nameadd,$addamount,$nontaxable\n";
	}
     }

	$result52 = mysql_query("SELECT * FROM tblconfipayrolltotal WHERE groupname = '$groupname' AND cutstart = '$cutstart' AND cutend = '$cutend'", $dbh);

	while ($myrow52 = mysql_fetch_row($result52))
	{
		$found52 = 1;
		$totalincomenontax = $myrow52[8];

		echo ",,Total,$totalincomenontax\n";
	}
	echo "\n";

     echo "\n";


// start withholding tax summary here

     echo "PHILKOEI INTERNATIONAL INC.\n";
     echo "Withholding Tax Summary - General Admin\n";
     echo "$cutstart -to- $cutend\n\n";

     echo "EmpID,Name,GrossPay,WithholdingTax\n";

     $result6 = mysql_query("SELECT tblconfipayroll.employeeid, tblconfipayroll.grosspay, tblconfipayroll.withholdingtax, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblconfipayroll, tblcontact WHERE tblconfipayroll.groupname = '$groupname' AND tblconfipayroll.cutstart = '$cutstart' AND tblconfipayroll.cutend = '$cutend' AND tblconfipayroll.employeeid = tblcontact.employeeid", $dbh);

     while ($myrow6 = mysql_fetch_row($result6))
     {
	$found6 = 1;
	$employeeid = $myrow6[0];
	$grosspay = $myrow6[1];
	$withholdingtax = $myrow6[2];
	$name_last = $myrow6[4];
	$name_first = $myrow6[5];
	$name_middle = $myrow6[6];

	echo "$employeeid,$name_last $name_first $name_middle,$grosspay,$withholdingtax\n";

     }

     $result61 = mysql_query("SELECT * FROM tblconfipayrolltotal WHERE groupname = '$groupname' AND cutstart = '$cutstart' AND cutend = '$cutend'", $dbh);

     while ($myrow61 = mysql_fetch_row($result61))
     {
	$found61 = 1;
	$totalgross = $myrow61[9];
	$totalwtax = $myrow61[10];

	echo ",Total,$totalgross,$totalwtax\n";
     }

     echo "\n\n";


// start sss summary here

     echo "PHILKOEI INTERNATIONAL INC.\n";
     echo "SSS Contribution Summary - General Admin\n";
     echo "$cutstart -to- $cutend\n\n";

     echo "EmpID,Name,EE,ER,EC-ER,Total+EC,TotalContribution\n";

     $result7 = mysql_query("SELECT tblconfipayroll.employeeid, tblconfipayroll.sssee, tblconfipayroll.ssser, tblconfipayroll.sssec, tblconfipayroll.ssstotalec, tblconfipayroll.ssstotal, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblconfipayroll, tblcontact WHERE tblconfipayroll.groupname = '$groupname' AND tblconfipayroll.cutstart = '$cutstart' AND tblconfipayroll.cutend = '$cutend' AND tblconfipayroll.employeeid = tblcontact.employeeid", $dbh);

     while ($myrow7 = mysql_fetch_row($result7))
     {
	$found7 = 1;
	$employeeid = $myrow7[0];
	$sssee = $myrow7[1];
	$ssser = $myrow7[2];
	$sssec = $myrow7[3];
	$ssstotalec = $myrow7[4];
	$ssstotal = $myrow7[5];
	$name_last = $myrow7[7];
	$name_first = $myrow7[8];
	$name_middle = $myrow7[9];

	echo "$employeeid,$name_last $name_first $name_middle,$sssee,$ssser,$sssec,$ssstotalec,$ssstotal\n";

     }

     $result71 = mysql_query("SELECT * FROM tblconfipayrolltotal WHERE groupname = '$groupname' AND cutstart = '$cutstart' AND cutend = '$cutend'", $dbh);

     while ($myrow71 = mysql_fetch_row($result71))
     {
	$found71 = 1;
	$totalsssee = $myrow71[11];
	$totalssser = $myrow71[12];
	$totalsssecer = $myrow71[13];
	$totalsssec = $myrow71[14];
	$totalsss = $myrow71[15];

	echo ",Total,$totalsssee,$totalssser,$totalsssecer,$totalsssec,$totalsss\n";
     }

     echo "\n\n";


// start philhealth summary here

     echo "PHILKOEI INTERNATIONAL INC.\n";
     echo "Philhealth Contribution Summary - General Admin\n";
     echo "$cutstart -to- $cutend\n\n";

     echo "EmpID,Name,EE,ER,TotalPremium\n";

     $result8 = mysql_query("SELECT tblconfipayroll.employeeid, tblconfipayroll.philhealthee, tblconfipayroll.philhealther, tblconfipayroll.philhealthtotal, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblconfipayroll, tblcontact WHERE tblconfipayroll.groupname = '$groupname' AND tblconfipayroll.cutstart = '$cutstart' AND tblconfipayroll.cutend = '$cutend' AND tblconfipayroll.employeeid = tblcontact.employeeid", $dbh);

     while ($myrow8 = mysql_fetch_row($result8))
     {
	$found8 = 1;
	$employeeid = $myrow8[0];
	$philhealthee = $myrow8[1];
	$philhealther = $myrow8[2];
	$philhealthtotal = $myrow8[3];
	$name_last = $myrow8[5];
	$name_first = $myrow8[6];
	$name_middle = $myrow8[7];

	echo "$employeeid,$name_last $name_first $name_middle,$philhealthee,$philhealther,$philhealthtotal\n";

     }

     $result81 = mysql_query("SELECT * FROM tblconfipayrolltotal WHERE groupname = '$groupname' AND cutstart = '$cutstart' AND cutend = '$cutend'", $dbh);

     while ($myrow81 = mysql_fetch_row($result81))
     {
	$found81 = 1;
	$totalphilhealthee = $myrow81[16];
	$totalphilhealther = $myrow81[17];
	$totalphilhealth = $myrow81[18];

	echo ",Total,$totalphilhealthee,$totalphilhealther,$totalphilhealth\n";
     }

     echo "\n\n";


// start pagibig summary here

     echo "PHILKOEI INTERNATIONAL INC.\n";
     echo "Pag-IBIG Contribution Summary - General Admin\n";
     echo "$cutstart -to- $cutend\n\n";

     echo "EmpID,Name,EE,ER,Total\n";

     $result9 = mysql_query("SELECT tblconfipayroll.employeeid, tblconfipayroll.pagibigee, tblconfipayroll.pagibiger, tblconfipayroll.pagibigtotal, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblconfipayroll, tblcontact WHERE tblconfipayroll.groupname = '$groupname' AND tblconfipayroll.cutstart = '$cutstart' AND tblconfipayroll.cutend = '$cutend' AND tblconfipayroll.employeeid = tblcontact.employeeid", $dbh);

     while ($myrow9 = mysql_fetch_row($result9))
     {
	$found9 = 1;
	$employeeid = $myrow9[0];
	$pagibigee = $myrow9[1];
	$pagibiger = $myrow9[2];
	$pagibigtotal = $myrow9[3];
	$name_last = $myrow9[5];
	$name_first = $myrow9[6];
	$name_middle = $myrow9[7];

	echo "$employeeid,$name_last $name_first $name_middle,$pagibigee,$pagibiger,$pagibigtotal\n";

     }

     $result91 = mysql_query("SELECT * FROM tblconfipayrolltotal WHERE groupname = '$groupname' AND cutstart = '$cutstart' AND cutend = '$cutend'", $dbh);

     while ($myrow91 = mysql_fetch_row($result91))
     {
	$found91 = 1;
	$totalpagibigee = $myrow91[19];
	$totalpagibiger = $myrow91[20];
	$totalpagibig = $myrow91[21];

	echo ",Total,$totalpagibigee,$totalpagibiger,$totalpagibig\n";
     }

     echo "\n\n";


//     echo "<p><a href=confipay2.php?loginid=$loginid>Back</a><br>";
}
else
{
     echo "<html>";
     
     echo "You are not logged in<br>";
     echo "<a href=login.htm>Login</a><br>";

     echo "</html>";
}

mysql_close($dbh);
?> 
