<?php 
$loginstat = urlencode($loginstat); // Ensure special characters are properly encoded
$loginid0 = urlencode($loginid0); // Ensure special characters are properly encoded
$session = urlencode($session); // Ensure special characters are properly encoded

?>
<?php
//
// ./vc/indexlinks.php
// parent: ./vc/index.php


// include("undercons.php"); // remove if  page is done


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
		// include("vpayslipsumm.php");
		include("undercons.php"); //remove if paysilp page is done
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
		// include("minvreq.php");
		include("undercons.php"); //remove if  page is done
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
		// include("mhrotlvfrm.php");
		include("undercons.php"); //remove if  page is done
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
  } else if($page==38) {
    // pkii-cpd
    include("mhrpkcpd.php");
  } else if($page==381) {
    // pkii-cpd link:1 latest announcement
    include("mhrpkcpdlnk01announce.php");
  } else if($page==382) {
    // pkii-cpd link:2 reference materials
    include("mhrpkcpdlnk02refmats.php");
  } else if($page==383) {
    // pkii-cpd link:3 cpd program catalogue
    include("mhrpkcpdlnk03progcat.php");
  } else if($page==384) {
    // pkii-cpd link:4 apply cpd
    include("mhrpkcpdlnk04applycpd.php");
  } else if($page==385) {
    // pkii-cpd link:5 contact zen team
    include("mhrpkcpdlnk05contactzen.php");
	} else if($page==41) {
		// change password
		include("mchgpass.php");
	} else if($page==411) {
    include("mchgpass2.php");
  } else if($page==412) {
    include("mchgpassskip.php");
  }

?>










<?php
if ($empdepartment0 == ''){
	$bg = 'hidden';
} else {
	$bg = '';
}

?>

<div id="newticket" >
  <button data-toggle="modal" data-target="#staticBackdropSupp"  class ='bg-primary' title="Request a ticket"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-ticket-perforated" viewBox="0 0 16 16">
  <path d="M4 4.85v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9z"/>
  <path d="M1.5 3A1.5 1.5 0 0 0 0 4.5V6a.5.5 0 0 0 .5.5 1.5 1.5 0 1 1 0 3 .5.5 0 0 0-.5.5v1.5A1.5 1.5 0 0 0 1.5 13h13a1.5 1.5 0 0 0 1.5-1.5V10a.5.5 0 0 0-.5-.5 1.5 1.5 0 0 1 0-3A.5.5 0 0 0 16 6V4.5A1.5 1.5 0 0 0 14.5 3zM1 4.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1.05a2.5 2.5 0 0 0 0 4.9v1.05a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1.05a2.5 2.5 0 0 0 0-4.9z"/>
</svg></button>
</div>

<?php

	if($empdepartment0!='') {
?>

<div class="modal fade " id="staticBackdropSupp" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelSupp" aria-hidden="true">
			<div class="modal-dialog  ">
				<div class="modal-content ">
				<div class="modal-header mx-auto ">
					<h5 class="modal-title border-0"  id="staticBackdropLabelSupp">Ticket Form</h5>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button> -->
				</div>
				<div class="modal-body" >
				<?php include 'mitsuppreqadd.php'; ?>
				</div>
				<div class="modal-footer border-0"">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				
				</div>
				</div>
			</div>
			</div>

<?php
  }


?>



