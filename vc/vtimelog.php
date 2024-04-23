<?php
//
// mactivitylog.php
// fr: vc/index.php
include '../includes/dbh.php';

$yyyymm = (isset($_POST['monsel'])) ? $_POST['monsel'] :'';

$cutstart = $yyyymm."-"."01";
$cutend = date("Y-m-t", strtotime("$cutstart"));

?>
<div class="pt-5 mt-4 mainbgc">
	<div class=""><h4 class = 'ms-5 py-5 text-white'>Time log</h4></div>
	

	<div class="container">	
		<div class="mx-auto bg-white rounded-4 shadow-lg ">
			<div class = 'p-4'>
							<?php 
						echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=12\" method=\"POST\" name=\"vtimelog\">";
						include("../m/qrytimelog.php");
						if($att_userid0 != "") {
							?>
								<div class="flex">
								<div class=" text-center">
							<?php
									echo "<p class = 'text-center text-muted fs-5'>Time Log Summary for: <span class = 'text-dark fs-4'>$name_last0, $name_first0 $name_middle0[0]</span>  </p>";
									echo "<form action=\"vtimelog.php?lst=1&lid=$loginid&sess=$session&p=12\" method=\"POST\" >";				
									include("../m/qrytimelog2.php");
									echo "<button class=\"secondarybgc text-white mx-2 border-0 px-3 py-2 rounded-3\" id='btnActdtlSubmit'>Submit</button>";
						?>
						</div></div>
						</form>
					</div>
				</div>
			</div>
			
		</div>
				<style>
					/* CSS for Responsive Calendar */
.calendar-container {
    display: flex;
    flex-wrap: wrap;
   
}

.calendar-day {
    width: calc(100% / 7); /* Adjust this value as needed for spacing */
    max-width: 200px; /* Adjust as needed */
}

@media screen and (max-width: 769px ) {
    .calendar-day {
        width: calc(100% / 5); /* Adjust this value for 5 days in a row on small screens */
    }
}

@media screen and (max-width: 640px) {
    .calendar-day {
        width: 100%; /* Full width on extra small screens */
    }
}

				</style>
						
						
	<div class="container-fluid px-5 my-4">
			
	<?php
	
if ($yyyymm != "") {
	echo "<div class='container'>";
	$startDate = date("Y-m-d", strtotime($cutstart));
	echo '<h3 class = "">' . date("F Y", strtotime($startDate)) . '</h3>';
	echo "</div>";
	echo "<div class = 'container'>";
    echo '<div class="calendar-container  shadow-lg p-5 rounded-4 bg-white d-flex justify-content-center justify-content-md-start">';

	
    while (strtotime($cutstart) <= strtotime($cutend)) {
		$dateval = date("Y-M-d", strtotime($cutstart));
        $dayOfWeek = date("l", strtotime($dateval));
        $currentDate = date("Y-M-d");

        // Check if the current date matches the date being iterated
		if ($dateval == $currentDate) {
            $borderClass = 'border-primary fw-bold ';
			$today = 'today';
        } else {
            $borderClass = '';
			$today = '';
        }
?>	

        <div class="calendar-day border <?php echo $borderClass; ?> <?php echo ($dayOfWeek == "Sunday") ? 'text-danger' : 'text-muted'; ?> p-4">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-6 text-center">
			<div class="day"><h6><?php echo $dayOfWeek; ?></h6></div>
			</div>
			<div class="col-md-12 col-sm-12 col-lg-6">
			<div class="date text-lg-end text-center"><h6><?php echo date("d", strtotime($dateval)); ?></h6></div>
			</div>
		</div>
          
           <div class = " text-center mt-2 mb-3">
			<div class = "maintext">
			<!-- <p class="fs-6 ">IN - OUT</p> -->
            <div class="time calendarbg p-2 rounded-3 ">
		
                <?php
                include("../m/qrytimelog3.php");
                if ($timein14 != "") {
                    echo '<h5 >'.date("G:i", strtotime($timein14));
                    $timein14 = "";
                }
                ?>
                <p class = 'fs-6 pt-2'>to</p>
                <?php
                include("../m/qrytimelog4.php");
                if ($timeout15 != "") {
                    echo  date("G:i", strtotime($timeout15)).'</h5>';
                    $timeout15 = "";
                }
                ?>
				</div>

			
				</div>


				
            </div>
        </div>
<?php
        // increment day
        $cutstart = date("Y-m-d", strtotime($cutstart . " + 1 days"));
    }
    echo '</div>';
	echo "</div>";
}






	} else {
		echo "<tr><td colspan\"2\"><font color=\"red\">Sorry. You are not enrolled on the time log device.</font></td></tr>";
	
	}
	echo "</form>";

	?>



