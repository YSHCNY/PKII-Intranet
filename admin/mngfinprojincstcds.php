<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$ver = (isset($_POST['ver'])) ? $_POST['ver'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
  echo "<p><font size=1>Manage >> Accounting Modules >> Proj Income Statement codes</font></p>";

// start contents here...

// query acct code default version
if($ver == '') {
	$res10query="SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"";
	$result10=""; $found10=0; $ctr10=0;
	$result10=$dbh2->query($res10query);
	if($result10->num_rows>0) {
		while($myrow10=$result10->fetch_assoc()) {
		$found10=1;
    $version10 = $myrow10['version'];		
		} // while
	} // if
  $ver = $version10;
}
?>

	<table class="table table-striped">
	<thead>
		<tr><th colspan="8">Project Income Statement Account Codes</th></tr>
	</thead>
	<tbody>
		<tr><td>
<?php
		echo "<form action=\"mngfinprojincstdcdsadd.php?loginid=$loginid\" method=\"POST\" name=\"mngfinprojincstdcdsadd\">";

		echo "</form>";
?>
		</td></tr>
	</tbody>
	</table>

<?php
// end contents here...

// edit body-footer
     echo "<p><a href=\"mngfinmods.php?loginid=$loginid\">Back</a></p>";

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result=$dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}
// mysql_close($dbh);
$dbh2->close();
?> 
