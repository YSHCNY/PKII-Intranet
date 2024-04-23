<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$pid = (isset($_GET['pid'])) ? $_GET['pid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<font size=1>Directory >> Manage Projects >> Edit Project</font><br>";

     echo "<table class=\"fin\" border=1>";
     echo "<tr><th colspan=\"2\">Edit Project Information</th></tr>";

	$res01query="SELECT projectid, proj_num, proj_code, proj_fname, proj_sname, proj_period, date_start, date_end, proj_desc, proj_services, proj_duty, companyid, projstatus, proj_remarks, contactid, employeeid, sw_nk, sw_jica, sw_icg, proj_relation0, proj_relation1, proj_relation2, proj_relation3, proj_class, countrycd, jobtypcd, divisioncd, pkiictgcd, date_mob, fk_companyid_client, fk_companyid_funding_agency, fk_companyid_implementing_agency, fk_contactid_client, fk_contactid_funding_agency, fk_contactid_implementing_agency, enrctg, filename1, filepath1, empidtl, empiddtl, empidpc FROM tblproject1 WHERE projectid=$pid";
	$result01=$dbh2->query($res01query);
	if($result01->num_rows>0) {
		while($myrow=$result01->fetch_assoc()) {
		$found01=1;
		$projectid = $myrow['projectid'];
		$proj_num = $myrow['proj_num'];
		$proj_code = $myrow['proj_code'];
		$proj_fname = $myrow['proj_fname'];
		$proj_sname = $myrow['proj_sname'];
		$proj_period = $myrow['proj_period'];
		$date_start = $myrow['date_start'];
		$date_end = $myrow['date_end'];
		$proj_desc = $myrow['proj_desc'];
		$proj_services = $myrow['proj_services'];
		$proj_duty = $myrow['proj_duty'];
		$companyid = $myrow['companyid'];
		$projstatus = $myrow['projstatus'];
		$proj_remarks = $myrow['proj_remarks'];
		$contactid = $myrow['contactid'];
		$employeeid = $myrow['employeeid'];
		$sw_nk = $myrow['sw_nk'];
		$sw_jica = $myrow['sw_jica'];
		$sw_icg = $myrow['sw_icg'];
		$proj_relation0 = $myrow['proj_relation0'];
		$proj_relation1 = $myrow['proj_relation1'];
		$proj_relation2 = $myrow['proj_relation2'];
		$proj_relation3 = $myrow['proj_relation3'];
		$proj_class = $myrow['proj_class'];
		$countrycd = $myrow['countrycd'];
		$jobtypcd = $myrow['jobtypcd'];
		$divisioncd = $myrow['divisioncd'];
		$pkiictgcd = $myrow['pkiictgcd'];
		$date_mob = $myrow['date_mob'];
		$fk_companyid_client11 = $myrow['fk_companyid_client'];
		$fk_companyid_funding_agency11 = $myrow['fk_companyid_funding_agency'];
		$fk_companyid_implementing_agency11 = $myrow['fk_companyid_implementing_agency'];
		$fk_contactid_client11 = $myrow['fk_contactid_client'];
		$fk_contactid_funding_agency11 = $myrow['fk_contactid_funding_agency'];
		$fk_contactid_implementing_agency11 = $myrow['fk_contactid_implementing_agency'];
    $enrctg = $myrow['enrctg'];
    $filename1 = $myrow['filename1'];
    $filepath1 = $myrow['filepath1'];
    $empidtl = $myrow['empidtl'];
    $empiddtl = $myrow['empiddtl'];
    $empidpc = $myrow['empidpc'];
		} // while
	} // if

/*		if((($companyid!="") || ($companyid!=0)) && (($contactid=="") || ($contactid==0))) { $rdiocompanyid="checked=\"checked\""; $rdiocontactid=""; }
		if((($contactid!="") || ($contactid!=0)) && (($companyid=="") || ($companyid==0))) { $rdiocontactid="checked=\"checked\""; $rdiocompanyid=""; }
		if((($companyid=="") && ($contactid=="")) || (($companyid==0) && ($contactid==0))) { $rdiocompanyid="checked=\"checked\""; $rdiocontactid=""; } */

     // echo "<tr><td></td><td>";
     // echo "";
     // echo "</td></tr>";

	// echo "<tr><td colspan='2'>vartest qry: $res01query</td></tr>";

	 // 20190915
     // echo "<tr><th class='text-right'>Project No.</th><td><input name=proj_num value=\"$proj_num\"></td></tr>";
	 
		if(($accesslevel >= 4) && ($accesslevel <= 5)) {
     echo "<tr><th class='text-right'>Project Code</th><td><strong>$proj_code</strong>&nbsp;&nbsp;";
    // echo "<a href=\"projchgcd.php?loginid=$loginid&pid=$pid\">&nbsp;&nbsp;";
    // echo "<font size=\"1\"><i>Change proj_code</i></font>";
      echo "<form action=\"projchgcd.php?pid=$pid&loginid=$loginid\" method=\"post\" name=\"projchgcd\"><button  type='submit' class='btn btn-warning'>Change project code</button></form>";
    echo "&nbsp;&nbsp;";
      echo "<form action=\"projdelete.php?pid=$pid&loginid=$loginid\" method=\"post\" name=\"delform\"><button  type='submit' class='btn btn-danger'>Delete this project</button></form>";
      echo "</td></tr>";
		} else if($accesslevel <= 3) {
     echo "<tr><th class='text-right'>Project Code</th><td>$proj_code</td></tr>";
		}
     echo "<form action=\"updateproj.php?pid=$pid&loginid=$loginid\" method=\"post\" name=\"updateform\">";
      echo "<input type='hidden' name=\"proj_code\" value=\"$proj_code\">";
     echo "<tr><th class='text-right'>Acronym</th><div class='form-group'><td><input class='form-control' name=\"proj_sname\" value=\"$proj_sname\" placeholder='acronym'></td></div></tr>";
     echo "<tr><th valign=top class='text-right'>Project Name</th><div class='form-group'><td><textarea class='form-control' name=\"proj_fname\" rows=\"3\" placeholder='project name'>$proj_fname</textarea></td></div></tr>";
     echo "<tr><th valign=top class='text-right'>Description</th><div class='form-group'><td><textarea class='form-control' name=\"proj_desc\" rows=\"5\" placeholder='description'>$proj_desc</textarea></td></div></tr>";
	 // 20190915
     // echo "<tr><th class='text-right'>c/o</th><td><input name=\"proj_duty\" value=\"$proj_duty\"></td></tr>";

		echo "<tr><th class='text-right'>NK/Others Relationship</th><td>";
		if(($proj_relation0 != "") || ($proj_relation0 != "-")) {
			if(($proj_relation1 != "") || ($proj_relation1 != "-")) {
				$result6=""; $found6=0;
				$result6 = mysql_query("SELECT name FROM tblprojrelref WHERE code=\"$proj_relation1\" AND level=1", $dbh);
				if($result6 != "") {
					while($myrow6 = mysql_fetch_row($result6)) {
					$found6 = 1;
					$name6 = $myrow6[0];
					} // while
				} // if
				if($proj_relation0 == "others") {
					echo "<b>$name6</b>";
					// 20180509
					$rdionprojrelnkchk=""; $rdionprojrelotherchk="checked";
				} else {
					// 20180509
					$rdionprojrelnkchk="checked"; $rdionprojrelotherchk="";
				} // if

				if(($proj_relation2 != "") || ($proj_relation2 != "-")) {
					$result7=""; $found7=0;
					$result7 = mysql_query("SELECT name FROM tblprojrelref WHERE code=\"$proj_relation2\" AND level=2 LIMIT 1", $dbh);
					if($result7 != "") {
						while($myrow7 = mysql_fetch_row($result7)) {
						$found7=1;
						$name7 = $myrow7[0];
						echo "<b>$name7</b>";
						} // while
					} // if

					if(($proj_relation3 != "") || ($proj_relation3 != "-")) {
						$result8=""; $found8=0;
						$result8 = mysql_query("SELECT name FROM tblprojrelref WHERE code=\"$proj_relation3\" AND level=3 LIMIT 1", $dbh);
						if($result8 != "") {
							while($myrow8 = mysql_fetch_row($result8)) {
							$found8 = 1;
							$name8 = $myrow8[0];
							echo "<b> - $name8</b>";
							} // while
						} // if
					} // if
				} // if
			} // if
		} else {
			// 20180509
			$rdionprojrelnkchk="checked"; $rdionprojrelotherchk="";
		} // if
		echo "<br>";
		/*
		echo "<select name=\"proj_relation0\" onchange=\"dynamicpulldown0()\" id=\"dynprojrel0\">";
		if(($proj_relation0 == "") || ($proj_relation0 == "-")) { echo "<option value=\"-\">-</option>"; }
		$result5=""; $found5=0;
		$result5 = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE level=0", $dbh);
		if($result5 != "") {
			while($myrow5 = mysql_fetch_row($result5)) {
			$found5 = 1;
			$projrelrefid5 = $myrow5[0];
			$code5 = $myrow5[1];
			$name5 = $myrow5[2];
			if($proj_relation0 == $code5) { $projrel0sel="selected"; } else { $projrel0sel=""; }
			echo "<option value=\"$code5\" $projrel0sel>$name5</option>";
			}
		}
		echo "</select>";
		*/
		// 20180509
		// echo "test:0:$proj_relation0,1:$proj_relation1,2:$proj_relation2,3:$proj_relation3<br>";
		echo "<table id=\"tblTesting\" class=\"fin\">";
		echo "<tr><td>";
		// column nk
		echo "<input type=\"radio\" name=\"nkotherrel\" value=\"nk\" $rdionprojrelnkchk>NK";
		echo "<br />";
      echo "<div class='form-group'><select class='form-control' id=\"proj_relation1list\" name=\"proj_relation1a\" onclick=\"getSelected()\" onchange=\"dynamicpulldown1()\">";   
			if(($proj_relation0 == "") || ($proj_relation0 == "-") || ($proj_relation0 == "others")) {
			echo "<option value=\"-\">-</option>";
			}
			$result12=""; $found12=0;
			$result12 = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE codeprev='nk' AND level=1", $dbh);
			if($result12 != "") {
				while($myrow12 = mysql_fetch_row($result12)) {
				$found12 = 1;
				$projrelrefid12 = $myrow12[0];
				$code12 = $myrow12[1];
				$name12 = $myrow12[2];
				if((($proj_relation1 != "") || ($proj_relation1 != "-")) && ($proj_relation1 == $code12)) { $projrel1sel="selected"; } else { $projrel1sel=""; }
				echo "<option value=\"$code12\" $projrel1sel>$name12</option>";
				}
			}
			echo "</select></div>";
			if($proj_relation0=='nk') {
				if($proj_relation1!='' || $proj_relation1!='-') {
					echo "<br />";
					if($proj_relation1=='nkmain') {
						echo "<div class='form-group'><select class='form-control' id=\"proj_relation2list\" name=\"proj_relation2a\" onclick=\"getSelected1()\" onchange=\"dynamicpulldown2()\">";
						$result11 = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE codeprev='nkmain' AND level=2", $dbh);
						if($proj_relation2=='' || $proj_relation2=='-') { echo "<option value=''>-</option>"; }
						if($result11 != '') {
						while($myrow11 = mysql_fetch_row($result11)) {
						$projrelrefid11 = $myrow11[0];
						$code11 = $myrow11[1];
						$name11 = $myrow11[2];
						if((($proj_relation2 != "") || ($proj_relation2 != "-")) && ($proj_relation2 == $code11)) { $projrel2sel="selected"; } else { $projrel2sel=""; }
						echo "<option value=\"$code11\" $projrel2sel>$name11</option>";
						} // while
						} // if
						echo "</select></div>";
					} else if($proj_relation1=='nkgroup') {
						echo "<div class='form-group'><select class='form-control' id=\"proj_relation2list\" name=\"proj_relation2b\" onclick=\"getSelected1()\">";   
						$result11b = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE codeprev='nkgroup' AND level=2", $dbh);
						if($proj_relation2=='' || $proj_relation2=='-') { echo "<option value=''>-</option>"; }
						if($result11b != '') {
						while($myrow11b = mysql_fetch_row($result11b)) {
						$projrelrefid11b = $myrow11b[0];
						$code11b = $myrow11b[1];
						$name11b = $myrow11b[2];
						if((($proj_relation2 != "") || ($proj_relation2 != "-")) && ($proj_relation2 == $code11b)) { $projrel2bsel="selected"; } else { $projrel2bsel=""; }
						echo "<option value=\"$code11b\" $projrel2bsel>$name11b</option>";
						} // while
						} // if
						echo "</select></div>";
					} // if
					if($proj_relation2!='' || $proj_relation2!='-') {
						echo "<br />";
						echo "<div class='form-group'><select class='form-control' id=\"proj_relation3list\" name=\"proj_relation3a\" onclick=\"getSelected2()\">";   
						$result14 = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE codeprev='nkoei' AND level=3", $dbh);
						if($proj_relation3=='' || $proj_relation3=='-') { echo "<option value=''>-</option>"; }
						if($result14 != '') {
						while($myrow14 = mysql_fetch_row($result14)) {
						$projrelrefid14 = $myrow14[0];
						$code14 = $myrow14[1];
						$name14 = $myrow14[2];
						if((($proj_relation3 != "") || ($proj_relation3 != "-")) && ($proj_relation3 == $code14)) { $projrel3sel="selected"; } else { $projrel3sel=""; }
						echo "<option value=\"$code14\" $projrel3sel>$name14</option>";
						} // while
						} // if
						echo "</select></div>";
					} // if
				} // if
			} // if
		echo "</td><td>";
		// column others
		echo "<input type=\"radio\" name=\"nkotherrel\" id=\"nkotherrel1\" value=\"others\" $rdionprojrelotherchk>Others";
		echo "<br />";
      echo "<div class='form-group'><select class='form-control' id=\"proj_relation1list\" name=\"proj_relation1b\" onclick=\"getSelected()\">";
			if(($proj_relation0 == "") || ($proj_relation0 == "-")) {
			echo "<option value=\"-\">-</option>";
			}
			$result12b=""; $found12b=0;
			$result12b = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE codeprev='others' AND level=1", $dbh);
			if($result12b != "") {
				while($myrow12b = mysql_fetch_row($result12b)) {
				$found12b=1;
				$projrelrefid12b = $myrow12b[0];
				$code12b = $myrow12b[1];
				$name12b = $myrow12b[2];
				if((($proj_relation1 != "") || ($proj_relation != "-")) && ($proj_relation1 == $code12b)) { $projrel2sel="selected"; } else { $projrel2sel=""; }
				echo "<option value=\"$code12b\" $projrel2sel>$name12b</option>";
				}
			}
			echo "</select></div>";
		echo "</td></tr>";
		echo "</table>";
    //
    // dynamicpulldown0
    //
    // echo "<div id=\"myDynamicPullDown0\">";			
    // echo "</div>";
		// echo "<input name=\"proj_relation1\" type=\"Hidden\">";

    //
    // dynamicpulldown1
    //
    echo "<div id=\"myDynamicPullDown1\">";			
    echo "</div>";
		echo "<input name=\"proj_relation2\" type=\"Hidden\">";

    //
    // dynamicpulldown2
    //
    echo "<div id=\"myDynamicPullDown2\">";			
    echo "</div>";
		echo "<input name=\"proj_relation3\" type=\"Hidden\">";

/*
		if((($proj_relation1 != "") || ($proj_relation1 != "-")) && ($proj_relation0 == "nk")) {
		if($proj_relation1 == "nkmain") {
			// echo "<br>";
			echo "<select name=\"proj_relation3\">";
			$result3=""; $found3=0;
			$result3 = mysql_query("SELECT companyid, company, supplierid FROM tblcompany WHERE company_type=\"associate\" AND comptypassocrel=\"nkmain\"", $dbh);
			if($result3 != "") {
				while($myrow3 = mysql_fetch_row($result3)) {
				$found3 = 1;
				$companyid3 = $myrow3[0];
				$company3 = $myrow3[1];
				$supplierid3 = $myrow3[2];
				if($companyid3 == $proj_relation3) { $projrel3sel="selected"; }
				else { $projrel3sel=""; }
				echo "<option value=\"$companyid3\" $projrel3sel>$company3</option>";
				}
			}
			echo "</select>";
		} else if($proj_relation1 == "nkgroup") {
			// echo "<br>";
			echo "<select name=\"proj_relation3\">";
			if(($proj_relation3 == "") || ($proj_relation3 == "-")) {
				echo "<option value=\"-\">-</option>";
			}
			$result3=""; $found3=0;
			$result3 = mysql_query("SELECT companyid, company, supplierid FROM tblcompany WHERE company_type=\"associate\" AND comptypassocrel=\"nkgroup\"", $dbh);
			if($result3 != "") {
				while($myrow3 = mysql_fetch_row($result3)) {
				$found3 = 1;
				$companyid3 = $myrow3[0];
				$company3 = $myrow3[1];
				$supplierid3 = $myrow3[2];
				if($companyid3 == $proj_relation3) { $projrel3sel="selected"; }
				else { $projrel3sel=""; }
				echo "<option value=\"$companyid3\" $projrel3sel>$company3</option>";
				}
			}
			echo "</select>";
		}
		}
*/
		echo "</td></tr>";

		echo "<tr><th class='text-right'>PKII Project Category</th><td>";
		echo "<div class='form-group'><select class='form-control' name=\"pkiictgcd\">";
		if($pkiictgcd=='') { echo "<option value=''>-</option>"; }
		echo "<option value=''>".">>> A. NK-related Contracts of DCG <<<"."</option>";
		$res17query="SELECT idprojctgpkii, code, name FROM tblprojctgpkii WHERE code LIKE \"A.%\"ORDER BY seq ASC";
		$result17=""; $found17=0;
		$result17=$dbh2->query($res17query);
		if($result17->num_rows>0) {
			while($myrow17=$result17->fetch_assoc()) {
			$found17=1;
			$idprojctgpkii17 = $myrow17['idprojctgpkii'];
			$code17 = $myrow17['code'];
			$name17 = $myrow17['name'];
			if($code17==$pkiictgcd) { $pkiictgcdsel="selected"; } else { $pkiictgcdsel=""; }
			echo "<option value=\"$code17\" $pkiictgcdsel>$code17&nbsp;$name17</option>";
			} // while
		} // if
		echo "<option value=''>".">>> B. Non NK-related Contracts of DCG <<<"."</option>";
		$res17bquery="SELECT idprojctgpkii, code, name FROM tblprojctgpkii WHERE code LIKE \"B.%\"ORDER BY seq ASC";
		$result17b=""; $found17b=0;
		$result17b=$dbh2->query($res17bquery);
		if($result17b->num_rows>0) {
			while($myrow17b=$result17b->fetch_assoc()) {
			$found17b=1;
			$idprojctgpkii17b = $myrow17b['idprojctgpkii'];
			$code17b = $myrow17b['code'];
			$name17b = $myrow17b['name'];
			if($code17b==$pkiictgcd) { $pkiictgcdbsel="selected"; } else { $pkiictgcdbsel=""; }
			echo "<option value=\"$code17b\" $pkiictgcdbsel>$code17b&nbsp;$name17b</option>";
			} // while
		} // if
		echo "<option value=''>".">>> C. NK Group-Related Contracts of ICG <<<"."</option>";
		$res17cquery="SELECT idprojctgpkii, code, name FROM tblprojctgpkii WHERE code LIKE \"C.%\"ORDER BY seq ASC";
		$result17c=""; $found17c=0;
		$result17c=$dbh2->query($res17cquery);
		if($result17c->num_rows>0) {
			while($myrow17c=$result17c->fetch_assoc()) {
			$found17c=1;
			$idprojctgpkii17c = $myrow17c['idprojctgpkii'];
			$code17c = $myrow17c['code'];
			$name17c = $myrow17c['name'];
			if($code17c==$pkiictgcd) { $pkiictgcdcsel="selected"; } else { $pkiictgcdcsel=""; }
			echo "<option value=\"$code17c\" $pkiictgcdcsel>$code17c&nbsp;$name17c</option>";
			} // while
		} // if
		echo "<option value=''>".">>> D. Non NK-Related Contracts of ICG <<<"."</option>";
		$res17dquery="SELECT idprojctgpkii, code, name FROM tblprojctgpkii WHERE code LIKE \"D.%\"ORDER BY seq ASC";
		$result17d=""; $found17d=0;
		$result17d=$dbh2->query($res17dquery);
		if($result17d->num_rows>0) {
			while($myrow17d=$result17d->fetch_assoc()) {
			$found17d=1;
			$idprojctgpkii17d = $myrow17d['idprojctgpkii'];
			$code17d = $myrow17d['code'];
			$name17d = $myrow17d['name'];
			if($code17d==$pkiictgcd) { $pkiictgcddsel="selected"; } else { $pkiictgcddsel=""; }
			echo "<option value=\"$code17d\" $pkiictgcddsel>$code17d&nbsp;$name17d</option>";
			} // while
		} // if
		echo "</select></div>";
		echo "</td></tr>";

// 20190904
// add'l fields based on mam AAR's MoReportonNK spreadsheet.
// insert the following (in any order):
// - original currency
// - region
// - ENR

		echo "<tr><th class='text-right'>Classification</th><td>";
		if($proj_class == "domestic") { $projclassdomsel="selected"; $projclassicgsel=""; $projclassnonesel=""; }
		else if($proj_class == "icg") { $projclassdomsel=""; $projclassicgsel="selected"; $projclassnonesel=""; }
		echo "<div class='form-group'><select class='form-control' name=\"proj_class\">";
		echo "<option value=\"-\" $projclassnonesel>-</option>";
		echo "<option value=\"domestic\" $projclassdomsel>Domestic</option>";
		echo "<option value=\"icg\" $projclassicgsel>ICG</option>";
		echo "</select></div>";
		echo "</td></tr>";

		echo "<tr><th class='text-right'>Country</th><td>";
		echo "<div class='form-group'><select class='form-control' name=\"countrycd\">";
		if($countrycd == "") { echo "<option value=''>choose country</option>"; }
		$result9=""; $found9=0; $ctr9=0;
		$result9 = mysql_query("SELECT tblcountrycdid, cname, letter2cd, letter3cd FROM tblcountrycd ORDER BY cname ASC", $dbh);
		if($result9 != "") {
			while($myrow9 = mysql_fetch_row($result9)) {
			$found9 = 1;
			$tblcountrycdid9 = $myrow9[0];
			$cname9 = $myrow9[1];
			$letter2cd9 = $myrow9[2];
			$letter3cd9 = $myrow9[3];
			if($letter2cd9 == $countrycd) { $countrycdsel="selected"; } else { $countrycdsel=""; }
			echo "<option value=\"$letter2cd9\" $countrycdsel>$cname9 ($letter2cd9)</option>";
			}
		}
		echo "</select></div>";
		echo "</td></tr>";
		
		// 20190915
		echo "<tr><th class='text-right'>Region</th><td>";
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
    echo "</td></tr>";
		echo "<tr><th class='text-right'>ENR</th><td>";
//    echo "<i><font color='gray'>temp.disabled</font></i>";
    echo "<div class='form-group'><select class='form-control' name=\"projctgenr\">";
    if($enrctg=='') { echo "<option value='' selected>-</option>"; } else { echo "<option value=''>-</option>"; }
    $res19query=""; $result19=""; $found19=0; $ctr19=0;
    $res19query="SELECT idprojctgenr, code, name_e, name_j FROM tblprojctgenr ORDER BY seq ASC";
    $result19=$dbh2->query($res19query);
    if($result19->num_rows>0) {
      while($myrow19=$result19->fetch_assoc()) {
      $found19=1;
      $ctr19=$ctr19+1;
      $idprojctgenr19 = $myrow19['idprojctgenr'];
      $code19 = $myrow19['code'];
      $name_e19 = $myrow19['name_e'];
      $name_j19 = $myrow19['name_j'];
      if($enrctg!='') {
        if($code19==$enrctg) { $enrctgsel="selected"; } else { $enrctgsel=""; }
      } // if($enrctg!='')
      echo "<option value=\"$code19\" $enrctgsel>$code19&nbsp;$name_e19</option>";
      } // while
    } // if
    echo "</select></div>";
    echo "</td></tr>";

		echo "<tr><th class='text-right'>Sector</th><td>";
		echo "<div class='form-group'><select class='form-control' name=\"divisioncd\">";
		if($divisioncd == "") { echo "<option value=''>select sector</option>"; }
		$result15=""; $found15=0; $ctr15=0;
		$result15 = mysql_query("SELECT code, name_j, name_e FROM tblprojdivisionref ORDER BY idtblprojdivisionref ASC", $dbh);
		if($result15 != "") {
			while($myrow15 = mysql_fetch_row($result15)) {
			$found15 = 1;
			$code15 = $myrow15[0];
			$name_j15 = $myrow15[1];
			$name_e15 = $myrow15[2];
			if($code15 == $divisioncd) { $divisioncdsel="selected"; } else { $divisioncdsel=""; }
			echo "<option value=\"$code15\" $divisioncdsel>$name_e15</option>";
			}
		}
		echo "</select></div></td></tr>";

/* 20190915
		echo "<tr><th class='text-right'>Job type</th><td>";
		echo "<select name=\"jobtypcd\">";
		if($jobtypcd == "") { echo "<option value=''>select job type</option>"; }
		$result16=""; $found16=0; $ctr16=0;
		$result16 = mysql_query("SELECT idtblprojjobtypref, code, name_e FROM tblprojjobtypref ORDER BY idtblprojjobtypref ASC", $dbh);
		if($result16 != "") {
			while($myrow16 = mysql_fetch_row($result16)) {
			$found16 = 1;
			$idtblprojjobtypref16 = $myrow16[0];
			$code16 = $myrow16[1];
			$name_e16 = $myrow16[2];
			if($code16 == $jobtypcd) { $jobtypcdsel="selected"; } else { $jobtypcdsel=""; }
			echo "<option value=\"$code16\" $jobtypcdsel>$name_e16</option>";
			}
		}
		echo "</select></td></tr>";
*/

     echo "<tr><th class='text-right'>Services</th><td>";
		// 20181104
		// echo "<input name=\"proj_services\" value=\"$proj_services\">";
	// check if multiple values
	if (strpos($proj_services, ',') !== false) {
  //comma SIGN FOUND
	$projsvcarr = explode(',',$proj_services);
	$projsvc01 = str_replace(' ', '', $projsvcarr[0]);
	$projsvc02 = str_replace(' ', '', $projsvcarr[1]);
	$projsvc03 = str_replace(' ', '', $projsvcarr[2]);
	$projsvc04 = str_replace(' ', '', $projsvcarr[3]);
	$projsvc05 = str_replace(' ', '', $projsvcarr[4]);
	} else {
	$projsvc01=$proj_services;
	} // if
	$res18query="SELECT idprojctgservices, code, name FROM tblprojctgservices ORDER BY seq ASC";
	$result18=""; $found18=0; $ctr18=0;
	$result18=$dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18=$result18->fetch_assoc()) {
		$found18=1;
		$ctr18=$ctr18+1;
		$idprojctgservices18=$myrow18['idprojctgservices'];
		$code18=$myrow18['code'];
		$name18=$myrow18['name'];
		if($projsvc01==$code18||$projsvc02==$code18||$projsvc03==$code18||$projsvc04==$code18||$projsvc05==$code18) { $id18found='checked'; } else { $id18found=''; }
		echo "<div class='form-group'><input class='form-control' type='checkbox' name='prjsvc[]' value='$code18' $id18found>$code18 - $name18<br>";
		} // while
	} // if
		echo "</td></tr>";
     echo "<tr><th class='text-right'>Period</th><td><div class='form-group'><input class='form-control' name=\"proj_period\" value=\"$proj_period\"></div></td></tr>";

     echo "<tr><th valign=top class='text-right'>Duration from</th>";
     echo "<td>Current: ".date('Y-M-d', strtotime($date_start))." ";
     echo "<a href=projchgdatefrom.php?loginid=$loginid&pid=$pid&pdfr=$date_start><font size=\"1\"><i>Change</i></font></a>";
     echo "</td></tr>";

     echo "<tr><th valign=top class='text-right'>Duration to</th>";
     if($date_end!='0000-00-00') {
     echo "<td>Current: ".date('Y-M-d', strtotime($date_end))." ";
     } else {
     echo "<td>Current: $date_end ";
     } //if-else
     echo "<a href=projchgdateto.php?loginid=$loginid&pid=$pid&pdto=$date_end><font size=\"1\"><i>Change</i></font></a>";
     echo "</td></tr>";

		echo "<tr><th class='text-right'>Mobilization date</th><td><div class='form-group'><input class='form-control' type='date' name='date_mob' value='$date_mob'></div></td></tr>";

