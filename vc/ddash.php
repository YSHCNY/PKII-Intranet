<?php

    include '../m/qryddashadm.php';
	session_start();

	// if(isset($_SESSION['username']) && isset($_SESSION['employeeid']) ) {
	// 	$username = $_SESSION['username']; // Retrieve the username from the session
	// 	$empid = $_SESSION['employeeid'];
	// } else {
	// 	// Redirect the user to the login page if not logged in
	// 	header("Location: index.php");
	// 	exit();
	// }

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css
">




<div class="container-fluid mt-5 mb-2 px-5 mainbgc" >

<p class="text-white ms-0 ms-lg-5 mt-5 pb-5 pt-5 text-lg-start text-center fs-2" >
Hello, <span class = 'fw-bold'><?php echo $name_first0 . " " . $name_last0 ; ?></span>! <br>
 <span class="fs-3">Dashboard</span></p> 


		<div class="mx-auto w-75">
	<div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-4  g-2 g-lg-3">

<div class="col-lg-4">
    <div class="card shadow-lg border-0 rounded-5 mx-auto p-5 mb-2">
        <div class="card-body py-0 px-4">
            <div class="row row-cols-lg-2 row-cols-md-2 ">
                <div class=" d-flex justify-content-center align-items-center">
                    <div class ='mb-3'>
                        <h3 class="card-subtitle  fw-bold maintext text-center "><?php echo "".number_format($ctrempactv, 0).""; ?></h3>
                        <h5 class="card-title fs-5 text-wrap text-body-secondary">Employees</h5>
                    </div>
                </div>
                <div class=" d-flex justify-content-center align-items-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#124D08" class="bi bi-people-fill" viewBox="0 0 16 16">
					<path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
					</svg>
                </div>
            </div>
        </div>
    </div>
</div>

	<!-- card 1 end -->




	
	<div class="col-lg-4">
    <div class="card shadow-lg border-0 rounded-5 mx-auto p-5 mb-2">
        <div class="card-body py-0 px-4">
            <div class="row row-cols-lg-2 row-cols-md-2 ">
                <div class=" d-flex justify-content-center align-items-center">
                    <div class ='mb-3'>
                        <h3 class="card-subtitle  fw-bold maintext text-center"><?php echo "".number_format($ctrconsactv, 0).""; ?></h3>
                        <h5 class="card-title fs-5 text-wrap text-body-secondary">Consultants</h5>
                    </div>
                </div>
                <div class=" d-flex justify-content-center align-items-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#1B3261" class="bi bi-headset" viewBox="0 0 16 16">
					<path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5"/>
					</svg>
                </div>
            </div>
        </div>
    </div>
</div>

	<!-- card 2 end -->


	<div class="col-lg-4">
    <div class="card shadow-lg border-0 rounded-5 mx-auto p-5 mb-2">
        <div class="card-body py-0 px-4">
            <div class="row row-cols-lg-2 row-cols-md-2 ">
                <div class=" d-flex justify-content-center align-items-center">
                    <div class ='mb-3'>
                        <h3 class="card-subtitle  fw-bold maintext text-center"><?php echo $ctrprojactv; ?></h3>
                        <h5 class="card-title fs-5 text-wrap text-body-secondary">Projects</h5>
                    </div>
                </div>
                <div class=" d-flex justify-content-center align-items-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#6A4B15" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
  <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5"/>
  <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85z"/>
</svg>
                </div>
            </div>
        </div>
    </div>
</div>

	<!-- card 3 end -->





	
			

	</div>
</div>


</div>









	<div class="container ">

<?php if($found11==1) {
		preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $emlbody, $urlpkhcarr);
		// print_r($urlpkhcarr[0]);
?>
	    <div class="row ">
<!-- <div class="jumbotron"> old -->
<div class="">

        <div class="col-md-6">
<?php
    $arrurlctr=0;
		foreach($urlpkhcarr as $val) {
			$arrurlctr++;
			$urlpkhc = $val[0];
			if($arrurlctr==1) {
			echo "<a href=\"$urlpkhc\" target=\"_blank\" class=\"btn btn-success btn-lg\" role=\"button\">PKII Health Check for ".date('D Y-M-d', strtotime($datenow))."<br>just in case you haven't filled-up for today.</a>";
			} //if
		} //foreach
?>
		</div>
        <div class="col-md-3">
		</div>
</div>
    </div> <!-- div class="row">
<?php } //if ?>

<!-- display dashboard stats -->
  


	<?php
		  $month = date('F');

	?>
<!-- <br> -->

