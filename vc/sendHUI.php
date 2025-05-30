<?php
session_start();

require("../includes/dbh.php");


$from = "AnonIntranet@philkoei.com.ph";
$to = "cdvitug@philkoei.com.ph";
// $to = "support@philkoei.com.ph";
$feedback = trim((isset($_POST['feedbackHUI'])) ? $_POST['feedbackHUI'] :'');
$subject = trim((isset($_POST['subjectHUI'])) ? $_POST['subjectHUI'] :'');


$userip = trim((isset($_POST['userip'])) ? $_POST['userip'] :'');
$userbrow = trim((isset($_POST['userbrow'])) ? $_POST['userbrow'] :'');
$userhost = trim((isset($_POST['userhost'])) ? $_POST['userhost'] :'');


$message = "<!DOCTYPE html>
<html>
<head>
    <title>Email from Intranet</title>
</head>
<body style='font-family: Arial, sans-serif !important; text-align: center !important; background-color: #f4f4f4 !important; padding: 20px !important;'>
    <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
        <tr>
            <td align='center'>
                <table width='500' style='background: #ffffff !important; padding: 20px !important; border-radius: 8px !important; box-shadow: 0px 0px 10px rgba(0,0,0,0.1) !important;'>
                    <tr>
                        <td align='center' style='padding: 20px !important;'>
                        
                            <img src='https://img.freepik.com/premium-vector/secret-agent-icon-logo-design-illustration_586739-409.jpg?semt=ais_hybrid' alt='Anonymous' width='100' style='display: block !important; margin-bottom: 10px !important; border: 2px solid #353334; border-radius: 100%;'>
                            <h4 style='color: #2A2A2B !important; font-style: italic !important; font-weight: lighter !important;'>&#10077; $feedback &#10078;</h4>
                        </td>
                    </tr>
                    <tr>
                        <td align='right' style='padding: 10px !important;'>
                            <h4 style='color: #323232 !important; font-weight: bolder !important;'>- Anonymous Sender</h4>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: (Anon of Intranet)" . "\r\n";
$headers .= "BCC: support@philkoei.com.ph" . "\r\n";



// send e-mail
if($feedback!="") {
    $ok = mail($to, $subject, $message, $headers);
} else {
    $ok = "";
} //if-else


// verification
if($ok) {
 header("location: ../vc/index.php");
 $_SESSION['FLAG'] = 'Success';
 $_SESSION['message'] = 'Thank You for Contacting Us! We Appreciate Your Feedback.';
 $_SESSION['secmessage'] = "Your message has been successfully sent! We sincerely appreciate you reaching out to us. Our team is always working to improve, and your feedback helps us serve you better.";
 
 
} else {
    header("location: ../vc/index.php");
 $_SESSION['FLAG'] = 'Error';

    $_SESSION['message'] = 'eRROR';
    $_SESSION['secmessage'] = "PLEASE CONTACT YOUR IT ADMINISTRATOR";
} // if($ok)


// $sql = "INSERT INTO feedbacktbl (timestamp, userip, userbrowser, userhost, feedback) VALUES ('$now', '$userip', '$userbrow', '$userhost', '$feedback')";
// if($feedback!="") {
//     $result = mysqli_query($dbh, $sql);	
// } 
// if ($result) {
//     echo "Record inserted successfully!";
// } else {
//     echo "Error: " . mysqli_error($dbh);
// }

$protectedSql = "INSERT INTO feedbacktbl (timestamp, userip, userbrowser, userhost, feedback) VALUES (?, ?, ?, ?, ?)";
$stmt = $dbh->prepare($protectedSql);
$stmt->bind_param("sssss", $now, $userip, $userbrow, $userhost, $feedback);
$stmt->execute();
$stmt->close();
$dbh->close();





?>

