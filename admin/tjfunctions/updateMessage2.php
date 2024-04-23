<?php 
$loginid= (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$action = (isset($_POST['id'])) ? $_POST['id'] :'';
$message = (isset($_POST['message'])) ? $_POST['message'] :'';
$fullname = (isset($_POST['fullname'])) ? $_POST['fullname'] :'';

include("../db1.php");

// query tblhrtaotreq
$res11query=""; $result11=""; $found11=0;
$res11query="SELECT comments FROM tblhrtalvreq WHERE idhrtalvreq=$action LIMIT 1";
$result11=$dbh2->query($res11query);
if($result11->num_rows>0) {
  while($myrow11=$result11->fetch_assoc()) {
  $found11=1;
  $comments11=$myrow11['comments'];
  } // while
} // if

if($found11==1) {
  // prep message
  $messageDivHtml = "$comments11";
  // $newMessageDivHtml = "<html>";
  $newMessageDivHtml = "<div class=\"messageItem\">";
  $newMessageDivHtml .= "<div class=\"messageFirstRow\">";
  $newMessageDivHtml .= "<div class=\"col-md-8\">";
  $newMessageDivHtml .= "<h6>$fullname</h6>";
  $newMessageDivHtml .= "</div>";
  $newMessageDivHtml .= "<div class=\"col-md-4\">";
  $newMessageDivHtml .= "<span>".date("Y-M-d H:i:s", strtotime($now))."</span>";
  $newMessageDivHtml .= "</div>";
  $newMessageDivHtml .= "</div>";
  $newMessageDivHtml .= "<div class=\"messageSecondRow\">";
  $newMessageDivHtml .= "<div class=\"col-md-12\">";
  $newMessageDivHtml .= "<p>$message</p>";
  $newMessageDivHtml .= "</div>";
  $newMessageDivHtml .= "<div style=\"clear:both;\"></div>";
  $newMessageDivHtml .= "</div>";
  $newMessageDivHtml .= "</div>";
  // $newMessageDivHtml .= "</html>";

  $allMessage = "$newMessageDivHtml" . "$messageDivHtml";

} // if

$resquery="UPDATE tblhrtalvreq SET comments=\"".addslashes($allMessage)."\" WHERE idhrtalvreq=$action";
$result=$dbh2->query($resquery);
$dbh2->close();

// include("../../admin/db1.php");
// $result = mysql_query("UPDATE tblhrtalvreq SET comments = '".$message."' WHERE idhrtalvreq = ".$action, $dbh);
// mysql_close($dbh);

// include("../../admin/db1.php");
// $resquery = "UPDATE tblhrtalvreq SET comments=\"$message\" WHERE idhrtalvreq=$action";
// $result = mysql_query("$resquery", $dbh);
// $result=$dbh2->query($resquery);
// mysql_close($dbh);
// $dbh2->close();

// echo "<p>rslt:$result,f11:$found11,id:$action<br>res11:$res11query<br>resqry:$resquery<br>$allMessage</p>";
// include("../../admin/db1.php");
// $result = mysql_query("UPDATE tblhrtaotreq SET comments = '".$message."' WHERE idhrtaotreq = ".$action, $dbh);
// mysql_close($dbh);

// redirect
header("Location: ../mnglvreqdtl.php?loginid=$loginid&lvid=$action");
die();
?>
