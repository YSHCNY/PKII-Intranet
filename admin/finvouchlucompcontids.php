<?php
//
// finvouchlucompcontids.php (20210203)
//
// req: $companyidfin, $contactidfin;
// res: $payeefin;
//

if($companyidfin!=0) {
	// query tblcompany
	$res15bqry=""; $result15b=""; $found15b=0; $ctr15b=0;
	$res15bqry="SELECT company, branch FROM tblcompany WHERE companyid=$companyidfin";
	$result15b=$dbh2->query($res15bqry);
	if($result15b->num_rows>0) {
		while($myrow15b=$result15b->fetch_assoc()) {
			$found15b=1;
			$ctr15b++;
			$companyname15b = $myrow15b['company'];
			$companybranch15b = $myrow15b['branch'];
			if($companybranch15b!='') {
				$payeefin = $companyname15b . " - " . $companybranch15b;
			} else {
				$payeefin = $companyname15b;
			} //if-else
		} //while
	} //if
} elseif($contactidfin!=0) {
	// query tblcontact
	$res15cqry=""; $result15c=""; $found15c=0; $ctr15c=0;
	$res15cqry="SELECT name_last, name_first, name_middle, employeeid FROM tblcontact WHERE contactid=$contactidfin";
	$result15c=$dbh2->query($res15cqry);
	if($result15c->num_rows>0) {
		while($myrow15c=$result15c->fetch_assoc()) {
			$found15c=1;
			$ctr15c++;
			$name_last15c = $myrow15c['name_last'];
			$name_first15c = $myrow15c['name_first'];
			$name_middle15c = $myrow15c['name_middle'];
			$employeeid15c = $myrow15c['employeeid'];
			if($name_middle15c!='') {
				$payeefin = $name_first15c . " " . $name_middle15c[0] . ". " . $name_last15c;
			} else {
				$payeefin = $name_first15c . " " . $name_last15c;					
			} //if-else
		} //while
	} //if
} //if-elseif
?>