</div>


























<!-- old -->
<?php
//
// mactivitylog.php
// fr: vc/index.php
// include '../includes/dbh.php';

// $yyyymm = (isset($_POST['monsel'])) ? $_POST['monsel'] :'';

// $cutstart = $yyyymm."-"."01";
// $cutend = date("Y-m-t", strtotime("$cutstart"));

?>
	<!-- <div class="row">
		<div class="col-md-12"><h3>Time Log</h3></div>
	</div>

	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
<table class="table">

<tbody> -->
		<?php 
	// echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=12\" method=\"POST\" name=\"vtimelog\">";
	?>
	

<?php	


	
// 	include("../m/qrytimelog.php");
	
	
// 	if($att_userid0 != "") {
	

// 	echo "<tr><th colspan=\"4\">Time Log Summary:&nbsp;&nbsp; $name_last0, $name_first0 $name_middle0[0]</td></tr>";
// 		echo "<form action=\"vtimelog.php?lst=1&lid=$loginid&sess=$session&p=12\" method=\"POST\" >";
		
// 		echo "<tr><td colspan=\"5\">&nbsp;";
	
// // list available year-month of timelog data
		
// 		include("../m/qrytimelog2.php");
		
	
// 		 echo "<button class=\"btn btn-primary\" id='btnActdtlSubmit'>Submit</button>";
// 		echo "<tr><th colspan=\"2\">&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; Date</th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Time-IN</th><th>&nbsp;&nbsp; &nbsp;&nbsp; Time-OUT</th></tr>";

	
	
	
// 	//generate timelog
	
// 	if($yyyymm != "") {
// 		while(strtotime($cutstart) <= strtotime($cutend)) {
// 			$dateval = date("Y-M-d", strtotime($cutstart));
// 			// echo "$dateval<br>";
// 			if(date("D", strtotime($dateval)) == "Sun") {
			
// 			echo "<tr><td><font color=\"red\">".date("Y-M-d", strtotime($dateval))."</font></td><td align=\"center\"><font color=\"red\">".date("D", strtotime($dateval))."</font></td>";
// 			} else {
// 			echo "<tr border color=\"black\"><td>".date("Y-M-d", strtotime($dateval))."</td><td align=\"center\">".date("D", strtotime($dateval))."</td>";
// 			}
		
// 			echo "<td align=\"center\">";
// 			include("../m/qrytimelog3.php");
// 			if($timein14 != "") {
// 				echo date("G:i", strtotime($timein14));
// 				echo "<br>";
// 				$timein14="";
// 			}
// 			echo "</td>";
// 			echo "<td align=\"center\">";
// 			include("../m/qrytimelog4.php");
// 			if($timeout15 != "") {
// 				echo date("G:i", strtotime($timeout15));
// 				echo "<br>";
// 				$timeout15="";
				
// 			} // if($result15->num_rows>0)
// 			echo "</td>";
// 			echo "</tr>";
// 			// increment day
// 			$cutstart = date("Y-m-d", strtotime($cutstart. " + 1 days"));
		
// 		}
	
// 	}
// 	} else {

// 		echo "<tr><td colspan\"2\"><font color=\"red\">Sorry. You are not enrolled on the time log device.</font></td></tr>";

	
// 	}
// 	echo "</table>";
// 	?>

<!-- // 	</tbody>
// </table>

// 		<div class="col-md-3"></div>
// 	</div> -->

