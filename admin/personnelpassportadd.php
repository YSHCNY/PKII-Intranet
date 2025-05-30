<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

<!-- Include JS -->


</head>
<body>

<?php 


     echo "<div class = 'px-4'>";
  

	
	echo "<div class ='mt-3'>Passport number<input class ='form-control' placeholder = 'Passport number..' name=\"passportnum\"></div>";
	echo "<div class ='mt-3'>Issuing country";
	echo "<select class = 'inputselect8' name=\"countrycd\">";
	$res18query = "SELECT cname, letter2cd FROM tblcountrycd ORDER BY cname ASC";
	$result18=""; $found18=0; $ctr18=0;
	// $result18 = mysql_query("$res18query", $dbh);
	$result18 = $dbh2->query($res18query);
	// if($result18 != "") {
	if($result18->num_rows>0) {
		// while($myrow18 = mysql_fetch_row($result18)) {
		while($myrow18 = $result18->fetch_assoc()) {
		$found18 = 1;
		$ctr18 = $ctr18 + 1;
		$cname18 = $myrow18['cname'];
		$letter2cd18 = $myrow18['letter2cd'];
		if($letter2cd18=="PH") { $letter2cdsel="selected"; } else { $letter2cdsel=""; }
		echo "<option value=\"$letter2cd18\" $letter2cdsel>$cname18 ($letter2cd18)</option>";
		} // while($myrow18 = $result18->fetch_assoc())
	} // if($result18->num_rows>0)
	echo "</select>";
	echo "</div>";
	echo "<div class ='mt-3'>Issued by<input class ='form-control' placeholder = 'Issued by...' name=\"issuedby\"></div>";
	echo "<div class ='mt-3'>Issued date<input class ='form-control' type='date' name=\"dateissued\" value=\"$datenow\">";

	echo "</div>";
	echo "<div class ='mt-3'>Expiry date<input class ='form-control' type='date' name=\"dateexpiry\" value=\"$datenow\">";

	echo "</div>";
	echo "</div>";

// end add education

     

     $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery);

  
?> 
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect8');
        new Choices(element, { searchEnabled: true });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect9');
        new Choices(element, { searchEnabled: true });
    });
</script>
</body>
</html>
