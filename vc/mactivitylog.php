<?php
//
// mactivitylog.php
// fr: vc/index.php

$yyyymm0 = (isset($_GET['ms'])) ? $_GET['ms'] :'';
$cutmonth0 = (isset($_GET['cm'])) ? $_GET['cm'] :'';

$yyyymm = (isset($_POST['monsel'])) ? $_POST['monsel'] :'';
$cutmonth = (isset($_POST['cutmonth'])) ? $_POST['cutmonth'] :'';

if($yyyymm0!='') { $yyyymm=$yyyymm0; }
if($cutmonth0!='') { $cutmonth=$cutmonth0; }

if(($yyyymm == "") || ($yyyymm == "")) {
	$cutstart = date("Y-m-01", strtotime($datenow));
} else {
	$cutstart = $yyyymm."-"."01";
} // if

if($cutmonth == "") { $cutmonth="0"; }

if($cutmonth == "0") {
  $cutend = date("Y-m-t", strtotime("$cutstart"));
} else if($cutmonth == "1") {
	$cutstartarr = explode("-", $cutstart);
	$cutstartyyyy = $cutstartarr[0];
	$cutstartmm = $cutstartarr[1];
	$cutstartdd = $cutstartarr[2];
	$cutend = $cutstartyyyy . "-" . $cutstartmm . "-" . "15";
} else if($cutmonth == "2") {
  $cutend = date("Y-m-t", strtotime("$cutstart"));
	$cutstartarr = explode("-", $cutstart);
	$cutstartyyyy = $cutstartarr[0];
	$cutstartmm = $cutstartarr[1];
	$cutstartdd = $cutstartarr[2];
	$cutstart = $cutstartyyyy . "-" . $cutstartmm . "-" . "16";
} // if

// init vars
$tottimeduredr=0;

?>
<br>

	
	

	<div class="">
		<div class=" p-5 mainbgc" >
		<h3 class = "text-white fs-3 mt-5 pt-4 ms-5 ps-5 ">My Activity Log</h3>
<div class="container">
	<div class=" flex bg-white shadow-lg  rounded-4 mb-5 ">
	
		<div class="row mx-auto d-flex justify-content-center align-items-center py-5">
	
			<div class="col-12 text-center my-3 col-md-auto ">
<!-- Button trigger modal -->
<button type="button" class="btn bg-success text-white p-3 rounded-4"  data-toggle="modal" data-target="#staticBackdrop">
Add Activity
</button>	</div>

<!-- Modal -->
<div class="modal fade " id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  ">
    <div class="modal-content ">
      <div class="modal-header mx-auto ">
        <h5 class="modal-title border-0"  id="staticBackdropLabel">Activity Log</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body" >
       <?php include 'mactivitylogfrm.php'; ?>
      </div>
      <div class="modal-footer border-0"">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

<script>
// Function to close the modal
function closeModal() {
	// Custom action after form submission
	alert("Form submitted successfully!");
	location.reload();

}
</script>


	<!-- </form> -->

	
	<div class="col-12 text-center text-lg-start col-md-auto">
<?php
	echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=14\" method=\"POST\" name=\"mactivitylog\">";
	include("../m/qrymactivitylog.php");
?>
<div class="row g-2 mx-3 p-4  flex justify-content-center align-items-center text-center">

	<h6 class = 'maintext'>Display By:</h6>


	<div class="col-lg-4 col-12 ">

	<select class = "monsel rounded-3 px-3 py-2 border-0 fs-5 "  name="monsel" id='monsel'>
<?php
	$param11 = count($yyyymm11Arr);
	for($x = 0; $x < $param11; $x++) {
		if($yyyymm11Arr[$x]==$yyyymm) { $yyyymmsel="selected"; } else { $yyyymmsel=""; }
		echo "<option value=\"".$yyyymm11Arr[$x]."\" $yyyymmsel>".date("Y-M", strtotime($yyyymm11Arr[$x]))."</option>";
	} // for
?>
	</select>
	</div>

	<div class="col-lg-4 col-12 ">
	<select class = "cutmonth rounded-3  px-3 py-2 border-0 fs-5" name="cutmonth"  id='cutmonth'>
<?php
	if($cutmonth == "0") { $cutmo0sel="selected"; $cutmo1sel=""; $cutmo2sel=""; }
	else if($cutmonth == "1") { $cutmo0sel=""; $cutmo1sel="selected"; $cutmo2sel=""; }
	else if($cutmonth == "2") { $cutmo0sel=""; $cutmo1sel=""; $cutmo2sel="selected"; }
	else { $cutmo0sel="selected"; $cutmo1sel=""; $cutmo2sel=""; }
