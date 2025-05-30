<?php 
include("db1.php");
include("tjfunctions/tjclasses.php");

	 $query = "Select * from tblinventory";
	 $res = $dbh2->query($query);

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'inventory_name', 
	1 => 'inventory_code',
	2 => 'inventory_class',
	3 => 'inventory_holder',
	4 => 'inventory_logged',
	5 => 'inventory_balance',
	6 => 'inventory_restock',
);

$totalData = mysqli_num_rows($res);


$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * from tblinventory Where 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( inventory_name LIKE '%".$requestData['search']['value']."%' ";    
	$sql.=" OR inventory_code LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR inventory_class LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR inventory_holder LIKE '%".$requestData['search']['value']."%' )";
}
$res = $dbh2->query($sql);
$totalFiltered = mysqli_num_rows($res); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$res = $dbh2->query($sql);
$data = array();
while( $row=$res->fetch_assoc() ) {  // preparing an array
	$nestedData=array(); 
	$stock = $row["inventory_balance"];
	$btn = "<button class='btn btn-success btn-make' data-id='".$row['inventory_id']."' style='margin-right:5px;'>Restock</button>";
	if($row['inventory_class'] == 'Fixed Asset')
	{
		// $btn = "<button class='btn btn-default btn-make' style='margin-bottom:5px;'>Change User</button> <button class='btn btn-danger btn-remarks' style='margin-bottom:5px;'>Report Asset</button>";
	}
	// $btn .= "<button class='btn btn-warning btn-show' >Show Logs</button>";
	if( $row["inventory_balance"] <= $row["inventory_restock"])
	{$stock = "<span style='color:red;'>".$row['inventory_balance']."</span>";}
	$nestedData[] = $row["inventory_name"];
	$nestedData[] = $row["inventory_code"];
	$nestedData[] = $row["inventory_class"];
	$nestedData[] = $row["inventory_holder"];
	$nestedData[] = $row["inventory_logged"];
	
	$nestedData[] = $stock;
	$nestedData[] = $row["inventory_restock"];
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