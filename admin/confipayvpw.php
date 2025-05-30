<?php 

		echo "<form action=\"confipayvpw2.php?loginid=$loginid&rs=$radiochecked\" method=\"POST\" name=\"confipayvpw2\">";

		echo "<input type=\"hidden\" name=\"employeeid\" value=\"$employeeid\">";
		echo "<input type=\"hidden\" name=\"groupname\" value=\"$groupname\">";
		echo "<input type=\"hidden\" name=\"confiaccesslevel\" value=\"$confiaccesslevel\">";
		echo "<input type=\"hidden\" name=\"srcfile\" value=\"$srcfile\">";

		if($radiochecked=="cutoff") {
		echo "<input type=\"hidden\" name=\"cutstart\" value=\"$cutstart\">";
		echo "<input type=\"hidden\" name=\"cutend\" value=\"$cutend\">";
		echo "<input type=\"hidden\" name=\"groupcut\" value=\"$groupcut\">";
		} else if($radiochecked=="onetime") {
		echo "<input type=\"hidden\" name=\"nameotp\" value=\"$nameotp\">";
		echo "<input type=\"hidden\" name=\"dateotp\" value=\"$dateotp\">";
		} else {
		echo "<input type=\"hidden\" name=\"cutstart\" value=\"$cutstart\">";
		echo "<input type=\"hidden\" name=\"cutend\" value=\"$cutend\">";
		echo "<input type=\"hidden\" name=\"groupcut\" value=\"$groupcut\">";
		} // if($radiochecked=="cutoff")

		echo "<tr><th colspan=\"2\"><h3>Validation of your password is required<br>for higher-level security access.</h3></th></tr>";
		$res11query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result11=""; $found11=0; $ctr11=0;
		/*
		$result11 = mysql_query("$res11query", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
		*/
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$adminuid11 = $myrow11['adminuid'];
			}
		}
		// echo "<tr><td colspan=\"2\">test $cutstart -to- $cutend</td></tr>";
		echo "<tr><td align=\"right\">user</td><th align=\"left\">$adminuid11</td></tr>";
		echo "<tr><td align=\"right\">password</td><th align=\"left\"><input type=\"password\" name=\"usrpassword\"></td></tr>";
		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></td></tr>";
		echo "</form>";

?> 