// client
	/*
		echo "<tr><th class='text-right'>Client</th><td>";
		echo "<input id=\"radio1\" type=\"radio\" name=\"clientsw\" value=\"company\" $rdiocompanyid>";
		echo "<select name=\"companyid\" onchange=\"radioselect1()\">";
		if((($companyid=="") && ($contactid=="")) || (($companyid==0) && ($contactid==0))) {
			echo "<option value=\"0\">select company</option>";
		}
		$result12=""; $found12=0; $ctr12=0;

		$result12 = mysql_query("SELECT companyid, company, branch FROM tblcompany WHERE (company IS NOT NULL OR company != '') ORDER BY company ASC", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12=1;
			$companyid12 = $myrow12[0];
			$company12 = $myrow12[1];
			$branch12 = $myrow12[2];
			if($companyid12 == $companyid) { $clientcompanysel="selected"; } else { $clientcompanysel=""; }
			echo "<option value=\"$companyid12\" $clientcompanysel>$company12";
			if($branch12 != "") { echo " - $branch12"; }
			echo "</option>";
			}
		}
		echo "</select>";
	echo "<br /><input id=\"radio2\" type=\"radio\" name=\"clientsw\" value=\"contactperson\" $rdiocontactid>";
		echo "<select name=\"contactid\" onchange=\"radioselect2()\">";
		if((($companyid=="") && ($contactid=="")) || (($companyid==0) && ($contactid11==0))) {
			echo "<option value=\"0\">select individual person</option>";
		}
		$result14=""; $found14=0; $ctr14=0;
		$result14 = mysql_query("SELECT tblcontact.contactid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact ORDER BY tblcontact.name_first ASC, tblcontact.name_last ASC", $dbh);
		if($result14 != "") {
			while($myrow14 = mysql_fetch_row($result14)) {
			$found14=1;
			$contactid14 = $myrow14[0];
			$companyid14 = $myrow14[1];
			$employeeid14 = $myrow14[2];
			$name_last14 = $myrow14[3];
			$name_first14 = $myrow14[4];
			$name_middle14 = $myrow14[5];
			if($contactid14 == $contactid) { $clientcontactsel="selected"; } else { $clientcontactsel=""; }
			echo "<option value=\"$contactid14\" $clientcontactsel>$name_first14";
			if($name_middle14 != "") { echo "&nbsp;$name_middle14[0]."; }
			echo "&nbsp;$name_last14";
			if($employeeid14 != '') { echo "&nbsp;($employeeid14)"; }
			echo "</option>";
			}
		}
		echo "</select>";
		echo "</td></tr>";
	*/
		echo "<tr><th class='text-right'>Client</th><td>";
		if($fk_companyid_client11!=0) { $rda1clientswchk="checked"; } else { $rda1clientswchk=""; }
		echo "<input type='radio' id='radioa1' name='clientsw' value='company' $rda1clientswchk>";
		echo "<div class='form-group'><select class='form-control' name='client_companyid' onchange='radioselecta1()'>";
		echo "<option value=''>select company</option>";
		// query tblcompany
		$res12query="SELECT companyid, company, branch FROM tblcompany WHERE company<>'' ORDER BY company ASC";
		$result12=""; $found12=0; $ctr12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$ctr12=$ctr12+1;
			$companyid12 = $myrow12['companyid'];
			$company12 = $myrow12['company'];
			$branch12 = $myrow12['branch'];
			if($companyid12==$fk_companyid_client11) { $compid12sel="selected"; } else { $compid12sel=""; }
			echo "<option value='$companyid12' $compid12sel>$company12";
			if($branch12!='') { echo "&nbsp;-&nbsp;$branch12"; }
			echo "</option>";
			} // while
		} // if
		echo "</select></div>";
