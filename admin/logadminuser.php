<?php 

include("db1.php");
include("datetimenow.php");
include "timeago.php";

$loginid = isset($_GET['loginid']) ? $_GET['loginid'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 50;

$logdtfr = isset($_POST['logdtfr']) ? $_POST['logdtfr'] : '';
$logdtto = isset($_POST['logdtto']) ? $_POST['logdtto'] : '';
$logusrnm = isset($_POST['logusrnm']) ? $_POST['logusrnm'] : '';

if (empty($logdtfr) || empty($logdtto)) {
    $logdtto = $datenow;
    $logdtfr = strtotime(date("Y-m-d", strtotime($logdtto)) . " - 30 days");
    $logdtfr1 = date("Y-m-d", $logdtfr);
} else {
    $logdtfr1 = $logdtfr;
}

$logdtfrts = $logdtfr1 . " 00:00:00";
$logdttots = $logdtto . " 23:59:59";

$found = 0;

$offset = ($page - 1) * $records_per_page;

if ($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {
    include("header.php");
    include("sidebar.php");
?>
<style>
  p, div{
    font-family: 'Poppins', sans-serif !important;
  }
  #page:hover {
      color: white !important;
  }
  #hov{
    transition: background-color 0.3s, color 0.3s, border-color 0.3s;
  }
  #hov:hover {
      background-color: #0a1d44;
      color: white !important;
      border-color: #00f9ff !important;
  }
</style>
<script language="JavaScript" src="ts_picker.js"></script>

