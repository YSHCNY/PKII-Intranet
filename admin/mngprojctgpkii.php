<?php 

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Manage >> Categories >> PKII project categories</font></p>";

// start contents here...
  if($accesslevel >= 4) {

    echo "<table class=\"table table-striped\">";
		echo "<thead>";
    echo "<tr><th colspan=\"6\">Manage Categories - PKII Project Categories</th></tr>";
		echo "</thead>";
		echo "<tbody>";
		echo "<tr><th colspan=\"6\">";
		echo "<form action=\"mngprojctgpkiiadd.php?loginid=$loginid\" method=\"POST\" name=\"mngprojmilestoneadd\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#myModal\">Add new</button>";
		echo "</form>";
		echo "</th></tr>";
		echo "<tr><th>ctr</th><th>code</th><th>name</th><th>seq</th><th colspan=\"2\">action</th></tr>";
		// query tblprojctgmilestone
		$res11query="SELECT idprojctgpkii, code, name, seq FROM tblprojctgpkii ORDER BY seq ASC";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11=$ctr11+1;
			$idprojctgpkii11 = $myrow11['idprojctgpkii'];
			$code11 = $myrow11['code'];
			$name11 = $myrow11['name'];
			$seq11 = $myrow11['seq'];
			echo "<tr><td>$ctr11</td><td>$code11</td><td>$name11</td><td>$seq11</td>";
			echo "<form action=\"mngprojctgpkiiedt.php?loginid=$loginid\" method=\"POST\" name=\"mngprojctgpkiiedt\">";
			echo "<input type=\"hidden\" name=\"idprojctgpkii\" value=\"$idprojctgpkii11\">";
			echo "<td><button type=\"submit\" class=\"btn btn-primary\">Edit</button></td>";
			echo "</form>";
			echo "<form action=\"mngprojctgpkiidel.php?loginid=$loginid\" method=\"POST\" name=\"mngprojctgpkiidel\">";
			echo "<input type=\"hidden\" name=\"idprojctgpkii\" value=\"$idprojctgpkii11\">";
			echo "<td><button type=\"submit\" class=\"btn btn-warning\">Del</button></td>";
			echo "</form>";
			echo "</tr>";
			} // while
		} // if
		echo "</tbody>";
    echo "</table>";
?>
	<!-- start modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

			<!-- Header-->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
				<span aria-hidden="true">&times;</span>
				<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Manage Categories - Project milestones - Add new</h4>
			</div>

			<!-- Body -->
			<div class="modal-body">
				<table class="table table-striped">
			<!--
				<thead>
				<tr><th colspan="2">Manage Categories - Project milestones - Add new</th></tr>
				</thead>
			-->
				<tbody>
<?php
		// echo "<form action=\"mngprojctgpkiiadd.php?loginid=$loginid\" method=\"POST\" name=\"mngprojctgpkiiadd\">";
		echo "<tr><th class=\"text-right\">code</th><td><input size=\"10\" name=\"code\"></td></tr>";		
		echo "<tr><th class=\"text-right\">name</th><td><input size=\"80\" name=\"name\"></td></tr>";		
		echo "<tr><th class=\"text-right\">seq</th><td><input type=\"number\" min=\"1\" max=\"100\" name=\"seq\"></td></tr>";		
		echo "<tr><th></th><td>";
		echo "<button class=\"btn btn-primary\">Add new</button>";
		echo "</td></tr>";
		// echo "</form>";
?>
				</tbody>
				</table>
			</div>

			<!-- Footer -->
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Add new</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			</div>

			</div>
		</div>
	</div>
<!-- end modal -->

<?php
  } // if($accesslevel>=4)
// end contents here...

// edit body-footer
     echo "<p><button type=\"button\" class=\"btn btn-primary\" onclick=\"window.location='mngcateg.php?loginid=$loginid'\">Back</button></p>";

		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery);

     include ("footer.php");
} else {
     include("logindeny.php");
}

$dbh2->close();
?>