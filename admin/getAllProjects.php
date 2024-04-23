<?php 
include("db1.php");
include("tjfunctions/tjclasses.php");
$loginid = $_GET['loginid'];
	 $query = "Select * from tblproject1 ";
	 $res = $dbh2->query($query);

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'projectid', 
	1 => 'proj_code',
	2 => 'proj_sname',
	3 => 'date_start',
	4 => 'date_end',
	5 => 'projstatus',
	6 => 'date_mob',
);

$totalData = mysqli_num_rows($res);


$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * from tblproject1 Where 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( proj_code LIKE '%".$requestData['search']['value']."%' ";    
	$sql.=" OR proj_sname LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR projstatus LIKE '%".$requestData['search']['value']."%') ";
}
$res = $dbh2->query($sql);
$totalFiltered = mysqli_num_rows($res); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." DESC LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$res = $dbh2->query($sql);
$data = array();
while( $row=$res->fetch_assoc() ) {  // preparing an array
	$nestedData=array(); 
	$status = $row["projstatus"];
	$progress = '';
	$btn = "<a class='btn btn-success btn-view' style='margin-right:5px;' href='projectManagementSingleProject.php?loginid=".$loginid."&pid=".$row['projectid']."'>View</a>";
	

	if( $status == '' || $status == null)
		{$status = "Finished";}
	if($status == 'Finished')
		{$progress = '100%';}
	else
		{$progress = '0%';}
	
	$progressGraph = '<div class="progress">';
	$progressGraph .= '<div class="bar" style="width:'.$progress.'">';
	$progressGraph .= '<p class="percent">'.$progress.'</p>';
	$progressGraph .= '</div>';
	$progressGraph .= '</div>';


	$nestedData[] = $row["proj_code"];
	$nestedData[] = $row["proj_sname"];
	$nestedData[] = $status;
	$nestedData[] = $row["date_start"];
	$nestedData[] = $row["date_end"];
	
	$nestedData[] = $progress;
	$nestedData[] = $progressGraph;
	$nestedData[] = $btn;
	
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format


mysql_close($dbh);


?>