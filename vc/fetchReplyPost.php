<?php

$servername = "localhost";
$username = "root";
$password = "sysad";
$dbname = "maindb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
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
        $minutes = floor($diff / 60);
        return $minutes . " min" . ($minutes == 1 ? "" : "s") . " ago";
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . " hr" . ($hours == 1 ? "" : "s") . " ago";
    } elseif ($diff < 2592000) { // 30 days
        $days = floor($diff / 86400);
        return $days . " day" . ($days == 1 ? "" : "s") . " ago";
    } elseif ($diff < 31536000) { // 12 months
        $months = floor($diff / 2592000);
        return $months . " month" . ($months == 1 ? "" : "s") . " ago";
    } else {
        $years = floor($diff / 31536000);
        return $years . " year" . ($years == 1 ? "" : "s") . " ago";
    }
    
}

?>

<style>
    button:focus, button:active {
    box-shadow: none !important;
    outline: none !important;
}


.like-btn {
    transition: transform 0.3s ease-in-out;
}
.like-btn.liked {
    transform: scale(1.2);
}

</style>






<?php

$drkmd = isset($_POST['drkmd_flag']) ? intval($_POST['drkmd_flag']) : 0;



if($drkmd == 0){

    $maintext = '';
    $subtext = 'text-muted';
    $mainbg = 'bg-white';
    $hero = 'bgforlight';
    $bodycolor = '';
  
    // dashboard icon
    $iconColordash = '';
  
    // intra feed
    $ifeedalert = 'alert-success';
    $pathemptyheart = '';
    $pathfullyheart = '#06328d';
   
    $pathcomment= '';

  
  
  }else{
  
    $maintext = 'text-light';
    $subtext = 'text-white';
    $mainbg = 'bg-dark';
    $hero = 'bgfordark';
    $bodycolor = 'dark-mode';
  
     // dashboard icon
    $iconColordash = '#ffffff';
  
     // intra feed
     $ifeedalert = 'alert-secondary';
    $pathemptyheart = 'white';
    $pathfullyheart = 'white';
    $pathcomment= 'white';


  
  }


// $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
$postReplyId = isset($_POST['postReplyId']) ? intval($_POST['postReplyId']) : 0;


// $sql = "SELECT id, usern, empid, userimg, shrdpst, anonflag, timestamp FROM tblshrdpst ORDER BY timestamp DESC";
$sql = "SELECT * FROM tblshrdpst WHERE id = $postReplyId ORDER BY `timestamp` DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userimg = ($row["anonflag"] == 1) ? "./img/anon.png" : htmlspecialchars($row["userimg"]);
        $postid = $row['id'];
        $username = ($row["anonflag"] == 1) ? "<span class='anon'>Anonymous</span>" : htmlspecialchars($row["usern"]);
        $post = htmlspecialchars($row["shrdpst"]);
        $timeAgo = timeAgo($row["timestamp"]);
        // $likeCount = $row['like_count'];
        // $userLiked = $row['user_liked'] > 0;
        // $heartIcon = $userLiked ? "❤️" : "🩶";
       


       
        echo "<div class='post   $mainbg  p-4 ' data-post-id='$postid'>";
        echo "<div class='d-flex gap-2 border-bottom align-items-center  p-3'>
                <img height='30' width='30' class='rounded-circle border' src='$userimg' />
                <div class='ml-3'>
                    <p class='font-weight-bold  $maintext mb-0 pb-0'>$username</p>
                    <p class='$subtext mb-0'>$timeAgo</p>
                </div>
              </div>";

              echo "<div class='p-5 mx-auto d-flex justify-content-center align-items-center border-b text-break text-wrap' style='max-width: 100%;'>
              <h4 class='m-0  font-monospace $maintext'>$post</h4>
            </div>";

//               echo "<div class = 'pt-4  text-start'>";
//             //   echo "<button class='btn border-0 btn-lg like-btn mx-2' data-post-id='$postid' data-liked='$userLiked'>
//             //   <span class='heart'>$heartIcon</span> <span class='like-count'>$likeCount</span>
//             // </button>";

  

       
// echo "</div>";
            


        echo "</div>";
    


    
    }
} else {
    echo "<div class = 'text-center mt-5 pt-5' ><h4 class = '$maintext'>Be the first one to share! $postReplyId</h4></div>";
}

$conn->close();
?>


<!-- ❤️ -->