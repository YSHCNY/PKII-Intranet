<table class='table table-striped table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
	<thead>

	</thead>
	<tbody>
		<?php 
			// include("db1.php");

			// $projcode = 'C2013-02';

			$resqueryPrimary = "SELECT * from tblfindisbursement WHERE projcode='".$projcode."' GROUP BY YEAR(date)";
			$resultPrimary = $dbh2->query($resqueryPrimary);
			$test = [];


			echo '<tr>';
			echo '<td> </td>';
			while($myrowPrimary = $resultPrimary->fetch_assoc()) {
				$yrs = date('Y', strtotime($myrowPrimary['date']));
				echo '<td><b>'.$yrs.'</b></td>';
				array_push($test, $yrs);

			}
			echo '</tr>';

					echo '<tr>';
					echo '<td>Disbursements</td>';
					foreach ($test as $key => $year) {
						$gtotalDisbursement = 0;
						$subDisbursement = "SELECT * FROM tblfindisbursement WHERE projcode = '".$projcode."' AND date like '%".$year."%'";
				        $subDisbursementResult = $dbh2->query($subDisbursement);
				        while($rowDisbursement = $subDisbursementResult->fetch_assoc()) 
				        {
				          	if(($rowDisbursement['glcode'] >= "10.00.000") && ($rowDisbursement['glcode'] <= "10.40.140")) {
				              $gtotalDisbursement += $rowDisbursement['debitamt'];
				              $gtotalDisbursement -= $rowDisbursement['creditamt'];
				            }

				            else if(($rowDisbursement['glcode'] >= "20.00.000") && ($rowDisbursement['glcode'] <= "50.10.400")) {
				              $gtotalDisbursement -= $rowDisbursement['debitamt'];
				              $gtotalDisbursement += $rowDisbursement['creditamt'];
				            }

				            else if(($rowDisbursement['glcode'] >= "60.00.000") && ($rowDisbursement['glcode'] <= "72.00.000")) {
				              $gtotalDisbursement += $rowDisbursement['debitamt'];
				              $gtotalDisbursement -= $rowDisbursement['creditamt'];
				            }

				            else if(($rowDisbursement['glcode'] >= "80.00.000") && ($rowDisbursement['glcode'] <= "90.00.000")) {
				              $gtotalDisbursement -= $rowDisbursement['debitamt'];
				              $gtotalDisbursement += $rowDisbursement['creditamt'];
				            }
				        }
				        echo '<td>'.number_format($gtotalDisbursement,2).'</td>';
					}

					echo '</tr>';

					echo '<tr>';
					echo '<td>CashReceipts</td>';
					foreach ($test as $key => $year) {
					
						$gtotalCashReceipt = 0;
   						$subCashReceipt = "SELECT * FROM tblfincashreceipt WHERE projcode = '".$projcode."' AND date like '%".$year."%'";
				        $subCashReceiptResult = $dbh2->query($subCashReceipt);
				        while($rowCashReceipt = $subCashReceiptResult->fetch_assoc()) 
				        {
				          	if(($rowCashReceipt['glcode'] >= "10.00.000") && ($rowCashReceipt['glcode'] <= "10.40.140")) {
				              $gtotalCashReceipt -= $rowCashReceipt['debitamt'];
				              $gtotalCashReceipt += $rowCashReceipt['creditamt'];
				            }

				            else if(($rowCashReceipt['glcode'] >= "20.00.000") && ($rowCashReceipt['glcode'] <= "50.10.400")) {
				              $gtotalCashReceipt += $rowCashReceipt['debitamt'];
				              $gtotalCashReceipt -= $rowCashReceipt['creditamt'];
				            }

				            else if(($rowCashReceipt['glcode'] >= "60.00.000") && ($rowCashReceipt['glcode'] <= "72.00.000")) {
				              $gtotalCashReceipt -= $rowCashReceipt['debitamt'];
				              $gtotalCashReceipt += $rowCashReceipt['creditamt'];
				            }

				            else if(($rowCashReceipt['glcode'] >= "80.00.000") && ($rowCashReceipt['glcode'] <= "90.00.000")) {
				              $gtotalCashReceipt += $rowCashReceipt['debitamt'];
				              $gtotalCashReceipt -= $rowCashReceipt['creditamt'];
				            }
				        }
				        echo '<td>'.number_format($gtotalCashReceipt,2).'</td>';

					}

					echo '</tr>';

					echo '<tr>';
					echo '<td>Journals</td>';
					foreach ($test as $key => $year) {
						$gtotalJournal = 0;
				        $subJournal = "SELECT * FROM tblfinjournal WHERE projcode = '".$projcode."' AND date like '%".$year."%'";
				        $subJournalResult = $dbh2->query($subJournal);
				        while($rowJournal = $subJournalResult->fetch_assoc()) 
				        {
				          	if(($rowJournal['glcode'] >= "10.00.000") && ($rowJournal['glcode'] <= "10.40.140")) {
				              $gtotalJournal += $rowJournal['debitamt'];
				              $gtotalJournal -= $rowJournal['creditamt'];
				            }

				            else if(($rowJournal['glcode'] >= "20.00.000") && ($rowJournal['glcode'] <= "50.10.400")) {
				              $gtotalJournal -= $rowJournal['debitamt'];
				              $gtotalJournal += $rowJournal['creditamt'];
				            }

				            else if(($rowJournal['glcode'] >= "60.00.000") && ($rowJournal['glcode'] <= "72.00.000")) {
				              $gtotalJournal += $rowJournal['debitamt'];
				              $gtotalJournal -= $rowJournal['creditamt'];
				            }

				            else if(($rowJournal['glcode'] >= "80.00.000") && ($rowJournal['glcode'] <= "90.00.000")) {
				              $gtotalJournal -= $rowJournal['debitamt'];
				              $gtotalJournal += $rowJournal['creditamt'];
				            }
				        }
				        echo '<td>'.number_format($gtotalJournal,2).'</td>';
					}

					echo '</tr>';


						



						






			

		?>
	</tbody>
</table>


<style>
	table{
		padding: 0;
		margin: 0;
	}
	table td{
		padding:0;
		margin: 0;
		border: 1px solid #000000;
	}
</style>

