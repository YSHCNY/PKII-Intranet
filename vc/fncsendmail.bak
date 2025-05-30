<?php
//
// fncsendmail.php
// may be used by other modules
// required variables: $to, $subject, $message

	// prepare mailheaders
	$from = "noreply@philkoei.com.ph";
	$cc = "";
	// set content-type to html
	$mailheader = "MIME-Version: 1.0" . "\r\n";
	$mailheader .= "Content-type:text/plain;charset=iso-8859-1" . "\r\n";
	// additional headers
	$mailheader .= "From:" . $from . "\r\n";
	$mailheader .= "Cc:" . $cc . "\r\n";

	$ok = "";
	// send e-mail
	$ok = mail("$to", "$subject", "$message", "$mailheader");

	// verification
	if($ok) {
		$emlmsg = "E-mail sent";
		$processed = $processed . $message . 	"------------------------------------------------------------------------------------------------------------\n";
	} else {
		$emlmsg = "E-mail sending error. Pls try again.";
	} // if($ok)

	// test
	// echo "<p>mlhdr:$mailheader<br>to:$to<br>subj:$subject<br>msg:$message<br>result:$emlmsg</p>";

?>
