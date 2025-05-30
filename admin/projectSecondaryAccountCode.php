<?php 
include("db1.php");
include("tjfunctions/tjclasses.php");

	 $query = "Select * from tblfinprojinsecondary where status ='1'";
	 $res = $dbh2->query($query);

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'projinsecondary_id', 
	1 => 'acctcode_to',
	2 => 'acctcode_from',
	3 => 'secondary_account_name',
	4 => 'datecreated',
);

$totalData = mysqli_num_rows($res);


$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * from tblfinprojinsecondary Where 1=1 AND status ='1'";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( secondary_account_name LIKE '%".$requestData['search']['value']."%' ";    
}
$res = $dbh2->query($sql);
$totalFiltered = mysqli_num_rows($res); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$res = $dbh2->query($sql);
$data = array();


while( $row=$res->fetch_assoc() ) {  // preparing an array
	$nestedData=array(); 
	$btn = "<button class='btn btn-success btn-edit' data-id='".$row['projinsecondary_id']."' style='margin-right:5px;'>Edit</button>";
	$btn .= "<button class='btn btn-danger btn-delete' data-id='".$row['projinsecondary_id']."' style='margin-right:5px;'>Delete</button>";
		$resquery = "SELECT * from tblfinprojinprimary WHERE projinprim_id=".$row["fk_projinprimary_id"];
		$result = $dbh2->query($resquery);
		$row1 = '';

		while($myrow = $result->fetch_assoc()) {
			$row1 = $myrow['account_code']. ' - ' .$myrow['account_name'];
		} 

	$nestedData[] = $row["projinsecondary_id"];
	$nestedData[] = $row1;
	$nestedData[] = $row["acctcode_from"];
	$nestedData[] = $row["acctcode_to"];
	$nestedData[] = $row["secondary_account_name"];
	$nestedData[] = date('F d, Y', strtotime($row["timestamp"]));
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