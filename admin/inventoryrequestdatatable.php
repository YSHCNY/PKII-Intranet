<?php 
include("db1.php");

	 $query = "Select * from tblinventoryrequest LEFT JOIN tblinventory ON tblinventoryrequest.fk_inventory_id = tblinventory.inventory_id";
	 $res = $dbh2->query($query);

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'request_id', 
	1 => 'inventory_name',
	2 => 'request_date',
	3 => 'request_quantity',
	4 => 'request_status',
	5 => 'request_comment',
	6 => 'request_remarks',
);
$totalData = mysqli_num_rows($res);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * from tblinventoryrequest LEFT JOIN tblinventory ON tblinventoryrequest.fk_inventory_id = tblinventory.inventory_id Where 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( inventory_name LIKE '%".$requestData['search']['value']."%' ";    
	$sql.=" OR request_status LIKE '%".$requestData['search']['value']."%' )"; 
}
$res = $dbh2->query($sql);
$totalFiltered = mysqli_num_rows($res); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$res = $dbh2->query($sql);
$data = array();
while( $row=$res->fetch_assoc() ) {  // preparing an array
	$nestedData=array(); 


	$status = $row["request_status"];
	$btn = "<button class='btn btn-success btn-view' data-id='".$row['request_id']."' style='margin-right:5px;'>View Request</button>";

	if( $row["request_status"] == 'Pending')
	{
		$status = "<span style='color:yellow;'>".$row['request_status']."</span>";
		$btn .= "<button class='btn btn-danger btn-cancel'  data-id='".$row['request_id']."'>Reject Request</button>";
		$btn .= "<button class='btn btn-primary btn-approve' style='margin-top:5px'  data-id='".$row['request_id']."'>Approve Request</button>";

	}
	elseif( $row["request_status"] == 'Approved')
	{$status = "<span style='color:green;'>".$row['request_status']."</span>";}
	elseif( $row["request_status"] == 'Rejected')
	{$status = "<span style='color:red;'>".$row['request_status']."</span>";}
	elseif( $row["request_status"] == 'Cancelled')
	{$status = "<span style='color:red;'>".$row['request_status']."</span>";}
	elseif( $row["request_status"] == 'Delivered')
	{$status = "<span style='color:blue;'>".$row['request_status']."</span>";}

$type = '';


	if($row['inventory_id'] == 6 || $row['inventory_id'] == '6')
	{
		$type = $row['request_type'];
	}
	else{
		$type = $row['inventory_type'];
	}



	$nestedData[] = $row["request_id"];
	$nestedData[] = $row["inventory_code"].'- ' .$type;
	$nestedData[] = $row["request_date"];
	$nestedData[] = $row["request_quantity"];
	$nestedData[] = $status;
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