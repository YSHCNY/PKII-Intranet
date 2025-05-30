<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$loginid0 = $_GET['stdlid'];
$username0 = $_GET['stduid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header2.php");
  


echo "<div class=' text-center bg-danger p-5 my-5 mx-auto'>";
echo "<h5 class=''>Manage Standard Users - Delete</h5>";
echo "
<div>
<h1 class='text-white'><strong>Deleting user: $username0</strong></h1>";
echo "   <p class = 'text-white fs-2'><i>Warning! This cant be undone.</i></p>
</div>";

echo "<h3 class='text-white'>Are you sure?</h3>";

echo "<div class='d-flex justify-content-center'>";
echo "<a href='mngstduserdel2.php?loginid=$loginid&stdlid=$loginid0&stduid=$username0' class='text-white border rounded-3 border-white bg-danger btn btn-lg mx-2'>Yes</a>";
echo "<a href='mngstdusers.php?loginid=$loginid' class='text-danger border rounded-3 border-white bg-white btn btn-lg mx-2'>No</a>";
echo "</div>";

echo "</div>";



  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

