<?php 
// sesison
session_start();
include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$username0 = trim($_POST['username']);
$password10 = trim($_POST['password1']);
$password20 = trim($_POST['password2']);
$employeeid00 = trim($_POST['employeeid']);

$defaultpath = "/var/www/pkii/transfers/";

$found = 0;
$found11 = 0;

// echo "vartest username:$username0<br>password1:$password10<br>password2:$password20<br>empID:$employeeid0<br>";

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

  if($accesslevel >= 4 && $accesslevel <= 5)
  {


// check passwords
    if($username0 != '' && $password10 != '' && $password20 != '' && $password10 == $password20 && $employeeid00 != '')
    {
      $result11 = mysql_query("SELECT username FROM tbllogin WHERE username = \"$username0\"", $dbh);
      if($result11 != '')
      {
	while($myrow11 = mysql_fetch_row($result11))
	{
	  $found11 = 1;
	  $username11 = $myrow11[0];
	}
	if($found11 == 1)
	{
		$message = "Sorry, username already on database. Please try again.";
		$_SESSION['message'] = $message;
	}
	else
	{
	  $result12 = mysql_query("SELECT employeeid FROM tbllogin WHERE employeeid = \"$employeeid00\"", $dbh);
	  while($myrow12 = mysql_fetch_row($result12))
	  {
	    $found12 = 1;
	    $employeeid12 = $myrow12[0];
	  }
	  if($found12 == 1)
	  {
	    $result13 = mysql_query("SELECT username FROM tbllogin WHERE employeeid=\"$employeeid12\"", $dbh);
	    while($myrow13 = mysql_fetch_row($result13))
	    {
	      $found13 = 1;
	      $username13 = $myrow13[0];
	    }
	    // echo "<tr><td colspan=\"2\"><font color=\"red\">Sorry, personnel selected already has a login name: <b>$username13</b>. Please try again.</font></td></tr>";

		$message = "ERROR Adding User, Sorry, personnel selected already has a login name: $username13. Please try again.";
		$_SESSION['message'] = $message;
	  }
	  else
	  {
	    $message = "New user: <b>$username0</b> saved. <i>$datenow</i>";
		$_SESSION['success'] = $message;

	    // insert new user into tbladminlogin
	    $result14 = mysql_query("INSERT INTO tbllogin SET username=\"$username0\", password=md5('$password10'), date_created=\"$datenow\", employeeid=\"$employeeid00\"", $dbh);

	    // echo "<tr><td>details</td><td>";
	    // echo "$username0<br>$datenow<br>$employeeid00</td></tr>";

	    // create user directory
//	    $return_val = mkdir( "./transfers/$username0/", "755" );
	    echo "<tr><td>folder status</td>";
	    $output1 = shell_exec('mkdir '.$defaultpath.$username0.'/');
	    $output2 = shell_exec('chmod 777 '.$defaultpath.$username0.'/');
	    echo "<pre>$output1</pre>";
	    echo "<pre>$output2</pre>";
//	    echo ( $return_val ? "<td>$username0 folder created</td>" : "<td><font color=\"red\">not created</font></td>" );
	    echo "</tr>";

	    // create log
	    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
	    while($myrow16 = mysql_fetch_row($result16))
	    { $adminuid16=$myrow16[0]; }
	    $adminlogdetails = "$loginid:$adminloginuid - Add new standard user:$username0 for employeeid:$employeeid00";
	    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid16\", adminlogdetails=\"$adminlogdetails\"", $dbh);
	  }
	}
      }
    }
    else
    {
		$message = "ERROR Adding User, Sorry, passwords do not match and/or fields should not be blank. Please try again";
		$_SESSION['message'] = $message;
    }
	echo '<script>';
echo 'window.location.href = "mngstdusers.php?loginid=' . $loginid . '";';
echo '</script>';
	exit; 
  }

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
