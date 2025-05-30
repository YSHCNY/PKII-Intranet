<?php
//
// this file was called by hrpersreqdtl.php
//

	if($candidate!='' && $found22==1) {
	// query tblempfiles based on contactid
	echo "<tr><th colspan=\"3\">Documents uploaded</th></tr>";
	if($pkintrausr=="adm") {
	echo "<form enctype=\"multipart/form-data\" action=\"hrpersrequpload.php?loginid=$loginid&idhpr=$idhrpersreq\" method=\"POST\" name=\"hrpersrequpload\">";
	echo "<input type=\"hidden\" name=\"idhrpersreqcand\" value=\"$idhrpersreqcand22\">";
	echo "<input type=\"hidden\" name=\"contactid\" value=\"$contactid22\">";
	echo "<tr><td colspan=\"3\" align=\"center\">";
	echo "doc_title:<input name=\"title\">";
	echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"20000000\" />";
	echo "<input name=\"uploadedfile\" type=\"file\" />";
	echo "</td></tr>";
	echo "<tr><td colspan=\"3\" align=\"center\"><input type=\"submit\" value=\"Upload file\"></td></tr>";
	echo "</form>";
	} // if($pkintrausr=="adm")
	$res24query="SELECT idempfiles, title, description, filepath, filename FROM tblempfiles WHERE contactid=$contactid22 AND empsection=\"tblcontact\"";
	$result24=""; $found24=0; $ctr24=0;
	$result24=$dbh2->query($res24query);
	if($result24->num_rows>0) {
		while($myrow24=$result24->fetch_assoc()) {
		$found24=1;
		$ctr24=$ctr24+1;
		$idempfiles24 = $myrow24['idempfiles'];
		$title24 = $myrow24['title'];
		$description24 = $myrow24['description'];
		$filepath24 = $myrow24['filepath'];
		$filename24 = $myrow24['filename'];
		echo "<tr><td colspan=\"3\"><a href=\"$filepath24/$filename24\" target=\"_blank\">";
		if($title24!='') {
		echo "$title24&nbsp;-&nbsp;";
		} // if($title24!='')
		echo "$filename24</a>";
		if($pkintrausr=="adm") {
		echo "<i>&nbsp;&nbsp;<a href=\"hrpersreqdelfile.php?loginid=$loginid&idhpr=$idhrpersreq&idef=$idempfiles24\">remove</a></i>";
		} // if($pkintrausr=="adm")
		echo "</td></tr>";
		} // while($myrow24=$result24->fetch_assoc())
	} // if($result24->num_rows>0)

	// set initial variable
	$prevstatus=1;

	// query tblhrpersreqstepsctg
	$res21query="SELECT idhrpersreqstepsctg, code, name FROM tblhrpersreqstepsctg WHERE name<>'' ORDER BY code ASC";
	$result21=""; $found21=0; $ctr21=0;
	$result21=$dbh2->query($res21query);
	if($result21->num_rows>0) {
		while($myrow21=$result21->fetch_assoc()) {
		$found21=1;
		$ctr21 = $ctr21+1;
		$idhrpersreqstepsctg21 = $myrow21['idhrpersreqstepsctg'];
		$code21 = $myrow21['code'];
		$name21 = $myrow21['name'];

		echo "<tr><th align=\"right\">Step $ctr21:</th><th align=\"left\">$name21</th>";

			// compose table field for step no. remarks
			$sfinremarks = strtolower($code21."remarks");
			$sfinstatus = strtolower($code21."status");
			$sfinstamp = strtolower($code21."stamp");
			$sfinlabel = strtolower($code21."label");
			// query tblhrpersreqcand and display info per step
			$res23query="SELECT $sfinremarks AS remarks, $sfinstatus AS status, $sfinstamp AS stamp FROM tblhrpersreqcand WHERE idhrpersreqcand=$idhrpersreqcand22";
			$result23=""; $found23=0; $ctr23=0;
			$result23=$dbh2->query($res23query);
			if($result23->num_rows>0) {
				while($myrow23=$result23->fetch_assoc()) {
				$found23=1;
				$ctr23=$ctr23+1;
				$remarks23 = $myrow23['remarks'];
				$status23 = $myrow23['status'];
				$stamp23 = $myrow23['stamp'];
				} // while($myrow23=$result23->fetch_assoc())
			} // if($result23->num_rows>0)

			if($status23>=1) {
			// display timestamp
			echo "<th align=\"left\"><font color=\"green\"><i>Step $ctr21 status: COMPLETED as of ".date("Y-M-d H:i", strtotime($stamp23))."</i></font></th></tr>";
			} else {
			// check previous step if completed first
			if($prevstatus>=1) {
			if($pkintrausr=="adm") {
			// display complete button
			echo "<form action=\"hrpersreqrpmstepyes.php?loginid=$loginid&idhpr=$idhrpersreq\" method=\"POST\" name=\"hrpersreqrpmstepyes\">";
			echo "<input type=\"hidden\" name=\"idhrpersreqcand\" value=\"$idhrpersreqcand22\">";
			echo "<input type=\"hidden\" name=\"stepcd\" value=\"$code21\">";
			echo "<input type=\"hidden\" name=\"steplabel\" value=\"$sfinstatus\">";
			echo "<input type=\"hidden\" name=\"stepstatusval\" value=\"1\">";
			echo "<td><input type=\"submit\" value=\"Mark Step $ctr21 as Completed\"></td></tr>";
			echo "</form>";
			} else { // if($pkintrausr=="adm")
			echo "<td><i>Step $ctr21 status: Pending</i></td></tr>";
			} // if($pkintrausr=="adm")
			} else {
			echo "<td><i>Step $ctr21 status: Pending</i></td></tr>";
			} // if($prevstatus>=1)
			} // if($status23>=1)

		if($pkintrausr=="adm" && $status23==0) {
			// display textarea under new form
			echo "<form action=\"hrpersreqrpm.php?loginid=$loginid&idhpr=$idhrpersreq\" method=\"POST\" name=\"hrpersreqrpm\">";
			echo "<input type=\"hidden\" name=\"idhrpersreqcand\" value=\"$idhrpersreqcand22\">";
			echo "<input type=\"hidden\" name=\"recstepcd\" value=\"$code21\">";
			echo "<tr><td colspan=\"3\" align=\"center\" nowrap>";
			echo "<textarea rows=\"3\" cols=\"70\" name=\"remarks\"></textarea>";
			echo "<input type=\"submit\" value=\"Submit\"></td></tr>";
			// echo "<tr><td colspan=\"2\" align=\"center\"></td></tr>";
			echo "</form>";
		} // if($pkintrausr=="adm")
			echo "<tr><td colspan=\"3\">".nl2br($remarks23)."</td></tr>";

			// set previous step
			$prevstatus=$status23;

		// reset variable
		$sfinremarks='';

		} // while($myrow21=$result21->fetch_assoc())
	} // if($result21->num_rows>0)

	if($pkintrausr=="adm") {
	// display input field for employeeid if last item of array status=1
	if($status23>=1) {
	echo "<form action=\"\" method=\"\" name=\"\">";
	echo "<input type=\"hidden\" name=\"\" value=\"\">";
	echo "<tr><td colspan=\"3\" align=\"center\">Enter employee no.:<input name=\"employeeid\"><input type=\"submit\" value=\"Set employee number\"></td></tr>";
	echo "</form>";
	} // if($status23>=1)
	} // if($pkintrausr=="adm")

	} // if($candidate!='' && $found22==1)

?>
