<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idtblhrtapaygrp = (isset($_GET['loginid'])) ? $_GET['idpg'] :'';

$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$idhrtapayshiftctg = (isset($_POST['idhrtapayshiftctg'])) ? $_POST['idhrtapayshiftctg'] :'';
$bankacctid = (isset($_POST['bankacctid'])) ? $_POST['bankacctid'] :'';
if(!isset($idhrtapayshiftctg) || empty($idhrtapayshiftctg)) { $idhrtapayshiftctg=0; }
if(!isset($bankacctid) || empty($bankacctid)) { $bankacctid=0; }

$restdaysun = (isset($_POST['restdaysun'])) ? $_POST['restdaysun'] :'';
if($restdaysun == "on") { $restdaysunval="1"; } else { $restdaysunval="0"; }
$restdaymon = (isset($_POST['restdaymon'])) ? $_POST['restdaymon'] :'';
if($restdaymon == "on") { $restdaymonval="1"; } else { $restdaymonval="0"; }
$restdaytue = (isset($_POST['restdaytue'])) ? $_POST['restdaytue'] :'';
if($restdaytue == "on") { $restdaytueval="1"; } else { $restdaytueval="0"; }
$restdaywed = (isset($_POST['restdaywed'])) ? $_POST['restdaywed'] :'';
if($restdaywed == "on") { $restdaywedval="1"; } else { $restdaywedval="0"; }
$restdaythu = (isset($_POST['restdaythu'])) ? $_POST['restdaythu'] :'';
if($restdaythu == "on") { $restdaythuval="1"; } else { $restdaythuval="0"; }
$restdayfri = (isset($_POST['restdayfri'])) ? $_POST['restdayfri'] :'';
if($restdayfri == "on") { $restdayfrival="1"; } else { $restdayfrival="0"; }
$restdaysat = (isset($_POST['restdaysat'])) ? $_POST['restdaysat'] :'';
if($restdaysat == "on") { $restdaysatval="1"; } else { $restdaysatval="0"; }
$restdayval = $restdaysunval.$restdaymonval.$restdaytueval.$restdaywedval.$restdaythuval.$restdayfrival.$restdaysatval;

$vlbal = (isset($_POST['vlbal'])) ? $_POST['vlbal'] :'';
if($vlbal == "") { $vlbal=0; }
// $vlbal = round($vlbal, 2);

// $vlcshcnv = (isset($_POST['vlcshcnv'])) ? $_POST['vlcshcnv'] :'';
// if($vlcshcnv == "") { $vlcshcnv=0; }
// $vlcshcnv = round($vlcshcnv, 2);

// $vlaccumcr = (isset($_POST['vlaccumcr'])) ? $_POST['vlaccumcr'] :'';
// if($vlaccumcr == "") { $vlaccumcr=0; }
// $vlaccumcr = round($vlaccumcr, 2);

// $vlretcr = (isset($_POST['vlretcr'])) ? $_POST['vlretcr'] :'';
// if($vlretcr == "") { $vlretcr=0; }
// $vlretcr = round($vlretcr, 2);

$slbal = (isset($_POST['slbal'])) ? $_POST['slbal'] :'';
if($slbal == "") { $slbal=0; }
// $slbal = round($slbal, 2);

// $slcshcnv = (isset($_POST['slcshcnv'])) ? $_POST['slcshcnv'] :'';
// if($slcshcnv == "") { $slcshcnv=0; }
// $slcshcnv = round($slcshcnv, 2);

// $slaccumcr = (isset($_POST['slaccumcr'])) ? $_POST['slaccumcr'] :'';
// if($slaccumcr == "") { $slaccumcr=0; }
// $slaccumcr = round($slaccumcr, 2);

// $slretcr = (isset($_POST['slretcr'])) ? $_POST['slretcr'] :'';
// if($slretcr == "") { $slretcr=0; }
// $slretcr = round($slretcr, 2);

$paterbal = (isset($_POST['paterbal'])) ? $_POST['paterbal'] :'';
if($paterbal == "") { $paterbal=0; }
// $paterbal = round($paterbal, 2);

$maternbal = (isset($_POST['maternbal'])) ? $_POST['maternbal'] :'';
if($maternbal == "") { $maternbal=0; }
// $maternbal = round($maternbal, 2);

$matercbal = (isset($_POST['matercbal'])) ? $_POST['matercbal'] :'';
if($matercbal == "") { $matercbal=0; }
// $matercbal = round($matercbal, 2);