<div class="row g-4 ">
	

		<div class="col-md-4 p-5">
	<div class=" row">

		<div class="mt-5 rounded-2 shadow-lg border">
		<p class = "text-secondary px-5 pt-5"><?php echo "$month";?> Celebrants </p>
  <?php
    // query birthdays <5d to >30d of curr_date
    include("../m/qryddashbday.php");
    // display results
	$currentMonth = date("m");
	$currentDay = date("d");
	
	

    $param11 = count($employeeid11Arr);
    for ($x = 0; $x < $param11; $x++) {
		$empMonth = date("m", strtotime($emp_birthdate11Arr[$x]));
		$empDay = date("d", strtotime($emp_birthdate11Arr[$x]));
		if ($currentMonth == $empMonth && $currentDay == $empDay) {
			$display = 'bday text-white p-5 fs-1';
			$text = 'text-white';
			$picborder = 'border-white';
			$mtext = 'text-white';
		} else {
			$display = 'py-2 px-5 submaintext '; // Initialize $display to an empty string if condition is not met
			$text = 'textmain';
			$picborder = 'border-black';
			$mtext = 'submaintext';
		}

        echo "<div class='row row-cols-md-2 row-cols-sm-1 row-cols-lg-3 $display justify-content-center align-items-center text-center mx-auto rounded-4 my-5'>";
			
	
        // Image column
        echo "<div class='col-lg-4 col-md-12 col-sm-12  mt-0   '>";
        echo "<img src='$pathavatar/{$picfn11Arr[$x]}' class='rounded-circle img-fluid border $picborder ' height='70' width='70'>";
        echo "</div>"; // column
        
        // Name column
        echo "<div class='col-lg-4 col-md-12 col-sm-12 mt-0 '>";
        echo "<p class='fs-5 fw-bold'>{$name_first11Arr[$x]} {$name_last11Arr[$x]}</p>";
        echo "</div>"; // column
        
        // Birthdate column
        echo "<div class='col-lg-3 col-md-12 col-sm-12 mt-0  '>";
        echo "<p class='fs-5 fw-bol '><span class='fs-2 fw-bold $text'> " . date("d", strtotime($emp_birthdate11Arr[$x])) . "</span><br><span class='fs-5 $mtext'>" . date("M", strtotime($emp_birthdate11Arr[$x])) . "</span></p>";
		echo "</div>"; // column


	
        
        echo "</div>"; // row
    }
?>

		</div><!-- <div class="col-md-4"> -->
	</div><!-- <div class="row"> -->
		</div><!-- <div class="col-md-4"><h4>Birthdays</h4> -->


















		
<!-- notification rate -->





		<div class="col-md-4 p-5">
	<div class=" row">

		<div class="mt-5 rounded-2 shadow-lg border">
		<p class = "text-secondary px-5 pt-5">Rateable tickets</p>

	
	<?php
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
					if($empdepartment0!='') {
				?>
			<?php
			include '../m/notification.php';

			$param12 = count($iditsupportreq12Arr);
			if ($param12 == 0) {
				// If there are no holidays
				echo '<h5 class = "text-secondary text-center p-5">Great! You have rated everything! </h5>';
			} else {
			for ($x = 0; $x < $param12; $x++) {
				$found12 = 1;
				$ctr12 = $ctr12 + 1;
				
				?>
			
					<div class="row mx-auto p-4 my-4">
						<div class="col-md-12 col-lg-6 col-sm-12 text-left ">
			<?php
				
				echo "<p class = 'text-secondary fs-5'> Your ticket <span class = 'text-dark'>" . $ticketnum12Arr[$x] . "</span> has been approved!</p>";
				echo "<p class = 'text-secondary fs-5'>Approve Date:  <span class = 'text-dark'>". $closestamp12Arr[$x]."</span></p>";
				?>
						</div>
						<div class="col-md-12 col-lg-6 col-sm-12 text-left">
				<?php
				echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=342\" class = 'py-3 ' method=\"POST\" name=\"mitsuppreqdtl\">";
				echo "<input type=\"hidden\" name=\"idsr\" value='" . $iditsupportreq12Arr[$x] . "'>";
				echo "<input type=\"hidden\" name=\"ctgactor\" value=\"$actor\">";
				echo "<button type=\"submit\" class=\"secondarybgc p-4 rounded-3 text-white border-0\">Rate Service</button>";
				echo "</form>";
				?>
						</div>	
						</div>	
				<?php
			}
		}

			?>
				
	

			<?php
				} else {
			?>
				<div class=""><h5 class="text-danger text-center">Sorry. No department defined on your profile.</h5></div>
			<?php
				} // if($empdepartment0!='')
			?>

	


		</div><!-- <div class="col-md-4"> -->
	</div><!-- <div class="row"> -->
		</div><!-- <div class="col-md-4"><h4>Birthdays</h4> -->