/* 20190915
		echo "<br>";
		if($fk_contactid_client11!=0) { $rda2clientswchk="checked"; } else { $rda2clientswchk=""; }
		echo "<input type='radio' id='radioa2' name='clientsw' value='contactperson' $rda2clientswchk>";
		echo "<select name='client_contactid' onchange='radioselecta2()'>";
		echo "<option value=''>select person</option>";
		// query tblcontact
		$res14query="SELECT tblcontact.contactid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact ORDER BY tblcontact.name_first ASC, tblcontact.name_last ASC";
		$result14=""; $found14=0; $ctr14=0;
		$result14=$dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
			$found14=1;
			$ctr14=$ctr14+1;
			$contactid14 = $myrow14['contactid'];
			$companyid14 = $myrow14['companyid'];
			$employeeid14 = $myrow14['employeeid'];
			$name_last14 = $myrow14['name_last'];
			$name_first14 = $myrow14['name_first'];
			$name_middle14 = $myrow14['name_middle'];
			if($contactid14==$fk_contactid_client11) { $contid14sel="selected"; } else { $contid14sel=""; }
			echo "<option value='$contactid14' $contid14sel>$name_first14&nbsp;";
			if($name_middle14!='') { echo "$name_middle14[0].&nbsp;"; }
			if($name_last14!='') { echo "$name_last14"; }
			echo "</option>";
			} // while
		} // if
		echo "</select>";
*/
		echo "</td></tr>";

