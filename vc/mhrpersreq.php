<?php
//
// mhrpersreq.php
// fr: vc/index.php
// indexlinks: $page==35

require '../includes/config.inc';

$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
if($logintype==1) {
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
} else if($logintype==2) {
$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
} // if
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';

?>
	<div class="mainbgc my-5 p-5">
		<div class=""><h4 class = 'ms-5 py-5 text-white'>HR Personnel Requisition Form</h4></div>
	</div>

<div class="container-fluid px-5">
	<div class="">
	<div class = 'table-responsive border p-5 rounded-4 shadow mt-3 mb-5'>
		<div class = 'mb-5 '>
	<div class="row">
		<div class="col"><p class = 'fw-bold maintext'>Personnel Request Details</p></div>
		<div class="col">

		<?php
	// display new request button for non-admin
	if($logintype==1) {
	echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=351\" class= 'float-end' method=\"POST\" name=\"mhrpersreqadd\">";
	echo "<button type=\"submit\" class=\"secondarybgc text-white px-3 py-2 rounded-3 border-0\" value=\"New request\">New request</button>";
	echo "</form>";
	} // if
?>
		</div>
	</div>
		
</div>
		<!-- <tr><th colspan="2" class="text-center">Personnel Request Details</th></tr>
		<tr><td colspan="2"> -->
			<table class="table-striped table-hover" id = 'example'>
			<thead>
				<tr>
					<th >Request date</th>
					<th >Position</th>
					<th >Department</th>
					<th >Employee type</th>
					<th >No. of staff needed</th>
					<th >Date needed</th>
					<th >Requested by</th>
					<th >Endorsed by</th>
					<th >Recommended by</th>
					<th >Approved by</th>
					<th >Action</th>
				</tr>
				<style>
	
						td, th{
							font-size: 12px !important;
						}
							@media (max-width: 768px) {
							th, td {
								font-size: 10px !important;
							}
							}

							@media (min-width: 768px) {
								th, td {
									font-size: 10px; 
								}
								}

				</style>
			</thead>
			<tbody>
			<?php include("hrpersreqtbl.php");?>
			</tbody>
			</table>
		</td></tr>
	</tbody>
</table>
		
</div>
</div>
</div>





