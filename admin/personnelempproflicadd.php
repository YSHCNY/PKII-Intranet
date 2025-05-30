<?php 



     echo "<div>";



	echo "<div class = 'mt-3'>Regulatory Board</div>
	<div><input class = 'form-control' placeholder ='Regulatory Board..' name='regulatoryboard'></div>";

	echo "<div class = 'mt-3'>Profession</div>
	<div><input class = 'form-control' placeholder ='Profession..' name='profession'></div>";

	echo "<div class = 'mt-3'>License Number</div>
	<div><input class = 'form-control' placeholder ='License Number..' name='licensenumber'></div>";

	echo "<div class = 'mt-3'>License Date</div>
	<div><input class = 'form-control' type='date' placeholder ='License Date..' name='licensedate'></div>";

	echo "</div>";

// end add education


 


     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 


?> 
