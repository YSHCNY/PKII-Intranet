<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$employeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';

$daterehired = $_POST['fromyear'] . '-' . $_POST['frommonth'] . '-' . $_POST['fromday'];
$dateresigned = $_POST['toyear'] . '-' . $_POST['tomonth'] . '-' . $_POST['today'];
$remarks = (isset($_POST['remarks'])) ? $_POST['remarks'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Add re-employment details</font></p>";

//  if ($durationfrom >= $durationto)
//  {
//    echo "<p><font color=red><b>Sorry Invalid Date</b></font></p>";
//    echo "<p>Date duration field 'From' should be earlier than or not equal to the date field 'To'</p>";
//    echo "<p><a href=personnelprojassignadd.php?loginid=$loginid&eid=$employeeid>Back</a></p>";
//  }
//  else
//  {

	echo "<p><font color=green><b>Add re-employment details successful!</b></font></p>";

        $res0query=""; $result0="";
	$res0query="SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid' AND `contact_type`='personnel'";
        $result0=$dbh2->query($res0query);
        if($result0->num_rows>0) {
            while($myrow0=$result0->fetch_assoc()) {
	  $name_last = $myrow0['name_last'];
	  $name_first = $myrow0['name_first'];
	  $name_middle = $myrow0['name_middle'];
            } //while
        } //if

  	include("datetimenow.php");

	echo "<p>For: <b>$employeeid - $name_last, $name_first $name_middle[0]</b><br>";
	echo "Re-employment details: $daterehired -to- $dateresigned<br>";

        $res1query=""; $result1="";
	$res1query="INSERT INTO tblemprehire (employeeid, daterehired, dateresigned, remarks) VALUES (\"$employeeid\", \"$daterehired\", \"$dateresigned\", \"$remarks\")";
        $result1=$dbh2->query($res1query);

	echo "empid = $employeeid<br>";
	echo "daterehired = $daterehired<br>";
	echo "dateresigned = $dateresigned<br>";
	echo "remarks = $remarks<br>";
	echo "Update Record - OK<br>";

     echo "<p><a href = \"personneledit2.php?loginid=$loginid&pid=$employeeid\" class='btn btn-default' role='button'>Back to Edit Personnel Info</a><br>";

//  }

  $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 

