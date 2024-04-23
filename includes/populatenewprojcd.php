<?php

include("db1.php");

?>

<html>
<body>
<h2>PKII - mysql.maindb - populate new project codes from tblprojcdref</h2>
<font size="1">
<table border="1" spacing="0" cellspacing="0" cellpadding="0">
<tr><th>no</th><th>newprojcd</th><th>oldprojcd</th><th>acronym</th><th>projtitle</th><th>services</th><th>period</th><th>duty</th><th>tables</th><th>action</th></tr>

<?php
	$result1=""; $found1=0;
	$result1 = mysql_query("SELECT projnum1, projcode0, projcode1, projfname1, projsname1, projsvcs1, projperiod1, projduty1 FROM tblprojcdref ORDER BY projnum1 ASC", $dbh);
	if($result1 != "") {
		while($myrow1 = mysql_fetch_row($result1)) {
		$found1 = 1;
		$projnum11 = $myrow1[0];
		$projcode01 = $myrow1[1];
		$projcode11 = $myrow1[2];
		$projfname11 = $myrow1[3];
		$projsname11 = $myrow1[4];
		$projsvcs11 = $myrow1[5];
		$projperiod11 = $myrow1[6];
		$projduty11 = $myrow1[7];

		echo "<tr><td>$projnum11</td><td>$projcode01</td><td>$projcode11</td><td>$projsname11</td><td>$projfname11</td><td>$projsvcs11</td><td>$projperiod11</td><td>$projduty11</td>";

		if($projcode11 != "") {
			// get tblproject1 id
			$result2=""; $found2=0;
			$result2 = mysql_query("SELECT projectid, proj_code FROM tblproject1 WHERE proj_code=\"$projcode11\"", $dbh);
			if($result2 != "") {
				while($myrow2 = mysql_fetch_row($result2)) {
				$found2 = 1;
				$projectid2 = $myrow2[0];
				$proj_code2 = $myrow2[1];
				if($proj_code2 == $projcode11) {
					// update all necessary fields in tblproject1
					if($projsname11 != "") {
						$result3 = mysql_query("UPDATE tblproject1 SET proj_num=\"$projnum11\", proj_code=\"$projcode01\", proj_fname=\"$projfname11\", proj_sname=\"$projsname11\", proj_services=\"$projsvcs11\", proj_period=\"$projperiod11\", proj_duty=\"$projduty11\" WHERE projectid=$projectid2", $dbh);
					} else {
						$result3 = mysql_query("UPDATE tblproject1 SET proj_num=\"$projnum11\", proj_code=\"$projcode01\", proj_fname=\"$projfname11\", proj_services=\"$projsvcs11\", proj_period=\"$projperiod11\", proj_duty=\"$projduty11\" WHERE projectid=$projectid2", $dbh);
					}
					// update all tables with proj_code and projcode fields

		echo "<td>";

		echo "tblcompany id:";
		$result12a=""; $found12a=0;
		$result12a = mysql_query("SELECT companyid FROM tblcompany WHERE proj_code=\"$projcode11\"", $dbh);
		if($result12a != "") {
			while($myrow12a = mysql_fetch_row($result12a)) {
			$found12a = 1;
			$companyid12a = $myrow12a[0];
			$result12b=""; $found12b=0;
			$result12b = mysql_query("UPDATE tblcompany SET proj_code=\"$projcode01\" WHERE proj_code=\"$projcode11\"", $dbh);
			echo "$companyid12a ";
			}
		}
		echo "<br>";

		echo "tblconfipaymemproj id:";
		$result14a=""; $found14a=0;
		$result14a = mysql_query("SELECT confipaymemprojid FROM tblconfipaymemproj WHERE proj_code=\"$projcode11\"", $dbh);
		if($result14a != "") {
			while($myrow14a = mysql_fetch_row($result14a)) {
			$found14a = 1;
			$confipaymemprojid14a = $myrow14a[0];
			$result14b=""; $found14b=0;
			$result14b = mysql_query("UPDATE tblconfipaymemproj SET proj_code=\"$projcode01\" WHERE proj_code=\"$projcode11\"", $dbh);
			echo "$confipaymemprojid14a ";
			}
		}
		echo "<br>";

		echo "tblconfipayrollproj id:";
		$result15a=""; $found15a=0;
		$result15a = mysql_query("SELECT confipayrollprojid FROM tblconfipayrollproj WHERE proj_code=\"$projcode11\"", $dbh);
		if($result15a != "") {
			while($myrow15a = mysql_fetch_row($result15a)) {
			$found15a = 1;
			$confipayrollprojid15a = $myrow15a[0];
			$result15b=""; $found15b=0;
			$result15b = mysql_query("UPDATE tblconfipayrollproj SET proj_code=\"$projcode01\" WHERE proj_code=\"$projcode11\"", $dbh);
			echo "$confipayrollprojid15a ";
			}
		}
		echo "<br>";

		echo "tblcontact id:";
		$result16a=""; $found16a=0;
		$result16a = mysql_query("SELECT contactid FROM tblcontact WHERE proj_code=\"$projcode11\"", $dbh);
		if($result16a != "") {
			while($myrow16a = mysql_fetch_row($result16a)) {
			$found16a = 1;
			$contactid16a = $myrow16a[0];
			$result16b=""; $found16b=0;
			$result16b = mysql_query("UPDATE tblcontact SET proj_code=\"$projcode01\" WHERE proj_code=\"$projcode11\"", $dbh);
			echo "$contactid16a ";
			}
		}
		echo "<br>";

		echo "tblfinacctspayable id:";
		$result17a=""; $found17a=0;
		$result17a = mysql_query("SELECT acctspayableid FROM tblfinacctspayable WHERE projcode=\"$projcode11\"", $dbh);
		if($result17a != "") {
			while($myrow17a = mysql_fetch_row($result17a)) {
			$found17a = 1;
			$acctspayableid17a = $myrow17a[0];
			$result17b=""; $found17b=0;
			$result17b = mysql_query("UPDATE tblfinacctspayable SET projcode=\"$projcode01\" WHERE projcode=\"$projcode11\"", $dbh);
			echo "$acctspayableid17a ";
			}
		}
		echo "<br>";

		echo "tblfincashreceipt id:";
		$result18a=""; $found18a=0;
		$result18a = mysql_query("SELECT cashreceiptid FROM tblfincashreceipt WHERE projcode=\"$projcode11\"", $dbh);
		if($result18a != "") {
			while($myrow18a = mysql_fetch_row($result18a)) {
			$found18a = 1;
			$cashreceiptid18a = $myrow18a[0];
			$result18b=""; $found18b=0;
			$result18b = mysql_query("UPDATE tblfincashreceipt SET projcode=\"$projcode01\" WHERE projcode=\"$projcode11\"", $dbh);
			echo "$cashreceiptid18a ";
			}
		}
		echo "<br>";

		echo "tblfindisbursement id:";
		$result19a=""; $found19a=0;
		$result19a = mysql_query("SELECT disbursementid FROM tblfindisbursement WHERE projcode=\"$projcode11\"", $dbh);
		if($result19a != "") {
			while($myrow19a = mysql_fetch_row($result19a)) {
			$found19a = 1;
			$disbursementid19a = $myrow19a[0];
			$result19b=""; $found19b=0;
			$result19b = mysql_query("UPDATE tblfindisbursement SET projcode=\"$projcode01\" WHERE projcode=\"$projcode11\"", $dbh);
			echo "$disbursementid19a ";
			}
		}
		echo "<br>";

		echo "tblfinjournal id:";
		$result20a=""; $found20a=0;
		$result20a = mysql_query("SELECT journalid FROM tblfinjournal WHERE projcode=\"$projcode11\"", $dbh);
		if($result20a != "") {
			while($myrow20a = mysql_fetch_row($result20a)) {
			$found20a = 1;
			$journalid20a = $myrow20a[0];
			$result20b=""; $found20b=0;
			$result20b = mysql_query("UPDATE tblfinjournal SET projcode=\"$projcode01\" WHERE projcode=\"$projcode11\"", $dbh);
			echo "$journalid20a ";
			}
		}
		echo "<br>";

		echo "tblinsuranceemp id:";
		$result21a=""; $found21a=0;
		$result21a = mysql_query("SELECT insuranceempid  FROM tblinsuranceemp WHERE proj_code=\"$projcode11\"", $dbh);
		if($result21a != "") {
			while($myrow21a = mysql_fetch_row($result21a)) {
			$found21a = 1;
			$insuranceempid21a = $myrow21a[0];
			$result21b=""; $found21b=0;
			$result21b = mysql_query("UPDATE tblinsuranceemp SET proj_code=\"$projcode01\" WHERE proj_code=\"$projcode11\"", $dbh);
			echo "$insuranceempid21a ";
			}
		}
		echo "<br>";

		echo "tblprojassign id:";
		$result22a=""; $found22a=0;
		$result22a = mysql_query("SELECT projassignid FROM tblprojassign WHERE proj_code=\"$projcode11\"", $dbh);
		if($result22a != "") {
			while($myrow22a = mysql_fetch_row($result22a)) {
			$found22a = 1;
			$projassignid22a = $myrow22a[0];
			$result22b=""; $found22b=0;
			$result22b = mysql_query("UPDATE tblprojassign SET proj_code=\"$projcode01\" WHERE proj_code=\"$projcode11\"", $dbh);
			echo "$projassignid22a ";
			}
		}
		echo "<br>";

		echo "tblprojassign0 id:";
		$result23a=""; $found23a=0;
		$result23a = mysql_query("SELECT projectassign0id FROM tblprojassign0 WHERE proj_code=\"$projcode11\"", $dbh);
		if($result23a != "") {
			while($myrow23a = mysql_fetch_row($result23a)) {
			$found23a = 1;
			$projectassign0id23a = $myrow23a[0];
			$result23b=""; $found23b=0;
			$result23b = mysql_query("UPDATE tblprojassign0 SET proj_code=\"$projcode01\" WHERE proj_code=\"$projcode11\"", $dbh);
			echo "$projectassign0id23a ";
			}
		}
		echo "</td>";

				}
				}
			}			
			echo "<td><font color=\"blue\">updated</font></td>";
		} else {
			$result5 = mysql_query("INSERT INTO tblproject1 SET proj_num=\"$projnum11\", proj_code=\"$projcode01\", proj_fname=\"$projfname11\", proj_sname=\"$projsname11\", proj_services=\"$projsvcs11\", proj_period=\"$projperiod11\", proj_duty=\"$projduty11\"", $dbh);
			echo "<td><font color=\"green\">inserted</font></td>";
		}

		echo "</tr>";
		}
	}

mysql_close($dbh);
?>

</table>
</font>
</body>
</html>