// funding agency
		echo "<tr><th class='text-right'>Funding agency</th><td>";
		if($fk_companyid_funding_agency11!=0) { $rdb1fundagenswchk="checked"; } else { $rdb1fundagenswchk=""; }
		echo "<input type='radio' id='radiob1' name='fundingagencysw' value='company' $rdb1fundagenswchk>";
		echo "<div class='form-group'><select class='form-control' name='fundingagency_companyid' onchange='radioselectb1()'>";
		echo "<option value=''>select company</option>";
		// query tblcompany
		$res15query="SELECT companyid, company, branch FROM tblcompany WHERE company<>'' ORDER BY company ASC";
		$result15=""; $found15=0; $ctr15=0;
		$result15=$dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15=$result15->fetch_assoc()) {
			$found15=1;
			$ctr15=$ctr15+1;
			$companyid15 = $myrow15['companyid'];
			$company15 = $myrow15['company'];
			$branch15 = $myrow15['branch'];
			if($companyid15==$fk_companyid_funding_agency11) { $compid15sel="selected"; } else { $compid15sel=""; }
			echo "<option value='$companyid15' $compid15sel>$company15";
			if($branch15!='') { echo "&nbsp;-&nbsp;$branch15"; }
			echo "</option>";
			} // while
		} // if
		echo "</select></div>";
