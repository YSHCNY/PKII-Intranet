<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';
$idtblemppassport = (isset($_GET['idpp'])) ? $_GET['idpp'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

    //  echo "<p><font size=1>Directory >> Manage Personnel >> Edit passport details</font></p>";

	?>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />

   
   <?php

     if ($employeeid == '')
     {
	echo "<tr><td colspan=\"2\"><font color=\"red\"><b>Sorry. No data available</b></font></td></tr>";
     }
     else
     {

	// query personnel name
	$res12query = "SELECT name_last, name_first, name_middle, position, contactid FROM tblcontact WHERE employeeid = \"$employeeid\" AND contact_type=\"personnel\"";
	$result12 = $dbh2->query($res12query);
	if($result12->num_rows>0) {
		// while ($myrow = mysql_fetch_row($result)) {
		while($myrow12 = $result12->fetch_assoc()) {
	  $found12 = 1;
	  $name_last12 = $myrow12['name_last'];
	  $name_first12 = $myrow12['name_first'];
	  $name_middle12 = $myrow12['name_middle'];
	  $position12 = $myrow12['position'];
		$contactid12 = $myrow12['contactid'];
		} // while($myrow = $result->fetch_assoc())
	} // if($result->num_rows>0)

	echo "<div class = 'p-4 shadow'><h4 class = 'text-capitalized'>Edit passport details for: $employeeid - <b>$name_last12, $name_first12 $name_middle12[0]</b> - $position12</h4></div>";

// start edit passport details
echo "<table class=\"table table-bordered table-striped table-hover\" >";

	// query tblemppassport
	$res11query = "SELECT passportnum, countrycd, issuedby, dateissued, dateexpiry, filepath, filename FROM tblemppassport WHERE idtblemppassport=$idtblemppassport";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$passportnum11 = $myrow11['passportnum'];
		$countrycd11 = $myrow11['countrycd'];
		$issuedby11 = $myrow11['issuedby'];
		$dateissued11 = $myrow11['dateissued'];
		$dateexpiry11 = $myrow11['dateexpiry'];
		$filepath11 = $myrow11['filepath'];
		$filename11 = $myrow11['filename'];
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)

	echo "<form enctype=\"multipart/form-data\" action=\"personnelpassportedt2.php?loginid=$loginid&eid=$employeeid&idpp=$idtblemppassport\" method=\"post\" name=\"perspassportedit2\">";
	echo "<tr><td align=\"right\">Passport number</td><td><input class = 'form-control' name=\"passportnum\" value=\"$passportnum11\"></td></tr>";
	echo "<tr><td align=\"right\">Issuing country</td><td>";
	echo "<select name=\"countrycd\" id = 'mySelect' class = 'form-select' >";
	if($countrycd11=='') { echo "<option value=''>-</option>"; }
	$res18query = "SELECT cname, letter2cd FROM tblcountrycd ORDER BY cname ASC";
	$result18=""; $found18=0; $ctr18=0;
	// $result18 = mysql_query("$res18query", $dbh);
	$result18 = $dbh2->query($res18query);
	// if($result18 != "") {
	if($result18->num_rows>0) {
		// while($myrow18 = mysql_fetch_row($result18)) {
		while($myrow18 = $result18->fetch_assoc()) {
		$found18 = 1;
		$ctr18 = $ctr18 + 1;
		$cname18 = $myrow18['cname'];
		$letter2cd18 = $myrow18['letter2cd'];
		if($letter2cd18==$countrycd11) { $letter2cdsel="selected"; } else { $letter2cdsel=""; }
		echo "<option value=\"$letter2cd18\" $letter2cdsel>$cname18 ($letter2cd18)</option>";
		} // while($myrow18 = $result18->fetch_assoc())
	} // if($result18->num_rows>0)
	echo "</select>";
	echo "</td></tr>";
	echo "<tr><td align=\"right\">Issued by</td><td><input class = 'form-control' type=\"text\" name=\"issuedby\" value=\"$issuedby11\"></td></tr>";
	echo "<tr><td align=\"right\">Issued date</td><td><input class = 'form-control' type=\"date\" name=\"dateissued\" value=\"$dateissued11\">";
	
	echo "</td></tr>";
	echo "<tr><td align=\"right\">Expiry date</td><td><input class = 'form-control' type=\"date\" name=\"dateexpiry\" value=\"$dateexpiry11\">";
	
	echo "</td></tr>";
	// 20171002 file attachment
	echo "<tr><td align=\"right\">Attachment</td><td>";
	if($filename3 != "") {
    echo "<a href=\"$filepath11/$filename11\" target=\"_blank\">$filename11</a>&nbsp;&nbsp;&nbsp;<i><a href=\"perspassportdelfile.php?loginid=$loginid&eid=$employeeid&pid=$idtblemppassport\">Remove</a></i><br>";    
  }
  echo "<input class = 'form-control' type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"20000000\" />";
  echo "<input class = 'form-control' name=\"uploadedfile\" type=\"file\" />";
	echo "</td></tr>";
	echo "</table>";
	echo "<div class = 'text-end'><a href=\"personneledit2.php?loginid=$loginid&pid=$employeeid\" class = 'btn  mx-1'>Cancel</a><button class = 'btn mx-1 bg-success text-white' type=\"submit\" >Upload</button></div></form>";


// end add education

     }

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery);

     include ("footer.php");
	 ?>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
 
	 <script>
		 $(document).ready(function() {
			 // Initialize Select2
			 $('#mySelect').select2({
				 placeholder: "Select an option",
			
			 });
		 });
	 </script>
	  <?php
}
else
{
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
