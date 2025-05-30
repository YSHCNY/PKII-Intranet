<?php

	if($confiaccesslevel11 >= 5) {
		$encrypted = $mcrypt->encrypt($groupname);
		$groupname = $encrypted;
		$encrypted="";
		$encrypted = $mcrypt->encrypt($employeeid);
		$employeeid = $encrypted;
		if($empalias!="") {
		$encrypted="";
		$encrypted = $mcrypt->encrypt($empalias);
		$empalias = $encrypted;
		}
	}

?>
