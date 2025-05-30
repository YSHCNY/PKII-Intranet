<?php

						// query remarks from tblhrtaemptimelog
						$res19select="SELECT idhrtaemptimelog, remarks FROM tblhrtaemptimelog WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup AND idcutoff=$idcutoff AND logdate=\"$n\"";
						$result19=""; $found19=0; $ctr19=0;
						$result19 = mysql_query("$res19select", $dbh);
						if($result19 != "") {
							while($myrow19 = mysql_fetch_row($result19)) {
							$found19 = 1;
							$idhrtaemptimelog19 = $myrow19[0];
							$remarks19 = $myrow19[1];
							}
						}
						$remarksfin = $remarks19 . "&nbsp;warning: $leavetypeval leave credit quota reaches maximum. not deducted.";
						// update query
						if($found19 == 1) { 
						$res20update="UPDATE tblhrtaemptimelog SET remarks=\"$remarksfin\" WHERE idhrtaemptimelog=$idhrtaemptimelog19 AND employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup AND idcutoff=$idcutoff AND logdate=\"$n\"";
						$result20 = mysql_query("$res20update", $dbh);
						}

?>
