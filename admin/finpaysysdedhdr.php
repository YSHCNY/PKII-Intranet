<?php

	if($tabinctyp=="list") {
		//  $tabinctypsellist="active"; 
		 $actives = 'active';
		//  $tabinctypseladd=""; 
		}
	else if($tabinctyp=="add") {
		//  $tabinctypsellist="";
		//   $tabinctypseladd="disabled"; 
		 $actives2 = 'active';

		}
	else { 
		// $tabinctypsellist="";
		//  $tabinctypseladd=""; 
		 $actives = '';
		 $actives2 = '';
		 
		}
	


	echo "<div class = 'p-5 shadow '>
     <div class = 'mb-4'>
          <h4 class = 'mb-0'>Income Deductions</h4>
          <p class = 'text-secondary mt-0'>Manage Employees' Deduction per paygroup</p>
     </div>
     <div class=\"row px-4\">";

	echo "<div class=\"col border-bottom\">";
	echo "<form action=\"finpaysysdedl.php?loginid=$loginid\" method=\"post\" name=\"finpaysysdedl\">";
	echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"list\">";
	echo "<input type=\"submit\" class = 'bg-transparent rounded-0 btn  border border-bottom-0 py-3  w-100  $actives' value=\"List\" $tabinctypsellist>";
	echo "</form>";
	echo "</div>";

	echo "<div class=\"col border-bottom\">";
	echo "<form action=\"finpaysysdeda.php?loginid=$loginid\" method=\"post\" name=\"finpaysysdeda\">";
	echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"add\">";
	echo "<input type=\"submit\" class = 'bg-transparent  rounded-0 btn  border border-bottom-0 py-3 w-100 $actives2' value=\"Add\" $tabinctypseladd>";
	echo "</form>";
	echo "</div>";

	echo "</div>";
	echo "</div>";


?>
