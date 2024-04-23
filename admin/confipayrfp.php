<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$groupname = $_GET['groupname'];
$cutstart = $_GET['cutstart'];
$cutend = $_GET['cutend'];

if($groupname == '' && $cutstart == '' && $cutend == '')
{
  $groupcut = $_POST['groupcut'];
  $cutoffarray = split(",", $groupcut);
  $groupname = $cutoffarray[0];
  $cutstart = $cutoffarray[1];
  $cutend = $cutoffarray[2];
}


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
     echo "<p>For payroll group and cutoff period:<br>";
     echo "<b>$groupname: $cutstart to $cutend</b></p>";

// Display members list for this cutoff
  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><td>Count</td><td>Employee#</td><td>FullName</td><td>Action</td></tr>";
  $result11 = mysql_query("SELECT confipayrollid, employeeid FROM tblconfipayroll WHERE groupname=\"$groupname\" AND cutstart=\"$cutstart\" AND cutend=\"$cutend\" ORDER BY employeeid ASC", $dbh);
  if($result11 != '')
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $confipayrollid11 = $myrow11[0];
      $employeeid11 = $myrow11[1];

      $result12 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$employeeid11\"", $dbh);
      if($result12 != '')
      {
	while($myrow12 = mysql_fetch_row($result12))
	{
	  $found12 = 1;
	  $name_last12 = $myrow12[0];
	  $name_first12 = $myrow12[1];
	  $name_middle12 = $myrow12[2];
	}
      }

      $count = $count + 1;

      echo "<tr><td>$count</td><td>$employeeid11</td><td>$name_last12, $name_first12 $name_middle12[0]</td><td><a href=\"confipayrfpview.php?loginid=$loginid&groupname=$groupname&cutstart=$cutstart&cutend=$cutend&empid=$employeeid11\" target=\"_blank\">Display RFP</a></td></tr>";
    }
  }

  echo "</table>";

//  echo "<p><a href=\"confipaytools.php?loginid=$loginid&groupname=$groupname&cutstart=$cutstart&cutend=$cutend\">Back</a></p>";

     echo "</html>";
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>
