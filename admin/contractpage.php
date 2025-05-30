
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

    $projectId = $_GET['pid'];
	$resquery = "SELECT * from tblproject1 WHERE projectid=".$projectId;
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
?>

<h3><?php echo $projcode.' - '.$services; ?></h3>
<div class="lineBlack"></div>
<div class="form-group">
	<div class="col-md-10">
		<h4>Contract Title: <?php echo $projname; ?></h4>
	</div>
	<div style="clear: both;"></div>
</div>

<div class="form-group">
	<div class="col-md-10">
		<h4>Contract Num: <?php echo $projcode; ?></h4>
	</div>
	<div style="clear: both;"></div>
</div>

<div class="form-group">
	<div class="col-md-10">
		<h4>Contract Start Date:</h4>
		<input type="text" readonly="true" class="form-control" name="startDate" id="startDate" placeholder="Start Date">
	</div>
	<div style="clear: both;"></div>
</div>

<div class="form-group">
	<div class="col-md-10">
		<h4>Contract End Date:</h4>
		<input type="text" readonly="true" class="form-control" name="endDate" id="endDate" placeholder="End Date">
	</div>
	<div style="clear: both;"></div>
</div>

<div class="form-group">
	<div class="col-md-10">
		<h4>Contract Type:</h4>
		<input type="text" readonly="true" class="form-control" name="contractType" id="contractType" placeholder="Contract Type">
	</div>
	<div style="clear: both;"></div>
</div>

<div class="form-group">
	<div class="col-md-10">
		<h4>Contract Type:</h4>
		<input type="text" readonly="true" class="form-control" name="contractType" id="contractType" placeholder="Contract Type">
	</div>
	<div style="clear: both;"></div>
</div>

<div class="form-group">
	<div class="col-md-10">
		<h4>Contract Mobilized:</h4>
		<input type="text" readonly="true" class="form-control" name="contractMobilized" id="contractMobilized" placeholder="Contract Type">
	</div>
	<div style="clear: both;"></div>
</div>

<link rel="stylesheet" type="text/css" href="tjaddons/contractpage.css">
<script src="tjaddons/contractpage.js"></script>

<?php
     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
