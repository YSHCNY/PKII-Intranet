<?php

include("db1.php");

$loginid = $_GET['loginid'];
$cutoffdate = $_GET['codate'];

$from = $_POST['from'];
$to = $_POST['to'];
$cc = $_POST['cc'];
$bcc = $_POST['bcc'];
$subject = $_POST['subject'];
$header = $_POST['header'];
$footer = $_POST['footer'];
$notes = $_POST['notes'];

// $message = "$header\n\n$salary\n\n$footer\n\n$notes<br>";

// echo "<html>";

// echo "<pre>";

// set content-type to html
$mailheader = "MIME-Version: 1.0" . "\r\n";
$mailheader .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// additional headers
$mailheader .= "From:" . $from . "\r\n";
$mailheader .= "Cc:" . $cc . "\r\n";
// $mailheader .= 'Bcc:$bcc' . "\r\n";

$message = "";
$message = $message . "<html><head><title>PKII - List of Expiring Contracts</title></head><body>";
$message = $message . "<h2><font color=blue>Philkoei International Inc. - List of Expiring Contracts</font></h2>";
$message = $message . "<p>$header</p>";

// start list of expiring contracts

$message = $message . "<table border=1 spacing=0><tr><th>Count</th><th>ContractRef#</th><th>Employee#</th><th>LastName</th><th>FirstName</th><th>Project</th><th>Position</th><th>From</th><th>To</th><th>Remarks</th><th colspan=\"3\">Salary</th><th colspan=\"3\">Incentive allowance</th><th colspan=\"3\">Project allowance</th><th colspan=\"3\">Field allowance</th><th colspan=\"3\">Accommodation allowance</th><th colspan=\"3\">Transpo allowance</th><th colspan=\"3\">Communication allowance</th><th colspan=\"2\">Per diem</th><th colspan=\"2\">Ecola1</th><th colspan=\"2\">Ecola2</th></tr>";

     $ctr4 = 0;

     $result4 = mysql_query("SELECT projassignexpiringid, cutoffdate, cutoffname, projassignid, projassign0id, employeeid, remarks, stat_finalized, stat_emailed FROM tblprojassignexpiring WHERE cutoffdate = \"$cutoffdate\"", $dbh);
     while($myrow4 = mysql_fetch_row($result4))
     {
	$found4 = 1;
	$ctr4++;
	$projassignexpiringid = $myrow4[0];
	$cutoffdate = $myrow4[1];
	$cutoffname = $myrow4[2];
	$projassignid = $myrow4[3];
	$projassign0id = $myrow4[4];
	$employeeid = $myrow4[5];
	$remarks = $myrow4[6];
	$stat_finalized = $myrow4[7];
	$stat_emailed = $myrow4[8];

//	echo "vartest ctr:$ctr4 id:$projassignexpiringid prjid:$projassignid eid:$employeeid<br>";

	$result5 = mysql_query("SELECT projassignid, ref_no, employeeid, proj_code, proj_name, position, salary, salarycurrency, salarytype, allow_inc, allow_inc_currency, allow_inc_paytype, allow_proj, allow_proj_currency, allow_proj_paytype, ecola1, ecola1_currency, ecola2, ecola2_currency, allow_field_currency, allow_field_paytype, allow_field, allow_accomm, allow_accomm_currency, allow_accomm_paytype, allow_transpo, allow_transpo_currency, allow_transpo_paytype, allow_comm, allow_comm_currency, allow_comm_paytype, perdiem, perdiem_currency, durationfrom, durationto, durationfrom2, durationto2 FROM tblprojassign WHERE projassignid = \"$projassignid\" AND employeeid = \"$employeeid\" ORDER BY durationto DESC, durationto2 DESC", $dbh);
	while($myrow5 = mysql_fetch_row($result5))
	{
	  $found5 = 1;
//	  $projassignid = $myrow5[0];
	  $ref_no = $myrow5[1];
//	  $employeeid = $myrow5[2];
	  $proj_code = $myrow5[3];
	  $proj_name = $myrow5[4];
	  $position = $myrow5[5];
	  $salary = $myrow5[6];
		$salarycurrency = $myrow5[7];
		$salarytype = $myrow5[8];
		$allow_inc = $myrow5[9];
		$allow_inc_currency = $myrow5[10];
		$allow_inc_paytype = $myrow5[11];
		$allow_proj = $myrow5[12];
		$allow_proj_currency = $myrow5[13];
		$allow_proj_paytype = $myrow5[14];
		$ecola1 = $myrow5[15];
		$ecola1_currency = $myrow5[16];
		$ecola2 = $myrow5[17];
		$ecola2_currency = $myrow5[18];
		$allow_field_currency = $myrow5[19];
		$allow_field_paytype = $myrow5[20];
		$allow_field = $myrow5[21];
		$allow_accomm = $myrow5[22];
		$allow_accomm_currency = $myrow5[23];
		$allow_accomm_paytype = $myrow5[24];
		$allow_transpo = $myrow5[25];
		$allow_transpo_currency = $myrow5[26];
		$allow_transpo_paytype = $myrow5[27];
		$allow_comm = $myrow5[28];
		$allow_comm_currency = $myrow5[29];
		$allow_comm_paytype = $myrow5[30];
		$perdiem = $myrow5[31];
		$perdiem_currency = $myrow5[32];
	  $durationfrom = $myrow5[33];
	  $durationto = $myrow5[34];
	  $durationfrom2 = $myrow5[35];
	  $durationto2 = $myrow5[36];

	  if ($durationto2 <> '')
	  {
	    if ($durationto2 <> '0000-00-00')
	    {
	      if ($durationto2 <= "$cutoffdate")
	      {
		$durationto = $durationto2;
	      }
	    }
	  }

	  $result6 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = \"$employeeid\"", $dbh);
	  while($myrow6 = mysql_fetch_row($result6))
	  {
	    $found6 = 1;
//	    $employeeid6 = $myrow6[0];
	    $name_last6 = $myrow6[1];
	    $name_first6 = $myrow6[2];
	    $name_middle6 = $myrow6[3];

	    $message = $message . "<tr><td>$ctr4</td><td>$ref_no</td><td>$employeeid</td><td>$name_last6</td><td>$name_first6</td><td>$proj_name</td><td>$position</td><td>$durationfrom</td><td>$durationto</td><td>&nbsp;</td>";

	// insert salaries & allowances here...
	if($salary != 0 || $salary > 0) {
		$message = $message . "<td align=\"right\">".number_format($salary, 2)."</td><td>$salarycurrency</td><td>$salarytype</td>";
	} else {
		$message = $message . "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
	}
	if($allow_inc != 0 || $allow_inc > 0) {
		$message = $message . "<td align=\"right\">".number_format($allow_inc, 2)."</td><td>$allow_inc_currency</td><td>$allow_inc_paytype</td>";
	} else {
		$message = $message . "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
	}
	if($allow_proj != 0 || $allow_proj > 0) {
		$message = $message . "<td align=\"right\">".number_format($allow_proj, 2)."</td><td>$allow_proj_currency</td><td>$allow_proj_paytype</td>";
	} else {
		$message = $message . "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
	}
	if($allow_field != 0 || $allow_field > 0) {
		$message = $message . "<td align=\"right\">".number_format($allow_field, 2)."</td><td>$allow_field_currency</td><td>$allow_field_paytype</td>";
	} else {
		$message = $message . "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
	}
	if($allow_accomm != 0 || $allow_accomm > 0) {
		$message = $message . "<td align=\"right\">".number_format($allow_accomm, 2)."</td><td>$allow_accomm_currency</td><td>$allow_accomm_paytype</td>";
	} else {
		$message = $message . "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
	}
	if($allow_transpo != 0 || $allow_transpo > 0) {
		$message = $message . "<td align=\"right\">".number_format($allow_transpo, 2)."</td><td>$allow_transpo_currency</td><td>$allow_transpo_paytype</td>";
	} else {
		$message = $message . "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
	}
	if($allow_comm != 0 || $allow_comm > 0) {
		$message = $message . "<td align=\"right\">".number_format($allow_comm, 2)."</td><td>$allow_comm_currency</td><td>$allow_comm_paytype</td>";
	} else {
		$message = $message . "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
	}
	if($perdiem != 0 || $perdiem > 0) {
		$message = $message . "<td align=\"right\">".number_format($perdiem, 2)."</td><td>$perdiem_currency</td>";
	} else {
		$message = $message . "<td>&nbsp;</td><td>&nbsp;</td>";
	}
	if($ecola1 != 0 || $ecola1 > 0) {
		$message = $message . "<td align=\"right\">".number_format($ecola1, 2)."</td><td>$ecola1_currency</td>";
	} else {
		$message = $message . "<td>&nbsp;</td><td>&nbsp;</td>";
	}
	if($ecola2 != 0 || $ecola2 > 0) {
		$message = $message . "<td align=\"right\">$ecola2</td><td>$ecola2_currency</td>";
	} else {
		$message = $message . "<td>&nbsp;</td><td>&nbsp;</td>";
	}

			$message = $message . "</tr>";

	  }
	}

	$result7 = mysql_query("SELECT projectassign0id, ref_no, employeeid1, name_last, name_first, name_middle, proj_code, proj_name, position, durationfrom, durationto, durationfrom2, durationto2 FROM tblprojassign0 WHERE projectassign0id = \"$projassign0id\" AND employeeid1 = \"$employeeid\" ORDER BY durationto DESC, durationto2 DESC", $dbh);
	while($myrow7 = mysql_fetch_row($result7))
	{
	  $found7 = 1;
	  $projectassign0id = $myrow7[0];
	  $ref_no12 = $myrow7[1];
	  $employeeid12 = $myrow7[2];
	  $name_last12 = $myrow7[3];
	  $name_first12 = $myrow7[4];
	  $name_middle12 = $myrow7[5];
	  $proj_code12 = $myrow7[6];
	  $proj_name12 = $myrow7[7];
	  $position12 = $myrow7[8];
	  $durationfrom12 = $myrow7[9];
	  $durationto12 = $myrow7[10];
	  $durationfrom212 = $myrow7[11];
	  $durationto212 = $myrow7[12];

	  if ($durationto212 <> '')
	  {
	    if ($durationto212 <> '0000-00-00')
	    {
	      if ($durationto212 <= "$cutoffdate")
	      { 
		$durationto12 = $durationto212;
	      }
	    }
	  }

	  $message = $message . "<tr><td>$ctr4</td><td>$ref_no12</td><td>$employeeid12</td><td>$name_last12</td><td>$name_first12</td><td>$proj_name12</td><td>$position12</td><td>$durationfrom12</td><td>$durationto12</td></tr>";

	}

     }
