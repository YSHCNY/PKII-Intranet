<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$groupname = $_POST['groupname'];
$checkall = $_POST['checkall'];

$found = 0;

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

     echo "<form action=\"emppaybonsend2.php?loginid=$loginid\" method=\"POST\">";

     echo "<table border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
     echo "<tr><td>EmpID</td><td>Name</td><td>email</td></tr>";
    
     $result = mysql_query("SELECT employeeid, name_first, name_last, email1 FROM tblcontact WHERE email1 != '' AND employeeid !=''", $dbh);

     while ($myrow = mysql_fetch_row($result))
     {      
          $employeeid = $myrow[0];
          $name_first = $myrow[1];
          $name_last = $myrow[2];
          $email = $myrow[3];
 
          $include = 0;

          $result2 = mysql_query("SELECT * FROM tblemppaybonus WHERE employeeid=\"$employeeid\" AND groupname=\"$groupname\"", $dbh);

          while ($myrow2 = mysql_fetch_row($result2))
          {      
               $include = 1;
          }

          if($include == 1)
          {
            if($checkall == "yes")
            {
		echo "<tr><td><input type=\"checkbox\" name=\"employeeid[]\" value=\"$employeeid\" checked>$employeeid</td><td>$name_last $name_first</td><td>$email</td></tr>"; 
            }
            else
            {
		echo "<tr><td><input type=\"checkbox\" name=\"employeeid[]\" value=\"$employeeid\">$employeeid</td><td>$name_last $name_first</td><td>$email</td></tr>"; 
            } 
          }
     }
     echo "</table>";

     echo "<hr>";

     $result = mysql_query("SELECT employeeid, name_first, name_last, email1 FROM tblcontact WHERE email1 = '' AND employeeid !=''", $dbh);

     echo "<p>The following have no email addresses. Please provide hard-copies of the pay advisory.</p>";

     while ($myrow = mysql_fetch_row($result))
     {      
          $employeeid = $myrow[0];
          $name_first = $myrow[1];
          $name_last = $myrow[2];
          $email = $myrow[3];

          $include = 0;

          $result2 = mysql_query("SELECT * FROM tblemppaybonus WHERE employeeid = '$employeeid' AND groupname = '$groupname'", $dbh);
 
          while ($myrow2 = mysql_fetch_row($result2))
          {      
               $include = 1;
          }

          if($include == 1)
          {
               echo "<font face=Helvetica size=2>$employeeid - $name_first $name_last</font><br>";
          }
     }

     echo "<hr>";
// start template here...
  
     echo "<p><b>email template</b></b>";

     echo "<table border=0 spacing=1>";

     $result = mysql_query("SELECT * FROM tblemailnotifier WHERE notifierid=1", $dbh); 

     while ($myrow = mysql_fetch_row($result))
     {
          $from = $myrow[1];
          $subject = $myrow[2];
          $header = $myrow[3];
          $footer = $myrow[4];
          $notes = $myrow[5];
     }

     echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
     echo "<tr><td><i>To</i></td><td><input name=\"totest\" size=\"30\"><i>testfield only</i></td></tr>";

     echo "<tr><td>From</td><td><input name=\"from\" size=\"50\" value=\"$from\"></td></tr>";
     echo "<tr><td>Subject</td><td><input name=\"subject\" size=\"50\" value=\"$subject\"></td></tr>";
     echo "<tr><td valign=top>Header</td><td><textarea name=header rows=3 cols=50>$header</textarea></td></tr>";
     echo "<tr><td valign=top>Salary Details</td><td><textarea name=\"salary\" rows=\"5\" cols=\"50\" readonly=\"readonly\">(Pls. check attached email body details)</textarea></td></tr>";
     echo "<tr><td valign=top>Footer</td><td><textarea name=footer rows=5 cols=50>$footer</textarea></td></tr>";
     echo "<tr><td valign=top>Notes</td><td><textarea name=notes rows=5 cols=50>$notes</textarea></td></tr>";
     echo "<tr><td>&nbsp;</td><td><input type=submit value=Send></td></tr>";
     echo "</table>";

     echo "</form>";

     echo "</html>";
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
