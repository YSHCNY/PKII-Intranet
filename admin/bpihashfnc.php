<?php

				$tothh56 = 0;
				$tothh78 = 0;
				$tothh910 = 0;
				$tothhnetpay = 0;

				$counter = $counter + 1;

				$acctnum4th = substr($acct_num, 3, 1);

				if ($acctnum4th == '5') {
					if ($acct_type == 'Savings') {
						$acctnum4thfin = '6';
					} else {
						$acctnum4thfin = $acctnum4th;
					}
				} else {
					$acctnum4thfin = $acctnum4th;
				}

				$acctnumpre1 = substr($acct_num, 0, 3);
				$acctnumpre2 = substr($acct_num, 4, 6);
				$acctnumfin = "$acctnumpre1$acctnum4thfin$acctnumpre2";

				$acct_num04 = substr($acctnumfin, 0, 4);
				$hh56 = substr($acctnumfin, 4, 2);
				$hh78 = substr($acctnumfin, 6, 2);
				$hh910 = substr($acctnumfin, 8, 2);

				$tothh56 = $hh56 * $netpay;
				$tothh78 = $hh78 * $netpay;
				$tothh910 = $hh910 * $netpay;

				$tothhnetpay = $tothh56 + $tothh78 + $tothh910;
        // reset acct number
        $acct_num='';

?>
