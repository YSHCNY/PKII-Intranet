<?php

include("db1.php");
// $dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
// mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$projectname = (isset($_POST['projectname'])) ? $_POST['projectname'] :'';
$advisorytype = (isset($_POST['advisorytype'])) ? $_POST['advisorytype'] :'';
$advisorytypeothers = (isset($_POST['advisorytypeothers'])) ? $_POST['advisorytypeothers'] :'';
$payamount = (isset($_POST['payamount'])) ? $_POST['payamount'] :'';
$currency = (isset($_POST['currency'])) ? $_POST['currency'] :'';
$othercurrency = (isset($_POST['othercurrency'])) ? $_POST['othercurrency'] :'';
$paytype = (isset($_POST['paytype'])) ? $_POST['paytype'] :'';
$acct_num = (isset($_POST['acct_num'])) ? $_POST['acct_num'] :'';
$paytypebankname = (isset($_POST['paytypebankname'])) ? $_POST['paytypebankname'] :'';
$paytypebankbranch = (isset($_POST['paytypebankbranch'])) ? $_POST['paytypebankbranch'] :'';
$paytypeacctnumber = (isset($_POST['paytypeacctnumber'])) ? $_POST['paytypeacctnumber'] :'';
$paytypeacctname = (isset($_POST['paytypeacctname'])) ? $_POST['paytypeacctname'] :'';
$paytypeaccttype = (isset($_POST['paytypeaccttype'])) ? $_POST['paytypeaccttype'] :'';
// $acctdatedeposited = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
$acctdatedeposited = (isset($_POST['datedeposited'])) ? $_POST['datedeposited'] :'';
// $paytypedatedeposited = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'];
$paytypedatedeposited = (isset($_POST['datedepositedcustom'])) ? $_POST['datedepositedcustom'] :'';
$moredetails = (isset($_POST['moredetails'])) ? $_POST['moredetails'] :'';

$to = (isset($_POST['to'])) ? $_POST['to'] :'';
$from = (isset($_POST['from'])) ? $_POST['from'] :'';
$cc = (isset($_POST['cc'])) ? $_POST['cc'] :'';
$bcc = (isset($_POST['bcc'])) ? $_POST['bcc'] :'';
$subject = (isset($_POST['subject'])) ? $_POST['subject'] :'';
$header = (isset($_POST['header'])) ? $_POST['header'] :'';
$footer = (isset($_POST['footer'])) ? $_POST['footer'] :'';
$notes = (isset($_POST['notes'])) ? $_POST['notes'] :'';

$message = "$subject\n\n$header\n\n";

//copy the temp. uploaded file to uploads folder

$name_of_uploaded_file = basename( $_FILES['uploaded_file']['name'] );

$upload_folder = "./transfers/emailnotifier/";

$path_of_uploaded_file = $upload_folder . $name_of_uploaded_file;
$tmp_path = $_FILES["uploaded_file"]["tmp_name"];
 
if(is_uploaded_file($tmp_path))
{
  if(!copy($tmp_path,$path_of_uploaded_file))
  {
    $errors .= '\n error while copying the uploaded file';
  }
}

echo "<html>";

echo "<pre>";

echo "filename $name_of_uploaded_file<br><br>";
echo "path $path_of_uploaded_file<br><br>";

// if($projectname <> "")
// {
//      $message = $message . "Project Name: $projectname\n\n";
//      $messagehtm = $messagehtm . "<table><tr><td>Project Name</td><td>$projectname</td></tr>";
// }

$message = $message . "Project Name/s:\n";
// $messagehtm = $messagehtm . "<table border=1 spacing=1><tr><td valign=top>Project Name</td><td>";

foreach($projectname as $val0)
{
	if(ctype_digit($val0)) {
		$res1query=""; $result1=""; $found1=0; $ctr1=0;
		$res1query="SELECT projectid, projcode, projname FROM tblprojcdassign WHERE projassignid=$val0";
		$result1=$dbh2->query($res1query);
		if($result1->num_rows>0) {
			while($myrow1=$result1->fetch_assoc()) {
			$found1 = 1;
			$projectid1 = $myrow1['projectid'];
			$projcode1 = $myrow1['projcode'];
			$projname1 = $myrow1['projname'];
			$ctr1 = $ctr1 + 1;
			if($ctr1 > 1) { $projlstbrk = "/"; $projlst = $projlst . $projlstbrk; }
			$projlst = $projlst . "$projname1";				
			} //while
		} //if
		$message = $message . $projlst . "\n";
	} else {
		$message = $message . "$val0\n";
	}
//      $messagehtm = $messagehtm . "$val0<br>";
}

