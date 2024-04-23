<?php

include("db1.php");

$loginid = isset($_GET['loginid']) ? $_GET['loginid'] : '';

$found = 0;

if ($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {

    $idhrtalvreq = isset($_GET['idhrtalvreq']) ? $_GET['idhrtalvreq'] : '';
    $idhrtaleavectg = isset($_GET['idhrtaleavectg']) ? $_GET['idhrtaleavectg'] : '';

    // Execute the first SQL query to delete from tblhrtalvreq
    $sql1 = "DELETE FROM tblhrtalvreq WHERE idhrtalvreq = '$idhrtalvreq'";
    if ($dbh2->query($sql1) === TRUE) {
        echo "Record deleted successfully from tblhrtalvreq";
    } else {
        echo "Error deleting record from tblhrtalvreq: " . $dbh2->error;
    }

    // Execute the second SQL query to delete from tblhrtaleavectg
    $sql2 = "DELETE FROM tblhrtaleavectg WHERE idhrtaleavectg = '$idhrtaleavectg'";
    if ($dbh2->query($sql2) === TRUE) {
        echo "Record deleted successfully from tblhrtaleavectg";
    } else {
        echo "Error deleting record from tblhrtaleavectg: " . $dbh2->error;
    }

    // Redirect back to hrtimeattcutleave.php
    header("Location: hrtimeattcutleave.php?loginid=$loginid");
    exit(); // Ensure that script stops executing after redirection
} else {
    include("logindeny.php");
}
?>
