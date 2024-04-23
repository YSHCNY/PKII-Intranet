
<?php 
include("db1.php");
$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

    if(isset($_GET['pid'])) {
    	$projectId = $_GET['pid'];
		$resquery = "SELECT * from tblproject1 WHERE projectid=".$projectId;
    }

    if(isset($_GET['projcode'])) {
    	$projectId = $_GET['projcode'];
		$resquery = "SELECT * from tblproject1 WHERE proj_code='".$projectId."'";
		$contractid = $_GET['contractid'];
    }
		
	$result = $dbh2->query($resquery);

	$projname = '';
	$projcode = '';
	$datestart = '';
	$services = '';
	$projclass = '';

	while($myrow = $result->fetch_assoc()) {
		$projname = $myrow['proj_fname'];
		$projcode = $myrow['proj_code'];
		$datestart = $myrow['date_start'];
		$services = $myrow['proj_sname'];
		$projclass = $myrow['proj_class'];
	} 
	$people = "SELECT * FROM tblprojassign INNER JOIN tblcontact ON tblprojassign.employeeid=tblcontact.employeeid WHERE tblprojassign.proj_name='".$services."' GROUP BY tblcontact.name_last ORDER BY tblcontact.name_last ASC ";
	$peopleresult = $dbh2->query($people);
?>

<div id="projectDetails" class="projectDetailsContainer">
	<div id="projectDetails" class="projectDetailsWrapper">
		<div class="firstRow">
			<div class="col-md-7">
				<h3><?php echo $projcode.' - '.$projname; ?></h3>
				<h5 id='projacro'><?php echo $services; ?></h5>
				<div class="col-md-6">
					<h5>Date Started: <?php echo date('F d, Y', strtotime($datestart)); ?></h5>
				</div>
				<div class="col-md-6">
					<h5>Project Class: <?php echo $projclass; ?></h5>
				</div>
				<div class="firstRowColumn">
					<h3>People</h3>
					<?php 
						while($myrowpeople = $peopleresult->fetch_assoc()) {
							echo "<div class='col-md-6'>";
							echo '<h5>'.$myrowpeople['name_first'].' '.$myrowpeople['name_last'].'</h5>' ;
							echo "</div>";	
						} 
					?>
				</div>
				<div style="clear: both;"></div>
				<div class="secondRowColumn">
					<div class="col-md-6 no-padding-left">
						<h3>Received Payments</h3>
						<div id="leftPayment" class="col-md-6 borderGray">
							<h4>Today</h4>
							<h5>PHP 0.00</h5>
						</div>
						<div id="rightPayment" class="col-md-6 borderGray">
							<h4>This Month</h4>
							<h5>PHP 26,500.00</h5>
						</div>
					</div>
					<div class="col-md-6 no-padding-right">
						<h3>Invoices</h3>
						<div id="leftInvoice" class="col-md-6 borderGray">
							<h4>Due</h4>
							<h5>PHP 29,350.00</h5>
						</div>
						<div id="rightInvoice" class="col-md-6 borderGray">
							<h4>Overdue</h4>
							<h5>PHP 12,500.00</h5>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div id='commentSection'>
					<h4>Comments</h4>
					<div id="line"></div>
					<div id="messagecontainer">
						<div id="messageDiv" class="messageDiv">
							
						</div>
					</div>
					<div id="messagesubmit">
						<div class="col-md-9">
							<textarea placeholder="Comment Here...." id="commentTextArea" class="form-control"></textarea>
						</div>
						<div class="col-md-3">
							<button type="button" id="btnSubmit" class="btn btn-success">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
		<div class="secondRow">
			<div id="graphContainer">
			</div>
		</div>
		<div class="thirdRow">
			<?php 
			echo 	'<a class="btn btn-info" >View All Invoices</a>';
			echo 	'<a href="projectreports.php?pid='.$projectId.'&loginid='.$_GET['loginid'].'" class="btn btn-info">View All Reports</a>';
			echo "<form action='projbilldtls.php?loginid=".$_GET['loginid']."' method='POST' id='contractForm' name='projbilldtls'>";
			echo "<input type='hidden' name='contractid' value='$contractid'>";
			echo "<input type='hidden' name='projcode' value='$projcode'>";
			echo "<button type='submit' class='btn btn-info'>View Contract</button>";
			echo "</form>";
			?>
		</div>
	</div>	
</div>



<link rel="stylesheet" type="text/css" href="tjaddons/projectmanagement.css">
<script src="tjaddons/charts.js"></script>
<script src="tjaddons/projectmanagement.js"></script>

<?php

echo "<p><a href='./projbilling.php?loginid=$loginid' class='btn btn-default' role='button'>back</a></p>";

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
