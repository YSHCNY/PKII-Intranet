<?php
//
// memlnotif.php
// fr: vc/index.php

?>
	<div class=" my-5 p-5 mainbgc" >
		<div class=""><h4 class = "ms-5 py-5 text-white">E-Mail Notifier</h4></div>
		</div>

<?php
	if($email10!='') {
?>



		<div class="container">
		<div class="row bg-white shadow-lg rounded-4 p-5">
		<div class="alert alert-success" id="alert" style="display: none" role="alert">
  Success! Email Sent! Thank you user.
</div>


			<div class="mb-3">
	<h4 class = "fw-bold text-dark">New Message</h4>
	</div>

<?php
	echo '<input type="hidden" id="logID" value="'.$loginid.'" />';
	echo '<input type="hidden" id="sessionID" value="'.$session.'" />';
?>

<?php
	// query user's email
	include '../m/qryemlsender.php';
		

?>

<?php

	echo "<label for = 'emlsender' class = 'fs-4 pb-0 mb-0 text-muted fw-normal'>From</label>";
	echo "<input name=\"emlsender\" id='emlsender' class = 'form-control shadow-none bg-white border-0 text-dark fs-4' value=\"$email10\" readonly> ";
?>


<?php
	// query recipients
	include '../m/qryemlrecipient.php';
?>
<?php
	echo "<label for = 'emlrecipient' class = 'fs-4 py-3 mb-0 text-muted fw-normal'>To</label>";
	echo "<select name=\"emlrecipient\"  class = 'form-control shadow-none border-1 rounded-4 text-dark fs-4' id='emlrecipient'>";
	echo "<option selected disabled class = ' fs-3 text-secondary '>Select Recipient</option>";
	// display results
	$param11 = count($name_last11Arr);
	for($x = 0; $x < $param11; $x++) {
		echo "<option class = ' fs-3 ' value='".$email111Arr[$x]."'>".$name_first11Arr[$x].",&nbsp;".$name_last11Arr[$x]." (".$email111Arr[$x].")</option>";
	} // for
	echo "</select>";
?>
	


<?php
echo "<label for = 'emlsubject' class = 'fs-4 py-3 mb-0 text-muted fw-normal'>Subject</label>";
	echo "<input size=\"60\" name=\"emlsubject\" id='emlsubject' class = 'form-control shadow-none border-1 rounded-4 text-dark fs-4' placeholder=\"E-Mail Subject\">";
?>
	
	

<?php
		echo "<label for = 'emlmessage' class = 'fs-4 fw-bold py-3 mb-0 text-muted fw-normal'>Message</label>";
	echo "<textarea name=\"emlmessage\" id='emlmessage' class = 'form-control shadow-none' style = 'height: 100px' id='emlmessage' placeholder=\"Type here...\"></textarea>";
?>


	<div class = "p-4 flex">

<!-- Button trigger modal -->
	<button class="float-end p-3 text-white rounded bg-success border-0 " id='btnEmailSubmit'> Send
	<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
	<mask id="mask0_134_222" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="25" height="25">
	<rect x="0.456543" y="0.637451" width="24" height="24" fill="#D9D9D9"/>
	</mask>
	<g mask="url(#mask0_134_222)">
	<path d="M3.45654 20.6375V4.63745L22.4565 12.6375L3.45654 20.6375ZM5.45654 17.6375L17.3065 12.6375L5.45654 7.63745V11.1375L11.4565 12.6375L5.45654 14.1375V17.6375Z" fill="white"/>
	</g>
	</svg>
	</button>

</div>


<?php
} else { // if($email10!='')
?>

	<div class="row">
		<div class="col-md-12">
		<h2><font color="red">Sorry, you have no valid e-mail address on record.</font></h2>
		</div>
	</div>
<?php
} // if($email10!='')
?>




</div>

<script>
$(document).ready(function(){

$('#btnEmailSubmit').on('click',function(){
	var loginid = $('#logID').val();
	var session = $('#sessionID').val();            
	var emlsender = $('#emlsender').val();
	var emlrecipient = $('#emlrecipient').val();
	var emlsubject = $('#emlsubject').val();
	var emlmessage = $('#emlmessage').val();
	
	$.ajax({
		url: "memlnotifsnd.php?lst=1&lid="+loginid+"&sess="+session+"&p=32",
		type: 'POST',
		data: {
			emlsender: emlsender,
			emlrecipient: emlrecipient,
			emlsubject: emlsubject,
			emlmessage: emlmessage,
		},
		success: function(returnResult){
			
			$('#alert').css('display', 'block'); // Show the alert
                setTimeout(function() {
                    $('#alert').css('display', 'none'); // Hide the alert after 3 seconds
                }, 3000);

				$('#emlsubject').val('');
				$('#emlrecipient').val('Select Recipient');
				$('#emlmessage').val('');
		}
	});     
}); 

});
</script>


