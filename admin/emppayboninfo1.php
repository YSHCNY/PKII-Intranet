<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$groupname2 = (isset($_GET['groupname'])) ? $_GET['groupname'] :'';

$employeetype = (isset($_POST['employeetype'])) ? $_POST['employeetype'] :'';
$groupname = (isset($_POST['groupname'])) ? $_POST['groupname'] :'';
$uploadsw = $_POST['uploadsw'];
$filename = basename( $_FILES['uploaded']['name']);

$datecreated = date("Y-m-d");

if($groupname2 == "") { $groupname2 = $groupname; }
else { $groupname = $groupname2; }
// echo "vartest group:$groupname<br>";

$found = 0;

$totgrossamt = 0;
$tottaxdeduct = 0;
$tototherdeduct = 0;
$totnetamt = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

/*     echo "<html><head><STYLE TYPE=\"text/css\">";
     echo "<!--";
     echo "p{font-family: Helvetica; font-size: 10pt;}";
     echo "B{font-family: Helvetica; font-size: 10pt;}";
     echo "TD{font-family: Helvetica; font-size: 10pt;}";
     echo "--->";
     echo "</STYLE></head>"; */

     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> Bonus Notifier >> Personnel details</font></p>";

     echo "<p><a href=emppaybon01.php?loginid=$loginid class='btn btn-default' role='button'>Back</a></p>";

    echo "<h3>Personnel Bonus Notifier - Details</h3>";

		echo "<table class='fin'>";     
		echo "<tr><td>";
     echo "Please fill-up individual details...";

     echo "<form enctype=\"multipart/form-data\" action=\"emppayboninfo1.php?loginid=$loginid&groupname=$groupname\" method=\"POST\">";
     echo "<input name=\"uploadsw\" type=\"hidden\" value=\"yes\">"; 
     echo "<input name=\"uploaded\" type=\"file\" /><br />";
     echo "<input type=\"submit\" value=\"Upload CSV File\" />";
     echo "</form>";
		echo "</td>";

		echo "<td>";
		 echo "or";
		 echo "<form action=\"emppaybonaddemp.php?loginid=$loginid&groupname=$groupname\" method=\"POST\" name=\"emppaybonaddemp\">";
		 echo "<button type=\"submit\" class='btn btn-success' name=\"employeeid\">Add personnel</button>";
		 echo "</form>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
  // echo "vartest uploadsw:$uploadsw, filename:$filename, groupname:$groupname,$groupname2<br>";

  if($uploadsw == "yes") {
    UploadFile();
// start inserting csv to mysql
    if(isset($_POST['submit'])) {
      $handle = fopen("transfers/$filename", "r");

      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $import="UPDATE tblemppaybonus SET date='$datenow', grossamt=$data[1], taxpercent=$data[2], taxdeduct=$data[3], otherdeduct=$data[4], netamt=$data[5], additional=$data[6] WHERE groupname='$groupname' AND employeeid='$data[0]'";
        mysql_query($import) or die(mysql_error());
        echo "Saving $datenow - $groupname - $data[0] - $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]<br>";
      }

      fclose($handle);
      print "Import done using fopen";
    } else {
	$res21query="DELETE FROM tblemppaybonus WHERE groupname='$groupname2'";
  $result21=$dbh2->query($res21query);
//	include("../includes/populateemppaybongroup.php");

	$data = mysql_query("LOAD DATA LOCAL INFILE '/var/www/pkii/admin/transfers/$filename'
	INTO TABLE maindb.tblemppaybonus
	FIELDS TERMINATED BY ','
	LINES TERMINATED BY '\n'
	(groupname, employeeid, grossamt, taxpercent, taxdeduct, otherdeduct, netamt, additional)")
	or die(mysql_error());

	print "Import done using data infile";
    }
  }

	echo "<table class='fin'>";

	echo "<tr><th>Count</th><th>EmpID</th><th>LastName</th><th>FirstName</th><th>email</th><th>Gross<br>Amount</th><th>Additional</th><th>Tax<br>Percentage</th><th>Tax<br>Deduction</th><th>Other<br>Deductions</th><th>Net<br>Amount</th><th colspan='2'>Action</th></tr>";

	$res2query="SELECT tblcontact.employeeid, tblcontact.name_last, tblcontact.name_middle, tblcontact.name_first, tblcontact.email1 FROM tblcontact WHERE tblcontact.employeeid != '' ORDER BY tblcontact.name_last ASC";
	$count1 = 0;
  $result2=$dbh2->query($res2query);
  if($result2->num_rows>0) {
    while($myrow2=$result2->fetch_assoc()) {
		$found2 = 1;
		$employeeid = $myrow2['employeeid'];
		$name_last = $myrow2['name_last'];
		$name_middle = $myrow2['name_middle'];
		$name_first = $myrow2['name_first'];
		$email1 = $myrow2['email1'];

		$resquery="SELECT DISTINCT tblemppaybonus.employeeid, tblemppaybonus.groupname, tblemppaybonus.grossamt, tblemppaybonus.taxpercent, tblemppaybonus.taxdeduct, tblemppaybonus.otherdeduct, tblemppaybonus.netamt, tblemppaybonus.additional FROM tblemppaybonus WHERE tblemppaybonus.employeeid = \"$employeeid\" AND tblemppaybonus.groupname = \"$groupname\"";
    $result=$dbh2->query($resquery);
    if($result->num_rows>0) {
        while($myrow=$result->fetch_assoc()) {
			$found = 1;
			$employeeid = $myrow['employeeid'];
			$groupname = $myrow['groupname'];
			$grossamt = $myrow['grossamt'];
			$taxpercent = $myrow['taxpercent'];
			$taxdeduct = $myrow['taxdeduct'];
			$otherdeduct = $myrow['otherdeduct'];
			$netamt = $myrow['netamt'];
      $additional = $myrow['additional'];

			$count1 = $count1 + 1;

		echo "<form action=\"emppayboninfo3.php?loginid=$loginid&groupname=$groupname\" method=\"POST\" name=\"myform2\">";
		echo "<tr><td>$count1</td><td><input type=checkbox name=\"employeeid\" value=\"$employeeid\" checked>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$email1</td>";
		echo "<td align=right><input size=7 style=\"text-align: right\" name=grossamt value=$grossamt></td>";
		echo "<td align=right><input size=7 style=\"text-align: right\" name=additional value=$additional></td>";
		echo "<td align=right><input size=\"3\" style=\"text-align: right\" name=\"taxpercent\" value=\"$taxpercent\">%</td>";
		echo "<td align=right><input size=6 style=\"text-align: right\" name=taxdeduct value=$taxdeduct></td>";
		echo "<td align=right><input size=6 style=\"text-align: right\" name=otherdeduct value=$otherdeduct></td>";
		echo "<td align=right>$netamt</td>";
		echo "<td><button type='submit' class='btn btn-success'>Update</button></td>";
		echo "</form>";
    echo "<form action=\"emppayboninfo3del.php?loginid=$loginid&groupname=$groupname\" method=\"POST\" name=\"emppayboninfo3del\">";
    echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
    echo "<td><button type='submit' class='btn btn-danger'>Del</button></td>";
    echo "</form>";
    echo "</tr>";

        } //while
    } //if

    } //while
  } //if

     $res5query = "SELECT DISTINCT employeeid, groupname, grossamt, taxdeduct, otherdeduct, netamt, additional FROM tblemppaybonus WHERE groupname = \"$groupname\"";
    $result5=$dbh2->query($res5query);
    if($result5->num_rows>0) {
        while($myrow5=$result5->fetch_assoc()) {
	$found5 = 1;
	$employeeid = $myrow5['employeeid'];
	$groupname = $myrow5['groupname'];
	$grossamt = $myrow5['grossamt'];
	$taxdeduct = $myrow5['taxdeduct'];
	$otherdeduct = $myrow5['otherdeduct'];
	$netamt = $myrow5['netamt'];
  $additional = $myrow['additional'];

  $grossamt1 = $grossamt + $additional;
	$totgrossamt = $totgrossamt + $grossamt1;
	$tottaxdeduct = $tottaxdeduct + $taxdeduct;
	$tototherdeduct = $tototherdeduct + $otherdeduct;
	$totnetamt = $totnetamt + $netamt;
        } //while
    } //if

     $res6query = "SELECT * FROM tblemppaybontotal WHERE groupname = \"$groupname\"";
    $result6=$dbh2->query($res6query);
    if($result6->num_rows>0) {
        while($myrow6=$result6->fetch_assoc()) {
	$found6 = 1;
	$groupname = $myrow6['groupname'];
        } //while
    } //if

     if ($found6 == 1) {
	$res7query = "UPDATE tblemppaybontotal SET datecreated=\"$datecreated\", totgrossamt=$totgrossamt, tottaxdeduct=$tottaxdeduct, tototherdeduct=$tototherdeduct, totnetamt=$totnetamt WHERE groupname = \"$groupname\"";
     } else {
	$res7query = "INSERT INTO tblemppaybontotal (groupname, datecreated, totgrossamt, tottaxdeduct, tototherdeduct, totnetamt) VALUES (\"$groupname\", \"$datecreated\", $totgrossamt, $tottaxdeduct, $tototherdeduct, $totnetamt)";
     }
    $result7 = $dbh2->query($res7query);

     echo "<tr><th colspan=\"5\" class='text-right'>Total</th><th class='text-right'>".number_format($totgrossamt, 2)."</th><th colspan='2'>&nbsp;</th><th class=\"text-right\">".number_format($tottaxdeduct, 2)."</th><th class=\"text-right\">".number_format($tototherdeduct, 2)."</th><th class=\"text-right\">".number_format($totnetamt, 2)."</th></tr>";

     echo "</table>";
//     echo "<p>";
//     echo "<input type=submit value=Save>";
     echo "</form>";

//     echo "<p><a href=emppayboninfo1.php?loginid=$loginid>Back</a><br>";
//     echo "</html>";
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();

function UploadFile() {
     $target = "transfers/"; 
     $target = $target . basename( $_FILES['uploaded']['name']) ; 
     $ok=1; 

     //This is our size condition 
     // if ($uploaded_size > 350000) 
     //{ 
     //     echo "Your file is too large.<br>"; 
     //     $ok=0; 
     //} 

     //This is our limit file type condition 
     if ($uploaded_type =="text/php") { 
          echo "No PHP files<br>"; 
          $ok=0; 
     } 

     //Here we check that $ok was not set to 0 by an error 
     if ($ok==0) { 
          echo "<font color=red>Sorry your file was not uploaded. Please try again.</font>"; 
     } 

     //If everything is ok we try to upload it 
     else { 
          if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) { 
               echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded";
          } else { 
               echo "<font color=red>Sorry, there was a problem uploading your file. Please try again.</font>"; 
          }
     }

     echo "<br>";
} 
?>
