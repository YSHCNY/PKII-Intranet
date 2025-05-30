<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$companytype = (isset($_POST['companytype'])) ? $_POST['companytype'] :'';
$orderby = (isset($_POST['orderby'])) ? $_POST['orderby'] :'';
$orderdirection = (isset($_POST['orderdirection'])) ? $_POST['orderdirection'] :'';

// set display type
// 0:directory (read only)
// 1:manage (crud)
$dirbizdisp = 1;

// for all contact persons list selection only
if($companytype=='all') {
$orderby = 'tblcontact.name_first';
} // if

// for other types but oder is tblcontact.name_first
if($companytype!='all' && $orderby=='tblcontact.name_first') {
$orderby = 'tblcompany.company';
} // if

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");
?>
	<p><font size="1">Manage >> Business Contacts</font></p>

	<table class="table">
	<thead><tr><th colspan="2">PKII Business Directory</th></tr></thead>
	<tbody>
	<!-- display manage menu buttons -->
	<tr><td colspan="2">
<?php
	echo "<p>vartest comptyp:$companytype, ordr:$orderby, directn:$orderdirection, dirbizdisp:$dirbizdisp</p>";
?>
		<table class="table">
		<tr>
<?php
	echo "<form action=\"businessadd.php?loginid=$loginid\" method=\"POST\" name=\"businessadd\">";
?>
			<td>
<?php
	echo "<button type=\"submit\" class=\"btn btn-primary\">Add new company</button>";
?>
			</td>
<?php
	echo "</form>";
	echo "<form action=\"businesspersadd.php?loginid=$loginid\" method=\"POST\" name=\"businesspersadd\">";
?>
			<td>
<?php
	echo "<button type=\"submit\" class=\"btn btn-primary\">Add new contact person</button>";
?>
			</td>
<?php
	echo "</form>";
?>
		</tr>
		</table>
	</td></tr>
	<!-- display menu dropdowns -->
	<tr><td colspan="2">
		<?php include './dirbizmnu.php' ?>
	</td></tr>
	<!-- display list result -->
	<tr><td colspan="2">
		<?php include './dirbizlist.php'; ?>
	</td></tr>
	</tbody>
	</table>

<?php
/*     echo "<tr><td><form action=businessedit.php?loginid=$loginid method=POST>";
     echo "<input type=submit value=\"List companies\"></form></td>";
     echo "<td><form action=businesspers.php?loginid=$loginid method=POST>";
     echo "<input type=submit value=\"List contact person\"></form></td>"; */

     echo "<p><a href=\"index2.php?loginid=$loginid\" class='btn btn-default' role='button'>Back</a><br>";
   
     $resuery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result=$dbh2->query($resquery); 
  
     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?> 
