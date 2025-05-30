<?php
include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
// start code here...

$target_path0 = "./transfers/emailnotifier";

$filename = basename( $_FILES['uploadedfile']['name'] );
$filename1 = str_replace(' ', '_', $filename);

if($filename1 != "") { $filenamefin = "$employeeid"."$filename1"; }

// update into crewcert table
//  $result12 = mysql_query("UPDATE consultantpayadvise SET filepath=\"$target_path0\", filename=\"$filenamefin\" WHERE employeeid=\"$employeeid\" AND conspayadvid=$conspayadvid", $dbh);

$target_path = $target_path0 . "/" . $filename1; 

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
{   
    $imagefile = $target_path0 . "/" . $filename1;
    
    $newimagefile = $target_path0 . "/" . $filenamefin;
    
    rename($imagefile, $newimagefile);
    
    echo "$target_path0\n";
    
    // create log
    $logdetails = "idlogin:". $idlogin . " uploaded email notifier document for empid:$employeeid, path: $target_path0, filename:$filenamefin";

    $result14 = mysql_query("INSERT INTO tbllogs (timestamp, loginid, username, logdetails) VALUES (\"$timestamp\", $loginid, \"$username\", \"$logdetails\")", $dbh);
 
}
else
{
    echo "There was an error uploading the file, please try again!<br>";
}

?> 
<!-- <form method="post">
<input type="button" value="Close Window" 
onclick="window.close()">
</form> -->
<?

// end code here...
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>