/* 20190915
		echo "<br>";
		if($fk_contactid_funding_agency11!=0) { $rdb2fundagenswchk="checked"; } else { $$rdb2fundagenswchk=""; }
		echo "<input type='radio' id='radiob2' name='fundingagencysw' value='contactperson' $rdb2fundagenswchk>";
		echo "<select name='fundingagency_contactid' onchange='radioselectb2()'>";
		echo "<option value=''>select person</option>";
		// query tblcontact
		$res16query="SELECT tblcontact.contactid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact ORDER BY tblcontact.name_first ASC, tblcontact.name_last ASC";
		$result16=""; $found16=0; $ctr16=0;
		$result16=$dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16=$result16->fetch_assoc()) {
			$found16=1;
			$ctr16=$ctr16+1;
			$contactid16 = $myrow16['contactid'];
			$companyid16 = $myrow16['companyid'];
			$employeeid16 = $myrow16['employeeid'];
			$name_last16 = $myrow16['name_last'];
			$name_first16 = $myrow16['name_first'];
			$name_middle16 = $myrow16['name_middle'];
			if($contactid16==$fk_contactid_funding_agency11) { $contid16sel="selected"; } else { $contid16sel=""; }
			echo "<option value='$contactid16' $contid16sel>$name_first16&nbsp;";
			if($name_middle16!='') { echo "$name_middle16[0].&nbsp;"; }
			if($name_last16!='') { echo "$name_last16"; }
			echo "</option>";
			} // while
		} // if
		echo "</select>";
*/
		echo "</td></tr>";

// implementing agency
		echo "<tr><th class='text-right'>Implementing agency</th><td>";
		if($fk_companyid_implementing_agency11!=0) { $rdc1impagenswchk="checked"; } else { $rdc1impagenswchk=""; }
		echo "<input type='radio' id='radioc1' name='implementingagencysw' value='company' $rdc1impagenswchk>";
		echo "<div class='form-group'><select class='form-control' name='implementingagency_companyid' onchange='radioselectc1()'>";
		echo "<option value=''>select company</option>";
		// query tblcompany
		$res17query="SELECT companyid, company, branch FROM tblcompany WHERE company<>'' ORDER BY company ASC";
		$result17=""; $found17=0; $ctr17=0;
		$result17=$dbh2->query($res17query);
		if($result17->num_rows>0) {
			while($myrow17=$result17->fetch_assoc()) {
			$found17=1;
			$ctr17=$ctr17+1;
			$companyid17 = $myrow17['companyid'];
			$company17 = $myrow17['company'];
			$branch17 = $myrow17['branch'];
			if($companyid17==$fk_companyid_implementing_agency11) { $compid17sel="selected"; } else { $compid17sel=""; }
			echo "<option value='$companyid17' $compid17sel>$company17";
			if($branch17!='') { echo "&nbsp;-&nbsp;$branch17"; }
			echo "</option>";
			} // while
		} // if
		echo "</select></div>";
