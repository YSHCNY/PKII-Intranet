<?php
session_start();
include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];



$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{

if (isset($_GET['idpgbtn'])) {
    $idpgname = $_GET['idpgname'];
    $idpg = $_GET['idpg'];
        $sql = mysql_query("DELETE FROM tblhrtapaygrp WHERE idtblhrtapaygrp = $idpg", $dbh); 
        header("Location: hrtimeattpaygrp.php?loginid=$loginid");
    
        $message = " Paygroup <b>$idpgname</b> has been <b>REMOVED</b> to the system.";
        $_SESSION['deleted'] = $message;

        exit;
    // Close the database connection
   
} else {
    echo "No ID provided for deletion.";
}
}



else{
     include ("logindeny.php");
}

?>
