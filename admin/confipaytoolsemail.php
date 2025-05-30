<?php 

require("db1.php");
include("clsmcrypt.php");

$loginid = $_GET['loginid'];

$groupname = $_POST['groupname'];
$cutstart = $_POST['cutstart'];
$cutend = $_POST['cutend'];

$found = 0;

// $cc = "aaroque@philkoei.com.ph";
$cc = "";
$bcc = "";

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     echo "<html><head><STYLE TYPE=\"text/css\">";
     echo "<!--";
     echo "p{font-family: Helvetica; font-size: 10pt;}";
     echo "B{font-family: Helvetica; font-size: 10pt;}";
     echo "TD{font-family: Helvetica; font-size: 10pt;}";
     echo "--->";
     echo "</STYLE></head>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan=\"4\">ConfiPay Email Notifier Template</th></tr>";

     echo "<form action=\"confipaysendmail.php?loginid=$loginid\" method=\"POST\" name=\"cfptsendmail2\">";

		echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
		echo "<input type=\"hidden\" name=\"cutstart\" value=\"$cutstart\">";
		echo "<input type=\"hidden\" name=\"cutend\" value=\"$cutend\">";

     echo "<tr><td colspan=\"4\">Payroll for $groupname: $cutstart -to- $cutend</td></tr>";

	$ctr=0;
	$result = mysql_query("SELECT tblconfipayroll.employeeid, tblconfipayroll.groupname, tblconfipayroll.cutstart, tblconfipayroll.cutend, tblconfipayroll.accesslevel FROM tblconfipayroll WHERE tblconfipayroll.groupname=\"$groupname\" AND tblconfipayroll.cutstart=\"$cutstart\" AND tblconfipayroll.cutend=\"$cutend\"", $dbh);
	if($result != "") {
    while ($myrow = mysql_fetch_row($result)) {
		$ctr=$ctr+1;     
		$employeeid = $myrow[0];
	  $groupname = $myrow[1];
	  $cutstart = $myrow[2];
	  $cutend = $myrow[3];
		$confiaccesslevel = $myrow[4];

		$res12query="SELECT empalias FROM tblconfipaymeminfo WHERe groupname=\"$groupname\" AND employeeid=\"$employeeid\" LIMIT 1";
		$result12=""; $found12=0; $ctr12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
			$found12=1;
			$empalias=$myrow12['empalias'];
			} // while
		} // if

		if($confiaccesslevel==5 && $accesslevel==5) {
		include("mcryptdec.php");
		$res11query="SELECT name_first, name_last, email1 FROM tblcontact WHERE employeeid=\"$employeeid\" AND contact_type=\"personnel\"";
		include("mcryptenc.php");
		} else if($confiaccesslevel<=4) {
		$res11query="SELECT name_first, name_last, email1 FROM tblcontact WHERE employeeid=\"$employeeid\" AND contact_type=\"personnel\"";
		}
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("$res11query", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$name_first = $myrow11[0];
			$name_last = $myrow11[1];
			$email1 = $myrow11[2];			
			}
		}

    echo "<tr>";
		if($confiaccesslevel==5 && $accesslevel==5) {
			echo "<td><input type=\"checkbox\" name=\"employeeid[]\" value=\"$employeeid\" checked></td>";
			include("mcryptdec.php");
			if($empalias=="") {
			echo "<td>$employeeid</td><td>$name_first $name_last</td><td>$email1</td>";
			} else {
			echo "<td>***</td><td>$empalias</td><td>*****@********.***.**</td>";
			}
			include("mcryptenc.php");
		} else if($confiaccesslevel<=4) {
			echo "<td><input type=\"checkbox\" name=\"employeeid[]\" value=\"$employeeid\" checked></td>";
			echo "<td>$employeeid</td><td>$name_first $name_last</td><td>$email1</td>";
		}
		echo "</tr>";

    }
	}

     echo "</table>";

     echo "<hr>";

     echo "<table border=0 spacing=1>";

     $result = mysql_query("SELECT * FROM tblemailnotifier WHERE notifierid=0", $dbh); 

     while ($myrow = mysql_fetch_row($result))
     {
          $from = $myrow[1];
          $subject = $myrow[2];
          $header = $myrow[3];
          $footer = $myrow[4];
          $notes = $myrow[5];
     }

     $mailhead = "From:$from\r\n";
//     $mailhead .= "CC:$cc\r\n";
//     $mailhead .= "BCC:$bcc\r\n";

     echo "<tr><td>From</td><td><input name=\"from\" size=\"50\" value=\"$from\"></td></tr>";
     echo "<tr><td>Cc</td><td><input name=\"cc\" size=\"50\" value=\"$cc\"></td></tr>";
//     echo "<tr><td>Bcc</td><td><input name=\"bcc\" size=\"50\" value=\"$bcc\"></td></tr>";
     echo "<tr><td>Subject</td><td><input name=\"subject\" size=\"50\" value=\"$subject\"></td></tr>";
     echo "<tr><td valign=top>Header</td><td><textarea name=\"header\" rows=3 cols=50>$header</textarea></td></tr>";
     echo "<tr><td valign=top>Salary Details</td><td><textarea name=\"salary\" rows=\"5\" cols=\"50\" readonly>(Pls. check attached email body details}</textarea></td></tr>";
     echo "<tr><td valign=top>Footer</td><td><textarea name=\"footer\" rows=\"5\" cols=\"50\">$footer</textarea></td></tr>";
     echo "<tr><td valign=top>Notes</td><td><textarea name=\"notes\" rows=\"5\" cols=\"50\">$notes</textarea></td></tr>";
     echo "<input type=hidden name=\"mailhead\" value=\"$mailhead\">";
     echo "<tr><td>&nbsp;</td><td><input type=\"submit\" value=\"Send\"></td></tr>";
     echo "</table>";

     echo "</form>";

//     echo "<a href=confipaytools2.php?loginid=$loginid&groupname=$groupname&cutstart=$cutstart&cutend=$cutend>Back</a><br>";

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
