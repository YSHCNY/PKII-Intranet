<?php 

//
// ddmeetingrms.php //20220105
// fr ddash.php > admlogin.php & index2.php
//

// set date after 5 days
$dateplus5d = date('Y-m-d', strtotime($datenow.' + 5 days'));

// chk first if a record exists
$res15query=""; $result15=""; $found15=0; $ctr15=0;
$res15query="SELECT count(*) AS mtgrmctr FROM tbladmmtgrm WHERE datemeeting BETWEEN '$datenow' AND '$dateplus15d'";
$result15=$dbh2->query($res15query);
if($result15->num_rows>0) {
    while($myrow15=$result15->fetch_assoc()) {
    $found15=1;
    $mtgrmctr15=$myrow15['mtgrmctr'];
    } //while
} //if

if($found15==1 && $mtgrmctr15>0) {

		// echo "<table class='table table-striped table-bordered'>";
    echo "<table width=\"100%\" border=0 spacing=0 cellspacing=0 cellpadding=0>";
//		echo "<thead>";
    echo "<tr><th colspan='3'>Meeting room schedules</th></tr>";
		echo "<tr><th>ctr</th><th>date</th><th>duration</th><th>meeting rm</th><th>project</th><th>topic</th><th>eqpt needed</th><th>add'l notes</th></tr>";
//		echo "</thead>";
    echo "<tbody>";
		// display list of entries based on meeting room
		$res14qry=""; $result14=""; $found14=0; $ctr14=0;
		$res14qry="SELECT tbladmmtgrm.idadmmtgrm, tbladmmtgrm.topic, tbladmmtgrm.projcode, tbladmmtgrm.notes, tbladmmtgrm.datemeeting, tbladmmtgrm.timedurfrom, tbladmmtgrm.timedurto, tbladmmtgrm.fk_admctgmtgrm, tbladmmtgrm.eqptlst, tbladmctgmtgrm.code, tbladmctgmtgrm.name FROM tbladmmtgrm LEFT JOIN tbladmctgmtgrm ON tbladmmtgrm.fk_admctgmtgrm=tbladmctgmtgrm.idadmctgmtgrm WHERE tbladmmtgrm.datemeeting BETWEEN '$datenow' AND '$dateplus5d' ORDER BY tbladmmtgrm.datemeeting ASC, tbladmmtgrm.timedurfrom ASC";
		$result14=$dbh2->query($res14qry);
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
				$found14=1;
				$ctr14++;
				$idadmmtgrm14 = $myrow14['idadmmtgrm'];
				$topic14 = $myrow14['topic'];
				$projcode14 = $myrow14['projcode'];
				$notes14 = $myrow14['notes'];
				$datemeeting14 = $myrow14['datemeeting'];
				$timedurfrom14 = $myrow14['timedurfrom'];
				$timedurto14 = $myrow14['timedurto'];
				$fk_admctgmtgrm14 = $myrow14['fk_admctgmtgrm'];
    $eqptlst14 = $myrow14['eqptlst'];
				$code14 = $myrow14['code'];
				$name14 = $myrow14['name'];
				// query projname
				$res14bqry=""; $result14b=""; $found14b=0;
				if($projcode14!='') {
				$res14bqry="SELECT proj_sname, proj_fname FROM tblproject1 WHERE proj_code=\"$projcode14\"";
				$result14b=$dbh2->query($res14bqry);
				if($result14b->num_rows>0) {
					while($myrow14b=$result14b->fetch_assoc()) {
						$found14b=1;
				$proj_sname14b = $myrow14b['proj_sname'];
				$proj_fname14b = $myrow14b['proj_fname'];
				if($proj_sname14b=='') {
					$projnamefin="".substr($proj_fname14b, 0, 30)."";
				} else {
					$projnamefin=$proj_sname14b;
				} //if-else						
					} //while
				} //if
				} //if
				echo "<tr>";
				echo "<td>$ctr14</td>";
    if($datemeeting14==$datenow) {
    echo "<th><font colo='green'>".date('D Y-M-d', strtotime($datemeeting14))."</font></th>";
    } else {
    echo "<td>".date('D Y-M-d', strtotime($datemeeting14))."</td>";
    } //if-else
    echo "<td>".date('g:ia', strtotime($timedurfrom14))." to ".date('g:ia', strtotime($timedurto14))."</td><td>$name14</td><th class='text-left'>$projnamefin</th><td>$topic14</td>";

    //20220104 display column for list of eqpt needed
    echo "<td>";
    $res16query=""; $result16=""; $found16=0; $ctr16=0;
    $res16query="SELECT idadmctgmtgrmeqptlst, code, name FROM tbladmctgmtgrmeqptlst WHERE code<>''";
    $result16=$dbh2->query($res16query);
    if($result16->num_rows>0) {
        while($myrow16=$result16->fetch_assoc()) {
        $found16=1;
        $idadmctgmtgrmeqptlst16 = $myrow16['idadmctgmtgrmeqptlst'];
        $code16 = $myrow16['code'];
        $name16 = $myrow16['name'];
        if(preg_match("/$code16/", "$eqptlst14")) {
        echo "$name16<br>";
        } //if
        } //while
    } //if
    echo "</td>";
				echo "<td>".nl2br($notes14)."</td>";
				echo "</tr>";
				// reset vars
				$projnamefin="";

			} //while
		} //if
		echo "</tbody>";
		echo "</table>";
} //if($found15==1 && $mtgrmctr15>0)

?>
