<?php

	if($tabinctyp=="list") { $tabinctypsellist="disabled"; $tabinctypseladd=""; }
	else if($tabinctyp=="add") { $tabinctypsellist=""; $tabinctypseladd="disabled"; }
	else { $tabinctypsellist=""; $tabinctypseladd=""; }
	echo "<table class=\"fin\">";
	echo "<tr><td>";
	echo "<form action=\"finpaysysaddincl.php?loginid=$loginid\" method=\"post\" name=\"finpaysysaddincl\">";
	echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"list\">";
	echo "<input type=\"submit\" value=\"List\" $tabinctypsellist>";
	echo "</form>";
	echo "</td><td>";
	echo "<form action=\"finpaysysaddinca.php?loginid=$loginid\" method=\"post\" name=\"finpaysysaddinca\">";
	echo "<input type=\"hidden\" name=\"tabinctyp\" value=\"add\">";
	echo "<input type=\"submit\" value=\"Add\" $tabinctypseladd>";
	echo "</form>";
	echo "</td></tr>";
	echo "</table>";

?>
