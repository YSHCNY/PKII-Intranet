<?php include("header.php");


require '../includes/dbh.php';

	$result11=""; $found11=0;
	$res11query = "SELECT employeeid, contactid FROM tbllogin WHERE loginid=$loginid AND username=\"$username\" AND password=md5('$password') LIMIT 1";
	$result11=$dbh->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$employeeid11=$myrow11['employeeid'];
		$contactid11=$myrow11['contactid'];
    } // while
	} // if

// $dbh->close();
// querry to find username 


function generateRandomString($length = 4) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
} //generate radom strings for code

// echo "<h1>". generateRandomString() ."</h1>"; might be handy later



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $username = isset($_POST['uname']) ? $_POST['uname'] : '';


    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

    // echo "Email: " . $email . "<br>";
    // echo "Username: " . $username;
} else {

    echo "Invalid request.";
} // get email and username attrib





	$res11query = "SELECT employeeid FROM tbllogin WHERE username=\"$username\" LIMIT 1";
	$result11=$dbh->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$employeeid11=$myrow11['employeeid'];

    } 
	} //get employee id
// echo '' . $employeeid11;
//     echo "Email: " . $email . "<br>";
//     echo "Username: " . $username;


$expiry = date('Y-m-d H:i:s', strtotime('+20 minutes'));
$random = generateRandomString();
$insertQuery = "INSERT INTO respass (codes, user, empid, email, expiry) VALUES ('$random', '$username', '$employeeid11',  '$email', '$expiry')";

$insertResult = mysql_query($insertQuery);

// Check if the query was successful
if ($insertResult) {
    echo "Records inserted successfully!";
} else {
    echo "Error inserting records: " . mysql_error();
}

?>