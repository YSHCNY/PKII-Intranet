<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Manage >> Purchasing Modules</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

     echo "<tr><th colspan=\"2\">Purchasing Modules Configuration</th></tr>";

// start contents here...
  if($accesslevel >= 4)
  {
    ?>
    <tr>
    <td><a>Requests</a></td>
    <td>Manage All Employee Requests</td>
    </tr>

    <tr>
    <td><a href="purchasingsuppliers.php?loginid=<?php echo $loginid; ?>">Suppliers</a></td>
    <td>Manage Supplier List</td>
    </tr>

    <tr>
    <td><a>Purchase Order</a></td>
    <td>Manage Purchase Orders</td>
    </tr>

    <tr>
    <td><a>Inventory</a></td>
    <td>Manage Inventory</td>
    </tr>
    <?php 
  }

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"index2.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
