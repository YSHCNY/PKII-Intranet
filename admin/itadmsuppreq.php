<script>
document.addEventListener("DOMContentLoaded", function() {
    var rows = document.querySelectorAll(".clickable-row");
    rows.forEach(function(row) {
        row.addEventListener("click", function() {
            window.location.href = this.dataset.href;
        });
    });
});

</script>

<style>
	th,td{
		font-family: 'Poppins', sans-serif !important;
		vertical-align: middle !important;
		text-align: center !important;
	}
    tbody tr:hover {
      cursor: pointer !important;
 
    }

	tbody tr{
		padding: 10px 5px 10px 5px !important ;

	}
	#notification{
		height: 60px;
		position: absolute;
		width: 75% !important;
	}

	.live-indicator {
    display: flex;
    align-items: center;
    font-family: Arial, sans-serif;
    font-weight: bold;
    color: red;
    font-size: 18px;
    gap: 8px; 
}


.live-indicator .circle {
    width: 9px;
    height: 9px;
    background-color: red;
    border-radius: 50%;
    animation: blink 1s infinite step-start;
}


.live-indicator .text {
    animation: blink 1s infinite step-start;
}


@keyframes blink {
    50% {
        opacity: 0;
    }
}


</style>

<?php
session_start();

include("db1.php");
include("datetimenow.php");
include("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$yrmonthavlbl = (isset($_POST['yrmonthavlbl'])) ? $_POST['yrmonthavlbl'] :'';
$dd1ticktyp = (isset($_POST['dd1ticktyp'])) ? $_POST['dd1ticktyp'] :'';
$dd2deptcd = (isset($_POST['dd2deptcd'])) ? $_POST['dd2deptcd'] :'';
$classreqtyp = (isset($_POST['classreqtyp'])) ? $_POST['classreqtyp'] :'';

$orderbydate = (isset($_POST['orderbydate'])) ? $_POST['orderbydate'] :'';
$sortby = (isset($_POST['sortby'])) ? $_POST['sortby'] :'';

$notification = isset($_SESSION['notification']) ? $_SESSION['notification'] : '';
// Clear notification from session
unset($_SESSION['notification']);

if($yrmonthavlbl == '') {
  $selyear = $yearnow;
  $selmonth = date("F", mktime(0, 0, 0, $monthnow));
  $yrmonthavlbl = $selyear." ".$selmonth;
}
// if($dd1ticktyp=='') { $dd1ticktyp="0"; }
if($dd1ticktyp=='') { $dd1ticktyp="2"; }
if($dd2deptcd=='') { $dd2deptcd="ALL"; }
if($classreqtyp=='') { $classreqtyp=5; }

$found = 0;
$accesslevel11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
    include ("header.php");
    include ("sidebar.php");

	if ($notification) {
		echo "
			<div id='notification' class='alert alert-danger d-flex align-items-center' role='alert'>
				<h4 class='text-danger my-auto'>$notification</h4>
			</div>
		";
		echo "
			<script>
				// JavaScript code to hide the notification after 3 seconds
				document.addEventListener('DOMContentLoaded', function() {
					setTimeout(function() {
						var notification = document.getElementById('notification');
						notification.style.transition = 'opacity 1s';
						notification.style.opacity = '0';
						setTimeout(function() {
							notification.style.display = 'none';
						}, 1000); // 1000 milliseconds = 1 second
					}, 3000); // 3000 milliseconds = 3 seconds
				});
			</script>
		";
	}
?>


<div class="shadow p-5 poppins">

<div class="row px-4">
<div class="col">
	<p class="fs-3 fw-bold mb-0 poppins">Ticket Request</p>
    <p class=" fs-5 poppins">Tech Support Request Summary<i class = 'text-primary poppins'> (click rows to view details)</i></p>
</div>
<div class="col ">
<div class="live-indicator justify-content-end">
    <div class="circle"></div>
    <h4 class="text fw-semibold">LIVE</h4>
	<a href="itsuppreqoriginal.php?loginid=<?php echo $loginid; ?>" class = ''>| End live</a>
</div>
</div>
</div>

<div class="row mt-5 mb-3">
<div class="col">
<h5 class = 'mt-3 mx-2'><span class = 'text-secondary'>Total Rows: </span><span id="rowCount">0</span></h5>
</div>
	<div class = 'col d-flex align-end justify-content-end  mb-2'>
	<p class = 'mt-3'>Search: </p>
	<input type="text" id="searchInput" placeholder="Search..." class="mx-2 w-50  form-control">
	</div>
	</div>


	<div class="table-responsive">
	<table  style='width:100%' class = 'table table-bordered  table-hover'>

	<thead>
	<tr class = 'fs-5 fw-normal text-capitalize'>

		<th>Request Date</th>
		<th>Ticket no.</th>
		<th>request type</th>
		<th>department</th>
		<th>Classification</th>
		<th>requestor</th>
		<th>approval status</th>
		<th>action taken</th>
		<th>score</th>
		<th>ticket status</th>
		<th>Duration</th>
		<th>Allowed Duration</th>
	
	</tr>

	</thead>

	<tbody id="tbodyid">





	</tbody>
</table>

<script>
 // Function to fetch data and bind events
function fetchData() {
	const loginid = <?php echo $loginid?>;
        const xhr = new XMLHttpRequest();
		xhr.open('GET', `itsuppreqbody.php?loginid=${encodeURIComponent(loginid)}`, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            // Replace table body with new rows
            document.getElementById('tbodyid').innerHTML = xhr.responseText;

            // Bind the click event to .clickable-row elements
            var rows = document.querySelectorAll(".clickable-row");
            rows.forEach(function(row) {
                row.addEventListener("click", function() {
                    window.location.href = this.dataset.href;
                });
            });

            // Reapply the filter on the new rows
            filterTable();
        } else {
            console.error('Failed to fetch data');
        }
    };

    xhr.onerror = function() {
        console.error('Request failed', xhr);
    };

    xhr.send();
}

