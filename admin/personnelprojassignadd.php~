<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}
?>
<script language="JavaScript" src="ts_picker.js"></script>  
<?php
if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Add new project assignment</font></p>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th colspan=2>Add New Project Assignment</th></tr>";

	if($employeeid=='') {
	echo "<tr><td colspan=2><font color=red><b>Sorry. No data available</b></font></td></tr>";
  } else {

	$resquery = "SELECT name_last, name_first, name_middle, position FROM tblcontact WHERE employeeid=\"$employeeid\"";
	$result=$dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow=$result->fetch_assoc()) {
	  $found = 1;
	  $name_last = $myrow['name_last'];
	  $name_first = $myrow['name_first'];
	  $name_middle = $myrow['name_middle'];
	  $position = $myrow['position'];
		} // while($myrow=$result->fetch_assoc())
	} // if($result->num_rows>0)

	echo "<tr><td colspan=2>For: $employeeid - <b>$name_last, $name_first $name_middle[0]</b> - $position</td></tr>";

// start add new project assignment

	echo "<form action=personnelprojassignadd2.php?loginid=$loginid&eid=$employeeid method=post name=\"personnelprojassignadd2\">";

	echo "<tr><th align=\"right\">Contract Reference No.</th><td><input name=ref_no></td></tr>";

	echo "<tr><th align=\"right\">Project Code/Name</th>";
	echo "<td><select class='chosen-select' name=\"proj_code\">";
	echo "<option>Select Project</option>";
	$res2query = "SELECT proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code != '' ORDER BY proj_code DESC";
	$result2=""; $found2=0;
	$result2=$dbh2->query($res2query);
	if($result2->num_rows>0) {
		while($myrow2=$result2->fetch_assoc()) {
	  $found2 = 1;
	  $proj_code = $myrow2['proj_code'];
	  $proj_fname = $myrow2['proj_fname'];
	  $proj_sname = $myrow2['proj_sname'];
	  $proj_fname2 = substr("$proj_fname", 0, 50);
	  echo "<option value=\"$proj_code\">$proj_code - $proj_sname - $proj_fname2</option>";
		} // while($myrow2=$result2->fetch_assoc())
	} // if($result2->num_rows>0)
	echo "</select></td></tr>";

	echo "<tr><th align=\"right\">Position</th><td>";
	// echo "<input size=30 name=position>";
	echo "<select name=\"idhrpositionctg\">";
	echo "<option value=0>-</option>";
	$res3query="SELECT idhrpositionctg, code, name, deptcd FROM tblhrpositionctg ORDER BY name ASC";
	$result3=""; $found3=0; $ctr3=0;
	$result3=$dbh2->query($res3query);
	if($result3->num_rows>0) {
		while($myrow3=$result3->fetch_assoc()) {
		$found3=1;
		$idhrpositionctg3 = $myrow3['idhrpositionctg'];
		$code3 = $myrow3['code'];
		$name3 = $myrow3['name'];
		$deptcd3 = $myrow3['name'];
		echo "<option value=\"$idhrpositionctg3\">$name3</option>";
		} // while($myrow3=$result3->fetch_assoc())
	} // if($result3->num_rows>0)
	echo "</select>";
	echo "</td></tr>";

	echo "<tr><th align=\"right\">Duration From</th><td>";
	echo "<input type=\"date\" name=\"datefrom\" value=\"$datenow\">";
	?>
  	<a href="javascript:show_calendar('document.personnelprojassignadd2.datefrom', document.personnelprojassignadd2.datefrom.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  <?php
	/*
	echo "<input name=fromyear size=4 value=2010>";
   
     echo "<select name=frommonth>";
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

     echo "<select name=fromday>";
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
	*/
	echo "</td></tr>";

	echo "<tr><th align=\"right\">Duration To</th><td>";
	echo "<input type=\"date\" name=\"dateto\" value=\"$datenow\">";
	?>
  	<a href="javascript:show_calendar('document.personnelprojassignadd2.dateto', document.personnelprojassignadd2.dateto.value);"><img src="./images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp"></a>
  <?php
	/*
	echo "<input name=toyear size=4 value=2010>";
   
     echo "<select name=tomonth>";
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

     echo "<select name=today>";
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
	*/
	echo "</td></tr>";

	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Submit\"></td></tr>";

	} // 

	echo "</table>";

// end add new project assignment
 
     echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back</a></p>";

		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result=$dbh2->query($resquery); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

$dbh2->close();
?>


<script>
		$(document).ready(function(){
			$('.chosen-select').chosen();
		});
</script>