$message = $message . "\nPay Advisory Type:\n";
// $messagehtm = $messagehtm . "</td></tr><tr><td valign=top>Pay Advisory Type</td><td>";


foreach($advisorytype as $val)
{
     if($val == "Others")
     {
          $message = $message . "$advisorytypeothers\n";
// 	    $messagehtm = $messagehtm . "$advisorytypeothers";
     }
     else
     {
          $message = $message . "$val\n";
//	    $messagehtm = $messagehtm . "$val<br>";
     }
}

if($payamount <> "")
{
     $payamount = FormatMoney($payamount);
     $message = $message . "\nAmount: $payamount\n";
}

if($currency == "Others")
{
     $message = $message . "Currency: $othercurrency\n\n";
}
else
{
     $message = $message . "Currency: $currency\n\n";
}

$message = $message . "Pay Type: $paytype\n\n";

if($paytype == "Bank Acct")
{
	$resquery=""; $result="";
    $resquery="SELECT acct_num, bank_name, bank_branch, acct_name, acct_type FROM tblbankacct WHERE acct_num='$acct_num'";
    $result=$dbh2->query($resquery);
    if($result->num_rows>0) {
        while($myrow=$result->fetch_assoc()) {
          $acct_num = $myrow['acct_num'];
          $bank_name = $myrow['bank_name'];
          $bank_branch = $myrow['bank_branch'];
          $acct_name = $myrow['acct_name'];
          $acct_type = $myrow['acct_type'];			
		} //while
    } //if		

     $message = $message . "Bank Name: $bank_name\n";
     $message = $message . "Bank Branch: $bank_branch\n";
     $message = $message . "Acct Number: $acct_num\n";
     $message = $message . "Acct Name: $acct_name\n";
     $message = $message . "Acct Type: $acct_type\n";
     $message = $message . "Date Deposited: $acctdatedeposited\n\n";
}

if($paytype == "Bank Deposit")
{
     $message = $message . "Bank Name: $paytypebankname\n";
     $message = $message . "Bank Branch: $paytypebankbranch\n";
     $message = $message . "Acct Number: $paytypeacctnumber\n";
     $message = $message . "Acct Name: $paytypeacctname\n";
     $message = $message . "Acct Type: $paytypeaccttype\n";
     $message = $message . "Date Deposited: $paytypedatedeposited\n\n";
}

$message = $message . "Additional Details:\n";
$message = $message . "$moredetails\n";

$message = $message . "\n$footer\n\n$notes\n\n";

echo "$message<br>";

echo "to: $to<br>";
echo "cc: $cc<br>";
echo "bcc: $bcc<br>";

$mailheader = "From:$from\r\n";
$mailheader .= "CC:$cc\r\n";
$mailheader .= "BCC:$bcc\r\n";

$mailheadfrom = "From:$from\r\n";
$mailheadcc = "CC:$cc\r\n";
$mailheadbcc = "BCC:$bcc\r\n";

echo "</pre>";

echo "<form action=\"sendmail3.php?loginid=$loginid\" method=post>";
echo "<input type=hidden name=to value=\"$to\">";
echo "<input type=hidden name=subject value=\"$subject\">";
echo "<input type=hidden name=message value=\"$message\">";
echo "<input type=hidden name=mailheader value=\"$mailheader\">";

echo "<input type=\"hidden\" name=\"mailheadfrom\" value=\"$mailheadfrom\">";
echo "<input type=\"hidden\" name=\"mailheadcc\" value=\"$mailheadcc\">";
echo "<input type=\"hidden\" name=\"mailheadbcc\" value=\"$mailheadbcc\">";

echo "<input type=\"hidden\" name=\"filename\" value=\"$name_of_uploaded_file\">";
echo "<input type=\"hidden\" name=\"path\" value=\"$upload_folder\">";
echo "<input type=hidden name=filepath value=\"$path_of_uploaded_file\">";

echo "<input type=submit value=Send>";
echo "</form>";

echo "</html>";

mysql_close($dbh);
$dbh2->close();

function FormatMoney($number) {
    $number = preg_replace("/[^0-9\.]/", "", str_replace(',','.',$number));
    if (substr($number,-3,1)=='.') {
        $sents = '.'.substr($number,-2);
        $number = substr($number,0,strlen($number)-3);
    } elseif (substr($number,-2,1)=='.') {
        $sents = '.'.substr($number,-1);
        $number = substr($number,0,strlen($number)-2);
    } else {
        $sents = '.00';
    }
    $number = preg_replace("/[^0-9]/", "", $number);
    return number_format($number.$sents,2,'.','');
}

?>
