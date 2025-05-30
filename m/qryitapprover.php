<?php
//
// qryitapprover.php
// fr: ../vc/menu.php
//

require '../includes/dbh.php';

	$res10query="SELECT iditsupportapprover, deptcd FROM tblitsupportapprover WHERE approver1empid=\"$employeeid0\" OR approver2empid=\"$employeeid0\" LIMIT 1";
	$result10=""; $activesw10=''; $found10=0;
	$result10=$dbh->query($res10query);
	if($result10->num_rows>0) {
		while($myrow10 = $result10->fetch_assoc()) {
		$found10=1;
		$iditsupportapprover10 = $myrow10['iditsupportapprover'];
		$deptcd10 = $myrow10['deptcd'];
		} // while
	} // if
		
$dbh->close();
?>
