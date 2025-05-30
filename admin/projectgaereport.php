<?php 

include("db1.php");
include("datetimenow.php");

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

    

// start contents here
echo '<form method="post" action="projectgaereport.php?loginid='.$loginid.'">';
     ?>

      <input class='btn form-control' type="text" id="fromDate" name='fromDate' placeholder="from"  style='width:30%; text-align: left; border: 1px solid #ddd;' />
       <input class='btn form-control' type="text" id="toDate" name="toDate" placeholder="To"  style='width:30%; text-align: left; border: 1px solid #ddd;' />
       <button type="submit" class="btn btnConfirm btn-default" id="btnConfirm">Submit</button>
       </form>
	<table id="tblName" class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
        <thead>
        	<th>Project Name</th>

<?php 
     $result11="";
		$result11 = mysql_query("SELECT gaename FROM tblfingaeref ORDER BY seq ASC", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			echo "<th>".$myrow11[0]."</th>";
			}
		}




?>
	</thead>

	<tbody>
		<?php 

			// $gaeref = "SELECT * FROM tblfingaeref ORDER BY seq ASC";
	  //    	$gaerefResult = $dbh2->query($gaeref);
	  //    	while($rowGae = $gaerefResult->fetch_assoc()) 
	  //    	{
	     		
	  //    	}

			// $gaeref = "SELECT * FROM tblfindisbursement WHERE (glcode>='70.00.000' AND glcode<='70.99.999') AND glrefver=2 GROUP BY projcode";
	  //    	$gaerefResult = $dbh2->query($gaeref);
	  //    	while($rowGae = $gaerefResult->fetch_assoc()) 
	  //    	{

					if(isset($_POST['fromDate']))
					{
		  				$fromDate = date('Y-m-d',strtotime($_POST['fromDate']));
						$toDate = date('Y-m-d',strtotime($_POST['toDate']));
						
						$resquery = "SELECT * from tblproject1 ORDER BY proj_code ASC";
					    $result = $dbh2->query($resquery);
						    while($myrow = $result->fetch_assoc()) {
						    	$grandTotal = 0;
						    	
						    	// disbursement query
						    	$disbursementValidate = "SELECT DISTINCT * from tblfindisbursement WHERE (glcode>='70.00.000' AND glcode<='70.99.999') AND date BETWEEN '".$fromDate."' AND '".$toDate."' AND glrefver=2 AND projcode = '".$myrow['proj_code']."'";
					    		$disbursementValidateResult = $dbh2->query($disbursementValidate);
						    	
						    	// acctspayable query
					    		$acctspayableValidate = "SELECT DISTINCT * from tblfinacctspayable WHERE (glcode>='70.00.000' AND glcode<='70.99.999') AND date BETWEEN '".$fromDate."' AND '".$toDate."' AND glrefver=2 AND projcode = '".$myrow['proj_code']."'";
					    		$acctspayableValidateResult = $dbh2->query($acctspayableValidate);

					    		// cash receipt query
					    		$cashreceiptValidate = "SELECT DISTINCT * from tblfincashreceipt WHERE (glcode>='70.00.000' AND glcode<='70.99.999') AND date BETWEEN '".$fromDate."' AND '".$toDate."' AND glrefver=2 AND projcode = '".$myrow['proj_code']."'";
					    		$cashreceiptValidateResult = $dbh2->query($cashreceiptValidate);

					    		// journal query
					    		$journalValidate = "SELECT DISTINCT * from tblfinjournal WHERE (glcode>='70.00.000' AND glcode<='70.99.999') AND date BETWEEN '".$fromDate."' AND '".$toDate."' AND glrefver=2 AND projcode = '".$myrow['proj_code']."'";
					    		$journalValidateResult = $dbh2->query($journalValidate);


					    		if( $disbursementValidateResult->num_rows > 0 || $acctspayableValidateResult->num_rows > 0 || $cashreceiptValidateResult->num_rows > 0 || $journalValidateResult->num_rows > 0)
					    		{

					    			echo "<tr>";

							    	$gaeReference = "SELECT * FROM tblfingaeref ORDER BY seq ASC";
							     	$gaeReferenceResult = $dbh2->query($gaeReference);
							     	while($rowGaeReference = $gaeReferenceResult->fetch_assoc()) 
							     	{
							    		$total = 0;

							    		// disbursement query
								    	$disbursementValidate = "SELECT * from tblfindisbursement WHERE (glcode>='70.00.000' AND glcode<='70.99.999') AND date BETWEEN '".$fromDate."' AND '".$toDate."' AND glrefver=2";
							    		$disbursementValidateResult = $dbh2->query($disbursementValidate);


									}
							    	echo "<td>".$myrow['proj_code']." - " .$myrow['proj_fname'] ." ". $myrow['proj_sname']."</td>";


							    	


							    	echo "</tr>";

					    		}



						    	
						    	
						    }
					    }
	     	// }

		?>
	</tbody>
</table>

<?php
//end contents here

    

     $result123 = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>

<script>
	$(document).ready(function(){
        $('#fromDate').datepicker();
        $('#toDate').datepicker();
    });
</script>