<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$wpgenyear = (isset($_POST['wpgenyear'])) ? $_POST['wpgenyear'] :'';
$wpgenmonth = (isset($_POST['wpgenmonth'])) ? $_POST['wpgenmonth'] :'';
$wpgendate = $wpgenyear."-".$wpgenmonth;

$wpgenmonthname = date("F", mktime(0, 0, 0, $wpgenmonth));

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}  

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// start contents here

echo "<table class=\"fin\" border=\"1\">";

?>

<tr><th colspan='4'>PKII Working Paper - Generate</th></tr>

<?php

// check if year-month selected exists on tblfinworkpaper
  $found11 = 0;
  $result11 = mysql_query("SELECT month FROM tblfinworkpaper WHERE month LIKE '$wpgendate%'", $dbh);
  if($result11 != '')
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $month11 = $myrow11[0];
    }
    if($found11 == 1)
    {
      echo "<tr><td colspan=\"4\"><font color=\"red\">Selected month already processed. Please try again.</font></td></tr>";
      echo "<td colspan=\"2\" align=\"center\"><form action=\"finvouchworkpgen.php?loginid=$loginid\" method=\"post\">";
      // echo "<input type=\"submit\" value=\"Back\">";
        echo "<button type='submit' class='btn btn-default'>Back</button>";
      echo "</form></td></tr>";
    }
    else
    {
      if($wpgenmonth == 1)
      {
        $wpstartmonth = 12;
        $wpstartyear = $wpgenyear - 1;
      }
      else
      {
        $wpstartmonth = $wpgenmonth - 1;
	if($wpstartmonth <= 9) { $wpstartmonth = "0".$wpstartmonth; }
        $wpstartyear = $wpgenyear;
      }
      $wpgendate2 = $wpstartyear."-".$wpstartmonth;
      $result12 = mysql_query("SELECT month FROM tblfinworkpaper WHERE month LIKE '$wpgendate2%'", $dbh);
      if($result12 != '')
      {
        while($myrow12 = mysql_fetch_row($result12))
        {
	  $found12 = 1;
	  $month12 = $myrow12[0];
        }
      }
      if($found12 != 1)
      {
        echo "<tr><td colspan=\"4\"><font color=\"red\">Sorry, no record for the previous month's working paper.<br>Would you like to input beginning balances of each account codes?</font></td></tr>";
        echo "<tr><td colspan=\"2\" align=\"center\"><form action=\"finvouchworkpgen2a.php?loginid=$loginid&gd=$wpgendate\" method=\"post\">";
        // echo "<input type=\"submit\" value=\"Yes\">";
        echo "<button type='submit' class='btn btn-success'>Yes</button>";
        echo "</form></td>";
        echo "<td colspan=\"2\" align=\"center\"><form action=\"finvouchworkpgen.php?loginid=$loginid\" method=\"post\">";
        // echo "<input type=\"submit\" value=\"No\">";
        echo "<button type='submit' class='btn btn-danger'>No</button>";
        echo "</form></td></tr>";
      }
      else
      {
        echo "<tr><td colspan=\"4\">Ready to fetch beginning balances from last month... <br>Click on the '<b>OK</b>' button to display beginning balances.</td></tr>";
        echo "<tr><td colspan=\"2\" align=\"center\"><form action=\"finvouchworkpgen2a.php?loginid=$loginid&gd=$wpgendate\" method=\"post\">";
        // echo "<input type=\"submit\" value=\"OK\">";
        echo "<button type='submit' class='btn btn-success'>OK</button>";
        echo "</form></td>";
        echo "<td colspan=\"2\" align=\"center\"><form action=\"finvouchworkpgen.php?loginid=$loginid\" method=\"post\">";
        // echo "<input type=\"submit\" value=\"Cancel\">";
        echo "<button type='submit' class='btn btn-danger'>Cancel</button>";
        echo "</form></td></tr>";
      }
    }

  }


?>

<?php
echo "</table>";

echo "<br><p><a href=\"finvouchmain.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";



// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>