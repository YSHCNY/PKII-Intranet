<?php 

require('./db1.php');
// require('./db2.php');

include './datetimenow.php';

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
// $startsw = $_POST['startsw'];

$import = (isset($_POST['import'])) ? $_POST['import'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Manage >> HR Modules >> Sync e-door userid to EmployeeID</font></p>";

// start contents here...
if($accesslevel >= 4) {
/*		echo "<p><form action=\"mnghruseridsync.php?loginid=$loginid\" method=\"post\"><input type=\"hidden\" name=\"startsw\" value=\"1\"><input type=submit value=\"Press to start\"></form></p>";

		if($startsw == 1) {
		echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><th></th><th colspan=\"5\">att2000<th>vs</th><th colspan=\"9\">maindb</th><th>status</th></tr>";
		echo "<tr><th>ctr</th><th>userid</th><th>badgenum</th><th>name</th><th>sex</th><th>title</th><th></th><th>id</th><th>timestamp</th><th>loginid</th><th>userid</th><th>badgenum</th><th>name</th><th>title</th><th>gender</th><th>empid</th><th>status</th></tr>";

		$result15=""; $found15=0;
		$result15 = mysql_query("SELECT USERID, Badgenumber, Name, Gender, TITLE FROM USERINFO WHERE USERID<>'' ORDER BY USERID ASC", $dbh2b);
		if($result15 != "") {
			while($myrow15 = mysql_fetch_row($result15)) {
			$found15 = 1;
			$USERID15 = $myrow15[0];
			$Badgenumber15 = $myrow15[1];
			$Name15 = $myrow15[2];
			$Gender15 = $myrow15[3];
			$TITLE15 = $myrow15[4];

			$ctr15 = $ctr15 + 1;

			echo "<tr><td>$ctr15</td><td>$USERID15</td><td>$Badgenumber15</td><td>$Name15</td><td>$Gender15</td><td>$TITLE15</td><td></td>";

			$result16=""; $found16=0;
			$result16 = mysql_query("SELECT hrattuserinfoid, timestamp, loginid, att_userid, att_badgenumber, att_name, att_title, att_gender, employeeid FROM tblhrattuserinfo WHERE att_userid=$USERID15 AND att_badgenumber=\"$Badgenumber15\"", $dbh);
			if($result16 != "") {
				while($myrow16 = mysql_fetch_row($result16)) {
				$found16 = 1;
				$hrattuserinfoid16 = $myrow16[0];
				$timestamp16 = $myrow16[1];
				$loginid16 = $myrow16[2];
				$att_userid16 = $myrow16[3];
				$att_badgenumber16 = $myrow16[4];
				$att_name16 = $myrow16[5];
				$att_title16 = $myrow16[6];
				$att_gender16 = $myrow16[7];
				$employeeid16 = $myrow16[8];
				}
			}

			if($found16 == 1) {
				echo "<td>$hrattuserinfoid16</td><td>$timestamp16</td><td>$loginid16</td>";
				echo "<td>$att_userid16</td><td>$att_badgenumber16</td><td>$att_name16</td><td>$att_title16</td><td>$att_gender16</td>";
				echo "<td>$employeeid16</td>";
				echo "<td>record exists</td>";
			} else if($found16 == 0) {
				$result17 = mysql_query("INSERT INTO tblhrattuserinfo SET timestamp=\"$now\", loginid=$loginid, att_userid=$USERID15, att_badgenumber=\"$Badgenumber15\", att_name=\"$Name15\", att_title=\"$TITLE15\", att_gender=\"$Gender15\"", $dbh);
				echo "<td colspan=\"9\"></td><td><font color=\"green\">inserted</font></td>";
			}
			echo "</tr>";
			}
		}

		echo "</table>";
		}
*/
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

                while($row = fgetcsv($f)) {

                    $uc_Addres = trim($row[0]);
                    $uc_CardNum = trim($row[1]);
                    $uc_Name = trim($row[2]);
                    $uc_PIN = trim($row[3]);
                    $uc_Dep = trim($row[4]);
                    $uc_Group = trim($row[5]);
                    $uc_Zone = trim($row[6]);
                    $uc_UserID = trim($row[7]);
                    $uc_CarNum = trim($row[8]);
                    $uc_Level = trim($row[9]);
                    $uc_Begin = trim($row[10]);
                    $uc_Expiry = trim($row[11]);
                    $uc_Alias = trim($row[12]);
                    $uc_VISAID = trim($row[13]);
                    $uc_Address = trim($row[14]);
                    $uc_TEL1 = trim($row[15]);

                    // test array values
                    // array_push($data, array($uc_Addres, $uc_CardNum, $uc_Name, $uc_PIN, $uc_Dep, $uc_Group, $uc_Zone, $uc_UserID, $uc_CarNum, $uc_Level, $uc_Begin, $uc_Expiry, $uc_Alias, $uc_VISAID, $uc_Address, $uc_TEL1));

                    // verify if not exists and insert
                    if($uc_Name!="" && $uc_UserID!="") {

                        // query tblhr701usrcrd if exists
                        $res11query=""; $result11=""; $found11=0;
                        $res11query="SELECT idhr701usrcrd FROM tblhr701usrcrd WHERE uc_Name=\"$uc_Name\" AND uc_UserID=\"$uc_UserID\" LIMIT 1";
                        $result11=$dbh2->query($res11query);
                        if($result11->num_rows>0) {
                            while($myrow11=$result11->fetch_assoc()) {
                            $found11=1;
                            $idhr701usrcrd11 = $myrow11['idhr701usrcrd'];
                            } //while
                        } //if

                        if($found11==1) {
                            // info msg: record exists
                            echo "$idhr701usrcrd11:$uc_Name:$uc_UserID->record exists->skipped.<br>";
                        } else {
                            // insert record
                            $res12query=""; $result12=""; $found12=0;
                            $res12query="INSERT INTO tblhr701usrcrd SET timestamp=\"$now\", loginid=$loginid, uc_Addres=\"$uc_Addres\", uc_CardNum=\"$uc_CardNum\", uc_Name=\"$uc_Name\", uc_PIN=\"$uc_PIN\", uc_Dep=\"$uc_Dep\", uc_Group=\"$uc_Group\", uc_Zone=\"$uc_Zone\", uc_UserID=\"$uc_UserID\", uc_CarNum=\"$uc_CarNum\", uc_Level=\"$uc_Level\", uc_Begin=\"$uc_Begin\", uc_Expiry=\"$uc_Expiry\", uc_Alias=\"$uc_Alias\", uc_VISAID=\"$uc_VISAID\", uc_Address=\"$uc_Address\", uc_TEL1=\"$uc_TEL1\"";
                            $result12=$dbh2->query($res12query);

                            if($result12!="") {
                                echo "$uc_Name:$uc_UserID:$uc_Alias-><font color='green'>New record inserted.</font><br>";
                                // insert logs
                                $adminlogdetails = "$loginid:$username - New record from usercard inserted on tblhr701usrcrd $uc_Name:$uc_UserID:$uc_Alias";
                                $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$username\", adminlogdetails=\"$adminlogdetails\"";
                                $result17=$dbh2->query($res17query);
                            } //if
                            // echo "r12q: $res12query<br>";

                        } //if-else
// echo "f11:$found11 | r11q: $res11query<br>r12q: $res12query<br><br>";
                    } //if

                } //while($row = fgetcsv($f))

echo ">>> end of file.<<<"."<br>";

                fclose($f);
echo "<p><a href='mnghruseridsync.php?loginid=$loginid' class='btn btn-default' role='button'>back</a></p>";
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
    //
    //
    // display user list with matching dropdown of employeeid
    echo "<table class='table-striped table-bordered'>";
    echo "<tr><th>Ctr</th><th>Addres</th><th>Name</th><th>Alias</th><th>Zone</th><th>UserID</th><th>vs.</th><th>Masterlist</th><th colspan='2'>Action</th></tr>";
    $res14query=""; $result14=""; $found14=0; $ctr14=0;
    $res14query="SELECT idhr701usrcrd, uc_Addres, uc_CardNum, uc_Name, uc_PIN, uc_Dep, uc_Group, uc_Zone, uc_UserID, uc_CarNum, uc_Level, uc_Begin, uc_Expiry, uc_Alias, uc_VISAID, uc_Address, uc_TEL1, fk_employeeid, fk_contactid FROM tblhr701usrcrd WHERE uc_UserID<>'' OR uc_UserID<>0 ORDER BY uc_UserID DESC";
    $result14=$dbh2->query($res14query);
    if($result14->num_rows>0) {
        while($myrow14=$result14->fetch_assoc()) {
        $found14=1;
        $ctr14++;
        $idhr701usrcrd14 = $myrow14['idhr701usrcrd'];
        $uc_Addres14 = $myrow14['uc_Addres'];
        $uc_CardNum14 = $myrow14['uc_CardNum'];
        $uc_Name14 = $myrow14['uc_Name'];
        $uc_PIN14 = $myrow14['uc_PIN'];
        $uc_Dep14 = $myrow14['uc_Dep'];
        $uc_Group14 = $myrow14['uc_Group'];
        $uc_Zone14 = $myrow14['uc_Zone'];
        $uc_UserID14 = $myrow14['uc_UserID'];
        $uc_CarNum14 = $myrow14['uc_CarNum'];
        $uc_Level14 = $myrow14['uc_Level'];
        $uc_Begin14 = $myrow14['uc_Begin'];
        $uc_Expiry14 = $myrow14['uc_Expiry'];
        $uc_Alias14 = $myrow14['uc_Alias'];
        $uc_VISAID14 = $myrow14['uc_VISAID'];
        $uc_Address14 = $myrow14['uc_Address'];
        $uc_TEL114 = $myrow14['uc_TEL1'];
        $fk_employeeid14 = $myrow14['fk_employeeid'];
        $fk_contactid14 = $myrow14['fk_contactid'];
        echo "<tr><td>$ctr14</td><td>$uc_Addres14</td><td><strong>$uc_Name14</strong></td><td>$uc_Alias14</td><td>$uc_Zone14</td><td><strong>$uc_UserID14</strong></td><td>vs.</td>";

        echo "<form action=\"mnghruseridsyncupd.php?loginid=$loginid\" method=\"POST\" name=\"mnghruseridsyncupd\">";
        echo "<input type=\"hidden\" name=\"id\" value=\"$idhr701usrcrd14\">";
        echo "<td><select class='form-group' name='cID'>";
        if($fk_contactid14==0 && $fk_employeeid14=="") {
            echo "<option value='' selected>choose EmpID</option>";
        } //if
            $res15query=""; $result15=""; $found15=0; $ctr15=0; $empidsel="";
            $res15query="SELECT tblemployee.employeeid, tblcontact.contactid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblemployee LEFT JOIN tblcontact ON tblcontact.employeeid=tblemployee.employeeid WHERE (tblemployee.employee_type=\"employee\" OR tblemployee.employee_type=\"consultant\") AND tblemployee.emp_record=\"active\" AND tblcontact.contact_type=\"personnel\" ORDER BY tblcontact.name_last ASC, tblcontact.name_first ASC";
            $result15=$dbh2->query($res15query);
            if($result15->num_rows>0) {
            while($myrow15=$result15->fetch_assoc()) {
            $found15=1;
            $employeeid15 = $myrow15['employeeid'];
            $contactid15 = $myrow15['contactid'];
            $name_last15 = $myrow15['name_last'];
            $name_first15 = $myrow15['name_first'];
            $name_middle15 = $myrow15['name_middle'];
            if($fk_employeeid14==$employeeid15) { $empidsel="selected"; } else { $empidsel=""; } //if-else
            echo "<option value=\"$contactid15\" $empidsel>$employeeid15 - $name_last15, $name_first15 $name_middle15[0]</option>";
            } //while
            } //if
        echo "</select></td>";
        echo "<td><button type=\"submit\" class=\"btn btn-success btn-sm\">Update</button></td>";
        echo "</form>";

        echo "<form action=\"mnghruseridsyncdel.php?loginid=$loginid\" method=\"POST\" name=\"mnghruseridsyncdel\">";
        echo "<input type=\"hidden\" name=\"id\" value=\"$idhr701usrcrd14\">";
        echo "<td><button type=\"submit\" class=\"btn btn-danger btn-sm\">Del</button></td>";
        echo "</form>";

        echo "</tr>";


        } //while
    } //if
    echo "</table>";

    } //if(isset($_POST['import']))

/*
    echo "<table class='fin'>";

    echo "</table>";
*/

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
// mysql_close($dbh2b);
?> 
