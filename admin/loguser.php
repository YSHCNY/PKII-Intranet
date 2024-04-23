<?php 

include("db1.php");
include "timeago.php";


$loginid = $_GET['loginid'];
$pagenum = $_GET['page'];

$found = 0;

$reccount = 0;
$pagerecstart = 0;
$rowsperpage = 100;

$logdtfr = $_POST['logdtfr'];
$logdtto = $_POST['logdtto'];
$logusrnm = $_POST['logusrnm'];

if(($logdtfr == '') || ($logdtto == '')) {
	$logdtto = $datenow;
	// $logdtfr = (strtotime($datenow) - 30 days);
	$logdtfr = strtotime(date("Y-m-d", strtotime($logdtto)) . " - 30 days");
	$logdtfr1 = date("Y-m-d", $logdtfr);
} else { $logdtfr1 = $logdtfr; }

$logdtfrts = $logdtfr1 . " " . "00:00:00";
$logdttots = $logdtto . " " . "23:59:59";

if($loginid != "")
{
    include("logincheck.php");
}

if ($found == 1)
{
    include ("header.php");
    include ("sidebar.php");
?>

<script language="JavaScript" src="ts_picker.js"></script>

<?php
    if($pagenum == "")
    {
      $pagenum = 0;
      $pagerecstart = 0;
    }
    else
    {
      $pagerecstart = ($pagenum) * $rowsperpage;
    }

    ?>
<div class = 'shadow px-4 py-5 my-2 '>
  <div class="mb-4 mx-3">
<p class = 'fs-4 mb-0 fw-bold text-dark'>User Activity Logs</p>
<p class="fs-5 text-muted">View logs of users and actions.</p>
</div>

<!-- form -->
<div class = 'flex border rounded-3 p-4 '>
  <p class = 'text-muted fs-6'>Action</p>
    <?php
	

		echo "<form method=\"post\" action=\"loguser.php?loginid=$loginid&page=$pagenum0\"  class = ' text-center mt-3' name=\"formlog\">";
		echo "<span class = 'text-muted fs-4'>From</span> <input class = 'my-2 bg-white rounded-3 px-3 py-2 border' type = 'date'  size=\"8\" name=\"logdtfr\" value=\"$logdtfr1\">";
		?>
     <!-- <a href="javascript:show_calendar('document.formlog.logdtfr', document.formlog.logdtfr.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a> -->
    <?php
		echo "<span class = 'text-muted fs-4'>To</span> <input class = 'my-2 bg-white rounded-3 px-3 py-2 border' type = 'date' size=\"8\" name=\"logdtto\" value=\"$datenow\">";
		?>
     <!-- <a href="javascript:show_calendar('document.formlog.logdtto', document.formlog.logdtto.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a> -->
    <?php
		echo "<input list=\"persons\" placeholder = 'Type User.. or leave blank' class = 'my-2 bg-white rounded-3 px-3 py-2 border' name=\"logusrnm\">";
    echo "<datalist id = 'persons'>";
		if($logusrnm == "") {
			echo "<option value=\"usersall\">ALL</option>";
		}
		$result12=""; $found12=0;
		$result12 = mysql_query("SELECT DISTINCT username FROM tbllogs ORDER BY username ASC", $dbh);
		if($result12 != "") {
			while($myrow12 = mysql_fetch_row($result12)) {
			$found12=1;
			$username12 = $myrow12[0];
			if($username12 == $logusrnm) { $logusrnmsel="selected"; } else { $logusrnmsel=""; }
			echo "<option value=\"$username12\" $logusrnmsel>$username12<option>";
			}
		}
		echo "</datalist>";
    echo "<button type=\"submit\" class = 'my-2 mx-3 rounded-3 px-3 py-2 border-0 mainbtnclr text-white'>Filter</button> ";
		echo "</form>";
		// echo "<br>vartest usrnm:$logusrnm, ttfr:$logdtfrts ttto:$logdttots";

    ?>

</div>
<?php
		

 
	  if(($logusrnm == "usersall") || ($logusrnm == "")) {
      // $result11 = mysql_query("SELECT adminlogid, timestamp, adminuid, adminlogdetails FROM tbladminlogs WHERE timestamp>=\"$logdtfrts\" AND timestamp<=\"$logdttots\" ORDER BY timestamp DESC", $dbh);
		$result11 = mysql_query("SELECT timestamp, loginid, username, logdetails FROM tbllogs WHERE logid <> '' ORDER BY logid DESC LIMIT $pagerecstart, $rowsperpage", $dbh);
			// $result11 = mysql_query("SELECT adminlogid, timestamp, adminuid, adminlogdetails FROM tbladminlogs WHERE timestamp>=\"$logdtfrts\" AND timestamp<=\"$logdttots\" ORDER BY timestamp DESC LIMIT $pagerecstart, $rowsperpage", $dbh);
			} else {
      // $result11 = mysql_query("SELECT adminlogid, timestamp, adminuid, adminlogdetails FROM tbladminlogs WHERE adminuid=\"$logusrnm\" AND (timestamp>=\"$logdtfrts\" AND timestamp<=\"$logdttots\") ORDER BY timestamp DESC", $dbh);
		$result11 = mysql_query("SELECT timestamp, loginid, username, logdetails FROM tbllogs WHERE username='$logusrnm' ORDER BY logid DESC LIMIT $pagerecstart, $rowsperpage",$dbh);
			// $result11 = mysql_query("SELECT adminlogid, timestamp, adminuid, adminlogdetails FROM tbladminlogs WHERE adminuid=\"$logusrnm\" AND (timestamp>=\"$logdtfrts\" AND timestamp<=\"$logdttots\") ORDER BY timestamp DESC LIMIT $pagerecstart, $rowsperpage", $dbh);
			}
      // $result11 = mysql_query("SELECT timestamp, loginid, username, logdetails FROM tbllogs WHERE logid <> '' ORDER BY logid DESC LIMIT $pagerecstart, $rowsperpage", $dbh);
      while($myrow11 = mysql_fetch_row($result11))
      {
	$found11 = 1;
	$timestamp11 = $myrow11[0];
	$loginid11 = $myrow11[1];
	$username11 = $myrow11[2];
	$logdetails11 = $myrow11[3];
  echo "

  <div class = 'border rounded-3 px-5 m-4'>  
 <div class='row pt-5'>
 <div class='col-lg-10'>
 <p class = 'text-muted fs-5 mb-0'>Details:</p>
 <p class = 'text-dark '><i>On</i> $timestamp11, <span class = 'text-uppercase fw-bold'>$username11</span>, <i>$logdetails11</i></p>
 </div>

 <div class='col-lg-2'>
 <p class = 'text-end text-muted'>" . timeAgo($timestamp11) . "</p>
 </div>
 </div>

  
  </div>
 ";
      }
      ?>
      </div>
      <?php
    $pagenum0 = $pagenum - 1;
    $pagenum2 = $pagenum + 1;

    echo "<tr><td colspan=\"4\" align=\"right\">";
    if ($pagenum0 < 0) { echo "&nbsp;"; } else {
    echo "<a href=\"logadminuser.php?loginid=$loginid&page=$pagenum0\">Back | </a>"; }

    $result22 = mysql_query("SELECT logid FROM tbllogs ORDER BY logid DESC LIMIT 0, 1", $dbh);
    while ($myrow22 = mysql_fetch_row($result22))
    {
      $found22 = 1;
      $maxlogid = $myrow22[0];
    }

    $reccounttot = $pagerecstart + $rowsperpage;

    echo "&nbsp;<b>$pagenum2</b>&nbsp;";

    if ($reccounttot >= $maxlogid)
    {
      echo "&nbsp;";
    }
    else
    {
      echo "<a href=\"loguser.php?loginid=$loginid&page=$pagenum2\"> | Next</a>";
    }
    echo "</td></tr>";

    echo "</table>";
    echo "</td></tr>"; 
    echo "</table>";

    echo "<p><a href=\"logs.php?loginid=$loginid\">Back</a></p>";

    $result = mysql_query("UPDATE tbllogin SET login_stat=1 WHERE loginid=$loginid", $dbh); 
  
    include ("footer.php");
}
else
{
    include ("logindeny.php");
}

mysql_close($dbh);

?> 
