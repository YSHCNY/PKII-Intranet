 <?php
 	if(isset($_POST['budgetdebit'])){
      include ("addprojbudgets.php");
     }
	 echo "<form action=\"setbudgets.php?loginid=$loginid\" method=\"post\">";
 ?>
 	<input type="hidden" value="<?php echo $projcode; ?>" name='pid' id='pid'/>
	<button style="margin-top:15px;" id="btnSetBudget" class="btn btn-primary">Set Budgets</button>
<?php 
	echo '</form>';
?>
<table class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
	<thead>
		<th colspan="2">Acct Name</th>
        <th>Acct Code</th>
        <th colspan="1">Budget</th>
        <th colspan="1">Actual</th>
        <th colspan="1">Variance</th>
        <th>%</th>
        <th>% Utilization</th>
	</thead>
	<tbody>
		<?php 
			$resqueryPrimary = "SELECT * from tblfinprojinprimary WHERE status='1'";
			$resultPrimary = $dbh2->query($resqueryPrimary);

			$grandTotalBudget = 0;
			$grandTotalActual = 0;
			$grandTotalVariance = 0;
			$grandTotalPercentage = 0;
			$grandTotalPercentageU = 0;

			$revenueTotalBudget = 0;
			$revenueTotalActual = 0;
			$revenueTotalVariance = 0;

			while($myrowPrimary = $resultPrimary->fetch_assoc()) {
				echo '<tr>';
					echo '<td colspan="2"><b>'.$myrowPrimary['account_name'].'</b></td>';
					echo '<td colspan="1"><b>'.$myrowPrimary['account_code'].'</b></td>';
					echo '<td colspan="7"> </td>';
				echo '</tr>';
				$primaryTotalBudget = 0;
				$primaryTotalVariance = 0;
				$primaryTotalActual = 0;
				$primaryTotalPercentage = 0;
				$primaryTotalPercentageU = 0;

				$resquerySecondary = "SELECT * from tblfinprojinsecondary WHERE status='1' AND fk_projinprimary_id =".$myrowPrimary['projinprim_id'];
				$resultSecondary = $dbh2->query($resquerySecondary);

				while($myrowSecondary = $resultSecondary->fetch_assoc()) {
					echo '<tr>';
						echo '<td colspan="1"> </b></td>';
						echo '<td colspan="1">'.$myrowSecondary['secondary_account_name'].'</td>';
						echo '<td colspan="1">'.$myrowSecondary['acctcode_from'].' - '.$myrowSecondary['acctcode_to'].'</td>';

						//budget
						$resqueryBudget = "SELECT * from tblfinprojincomestatement WHERE proj_code='".$projcode."' AND fk_projinsecondary_id =".$myrowSecondary['projinsecondary_id'];
						$resultBudget = $dbh2->query($resqueryBudget);

						if($resultBudget->num_rows > 0){
							while($myrowBudget = $resultBudget->fetch_assoc()) {
								$budgetDebit = $myrowBudget['budget_debit'];
								$budgetCredit = $myrowBudget['budget_credit'];
								echo '<td colspan="1" align="right">'.number_format($budgetDebit,2).'</td>';
								// echo '<td colspan="1">'.number_format($budgetCredit,2).'</td>';
							} 
						}	
						else{
							echo '<td colspan="1" align="right">0.00</td>';
							// echo '<td colspan="1">0.00</td>';
							$budgetCredit = 0;
							$budgetDebit = 0;
						}
						

						//actual
						$subDisbursement = "SELECT SUM(debitamt) as gtotaldebit, SUM(creditamt) as gtotalcredit FROM tblfindisbursement WHERE projcode = '".$projcode."' AND glcode >= '".$myrowSecondary['acctcode_from']."' AND glcode <= '".$myrowSecondary['acctcode_to']."'";
				        $subDisbursementResult = $dbh2->query($subDisbursement);
				        while($rowDisbursement = $subDisbursementResult->fetch_assoc()) 
				        {
				          $totalDisbursmentDebit = $rowDisbursement['gtotaldebit'];
				          $totalDisbursmentCredit = $rowDisbursement['gtotalcredit'];
				        }

				        $subJournal = "SELECT SUM(debitamt) as gtotaldebit, SUM(creditamt) as gtotalcredit FROM tblfinjournal WHERE projcode = '".$projcode."' AND glcode >= '".$myrowSecondary['acctcode_from']."' AND glcode <= '".$myrowSecondary['acctcode_to']."'";
				        $subJournalResult = $dbh2->query($subJournal);
				        while($rowJournal = $subJournalResult->fetch_assoc()) 
				        {
				          $totalJournalDebit = $rowJournal['gtotaldebit'];
				          $totalJournalCredit = $rowJournal['gtotalcredit'];
				        }

				         $subCashReceipt = "SELECT SUM(debitamt) as gtotaldebit, SUM(creditamt) as gtotalcredit FROM tblfincashreceipt WHERE projcode = '".$projcode."' AND glcode >= '".$myrowSecondary['acctcode_from']."' AND glcode <= '".$myrowSecondary['acctcode_to']."'";
				        $subCashReceiptResult = $dbh2->query($subCashReceipt);
				        while($rowCashReceipt = $subCashReceiptResult->fetch_assoc()) 
				        {
				          $totalCashReceiptDebit = $rowCashReceipt['gtotaldebit'];
				          $totalCashReceiptCredit = $rowCashReceipt['gtotalcredit'];
				        }
				        $totalActualDebit = $totalDisbursmentDebit + $totalJournalDebit + $totalCashReceiptDebit;
				        $totalAcutalCredit = $totalDisbursmentCredit + $totalJournalCredit + $totalCashReceiptCredit;

				        $totalActual = 0;

				        if(($myrowSecondary['acctcode_from'] >= "10.00.000") && ($myrowSecondary['acctcode_from'] <= "10.40.140")) {
				        	$totalActual = $totalActualDebit - $totalAcutalCredit;
			            }

			            else if(($myrowSecondary['acctcode_from'] >= "20.00.000") && ($myrowSecondary['acctcode_from'] <= "50.10.400")) {
				        	$totalActual =  $totalAcutalCredit -  $totalActualDebit ;
			            }

			            else if(($myrowSecondary['acctcode_from'] >= "60.00.000") && ($myrowSecondary['acctcode_from'] <= "72.00.000")) {
				        	$totalActual = $totalActualDebit - $totalAcutalCredit;
			            }

			            else if(($myrowSecondary['acctcode_from'] >= "80.00.000") && ($myrowSecondary['acctcode_from'] <= "90.00.000")) {
				        	$totalActual =  $totalAcutalCredit -  $totalActualDebit ;
			            }

						echo '<td colspan="1" align="right">'.number_format($totalActual,2).'</td>';
						// echo '<td colspan="1">'.number_format($totalAcutalCredit,2).'</td>';
						
						// compute total for revenue accts
						if(($myrowSecondary['acctcode_from'] >= "40.10.000") && ($myrowSecondary['acctcode_to'] <= "40.10.240")) {
							$revenueTotalBudget += $budgetDebit;
							$revenueTotalActual += $totalActual;
							$revenueTotalVariance = $budgetDebit - $totalActual;
						} // if

						//variance
						$varianceDebit = $budgetDebit - $totalActual;
						$percentage = $varianceDebit/$budgetDebit * 100;
						$percentageU = $totalActual/$budgetDebit * 100;

						// $grandTotalBudget += $budgetDebit;
						// $grandTotalActual += $totalActual;
						// $grandTotalVariance += $varianceDebit;

						$primaryTotalBudget += $budgetDebit;
						$primaryTotalActual += $totalActual;
						$primaryTotalVariance += $varianceDebit;

						if($varianceDebit < 0){
							echo '<td colspan="1" align="right"><span style="color:red">('.number_format($varianceDebit * -1, 2).')</span></td>';
						}
						else{
							echo '<td colspan="1" align="right">'.number_format($varianceDebit, 2).'</td>';
						}
						if($percentage < 0){
							echo '<td colspan="1" align="right"><span style="color:red">('.number_format($percentage * -1, 2).')</span></td>';
						}
						else{
							echo '<td colspan="1" align="right">'.number_format($percentage,2).'</td>';
						}
						if($percentageU < 0){
							echo '<td colspan="1" align="right"><span style="color:red">('.number_format($percentageU * -1, 2).')</span></td>';
						}
						else{
							echo '<td colspan="1" align="right">'.number_format($percentageU,2).'</td>';
						}
						// $varianceCredit = $budgetCredit - $totalAcutalCredit;
						// echo '<td colspan="1">'.number_format($varianceCredit, 2).'</td>';
					echo '</tr>';

				}

				$primaryTotalPercentage = $primaryTotalVariance/$primaryTotalBudget * 100;
				$primaryTotalPercentageU = $primaryTotalActual/$primaryTotalBudget * 100;

				echo "<tr>";
					echo "<td colspan='3'><b>Total: </b></td>";
					echo "<td colspan='1' align='right'><b>".number_format($primaryTotalBudget,2)."</b></td>";
					echo "<td colspan='1' align='right'><b>".number_format($primaryTotalActual,2)."</b></td>";
					if($primaryTotalVariance < 0){
							echo '<td colspan="1" align="right"><span style="color:red"><b>('.number_format($primaryTotalVariance * -1, 2).')</b></span></td>';
						}
						else{
							echo '<td colspan="1" align="right"><b>'.number_format($primaryTotalVariance, 2).'</b></td>';
						}
						if($primaryTotalPercentage < 0){
							echo '<td colspan="1" align="right"><span style="color:red"><b>('.number_format($primaryTotalPercentage * -1, 2).')</b></span></td>';
						}
						else{
							echo '<td colspan="1" align="right"><b>'.number_format($primaryTotalPercentage,2).'</b></td>';
						}

						if($primaryTotalPercentageU < 0){
							echo '<td colspan="1" align="right"><span style="color:red"><b>('.number_format($primaryTotalPercentageU * -1, 2).')</b></span></td>';
						}
						else{
							echo '<td colspan="1" align="right"><b>'.number_format($primaryTotalPercentageU,2).'</b></td>';
						}

				echo "</tr>";

			} 

			// $grandTotalBudget = $primaryTotalBudget - $budgetDebit;
			// $grandTotalActual = $primaryTotalActual - $totalActual;
			// $grandTotalVariance = primaryTotalVariance - $varianceDebit;
			
			$grandTotalBudget = $revenueTotalBudget - $primaryTotalBudget;
			$grandTotalActual = $revenueTotalActual - $primaryTotalActual;
			$grandTotalVariance = $revenueTotalVariance - $primaryTotalVariance;

			$grandTotalPercentage = $grandTotalVariance/$grandTotalBudget * 100;
			$grandTotalPercentageU = $grandTotalActual/$grandTotalBudget * 100;

			echo "<tr>";
			echo "<td colspan='3'><b>Net Profit: </b></td>";

			if($grandTotalBudget < 0) {
			echo "<td colspan='1' align='right'><span style='color:red'><b>".number_format($grandTotalBudget,2)."</b></span></td>";				
			} else {
			echo "<td colspan='1' align='right'><b>".number_format($grandTotalBudget,2)."</b></td>";				
			}
			
			if($grandTotalActual < 0) {
			echo "<td colspan='1' align='right'><span style='color:red'><b>".number_format($grandTotalActual,2)."</b></span></td>";
			} else {
			echo "<td colspan='1' align='right'><b>".number_format($grandTotalActual,2)."</b></td>";				
			}

			if($grandTotalVariance < 0){
				echo '<td colspan="1" align="right"><span style="color:red"><b>('.number_format($grandTotalVariance * -1, 2).')</b></span></td>';
			} else {
				echo '<td colspan="1" align="right"><b>'.number_format($grandTotalVariance, 2).'</b></td>';
			}

			if($grandTotalPercentage < 0){
				echo '<td colspan="1" align="right"><span style="color:red"><b>('.number_format($grandTotalPercentage * -1, 2).')</b></span></td>';
			} else {
				echo '<td colspan="1" align="right"><b>'.number_format($grandTotalPercentage,2).'</b></td>';
			}

			if($grandTotalPercentageU < 0){
				echo '<td colspan="1" align="right"><span style="color:red"><b>('.number_format($grandTotalPercentageU * -1, 2).')</b></span></td>';
			} else {
				echo '<td colspan="1" align="right"><b>'.number_format($grandTotalPercentageU,2).'</b></td>';
			}
			echo "</tr>";

		?>
	</tbody>
</table>



