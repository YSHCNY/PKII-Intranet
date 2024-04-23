<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeetype = (isset($_POST['employeetype'])) ? $_POST['employeetype'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> Personnel Bonus Notifier</font></p>";

     echo "<table class='fin'>";
     echo "<tr><th>Personnel Bonus Notifier</th></tr>";

//	echo "<form enctype=\"multipart/form-data\" action=emppayproccsv.php method=POST>";
//	echo "<input type=hidden name=MAX_FILE_SIZE value=50000 />";
//	echo "Choose a file:<br /><input name=uploadedfile type=file /><br />";
//	echo "<p><input type=submit value=\"Process this file\" />";
//	echo "</form>"; 

     echo "<tr><td><a href=\"emppaybongrpadd.php?loginid=$loginid\" class='btn btn-primary' role='button'>Prepare Personnel</a></td></tr>";
     echo "<tr><td><a href=\"emppayboninfo.php?loginid=$loginid\" class='btn btn-primary' role='button'>Bonus Details</a></td></tr>";

     echo "<tr><td><a href=\"emppaybonbpi.php?loginid=$loginid\" class='btn btn-primary' role='button'>Create BPI Transaction</a></td></tr>";

     echo "<tr><td><a href=\"emppaybonsend.php?loginid=$loginid\" class='btn btn-primary' role='button'>Send emails</a></td></tr>";
     echo "</table>";

     echo "<p><a href=\"emppaybon00.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
