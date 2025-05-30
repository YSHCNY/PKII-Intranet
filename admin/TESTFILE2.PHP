<script>
    // This function will fetch new data from the server every 5 seconds
    function fetchNewData() {
        // Create a new AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'fetch_new_data.php', true);  // Call the PHP script

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Parse the JSON response
                var data = JSON.parse(xhr.responseText);
                
                // Clear the existing table rows
                var tableBody = document.getElementById('table-body');  // Make sure your table body has the ID "table-body"
                tableBody.innerHTML = '';  // Clear the existing rows

                // Loop through the fetched data and append new rows to the table
                data.forEach(function(row) {
                    var tr = document.createElement('tr');
                    tr.classList.add('clickable-row');
                    tr.setAttribute('data-href', 'itadmsuppreqdtl.php?loginid=<?php echo $loginid; ?>&its=' + row.iditsupportreq);

                    // Create table cells and append them to the row
                    tr.innerHTML = `
                        <td>${new Date(row.stamprequest).toLocaleString()}</td>
                        <td>${row.ticketnum === '0' ? '<span class="text-danger fw-semibold">Unassigned</span>' : row.ticketnum}</td>
                        <td>${row.categnames}</td>
                        <td>${row.deptcd}</td>
                        <td>${row.classreqtyp}</td>
                        <td>${row.name_last}, ${row.name_first}</td>
                        <td>${row.approvectr >= 1 ? 'Approved' : 'Pending Approval'}</td>
                        <td>${row.actionctg}</td>
                        <td>${row.scoreval}</td>
                        <td>${row.closeticketsw == 0 ? 'OPEN' : 'CLOSED'}</td>
                    `;

                    tableBody.appendChild(tr);  // Append the row to the table
                });
            }
        };

        xhr.send();
    }

    // Fetch new data every 5 seconds
    setInterval(fetchNewData, 5000);  // Adjust the interval as needed
</script>
