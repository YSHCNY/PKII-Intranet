<?php

	echo "<tr><td>Displaying all active <b>employees</b> and <b>consultants</b>.<br>Please select members for this group:<br>";

	echo "<form action=\"configrpadd3.php?loginid=$loginid\" method=\"POST\" name=\"myform2\">";

	echo "Groupname: <b><input name=\"groupname\" value=\"$groupname\" readonly></b><br>";

      if($confiaccesslevel == 3) { $level3selected = "selected"; }
      else if($confiaccesslevel == 5) { $level5selected = "selected"; }
        echo "Access Level: <b>";
      echo "<select name=\"confiaccesslevel\">";
        echo "<option value=\"3\" $level3selected>Level 3 : Standard</option>";
        echo "<option value=\"5\" $level5selected>Level 5 : Confidential</option>";
      echo "</select>";
        echo "</b><br>";

	$result2 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_middle, tblcontact.name_last FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = \"personnel\" AND tblemployee.term_resign = \"0000-00-00\" ORDER BY tblcontact.employeeid ASC, tblcontact.name_last ASC, tblcontact.name_first ASC", $dbh);

	echo "<table border=1 spacing=1>";
	echo "<tr><td>Select</td><td>EmployeeID</td><td>First</td><td>Middle</td><td>Last</td></tr>";

	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $employeeid = $myrow2[0];
	  $name_first = $myrow2[1];
	  $name_middle = $myrow2[2];
	  $name_last = $myrow2[3];
	  echo "<tr>";
	  echo "<td><input type=checkbox name=member[] value=$employeeid></td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td>";
	  echo "</tr>";
	}
	echo "</table><br>";
	echo "<center><INPUT TYPE=\"SUBMIT\" value=\"Save\"></center></td></tr>";

?>