/* 20190915
		echo "<br>";
		if($fk_contactid_implementing_agency11!=0) { $rdc2impagenswchk="checked"; } else { $rdc2impagenswchk=""; }
		echo "<input type='radio' id='radioc2' name='implementingagencysw' value='contactperson' $rdc2impagenswchk>";
		echo "<select name='implementingagency_contactid' onchange='radioselectc2()'>";
		echo "<option value=''>select person</option>";
		// query tblcontact
		$res18query="SELECT tblcontact.contactid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblcontact ORDER BY tblcontact.name_first ASC, tblcontact.name_last ASC";
		$result18=""; $found18=0; $ctr18=0;
		$result18=$dbh2->query($res18query);
		if($result18->num_rows>0) {
			while($myrow18=$result18->fetch_assoc()) {
			$found18=1;
			$ctr18=$ctr18+1;
			$contactid18 = $myrow18['contactid'];
			$companyid18 = $myrow18['companyid'];
			$employeeid18 = $myrow18['employeeid'];
			$name_last18 = $myrow18['name_last'];
			$name_first18 = $myrow18['name_first'];
			$name_middle18 = $myrow18['name_middle'];
			if($contactid18==$fk_contactid_implementing_agency11) { $contid18sel="selected"; } else { $contid18sel=""; }
			echo "<option value='$contactid18' $contid18sel>$name_first18&nbsp;";
			if($name_middle18!='') { echo "$name_middle18[0].&nbsp;"; }
			if($name_last18!='') { echo "$name_last18"; }
			echo "</option>";
			} // while
		} // if
		echo "</select>";
*/
		echo "</td></tr>";

     echo "<tr><th  class='text-right'>Status</th><td>";

     // echo "Current: $projstatus<br>";
		if($projstatus == "On-going") { $projstatusongoing="checked='checked'"; $projstatusfinished=""; $projstatusonhold=""; $projstatusextended=""; $projstatusnotstarted="";
		} elseif($projstatus == "Finished") { $projstatusfinished = "checked='checked'"; $projstatusongoing = ""; $projstatusonhold=""; $projstatusextended = ""; $projstatusnotstarted = "";
		} elseif ($projstatus == "On-hold") { $projstatusonhold="checked='checked'"; $projstatusextended = ""; $projstatusongoing = ""; $projstatusfinished = ""; $projstatusnotstarted = "";
		} elseif ($projstatus == "Extended") { $projstatusextended = "checked='checked'"; $projstatusongoing = ""; $projstatusfinished = ""; $projstatusonhold=""; $projstatusnotstarted = "";
		} elseif ($projstatus == "Not Started") { $projstatusnotstarted = "checked='checked'"; $projstatusongoing = ""; $projstatusfinished = ""; $projstatusonhold=""; $projstatusextended = "";
		} // if-else

     // echo "og:$projstatusongoing,f:$projstatusfinished,oh:$projstatusonhold,ext:$projstatusextended,ns:$projstatusnotstarted<br>";
    echo "<input type=radio name=\"projstatus\" value=\"On-going\" $projstatusongoing>&nbsp;On-going<br>";
	 // 20190915
     // echo "<input type=radio name=\"projstatus\" value=\"Finished\" $projstatusfinished>Finished<br>";
	 echo "<input type=radio name=\"projstatus\" value=\"Finished\" $projstatusfinished>&nbsp;Completed<br>";
     echo "<input type=radio name=\"projstatus\" value=\"On-hold\" $projstatusonhold>&nbsp;On-hold<br>";
     echo "<input type=radio name=\"projstatus\" value=\"Extended\" $projstatusextended>&nbsp;Extended<br>";
     echo "<input type=radio name=\"projstatus\" value=\"Not Started\" $projstatusnotstarted>&nbsp;Not Started</td></tr>";
//     echo "vartest projstatus:$projstatus<br>";

     echo "<tr><th valign=top class='text-right'>Remarks</th><td><div class='form-group'><textarea class='form-control' name=proj_remarks rows=5 cols=60>$proj_remarks</textarea></div></td></tr>";
   ?>

    <!-- 20210728 add'l fields for TL, DTL & PC -->
    <tr><th valign=top class='text-right'>Project Team Leader</th><td><div class='form-group'>
<?php
    echo "<select class='form-control' name=\"empidtl\">";
    if($empidtl=="") {
    echo "<option value='' selected>-</option>";
    } else {
    echo "<option value=''>-</option>";
    } //if-else
    $res2aquery=""; $result2a=""; $found2a=0; $empidtlsel="";
    $res2aquery="SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.contact_type='personnel' AND tblemployee.emp_record=\"active\" ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC";
    $result2a=$dbh2->query($res2aquery);
    if($result2a->num_rows>0) {
        while($myrow2a=$result2a->fetch_assoc()) {
        $found2a=1;
        $employeeid2a = $myrow2a['employeeid'];
        $name_first2a = $myrow2a['name_first'];
        $name_last2a = $myrow2a['name_last'];
        $name_middle2a = $myrow2a['name_middle'];
        $email12a = $myrow2a['email1'];
        if($employeeid2a==$empidtl) { $empidtlsel="selected"; } else { $empidtlsel=""; } //if-else
        echo "<option value=\"$employeeid2a\" $empidtlsel>$employeeid2a - $name_last2a, $name_first2a $name_middle2a[0]</option>";
        } //while
    } //if
    echo "</select>";
?>
    </div></td></tr>

    <tr><th valign=top class='text-right'>Deputy Team Leader</th><td><div class='form-group'>
<?php
    echo "<select class='form-control' name=\"empiddtl\">";
    if($empiddtl=="") {
    echo "<option value='' selected>-</option>";
    } else {
    echo "<option value=''>-</option>";
    } //if-else
    $res2bquery=""; $result2b=""; $found2b=0; $empiddtlsel="";
    $res2bquery="SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.contact_type='personnel' AND tblemployee.emp_record=\"active\" ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC";
    $result2b=$dbh2->query($res2bquery);
    if($result2b->num_rows>0) {
        while($myrow2b=$result2b->fetch_assoc()) {
        $found2b=1;
        $employeeid2b = $myrow2b['employeeid'];
        $name_first2b = $myrow2b['name_first'];
        $name_last2b = $myrow2b['name_last'];
        $name_middle2b = $myrow2b['name_middle'];
        $email12b = $myrow2b['email1'];
        if($employeeid2b==$empiddtl) { $empiddtlsel="selected"; } else { $empiddtlsel=""; } //if-else
        echo "<option value=\"$employeeid2b\" $empiddtlsel>$employeeid2b - $name_last2b, $name_first2b $name_middle2b[0]</option>";
        } //while
    } //if
    echo "</select>";
?>
    </div></td></tr>

    <tr><th valign=top class='text-right'>Project Coordinator</th><td><div class='form-group'>
<?php
    echo "<select class='form-control' name=\"empidpc\">";
    if($empidpc=="") {
    echo "<option value='' selected>-</option>";
    } else {
    echo "<option value=''>-</option>";
    } //if
    $res2cquery=""; $result2c=""; $found2c=0; $empidpcsel="";
    $res2cquery="SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.contact_type='personnel' AND tblemployee.emp_record=\"active\" ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC";
    $result2c=$dbh2->query($res2cquery);
    if($result2c->num_rows>0) {
        while($myrow2c=$result2c->fetch_assoc()) {
        $found2c=1;
        $employeeid2c = $myrow2c['employeeid'];
        $name_first2c = $myrow2c['name_first'];
        $name_last2c = $myrow2c['name_last'];
        $name_middle2c = $myrow2c['name_middle'];
        $email12c = $myrow2c['email1'];
        if($employeeid2c==$empidpc) { $empidpcsel="selected"; } else { $empidpcsel=""; } //if-else
        echo "<option value=\"$employeeid2c\" $empidpcsel>$employeeid2c - $name_last2c, $name_first2c $name_middle2c[0]</option>";
        } //while
    } //if
    echo "</select>";
