<?php
// Your database connection here
include("db1.php");

$res11query = "
SELECT 
    tblitsupportreq.*, 
    tblcontact.*, 
    GROUP_CONCAT(tblitctgsuppreq.name ORDER BY tblitctgsuppreq.code SEPARATOR '<br>- ') AS categnames, 
    approver.name_last AS approver_last, approver.name_first AS approver_first,
    closer.name_last AS closer_last, closer.name_first AS closer_first,
    actionctg.name AS action_name
FROM 
    tblitsupportreq
LEFT JOIN 
    tblcontact ON tblitsupportreq.employeeid = tblcontact.employeeid
LEFT JOIN 
    tblitctgsuppreq ON tblitsupportreq.requestctg LIKE CONCAT('%', tblitctgsuppreq.code, '|%')
LEFT JOIN 
    tblcontact AS approver ON tblitsupportreq.approveempid = approver.employeeid
LEFT JOIN 
    tblitctgsuppreq AS actionctg ON tblitsupportreq.actionctg = actionctg.code
LEFT JOIN 
    tblcontact AS closer ON tblitsupportreq.actionempid = closer.employeeid
GROUP BY 
    tblitsupportreq.iditsupportreq, tblcontact.employeeid
ORDER BY 
    tblitsupportreq.stamprequest DESC;
";

$result11 = $dbh2->query($res11query);
$data = [];

if ($result11->num_rows > 0) {
    while ($myrow11 = $result11->fetch_assoc()) {
        $data[] = $myrow11; // Add each row to the data array
    }
}

// Return the data in JSON format
echo json_encode($data);
?>
