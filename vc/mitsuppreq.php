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
				<div class="modal-header mx-auto ">
					<h5 class="modal-title border-0"  id="staticBackdropLabel">Ticket Form</h5>
				</div>
				<div class="modal-body" >
				<?php include 'mitsuppreqadd.php'; ?>
				</div>
				<div class="modal-footer border-0"">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				
				</div>
				</div>
			</div>
			</div>



	<div class=" my-5 p-5 mainbgc" >
		<div class=""><h4 class = 'ms-5 py-5 text-white'>IT Support Request</h4></div>
		</div>
<?php
	if($empdepartment0!='') {
?>

<div class="container w-50  mb-5">

	<div class = "bg-white shadow-lg rounded-4 p-2">
	<h6 class = "text-muted px-3">Actions</h6>
		<div class="row ">
			
			<div class="col-lg-6 text-center pb-4 ">

			<button type="button" class="secondarybgc border-0 rounded-3 my-3 px-3 py-2 text-white" data-toggle="modal" data-target="#staticBackdrop">
			New Ticket
			</button>



			</div>

				
			<div class="col-lg-6 text-center pb-4  ">
			
		<?php
			echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=34\" method=\"POST\" name=\"mitsuppreq\" class = '' onclick=\"this.form.submit();\">";
			// query available months
			include("../m/qrymitsuppreq.php");
		?>

				<select name="monsel" id='monsel' class = " bg-white my-3 py-2 px-2 shadow-0 border" '>
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
					
					<button type="submit" class="btn text-white bg-success">Submit</button>
				
		
				
			
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

<div class="row">

	<div class="col-md-6  ">
		<h5 class = 'text-secondary'>To Rate Tickets</h5>
		<div class="  rounded-3 px-4 border shadow anyClass mb-5">


		<?php
				include '../m/notification.php';

				$param12 = count($iditsupportreq12Arr);

				if ($param12 == 0){
					echo "<h4 class ='text-secondary text-center p-5'>All tickets have been rated!</h4>";
				}else{

				for ($x = 0; $x < $param12; $x++) {
					$found12 = 1;
					$ctr12 = $ctr12 + 1;
					
					?>
					<div class="border bg-white rounded-4  my-5 p-5">
						
						<div class="row flex-row">
				<?php
				
					//ticket number
				echo "<div class = 'col-md-4 '>";
				echo "<p class = 'text-secondary fs-5'> <span class = 'text-dark'>" . $ticketnum12Arr[$x] . "</span></p>";
			echo "</div>";

					//date
				echo "<div class = 'col-md-4'>";
					echo "<p class = 'text-secondary fs-5'>Date of Request:  <span class = 'text-dark'>" . date("Y-M-d", strtotime($stamprequest12Arr[$x])) . "</span></p>";
				echo "</div>";

					//pending or approved
				echo "<div class = 'col-md-4'>";
				if ($approvectr12Arr[$x] == 0) {
					$approvestatstr = "Pending";
					
					echo "<p class = 'border border-warning float-end  text-warning p-2 rounded-3'> $approvestatstr</p>";
					
				} elseif ($approvectr12Arr[$x] == 1) {
					$approvestatstr = "Approved";
				
					echo "<p class = 'border border-success  float-end text-success p-2 rounded-3' > $approvestatstr</p>";
				
				} 
				echo "</div>";


			
				echo "<div class = 'col-md-12 my-4'>";
					echo "<p class=\"text-secondary \">Request: <span class = 'fw-bold text-dark'> " . $resquestctg12Arr[$x] . "";

					$arritsrctg = explode("|", $requestctg12Arr[$x]);

					foreach ($arritsrctg as $val => $n) {
						if ($n != '') {
							include '../m/qrymitsuppreq3.php';

							$param14 = count($name14Arr);

							for ($y = 0; $y < $param14; $y++) {
								$found14 = 1;
								$ctr14 = $ctr14 + 1;
								echo $name14Arr[$y]  ;
							}

							$param14 = '';
							$name14Arr = '';
						}
					}

					$arritsrctg = "";

					echo "</span></p>";
					echo "</div>";
					?>
					</div>
					<?php
					echo "<h5 class=\"text-secondary\">More Details: <br> <span class = 'text-dark fst-italic'> " . nl2br($details12Arr[$x]) . "</span></h5>";

					
					include '../m/qrymitsuppreq4.php';

					echo "<p class = 'text-secondary mt-4'>Status: <span class = 'text-dark'> $name15</span></p>";

					// if ($approvectr12Arr[$x] == 0) {
					
					// } elseif ($approvectr12Arr[$x] == 1) {
					// 	if ($ticketnum12Arr[$x] != 0 || $ticketnum12Arr[$x] != '') {
					// 		if ($closeticketsw12Arr[$x] == 1) {
					// 			$closetickstatstr = "<span class = ' text-danger p-2 rounded-4'> Closed</span>";
					// 		} elseif ($closeticketsw12Arr[$x] == 0) {
					// 			$closetickstatstr = "<span class = ' text-danger p-2 rounded-4'> Open</span>";
					// 		}
					// 	} else {
					// 		$closetickstatstr = "";
					// 	}

					// 	echo "<p class = 'text-secondary mt-4'>ticket status: $closetickstatstr</p>";
					// }

					$closetickstatstr = ($approvectr12Arr[$x] == 1 && ($ticketnum12Arr[$x] != 0 || $ticketnum12Arr[$x] != '')) ? 
					($closeticketsw12Arr[$x] == 1 ? "<span class='text-danger p-2 rounded-4'> Closed</span>" : 
					"<span class='text-danger p-2 rounded-4'> Open</span>") : '';
					echo ($approvectr12Arr[$x] == 1) ? "<p class='text-secondary mt-4'>ticket status: $closetickstatstr</p>" : '';


					if ($employeeid12Arr[$x] == $employeeid0) {
						$actor = "REQ";
					} elseif ($approveempid12Arr[$x] == $employeeid0) {
						$actor = "APP";
					} elseif ($actionempid12Arr[$x] == $employeeid0) {
						$actor = "ACT";
					}

					echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=342\" method=\"POST\" name=\"mitsuppreqdtl\">";
					echo "<input type=\"hidden\" name=\"idsr\" value='" . $iditsupportreq12Arr[$x] . "'>";
					echo "<input type=\"hidden\" name=\"ctgactor\" value=\"$actor\">";
					echo "<button type=\"submit\" class=\"secondarybgc text-white rounded-4 p-3 mt-4 border-0\">Details</button>";
					
					echo "</form>";
					?>
							</div>
					<?php
				}
			}
				?>
		


				<?php
					} else {
				?>
					<div class="col-md-12"><h3 class="text-danger">Sorry. No department defined on your profile.</h3></div>
				<?php
					} // if($empdepartment0!='')
				?>
		</div>

				</div>







				<div class="col-md-6  ">
		<h5 class = 'text-secondary'>Your Tickets</h5>
		<div class="  rounded-3 px-4 border shadow anyClass mb-5">


		<?php
				include '../m/qrymitsuppreq2.php';

				$param12 = count($iditsupportreq12Arr);

				if ($param12 == 0){
					echo "<h4 class ='text-secondary text-center p-5'>All tickets have been rated!</h4>";
				}else{

				for ($x = 0; $x < $param12; $x++) {
					$found12 = 1;
					$ctr12 = $ctr12 + 1;
					
					?>
					<div class="border bg-white rounded-4  my-5 p-5">
						
						<div class="row flex-row">
				<?php
				
					//ticket number
				echo "<div class = 'col-md-4 '>";
				echo "<p class = 'text-secondary fs-5'> Ticket number: <span class = 'text-dark'>" . $ticketnum12Arr[$x] . "</span></p>";
			echo "</div>";

					//date
				echo "<div class = 'col-md-4'>";
					echo "<p class = 'text-secondary fs-5'>Date of Request:  <span class = 'text-dark'>" . date("Y-M-d", strtotime($stamprequest12Arr[$x])) . "</span></p>";
				echo "</div>";

					//pending or approved
				echo "<div class = 'col-md-4'>";
				if ($approvectr12Arr[$x] == 0) {
					$approvestatstr = "Pending";
					
					echo "<p class = 'border border-warning float-end  text-warning p-2 rounded-3'> $approvestatstr</p>";
					
				} elseif ($approvectr12Arr[$x] == 1) {
					$approvestatstr = "Approved";
				
					echo "<p class = 'border border-success  float-end text-success p-2 rounded-3' > $approvestatstr</p>";
				
				} 
				echo "</div>";


			
				echo "<div class = 'col-md-12 my-4'>";
					echo "<p class=\"text-secondary \">Request: <span class = 'fw-bold text-dark'> " . $resquestctg12Arr[$x] . "";

					$arritsrctg = explode("|", $requestctg12Arr[$x]);

					foreach ($arritsrctg as $val => $n) {
						if ($n != '') {
							include '../m/qrymitsuppreq3.php';

							$param14 = count($name14Arr);

							for ($y = 0; $y < $param14; $y++) {
								$found14 = 1;
								$ctr14 = $ctr14 + 1;
								echo $name14Arr[$y]  ;
							}

							$param14 = '';
							$name14Arr = '';
						}
					}

					$arritsrctg = "";

					echo "</span></p>";
					echo "</div>";
					?>
					</div>
					<?php
					echo "<h5 class=\"text-secondary\">More Details: <br> <span class = 'text-dark fst-italic'> " . nl2br($details12Arr[$x]) . "</span></h5>";

					
					include '../m/qrymitsuppreq4.php';

					echo "<p class = 'text-secondary mt-4'>Status: <span class = 'text-dark'> $name15</span></p>";

					// if ($approvectr12Arr[$x] == 0) {
					
					// } elseif ($approvectr12Arr[$x] == 1) {
					// 	if ($ticketnum12Arr[$x] != 0 || $ticketnum12Arr[$x] != '') {
					// 		if ($closeticketsw12Arr[$x] == 1) {
					// 			$closetickstatstr = "<span class = ' text-danger p-2 rounded-4'> Closed</span>";
					// 		} elseif ($closeticketsw12Arr[$x] == 0) {
					// 			$closetickstatstr = "<span class = ' text-danger p-2 rounded-4'> Open</span>";
					// 		}
					// 	} else {
					// 		$closetickstatstr = "";
					// 	}

					// 	echo "<p class = 'text-secondary mt-4'>ticket status: $closetickstatstr</p>";
					// }

					$closetickstatstr = ($approvectr12Arr[$x] == 1 && ($ticketnum12Arr[$x] != 0 || $ticketnum12Arr[$x] != '')) ? 
					($closeticketsw12Arr[$x] == 1 ? "<span class='text-danger p-2 rounded-4'> Closed</span>" : 
					"<span class='text-danger p-2 rounded-4'> Open</span>") : '';
					echo ($approvectr12Arr[$x] == 1) ? "<p class='text-secondary mt-4'>ticket status: $closetickstatstr</p>" : '';


					if ($employeeid12Arr[$x] == $employeeid0) {
						$actor = "REQ";
					} elseif ($approveempid12Arr[$x] == $employeeid0) {
						$actor = "APP";
					} elseif ($actionempid12Arr[$x] == $employeeid0) {
						$actor = "ACT";
					}

					echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=342\" method=\"POST\" name=\"mitsuppreqdtl\">";
					echo "<input type=\"hidden\" name=\"idsr\" value='" . $iditsupportreq12Arr[$x] . "'>";
					echo "<input type=\"hidden\" name=\"ctgactor\" value=\"$actor\">";
					echo "<button type=\"submit\" class=\"secondarybgc text-white rounded-4 p-3 mt-4 border-0\">Details</button>";
				
					
					echo "</form>";
					?>
					
							</div>
							
					<?php
				}
			}
				?>
			


				
		</div>

				</div>







</div>
	








	</div>




