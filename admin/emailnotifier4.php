<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$employeeid = $_POST['employeeid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
    $cc1 = "aaroque@philkoei.com.ph";
     $cc2 = "aaroque@philkoei.com.ph, kbcruz@philkoei.com.ph";
     echo "<html>";
?>
<STYLE TYPE="text/css">
<!--
TD{font-family: Helvetica; font-size: 10pt;}
--->
</STYLE>
<script language="JavaScript" src="ts_picker.js"></script>
<?php
     echo "<form enctype=\"multipart/form-data\" action=\"sendmail2.php?loginid=$loginid&eid=$employeeid\" method=\"POST\" name=\"emailnotifier4\">";
    
     $result = mysql_query("SELECT employeeid, name_first, name_last, email1 FROM tblcontact WHERE employeeid ='$employeeid'", $dbh);

     while ($myrow = mysql_fetch_row($result))
     {    
          $eid = $myrow[0];
          $name_first = $myrow[1];
          $name_last = $myrow[2];
          $email = $myrow[3];

     }

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue width=730 colspan=2><font color=white><b>Notifier Details</b></font></td></tr>";

     echo "<tr><td colspan=2>For: $eid - <b>$name_first $name_last</b> - $email</td></tr>";

     echo "<tr><td>Project Name</td>";
     echo "<td>";
//     echo "<select name=projectname>";

     $result = mysql_query("SELECT DISTINCT proj_name FROM tblprojassign WHERE employeeid='$employeeid' AND (proj_code != '' OR proj_code != 'Select Pro') AND proj_name != '' ORDER BY durationfrom ASC", $dbh);

     while ($myrow = mysql_fetch_row($result))
     {    
          $proj_name = $myrow[0];
    
 //         echo "<option value=\"$proj_name\">$proj_name</option>";
	  echo "<input type=checkbox name=projectname[] value=$proj_name checked=\"checked\">$proj_name<br>";
     }

		$result2=""; $found2=0; $ctr2=0;
		$result2 = mysql_query("SELECT DISTINCT projassignid FROM tblprojcdassign WHERE empid=\"$employeeid\"", $dbh);
		if($result2 != "") {
			while($myrow2 = mysql_fetch_row($result2)) {
			$found2 = 1;
			$projassignid2 = $myrow2[0];

			echo "<input type=\"checkbox\" name=\"projectname[]\" value=\"$projassignid2\" checked=\"checked\">";
			$result2b=""; $found2b=0; $ctr2b=0;
			$result2b = mysql_query("SELECT projectid, projcode, projname FROM tblprojcdassign WHERE empid=\"$employeeid\" AND projassignid=$projassignid2", $dbh);
			if($result2b != "") {
				while($myrow2b = mysql_fetch_row($result2b)) {
				$found2b = 1;
				$projectid2b = $myrow2b[0];
				$projcode2b = $myrow2b[1];
				$projname2b = $myrow2b[2];
				$ctr2b = $ctr2b + 1;
				if($ctr2b > 1) { echo " / "; }
				echo "$projname2b";
				}
			}
			echo "<br>";
			}
		}

     echo "<input type=checkbox name=projectname[] value=\"Others\">Others";
     echo "<input name=projectnameothers></td></tr>";
   
     echo "</select></td></tr>"; 
   
     echo "<tr><td valign=top>Pay Advisory Type</td>";

     echo "<td><input type=checkbox name=advisorytype[] value=\"Professional Fee\" checked=\"checked\">Professional Fee<br>";
     echo "<input type=checkbox name=advisorytype[] value=\"Salary\">Salary<br>";
     echo "<input type=checkbox name=advisorytype[] value=\"Per Diem\">Per Diem<br>";
     echo "<input type=checkbox name=advisorytype[] value=\"Cash Advance\">Cash Advance<br>";
     echo "<input type=checkbox name=advisorytype[] value=\"Allowance\">Allowance<br>";
     echo "<input type=checkbox name=advisorytype[] value=\"Others\">Others";
     echo "<input name=advisorytypeothers></td></tr>";

     echo "<tr><td>Amount</td>";
     echo "<td><input name=payamount></td></tr>";
     echo "<tr><td valign=top>Currency</td>";
     echo "<td><input type=radio name=currency value=\"Philippine Peso\" checked=\"checked\">Philippine Peso<br>";
     echo "<input type=radio name=currency value=\"US Dollars\">United States Dollars<br>";
     echo "<input type=radio name=currency value=\"Japanese Yen\">Japanese Yen<br>";
     echo "<input type=radio name=currency value=\"Others\">Others";
     echo "<input name=othercurrency></td></tr>";
     
     echo "<tr><td valign=top>Pay Type</td>";
     echo "<td><input type=radio name=paytype value=\"Cash\" checked=\"checked\">CASH<br>";
     echo "------------<br>";
     echo "<input type=radio name=paytype value=\"Bank Acct\">BANK Deposit<br>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0><tr><td>";
     echo "Bank Acct Info</td><td>";

     $result = mysql_query("SELECT acct_num, bank_name, bank_branch FROM tblbankacct WHERE employeeid='$employeeid'", $dbh); 

     echo "<select name=acct_num>";

     while ($myrow = mysql_fetch_row($result))
     {
           $acct_num = $myrow[0];
           $bank_name = $myrow[1];
           $bank_branch = $myrow[2];

           echo "<option value=\"$acct_num\">$bank_name $bank_branch $acct_num</option>";
     }

     echo "</select><br>";

     echo "Date Deposited";
   
     echo "<input name=\"datedeposited\" value=\"$datenow\">";
     ?>
     <a href="javascript:show_calendar('document.emailnotifier4.datedeposited', document.emailnotifier4.datedeposited.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
    <?php
/*
     echo "<select name=month>";
     echo "<option value=1>Jan</option>";
     echo "<option value=2>Feb</option>";
     echo "<option value=3>Mar</option>";
     echo "<option value=4>Apr</option>";
     echo "<option value=5>May</option>";
     echo "<option value=6>Jun</option>";
     echo "<option value=7>Jul</option>";
     echo "<option value=8>Aug</option>";
     echo "<option value=9>Sep</option>";
     echo "<option value=10>Oct</option>";
     echo "<option value=11>Nov</option>";
     echo "<option value=12>Dec</option>";
     echo "</select>";

     echo "<select name=day>";
     echo "<option value=1>1</option>";
     echo "<option value=2>2</option>";
     echo "<option value=3>3</option>";
     echo "<option value=4>4</option>";
     echo "<option value=5>5</option>";
     echo "<option value=6>6</option>";
     echo "<option value=7>7</option>";
     echo "<option value=8>8</option>";
     echo "<option value=9>9</option>";
     echo "<option value=10>10</option>";
     echo "<option value=11>11</option>";
     echo "<option value=12>12</option>";
     echo "<option value=13>13</option>";
     echo "<option value=14>14</option>";
     echo "<option value=15>15</option>";
     echo "<option value=16>16</option>";
     echo "<option value=17>17</option>";
     echo "<option value=18>18</option>";
     echo "<option value=19>19</option>";
     echo "<option value=20>20</option>";
     echo "<option value=21>21</option>";
     echo "<option value=22>22</option>";
     echo "<option value=23>23</option>";
     echo "<option value=24>24</option>";
     echo "<option value=25>25</option>";
     echo "<option value=26>26</option>";
     echo "<option value=27>27</option>";
     echo "<option value=28>28</option>";
     echo "<option value=29>29</option>";
     echo "<option value=30>30</option>";
     echo "<option value=31>31</option>";

     echo "</select>";
     echo "<input name=year size=4 value=2010></td></tr></table>";
*/
     echo "</td></tr></table>";
     echo "------------<br>";

     echo "<input type=radio name=paytype value=\"Bank Deposit\">BANK Deposit (custom)<br>";

     echo "<table border=1 spacing=0><tr><td>Bank Name</td><td><input name=paytypebankname></td></tr>";
     echo "<tr><td>Bank Branch</td><td><input name=paytypebankbranch></td></tr>";
     echo "<tr><td>Acct Number</td><td><input name=paytypeacctnumber></td></tr>";
     echo "<tr><td>Acct Name</td><td><input name=paytypeacctname></td></tr>";
     echo "<tr><td>Acct Type</td><td><input name=paytypeaccttype></td></tr>";
     echo "<tr><td>Date Deposited";
     echo "</td><td><input name=\"datedepositedcustom\" value=\"$datenow\">";
     ?>
     <a href="javascript:show_calendar('document.emailnotifier4.datedepositedcustom', document.emailnotifier4.datedepositedcustom.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
    <?php
/*   
     echo "<select name=month2>";
     echo "<option value=1>Jan</option>";
     echo "<option value=2>Feb</option>";
     echo "<option value=3>Mar</option>";
     echo "<option value=4>Apr</option>";
     echo "<option value=5>May</option>";
     echo "<option value=6>Jun</option>";
     echo "<option value=7>Jul</option>";
     echo "<option value=8>Aug</option>";
     echo "<option value=9>Sep</option>";
     echo "<option value=10>Oct</option>";
     echo "<option value=11>Nov</option>";
     echo "<option value=12>Dec</option>";
     echo "</select>";

     echo "<select name=day2>";
     echo "<option value=1>1</option>";
     echo "<option value=2>2</option>";
     echo "<option value=3>3</option>";
     echo "<option value=4>4</option>";
     echo "<option value=5>5</option>";
     echo "<option value=6>6</option>";
     echo "<option value=7>7</option>";
     echo "<option value=8>8</option>";
     echo "<option value=9>9</option>";
     echo "<option value=10>10</option>";
     echo "<option value=11>11</option>";
     echo "<option value=12>12</option>";
     echo "<option value=13>13</option>";
     echo "<option value=14>14</option>";
     echo "<option value=15>15</option>";
     echo "<option value=16>16</option>";
     echo "<option value=17>17</option>";
     echo "<option value=18>18</option>";
     echo "<option value=19>19</option>";
     echo "<option value=20>20</option>";
     echo "<option value=21>21</option>";
     echo "<option value=22>22</option>";
     echo "<option value=23>23</option>";
     echo "<option value=24>24</option>";
     echo "<option value=25>25</option>";
     echo "<option value=26>26</option>";
     echo "<option value=27>27</option>";
     echo "<option value=28>28</option>";
     echo "<option value=29>29</option>";
     echo "<option value=30>30</option>";
     echo "<option value=31>31</option>";

     echo "</select>";
     echo "<input name=year2 size=4 value=2010>";
*/
     echo "</td></tr></table>";

     echo "<tr><td valign=top>Optional: Additional Details</td>";
     echo "<td><textarea name=moredetails rows=4 cols=50>&nbsp</textarea></td></tr>";

     echo "<tr><td>File attachment</td>";
    echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2000000\" />";
    echo "<td><input name=\"uploaded_file\" type=\"file\" />";
    echo "</td></tr>";

     echo "</td></tr></table>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue width=700 colspan=2><font color=white><b>Email Template</b></font></td></tr>";

     echo "<tr><td>To</td><td><input name=to value=$email size=50></td></tr>";
   
     $result = mysql_query("SELECT * FROM tblemailnotifier WHERE notifierid=2", $dbh); 

     while ($myrow = mysql_fetch_row($result))
     {
          $from = $myrow[1];
          $subject = $myrow[2];
          $header = $myrow[3];
          $footer = $myrow[4];
          $notes = $myrow[5];
     }

     echo "<tr><td>From</td><td><input name=from size=50 value=$from></td></tr>";

     $result = mysql_query("SELECT tblcontact.email1 FROM tblcontact JOIN tbladminlogin ON tblcontact.employeeid = tbladminlogin.employeeid WHERE tbladminlogin.adminloginid=$loginid", $dbh);

     while ($myrow = mysql_fetch_row($result))
     {
          $bcc = $myrow[0];
     }
    $ccfin="";
    if($bcc!='') {
        if($bcc=="kbcruz@philkoei.com.ph") {
        $ccfin = $cc1;
        } else {
        $ccfin = $cc2;
        } //if-else
    } //if
    
     echo "<tr><td><i>Cc</i></td><td><input name=cc value=\"$ccfin\" size=50></td></tr>";
     echo "<tr><td><i>Bcc</i></td><td><input name=bcc value=$bcc size=50></td></tr>";

     echo "<tr><td>Subject</td><td><input name=subject size=50 value=\"$subject\"></td></tr>";
     echo "<tr><td>Header</td><td><textarea name=header rows=5 cols=50>$header</textarea></td></tr>";
     echo "<tr><td valign=top>Salary Details</td><td><textarea name=salary rows=3 cols=50 readonly>{Pls. review email body details above before sending}</textarea></td></tr>";
     echo "<tr><td valign=top>Footer</td><td><textarea name=footer rows=5 cols=50>$footer</textarea></td></tr>";
     echo "<tr><td valign=top>Notes</td><td><textarea name=notes rows=5 cols=50>$notes</textarea></td></tr>";

     echo "<tr><td>&nbsp</td><td><input type=submit value=Preview></td></tr>";
     echo "</table>";
     echo "</form>";

     echo "<script language=javascript>";
     echo "function mypopup()";
     echo "{";
     echo "alert(\"this is a test\")";
     echo "}"; 
     echo "</script>";
     echo "</html>";
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 