?>
	<option value="0" <?php echo $cutmo0sel; ?>>whole month</option>
	<option value="1" <?php echo $cutmo1sel; ?>>1st half</option>
	<option value="2" <?php echo $cutmo2sel; ?>>2nd half</option>
	</select>
	</div>
	</div>


	</div>

<div class="col-12 text-center my-3 col-md-auto">
	<button class="border-0 p-3 text-white rounded-4" id = "checkbtn">Display
</button>
	

	</form>
	</div>

	</div>
	</div>
	</div>



	<?php
	if (isset($_SESSION['editsuccess']) && $_SESSION['editsuccess']) {
			// Display success alert
			echo '<div class = "container"><div id="success-alert" class="alert-success my-4 text-success rounded-4 border transition delay-200 px-4 py-4 relative" role="alert">
					<strong class="font-bold">Updated!</strong>
					<span class="block sm:inline">Entry has been updated!</span>
				  </div></div>';
			// Unset the session variable to prevent displaying the alert again on page refresh
			unset($_SESSION['editsuccess']);
		
			
		}
		?>
		<script>
				  
					const successAlertedit = document.getElementById('success-alert');
					setTimeout(function() {
						successAlertedit.style.opacity = '0';
						setTimeout(function() {
							successAlertedit.style.display = 'none';
						},300); 
					}, 3000);
				</script>
	

	
<?php
	if (isset($_SESSION['addsuccess']) && $_SESSION['addsuccess']) {
			// Display success alert
			echo '<div class = "container"><div id="success-alert-edit" class="alert-primary text-white bg-primary my-4 rounded-4 border transition delay-200 px-4 py-4 relative" role="alert">
					<strong class="font-bold">Added!</strong>
					<span class="block sm:inline">New entry has been successfully added!</span>
				  </div></div>';
			// Unset the session variable to prevent displaying the alert again on page refresh
			unset($_SESSION['addsuccess']);
		
			
		}
		?>
		<script>
				  
					const successAlerteditadd = document.getElementById('success-alert-edit');
					setTimeout(function() {
						successAlerteditadd.style.opacity = '0';
						setTimeout(function() {
							successAlerteditadd.style.display = 'none';
						},300); 
					}, 3000);
				</script>
				
<?php
	// echo "<a href=\"mactivitylogprtvw.php?lst=1&lid=$loginid&sess=$session&p=142&cm=$cutmonth&ms=$monsel\" target=\"_blank\"><i>Printable view</i></a>";
	// echo "<form action=\"mactivitylogprtvw.php?lst=1&lid=$loginid&sess=$session&p=142&cm=$cutmonth&ms=$monsel\" method=\"get\" name=\"mactivitylogprtvw\">";
	echo "<form action=\"mactivitylogprtvw.php\" method=\"POST\" name=\"mactivitylogprtvw\">";
		echo "<input type=\"hidden\" name=\"lst\" value=\"1\">";
		echo "<input type=\"hidden\" name=\"lid\" value=\"$loginid\">";
		echo "<input type=\"hidden\" name=\"sess\" value=\"$session\">";
		echo "<input type=\"hidden\" name=\"p\" value=\"142\">";
		echo "<input type=\"hidden\" name=\"cm\" value=\"$cutmonth\">";
		echo "<input type=\"hidden\" name=\"ms\" value=\"$yyyymm\">";
		?>
		<div class="container mx auto justify-content-center align-items-center d-flex">
		<?php
		echo "<button type=\"submit\" class=\"border-0 p-3 rounded-4\" formtarget=\"_blank\">Printable view <svg width=\"25\" height=\"25\" viewBox=\"0 0 25 25\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
			<mask id=\"mask0_31_927\" style=\"mask-type:alpha\" maskUnits=\"userSpaceOnUse\" x=\"0\" y=\"0\" width=\"25\" height=\"25\">
			<rect width=\"25\" height=\"25\" fill=\"#D9D9D9\"/>
			</mask>
			<g mask=\"url(#mask0_31_927)\">
			<path d=\"M16.6666 8.33333V5.20833H8.33325V8.33333H6.24992V3.125H18.7499V8.33333H16.6666ZM18.7499 13.0208C19.0451 13.0208 19.2925 12.921 19.4921 12.7214C19.6918 12.5217 19.7916 12.2743 19.7916 11.9792C19.7916 11.684 19.6918 11.4366 19.4921 11.237C19.2925 11.0373 19.0451 10.9375 18.7499 10.9375C18.4548 10.9375 18.2074 11.0373 18.0077 11.237C17.8081 11.4366 17.7083 11.684 17.7083 11.9792C17.7083 12.2743 17.8081 12.5217 18.0077 12.7214C18.2074 12.921 18.4548 13.0208 18.7499 13.0208ZM16.6666 19.7917V15.625H8.33325V19.7917H16.6666ZM18.7499 21.875H6.24992V17.7083H2.08325V11.4583C2.08325 10.5729 2.38707 9.83073 2.99471 9.23177C3.60235 8.63281 4.3402 8.33333 5.20825 8.33333H19.7916C20.677 8.33333 21.4192 8.63281 22.0182 9.23177C22.6171 9.83073 22.9166 10.5729 22.9166 11.4583V17.7083H18.7499V21.875ZM20.8333 15.625V11.4583C20.8333 11.1632 20.7334 10.9158 20.5338 10.7161C20.3341 10.5165 20.0867 10.4167 19.7916 10.4167H5.20825C4.91311 10.4167 4.66572 10.5165 4.46606 10.7161C4.26641 10.9158 4.16659 11.1632 4.16659 11.4583V15.625H6.24992V13.5417H18.7499V15.625H20.8333Z\" fill=\"#0A1D44\"/>
			</g>
			</svg>
			</button>";
			?>
			</div>
			<?php
			
	echo "</form>";
