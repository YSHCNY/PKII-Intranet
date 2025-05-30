<?php
	session_start();


    $alertMessage = isset($_SESSION['alert_message']) ? $_SESSION['alert_message'] : '';
    unset($_SESSION['alert_message']); 

    $drkmd = $_SESSION['drkmd'];

$servername = "localhost";
$username = "root";
$password = "sysad";
$dbname = "maindb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set("Asia/Manila");

// Function to convert timestamp to "time ago"
function timeAgo($datetime) {
    $time = strtotime($datetime);
    $diff = time() - $time;

    if ($diff < 60) {
        return $diff . " sec" . ($diff == 1 ? "" : "s") . " ago";
    } elseif ($diff < 3600) {
        return floor($diff / 60) . " mins ago";
    } elseif ($diff < 86400) {
        return floor($diff / 3600) . " hrs ago";
    } elseif ($diff < 2592000) {
        return floor($diff / 86400) . " days ago";
    } elseif ($diff < 31536000) {
        return floor($diff / 2592000) . " months ago";
    } else {
        return floor($diff / 31536000) . " years ago";
    }
}





if($_SESSION['drkmd'] == 0){
    // darkmode off
    $maintext = 'maintext';
    $subtext = 'text-muted';
    $mainbg = 'bg-white';
    $hero = 'bgforlight';
    $bodycolor = 'bg-light';
  
    // dashboard icon
    $iconColordash = '';
  
    // intra feed
    $ifeedalert = 'alert-success';
  
    // peronsal information
    $tableinfo = 'table-light';
  
    // Als 
    $theadof = 'table-dark';
    $currentday = 'info';
    $tblborder = 'border';
  
  ?>
  <style>
   
   .maintext{
    color:#1b3261;
   }
  
  .fc-toolbar {
    border: 1px solid #333 !important;
    color: white;
    padding: 10px;
  }
  
  
  
  .fc-list-event {
    cursor: pointer;
  }
  
  .fc-list-event:hover {
    color: black !important; /* White title */
    cursor: pointer;
  
  }
  
  a,
  .fc-toolbar-title,
  .fc-timegrid-slot-label{
    padding: 5px; 
    color: rgb(51, 51, 51) !important; 
  }
  
  
  
  </style>
  
  <?php
  
    
  
  
  }else{
  
    // darkmode on
    $maintext = 'maintext';
    $subtext = 'subtext';
    $mainbg = 'mainbg';
    $hero = 'bgfordark';
    $bodycolor = 'dark-mode';
  
     // dashboard icon
    $iconColordash = '#EDEDED';
  
     // intra feed
     $ifeedalert = 'alert-secondary';
  
      // peronsal information
      $tableinfo = 'table-dark';
  
      // Als 
    $theadof = 'table-light';
    $currentday = 'secondary';
  
    $tblborder = '';
  
    
    ?>
    
    <style>
      .mainbg {
        background-color: #373d42;
      }
      .maintext{
      color: #e3e7ea !important;
    }
  
    .subtext{
      color: #7a8c96 !important;
    }
  
  
  
  .fc-event {
    background-color: rgb(37, 101, 13) !important;
    border-color: rgb(52, 154, 14) !important;
  }
  
  .fc-day-today {
    background-color: rgb(28, 63, 15) !important; 
  }
  
  
  
  .fc-toolbar {
    background: #333;
    color: white;
    padding: 10px;
  }
  
  
  
  .fc-list-event {
    color: #fff !important; /* White title */
    cursor: pointer;
  }
  
  .fc-list-event:hover {
    color: black !important; /* White title */
    cursor: pointer;
  
  }
  
  
  
  
  a,
  .fc-toolbar-title,
  .fc-timegrid-slot-label{
    padding: 5px; 
    color: rgb(220, 219, 219) !important; 
  }
  
  .fc-event-title {
    color: #ffffff !important; 
  }
  
  
        .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter label {
        color: white !important; /* Change to your desired color */
        font-weight: bold;
    }
    
    /* Change color of pagination text */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #007bff !important; /* Change to your desired color */
    }
  
    .dataTables_wrapper .dataTables_info {
      color: white !important; /* Change to your desired color */
   
      font-size: 14px;
  }
    </style>
    
    <?php
  }
  ?>


<div class="container  rounded-4 mb-4 mt-5">
<a class = 'btn btn-primary p-2 mb-3 text-white text-decoration-none' href="<?php echo "index.php?lst=1&lid=$loginid&sess=$session&p=43&title=Intra%20Feed%20"?>">Back</a>

    <div class = 'p-4 shadow border rounded'>
        <h4 class="fw-semibold pb-0 mb-0 <?php echo $maintext?>">Your Created Posts </h4>
        <p class = ' <?php echo $subtext?>'>Manage your shared post activity. <i>(note: Your anonymous posts will not display here)</i></p>
    </div>
</div>

<?php if (!empty($alertMessage)): ?>
  <div class="container mt-4">
  <div id="sessionAlert" class="alert alert-primary" role="alert">
  <?= htmlspecialchars($alertMessage) ?>
  </div>
</div>

    
    <?php endif; ?>

<script>
        document.addEventListener("DOMContentLoaded", function() {
            let alertBox = document.getElementById("sessionAlert");
            if (alertBox) {
                setTimeout(() => {
                    alertBox.classList.add("fade");
                    setTimeout(() => alertBox.remove(), 500); // Remove after fade out
                }, 3000);
            }
        });
    </script>

    
<div class="bodyofpost container">
    <div id="posts-container" class="pb-5 pt-4 px-3 mb-3">
        <?php
        // Fetch shared posts
        $sql = "SELECT id, usern, empid, userimg, shrdpst, anonflag, timestamp FROM tblshrdpst WHERE empid = '$employeeid0'  ORDER BY timestamp DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $taggedid = $row['id'];
                $userimg = ($row["anonflag"] == 1) ? "./img/anon.png" : htmlspecialchars($row["userimg"]);
                $username = ($row["anonflag"] == 1) ? "<span class='anon'>Anonymous</span>" : htmlspecialchars($row["usern"]);
                $post = htmlspecialchars($row["shrdpst"]);
                $timeAgo = timeAgo($row["timestamp"]);

                echo "  <div class='post position-relative shadow border $mainbg rounded p-4 mb-5' > 
                <div class=' position-absolute d-flex top-0 start-80 translate-middle'>
                        <a href = 'ifupdel.php?lst=1&loginid=$loginid&sess=$session&delid=$taggedid' class='btn btn-sm btn-danger $maintext' style='transform: rotate(-20deg);'>Remove</a>
                      </div>
                ";
                
                echo "
                <div class='d-flex gap-2 align-items-center border-bottom p-3'>
                      <img height='40' width='40' class='rounded-circle border' src='$userimg' />
                      <div class='ml-3'>
                        <p class='font-weight-bold $maintext mb-1'>$username</p>
                        <p class='$subtext small mb-0'>$timeAgo</p>
                     
                      </div>
                     
                      </div>";
                echo "<div class='my-5 mx-auto d-flex border-b w-75'><h4 class='m-auto fw-regular $maintext font-monospace'>$post </h4></div>";
                echo "</div>";
            }
        } else {
            echo "<div class='text-center mt-5 pt-5'><h4 class='$subtext'>You have no posts.</h4></div>";
        }
        ?>
    </div>
</div>

<script>
    function fetchPosts() {
        $("#posts-container").load(window.location.href + " #posts-container > *");
    }

    $(document).ready(function() {
        setInterval(fetchPosts, 3000);
    });
</script>

</body>
</html>

<?php
$conn->close();
?>
