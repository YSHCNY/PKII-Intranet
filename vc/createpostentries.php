<?php
// Database connection (adjust as needed)
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


.like-btn:hover{
     color: rgb(160, 168, 173);
  
}



.reply-btn{
    


}

.reply-btn:hover{
    color: rgb(160, 168, 173);
   

}
</style>






<?php
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
$drkmd = isset($_GET['drkmd_flag']) ? intval($_GET['drkmd_flag']) : 0;


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



$emptyheart = "<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='$pathemptyheart' class='bi bi-heart' viewBox='0 0 16 16'>
  <path d='m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15'/>
</svg>";

$fullheart = "<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='$pathfullyheart' class='bi bi-heart-fill' viewBox='0 0 16 16'>
  <path fill-rule='evenodd' d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314'/>
</svg>";

$emptycomment = "<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='$pathcomment' class='bi bi-chat-left' viewBox='0 0 16 16'>
  <path d='M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z'/>
</svg>";





  



// $sql = 'SELECT id, usern, empid, userimg, shrdpst, anonflag, timestamp FROM tblshrdpst ORDER BY timestamp DESC';
$sql = "SELECT p.id, p.usern, p.empid, p.userimg, p.shrdpst, p.anonflag, p.timestamp, 
            (SELECT COUNT(*) FROM likes WHERE post_id = p.id) AS like_count,
            (SELECT COUNT(*) FROM likes WHERE post_id = p.id AND user_id = $user_id) AS user_liked
        FROM tblshrdpst p 
        ORDER BY p.timestamp DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userimg = ($row["anonflag"] == 1) ? "./img/anon.png" : htmlspecialchars($row["userimg"]);
        $postid = $row['id'];
        $username = ($row["anonflag"] == 1) ? "<span class='anon'>Anonymous</span>" : htmlspecialchars($row["usern"]);
        $post = htmlspecialchars($row["shrdpst"]);
        $timeAgo = timeAgo($row["timestamp"]);
        $likeCount = $row['like_count'];
        $userLiked = $row['user_liked'] > 0;
        $heartIcon = $userLiked ? "$fullheart" : "$emptyheart";
       

        $titlethis = ($likeCount == 1 || $likeCount == 0) ? 'Like' : 'Likes';
        $titlethiscomms = ($countedcomments == 1 || $countedcomments == 0) ? 'Comment' : 'Comments';

        $usernameText = strip_tags($username);
        
        $sqlcountComments = "SELECT COUNT(*) AS countedreplies FROM replies WHERE post_id = $postid";
        $resultCountComments = $conn->query($sqlcountComments);

        if($resultCountComments->num_rows > 0){
            while ($rowCountComms = $resultCountComments->fetch_assoc()){
                $countedcomments = $rowCountComms['countedreplies'];
            }
        }
    //    echo $drkmd;
   
        echo "<div class='post  shadow border $mainbg  rounded p-4 mb-5' data-post-id='$postid'>";
        echo "<div class='d-flex gap-2 align-items-center border-bottom p-3'>
                <img height='40' width='40' class='rounded-circle border' src='$userimg' />
                <div class='ml-3'>
                    <p class='fw-bold $maintext mb-1'>$username</p>
                    <p class='$subtext small mb-0'>$timeAgo</p>
                </div>
              </div>";

        // echo "<div class='m-5 p-5 mx-auto d-flex border-b '>
        //         <p class='m-auto   font-monospace'>$post</p>
        //       </div>";

        echo "<div class='p-5 mx-auto d-flex justify-content-center align-items-center border-b text-break text-wrap' style='max-width: 100%;'>
        <h4 class='m-0 py-5 $maintext font-monospace'>$post</h4>
      </div>";



//             //   counter
              echo "<div class =' border-top d-flex gap-4 pt-2 px-3 justify-content-end text-end'>
                

              
 <button class='viewlike-btn border-0 bg-transparent mb-1 fs-5  $subtext'
                type='button' 
              data-toggle='modal' 
              data-target='#viewlike' 
              data-postid='" . htmlspecialchars($postid, ENT_QUOTES, 'UTF-8') . "' 
              data-username='" . htmlspecialchars($usernameText, ENT_QUOTES, 'UTF-8') . "'> 
            $likeCount $titlethis
          </button>


              <button class='reply-btn border-0 bg-transparent mb-1 fs-5  $subtext' 
              type='button' 
              data-toggle='modal' 
              data-target='#replyModal' 
              data-postid='" . htmlspecialchars($postid, ENT_QUOTES, 'UTF-8') . "' 
              data-username='" . htmlspecialchars($usernameText, ENT_QUOTES, 'UTF-8') . "'>
             $countedcomments $titlethiscomms  </span> 
          </button>
</div>";


// button icon
              echo "<div class = 'pt-4 border-top text-center'>";
              echo "<button class='btn border-0 mx-5 like-btn' data-post-id='$postid' data-liked='$userLiked'>
              <span class='heart'>$heartIcon </span> <span class='$subtext'> $likeCount </span> 
            </button>";

            echo "<button class='reply-btn btn mx-5 border-0' 
            type='button' 
            data-toggle='modal' 
            data-target='#replyModal' 
            data-postid='" . htmlspecialchars($postid, ENT_QUOTES, 'UTF-8') . "' 
            data-username='" . htmlspecialchars($usernameText, ENT_QUOTES, 'UTF-8') . "'>
            $emptycomment </span>  <span class='$subtext'> $countedcomments </span> 
        </button>";


 

echo "</div>";
            



        echo "</div>";
    


    
    }
} else {
    echo "<div class = 'text-center mt-5 pt-5' ><h4 class = '$subtext'>Be the first one to share!</h4></div>";
}

$conn->close();
?>


<!-- ❤️ -->