<div class="shadow px-4 py-5 my-2">
  <div class="mb-4 mx-3">
    <p class="fs-4 mb-0 fw-bold text-dark">Admin Activity Logs</p>
    <p class="fs-5 text-muted">View logs of admin and device details.</p>
  </div>

  <!-- form -->
  <div class="flex border rounded-3 p-4">
    <p class="text-muted fs-5">Action</p>
    <?php
      echo "<form method=\"post\" action=\"logadminuser.php?loginid=$loginid&page=1\" class=\"text-center mt-3\" name=\"formlog\">";
      echo "<span class=\"text-muted fs-4\">From</span> <input size=\"8\" class=\"my-2 bg-white rounded-3 px-3 py-2 border me-2\" name=\"logdtfr\" type=\"date\" value=\"$logdtfr1\">";
      echo "<span class=\"text-muted fs-4\">To</span> <input size=\"8\" class=\"my-2 bg-white rounded-3 px-3 py-2 border me-3\" name=\"logdtto\" type=\"date\" value=\"$datenow\">";
      echo "<input name=\"logusrnm\" list=\"persons\" placeholder=\"Type User.. or leave blank\" class=\"my-2 bg-white rounded-3 px-3 py-2 border\">";
      echo "<datalist id=\"persons\">";
      if ($logusrnm == "") {
          echo "<option value=\"usersall\">ALL</option>";
      }
      $result12 = mysql_query("SELECT DISTINCT adminuid FROM tbladminlogs ORDER BY adminuid ASC", $dbh);
      if ($result12) {
          while ($myrow12 = mysql_fetch_row($result12)) {
              $adminuid12 = $myrow12[0];
              $logusrnmsel = ($adminuid12 == $logusrnm) ? "selected" : "";
              echo "<option value=\"$adminuid12\" $logusrnmsel>$adminuid12</option>";
          }
      }
      echo "</datalist>";
      echo "<button type=\"submit\" class=\"my-2 mx-3 rounded-3 px-5 py-2 border-0 mainbtnclr text-white\">Filter</button>";
      echo "</form>";
    ?>
  </div>

  <?php
    $whereClause = "timestamp >= '$logdtfrts' AND timestamp <= '$logdttots'";
    if (($logusrnm != "usersall") && ($logusrnm != "")) {
        $whereClause .= " AND adminuid = '$logusrnm'";
    }
    $query = "SELECT adminlogid, timestamp, adminuid, adminlogdetails FROM tbladminlogs WHERE $whereClause ORDER BY timestamp DESC LIMIT $offset, $records_per_page";
    $result11 = mysql_query($query, $dbh);

    while ($myrow11 = mysql_fetch_row($result11)) {
        $adminlogid11 = $myrow11[0];
        $timestamp11 = $myrow11[1];
        $adminuid11 = $myrow11[2];
        $adminlogdetails11 = $myrow11[3];

        echo "
          <div id='hov' class='border rounded-3 px-5 m-4'>
            <div class='row pt-5'>
              <div class='col-lg-10'>
                <p class='fs-5 mb-0'>Details:</p>
                <p><i>On</i> $timestamp11, <span class='text-uppercase fw-bold'>$adminuid11</span>, <i>$adminlogdetails11</i></p>
              </div>
              <div class='col-lg-2'>
                <p class='text-end'>" . timeAgo($timestamp11) . "</p>
              </div>
            </div>
          </div>
        ";
    }

    $total_records_query = "SELECT COUNT(*) AS total_records FROM tbladminlogs WHERE $whereClause";
    $total_records_result = mysql_query($total_records_query, $dbh);
    $total_records_row = mysql_fetch_assoc($total_records_result);
    $total_records = $total_records_row['total_records'];
    $total_pages = ceil($total_records / $records_per_page);
  ?>
  
  <div class="pagination poppins d-flex justify-content-end gap-1">
      <?php
      if ($page > 1) {
          $prev_page = $page - 1;
          $prev_pagination_link = "?loginid=$loginid&page=$prev_page";
          echo "<a href='$prev_pagination_link' id='page' class='btn btn-outline-primary border border-1 text-black fw-medium'>Previous</a>";
      }

      if ($total_pages <= 5) {
          for ($i = 1; $i <= $total_pages; $i++) {
              $pagination_link = "?loginid=$loginid&page=$i";
              echo "<a href='$pagination_link' id='page' class='btn border border-1 " . ($i == $page ? "bg-danger border border-1 border-danger text-white" : "btn-outline-primary") . " text-black fw-semibold'>$i</a>";
          }
      } else {
          $pagination_link = "?loginid=$loginid&page=1";
          echo "<a href='$pagination_link' id='page' class='btn border border-1 " . (1 == $page ? "bg-danger border border-1 border-danger text-white" : "btn-outline-primary") . " text-black fw-semibold'>1</a>";

          if ($page > 3) {
              echo "<span id='page' class='btn border border-1 btn-outline-primary text-black fw-semibold'>...</span>";
          }

          for ($i = max(2, $page - 1); $i <= min($total_pages - 1, $page + 1); $i++) {
              $pagination_link = "?loginid=$loginid&page=$i";
              echo "<a href='$pagination_link' id='page' class='btn border border-1 " . ($i == $page ? "bg-danger border border-1 border-danger text-white" : "btn-outline-primary") . " text-black fw-semibold'>$i</a>";
          }

          if ($page < $total_pages - 2) {
              echo "<span id='page' class='btn border border-1 btn-outline-primary text-black fw-semibold'>...</span>";
          }

          $pagination_link = "?loginid=$loginid&page=$total_pages";
          echo "<a href='$pagination_link' id='page' class='btn border border-1 " . ($total_pages == $page ? "bg-danger border border-1 border-danger text-white" : "btn-outline-primary") . " text-black fw-semibold'>$total_pages</a>";
      }

      if ($page < $total_pages) {
          $next_page = $page + 1;
          $next_pagination_link = "?loginid=$loginid&page=$next_page";
          echo "<a href='$next_pagination_link' id='page' class='btn btn-outline-primary border border-1 text-black fw-medium'>Next</a>";
      }
      ?>
  </div>
</div>

<div class="d-flex justify-content-end mt-5">
	<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
		<button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">Back</button>
	</a>
</div>

<?php
    $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminloginid=$loginid", $dbh); 
    include("footer.php");
} else {
    include("logindeny.php");
}

mysql_close($dbh);
?>