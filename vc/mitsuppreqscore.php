<?php
//
// mitsuppreqscore.php
// fr: vc/index.php
// indexlinks: $page==342x

require '../includes/config.inc';

$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';

$iditsupportreq = (isset($_POST['idsr'])) ? $_POST['idsr'] :'';
$actor = (isset($_POST['ctgactor'])) ? $_POST['ctgactor'] :'';
$scoreval = (isset($_POST['scoreval'])) ? $_POST['scoreval'] :'';
$scoreremarks = (isset($_POST['scoreremarks'])) ? $_POST['scoreremarks'] :'';

if($iditsupportreq!='' && ($scoreval!='' || $scoreval!=0)) {

	// insert query
	include '../m/qrymitsuppreq15.php';
	// query actor
	include '../m/qrymitsuppreq11.php';

	// insert log
	$logdetails = "IT support request SCORE of $scoreval submitted by $employeeid21 - $name_last21, $name_first21 as $actor with id:$iditsupportreq";
	include '../m/qryinslog.php';

} // if

// redirect
session_start();
$_SESSION['ratescore'] = true;
header("Location: index.php?lst=$lst&lid=$loginid&sess=$session&p=$page&srid=$iditsupportreq");
exit;
?>
