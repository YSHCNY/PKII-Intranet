<?php 

require('./db1.php');

include './datetimenow.php';

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$import = (isset($_POST['import'])) ? $_POST['import'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Manage >> HR Modules >> Sync e-door logs to Time & Attendance log</font></p>";

// start contents here...
if($accesslevel >= 4) {

?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <button class="btn btn-primary" type="submit" name="import">Import</button>
    </form>
<?php
    if(isset($_POST['import'])) {
        if((isset($_FILES['file']) && is_array( $_FILES['file']))) {
        $csv = $_FILES['file'];
            if(isset($csv['tmp_name']) && !empty($csv['tmp_name'])) {

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $csv['tmp_name']);
            finfo_close($finfo);

            $allowed_mime = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

            if(in_array($mime, $allowed_mime) && is_uploaded_file($csv['tmp_name'])) {

                $f = fopen($csv['tmp_name'], 'r');

                fgetcsv($f);

                $data = array();

                $ctr=0;

                while($row = fgetcsv($f)) {

                    $uc_Date = trim($row[0]);
                    $uc_Time = trim($row[1]);
                    $uc_UserID = trim($row[2]);
                    $uc_Addres = trim($row[3]);
                    $uc_Addres = substr("$uc_Addres", -5);

                    $ctr++;

                    // test array values
                    // array_push($data, array($uc_Date, $uc_Time, $uc_UserID));

                    // verify if not exists and insert
                    if($uc_Addres!="") {

                        // compose date & time
                        $uc_DateTime = $uc_Date." ".$uc_Time;
                        $uc_DateTime = date("Y-m-d H:i:s", strtotime($uc_DateTime));
                        // $uc_DateTime = $uc_DateTime->format("Y-m-d H:i:s");

                        // verify if in(<3PM) or out (>=3PM)
// 20220104 modified timeout to 2PM
//                        if($uc_Time >= "15:00:00") {
                        if($uc_Time >= "14:00:00") {
                        $uc_CheckType="o";
                        } else {
                        $uc_CheckType="I";
                        } // if-else

                        // set 0 or blank other fields
                        $uc_VerifyCode=0;
                        $uc_SensorID="";
                        $uc_MemoInfo="";
                        $uc_WorkCode=0;
                        $uc_sn="";
                        $uc_UserExtFmt=0;

                        // query Addres, userID from tblhrattuserinfo
                        $res11query=""; $result11=""; $found11=0;
                        $res11query="SELECT `hrattuserinfoid`, `att_userid`, `employeeid`, `fk_uc_ID` FROM `tblhrattuserinfo` WHERE `fk_uc_Addres`=\"$uc_Addres\" AND `fk_uc_UserID`=\"$uc_UserID\" LIMIT 1";
                        $result11=$dbh2->query($res11query);
                        if($result11->num_rows>0) {
                            while($myrow11=$result11->fetch_assoc()) {
                            $found11=1;
                            $hrattuserinfoid11 = $myrow11['hrattuserinfoid'];
                            $att_userid11 = $myrow11['att_userid'];
                            $employeeid11 = $myrow11['employeeid'];
                            $fk_uc_ID11 = $myrow11['fk_uc_ID'];
                            } //while
                        } //if

                        if($found11==1) {

                            // check if exists, else insert record
                            $res12query=""; $result12=""; $found12=0; $ctr12=0;
                            $res12query="SELECT hrattcheckinoutid FROM tblhrattcheckinout WHERE att_checktime=CAST(\"$uc_DateTime\" AS DATETIME) AND att_userid=\"$att_userid11\"";
                            $result12=$dbh2->query($res12query);
                            if($result12->num_rows>0) {
                            while($myrow12=$result12->fetch_assoc()) {
                                $found12=1;
                                $ctr12++;
                                $hrattcheckinoutid12 = $myrow12['hrattcheckinoutid'];
                            } //while
                            } //if
// echo "r12q: $res12query<br>";
                            if($found12==1) {

                            // info msg: record exists, skip
                            echo $ctr." ".$uc_DateTime." for Addres:".$uc_Addres." with EmpID:".$employeeid11." record exists -> skipped.<br>";

                            } else {

                            // insert query
                            $res14query=""; $result14=""; $found14=0;
                            $res14query="INSERT INTO tblhrattcheckinout SET timestamp=\"$now\", loginid=$loginid, att_userid=\"$att_userid11\", att_checktime=\"$uc_DateTime\", att_checktype=\"$uc_CheckType\", att_verifycode=$uc_VerifyCode, att_sensorid=\"$uc_SensorID\", att_memoinfo=\"$uc_MemoInfo\", att_workcode=$uc_WorkCode, att_sn=\"$uc_sn\", att_userextfmt=$uc_UserExtFmt";
                            $result14=$dbh2->query($res14query);

                                // insert logs
                                $adminlogdetails = "$loginid:$username - New time log from door attendance cutoff inserted in tblhrattcheckinout $uc_DateTime, $uc_CheckType, $uc_UserID, $uc_Addres for EmpID: $employeeid11";
                                $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$username\", adminlogdetails=\"$adminlogdetails\"";
                                $result17=$dbh2->query($res17query);
echo $ctr." ".$uc_DateTime." for Addres:".$uc_Addres." with EmpID:".$employeeid11." -> <font color='green'>record inserted.</font><br>";

// echo "r14q: $res14query<br><br>";
// echo "r17q: $res17query<br>";

                            } //if-else

                        } else {

                            // info msg: no record found, skip
                            echo $ctr." ".$uc_Date."T".$uc_Time." for Addres:".$uc_Addres." with EmpID:<font color='red'><strong>".$uc_UserID."</strong> -> No enrolled user. Pls re-sync userid first. -> skipped.<br>$res11query</font><br>";
                            // echo "<br>f11:$found11, r11q: $res11query<br><br>";
                    
                        } //if-else
// echo "f11:$found11 | r11q: $res11query<br>r12q: $res12query<br><br>";
                    } else {

                        // info msg: record exists, skip
                        echo $ctr." ".$uc_Date."T".$uc_Time."<font color='red'> -> No uc_Addres -> skipped.</font><br>";

                    } //if-else

                    // reset vars
                    $employeeid11=""; $uc_Date=""; $uc_Time=""; $uc_Addres="";

                } //while($row = fgetcsv($f))

echo ">>> end of file.<<<"."<br>";

echo "<p><a href='mnghrofctimelogsync.php?loginid=$loginid' class='btn btn-default' role='button'>back</a></p>";

                fclose($f);
                // echo '<pre>';
                // var_dump($data);
                // echo '<pre>';
                die;
            } //if(in_array($mime, $allowed_mime) && is_uploaded_file($csv['tmp_name']))
            } //if(isset($csv['tmp_name']) && !empty($csv['tmp_name']))
        } //if((isset($_FILES['file']) && is_array( $_FILES['file'])))

    //
    //
    } else { //if(isset($_POST['import']))

    } //if(isset($_POST['import']))

} //if($accesslevel >= 4)

// end contents here...

// edit body-footer
     echo "<p><a href=\"mnghrmod.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a></p>";

    $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 