?>

		</div>
	
	</div> <!-- div class=row -->


<div class="container">

		


<!-- <table class="table-sm  p-5 mx-auto  rounded-4" >
<thead  class = 'text-center '>
	<tr class = 'fs-5'> -->
		<!-- <th  class = 'text-center'>Date</th>
		<th  class = 'text-center'>Day</th> -->

	<!-- <th class = 'text-center'>WFH</th>
	<th class = 'text-center'>Activity</th>
	<th class = 'text-center'>Action</th>
	<th class = 'text-center'>Work hours</th>
	<th class = 'text-center'>Hours Rendered</th> -->
<!-- </tr>
</thead> -->



<!-- </table> -->
	


<?php include 'actlogtbl.php';?>
</div>











	
<!-- start modal popup window -->
<div class="modal fade" id='myModal' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><font color="red">Deleting Activity log</font></h5>
        
      </div>
      <!-- <div class="modal-body" id='myModalBody'> -->
			<div>
			<h4 class="modal-title" id="myModalLabel">Are you sure?<br></h4>
    
      </div>
      <div class="modal-footer">
<?php
		echo "<form action=\"mactivitylogdel.php?lst=1&lid=$loginid&sess=$session&p=144\" method=\"POST\" name=\"mactivitylogdel\">";
			echo "<button type=\"submit\" class=\"btn btn-success\" id='btnYesDelete'>Yes</button>";
			echo "<input type=\"hidden\" name=\"aid\" id='recordid' />";
			echo "<input type=\"hidden\" name=\"ms\" id='ms' />";
			echo "<input type=\"hidden\" name=\"cm\" id='cm' />";
			echo "<input type=\"hidden\" name=\"idl\" id='idl' />";			
			echo "&nbsp;&nbsp;<button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\" id='btnCloseRedir'>No</button>";
		echo "</form>";
?>
      </div>
    </div>
  </div>
</div>
<!-- end modal popup window -->

<!-- <script>
        // Function to fetch and update table body
        function updateTable() {
            fetch('actlogtbl.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('myTable').innerHTML = data;
                })
                .catch(error => console.error('Error fetching table body:', error));
        }

        // Initial update
        updateTable();

        // Periodically update the table every 5 seconds (adjust as needed)
        setInterval(updateTable, 5000); // 5000 milliseconds = 5 seconds
    </script> -->


	<button id="scrollToBottomBtn" title = 'to save all entries' onclick="scrollToBottom()"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#FFFFFF" class="bi bi-chevron-double-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
  <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
</svg></button>

	<style>
		#scrollToBottomBtn {
  position: fixed;
  bottom: 80px;
  right: 20px;
 
  background-color: GREEN;
  color: #fff;
  border: none;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  font-size: 18px;
  cursor: pointer;


  
}



	</style>
<script>
// window.addEventListener('scroll', function() {
//   var scrollToBottomBtn = document.getElementById('scrollToBottomBtn');
//   // Adjust 'scrollThreshold' to set when the button appears
//   var scrollThreshold = 120; // Adjust this value as needed
  
//   if (window.scrollY > scrollThreshold) {
//     scrollToBottomBtn.style.display = 'block';
//   } else {
//     scrollToBottomBtn.style.display = 'none';
//   }
// });

function scrollToBottom() {
  window.scrollTo({
    top: document.body.scrollHeight,
    behavior: 'smooth'
  });
}


$(document).ready(function(){

	$('body').delegate('.btnActlogDelete','click',function(){
			var recordId = $(this).data('id');
			$('#recordid').val(recordId);
			$('#ms').val($('#monsel').val());
			$('#cm').val($('#cutmonth').val());
			$('#idl').val($('#loginid').val());
	});

});



</script>


