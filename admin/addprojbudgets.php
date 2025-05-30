<?php 
	$budgetDebits = $_POST['budgetdebit'];
	$projectCode = $_POST['pid'];

	$resquerySecondary = "SELECT * from tblfinprojinsecondary WHERE status='1'";
    $resultSecond = $dbh2->query($resquerySecondary);
    
     while($myrow = $resultSecond->fetch_assoc()) {
     	$id = $myrow['projinsecondary_id'];

     	$resqueryBudget = "SELECT * from tblfinprojincomestatement WHERE proj_code='".$projectCode."' AND fk_projinsecondary_id =".$myrow['projinsecondary_id'];
        $resultBudget = $dbh2->query($resqueryBudget);

        if($resultBudget->num_rows > 0){
     		while($myrowResultBudget = $resultBudget->fetch_assoc()) {
				$incomeStatementId = $myrowResultBudget['incomestatement_id'];
			}
        	$debit = $budgetDebits[$id];
        	// $credit = $budgetCredits[$id];
            $result = mysql_query("UPDATE tblfinprojincomestatement SET budget_debit=".$debit." WHERE incomestatement_id = ".$incomeStatementId, $dbh); 
        } 
        else{
            $result = mysql_query("INSERT INTO tblfinprojincomestatement SET proj_code='".$projectCode."', budget_debit=".$budgetDebits[$id].", fk_projinsecondary_id=".$id, $dbh);
        }
     }


?>