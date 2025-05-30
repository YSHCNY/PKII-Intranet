<?php 

include("db1.php");
include("datetimenow.php");
include ("addons.php");

$loginid = $_GET['loginid'];
$docsw = $_GET['docsw'];

$doctyp = $_POST['doctyp'];

$filepath = $_POST['fp'];
$filename = $_POST['fn'];

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
 <div class="mb-4">
		<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white btn text-decoration-none mainbtnclr">
			Back
		</a>
    </div>
    <div>
        <?php include("dirisodocshead.php"); ?>
    <tr>
      <td colspan="2">

<?php 
    if($docsw != 0 || $docsw != "") {
?>
  <![if !IE]>
  <object class = ' border p-5 shadow ' data="<?php echo $filepath . $filename; ?>#toolbar=0" type="application/pdf" WIDTH="100%" HEIGHT="650">
      <param name="WMode" value="transparent" /></param>
      <embed src="<?php echo $filepath . $filename; ?>#toolbar=0" wmode="transparent" type="application/pdf" />
  </object>
  <![endif]>

<?php
    }
?>

      </td>
    </tr>
  </div>

   

<?php
    $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

    include ("footer.php");
}
else
{
    include ("logindeny.php");
}

mysql_close($dbh);
?>