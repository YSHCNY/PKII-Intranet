<?php
//
// 20191119
// projrptincst.php 
// fr projectreports menu#8
//
  if($pisdatefr0=='') { $pisdatefr=$datenow; }
  if($pisdateto0=='') { $pisdateto=$datenow; }
  echo "<form action=\"./projrptincst2.php?loginid=$loginid&pid=$projcode\" method=\"POST\" target=\"_blank\" name=\"projectreports\">";
  echo "<input type=\"hidden\" name=\"rpttyp\" value=\"incomestatement\">";
  echo "From:<input type=\"date\" name=\"pisdatefr\" value=\"$pisdatefr\">&nbsp;&nbsp;&nbsp;";
  echo "To:<input type=\"date\" name=\"pisdateto\" value=\"$pisdateto\">&nbsp;&nbsp;&nbsp;";
  echo "<button type=\"submit\" class=\"btn btn-success\">Submit</button>";
  echo "</form>";

?>