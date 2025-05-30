<?php 

require("db1.php");
include("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] : '';
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$records_per_page = 10;

$orderby = 'tblcontract.fk_projcode';
$orderto = 'DESC';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1 && substr($level, -33, 1) == 1) {
     include ("header.php");
     include ("sidebar.php");
?>
<style>
	#searchInput{
		width: 30%;
		padding: 0.7% 0;
	}
	table td{
		font-family: 'Poppins', sans-serif;
		color: black;
		font-weight: 500;
	}
	#page:hover {
        color: white !important;
    }
    #bk:hover{
        color: white !important;
    }
	.highlight {
    	background-color: #00fff3;
		border-radius: 3px;
	}
	@media (max-width: 767px) {
        #searchInput{
            width: 50% !important;
			padding: 1.2% 1% !important;
        }
    }
</style>
<div class="poppins shadow p-5">
	<div class="text-center mb-5">
        <h2 class="m-0">Project Billing</h2>
    </div>
<?php
  if($accesslevel >= 3) {
	?>
		<div class="d-flex justify-content-between align-items-center my-4">
			<input type="text" id="searchInput" placeholder="Search..." onkeyup="searchTable()" class="rounded border border-1 border-secondary px-3">

			<form action="projbillcontrnew.php?loginid=<?php echo $loginid; ?>" method="POST" name="projbillcontrnew" class="m-0">
				<button type="submit" class="btn btn-info bg-primary border border-1 border-primary px-5 py-3">Add New Contract</button>
			</form>
		</div>

        <div class="table-responsive-xxl">
		<table id="myTable" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="">Project Code</th>
                    <th class="">Contract Title</th>
                    <th class="">Duration</th>
                    <th class="">Type</th>
                    <th class="">Total Contract Cost</th>
                    <th class="">Paid</th>
                    <th class="">Balance</th>
                    <th class="" colspan='2'>Action</th>
                </tr>
            </thead>
	<?php
	$start_from = ($page - 1) * $records_per_page;
	$res11query="SELECT tblcontract.contract_id, tblcontract.contract_title, tblcontract.contract_num, tblcontract.contract_type, tblcontract.contract_totcost_balance, tblcontract.contract_totcost_paid, tblcontract.contract_totcost_directcost, tblcontract.contract_totcost_tax, tblcontract.contract_totcost_remuneration, tblcontract.fk_projcode, tblproject1.date_start AS date_start, tblproject1.date_end AS date_end, tblproject1.date_mob AS date_mob FROM tblcontract LEFT JOIN tblproject1 ON tblcontract.fk_projcode=tblproject1.proj_code ORDER BY $orderby $orderto LIMIT $start_from, $records_per_page";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11=$ctr11+1;
			$contract_id11 = $myrow11['contract_id'];
			$contract_title11 = $myrow11['contract_title'];
			$contract_num11 = $myrow11['contract_num'];
			$contract_type11 = $myrow11['contract_type'];
			$contract_totcost_balance11 = $myrow11['contract_totcost_balance'];
			$contract_totcost_paid11 = $myrow11['contract_totcost_paid'];
			$contract_totcost_directcost11 = $myrow11['contract_totcost_directcost'];
			$contract_totcost_tax11 = $myrow11['contract_totcost_tax'];
			$contract_totcost_remuneration11 = $myrow11['contract_totcost_remuneration'];
			$fk_projcode11 = $myrow11['fk_projcode'];
			$date_start11 = $myrow11['date_start'];
			$date_end11 = $myrow11['date_end'];
			$date_mod11 = $myrow11['date_mob'];

	$contract_totcost = $contract_totcost_directcost11 + (($contract_totcost_directcost11*$contract_totcost_tax11)/100) + $contract_totcost_remuneration11;
    $contract_totcost_balance = $contract_totcost - $contract_totcost_paid11;
	
	?>
		<tr>
			<td class=""><?php echo $fk_projcode11; ?></td>
			<td><?php echo $contract_title11; ?></td>
			<td class="">
	<?php

    if($date_start11=="" || $date_start11=="0000-00-00") {
    }else {
        echo date('M d, Y', strtotime($date_start11));
    }
		if($date_end11=="" || $date_end11=="0000-00-00") {
    }else {
        echo "<br>to<br>".date('Y-M-d', strtotime($date_end11))."";
    }
	?>
			</td>
			<td class=""><?php echo $contract_type11; ?></td>
			<td class=""><?php echo number_format($contract_totcost); ?></td>
			<td class=""><?php echo number_format($contract_totcost_paid11); ?></td>
			<td class=""><?php echo number_format($contract_totcost_balance); ?></td>

			<form action='projbilldtls.php?loginid=<?php echo $loginid; ?>' method='POST' name='projbilldtls'>
				<input type='hidden' name='contractid' value='<?php echo $contract_id11; ?>'>
				<input type='hidden' name='projcode' value='<?php echo $fk_projcode11; ?>'>
				<td class="">
					<button type='submit' class='btn btn-info bg-primary border border-1 border-primary'>Manage</button>
				</td>
			</form>

			<form action='projectManagement.php?loginid=<?php echo $loginid; ?>&projcode=<?php echo $fk_projcode11; ?>&contractid=<?php echo $contract_id11; ?>' method='POST' name='projmanagement'>
				<td class="">
					<button type='submit' class='btn btn-warning'>Details</button>
				</td>
			</form>
		</tr>
	<?php
		$contract_totcost=0; $date_start11=""; $date_end11="";
		}
	}
	?>
		</table>
        </div>
	<?php

	$total_records_query = "SELECT COUNT(*) AS total_records FROM tblcontract";
	$total_records_result = $dbh2->query($total_records_query);
	$total_records_row = $total_records_result->fetch_assoc();
	$total_records = $total_records_row['total_records'];
	$total_pages = ceil($total_records / $records_per_page);
	?>

