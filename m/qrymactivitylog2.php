<?php
//
// qrymactivitylog2.php
// fr: ./vc/mactivitylog.php

// db conn string

require '../includes/dbh.php';

	$res12query="SELECT att_userid, fk_uc_UserID, fk_uc_Addres, fk_uc_ID FROM tblhrattuserinfo WHERE employeeid=\"$employeeid0\" LIMIT 1";
	$result12=""; $found12=0; $ctr12=0;
	$result12=$dbh->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
		$att_userid12 = $myrow12['att_userid'];
                $fk_uc_UserID12 = $myrow12['fk_uc_UserID'];
                $fk_uc_Addres12 = $myrow12['fk_uc_Addres'];
                $fk_uc_ID12 = $myrow12['fk_uc_ID'];
		} // while
	} // if

// close database
$dbh->close();
?>
