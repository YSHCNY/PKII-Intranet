<?php
//
// ./vc/indexlinks.php
// parent: ./vc/index.php

	if($page=="" || $page==0) {
		// display dashboard
		include("ddash.php");
	} else if($page==11) {
		// my info
		include("vpersinfo.php");
	} else if($page==12) {
		// my time log
		include("vtimelog.php");
	} else if($page==14) {
		// my activity log
		include("mactivitylog.php");
	} else if($page==141) {
		// my activity log - add
		include("mactivitylogfrm.php");
	} else if($page==142) {
		// my activity log - print view
		include("mactivitylogprt.php");
	} else if($page==143) {
		// my activity log - edit activity
		include("mactivitylogedt.php");
	} else if($page==144) {
		// my activity log - delete activity
		include("mactivitylogdel.php");
	} else if($page==15) {
		// my payslip summary
		include("vpayslipsumm.php");
	} else if($page==21) {
		// projects
		include("vprojects.php");
	} else if($page==211) {
		// projects - more info
		include("vprojmore.php");
	} else if($page==22) {
		// personnel
		include("vpersonnel.php");
	} else if($page==23) {
		// business contacts
		include("vbizcontact.php");
	} else if($page==24) {
		// iso documents
		include("visodocs.php");
	} else if($page==25) {
		// training mats
		include("vtrngmat.php");
	} else if($page==31) {
		// file uploader
		include("mfileupload.php");
	} else if($page==32) {
		// e-mail notifier
		include("memlnotif.php");
	} else if($page==33) {
		// inventory request
		include("minvreq.php");
	} else if($page==34) {
		// it support request
		include("mitsuppreq.php");
	} else if($page==341) {
		// it support request - add new
		include("mitsuppreqadd.php");
	} else if($page==342) {
		// it support request - details
		include("mitsuppreqdtl.php");
	} else if($page==35) {
		// hr personnel request
		include("mhrpersreq.php");
	} else if($page==351) {
		// hr personnel request - add
		include("mhrpersreqadd.php");
	} else if($page==352) {
		// hr personnel request - details
		include("mhrpersreqdtl.php");
	} else if($page==36) {
		// hr ot/leave form
		include("mhrotlvfrm.php");
	} else if($page==361) {
		// hr ot form request
		include("mhrotfrmreq.php");
	} else if($page == 362){
		// hr ot form req submit
		include("mhrotfrmreq2.php");
	} else if($page == 363) {
		// hr ot form - update
		include("mhrotfrmreq3.php");
	} else if($page == 364){
		// hr ot form details
		include("mhrotreqdetails.php"); 
	} else if($page==366) {
		// hr lv form request
		include("mhrlvfrmreq.php");
	} else if($page==367) {
		// hr lv form req submit
		include("mhrlvfrmreq2.php");
	} else if($page == 368){
		// hr lv form details
		include("mhrlvreqdetails.php");
  } else if($page == 369) {
    // hr lv form approve
    include("mhrlvfrmreq3.php");
	} else if($page==37) {
		// act/fin liquidation form
		include("mfincaliqfrm.php");
	} else if($page==41) {
		// change password
		include("mchgpass.php");
	} else if($page==411) {
    include("mchgpass2.php");
  } // if

?>