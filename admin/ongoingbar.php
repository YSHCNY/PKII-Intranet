<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart.js with PHP</title>
 
</head>
<body>
<script>
    	    window.onload = function() {
        document.body.style.opacity = 1;
    };
</script>
<!-- <p>Total Entries: <span id="totalCount">0</span></p> -->
<canvas id="myChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Fetch data from PHP
        fetch('databar.php')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => item.full_range);
            const values = data.map(item => item.proj_period_count);

            // const totalCount = values.reduce((sum, value) => sum + parseInt(value), 0);
            // document.getElementById('totalCount').textContent = totalCount;

            // Render Chart
            const ctx = document.getElementById('myChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
              
                        label: 'Project Count',
                    data: values,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.4  

                    }]
                },
                options: {
                responsive: true,
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
                        text: 'On Going Projects'
                    },
                
                 
                }
            },


            });
        })
        .catch(error => console.error('Error fetching data:', error));
    </script>

</body>
</html>