<?php

		//
		// check leave credits
		//
		/*
		if($leavetypeval != "" && $leavedaydur[$val] != 0) {
			if($leavetypeval == "vacation") {
				$vlbal = $vlbal + $leavedaydur[$val];
			} else if($leavetypeval == "sick") {
				$slbal = $slbal + $leavedaydur[$val];
			} else if($leavetypeval == "paternity") {
				$paterbal = $paterbal + $leavedaydur[$val];
			} else if($leavetypeval == "maternityn") {
				$maternbal = $maternbal - $leavedaydur[$val];
			} else if($leavetypeval == "maternityc") {
				$matercbal = $matercbal - $leavedaydur[$val];
			} else if($leavetypeval == "special") {
				$splbal = $splbal - $leavedaydur[$val];
			} else if($leavetypeval == "accumulated") {
				$slaccumcr = $slaccumcr - $leavedaydur[$val];
			}
		}
		*/
		// init var
		$leavereqstat = 0;

		if($leavetypeval != "" && $leavedaydur[$val] != "0.00") {
			if($leavetypeval == "vacation") {
				$idhrtaleavectg=2;
				$res20query = "SELECT idhrtaempleavesumm, bal FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup AND idhrtaleavectg=$idhrtaleavectg AND (dateannivstart>=\"$cutstart\" AND dateannivend<=\"$cutstart\") AND (datestart=\"0000-00-00\" AND dateend=\"0000-00-00\") ORDER BY dateupd DESC LIMIT 1";
				$result20=""; $found20=0; $ctr20=0;
				$result20 = $dbh2->query($res20query);
				if($result20->num_rows>0) {
					while($myrow20 = $result20->fetch_assoc()) {
					$found20 = 1;
					$idhrtaempleavesumm20 = $myrow20['idhrtaempleavesumm'];
					$bal20 = $myrow20['bal'];
					} // while($myrow20 = $result20->fetch_assoc())
				} // if($result20->num_rows>0)
				if($found20==1) {
					$bal0 = $bal20 - $leavedaydur[$val];
					if($bal0 >= 0) {
						if($bal0 >= $leavereqtot) {
						// vl accepted
						$bal1 = $bal1 + $leavedaydur[$val];
						$leavereqstat = 1;
						} else {
						// vl denied
						$leavereqstat = 0;
						} // if($leavereqtot >= $vlbal0)
					} else {
						// vl denied
						$leavereqstat = 0;
					} // if($vlbal0 >= 0)
					$bal0=0;
				} // if($found20==1)
			} else if($leavetypeval == "sick") {
				$idhrtaleavectg=1;
				$res20query = "SELECT idhrtaempleavesumm, bal FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup AND idhrtaleavectg=$idhrtaleavectg AND (dateannivstart>=\"$cutstart\" AND dateannivend<=\"$cutstart\") AND (datestart=\"0000-00-00\" AND dateend=\"0000-00-00\") ORDER BY dateupd DESC LIMIT 1";
				$result20=""; $found20=0; $ctr20=0;
				$result20 = $dbh2->query($res20query);
				if($result20->num_rows>0) {
					while($myrow20 = $result20->fetch_assoc()) {
					$found20 = 1;
					$idhrtaempleavesumm20 = $myrow20['idhrtaempleavesumm'];
					$bal20 = $myrow20['bal'];
					} // while($myrow20 = $result20->fetch_assoc())
				} // if($result20->num_rows>0)
				if($found20==1) {
					$bal0 = $slbal20 - $leavedaydur[$val];
					if($slbal0 >= 0) {
						if($slbal0 >= $leavereqtot) {
						// sl accepted
						$slbal1 = $slbal1 + $leavedaydur[$val];
						$leavereqstat = 1;
						} else {
						// deny sl request
						$leavereqstat = 0;
						} // if($slbal0 >= $leavereqtot)
					} else {
						// sl denied
						$leavereqstat = 0;
					} // if($slbal0 >= 0)
					$slbal0=0;
				} // if($found20==1)
			} else if($leavetypeval == "paternity") {
				$res20query = "SELECT idhrtaempleavesumm, paterbal FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup ORDER BY dateupd DESC LIMIT 1";
				$result20=""; $found20=0; $ctr20=0;
				$result20 = $dbh2->query($res20query);
				if($result20->num_rows>0) {
					while($myrow20 = $result20->fetch_assoc()) {
					$found20 = 1;
					$idhrtaempleavesumm20 = $myrow20['idhrtaempleavesumm'];
					$paterbal20 = $myrow20['paterbal'];
					} // while($myrow20 = $result20->fetch_assoc())
				} // if($result20->num_rows>0)
				if($found20==1) {
					$paterbal0 = $paterbal20 - $leavedaydur[$val];
					if($paterbal0 >= 0) {
						if($paterbal0 >= $leavereqtot) {
						// leave request accepted
						$paterbal1 = $paterbal1 + $leavedaydur[$val];
						$leavereqstat = 1;
						} else {
						// deny leave request
						$leavereqstat = 0;
						} // if($paterbal0 >= $leavereqtot)
					} else {
						// vl denied
						$leavereqstat = 0;
					} // if($paterbal0 >= 0)
					$paterbal0=0;
				} // if($found20==1)
			} else if($leavetypeval == "maternityn") {
				$res20query = "SELECT idhrtaempleavesumm, maternbal FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup ORDER BY dateupd DESC LIMIT 1";
				$result20=""; $found20=0; $ctr20=0;
				$result20 = $dbh2->query($res20query);
				if($result20->num_rows>0) {
					while($myrow20 = $result20->fetch_assoc()) {
					$found20 = 1;
					$idhrtaempleavesumm20 = $myrow20['idhrtaempleavesumm'];
					$maternbal20 = $myrow20['maternbal'];
					} // while($myrow20 = $result20->fetch_assoc())
				} // if($result20->num_rows>0)
				if($found20==1) {
					$maternbal0 = $maternbal20 - $leavedaydur[$val];
					if($maternbal0 >= 0) {
						if($maternbal0 >= $leavereqtot) {
						// leave request accepted
						$maternbal1 = $maternbal1 + $leavedaydur[$val];
						$leavereqstat = 1;
						} else {
						// levae denied
						$leavereqstat = 0;
						} // if($maternbal0 >= $leavereqtot
					} else {
						// vl denied
						$leavereqstat = 0;
					} // if($maternbal0 >= 0)
					$maternbal0=0;
				} // if($found20==1)
			} else if($leavetypeval == "maternityc") {
				$res20query = "SELECT idhrtaempleavesumm, matercbal FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup ORDER BY dateupd DESC LIMIT 1";
				$result20=""; $found20=0; $ctr20=0;
				$result20 = $dbh2->query($res20query);
				if($result20->num_rows>0) {
					while($myrow20 = $result20->fetch_assoc()) {
					$found20 = 1;
					$idhrtaempleavesumm20 = $myrow20['idhrtaempleavesumm'];
					$matercbal20 = $myrow20['matercbal'];
					} // while($myrow20 = $result20->fetch_assoc())
				} // if($result20->num_rows>0)
				if($found20==1) {
					$matercbal0 = $matercbal20 - $leavedaydur[$val];
					if($matercbal0 >= 0) {
						if($matercbal0 >= $leavereqtot) {
						// leave request accepted
						$matercbal1 = $matercbal1 + $leavedaydur[$val];
						$leavereqstat = 1;
						} else {
						// leave denied
						$leavereqstat = 0;
						} // if($matercbal0 >= $leavereqtot)
					} else {
						// vl denied
						$leavereqstat = 0;
					} // if($matercbal0 >= 0)
					$matercbal0=0;
				} // if($found20==1)
			} else if($leavetypeval == "special") {
				$res20query = "SELECT idhrtaempleavesumm, splbal FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup ORDER BY dateupd DESC LIMIT 1";
				$result20=""; $found20=0; $ctr20=0;
				$result20 = $dbh2->query($res20query);
				if($result20->num_rows>0) {
					while($myrow20 = $result20->fetch_assoc()) {
					$found20 = 1;
					$idhrtaempleavesumm20 = $myrow20['idhrtaempleavesumm'];
					$splbal20 = $myrow20['splbal'];
					} // while($myrow20 = $result20->fetch_assoc())
				} // if($result20->num_rows>0)
				if($found20==1) {
					$splbal0 = $splbal20 - $leavedaydur[$val];
					if($splbal0 >= 0) {
						if($splbal0 >= $leavereqtot) {
						// leave request accepted
						$splbal1 = $splbal1 + $leavedaydur[$val];
						$leavereqstat = 1;
						} else {
						// leave denied
						$leavereqstat = 0;
						} // if($splbal0 >= $leavereqtot)
					} else {
						// vl denied
						$leavereqstat = 0;
					} // if($splbal0 >= 0)
					$splbal0=0;
				} // if($found20==1)
			} else if($leavetypeval == "accumulated") {
				$res20query = "SELECT idhrtaempleavesumm, slaccumcr FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup ORDER BY dateupd DESC LIMIT 1";
				$result20=""; $found20=0; $ctr20=0;
				$result20 = $dbh2->query($res20query);
				if($result20->num_rows>0) {
					while($myrow20 = $result20->fetch_assoc()) {
					$found20 = 1;
					$idhrtaempleavesumm20 = $myrow20['idhrtaempleavesumm'];
					$slaccumcr20 = $myrow20['slaccumcr'];
					} // while($myrow20 = $result20->fetch_assoc())
				} // if($result20->num_rows>0)
				if($found20==1) {
					$slaccumcr0 = $slaccumcr20 - $leavedaydur[$val];
					if($slaccumcr0 >= 0) {
						if($slaccumcr0 >= $leavereqtot) {
						// leave request accepted
						$slaccumcr1 = $slaccumcr1 + $leavedaydur[$val];
						$leavereqstat = 1;
						} else {
						// leave denied
						$leavereqstat = 0;
						} // if($slaccumcr0 >= $leavereqtot)
					} else {
						// vl denied
						$leavereqstat = 0;
					} // if($slaccumcr0 >= 0)
					$slaccumcr0=0;
				} // if($found20==1)
			} // if($leavetypeval == "vacation")
		} // if($leavetypeval != "" && $leavedaydur[$val] != 0)

?>
