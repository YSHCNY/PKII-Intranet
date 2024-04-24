<?php

require_once('/home/sysad/vendor/autoload.php');

$apiKey = 'place api here';

$mailchimp = new \Mailchimp\Mailchimp($apiKey);

$toEmail = 'support@philkoei.com.ph';

$subject = 'this is a test from intranet';

$body = '<p>This is a test from the intranet server using mailchimp with api</p>';

try {
    $mailchimp->sendEmail($toEmail, $subject, $body);
} catch (\Exception $e) {
    echo 'Error sending email: ' . $e->getMessage();
}

?>
