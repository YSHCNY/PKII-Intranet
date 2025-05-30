<?php
//
// mitsuppreqcomments.php
// fr: vc/index.php
// indexlinks: $page==342x

require '../includes/config.inc';

$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';

$iditsupportreq = (isset($_POST['idsr'])) ? $_POST['idsr'] :'';
$actor = (isset($_POST['ctgactor'])) ? $_POST['ctgactor'] :'';
$comments = (isset($_POST['comments'])) ? $_POST['comments'] :'';

if($iditsupportreq!='') {

	// query tblsupportreq
	include '../m/qrymitsuppreq5.php';
	// query actor
	include '../m/qrymitsuppreq11.php';
	// compose comments post and queried comments
	$commentsfin = $name_last21 . ", " . $name_first21 . " on $now:\r\n" . $comments . "\r\n\r\n" . $comments16;

	// update query
	include '../m/qrymitsuppreq12.php';
	// insert log
	$logdetails = "IT support request comment submitted by $employeeid21 - $name_last21, $name_first21 as $actor with id:$iditsupportreq";
	include '../m/qryinslog.php';

} // if

// redirect
header("Location: index.php?lst=$lst&lid=$loginid&sess=$session&p=$page&srid=$iditsupportreq");
exit;
	// echo "<p>lst:$lst,lid:$loginid,sess:$session,pg:$page,idsr:$iditsupportreq,actor:$actor,cmnt:$comments<br>";
	// echo "<a href=\"index.php?lst=$lst&lid=$loginid&sess=$session&p=$page&srid=$iditsupportreq\">back</a></p>";
?>
