<?php 

include("db1.php");
include ("addons.php");

$loginid = $_GET['loginid'];
$pagenum = $_GET['page'];

$found = 0;

$reccount = 0;
$pagerecstart = 0;
$rowsperpage = 50;

if($loginid != "")
{
    include("logincheck.php");
}

if ($found == 1)
{
    include ("header.php");
    include ("sidebar.php");

    if($pagenum == "")
    {
      $pagenum = 0;
      $pagerecstart = 0;
    }
    else
    {
      $pagerecstart = ($pagenum) * $rowsperpage;
    }
?>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <style>
    table th, table td{
      color: black;
      text-align: center;
      font-family: 'Poppins', sans-serif;
    }
    table th{
      vertical-align: middle !important;
      height: 50px !important;
    }
  </style>

    <div class="w-100 text-center mb-5">
		  <h2 class="text-black fw-semibold poppins">Networking Devices Ping Logs</h2>
	  </div>

    <div class="w-100">
      <div class="p-5 bg-white shadow border border-1 rounded-2">
        <table class="w-100 table table-bordered table-hover table-striped">
          <tr>
            <th class="fw-medium bg-secondary-subtle">ID</th>
            <th class="fw-medium bg-secondary-subtle">Stamp</th>
            <th class="fw-medium bg-secondary-subtle">Hostname</th>
            <th class="fw-medium bg-secondary-subtle">IP</th>
            <th class="fw-medium bg-secondary-subtle">Status</th>
            <th class="fw-medium bg-secondary-subtle">Downspeed</th>
            <th class="fw-medium bg-secondary-subtle">Upspeed</th>
            <th class="fw-medium bg-secondary-subtle">Remarks</th>
          </tr>
<?php
      $result11 = mysql_query("SELECT idsysadpingres, timestamp, hostname, ipaddress, status, bwdownspeed, bwupspeed, remarks FROM tblsysadpingres ORDER BY timestamp DESC LIMIT $pagerecstart, $rowsperpage", $dbh);
      while($myrow11 = mysql_fetch_row($result11)) {
        $found11 = 1;
        $idsysadpingres11 = $myrow11[0];
        $timestamp11 = $myrow11[1];
        $hostname11 = $myrow11[2];
        $ipaddress11 = $myrow11[3];
        $status11 = $myrow11[4];
        $bwdownspeed11 = $myrow11[5];
        $bwupspeed11 = $myrow11[6];
        $remarks11 = $myrow11[7];
?>
  <tr>
      <td align="center"><?php echo $idsysadpingres11 ?></td>
      <td><?php echo $timestamp11 ?></td>
      <td><?php echo $hostname11 ?></td>
      <td><?php echo $ipaddress11 ?></td>
      <td>
          <?php
          if ($status11 == "DOWN") {
              echo "<span class='text-danger fw-semibold'>$status11</span>";
          } else {
              echo "<span class='text-success fw-semibold'>$status11</span>";
          }
          ?>
      </td>
      <td><?php echo $bwdownspeed11 ?></td>
      <td><?php echo $bwupspeed11 ?></td>
      <td><?php echo $remarks11 ?></td>
  </tr>
<?php
      }

    $pagenum0 = $pagenum - 1;
    $pagenum2 = $pagenum + 1;
?>
      </table>
      <div class="poppins d-flex justify-content-end">
        <?php
          if ($pagenum0 < 0) { echo "&nbsp;"; } else {
          ?>
            <a class="text-black" href="logping.php?loginid=<?php echo $loginid ?>&page=<?php echo $pagenum0 ?>">< Back | </a>
          <?php  
          }
          $result22 = mysql_query("SELECT idsysadpingres FROM tblsysadpingres ORDER BY idsysadpingres DESC LIMIT 0, 1", $dbh);
          while ($myrow22 = mysql_fetch_row($result22))
          {
            $found22 = 1;
            $maxlogid = $myrow22[0];
          }

          $reccounttot = $pagerecstart + $rowsperpage;

          echo "&nbsp;<strong>$pagenum2</strong>&nbsp;";

          if ($reccounttot >= $maxlogid)
          {
            echo "&nbsp;";
          }
          else
          {
            ?>
              <a class="text-black" href="logping.php?loginid=<?php echo $loginid ?>&page=<?php echo $pagenum2 ?>"> | Next ></a>
            <?php
          }
        ?>
      </div>
    </div>
	</div>

	<div class="d-flex justify-content-end pt-5">
	<button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">
		<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">Back</a>
	</button>
	</div>

  <!-- <p><a href="logs.php?loginid=<?php echo $loginid ?>">Back</a></p> -->
<?php
    $result = mysql_query("UPDATE tbllogin SET login_stat=1 WHERE loginid=$loginid", $dbh); 
  
    include ("footer.php");
}
else
{
    include ("logindeny.php");
}

mysql_close($dbh);

?> 