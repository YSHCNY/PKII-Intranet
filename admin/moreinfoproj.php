<?php 

require("db1.php");
include ("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$pid = (isset($_GET['pid'])) ? $_GET['pid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header2.php");
?>
<style>
	p{
		font-family: 'Poppins', sans-serif;
		font-weight: 500;
	}
</style>
<div class="container">
<div class = 'shadow p-5  rounded-4'>

<?php
 
 echo "<div class = 'text-end'><a TYPE=\"BUTTON\" href='projects.php?loginid=$loginid' class = 'px-3 py-2 bg-danger border-0 rounded-3 text-white fs-3 fw-semibold'>×</a></div>";

		/*
     $result = mysql_query("SELECT projectid, proj_num, proj_code, proj_fname, proj_sname, proj_desc, proj_services, proj_period, proj_duty, companyid, date_start, date_end, projstatus, proj_remarks, contactid, employeeid, sw_nk, sw_jica, sw_icg, proj_relation0, proj_relation1, proj_relation2, proj_relation3, proj_class, countrycd, jobtypcd, divisioncd FROM tblproject1 WHERE tblproject1.projectid='$pid'", $dbh);
     while ($myrow = mysql_fetch_row($result))
     {
         $projectid = $myrow[0];
	 $proj_num = $myrow[1];
         $proj_code = $myrow[2];
         $proj_fname = $myrow[3];
         $proj_sname = $myrow[4];
         $proj_desc = $myrow[5];
         $proj_services = $myrow[6];
	 $proj_period = $myrow[7];
	 $proj_duty = $myrow[8];
         $companyid = $myrow[9];
         $date_start = $myrow[10];
         $date_end = $myrow[11];
         $projstatus = $myrow[12];
         $proj_remarks = $myrow[13];
	 $contactid = $myrow[14];
         $employeeid = $myrow[15];
				$sw_nk = $myrow[16];
				$sw_jica = $myrow[17];
				$sw_icg = $myrow[18];
		$proj_relation0 = $myrow[19];
		$proj_relation1 = $myrow[20];
		$proj_relation2 = $myrow[21];
		$proj_relation3 = $myrow[22];
		$proj_class = $myrow[23];
		$countrycd = $myrow[24];
		$jobtypcd = $myrow[25];
		$divisioncd = $myrow[26];
     }
		*/

		$res11query="SELECT projectid, proj_num, proj_code, proj_fname, proj_sname, proj_desc, proj_services, proj_period, proj_duty, companyid, date_start, date_end, projstatus, proj_remarks, contactid, employeeid, sw_nk, sw_jica, sw_icg, proj_relation0, proj_relation1, proj_relation2, proj_relation3, proj_class, countrycd, jobtypcd, divisioncd, pkiictgcd, date_mob, fk_companyid_client, fk_companyid_funding_agency, fk_companyid_implementing_agency, fk_contactid_client, fk_contactid_funding_agency, fk_contactid_implementing_agency, enrctg, filename1, filepath1, empidtl, empiddtl, empidpc FROM tblproject1 WHERE tblproject1.projectid=\"$pid\"";
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$projectid = $myrow11['projectid'];
			$proj_num = $myrow11['proj_num'];
			$proj_code = $myrow11['proj_code'];
			$proj_fname = $myrow11['proj_fname'];
			$proj_sname = $myrow11['proj_sname'];
			$proj_desc = $myrow11['proj_desc'];
			$proj_services = $myrow11['proj_services'];
			$proj_period = $myrow11['proj_period'];
			$proj_duty = $myrow11['proj_duty'];
      $companyid = $myrow11['companyid'];
      $date_start = $myrow11['date_start'];
      $date_end = $myrow11['date_end'];
      $projstatus = $myrow11['projstatus'];
      $proj_remarks = $myrow11['proj_remarks'];
			$contactid = $myrow11['contactid'];
			$employeeid = $myrow11['employeeid'];
			$sw_nk = $myrow11['sw_nk'];
			$sw_jica = $myrow11['sw_jica'];
			$sw_icg = $myrow11['sw_icg'];
			$proj_relation0 = $myrow11['proj_relation0'];
			$proj_relation1 = $myrow11['proj_relation1'];
			$proj_relation2 = $myrow11['proj_relation2'];
			$proj_relation3 = $myrow11['proj_relation3'];
			$proj_class = $myrow11['proj_class'];
			$countrycd = $myrow11['countrycd'];
			$jobtypcd = $myrow11['jobtypcd'];
			$divisioncd = $myrow11['divisioncd'];
			$pkiictgcd = $myrow11['pkiictgcd'];
			$date_mob = $myrow11['date_mob'];
			$fk_companyid_client = $myrow11['fk_companyid_client'];
			$fk_companyid_funding_agency = $myrow11['fk_companyid_funding_agency'];
			$fk_companyid_implementing_agency = $myrow11['fk_companyid_implementing_agency'];
			$fk_contactid_client = $myrow11['fk_contactid_client'];
			$fk_contactid_funding_agency = $myrow11['fk_contactid_funding_agency'];
			$fk_contactid_implementing_agency = $myrow11['fk_contactid_implementing_agency'];
      $enrctg = $myrow11['enrctg'];
      $filename1 = $myrow11['filename1'];
      $filepath1 = $myrow11['filepath1'];
    $empidtl = $myrow11['empidtl'];
    $empiddtl = $myrow11['empiddtl'];
    $empidpc = $myrow11['empidpc'];
			}
		}
	echo "<div class = 'border-bottom mb-4'>
	<p class = 'fs-3 mb-0'>$proj_fname <span class = 'text-muted'>($proj_sname)</span></p>
	<p class = 'fs-5 text-muted'>Project Information</p>
	</div>";


     echo "
	 <div class = 'mb-2'>
	 <p class = 'mb-0 fs-6 text-muted'>Project Item#</p>
	 <p class = 'fs-4'>$proj_num</p>
	 </div>";


     echo "
	 <div class = 'mb-2'>
	 <p class = 'mb-0 fs-6 text-muted'>Project Code</p>
	 <p class = 'fs-4'>$proj_code</p>
	 </div>";


    //  echo "
	//  <div class = 'mb-2'>
	//  <p class = 'mb-0 fs-6 text-muted'>Acronym</p>
	//  <p class = 'fs-4'>$proj_sname</p>
	//  </div>";
    //  echo "<p>Project Name</p>
	//  <p><b>$proj_fname</b></p>";
     echo "
	 <div class = 'mb-2'>
	 <p class = 'mb-0 fs-6 text-muted'>Description</p>
	 <p class = 'fs-4'>$proj_desc</p>
	 </div>";
  
     echo "
	 <div class = 'mb-2'>
	 <p class = 'mb-0 fs-6 text-muted'>Status</p>
	 <p class = 'fs-4'>";
	 // 20190915
	 if($projstatus=='Finished') { $projstatus="Completed"; }
	 echo "$projstatus";
	 echo "</p>
	 </div>";



     echo "
	 <div class = 'mb-2'>
	 <p class = 'mb-0 fs-6 text-muted'>Period</p>
	 <p class = 'fs-4'>$proj_period</p>
	 </div>";


     echo "
	 <div class = 'mb-2'>
	 <p class = 'mb-0 fs-6 text-muted'>Date Started</p>";
		if($date_start!='0000-00-00' || $date_start!='') {
		echo "<p>".date('Y-M-d', strtotime($date_start))."</p>";
		} else {
			echo "<p class = 'fs-4'>none</p>
			</div>";
		} // if-else
		
     echo "
	 <div class = 'mb-2'>
	 <p class = 'mb-0 fs-6 text-muted'>Date Finished</p>";
		if($date_end!='0000-00-00') {
		echo "<p class = 'fs-4'>".date('Y-M-d', strtotime($date_end))."</p>";
		} else {
		echo "<p class = 'fs-4'>none</p>
		</div>";
		} // if-else
	
		echo "
		<div class = 'mb-2'>
		<p class = 'mb-0 fs-6 text-muted'>Mobilization date</p>
		<p class = 'fs-4'>";
		if($date_mob!='0000-00-00') {
		echo "".date('Y-M-d D', strtotime($date_mob))."";
		} else {
		echo "<p>none</p>";
		} // if-else
		echo "</p>
		</div>";

	 // 20190915


     echo "
	 <div class = 'mb-2'>
	 <p class = 'mb-0 fs-6 text-muted'>Services</p>
	 <p class = 'fs-4'>$proj_services</p>
	 </div>";
		// 20180509
		echo "
		<div class = 'mb-2'>
		<p class = 'mb-0 fs-6 text-muted'>PKII Category</p>";
		
		$res12query="SELECT idprojctgpkii, name FROM tblprojctgpkii WHERE code=\"$pkiictgcd\"";
		$result12=""; $found12=0; $ctr12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$idprojctgpkii12 = $myrow12['idprojctgpkii'];
			$name12 = $myrow12['name'];
			} // while
		} // if
		echo "<p class = 'fs-4'> $pkiictgcd - $name12";
		echo "</p>
		</div>
		";


		echo "
		<div class = 'mb-2'>
		<p class = 'mb-0 fs-6 text-muted'>NK/Others Relationship</p>
		";
		/*
		if($sw_nk == 1) { echo "NK&nbsp;&nbsp;"; }
		if($sw_jica == 1) { echo "JICA&nbsp;&nbsp;"; }
		if($sw_icg == 1) { echo "ICG&nbsp;&nbsp;"; }
		*/
		if(($proj_relation0 != "") || ($proj_relation0 != "-")) {
			if(($proj_relation1 != "") || ($proj_relation1 != "-")) {
				/*
				$result6 = mysql_query("SELECT name FROM tblprojrelref WHERE code=\"$proj_relation1\" AND level=1", $dbh);
				if($result6 != "") {
					while($myrow6 = mysql_fetch_row($result6)) {
					$found6 = 1;
					$name6 = $myrow6[0];
					}
				}
				*/
				$res6query="SELECT name FROM tblprojrelref WHERE code=\"$proj_relation1\" AND level=1";
				$result6 = $dbh2->query($res6query);
				if($result6->num_rows>0) {
					while($myrow6 = $result6->fetch_assoc()) {
					$found6 = 1;
					$name6 = $myrow6['name'];
					}
				}
				if($proj_relation0 == "others") { echo "$name6"; }

				if(($proj_relation2 != "") || ($proj_relation2 != "-")) {
					/*
					$result7 = mysql_query("SELECT name FROM tblprojrelref WHERE code=\"$proj_relation2\" AND level=2 LIMIT 1", $dbh);
					if($result7 != "") {
						while($myrow7 = mysql_fetch_row($result7)) {
						$found7=1;
						$name7 = $myrow7[0];
						echo "$name7";
						}
					}
					*/
					$res7query="SELECT name FROM tblprojrelref WHERE code=\"$proj_relation2\" AND level=2 LIMIT 1";
					$result7=""; $found7=0;
					$result7=$dbh2->query($res7query);
					if($result7->num_rows>0) {
						while($myrow7 = $result7->fetch_assoc()) {
						$found7=1;
						$name7 = $myrow7['name'];
						echo " <p class = 'fs-4'> $name7 </p>";
						}
					}

					if(($proj_relation3 != "") || ($proj_relation3 != "-")) {
						/*
						$result8 = mysql_query("SELECT name FROM tblprojrelref WHERE code=\"$proj_relation3\" AND level=3 LIMIT 1", $dbh);
						if($result8 != "") {
							while($myrow8 = mysql_fetch_row($result8)) {
							$found8 = 1;
							$name8 = $myrow8[0];
							echo " - $name8";
							}
						}
						*/
						$res8query="SELECT name FROM tblprojrelref WHERE code=\"$proj_relation3\" AND level=3 LIMIT 1";
						$result8=""; $found8=0;
						$result8=$dbh2->query($res8query);
						if($result8->num_rows>0) {
							while($myrow8 = $result8->fetch_assoc()) {
							$found8 = 1;
							$name8 = $myrow8['name'];
							echo "<p class = 'fs-4'> - $name8 </p>";
							}
						}
					}
				}
			}
		}
		echo "</div>";





		echo "<div class = 'mb-2'>
		<p class = 'mb-0 fs-6 text-muted'>Classification</p>
		<p class = 'fs-4'>$proj_class</p>
		</div>
		";

		echo "
		<div class = 'mb-2'>
		<p class = 'mb-0 fs-6 text-muted'>Country</p>";
		/*
		$result17 = mysql_query("SELECT cname FROM tblcountrycd WHERE letter2cd=\"$countrycd\"", $dbh);
		if($result17 != "") {
			while($myrow17 = mysql_fetch_row($result17)) {
			$found17 = 1;
			$cname17 = $myrow17[0];
			}
		}
		*/

		echo "<p class = 'fs-4'>";
		$res17query="SELECT cname FROM tblcountrycd WHERE letter2cd=\"$countrycd\"";
		$result17=""; $found17=0; $ctr17=0;
		$result17=$dbh2->query($res17query);
		if($result17->num_rows>0) {
			while($myrow17 = $result17->fetch_assoc()) {
			$found17 = 1;
			$cname17 = $myrow17['cname'];
			}
		}
		if($cname17 != "") { echo "$cname17"; } else { echo "$countrycd17"; }
		echo "</p>
		</div>
		";

		// 20190915
		echo "
		<div class = 'mb-2'>
		<p class = 'mb-0 fs-6 text-muted' >Region</p>
		<p class = 'fs-4'>";
    $res10query=""; $result10=""; $found10=0;
    $res10query="SELECT region, subregion FROM tblcountrycd WHERE letter2cd=\"$countrycd\" LIMIT 1";
    $result10=$dbh2->query($res10query);
    if($result10->num_rows>0) {
      while($myrow10=$result10->fetch_assoc()) {
      $found10=1;
      $region10 = $myrow10['region'];
      $subregion10 = $myrow10['subregion'];
      } // while
    } // if
    if($found10==1 && $subregion10!='') { echo "$subregion10"; } else { echo ""; }
    echo "</p> </div>";

    // 20190920 ENR
    echo "
	<div class = 'mb-2'>
	<p class = 'mb-0 fs-6 text-muted'>ENR</p>
	";
    $res20query=""; $result20=""; $found20=0;
    $res20query="SELECT idprojctgenr, name_e, name_j FROM tblprojctgenr WHERE code=\"$enrctg\"";
    $result20=$dbh2->query($res20query);
    if($result20->num_rows>0) {
      while($myrow20=$result20->fetch_assoc()) {
      $found20=1;
      $idprojctgenr20 = $myrow20['idprojctgenr'];
      $name_e20 = $myrow20['name_e'];
      $name_j20 = $myrow20['name_j'];
      } // while
    } // if
    echo " <p class = 'fs-4'> $enrctg - $name_e20";
    // echo "<br>$name_j20";
    echo "</p>
	</div>
	";

		echo "<p class = 'mb-0 fs-6 text-muted'>Sector</p>";
		/*
		$result19 = mysql_query("SELECT name_j, name_e FROM tblprojdivisionref WHERE code=\"$divisioncd\"", $dbh);
		if($result19 != "") {
			while($myrow19 = mysql_fetch_row($result19)) {
			$found19 = 1;
			$name_j19 = $myrow19[0];
			$name_e19 = $myrow19[1];
			}
		}
		*/
		$res19query="SELECT name_j, name_e FROM tblprojdivisionref WHERE code=\"$divisioncd\"";
		$result19=""; $found19=0; $ctr19=0;
		$result19=$dbh2->query($res19query);
		if($result19->num_rows>0) {
			while($myrow19=$result19->fetch_assoc()) {
			$found19 = 1;
			$name_j19 = $myrow19['name_j'];
			$name_e19 = $myrow19['name_e'];			
			}
		}

		if($name_e19 != "") { echo "<p class = 'fs-4'>$name_e19</p>"; } else { echo "<p class = 'fs-4'>$divisioncd</p>"; }
		

		/* 20190915
		echo "<tr><th align=\"right\">Job Type</th>";
		$res18query="SELECT name_j, name_e FROM tblprojjobtypref WHERE code=\"$jobtypcd\"";
		$result18=""; $found18=0; $ctr18=0;
		$result18 = $dbh2->query($res18query);
		if($result18->num_rows>0) {
			while($myrow18=$result18->fetch_assoc()) {
			$found18 = 1;
			$name_j18 = $myrow18['name_j'];
			$name_e18 = $myrow18['name_e'];
			}
		}
		if($name_e18 != "") { echo "<td>$name_e18</td>"; } else { echo "<td>$jobtypcd</td>"; }
		echo "</tr>";
		*/

		echo "<p class = 'mb-0 fs-6 text-muted'>Client</p>
		<p class = 'fs-4'>";
		/*
		if((($companyid!="") || ($companyid!=0)) && (($contactid=="") || ($contactid==0))) {
			$res11aquery="SELECT company, branch FROM tblcompany WHERE companyid=$companyid";
			$result11a=""; $found11a=0; $ctr11a=0;
			$result11a = $dbh2->query($res11aquery);
			if($result11a->num_rows>0) {
				while($myrow11a = $result11a->fetch_assoc()) {
				$found11a = 1;
				$company11a = $myrow11a['company'];
				$branch11a = $myrow11a['branch'];
				}
			}

			$company11afin = $company11a;
			if($branch11a!="") { $company11afin = $company11a . " - " . $branch11a; }
			echo "$company11afin";
		}
		if((($contactid!="") || ($contactid!=0)) && (($companyid=="") || ($companyid==0))) {
			$res11bquery="SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid";
			$result11b=""; $found11b=0; $ctr11b=0;
			$result11b = $dbh2->query($res11bquery);
			if($result11b->num_rows>0) {
				while($myrow11b = $result11b->fetch_assoc()) {
				$found11b = 1;
				$companyid11b = $myrow11b['companyid'];
				$employeeid11b = $myrow11b['employeeid'];
				$name_last11b = $myrow11b['name_last'];
				$name_first11b = $myrow11b['name_first'];
				$name_middle11b = $myrow11b['name_middle'];
				}
			}

			$contactname11bfin = $name_first11b;
			if($name_middle11b != "") { $contactname11bfin = $contactname11bfin . "&nbsp;" . $name_middle11b[0] . "."; }
			if($name_last11b != "") { $contactname11bfin = $contactname11bfin . "&nbsp;" . $name_last11b; }
			echo "$contactname11bfin";
		}
		if((($companyid=="") && ($contactid=="")) || (($companyid==0) && ($contactid==0))) {
			echo "";
		}
		*/
		if($fk_companyid_client!=0) {
		// query tblcompany
		$res12query="SELECT company, branch FROM tblcompany WHERE companyid=$fk_companyid_client LIMIT 1";
		$result12=""; $found12=0; $ctr12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$ctr12=$ctr12+1;
			$company12 = $myrow12['company'];
			$branch12 = $myrow12['branch'];
			} // while
		} // if
		if($found12==1) {
			echo "$company12";
			if($branch12!='') { echo "&nbsp;-&nbsp;$branch12"; } // if
		} else {
		echo "";
		} // if-else
		} else if($fk_contactid_client!=0) {
		// query tblcontact
		$res14query="SELECT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact WHERE tblcontact.contactid=$fk_contactid_client LIMIT 1";
		$result14=""; $found14=0;
		$result14=$dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
			$found14=1;
			$employeeid14 = $myrow14['employeeid'];
			$name_last14 = $myrow14['name_last'];
			$name_first14 = $myrow14['name_first'];
			$name_middle14 = $myrow14['name_middle'];
			} // while
		} // if
		if($found14==1) {
			echo "$name_first14&nbsp;";
			if($name_middle14!='') { echo "$name_middle14[0].&nbsp;"; }
			if($name_last14!='') { echo "$name_last14"; }
		} else {
		echo "";
		} // if-else
		} // if($fk_companyid_client!=0) else if($fk_contactid_client!=0)
		echo "</p>";




		echo "<p class = 'mb-0 fs-6 text-muted'>Funding agency</p>
		<p class = 'fs-4'>";
		if($fk_companyid_funding_agency!=0) {
		// query tblcompany
		$res15query="SELECT company, branch FROM tblcompany WHERE companyid=$fk_companyid_funding_agency LIMIT 1";
		$result15=""; $found15=0;
		$result15=$dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15=$result15->fetch_assoc()) {
			$found15=1;
			$company15 = $myrow15['company'];
			$branch15 = $myrow15['branch'];
			} // while
		} // if
		if($found15==1) {
		echo "$company15";
			if($branch15!='') { echo "&nbsp;-&nbsp;$branch15"; }
		} else {
		echo "";
		} // if-else
		} else if($fk_contactid_funding_agency!=0) {
		// query tblcontact
		$res16query="SELECT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact WHERE tblcontact.contactid=$fk_contactid_funding_agency LIMIT 1";
		$result16=""; $found16=0;
		$result16=$dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16=$result16->fetch_assoc()) {
			$found16=1;
			$employeeid16 = $myrow16['employeeid'];
			$name_last16 = $myrow16['name_last'];
			$name_first16 = $myrow16['name_first'];
			$name_middle16 = $myrow16['name_middle'];
			} // while
		} // if
		if($found16==1) {
		echo "$name_first16&nbsp;";
			if($name_middle16!='') { echo "$name_middle16[0].&nbsp;"; }
			if($name_last16!='') { echo "$name_last16"; }
		} else {
		echo "";
		} // if-else
		} // if($fk_companyid_funding_agency!=0) else if($fk_contactid_funding_agency!=0)
		echo "</p>";

		echo "<p class = 'mb-0 fs-6 text-muted' >Implementing agency</p>
		<p class = 'fs-4'>";
		if($fk_companyid_implementing_agency!=0) {
		// query tblcompany
		$res17query="SELECT company, branch FROM tblcompany WHERE companyid=$fk_companyid_implementing_agency LIMIT 1";
		$result17=""; $found17=0;
		$result17=$dbh2->query($res17query);
		if($result17->num_rows>0) {
			while($myrow17=$result17->fetch_assoc()) {
			$found17=1;
			$company17 = $myrow17['company'];
			$branch17 = $myrow17['branch'];
			} // while
		} // if
		if($found17==1) {
		echo "$company17";
			if($branch17!='') { echo "&nbsp;-&nbsp;$branch17"; }
		} else {
		echo "";
		} // if-else
		} else if($fk_contactid_implementing_agency!=0) {
		// query tblcontact
		$res18query="SELECT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact WHERE tblcontact.contactid=$fk_contactid_implementing_agency LIMIT 1";
		$result18=""; $found18=0; $ctr18=0;
		$result18=$dbh2->query($res18query);
		if($result18->num_rows>0) {
			while($myrow18=$result18->fetch_assoc()) {
			$found18=1;
			$employeeid18 = $myrow18['employeeid'];
			$name_last18 = $myrow18['name_last'];
			$name_first18 = $myrow18['name_first'];
			$name_middle18 = $myrow18['name_middle'];
			} // while
		} // if
		if($found18==1) {
			echo "$name_first18&nbsp;";
			if($name_middle18!='') { echo "$name_middle18[0].&nbsp;"; }
			if($name_last18!='') { echo "$name_last18"; }
		} else {
			echo "";
		} // if-else
		} // if($fk_companyid_implementing_agency!=0) else if($fk_contactid_implementing_agency!=0)
		echo "</p>";

     echo "<p class = 'mb-0 fs-6 text-muted'>Remarks</p>
	 <p class = 'fs-4'>$proj_remarks</p>";


     echo "<p class = 'mb-0 fs-6 text-muted'>PDS file</p>
	 <p class = 'fs-4'><a href=\"$filepath1/$filename1\" target=\"_blank\">$filename1</a></p>";

    if($empidtl!="") {
    $res2aquery=""; $result2a=""; $found2a=0;
    $res2aquery="SELECT tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.employeeid=\"$empidtl\" AND tblcontact.contact_type=\"personnel\"";
    $result2a=$dbh2->query($res2aquery);
    if($result2a->num_rows>0) {
        while($myrow2a=$result2a->fetch_assoc()) {
        $found2a=1;
        $name_first2a = $myrow2a['name_first'];
        $name_last2a = $myrow2a['name_last'];
        $name_middle2a = $myrow2a['name_middle'];
        $email12a = $myrow2a['email1'];
        } //while
    } //if
    if($found2a==1) {
    echo "<p class = 'mb-0 fs-6 text-muted'>Project Team Leader</p>
	<p class ='fs-4'>
	<a href=\"mailto:$email12a\">$name_last2a, $name_first2a $name_middle2a[0]</a></p>";
    } //if
    } //if

    if($empiddtl!="") {
    $res2bquery=""; $result2b=""; $found2b=0;
    $res2bquery="SELECT tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.employeeid=\"$empiddtl\" AND tblcontact.contact_type=\"personnel\"";
    $result2b=$dbh2->query($res2bquery);
    if($result2b->num_rows>0) {
        while($myrow2b=$result2b->fetch_assoc()) {
        $found2b=1;
        $name_first2b = $myrow2b['name_first'];
        $name_last2b = $myrow2b['name_last'];
        $name_middle2b = $myrow2b['name_middle'];
        $email12b = $myrow2b['email1'];
        } //while
    } //if
    if($found2b==1) {
    echo "<p class = 'mb-0 fs-6 text-muted'>Deputy Team Leader</p>
	<p class = 'fs-4'><a href=\"mailto:$email12b\">$name_last2b, $name_first2b $name_middle2b[0]</a></p>";
    } //if
    } //if

    if($empidpc!="") {
    $res2cquery=""; $result2c=""; $found2c=0;
    $res2cquery="SELECT tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.employeeid=\"$empidpc\" AND tblcontact.contact_type=\"personnel\"";
    $result2c=$dbh2->query($res2cquery);
    if($result2c->num_rows>0) {
        while($myrow2c=$result2c->fetch_assoc()) {
        $found2c=1;
        $name_first2c = $myrow2c['name_first'];
        $name_last2c = $myrow2c['name_last'];
        $name_middle2c = $myrow2c['name_middle'];
        $email12c = $myrow2c['email1'];
        } //while
    } //if
    if($found2c==1) {
    echo "<p class = 'mb-0 fs-6 text-muted'>Deputy Team Leader</p>
	<p class = 'fs-4'><a href=\"mailto:$email12c\">$name_last2c, $name_first2c $name_middle2c[0]</a></p>";
    } //if
    } //if

    if($employeeid!="") {
     echo "<p class = 'mb-0 fs-6 text-muted'>Account Officer</p>
	 <p class = 'fs-4'>";
		$res2query="SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.email1 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.employeeid='$employeeid' AND tblcontact.contact_type=\"personnel\"";
		$result2 = $dbh2->query($res2query);
		if($result2->num_rows > 0) {
			while($myrow2 = $result2->fetch_assoc()) {
			$found2 = 1;    
      $employeeid = $myrow2['employeeid'];
      $name_first = $myrow2['name_first'];
      $name_last = $myrow2['name_last'];
      $email1 = $myrow2['email1'];
			}
		}
     if ($employeeid != '')
     {
	echo "$name_first $name_last";
	if($email1!='') {
	echo " - <a href='mailto:$email1'>$email1</a>";
	} // if
     }
     else
     {
	echo "n/a<br>";
     }
	 echo"</p>";
    } //if

     echo "<p class = 'mb-0 fs-6 text-muted'>Personnel involved</p>";
  

    
   

	/*
		$result1=""; $found1=0; $ctr1=0;
    $result1 = mysql_query("SELECT DISTINCT tblprojassign.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.email1 FROM tblprojassign INNER JOIN tblcontact ON tblprojassign.employeeid=tblcontact.employeeid WHERE tblprojassign.proj_code=\"$proj_code\" AND tblcontact.contact_type=\"personnel\" ORDER BY tblcontact.name_last ASC", $dbh);
     while ($myrow1 = mysql_fetch_row($result1))
     {
	$employeeid = $myrow1[0];
	$name_first = $myrow1[1];
	$name_last = $myrow1[2];
	$email1 = $myrow1[3];
	$projassignid = $myrow1[4];
	*/

	?>

