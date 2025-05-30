<?php
include("db1.php");
$loginid = (isset($_GET['idl'])) ? $_GET['idl'] :'';

$idpknkcode = (isset($_POST['idpknkcd'])) ? $_POST['idpknkcd'] :'';

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
  if(isset($_POST['idpknkcd'])) {
	$res21query="DELETE FROM tbljoinnkgandpkiicodes WHERE id=$idpknkcode";
  $result21=$dbh2->query($res21query);
	echo "<h3><font color='green'>Deleted.</font></h3>";
	} else {
	echo "<h3><font color='red'></font></h3>";
	} // if
	echo "<p><a href='./stravis.php?loginid=$loginid'>back</a></p>";
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