<!-- holidays -->

		<div class="col-md-4 p-5">
<div class="row">
<div class="">
   
    <div class="row">
        <div class="col-md-12 mt-5 border rounded-2 shadow-lg ">
        <p class = "text-secondary px-5 pt-5">Upcoming Holidays</p>
            <div class=' p-3 bg-white  rounded-5'>
                <?php
                // query holidays of curr_year
					include("../m/qryddashhday.php");

					// display results
					$param12 = count($applic_date12Arr);

					if ($param12 == 0) {
						// If there are no holidays
						echo '<h5 class = "text-secondary text-center p-5" >No holiday</h5>';
					} else {
						// If there are holidays
						for($x = 0; $x < $param12; $x++) {
							echo '<div class="card border my-3 rounded-4 px-3">';
							echo '<div class="card-body">';
							if (date("Y-m-d", strtotime($applic_date12Arr[$x])) == date("Y-m-d", strtotime($datenow))) {
								echo "<div class='row '>";
								echo '<div class="col-md-6 pt-2">';
								echo '<p class="fs-5 text-lg-start text-center text-danger">' . $holidayname12Arr[$x] . '</p>';
								echo '</div>';
								echo '<div class="col-md-6 pt-2">';
								echo '<p class="fs-5 text-lg-end text-center text-secondary">' . date("D Y-M-d", strtotime($applic_date12Arr[$x])) . '</p>';
								echo '</div>';
							} else {
								echo "<div class='row '>";
								echo '<div class="col-lg-6 col-md-12 col-sm-12 pt-2">';
								echo '<p class="fs-5 text-lg-start text-center text-danger">' . $holidayname12Arr[$x] . '</p>';
								echo '</div>';
								echo '<div class="col-lg-6 col-md-12 col-sm-12 pt-2">';
								echo '<p class="fs-5 text-lg-end text-center text-secondary">' . date("D Y-M-d", strtotime($applic_date12Arr[$x])) . '</p>';
								echo '</div>';
							} // if
							echo '</div>';
							echo '</div>';
							echo '</div>';
						}
					}

                ?> 
            </div>
        </div><!-- <div class="col-md-4"> -->
    </div><!-- <div class="row"> -->
</div><!-- <div class="col-md-4"><h4>Holidays</h4> -->







<div class="">
  
    <div class="row">
	<div class="col-md-12 mt-5 border rounded-2 shadow-lg ">
		<p class ="text-secondary px-5 pt-5">Upcoming <?php echo "$empdepartment0"; ?> Schedule</p>
          <div class = "p-3 bg-white  rounded-5">
				
                <?php
                    // query
                    include("../m/qryddashdsched.php");
                    // display
                    $param14 = count($idscheduler14Arr);
					if ($param14 == 0) {
						// If there are no holidays
						echo '<h5 class = "text-secondary text-center p-5"> No Schedule on your department</h5>';
					} else {
                    for ($x = 0; $x < count($datefrom14Arr); $x++) {
                        echo '<div class="col">';
                        echo '<div class="card my-3 rounded-4 px-3">';
                        echo '<div class="card-body ">';
						?>
						<div class="row">

						<div class="col-lg-6 col-md-12 col-sm-12 pt-2">
							<?php echo '<p class="card-text fs-5 text-lg-start text-center text-secondary text-danger">' . $schedname14Arr[$x] . '</p>';?></div>
							<div class="col-lg-6 col-md-12 col-sm-12 pt-2">
						<?php
                        echo '<p class="card-text fs-5 text-lg-end text-center text-secondary text-secondary">';


                        if (date("Y-m-d", strtotime($datefrom14Arr[$x])) == date("Y-m-d", strtotime($dateto14Arr[$x]))) {
							
                            echo date("D Y-M-d", strtotime($datefrom14Arr[$x]));
                        } else {
                            echo date("D Y-M-d", strtotime($datefrom14Arr[$x])) . '<br>-to-<br>' . date("D Y-M-d", strtotime($dateto14Arr[$x]));
                        } // if
                        echo '</p>';
                      
						?>
						</div>
						

						</div>
						<?php
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
				}
                ?>
           </div>
        </div><!-- <div class="col-md-4"> -->
    </div><!-- <div class="row"> -->
</div><!-- <div class="col-md-4"><h4><?php echo "$empdepartment0"; ?> schedule</h4> -->

</div>
</div>







	
		</div>


	</div><!-- <div class="row"> -->
		</div><!-- <div class="container"> -->

