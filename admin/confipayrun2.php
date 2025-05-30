<?php 

require("db1.php");
include("datetimenow.php");
// include("clsmcrypt.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$radiochecked = (isset($_GET['rs'])) ? $_GET['rs'] :'';
$groupname = (isset($_POST['groupname'])) ? $_POST['groupname'] :'';

if($radiochecked == "") {
  $checkedcutoff = "checked";
  $stylecutoff = "";
  $styleonetime = "style='display:none;'";
} else if($radiochecked == "cutoff") {
  $checkedcutoff = "checked";
  $stylecutoff = "";
  $styleonetime = "style='display:none;'";
} else if($radiochecked == "onetime") {
  $checkedonetime = "checked";
  $stylecutoff = "style='display:none;'";
  $styleonetime = "";
} // if($radiochecked == "")

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
?>
     <html><head><STYLE TYPE="text/css">
     <!--
     p{font-family: Helvetica; font-size: 10pt;}
     B{font-family: Helvetica; font-size: 10pt;}
     TD{font-family: Helvetica; font-size: 10pt;}
     TH{font-family: Helvetica; font-size: 12pt;}
     --->
     </STYLE></head><body>
<?php

     echo "<b>Custom Payroll System - Pay Period Process<br>for $groupname group</b>";

?>
<script type="text/javascript">
function get_radio_value(val)
{
  val = val - 1;
  for (var i=0; i < document.pay.type.length; i++){
    if(i==val){
      document.pay.type[i].checked = true;
    }
  }
  for (var i=0; i < document.pay.type.length; i++){
    if (document.pay.type[i].checked)
    {
      var rad_val = document.pay.type[i].value;
      document.getElementById(rad_val).style.display = "block";
    }
    else {
      var rad_val = document.pay.type[i].value;
      document.getElementById(rad_val).style.display = "none";
    }
  }
}
</script>

	<form name='pay'>
	<table class='fin' border='1'>
	<tr><th colspan='4'>choose pay type</th></tr>
	<tr><td colspan='2' align='left'>
	<input type='radio' name='type' value='cutoff' onClick="get_radio_value(1);" <?php echo "$checkedcutoff"; ?>>Payroll cut-off period
	</td><td colspan='2' align='left'>
	<input type='radio' name='type' value='onetime' onClick="get_radio_value(2);" <?php echo "$checkedonetime"; ?>>One-time payment only
	</td></tr>
	</form>
	<tr><td colspan='4'>

<div id='cutoff' <?php echo "$stylecutoff"; ?>>
<?php
echo "<table>";
     echo "<form action=\"confipayrun3.php?loginid=$loginid&rs=cutoff\" method=\"POST\" name=\"myform\">";
		echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
		// echo "<input type=\"hidden\" name=\"rs\" value=\"cutoff\">";

     echo "<tr><td>Cutoff-Start</td>";
   
     echo "<td><select name=month>";
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
     echo "</select></td>";

     echo "<td><select name=daystart>";
     echo "<option value=1>1</option>";
     echo "<option value=16>16</option>";
     echo "</select></td>";

     echo "<td><input name=\"year\" size=\"4\" value=\"$yearnow\"></td></tr>";

     echo "<tr><td>Cutoff-End</td>";
   
     echo "<td>&nbsp;</td>";

     echo "<td><select name=dayend>";
     echo "<option value=15>15</option>";
     echo "<option value=28>28</option>";
     echo "<option value=29>29</option>";
     echo "<option value=30>30</option>";
     echo "<option value=31>31</option>";
     echo "</select></td>";

     echo "<td>&nbsp;</td></tr>";
     echo "<tr><td>&nbsp;</td><td colspan=3 align=center><input type=\"submit\" value=\"Prepare Payroll\">";
		echo "</form>";
echo "</table>";
?>
</div>

<div id='onetime' <?php echo "$styleonetime"; ?>>
<?php
echo "<table>";
     echo "<form action=\"confipayrun3.php?loginid=$loginid&rs=onetime\" method=\"POST\" name=\"myform\">";
		echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
		// echo "<input type=\"hidden\" name=\"rs\" value=\"onetime\">";

	echo "<tr><td colspan=\"4\">";
	// echo "pay name&nbsp;<input name=\"nameotp\">";
	echo "date:&nbsp;<input type=\"date\" name=\"dateotp\" value=\"$datenow\">";
	echo "</td></tr>";

     echo "<tr><td>&nbsp;</td><td colspan=3 align=center><input type=\"submit\" value=\"Prepare Payroll\">";
		echo "</form>";
echo "</table>";
?>
</div>

	</td></tr></table></body></html>

<?php
//     echo "<p><a href=confipay2.php?loginid=$loginid>Back</a><br>";
}
else
{
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
