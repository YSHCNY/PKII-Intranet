<?php
//
// mitsuppreq.php
// fr: vc/index.php
// indexlinks: $page==34

require '../includes/config.inc';

$yyyymm = (isset($_POST['monsel'])) ? $_POST['monsel'] :'';

if($yyyymm=='') { $yyyymm="all"; }

if($yyyymm != "all") {
	$cutstart = $yyyymm."-"."01";
	$cutstartarr = split("-", $yyyymm);
	$cutyear = $cutstartarr[0];
	$cutmonth = $cutstartarr[1];
	// $cutstart = date("Y-m-01", strtotime($datenow));
} // if



?>

<div class="modal fade " id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog  ">
				<div class="modal-content ">
				<div class="modal-header  <?php echo "$mainbg $maintext"?>">
					<h5 class='modal-title <?php echo "$mainbg $maintext"?>'  id="staticBackdropLabel">Ticket Form</h5>
				</div>
				<div class="modal-body <?php echo "$mainbg $maintext"?>" >
				<?php include 'mitsuppreqadd.php'; ?>
				</div>
				<div class="modal-footer  <?php echo "$mainbg $maintext"?>">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				
				</div>
				</div>
			</div>
			</div>


			<div class=" p-5 <?php echo $hero?>" >
	<div class="text-center"><h3 class = 'mb-5 mt-2 py-5 fw-bold text-uppercase text-white'>IT Support Request</h3></div>

		</div>
