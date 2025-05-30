<?php
//
// 20180116 removed fr hrtimeatttimelogupd.php
//

		//
		// query and update for leave credits
		//
		$res15query = "SELECT idhrtaempleavesumm, paygroupname, datestart, dateend, dateanniv, dateupd, vlquota, vlbal, vlcshcnv, vlaccumcr, vlretcr, vlforfeit, slquota, slbal, slcshcnv, slaccumcr, slretcr, slforfeit, splquota, splbal, paterquota, paterbal, maternquota, maternbal, matercquota, matercbal FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup AND idcutoff=$idcutoff ORDER BY dateupd DESC LIMIT 1";
		$result15=""; $found15=0; $ctr15=0;
		$result15 = $dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15 = $result15->fetch_assoc()) {
			$found15 = 1;
			$idhrtaempleavesumm15 = $myrow15['idhrtaempleavesumm'];
			$paygroupname15 = $myrow15['paygroupname'];
			$datestart15 = $myrow15['datestart'];
			$dateend15 = $myrow15['dateend'];
			$dateanniv15 = $myrow15['dateanniv'];
			$dateupd15 = $myrow15['dateupd'];
			$vlquota15 = $myrow15['vlquota'];
			$vlbal15 = $myrow15['vlbal'];
			$vlcshcnv15 = $myrow15['vlcshcnv'];
			$vlaccumcr15 = $myrow15['vlaccumcr'];
			$vlretcr15 = $myrow15['vlretcr'];
			$vlforfeit15 = $myrow15['vlforfeit'];
			$slquota15 = $myrow15['slquota'];
			$slbal15 = $myrow15['slbal'];
			$slcshcnv15 = $myrow15['slcshcnv'];
			$slaccumcr15 = $myrow15['slaccumcr'];
			$slretcr15 = $myrow15['slretcr'];
			$slforfeit15 = $myrow15['slforfeit'];
			$splquota15 = $myrow15['splquota'];
			$splbal15 = $myrow15['splbal'];
			$paterquota15 = $myrow15['paterquota'];
			$paterbal15 = $myrow15['paterbal'];
			$maternquota15 = $myrow15['maternquota'];
			$maternbal15 = $myrow15['maternbal'];
			$matercquota15 = $myrow15['matercquota'];
			$matercbal15 = $myrow15['matercbal'];
			}
		}
		if($found15 == 1) {
			// query previous leave credits record not in id15
			$res19query = "SELECT idhrtaempleavesumm, paygroupname, datestart, dateend, dateanniv, dateupd, vlquota, vlbal, vlcshcnv, vlaccumcr, vlretcr, vlforfeit, slquota, slbal, slcshcnv, slaccumcr, slretcr, slforfeit, splquota, splbal, paterquota, paterbal, maternquota, maternbal, matercquota, matercbal FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup AND idhrtaempleavesumm<>$idhrtaempleavesumm15 ORDER BY dateupd DESC LIMIT 1";
			$result19=""; $found19=0; $ctr19=0;
			/*
			$result19 = mysql_query("$res19select", $dbh);
			if($result19 != "") {
				while($myrow19 = mysql_fetch_row($result19)) {
			*/
			$result19 = $dbh2->query($res19query);
			if($result19->num_rows>0) {
				while($myrow19 = $result19->fetch_assoc()) {
				$found19 = 1;
				$idhrtaempleavesumm19 = $myrow19['idhrtaempleavesumm'];
				$paygroupname19 = $myrow19['paygroupname'];
				$datestart19 = $myrow19['datestart'];
				$dateend19 = $myrow19['dateend'];
				$dateanniv19 = $myrow19['dateanniv'];
				$dateupd19 = $myrow19['dateupd'];
				$vlquota19 = $myrow19['vlquota'];
				$vlbal19 = $myrow19['vlbal'];
				$vlcshcnv19 = $myrow19['vlcshcnv'];
				$vlaccumcr19 = $myrow19['vlaccumcr'];
				$vlretcr19 = $myrow19['vlretcr'];
				$vlforfeit19 = $myrow19['vlforfeit'];
				$slquota19 = $myrow19['slquota'];
				$slbal19 = $myrow19['slbal'];
				$slcshcnv19 = $myrow19['slcshcnv'];
				$slaccumcr19 = $myrow19['slaccumcr'];
				$slretcr19 = $myrow19['slretcr'];
				$slforfeit19 = $myrow19['slforfeit'];
				$splquota19 = $myrow19['splquota'];
				$splbal19 = $myrow19['splbal'];
				$paterquota19 = $myrow19['paterquota'];
				$paterbal19 = $myrow19['paterbal'];
				$maternquota19 = $myrow19['maternquota'];
				$maternbal19 = $myrow19['maternbal'];
				$matercquota19 = $myrow19['matercquota'];
				$matercbal19 = $myrow19['matercbal'];
				}
			}
			if($found19 == 1) {
			// check available credits if enough then deduct
			if($vlbal <= $vlbal19) {
				$vlbal19 = $vlbal19 - $vlbal;
			} else { include("hrtimeatttimelogupdlvmaxwarn.php"); }
			if($slbal <= $slbal19) {
				$slbal19 = $slbal19 - $slbal;
			} else { include("hrtimeatttimelogupdlvmaxwarn.php"); }
			if($splbal <= $splbal19) {
				$splbal19 = $splbal19 - $splbal;
			} else { include("hrtimeatttimelogupdlvmaxwarn.php"); }
			if($paterbal <= $paterbal19) {
				$paterbal19 = $paterbal19 - $paterbal;
			} else { include("hrtimeatttimelogupdlvmaxwarn.php"); }
			if($maternbal <= $maternbal19) {
				$maternbal19 = $maternbal19 - $maternbal;
			} else { include("hrtimeatttimelogupdlvmaxwarn.php"); }
			if($matercbal <= $matercbal19) {
				$matercbal19 = $matercbal19 - $matercbal;
			} else { include("hrtimeatttimelogupdlvmaxwarn.php"); }
			if($slaccumcr <= $slaccumcr19) {
				$slaccumcr19 = $slaccumcr19 - $slaccumcr;
			} else { include("hrtimeatttimelogupdlvmaxwarn.php"); }
			} // end if($found19 == 1)
			// update tblhrtaempleavesumm based on id
			$res15bupdate = "UPDATE tblhrtaempleavesumm SET vlbal=$vlbal19, slbal=$slbal19, paterbal=$paterbal19, maternbal=$maternbal19, matercbal=$matercbal19, splbal=$splbal19, slaccumcr=$slaccumcr19 WHERE idhrtaempleavesumm=$idhrtaempleavesumm15 AND employeeid=\"$employeeid\"";
			// $result15b = $dbh2->query($res15bupdate);
		} else if($found15 == 0) {
			// select query from tblhrtaempleavesumm
			$res18select="SELECT idhrtaempleavesumm, paygroupname, datestart, dateend, dateanniv, dateupd, vlquota, vlbal, vlcshcnv, vlaccumcr, vlretcr, vlforfeit, slquota, slbal, slcshcnv, slaccumcr, slretcr, slforfeit, splquota, splbal, paterquota, paterbal, maternquota, maternbal, matercquota, matercbal FROM tblhrtaempleavesumm WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup ORDER BY dateupd DESC LIMIT 1";
			$result18=""; $found18=0; $ctr18=0;
			$result18 = $dbh2->query($res18select);
			if($result18->num_rows>0) {
				while($myrow18 = $result18->fetch_assoc()) {
				$found18 = 1;
				$idhrtaempleavesumm18 = $myrow18['idhrtaempleavesumm'];
				$paygroupname18 = $myrow18['paygroupname'];
				$datestart18 = $myrow18['datestart'];
				$dateend18 = $myrow18['dateend'];
				$dateanniv18 = $myrow18['dateanniv'];
				$dateupd18 = $myrow18['dateupd'];
				$vlquota18 = $myrow18['vlquota'];
				$vlbal18 = $myrow18['vlbal'];
				$vlcshcnv18 = $myrow18['vlcshcnv'];
				$vlaccumcr18 = $myrow18['vlaccumcr'];
				$vlretcr18 = $myrow18['vlretcr'];
				$vlforfeit18 = $myrow18['vlforfeit'];
				$slquota18 = $myrow18['slquota'];
				$slbal18 = $myrow18['slbal'];
				$slcshcnv18 = $myrow18['slcshcnv'];
				$slaccumcr18 = $myrow18['slaccumcr'];
				$slretcr18 = $myrow18['slretcr'];
				$slforfeit18 = $myrow18['slforfeit'];
				$splquota18 = $myrow18['splquota'];
				$splbal18 = $myrow18['splbal'];
				$paterquota18 = $myrow18['paterquota'];
				$paterbal18 = $myrow18['paterbal'];
				$maternquota18 = $myrow18['maternquota'];
				$maternbal18 = $myrow18['maternbal'];
				$matercquota18 = $myrow18['matercquota'];
				$matercbal18 = $myrow18['matercbal'];
				}
			}
			// check available credits if enough then deduct
			if($vlbal <= $vlbal18) {
				$vlbal18 = $vlbal18 - $vlbal;
			} else { include("hrtimeatttimelogupdlvmaxwarn.php"); }
			if($slbal <= $slbal18) {
				$slbal18 = $slbal18 - $slbal;
			} else { include("hrtimeatttimelogupdlvmaxwarn.php"); }
			if($splbal <= $splbal18) {
				$splbal18 = $splbal18 - $splbal;
			} else { include("hrtimeatttimelogupdlvmaxwarn.php"); }
			if($paterbal <= $paterbal18) {
				$paterbal18 = $paterbal18 - $paterbal;
			} else { include("hrtimeatttimelogupdlvmaxwarn.php"); }
			if($maternbal <= $maternbal18) {
				$maternbal18 = $maternbal18 - $maternbal;
			} else { include("hrtimeatttimelogupdlvmaxwarn.php"); }
			if($matercbal <= $matercbal18) {
				$matercbal18 = $matercbal18 - $matercbal;
			} else { include("hrtimeatttimelogupdlvmaxwarn.php"); }
			if($slaccumcr <= $slaccumcr18) {
				$slaccumcr18 = $slaccumcr18 - $slaccumcr;
			} else { include("hrtimeatttimelogupdlvmaxwarn.php"); }
			// insert into tblbhrtaempleavesumm 
			$res15binsert = "INSERT INTO tblhrtaempleavesumm SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", lastupdate=$loginid, idpaygroup=$idpaygroup, paygroupname=\"$paygroupname14\", idcutoff=$idcutoff, datestart=\"$cutstart14\", dateend=\"$cutend14\", employeeid=\"$employeeid\", dateanniv=\"\", dateupd=\"$now\", vlquota=$vlquota18, vlbal=$vlbal18, vlcshcnv=$vlcshcnv18, vlaccumcr=$vlaccumcr18, vlretcr=$vlretcr18, vlforfeit=$vlforfeit18, slquota=$slquota18, slbal=$slbal18, slcshcnv=$slcshcnv18, slaccumcr=$slaccumcr18, slretcr=$slretcr18, slforfeit=$slforfeit18, splquota=$splquota18, splbal=$splbal18, paterquota=$paterquota18, paterbal=$paterbal18, maternquota=$maternquota18, maternbal=$maternbal18, matercquota=$matercquota18, matercbal=$matercbal18";
			// $result15b = $dbh2->query($res15binsert);
		} // end if($found15 == 1)
	// echo "$res15bupdate $res15binsert \n";
?>
