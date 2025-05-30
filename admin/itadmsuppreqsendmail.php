<?php
// from itsuppreq2.php

	// echo "<pre>";
		// prepare mailheaders
		$from = "noreply@philkoei.com.ph";
		$cc = "";
		// set content-type to html
		$mailheader = "MIME-Version: 1.0" . "\r\n";
		$mailheader .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// additional headers
		$mailheader .= "From:" . $from . "\r\n";
		$mailheader .= "Cc:" . $cc . "\r\n";
		// echo "$mailheader\n";
		// echo "from:$from\n";
		// echo "$message\n";
		$ok = "";
		$ok = mail("$to", "$subject", "$message", "$mailheader");
	// echo "</pre>";
		if($ok) {
			$emlmsg = "Congratulations your email has been sent";
			$processed = $processed . $message . 	"------------------------------------------------------------------------------------------------------------\n";
		} else {
			$emlmsg = "Sorry, the email was not sent. Pls try again.";
		} // if($ok)
	//
	// end sendmail
	//

?>