<?php
	if($empdepartment0!='') {
?>

<div class="container w-50  mb-5">

	<div class = "<?php echo $mainbg?> shadow  rounded p-2">
	<h6 class = "<?php echo $subtext?> px-3">Actions</h6>
		<div class="row ">
			
			<div class="col-lg-6 text-center pb-4 ">

			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
			New Ticket
			</button>



			</div>

				
			<div class="col-lg-6 text-center pb-4  ">
			
		<?php
			echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=34\" method=\"POST\" name=\"mitsuppreq\" class = '' onclick=\"this.form.submit();\">";
			// query available months
			include("../m/qrymitsuppreq.php");
		?>

				<select name="monsel" id='monsel' class = " <?php echo "$mainbg $maintext"?> my-3 py-2 px-2 shadow-0 border" '>
							<?php
								$param11 = count($yyyymm11Arr);
								for($x = 0; $x < $param11; $x++) {
									if($yyyymm11Arr[$x]==$yyyymm) { $yyyymmsel="selected"; } else { $yyyymmsel=""; }
									echo "<option value=\"".$yyyymm11Arr[$x]."\" $yyyymmsel>".date("Y-M", strtotime($yyyymm11Arr[$x]))."</option>";
								} // for
								if($yyyymm=="all") { $allsel="selected"; } else { $allsel=""; }
								echo "<option value=\"all\" $allsel>All</option>";
							?>
						</select>
					
					<button type="submit" class="btn btn-success">Submit</button>
				
		
				
			
		<?php
			echo "</form>";
		?>

</div>


</div>
</div>
</div>









<div class="container">


<style>
.anyClass {
  height: 900px;
  overflow-y: scroll;
}

/* 
.anyClass::-webkit-scrollbar {
    width: 5px !important;
}

.anyClass::-webkit-scrollbar-thumb {
    background-color:#0A1D44;
	border-radius: 4px;
} */



</style>

<div class="">

	







				<div class="  p-4 border shadow   ">
		<h5 class = '<?php echo $maintext ?> m-3'>My Tickets</h5>
		<div class="  rounded px-4 table-responsive mb-5">


		<?php
		include '../m/qrymitsuppreq2.php';

		$param12 = count($iditsupportreq12Arr);
		
		if ($param12 == 0) {
			echo "<h4 class ='$maintext text-center p-5'>All tickets have been rated!</h4>";
		} else {
			echo "<table class='table $tableinfo table-striped table-bordered' id = 'mitsuprreq'>";
			echo "<thead class='$theadof'>";
			echo "<tr class = '$maintext'>
					<th>Ticket Number</th>
					<th>Date of Request</th>
					<th>Status</th>
					<th>Request</th>
					<th>More Details</th>
					<th>Current Status</th>
					<th>Ticket Status</th>
					<th>Action</th>
				  </tr>";
			echo "</thead>";
			echo "<tbody class =''>";
		
			for ($x = 0; $x < $param12; $x++) {
				$requestDate = new DateTime($stamprequest12Arr[$x]);
				$currentDateMinus15days = (new DateTime())->modify('-15 days');
				$output = ($requestDate >= $currentDateMinus15days);
		
				// Determine approval status
				if ($approvectr12Arr[$x] == 1) {
					$approvestatstr = "Approved";
					$statusClass = "text-success";
				} elseif (!$output) {
					$approvestatstr = "Request Expired";
					$statusClass = "text-danger";
				} else {
					$approvestatstr = "Pending";
					$statusClass = "text-warning";
				}
		
				// Request details
				$requestDetails = "<strong class='$subtext'>" . $resquestctg12Arr[$x] . "</strong>";
				$arritsrctg = explode("|", $requestctg12Arr[$x]);
		
				foreach ($arritsrctg as $n) {
					if ($n != '') {
						include '../m/qrymitsuppreq3.php';
						for ($y = 0; $y < count($name14Arr); $y++) {
							$requestDetails .= " " . $name14Arr[$y];
						}
					}
				}
		
				// Ticket status
				$closetickstatstr = ($approvectr12Arr[$x] == 1 && ($ticketnum12Arr[$x] != 0 || $ticketnum12Arr[$x] != '')) ?
					($closeticketsw12Arr[$x] == 1 ? "<span class='text-danger p-2 rounded'>Closed</span>" :
					"<span class='text-success p-2 rounded'>Open</span>") : '';
		
				// Determine actor role
				if ($employeeid12Arr[$x] == $employeeid0) {
					$actor = "REQ";
				} elseif ($approveempid12Arr[$x] == $employeeid0) {
					$actor = "APP";
				} elseif ($actionempid12Arr[$x] == $employeeid0) {
					$actor = "ACT";
				}
		
				echo "<tr>";
				echo "<td>" . $ticketnum12Arr[$x] . "</td>";
				echo "<td>" . date("Y-M-d", strtotime($stamprequest12Arr[$x])) . "</td>";
				echo "<td class='$statusClass'>$approvestatstr</td>";
				echo "<td>$requestDetails</td>";
				echo "<td class='fst-italic'>$details12Arr[$x]</td>";
				echo "<td>$name15</td>";
				echo "<td>$closetickstatstr</td>";
				echo "<td>
						<form action='index.php?lst=1&lid=$loginid&sess=$session&p=342' method='POST'>
							<input type='hidden' name='idsr' value='{$iditsupportreq12Arr[$x]}'>
							<input type='hidden' name='ctgactor' value='$actor'>
							<button type='submit' class='btn btn-primary'>Details</button>
						</form>
					  </td>";
				echo "</tr>";
			}
		
			echo "</tbody>";
			echo "</table>";
		}
		?>
			<!-- end of my rated tickets -->


				
		</div>

				</div>




	
		<style>
			td, th{
				padding: 10px !important;
				
			}

			th{
				text-align: center;
				text-wrap: nowrap;
			}
		</style>
		



		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
	        $(document).ready(function() {
            $('#mitsuprreq').DataTable({
              
              "lengthMenu": [[ 50, -1], [ 50, "All"]],
              "lengthChange": true,
              "language": {
        "lengthMenu": "Display _MENU_ Entries"
    },
	"order": false
            });




		});


</script>
























				<!-- end dep -->


				<?php
					} else {
				?>
					<div class="col-md-12"><h3 class="text-danger">Sorry. No department defined on your profile.</h3></div>
				<?php
					} // if($empdepartment0!='')
				?>
		</div>

				</div>


</div>
	








	</div>




