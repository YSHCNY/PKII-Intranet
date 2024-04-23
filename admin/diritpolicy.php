<?php 

include("db1.php");
include("datetimenow.php");

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

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");
?>
<div>
	<?php include("dirisodocshead.php"); ?>
    <tr>
        <td colspan="2">
            <?php if($docsw != 0 || $docsw != ""): ?>
                <!--[if IE]-->
                <!-- <iframe frameborder="0" width="100%" height="600" src="<?php echo $filepath . $filename; ?>?wmode=opaque" type="application/pdf"></iframe>
                <![endif]-->
                <![if !IE]>
                <object data="<?php echo $filepath . $filename; ?>#toolbar=0" type="application/pdf" WIDTH="100%" HEIGHT="650">
                    <param name="WMode" value="transparent" /></param>
                    <embed src="<?php echo $filepath . $filename; ?>#toolbar=0" wmode="transparent" type="application/pdf" />
                </object>
                <![endif]>
            <?php endif; ?>
        </td>
    </tr>
</div>

<div class="d-flex justify-content-end mt-4">
    <button class="border border-1 rounded-3" style="width: 12.5%; height: 40px; background-color: #0a1d44;">
        <a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">Back</a>
    </button>
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
