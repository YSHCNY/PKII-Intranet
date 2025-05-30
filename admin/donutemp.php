<?php
$servername = "localhost";
$username = "root";
$password = "sysad";
$dbname = "maindb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT YEAR(date_hired) AS hire_year, COUNT(*) AS total_count
        FROM tblcontact 
        JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid 
        WHERE tblcontact.contact_type = 'personnel' 
        AND tblemployee.emp_record = 'active'
        GROUP BY YEAR(date_hired)
        ORDER BY hire_year";
$result = $conn->query($sql);

$years = [];
$counts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $years[] = $row['hire_year'];
        $counts[] = $row['total_count'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="hireChart"></canvas>
    <script>
        var ctx = document.getElementById('hireChart').getContext('2d');
        var hireChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($years); ?>,
                datasets: [{
                    label: 'Total Hires Per Year',
                    data: <?php echo json_encode($counts); ?>,
                    borderColor: 'rgb(57, 102, 133)',
                    backgroundColor: 'rgba(75, 112, 192, 0.2)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                    },
                plugins: {
                    tooltip: {
                        enabled: true,
                        position: 'nearest',
                     
                    },
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Hires Per Year'
                    },
                
                 
                }
            }
        });
    </script>
</body>
</html>