?>
    </div></td></tr>

     <tr><th valign=top class='text-right'>Account Officer</th><td><div class='form-group'>
   <?php
		echo "<select class='form-control'name='employeeid'>";
		if($employeeid=='' || $employeeid=='selec') {
			echo "<option value='' selected>-</option>";
		} else {
			echo "<option value=''>-</option>";
		} // if-else
		$res2query="SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.email1 FROM tblcontact LEFT JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.contact_type='personnel' AND tblemployee.emp_record=\"active\" ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC";
		$result2=""; $found2=0;
		$result2=$dbh2->query($res2query);
		if($result2->num_rows>0) {
			while($myrow2=$result2->fetch_assoc()) {
			$found2=1;
			$employeeid2 = $myrow2['employeeid'];
			$name_first2 = $myrow2['name_first'];
			$name_last2 = $myrow2['name_last'];
			$email12 = $myrow2['email1'];
			if($employeeid2==$employeeid) { $acctofcrempidsel="selected"; } else { $acctofcrempidsel=""; }
			echo "<option value='$employeeid2' $acctofcrempidsel>$employeeid2 - $name_last2, $name_first2</option>";
			} // while
		} // if
		echo "</select></div>";
		echo "</td></tr>";

/*     if ($employeeid != '')
     {
	echo "<td>Current: $employeeid - $name_first $name_last - <a href='mailto:$email'>$email</a><br>";
     }
     else
     {
	echo "<td>Current: n/a<br>";
     }


     $result3 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, name_middle FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.term_resign = '0000-00-00' ORDER BY tblcontact.name_last", $dbh);

     echo "Change to <select name=employeeid>";
     echo "<option value=''>n/a</option>";

     while ($myrow3 = mysql_fetch_row($result3))
     {    
       $employeeid2 = $myrow3[0];
       $name_first = $myrow3[1];
       $name_last = $myrow3[2];
       $name_middle = $myrow3[3];

       echo "<option value=$employeeid2>$name_last, $name_first $name_middle[0].</option>";
     }
  
     echo "</select></td></tr>";
	*/
		// echo "<tr><td colspan=2>&nbsp;</td></tr>"; 

     echo "<tr><td colspan=\"2\" align=\"center\"><div class='form-group'><button type='submit' class='btn btn-success'>Update</button></div></td></tr>";
     echo "</form>";

    echo "<tr><th colspan=\"2\">File attachment/s</th></tr>";
    // 20190915
	// echo "<tr><th class='text-right'><i><font color='gray'>File attachment #1</font></i></th><td><i><input type='button' value='Browse'><font color='gray'>->temp.disabled</font></i></td></tr>";
	echo "<tr><th class='text-right'>PDS File Attachment</th><td>";

  echo "<form enctype=\"multipart/form-data\" method=\"POST\" action=\"projfile1attach.php?pid=$pid&loginid=$loginid\" name=\"projfile1attach\">";
  echo "<input type=\"hidden\" name=\"proj_code\" value=\"$proj_code\">";
  echo "<input type=\"hidden\" name=\"projectid\" value=\"$projectid\">";
    echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000000\" />";
    echo "<input name=\"uploadedfile\" type=\"file\" />";
  echo "<button type=\"submit\" class=\"btn btn-success\">Save file</button>";
  echo "</form>";

    if($filename1!='') {
  echo "<br><a href='$filepath1/$filename1' target='_blank'>$filename1</a>&nbsp;";
  echo "<form method=\"POST\" action=\"projfile1del.php?pid=$pid&loginid=$loginid\" name=\"projfile1del\">";
  echo "<input type=\"hidden\" name=\"proj_code\" value=\"$proj_code\">";
  echo "<input type=\"hidden\" name=\"projectid\" value=\"$projectid\">";
  echo "<input type=\"hidden\" name=\"filename1\" value=\"$filename1\">";
  echo "<input type=\"hidden\" name=\"filepath1\" value=\"$filepath1\">";
  echo "<button type='submit' class='btn btn-danger'>Delete file</button>";
  echo "</form>";
    } // if
	echo "</td></tr>";

	echo "<tr><th class='text-right'><i><font color='gray'>File attachment #2</font></i></th><td><i><input type='button' value='Browse'><font color='gray'>->temp.disabled</font></i></td></tr>";
	echo "<tr><th class='text-right'><i><font color='gray'>File attachment #3</font></i></th><td><i><input type='button' value='Browse'><font color='gray'>->temp.disabled</font></i></td></tr>";

     echo "</table>";
     echo "<p>";

     echo "<a href=\"project2.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

     $resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}
?>

<script language="javascript">

// This function goes through the options for the given
// drop down box and removes them in preparation for
// a new set of values

function emptyList( box ) {
	// Set each option to null thus removing it
	while ( box.options.length ) box.options[0] = null;
}

// This function assigns new drop down options to the given
// drop down box from the list of lists specified

function fillList( box, arr ) {
	// arr[0] holds the display text
	// arr[1] are the values

	for ( i = 0; i < arr[0].length; i++ ) {

		// Create a new drop down option with the
		// display text and value from arr

		option = new Option( arr[0][i], arr[1][i] );

		// Add to the end of the existing options

		box.options[box.length] = option;
	}

	// Preselect option 0

	box.selectedIndex=0;
}

// This function performs a drop down list option change by first
// emptying the existing option list and then assigning a new set

function changeList( box ) {
	// Isolate the appropriate list by using the value
	// of the currently selected option

	list = lists[box.options[box.selectedIndex].value];

	// Next empty the slave list

	emptyList( box.form.slave );

	// Then assign the new list values

	fillList( box.form.slave, list );
}

//
// dynamicpulldown0
//

function dynamicpulldown0()
{
    var htmlStr = "";
    var selectedprojrel0 = document.getElementById('dynprojrel0').value;
//    alert(selectedprojrel0);
    if(selectedprojrel0 == 'nk')
    {
      htmlStr = htmlStr + "<div class='form-group'><select class='form-control' id=\"proj_relation1list\" onclick=\"getSelected()\" onchange=\"dynamicpulldown1()\">";   
			<?php
			if(($proj_relation0 == "") || ($proj_relation0 == "-")) {
			?>
			htmlStr = htmlStr + "<option value=\"-\">-</option>";
			<?php
			}
			$result12=""; $found12=0;
			$result12 = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE codeprev='nk' AND level=1", $dbh);
			if($result12 != "") {
				while($myrow12 = mysql_fetch_row($result12)) {
				$found12 = 1;
				$projrelrefid12 = $myrow12[0];
				$code12 = $myrow12[1];
				$name12 = $myrow12[2];
				if((($proj_relation1 != "") || ($proj_relation != "-")) && ($proj_relation1 == $code12)) { $projrel1sel="selected"; } else { $projrel1sel=""; }
			?>
				htmlStr = htmlStr + "<option value=\"<?=$code12?>\" <?=$projrel1sel?>><?=$name12?></option>";
			<?php			
				}
			}
			?>
			htmlStr = htmlStr + "</select></div>";
    }
		else if(selectedprojrel0 == 'others')
		{
      htmlStr = htmlStr + "<div class='form-group'><select class='form-control' id=\"proj_relation1list\" onclick=\"getSelected()\">";
			<?php
			if(($proj_relation0 == "") || ($proj_relation0 == "-")) {
			?>
			htmlStr = htmlStr + "<option value=\"-\">-</option>";
			<?php
			}
			$result12b=""; $found12b=0;
			$result12b = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE codeprev='others' AND level=1", $dbh);
			if($result12b != "") {
				while($myrow12b = mysql_fetch_row($result12b)) {
				$found12b=1;
				$projrelrefid12b = $myrow12b[0];
				$code12b = $myrow12b[1];
				$name12b = $myrow12b[2];
				if((($proj_relation1 != "") || ($proj_relation != "-")) && ($proj_relation1 == $code12b)) { $projrel2sel="selected"; } else { $projrel2sel=""; }
			?>
				htmlStr = htmlStr + "<option value=\"<?=$code12b?>\" <?=$projrel2sel?>><?=$name12b?></option>";
			<?php
				}
			}
			?>
			htmlStr = htmlStr + "</select></div>";
		}
    document.getElementById('myDynamicPullDown0').innerHTML = htmlStr;

}


