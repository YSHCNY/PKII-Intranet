<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$pid = $_GET['pid'];

$proj_code = trim($_POST['proj_code']);

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
    include ("header.php");
    include ("sidebar.php");

  echo "<p><b>Modify project code...</b></p>";

  if($accesslevel >= 4 && $accesslevel <= 5)
  {

	echo "<html><body><table class=\"fin\" border=\"1\">";

	$result11=""; $found11=0;
	$result11 = mysql_query("SELECT proj_num, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE projectid=$pid", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$proj_num11 = $myrow11[0];
		$proj_code11 = $myrow11[1];
		$proj_fname11 = $myrow11[2];
		$proj_sname11 = $myrow11[3];
		}
	}

	if($found11 == 1) {
		// update queries on all related tables with proj_code fields
		echo "<tr><th colspan=\"2\">fr:$proj_code11 to:$proj_code</th></tr>";

		echo "<tr><th>tblcompany</th><td>";
		$result12a=""; $found12a=0;
		$result12a = mysql_query("SELECT companyid FROM tblcompany WHERE proj_code=\"$proj_code11\"", $dbh);
		if($result12a != "") {
			while($myrow12a = mysql_fetch_row($result12a)) {
			$found12a = 1;
			$companyid12a = $myrow12a[0];
			$result12b=""; $found12b=0;
			$result12b = mysql_query("UPDATE tblcompany SET proj_code=\"$proj_code\" WHERE proj_code=\"$proj_code11\"", $dbh);
			echo "companyid:$companyid12a<br>";
			}
		}
		echo "</td></tr>";

		echo "<tr><th>tblconfipaymemproj</th><td>";
		$result14a=""; $found14a=0;
		$result14a = mysql_query("SELECT confipaymemprojid FROM tblconfipaymemproj WHERE proj_code=\"$proj_code11\"", $dbh);
		if($result14a != "") {
			while($myrow14a = mysql_fetch_row($result14a)) {
			$found14a = 1;
			$confipaymemprojid14a = $myrow14a[0];
			$result14b=""; $found14b=0;
			$result14b = mysql_query("UPDATE tblconfipaymemproj SET proj_code=\"$proj_code\" WHERE proj_code=\"$proj_code11\"", $dbh);
			echo "confipaymemprojid:$confipaymemprojid14a<br>";
			}
		}
		echo "</td></tr>";

		echo "<tr><th>tblconfipayrollproj</th><td>";
		$result15a=""; $found15a=0;
		$result15a = mysql_query("SELECT confipayrollprojid FROM tblconfipayrollproj WHERE proj_code=\"$proj_code11\"", $dbh);
		if($result15a != "") {
			while($myrow15a = mysql_fetch_row($result15a)) {
			$found15a = 1;
			$confipayrollprojid15a = $myrow15a[0];
			$result15b=""; $found15b=0;
			$result15b = mysql_query("UPDATE tblconfipayrollproj SET proj_code=\"$proj_code\" WHERE proj_code=\"$proj_code11\"", $dbh);
			echo "confipayrollprojid:$confipayrollprojid15a<br>";
			}
		}
		echo "</td></tr>";

		echo "<tr><th>tblcontact</th><td>";
		$result16a=""; $found16a=0;
		$result16a = mysql_query("SELECT contactid FROM tblcontact WHERE proj_code=\"$proj_code11\"", $dbh);
		if($result16a != "") {
			while($myrow16a = mysql_fetch_row($result16a)) {
			$found16a = 1;
			$contactid16a = $myrow16a[0];
			$result16b=""; $found16b=0;
			$result16b = mysql_query("UPDATE tblcontact SET proj_code=\"$proj_code\" WHERE proj_code=\"$proj_code11\"", $dbh);
			echo "contactid:$contactid16a<br>";
			}
		}
		echo "</td></tr>";

		echo "<tr><th>tblfinacctspayable</th><td>";
		$result17a=""; $found17a=0;
		$result17a = mysql_query("SELECT acctspayableid FROM tblfinacctspayable WHERE projcode=\"$proj_code11\"", $dbh);
		if($result17a != "") {
			while($myrow17a = mysql_fetch_row($result17a)) {
			$found17a = 1;
			$acctspayableid17a = $myrow17a[0];
			$result17b=""; $found17b=0;
			$result17b = mysql_query("UPDATE tblfinacctspayable SET projcode=\"$proj_code\" WHERE projcode=\"$proj_code11\"", $dbh);
			echo "acctspayableid:$acctspayableid17a<br>";
			}
		}
		echo "</td></tr>";

		echo "<tr><th>tblfincashreceipt</th><td>";
		$result18a=""; $found18a=0;
		$result18a = mysql_query("SELECT cashreceiptid FROM tblfincashreceipt WHERE projcode=\"$proj_code11\"", $dbh);
		if($result18a != "") {
			while($myrow18a = mysql_fetch_row($result18a)) {
			$found18a = 1;
			$cashreceiptid18a = $myrow18a[0];
			$result18b=""; $found18b=0;
			$result18b = mysql_query("UPDATE tblfincashreceipt SET projcode=\"$proj_code\" WHERE projcode=\"$proj_code11\"", $dbh);
			echo "cashreceiptid:$cashreceiptid18a<br>";
			}
		}
		echo "</td></tr>";

		echo "<tr><th>tblfindisbursement</th><td>";
		$result19a=""; $found19a=0;
		$result19a = mysql_query("SELECT disbursementid FROM tblfindisbursement WHERE projcode=\"$proj_code11\"", $dbh);
		if($result19a != "") {
			while($myrow19a = mysql_fetch_row($result19a)) {
			$found19a = 1;
			$disbursementid19a = $myrow19a[0];
			$result19b=""; $found19b=0;
			$result19b = mysql_query("UPDATE tblfindisbursement SET projcode=\"$proj_code\" WHERE projcode=\"$proj_code11\"", $dbh);
			echo "disbursementid:$disbursementid19a<br>";
			}
		}
		echo "</td></tr>";

		echo "<tr><th>tblfinjournal</th><td>";
		$result20a=""; $found20a=0;
		$result20a = mysql_query("SELECT journalid FROM tblfinjournal WHERE projcode=\"$proj_code11\"", $dbh);
		if($result20a != "") {
			while($myrow20a = mysql_fetch_row($result20a)) {
			$found20a = 1;
			$journalid20a = $myrow20a[0];
			$result20b=""; $found20b=0;
			$result20b = mysql_query("UPDATE tblfinjournal SET projcode=\"$proj_code\" WHERE projcode=\"$proj_code11\"", $dbh);
			echo "journalid:$journalid20a<br>";
			}
		}
		echo "</td></tr>";

		echo "<tr><th>tblinsuranceemp</th><td>";
		$result21a=""; $found21a=0;
		$result21a = mysql_query("SELECT insuranceempid  FROM tblinsuranceemp WHERE proj_code=\"$proj_code11\"", $dbh);
		if($result21a != "") {
			while($myrow21a = mysql_fetch_row($result21a)) {
			$found21a = 1;
			$insuranceempid21a = $myrow21a[0];
			$result21b=""; $found21b=0;
			$result21b = mysql_query("UPDATE tblinsuranceemp SET proj_code=\"$proj_code\" WHERE proj_code=\"$proj_code11\"", $dbh);
			echo "insuranceempid:$insuranceempid21a<br>";
			}
		}
		echo "</td></tr>";

		echo "<tr><th>tblprojassign</th><td>";
		$result22a=""; $found22a=0;
		$result22a = mysql_query("SELECT projassignid FROM tblprojassign WHERE proj_code=\"$proj_code11\"", $dbh);
		if($result22a != "") {
			while($myrow22a = mysql_fetch_row($result22a)) {
			$found22a = 1;
			$projassignid22a = $myrow22a[0];
			$result22b=""; $found22b=0;
			$result22b = mysql_query("UPDATE tblprojassign SET proj_code=\"$proj_code\" WHERE projassignid=$projassignid22a AND proj_code=\"$proj_code11\"", $dbh);
			echo "projassignid:$projassignid22a<br>";
			}
		}
		echo "</td></tr>";

		echo "<tr><th>tblprojassign0</th><td>";
		$result23a=""; $found23a=0;
		$result23a = mysql_query("SELECT projectassign0id FROM tblprojassign0 WHERE proj_code=\"$proj_code11\"", $dbh);
		if($result23a != "") {
			while($myrow23a = mysql_fetch_row($result23a)) {
			$found23a = 1;
			$projectassign0id23a = $myrow23a[0];
			$result23b=""; $found23b=0;
			$result23b = mysql_query("UPDATE tblprojassign0 SET proj_code=\"$proj_code\" WHERE projectassign0id=$projectassign0id23a AND proj_code=\"$proj_code11\"", $dbh);
			echo "projectassign0id:$projectassign0id23a<br>";
			}
		}
		echo "</td></tr>";

		echo "<tr><th>tblproject1</th><td>";
		$result24a=""; $found24a=0;
		$result24a = mysql_query("SELECT projectid FROM tblproject1 WHERE proj_code=\"$proj_code11\"", $dbh);
		if($result24a != "") {
			while($myrow24a = mysql_fetch_row($result24a)) {
			$found24a = 1;
			$projectid24a = $myrow24a[0];
			$result24b=""; $found24b=0;
			$result24b = mysql_query("UPDATE tblproject1 SET proj_code=\"$proj_code\" WHERE proj_code=\"$proj_code11\"", $dbh);
			echo "projectid:$projectid24a<br>";
			}
		}
		echo "</td></tr>";
		
	}

	// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Changed project code from:$proj_code11 to:$proj_code of $proj_sname11 - $proj_fname11";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

		echo "<tr><td colspan=\"2\">login:$loginid | date:$now | user:$adminuid | $adminlogdetails</td></tr>";

	echo "</table></body></html>";

  }


  // header("Location: editproj.php?loginid=$loginid&pid=$pid");
  // exit;

	echo "<p><a href=\"editproj.php?loginid=$loginid&pid=$pid\">Back</a></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

    include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?>