// Initial data load
fetchData();

// Refresh the data every 5 seconds
setInterval(fetchData, 5000);

// Live search functionality
function filterTable() {
    let input = document.getElementById('searchInput').value.toLowerCase();
    let rows = document.querySelectorAll('#tbodyid tr'); // Select all rows in the table body

    rows.forEach(function(row) {
        let rowText = row.textContent.toLowerCase(); // Get the row text content
        if (rowText.includes(input)) {
            row.style.display = ''; // Show row if it matches
        } else {
            row.style.display = 'none'; // Hide row if it doesn't match
        }
    });
    countRows();
  }

  // Count visible rows and update display
  function countRows() {
      let visibleRows = document.querySelectorAll('#tbodyid tr:not([style*="display: none"])');
      document.getElementById('rowCount').textContent = visibleRows.length;
  }

// Event listener on the search input
document.getElementById('searchInput').addEventListener('keyup', filterTable);

document.addEventListener("DOMContentLoaded", function() {
    // Delegate the click event to the parent tbody
    var tbody = document.getElementById('tbodyid');
    
    tbody.addEventListener('click', function(event) {
        // Check if the clicked element is a row with class 'clickable-row'
        if (event.target.closest('.clickable-row')) {
            window.location.href = event.target.closest('.clickable-row').dataset.href;
        }
    });

});


</script>
	<?php
// end cont

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result = $dbh2->query($resquery);
     include ("footer.php");

} else {
     include ("logindeny.php");
}

?>

<div class="d-flex justify-content-end mt-5 mb-3">
	<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">
		<button class="border-0 rounded-3" style="width: 170px; height: 40px; background-color: #0a1d44;">Back</button>
	</a>
</div>
	
	</div>
	</div>

<?php

$dbh2->close();
?>













<!-- 





