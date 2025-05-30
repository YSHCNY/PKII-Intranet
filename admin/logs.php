<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$found = 0;

if($loginid != "")
{
    include("logincheck.php");
}

if ($found == 1)
{
    include ("header.php");
    include ("sidebar.php");

    ?>
<div class=" border rounded-3 p-4">
  <p>Activity Log</p>
<?php



    $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE login_id=$loginid", $dbh); 

  


  

    echo "<a href=\"lognotifier.php?loginid=$loginid\" class='px-3 py-2 border-0 rounded-3 mainbtnclr text-decoration-none text-white'>Notifier Files</a>";
    echo "<a href=\"logping.php?loginid=$loginid\" class='px-3 py-2 border-0 rounded-3 mainbtnclr text-decoration-none text-white'>Network devices ping logs</a>";
    


   

   ?>
</div>
   <?php

    $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminloginid=$loginid", $dbh); 
  

}
else
{
    include ("logindeny.php");
}

mysql_close($dbh);

?> 
