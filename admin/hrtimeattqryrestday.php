<?php
//
// hrtimeattqryrestday.php
// fr: hrtimattcutleave.php
//
	if($restday14 != "") {
			$restdaysunval = substr("$restday14", 0, 1);
			$restdaymonval = substr("$restday14", 1, 1);
			$restdaytueval = substr("$restday14", 2, 1);
			$restdaywedval = substr("$restday14", 3, 1);
			$restdaythuval = substr("$restday14", 4, 1);
			$restdayfrival = substr("$restday14", 5, 1);
			$restdaysatval = substr("$restday14", 6, 1);
			if($restdaysunval == 1) { $restdaysunfin="Sun"; } else { $restdaysunfin=""; }
			if($restdaymonval == 1) { $restdaymonfin="Mon"; } else { $restdaymonfin=""; } 
			if($restdaytueval == 1) { $restdaytuefin="Tue"; } else { $restdaytuefin=""; }
			if($restdaywedval == 1) { $restdaywedfin="Wed"; } else { $restdaywedfin=""; }
			if($restdaythuval == 1) { $restdaythufin="Thu"; } else { $restdaythufin=""; }
			if($restdayfrival == 1) { $restdayfrifin="Fri"; } else { $restdayfrifin=""; }
			if($restdaysatval == 1) { $restdaysatfin="Sat"; } else { $restdaysatfin=""; }
		} // if($restday14 != "")
?>