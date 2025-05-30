<?php

	$res11query="SELECT confipaygrpid, accesslevel FROM tblconfipaygrp WHERE groupname=\"$groupname\" AND accesslevel>=5";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = mysql_query("$res11query", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$confipaygrpid11 = $myrow11[0];
		$confiaccesslevel11 = $myrow11[1];
		}
	}
	if($found11 == 1) {
		$decrypted = $mcrypt->decrypt($groupname);
		$decgrpnm = $decrypted;
		$groupname = $decgrpnm;
		$decrypted="";
		$decrypted = $mcrypt->decrypt($employeeid);
		$decempid = $decrypted;
		$employeeid = $decempid;
		if($empalias!="") {
		$decrypted="";
		$decrypted = $mcrypt->decrypt($empalias);
		$decealias = $decrypted;
		$empalias = $decealias;
		}
	}

?>
