<?php
require_once 'db1.php';

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idofimg = (isset($_GET['imgid'])) ? $_GET['imgid'] :'';
$use = (isset($_GET['useid'])) ? $_GET['useid'] :'';
$currimg = (isset($_GET['idcur'])) ? $_GET['idcur'] :'';
$remid = (isset($_GET['remid'])) ? $_GET['remid'] :'';




// echo "$loginid, $idofimg, $use, $currimg";

$useflag = 1;
$disableflag = 0;

if ($use == 'usenotdel'){
    // user image
    $sql = "UPDATE logimg SET activeimg = $useflag WHERE id = $idofimg";
    if( $executesql = $dbh2->query($sql) == TRUE){

        header('location: index2.php?loginid='.$loginid.'');
        $message = "Changed Successfully";
        $_SESSION['success_message'] = $message;
    } else {
        echo "error change";
    }

    // disable current displayed image
    $sql2 = "UPDATE logimg SET activeimg = $disableflag WHERE id = $currimg";
    if( $executesql2 = $dbh2->query($sql2) == TRUE){

        header('location: index2.php?loginid='.$loginid.'');
        $message = "Changed Successfully";
        $_SESSION['success_message'] = $message;

        

    } else {
        $message = "Change Error";
        $_SESSION['error_message'] = $message;
        echo "error change";
    }

    
} 


if ($remid == 'removecurrimg'){
    $sql3 = "UPDATE logimg SET activeimg = $disableflag WHERE id = $currimg";
    if( $executesql3 = $dbh2->query($sql3) == TRUE){
        header('location: index2.php?loginid='.$loginid.'');
        $message = "Changed Successfully";
        $_SESSION['success_message'] = $message;


    } else {
        $message = "Change Error";
        $_SESSION['error_message'] = $message;
        echo "error change";

    }
}
?>