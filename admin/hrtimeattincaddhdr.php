<?php

	if($tabinctyp=="list") { $tabinctypsellist="disabled"; $tabinctypseladd=""; }
	else if($tabinctyp=="add") { $tabinctypsellist=""; $tabinctypseladd="disabled"; }
	else { $tabinctypsellist=""; $tabinctypseladd=""; }
	echo "<table class=\"fin\">";
	echo "<tr><td>";
	echo "<form action=\"hrtimeattincomelst.php?loginid=$loginid\" method=\"post\" name=\"hrtimeattincomelst\">";
	echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"list\">";
	// echo "<input type=\"submit\" value=\"List\" $tabinctypsellist>";
	echo "<button type=\"submit\" class=\"btn btn-primary\" $tabinctypsellist>List</button>";
	echo "</form>";
	echo "</td><td>";
	echo "<form action=\"hrtimeattincomeadd.php?loginid=$loginid\" method=\"post\" name=\"hrtimeattincomeadd\">";
	echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"add\">";
	// echo "<input type=\"submit\" value=\"Add\" $tabinctypseladd>";
	echo "<button type=\"submit\" class=\"btn btn-primary\" $tabinctypseladd>Add</button>";
	echo "</form>";
	echo "</td></tr>";
	echo "</table>";

?>
