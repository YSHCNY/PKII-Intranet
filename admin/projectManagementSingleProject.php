
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
    if(isset($_GET['pid']))
    {
    	$projectId = $_GET['pid'];
		$resquery = "SELECT * from tblproject1 WHERE projectid=".$projectId;
    }
    if(isset($_GET['projcode'])){
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
			<div class="col-md-12">
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
				
			</div>
		
		<div class="thirdRow">
			<?php 
				echo '<a href="projectManagementMilestones.php?pid='.$projectId.'&loginid='.$_GET['loginid'].'" class="btn btn-info">Project Milestones</a>';
			?>
		</div>
	</div>	
</div>



<link rel="stylesheet" type="text/css" href="tjaddons/projectmanagement.css">
<script src="tjaddons/charts.js"></script>
<script src="tjaddons/projectmanagement.js"></script>

<?php



     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminloginid=$loginid", $dbh);

}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