function dynamicpulldown1()
{
    var htmlStr = "";
    var selectedprojrel1 = document.getElementById('proj_relation1list').value;
 // alert(selectedprojrel1);
 // alert("this is a test");

    if(selectedprojrel1 == 'nkmain') {
      htmlStr = htmlStr + "<div class='form-group'><select class='form-control' id=\"proj_relation2list\" onclick=\"getSelected1()\" onchange=\"dynamicpulldown2()\">";   
			<?php
			// if(($proj_relation1 == "") || ($proj_relation1 == "-")) {
			?>
			htmlStr = htmlStr + "<option value=\"-\">-</option>";
			<?php
			// }
				$result11 = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE codeprev='nkmain' AND level=2", $dbh);
			if($result11 != '') {
				while($myrow11 = mysql_fetch_row($result11)) {
					$projrelrefid11 = $myrow11[0];
					$code11 = $myrow11[1];
					$name11 = $myrow11[2];
					if((($proj_relation2 != "") || ($proj_relation2 != "-")) && ($proj_relation2 == $code11)) { $projrel2sel="selected"; } else { $projrel2sel=""; }
			?>
					htmlStr = htmlStr + "<option value=\"<?=$code11?>\" <?=$projrel2sel?>><?=$name11?></option>";
			<?php
				}
			}
			?>
			htmlStr = htmlStr + "</select></div>";

    } else if(selectedprojrel1 == 'nkgroup') {
      htmlStr = htmlStr + "<div class='form-group'><select class='form-control' id=\"proj_relation2list\" onclick=\"getSelected1()\">";   
			<?php
			// if(($proj_relation1 == "") || ($proj_relation1 == "-")) {
			?>
			htmlStr = htmlStr + "<option value=\"-\">-</option>";
			<?php
			// }
				$result11b = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE codeprev='nkgroup' AND level=2", $dbh);
			if($result11b != '') {
				while($myrow11b = mysql_fetch_row($result11b)) {
					$projrelrefid11b = $myrow11b[0];
					$code11b = $myrow11b[1];
					$name11b = $myrow11b[2];
					if((($proj_relation2 != "") || ($proj_relation2 != "-")) && ($proj_relation2 == $code11b)) { $projrel2bsel="selected"; } else { $projrel2bsel=""; }
			?>
					htmlStr = htmlStr + "<option value=\"<?=$code11b?>\" <?=$projrel2bsel?>><?=$name11b?></option>";
			<?php
				}
			}
			?>
			htmlStr = htmlStr + "</select></div>";
		}
    document.getElementById('myDynamicPullDown1').innerHTML = htmlStr;
		// document.forms["updateform"].proj_relation1.options.selected = true;
		// alert(selectedprojrel1);
    // document.updateform.submit();
}

function dynamicpulldown2()
{
    var htmlStr = "";
    var selectedprojrel2 = document.getElementById('proj_relation2list').value;
 // alert(selectedprojrel2);
 // alert("this is a test");

    if(selectedprojrel2 == 'nkoei') {
      htmlStr = htmlStr + "<div class='form-group'><select class='form-control' id=\"proj_relation3list\" onclick=\"getSelected2()\">";   
			<?php
			// if(($proj_relation2 == "") || ($proj_relation2 == "-")) {
			?>
			htmlStr = htmlStr + "<option value=\"-\">-</option>";
			<?php
			// }
				$result14 = mysql_query("SELECT projrelrefid, code, name FROM tblprojrelref WHERE codeprev='nkoei' AND level=3", $dbh);
			if($result14 != '') {
				while($myrow14 = mysql_fetch_row($result14)) {
					$projrelrefid14 = $myrow14[0];
					$code14 = $myrow14[1];
					$name14 = $myrow14[2];
					if((($proj_relation3 != "") || ($proj_relation3 != "-")) && ($proj_relation3 == $code14)) { $projrel3sel="selected"; } else { $projrel3sel=""; }
			?>
					htmlStr = htmlStr + "<option value=\"<?=$code14?>\" <?=$projrel3sel?>><?=$name14?></option>";
			<?php
				}
			}
			?>
			htmlStr = htmlStr + "</select></div>";

    }
    document.getElementById('myDynamicPullDown2').innerHTML = htmlStr;
		// document.forms["updateform"].proj_relation3.options.selected = true;
		// alert(selectedprojrel1);
    // document.updateform.submit();
}

function getSelected()
{
     document.updateform.proj_relation1.value = document.getElementById('proj_relation1list').value;
}

function getSelected1()
{
     document.updateform.proj_relation2.value = document.getElementById('proj_relation2list').value;
}

function getSelected2()
{
     document.updateform.proj_relation3.value = document.getElementById('proj_relation3list').value;
}

function radioselect2()
{
     document.getElementById('radio2').checked = true;
}
function radioselect1()
{
     document.getElementById('radio1').checked = true;	
}
function radioselecta1()
{
     document.getElementById('radioa1').checked = true;	
}
function radioselecta2()
{
     document.getElementById('radioa2').checked = true;	
}
function radioselectb1()
{
     document.getElementById('radiob1').checked = true;	
}
function radioselectb2()
{
     document.getElementById('radiob2').checked = true;	
}
function radioselectc1()
{
     document.getElementById('radioc1').checked = true;	
}
function radioselectc2()
{
     document.getElementById('radioc2').checked = true;	
}
function radioselecta1()
{
     document.getElementById('radioa1').checked = true;	
}
function radioselecta2()
{
     document.getElementById('radioa2').checked = true;	
}
function radioselectb1()
{
     document.getElementById('radiob1').checked = true;	
}
function radioselectb2()
{
     document.getElementById('radiob2').checked = true;	
}
function radioselectc1()
{
     document.getElementById('radioc1').checked = true;	
}
function radioselectc2()
{
     document.getElementById('radioc2').checked = true;	
}

//
//20190909tjm
//

$(document).ready(function(){
	$('#proj_relation1list').on('change',function(){
		var projectCode = $('#proj_relation1list option:selected').val();
		if(projectCode == 'nkgroup'){
			$('#myDynamicPullDown2 #proj_relation3list').css('display','none');
		} else{
			$('#myDynamicPullDown2 #proj_relation3list').css('display','block');
		}
		$('#tblTesting #proj_relation2list').css('display','none');
		$('#tblTesting #proj_relation3list').css('display','none');

	});
	$('select[name=proj_relation1a]').on('change',function(){
		$("#nkotherrel").prop('checked', true);
	});

	$('select[name=proj_relation1b]').on('change',function(){
		$("#nkotherrel1").prop('checked', true);
			$('#myDynamicPullDown2 #proj_relation3list').css('display','none');
			$('#myDynamicPullDown1 #proj_relation2list').css('display','none');

	});
});
</script>

<?php
mysql_close($dbh);
$dbh2->close();
?>
