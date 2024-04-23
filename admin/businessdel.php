<?php 

include("db1.php");

$loginid = (isset($_POST['loginid'])) ? $_POST['loginid'] :'';
$companyid = (isset($_POST['pid'])) ? $_POST['pid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><th colspan=\"2\" align=\"center\">Manage Business Contact - Delete</th></tr>";

    $res11query=""; $result11=""; $found11=0;
	$res11query="SELECT companyid, company, branch, supplierid FROM tblcompany WHERE companyid=$companyid";
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
      $companyid11 = $myrow11['companyid'];
      $company11 = $myrow11['company'];
      $branch11 = $myrow11['branch'];
	  $supplierid11 = $myrow11['supplierid'];
	  if($company11=='') { $company11=$supplierid11; }
		} //while
	} //if

  echo "<tr><td colspan=\"2\" align=\"center\"><font color=\"red\"><b>Deleting company: <b>$companyid11 - $company11 - $branch11</b></td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><h3>Are you sure?</h3></font></td></tr>";
  echo "<tr><td align=\"center\"><form method=\"post\" action=\"businessdel2.php?loginid=$loginid&cid=$companyid\">";
  echo "<input type='hidden' name='loginid' value='$loginid'>";
  echo "<input type='hidden' name='cid' value='$cid'>";
  echo "<input type=\"submit\" value=\"Yes\"></form></td>";
  echo "<td align=\"center\"><form method=\"post\" action=\"businessedit.php?loginid=$loginid\">";
  echo "<input type=\"submit\" value=\"No\"></form></td></tr>";
  echo "</table>";

  $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
  $result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 