// end list of expiring contracts

$message = $message . "</table>";
$message = $message . "<p>$footer</p>";
$message = $message . "<p>$notes</p>";
$message = $message . "</body></html>";

// echo "</html>";
// echo "</pre>";

echo "$message<br>";

$ok = "";

$ok = mail("$to", "$subject", "$message", "$mailheader");

     if ($ok)
     {
          echo "<p>Congratulations your email has been sent</p>";

          $processed = $processed . $message . "------------------------------------------------------------------------------------------------------------\n";

     }
     else
     {
          echo "<p><font color=red>Sorry, the email was not sent. Pls try again.</font></p>";
     }

     echo "to:$to<hr>";


// $File = "/var/www/admin/logs/". date("y-m-d_H:i:s", time()) . "_ExpiringContracts_" . $cutoffdate . ".txt";
// $Handle = fopen($File, 'w');
// $Data = "$processed"; 
// fwrite($Handle, $Data);
// fclose($Handle);

echo "<p><FORM><INPUT TYPE='BUTTON' VALUE='Close Window' onClick='window.close()'></FORM></p>";

echo "</html>";

mysql_close($dbh);

function FormatMoney($number) {
    $number = preg_replace("/[^0-9\.]/", "", str_replace(',','.',$number));
    if (substr($number,-3,1)=='.') {
        $sents = '.'.substr($number,-2);
        $number = substr($number,0,strlen($number)-3);
    } elseif (substr($number,-2,1)=='.') {
        $sents = '.'.substr($number,-1);
        $number = substr($number,0,strlen($number)-2);
    } else {
        $sents = '.00';
    }
    $number = preg_replace("/[^0-9]/", "", $number);
    return 'P' . number_format($number.$sents,2,'.','');
}
?>