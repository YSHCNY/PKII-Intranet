<?php

include("db1.php");

$loginid = isset($_GET['loginid']) ? $_GET['loginid'] : '';

$found = 0;

if ($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("db1.php");

    $conn = new mysqli($hostname, $dbuser, $dbuserpass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected successfully<br>";
    }

    $durationfrom_date = isset($_POST['durationfrom']) ? $_POST['durationfrom'] : '';
    $durationfrom_time = isset($_POST['durationfromh']) ? $_POST['durationfromh'] : '';
    $durationto_date = isset($_POST['durationto']) ? $_POST['durationto'] : '';
    $durationto_time = isset($_POST['durationtoh']) ? $_POST['durationtoh'] : '';
    $reason = isset($_POST['reason']) ? $_POST['reason'] : '';
    $idhrtalvreq = isset($_POST['idhrtalvreq']) ? $_POST['idhrtalvreq'] : '';

    $durationfrom = $durationfrom_date . ' ' . $durationfrom_time;
    $durationto = $durationto_date . ' ' . $durationto_time;

    var_dump($durationfrom, $durationto, $reason, $idhrtalvreq);

    $stmt = $conn->prepare("UPDATE tblhrtalvreq SET durationfrom = ?, durationto = ?, reason = ? WHERE idhrtalvreq = ?");
    
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssss", $durationfrom, $durationto, $reason, $idhrtalvreq);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            // Set success message
            session_start();
            $_SESSION['success_message'] = "Record updated successfully";
            header("Location: hrtimeattcutleave.php?loginid=$loginid");
            exit;
        } else {
            echo "No records updated";
        }
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

} else {
    include("logindeny.php");
}

?>