<div class="pagination poppins d-flex justify-content-end gap-1">
    <?php
    if ($page > 1) {
        $prev_page = $page - 1;
        $prev_pagination_link = "?loginid=$loginid&page=$prev_page";
        if (!empty($_GET['search'])) {
            $search_query_param = urlencode($_GET['search']);
            $prev_pagination_link .= "&search=$search_query_param";
        }
        ?>
        <a href='<?php echo $prev_pagination_link; ?>' id="page" class='btn btn-outline-primary border border-1 text-black fw-medium'>Previous</a>
        <?php
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        $pagination_link = "?loginid=$loginid&page=$i";
        if (!empty($_GET['search'])) {
            $search_query_param = urlencode($_GET['search']);
            $pagination_link .= "&search=$search_query_param";
        }
        ?>
        <a href='<?php echo $pagination_link; ?>' id="page" class='btn border border-1 <?php echo ($i == $page) ? "bg-danger border border-1 border-danger text-white" : "btn-outline-primary"; ?> text-black fw-semibold'><?php echo $i; ?></a>
        <?php
    }
    if ($page < $total_pages) {
        $next_page = $page + 1;
        $next_pagination_link = "?loginid=$loginid&page=$next_page";
        if (!empty($_GET['search'])) {
            $search_query_param = urlencode($_GET['search']);
            $next_pagination_link .= "&search=$search_query_param";
        }
        ?>
        <a href='<?php echo $next_pagination_link; ?>' id="page"  class='btn btn-outline-primary border border-1 text-black fw-medium'>Next</a>
        <?php
    }
    ?>
</div>

	<?php
  }
	if($accesslevel >= 4) {

	}
?>

</div>

<div class="my-5 d-flex justify-content-end">
     <a id="bk" href="index2.php?loginid=<?php echo $loginid; ?>" class="poppins fw-semibold text-black border border-1 border-primary btn btn-outline-primary" style="padding: 10px 60px;" role="button">Back</a>
</div>

<?php
     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();

/**
 * Check if the value is a valid date
 *
 * @param mixed $value
 *
 * @return boolean
 */
function isDate($date_end11) 
{
    if (!$date_end11) {
        return false;
    }

    try {
        new \DateTime($date_end11);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}
?>

<script>
function searchTable() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        if (tr[i].getElementsByTagName("th").length > 0) {
            continue; // Skip processing table header rows
        }

        td = tr[i].getElementsByTagName("td");
        var rowMatches = false;

        // Loop through all cells in current row
        for (j = 0; j < td.length; j++) {
            if (td[j]) {
                // Check if the cell contains a button
                if (td[j].querySelector('button')) {
                    continue; // Skip processing this cell if it contains a button
                }

                txtValue = td[j].textContent || td[j].innerText;

                // Check if the cell content matches the search filter
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    rowMatches = true;
                    // Highlight the matching text
                    var regex = new RegExp(filter, 'gi');
                    td[j].innerHTML = txtValue.replace(regex, function(match) {
                        return '<span class="highlight">' + match + '</span>';
                    });
                } else {
                    // Reset the cell content if it doesn't match the filter
                    td[j].textContent = txtValue;
                }
            }
        }

        // Show or hide the row based on whether it matches the search filter
        if (rowMatches) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}
</script>