$splbal = (isset($_POST['splbal'])) ? $_POST['splbal'] :'';
if($splbal == "") { $splbal=0; }
// $splbal = round($splbal, 2);

echo "<p>vartest vlbal:$vlbal, slbal:$slbal, paterbal:$paterbal, maternbal:$maternbal, matercbal:$matercbal, splbal:$splbal</p>";

$projcode = (isset($_POST['projcode'])) ? $_POST['projcode'] :'';

$projchgtyp = (isset($_POST['projchgtyp'])) ? $_POST['projchgtyp'] :'';

$allowotdflt = (isset($_POST['allowotdflt'])) ? $_POST['allowotdflt'] :'';

$allowotbfidflt = (isset($_POST['allowotbfidflt'])) ? $_POST['allowotbfidflt'] :'';

$activesw = (isset($_POST['activesw'])) ? $_POST['activesw'] :'';
if($activesw == "on") { $activeswval="1"; } else { $activeswval="0"; }

//20200107
$projassignid = (isset($_POST['projassignid'])) ? $_POST['projassignid'] :'';

$idcutoff=0;

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
	// query paygroupname
	$res14query="SELECT paygroupname FROM tblhrtapaygrp WHERE idtblhrtapaygrp=$idtblhrtapaygrp";
	$result14=""; $found14=0; $ctr14=0;
	$result14=$dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14=$result14->fetch_assoc()) {
		$found14=1;
		$paygroupname14 = $myrow14['paygroupname'];
		} // while
	} // if

	// check tblhrtapaygrpemplst if employeeid exists and update
	$res15query="SELECT idhrtapaygrpemplst FROM tblhrtapaygrpemplst WHERE idtblhrtapaygrp=$idtblhrtapaygrp AND employeeid=\"$employeeid\"";
	$result15=""; $found15=0; $ctr15=0;
	$result15=$dbh2->query($res15query);
	if($result15->num_rows>0) {
		while($myrow15=$result15->fetch_assoc()) {
		$found15=1;
		$idhrtapaygrpemplst15 = $myrow15['idhrtapaygrpemplst'];
		} // while
	} // if

	if($found15 == 1) {

		// update tblhrtapaygrpemplst
		$res14select="UPDATE tblhrtapaygrpemplst SET timestamp=\"$now\", loginid=$loginid, lastlogin=$loginid, idhrtapayshiftctg=$idhrtapayshiftctg, bankacctid=$bankacctid, restday=\"$restdayval\", projcode=\"$projcode\", projchgtyp=\"$projchgtyp\", allowotdflt=$allowotdflt, allowotbfidflt=$allowotbfidflt, activesw=$activeswval, projassignid=$projassignid WHERE idhrtapaygrpemplst=$idhrtapaygrpemplst15 AND employeeid=\"$employeeid\"";
		$result14=$dbh2->query($res14select);

		// update tblbankacct for default payroll
		$res20query="UPDATE tblbankacct SET payrolldflt=1 WHERE employeeid=\"$employeeid\" AND bankacctid=$bankacctid";
		$result20=$dbh2->query($res20query);

		// query tblcontact for date_hired and contact_gender
		$res21query="SELECT tblemployee.date_hired, tblcontact.contact_gender FROM tblcontact INNER JOIN tblemployee ON tblcontact.employeeid=tblemployee.employeeid WHERE tblcontact.employeeid=\"$employeeid\" AND tblcontact.contact_type=\"personnel\" AND tblemployee.emp_record=\"active\"";
		$result21=""; $found21=0;
		$result21=$dbh2->query($res21query);
		if($result21->num_rows>0) {
			while($myrow21=$result21->fetch_assoc()) {
			$found21=1;
			$date_hired21 = $myrow21['date_hired'];
			$contact_gender21 = $myrow21['contact_gender'];
			} // while
		} // if
		if($found21==1) {
		// prep datehiredstart and datehiredend
		// set date_hired to current year
		$datehiredarr=explode("-", $date_hired21);
		$datehiredyyyy=$datehiredarr[0];
		$datehiredmm=$datehiredarr[1];
		$datehireddd=$datehiredarr[2];
		$datehiredcurr="$yearnow-$datehiredmm-$datehireddd";
		// check if anniv > datenow
		if(strtotime($datehiredcurr)<=strtotime($datenow)) {
		$datehiredstart=strtotime($datehiredcurr);
		} else {
		// subtract by 1 year
		$datehiredstart=strtotime('-1 year', strtotime($datehiredcurr));
		} // if
		// get date_hired end
		$datehiredend0=strtotime('+1 year', $datehiredstart);
		$datehiredend=strtotime('-1 day', $datehiredend0);
		$datehiredstartfin=date("Y-m-d", $datehiredstart);
		$datehiredendfin=date("Y-m-d", $datehiredend);
		// echo "<br>$datehiredstartfin<br>$datehiredendfin";
		} // if

		//
		// check tblhrtaempleavesumm if exists and update else insert
		//
		// $vlbal
		$vlctg=2;
		$res11query="SELECT idhrtaempleavesumm FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idtblhrtapaygrp AND idhrtaleavectg=$vlctg AND ((datestart='' OR datestart IS NULL) AND (dateend='' OR dateend IS NULL)) AND dateannivstart=\"$datehiredstartfin\" ORDER BY dateannivstart DESC LIMIT 1";
		$result11=""; $found11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$idhrtaempleavesumm11 = $myrow11['idhrtaempleavesumm'];
			} // while
		} // if
		if($found11==1) {
		// update
		$res12query="UPDATE tblhrtaempleavesumm SET bal=\"$vlbal\" WHERE idhrtaempleavesumm=$idhrtaempleavesumm11";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		} else {
		// query default vl quota
		$res11aquery="SELECT quota FROM tblhrtaleavectg WHERE idhrtaleavectg=$vlctg";
		$result11a=""; $found11a=0;
		$result11a=$dbh2->query($res11aquery);
		if($result11a->num_rows>0) {
			while($myrow11a=$result11a->fetch_assoc()) {
			$found11a=1;
			$quota11a=$myrow11a['quota'];
			} // while
		} // if
		// set variables and insert query
		$datestart="0000-00-00"; $dateend="0000-00-00";
		$res12query="INSERT INTO tblhrtaempleavesumm SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$now\", createdby=$loginid, paygroupname=\"$paygroupname14\", employeeid=\"$employeeid\", dateannivstart=\"$datehiredstartfin\", dateannivend=\"$datehiredendfin\", datestart=\"$datestart\", dateend=\"$dateend\", quota=\"$quota11a\", bal=\"$vlbal\", idpaygroup=$idtblhrtapaygrp, idhrtaleavectg=$vlctg, idhrtapaygrpemplst=$idhrtapaygrpemplst15";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		} // if-else
		//
		// $slbal
		$slctg=1;
		$res11query="SELECT idhrtaempleavesumm FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idtblhrtapaygrp AND idhrtaleavectg=$slctg AND ((datestart='' OR datestart IS NULL) AND (dateend='' OR dateend IS NULL)) AND dateannivstart=\"$datehiredstartfin\" ORDER BY dateannivstart DESC LIMIT 1";
		$result11=""; $found11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$idhrtaempleavesumm11 = $myrow11['idhrtaempleavesumm'];
			} // while
		} // if
		if($found11==1) {
		// update
		$res12query="UPDATE tblhrtaempleavesumm SET bal=\"$slbal\" WHERE idhrtaempleavesumm=$idhrtaempleavesumm11";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		} else {
		// query default vl quota
		$res11aquery="SELECT quota FROM tblhrtaleavectg WHERE idhrtaleavectg=$slctg";
		$result11a=""; $found11a=0;
		$result11a=$dbh2->query($res11aquery);
		if($result11a->num_rows>0) {
			while($myrow11a=$result11a->fetch_assoc()) {
			$found11a=1;
			$quota11a=$myrow11a['quota'];
			} // while
		} // if
		// set variables and insert query
		$datestart="0000-00-00"; $dateend="0000-00-00";
		$res12query="INSERT INTO tblhrtaempleavesumm SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$now\", createdby=$loginid, paygroupname=\"$paygroupname14\", employeeid=\"$employeeid\", dateannivstart=\"$datehiredstartfin\", dateannivend=\"$datehiredendfin\", datestart=\"$datestart\", dateend=\"$dateend\", quota=\"$quota11a\", bal=\"$slbal\", idpaygroup=$idtblhrtapaygrp, idhrtaleavectg=$slctg, idhrtapaygrpemplst=$idhrtapaygrpemplst15";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		} // if-else
		//
		// check gender if male or female
		if($contact_gender21=='Male') {
		//
		// $paterbal
		$paterctg=3;
		$res11query="SELECT idhrtaempleavesumm FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idtblhrtapaygrp AND idhrtaleavectg=$paterctg AND ((datestart='' OR datestart IS NULL) AND (dateend='' OR dateend IS NULL)) AND dateannivstart=\"$datehiredstartfin\" ORDER BY dateannivstart DESC LIMIT 1";
		$result11=""; $found11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$idhrtaempleavesumm11 = $myrow11['idhrtaempleavesumm'];
			} // while
		} // if
		if($found11==1) {
		// update
		$res12query="UPDATE tblhrtaempleavesumm SET bal=\"$paterbal\" WHERE idhrtaempleavesumm=$idhrtaempleavesumm11";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		} else {
		// query default vl quota
		$res11aquery="SELECT quota FROM tblhrtaleavectg WHERE idhrtaleavectg=$paterctg";
		$result11a=""; $found11a=0;
		$result11a=$dbh2->query($res11aquery);
		if($result11a->num_rows>0) {
			while($myrow11a=$result11a->fetch_assoc()) {
			$found11a=1;
			$quota11a=$myrow11a['quota'];
			} // while
		} // if
		// set variables and insert query
		$datestart="0000-00-00"; $dateend="0000-00-00";
		$res12query="INSERT INTO tblhrtaempleavesumm SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$now\", createdby=$loginid, paygroupname=\"$paygroupname14\", employeeid=\"$employeeid\", dateannivstart=\"$datehiredstartfin\", dateannivend=\"$datehiredendfin\", datestart=\"$datestart\", dateend=\"$dateend\", quota=\"$quota11a\", bal=\"$paterbal\", idpaygroup=$idtblhrtapaygrp, idhrtaleavectg=$paterctg, idhrtapaygrpemplst=$idhrtapaygrpemplst15";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		} // if-else
		} else if($contact_gender21=='Female') {
		//
		// $maternbal
		$maternctg=4;
		$res11query="SELECT idhrtaempleavesumm FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idtblhrtapaygrp AND idhrtaleavectg=$maternctg AND ((datestart='' OR datestart IS NULL) AND (dateend='' OR dateend IS NULL)) AND dateannivstart=\"$datehiredstartfin\" ORDER BY dateannivstart DESC LIMIT 1";
		$result11=""; $found11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$idhrtaempleavesumm11 = $myrow11['idhrtaempleavesumm'];
			} // while
		} // if
		if($found11==1) {
		// update
		$res12query="UPDATE tblhrtaempleavesumm SET bal=\"$maternbal\" WHERE idhrtaempleavesumm=$idhrtaempleavesumm11";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		} else {
		// query default vl quota
		$res11aquery="SELECT quota FROM tblhrtaleavectg WHERE idhrtaleavectg=$maternctg";
		$result11a=""; $found11a=0;
		$result11a=$dbh2->query($res11aquery);
		if($result11a->num_rows>0) {
			while($myrow11a=$result11a->fetch_assoc()) {
			$found11a=1;
			$quota11a=$myrow11a['quota'];
			} // while
		} // if
		// set variables and insert query
		$datestart="0000-00-00"; $dateend="0000-00-00";
		$res12query="INSERT INTO tblhrtaempleavesumm SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$now\", createdby=$loginid, paygroupname=\"$paygroupname14\", employeeid=\"$employeeid\", dateannivstart=\"$datehiredstartfin\", dateannivend=\"$datehiredendfin\", datestart=\"$datestart\", dateend=\"$dateend\", quota=\"$quota11a\", bal=\"$maternbal\", idpaygroup=$idtblhrtapaygrp, idhrtaleavectg=$maternctg, idhrtapaygrpemplst=$idhrtapaygrpemplst15";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		} // if-else
		//
		// $matercbal
		$matercctg=5;
		$res11query="SELECT idhrtaempleavesumm FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idtblhrtapaygrp AND idhrtaleavectg=$matercctg AND ((datestart='' OR datestart IS NULL) AND (dateend='' OR dateend IS NULL)) AND dateannivstart=\"$datehiredstartfin\" ORDER BY dateannivstart DESC LIMIT 1";
		$result11=""; $found11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$idhrtaempleavesumm11 = $myrow11['idhrtaempleavesumm'];
			} // while
		} // if
		if($found11==1) {
		// update
		$res12query="UPDATE tblhrtaempleavesumm SET bal=\"$matercbal\" WHERE idhrtaempleavesumm=$idhrtaempleavesumm11";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		} else {
		// query default vl quota
		$res11aquery="SELECT quota FROM tblhrtaleavectg WHERE idhrtaleavectg=$matercctg";
		$result11a=""; $found11a=0;
		$result11a=$dbh2->query($res11aquery);
		if($result11a->num_rows>0) {
			while($myrow11a=$result11a->fetch_assoc()) {
			$found11a=1;
			$quota11a=$myrow11a['quota'];
			} // while
		} // if
		// set variables and insert query
		$datestart="0000-00-00"; $dateend="0000-00-00";
		$res12query="INSERT INTO tblhrtaempleavesumm SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$now\", createdby=$loginid, paygroupname=\"$paygroupname14\", employeeid=\"$employeeid\", dateannivstart=\"$datehiredstartfin\", dateannivend=\"$datehiredendfin\", datestart=\"$datestart\", dateend=\"$dateend\", quota=\"$quota11a\", bal=\"$matercbal\", idpaygroup=$idtblhrtapaygrp, idhrtaleavectg=$matercctg, idhrtapaygrpemplst=$idhrtapaygrpemplst15";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		} // if-else
		} // if-else
		//
		// $splbal
		$splctg=6;
		$res11query="SELECT idhrtaempleavesumm FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idtblhrtapaygrp AND idhrtaleavectg=$splctg AND ((datestart='' OR datestart IS NULL) AND (dateend='' OR dateend IS NULL)) AND dateannivstart=\"$datehiredstartfin\" ORDER BY dateannivstart DESC LIMIT 1";
		$result11=""; $found11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$idhrtaempleavesumm11 = $myrow11['idhrtaempleavesumm'];
			} // while
		} // if
		if($found11==1) {
		// update
		$res12query="UPDATE tblhrtaempleavesumm SET bal=\"$splbal\" WHERE idhrtaempleavesumm=$idhrtaempleavesumm11";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		} else {
		// query default vl quota
		$res11aquery="SELECT quota FROM tblhrtaleavectg WHERE idhrtaleavectg=$splctg";
		$result11a=""; $found11a=0;
		$result11a=$dbh2->query($res11aquery);
		if($result11a->num_rows>0) {
			while($myrow11a=$result11a->fetch_assoc()) {
			$found11a=1;
			$quota11a=$myrow11a['quota'];
			} // while
		} // if
		// set variables and insert query
		$datestart="0000-00-00"; $dateend="0000-00-00";
		$res12query="INSERT INTO tblhrtaempleavesumm SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$now\", createdby=$loginid, paygroupname=\"$paygroupname14\", employeeid=\"$employeeid\", dateannivstart=\"$datehiredstartfin\", dateannivend=\"$datehiredendfin\", datestart=\"$datestart\", dateend=\"$dateend\", quota=\"$quota11a\", bal=\"$splbal\", idpaygroup=$idtblhrtapaygrp, idhrtaleavectg=$splctg, idhrtapaygrpemplst=$idhrtapaygrpemplst15";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		} // if-else

	// create log
	$adminlogdetails = "$loginid-$username: updated individual info of paygroup member with empid:$employeeid, paygroupid:$idtblhrtapaygrp paygrpemplstid:$idhrtapaygrpemplst15, payshiftid:$idhrtapayshiftctg, bankid:$bankacctid of payroll system";
	$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$username\", adminlogdetails=\"$adminlogdetails\"";
	$result17=$dbh2->query($res17query);

	} // if

	// redirect back to mngdeptcd.php
	header("Location: hrtimeattindivinfo.php?loginid=$loginid&idpg=$idtblhrtapaygrp&eid=$employeeid");
	exit;
	// echo "<p>vartest $adminlogdetails<br>idpg:$idtblhrtapaygrp,pgn:$paygroupname14,dateanv:$date_hired21|$datehiredstartfin|$datehiredendfin,gender:$contact_gender21,vlb:$vlbal,slb:$slbal,splb:$splbal,ptrb:$paterbal,mtrnb:$maternbal,mtrcb:$matercbal<br>$res11query</p>";
	// echo "<p>f15:$found15, active:$active, $res14select</p>";
	// echo "<p><a href=\"hrtimeattindivinfo.php?loginid=$loginid&idpg=$idtblhrtapaygrp&eid=$employeeid\">back</a></p>";
} else {
     include ("logindeny.php");
}
// mysql_close($dbh);
$dbh2->close();
?>