<style>
			.hoverable{
				color: #6F6E6E !important;
				transition: .3s;
			}

	
			.hoverable:hover{
				color: white !important;
				background-color:  #0a1d44 !important;
				transition: .3s ;
			}
		</style>
<?php
	$res1query="SELECT DISTINCT tblprojassign.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.email1 FROM tblprojassign LEFT JOIN tblcontact ON tblprojassign.employeeid=tblcontact.employeeid WHERE tblprojassign.proj_code=\"$proj_code\" AND tblcontact.contact_type=\"personnel\" ORDER BY tblcontact.name_last ASC";
	$result1=$dbh2->query($res1query);
	if($result1->num_rows>0) {
		while($myrow1=$result1->fetch_assoc()) {
		$employeeid = $myrow1['employeeid'];
		$name_first = $myrow1['name_first'];
		$name_last = $myrow1['name_last'];
		$email1 = $myrow1['email1'];
		?>
	
<a href='mailto:<?php echo $email1; ?>' class = ''>
		<div class ='border p-4 rounded-3 my-2 hoverable'>
	   <?php
	echo "<p class = 'name fs-4 mb-0'>$name_first $name_last</p>";

    $res2query=""; $result2=""; $found2=0;
    $res2query="SELECT ref_no, proj_code, position, durationfrom, durationto, idhrpositionctg FROM tblprojassign WHERE employeeid=\"$employeeid\" AND proj_code=\"$proj_code\" ORDER BY durationto DESC";
    $result2=$dbh2->query($res2query);
    if($result2->num_rows>0) {
        while($myrow2=$result2->fetch_assoc()) {
        $found2=1;
	  $found2 = 1;
	  $ref_no = $myrow2['ref_no'];
	  $proj_code = $myrow2['proj_code'];
	  $position = $myrow2['position'];
	  $durationfrom = $myrow2['durationfrom'];
	  $durationto = $myrow2['durationto'];
        $idhrpositionctg=$myrow2['idhrpositionctg'];
   
    if($idhrpositionctg!=0) {
    $res2bquery=""; $result2b=""; $found2b=0;
    $res2bquery="SELECT name FROM tblhrpositionctg WHERE idhrpositionctg=$idhrpositionctg";
    $result2b=$dbh2->query($res2bquery);
    if($result2b->num_rows>0) {
        while($myrow2b=$result2b->fetch_assoc()) {
        $found2b=1;
        $name2b=$myrow2b['name'];
        } //while
    } //if
    if($found2b==1) {
    echo "
	
	<p class = 'sw  fs-5 mb-0'>$name2b</p>";
    echo "<p class = 'sw  fs-5 mb-0'>$position</p>";
    } //if-else
    } else {
    echo "<p class = 'sw  fs-5 mb-0'>$position</p>";
    echo "<p class = 'sw  fs-5 mb-0'>$ref_no</p>";
}
    if($durationto!='0000-00-00') {
    $durationto=date("Y-M-d", strtotime($durationto));
    } else {
    $durationto="";
    } //if-else
    echo "<p class = 'sw fs-5 mb-0'>".date("Y-M-d", strtotime($durationfrom))." -to- $durationto</p> ";
        } //while
    } //if
echo "</div> </a>";

//     }
		} // while($myrow1=$result1->fetch_assoc())
	} // if($result1->num_rows>0)

		/*
		$result6 = mysql_query("SELECT DISTINCT tblprojcdassign.empid, tblprojcdassign.projassignid, tblcontact.name_last, tblcontact.name_first, tblprojassign.ref_no, tblprojassign.proj_code, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto FROM tblprojcdassign LEFT JOIN tblcontact ON tblprojcdassign.empid=tblcontact.employeeid LEFT JOIN tblprojassign ON tblprojcdassign.projassignid=tblprojassign.projassignid WHERE tblprojcdassign.projcode=\"$proj_code\" AND tblcontact.contact_type=\"personnel\"", $dbh);
		if($result6 != "") {
			while($myrow6 = mysql_fetch_row($result6)) {
			$found6=1;
			$employeeid6 = $myrow6[0];
			$projassignid6 = $myrow6[1];
			$name_last6 = $myrow6[2];
			$name_first6 = $myrow6[3];
			$ref_no6 = $myrow6[4];
			$proj_code6 = $myrow6[5];
			$position6 = $myrow6[6];
			$durationfrom6 = $myrow6[7];
			$durationto6 = $myrow6[8];
			echo "<tr><td>$name_first6 $name_last6</td><td>";
			echo "<table width=\"100%\" class=\"fin2\">";
			echo "<tr><td>$position6</td><td>$ref_no6</td><td>$durationfrom6-to-$durationto6</td></tr>";
			echo "</table>";
			echo "</td></tr>";
			}
		}
		*/


		$res6query="SELECT DISTINCT tblprojcdassign.empid, tblprojcdassign.projassignid, tblcontact.name_last, tblcontact.name_first, tblprojassign.ref_no, tblprojassign.proj_code, tblprojassign.position, tblprojassign.durationfrom, tblprojassign.durationto, tblprojassign.idhrpositionctg FROM tblprojcdassign LEFT JOIN tblcontact ON tblprojcdassign.empid=tblcontact.employeeid LEFT JOIN tblprojassign ON tblprojcdassign.projassignid=tblprojassign.projassignid WHERE tblprojcdassign.projcode=\"$proj_code\" AND tblcontact.contact_type=\"personnel\"";
		$result6=""; $found6=0; $ctr6=0;
		$result6 = $dbh2->query($res6query);
		if($result6->num_rows>0) {
			while($myrow6 = $result6->fetch_assoc()) {
			$found6=1;
			$employeeid6 = $myrow6['empid'];
			$projassignid6 = $myrow6['projassignid'];
			$name_last6 = $myrow6['name_last'];
			$name_first6 = $myrow6['name_first'];
			$ref_no6 = $myrow6['ref_no'];
			$proj_code6 = $myrow6['proj_code'];
			$position6 = $myrow6['position'];
			$durationfrom6 = $myrow6['durationfrom'];
			$durationto6 = $myrow6['durationto'];
    $idhrpositionctg6 = $myrow6['idhrpositionctg'];


	?>
<div class ='border p-4 rounded-3 my-2 '>
			<?php

		
			echo "<p class = 'name fs-4 mb-0'>$name_first6 $name_last6</p>";
    if($idhrpositionctg6!=0) {
    $res6aquery=""; $result6a=""; $found6a=0;
    $res6aquery="SELECT name FROM tblhrpositionctg WHERE idhrpositionctg=$idhrpositionctg6";
    $result6a=$dbh2->query($res6aquery);
    if($result6a->num_rows>0) {
        while($myrow6a=$result6a->fetch_assoc()) {
        $found6a=1;
        $name6a = $myrow6a['name'];
        } //while
    } //if
    if($found6a==1) {
    echo "<p class = 'sw  fs-5 mb-0'>$name6a</p>";
    } else {
    echo "<p class = 'sw  fs-5 mb-0'>$position6</p>";
    } //if-else
    } else {
    echo "<p class = 'sw  fs-5 mb-0'>$position6</p>";
    } //if-else

    echo "<p class = 'sw  fs-5 mb-0'>$ref_no6</p>";

    if($durationto6!='0000-00-00') {
    $durationto6 = date("Y-M-d", strtotime($durationto6));
    } else {
    $durationto6="";
    } //if-else
    echo "<p class = 'sw  fs-5 mb-0'>".date("Y-M-d", strtotime($durationfrom6))."-to-$durationto6</p>";

			}
		}

  
 
		echo "</div> ";


	 ?>



</div>
</div>
<?php

     // $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);
		$resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery);

     echo "<p>";
    

     include ("footer.php");
} else {
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
