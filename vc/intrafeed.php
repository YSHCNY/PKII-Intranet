<?php
	session_start();
  include '../m/qryvpersinfo.php';

  $alertMessage = isset($_SESSION['alert_message']) ? $_SESSION['alert_message'] : '';
  unset($_SESSION['alert_message']);
  
if ( isset($_SESSION['drkmd']) && $_SESSION['drkmd'] == 1){
  $drkmd = 1;
} else {
  $drkmd = 0;
}

?>
<script>
  // store id to post in creatpost
    var currentUserId = <?php echo $employeeid0; ?>;
    var drkmd = <?php echo $drkmd; ?>;


    
</script>

<style>
    /* Remove border and outline on focus */
.shrdposttxta:focus {
  border: none !important;
  box-shadow: none !important;
  outline: none !important;
}

/* Optional: remove the default focus ring */
.shrdposttxta:focus:active, .shrdposttxta:focus {
  box-shadow: none !important;
}

.shrdposttxta{
    height: 200px !important; 
    border: none !important;
  box-shadow: none !important;
  outline: none !important;
    
}

.modalpopper{
    background-color: #f0f0f0 !important;
}



</style>



<!-- Modal Post-->
<div class="modal fade" id="shrdpstmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="px-0">
        <!-- header -->
      <div class="d-flex <?php echo $mainbg ?> justify-content-between border-bottom pb-0 pt-3 px-5">
        <div class="text-center ">
  <h5 class="fw-bold <?php echo $subtext?> " id="exampleModalLabel">Share your thoughts </h5>
  </div>
  <button type="button" class="close " data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-dark <?php echo $mainbg ?>">&times;</span>
  </button>
</div>
      </div>
      <div class="modal-body <?php echo $mainbg?>">
       <?php echo "<form action = 'createpost.php?lst=1&loginid=$loginid&sess=$session' method = 'POST'>"; ?>
        <input type="hidden" name = 'userimgpath' value = '<?php echo "$pathavatar/$picfn0"; ?>'>
        <input type="hidden" name='usern' value="<?php echo "$name_first0 $name_last0"; ?>">
        <input type="hidden" name="empid" value = '<?php echo "$employeeid0";?>'>
            <div>
                <!-- textarea -->
                <textarea name="shrdpst" class = 'border-0 shrdposttxta form-control <?php echo "$mainbg $maintext"?> fs-3'  placeholder = "Tell us what's up <?php echo $name_first0; ?>!" id="" required></textarea>
            </div>
      </div>
            <div class = 'border-top <?php echo $mainbg ?> py-3'>
                    <div class="text-center">
                        <button type="submit"  class="btn bg-secondary text-white border rounded-3 px-5 py-3">Create Post</button>
                    </div>
<?php 

     if ($department == 'ITD'){
?>
                    <div class="d-flex justify-content-center gap-3 my-2">
                        <input type="checkbox" class="checkbox" name = 'anonflag' value='1' > <span class = '<?php echo $subtext?>'>Share Anonymously (ITD ONLY)</span>
                    </div>

                    <?php
                    }?>
            </div>
      </form>
    </div>
  </div>
</div>











<!-- reply page -->
<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header <?php echo $mainbg ?>">
        <h5 class="modal-title <?php echo $maintext ?> fw-semibold"></h5>
        <button type="button" class="btn-close bg-white" data-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body <?php echo $mainbg?> d-flex flex-column" style="max-height: 70vh; overflow: hidden;">
        
        <!-- Scrollable content -->
        <div class="flex-grow-1 overflow-auto">
          <div class="border">          
            <div id="post-disp" class = ''></div></div>
          <div class="reply-body ">
            <div id="replies-container"></div>
          </div>
        </div>

        <!-- Fixed Input Area -->
       
        <div class="card p-4 border-0 position-sticky  bottom-0 <?php echo $mainbg ?>">
          <div class="d-flex align-items-center <?php echo $mainbg ?> gap-3">
            <input type="hidden" value = '<?php echo $employeeid0?>' id="currentuser">
            <textarea id="reply-text" class="form-control <?php echo "$mainbg $maintext"?> thistextarea border" placeholder="Write a reply..."></textarea>
            <button type="button" class="btn btn-primary btn-lg" id="send-reply"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
  <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"/>
</svg></button>
          </div>

          <?php 

     if ($department == 'ITD'){
?>
          <div class="text-center mt-2">
            <input type="checkbox" class="form-check-input" id="anonflag" name="anonflag" value="1">
            <label for="anonflag" class="form-check-label <?php echo $subtext?>">Reply Anonymously (ITD ONLY)</label>
          </div>
          <?php 

     }
?>
        </div>

      </div>

    </div>
  </div>
</div>






<!-- Modal View Like-->
<div class="modal fade" id="viewlike" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content <?php echo $mainbg ?>">
      <div class="px-0 <?php echo $mainbg ?>">
        <!-- header -->
      <div class="d-flex justify-content-between border-bottom pb-0 pt-3 px-5">
        <div class="text-center">
  <h5 class="fw-bold <?php echo $subtext?> " id="exampleModalLabel">People Who Liked This</h5>
  </div>
  <button type="button" class="close bg-white" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-dark bg-white">&times;</span>
  </button>
</div>
      </div>
      <div class="modal-body <?php echo $mainbg?>">
      <div class="viewlike-body ">
            <div id="viewlike-container"></div>
            <div id="viewlike-disp"></div>

          </div>
      </div>
     
    </div>
  </div>
</div>













<div class="container mt-3">
    <div class="row justify-content-center stickythis">
        <div class="col-md-8 col-lg-6 col-12  rounded-2 p-4 shadow <?php echo $mainbg?>">
            <div class="d-flex align-items-center mx-2">
                <!-- User Profile Image -->
                <?php echo "
               $picshrdpst"; ?>
     
                
                
                <!-- Post Input Button -->
                <button type="button" class="btn text-start border mx-2 flex-grow-1 <?php echo $mainbg?> <?php echo $subtext?>  rounded-pill px-3 py-4" data-toggle="modal" data-target="#shrdpstmodal">
                Tell us what's up <?php echo $name_first0; ?>!
                </button>

                <?php echo "<a type='button' class='btn btn-primary rounded-circle p-2' title = 'View your posts' href='index.php?lst=1&lid=$loginid&sess=$session&p=431&title=Created%20Posts'>
    
               <svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='white' class='bi bi-blockquote-left' viewBox='0 0 16 16'>
  <path d='M2.5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1zm5 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1zm.79-5.373q.168-.117.444-.275L3.524 6q-.183.111-.452.287-.27.176-.51.428a2.4 2.4 0 0 0-.398.562Q2 7.587 2 7.969q0 .54.217.873.217.328.72.328.322 0 .504-.211a.7.7 0 0 0 .188-.463q0-.345-.211-.521-.205-.182-.568-.182h-.282q.036-.305.123-.498a1.4 1.4 0 0 1 .252-.37 2 2 0 0 1 .346-.298zm2.167 0q.17-.117.445-.275L5.692 6q-.183.111-.452.287-.27.176-.51.428a2.4 2.4 0 0 0-.398.562q-.165.31-.164.692 0 .54.217.873.217.328.72.328.322 0 .504-.211a.7.7 0 0 0 .188-.463q0-.345-.211-.521-.205-.182-.568-.182h-.282a1.8 1.8 0 0 1 .118-.492q.087-.194.257-.375a2 2 0 0 1 .346-.3z'/>
</svg></a>"; ?>

            </div>
        </div>
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



<div class="container mt-4">
<div class="alert <?php echo $ifeedalert?> alert-dismissible  " role="alert">
  
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <span class = "">
  Hey there! 👋 Got something on your mind? A fun idea, a random thought, a big win, or just a simple ‘hello’? This space is all yours! Share what’s on your mind—no pressure, just good vibes and open conversation.

We’re all about keeping things positive, welcoming, and respectful. Let’s lift each other up! Our admins are here to make sure this stays a friendly space, so if a post goes against our community guidelines (like hate speech or negativity), it may be removed.

So go ahead—speak your mind, share your thoughts, and let’s keep the good energy flowing! <br> What’s on your mind today? 😊</span>
</div>
</div>

<div class="bodyofpost container">
    <div id="posts-container" class = ' pb-5 pt-4 px-3 mb-3 '>
        <!-- Dynamic posts will be loaded here -->
    </div>

    <script>
function fetchPosts() {
    $.ajax({
        url: 'createpostentries.php',
        type: 'GET',
        data: { user_id: currentUserId, drkmd_flag: drkmd },
        success: function(response) {
            $('#posts-container').html(response);
        },
        error: function() {
            alert('Failed to load posts.');
        }
    });
}


$(document).ready(function() {
    fetchPosts();
    setInterval(fetchPosts, 1000);

    $(document).on('click', '.like-btn', function() {
      var emptyheart = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"><path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/></svg>';

var fullheart = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#06328d" class="bi bi-heart-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/></svg>';

        var button = $(this);
        var postId = button.data('post-id');
        var userId = <?php echo $employeeid0; ?>;

        $.ajax({
            url: 'like.php',
            type: 'POST',
            data: { user_id: userId, post_id: postId, drkmd_flag: drkmd },
            success: function(response) {
                var data = JSON.parse(response);
                var likeCount = parseInt(button.find('.like-count').text());

                if (data.status === "liked") {
                    button.html(fullheart);
                } else {
                    button.html(emptyheart);
                }
            }
        });
    });




// get reply
let fetchRepliesInterval; // Global variable to store interval ID
let fetchlikersInterval;


$(document).on('click', '.reply-btn', function() {
    var button = $(this);
    var postReplyId = button.data('postid');
    var username = button.data('username');

    $('#replyModal .modal-title').text(username + "'s Post");

    $.ajax({
        url: 'fetchReplyPost.php',
        type: 'POST',
        data: { postReplyId: postReplyId, drkmd_flag: drkmd },
        success: function(response) {
            $('#post-disp').html(response);
        }
    });

    
    function fetchReplies() {
        $.ajax({
            url: "fetchReplies.php",
            type: "GET",
            data: { postId: postReplyId, drkmd_flag: drkmd },
            success: function(response) {
                var replies = JSON.parse(response);
                var replyHTML = "";

                if (replies.length > 0) {
                    replies.forEach(reply => {
                        replyHTML += `
                            <div class='reply <?php echo $mainbg ?> p-4 d-flex gap-2 align-items-start'>
                                <img src='${reply.userImg}' height='30' width='30' class='rounded-circle border' />
                                <div class = '<?php echo $mainbg?> rounded px-4 py-1'>
                                    <p class='m-0 fs-4  <?php echo $maintext?>'>${reply.username}</p>
                                    <p class='m-0 fs-4 <?php echo $maintext ?>'>${reply.replyText}</p><span class='fs-6 <?php echo $subtext ?>'>${reply.timestamp}</span>
                                </div>
                                
                            </div>
                        `;
                    });
                } else {
                    replyHTML = "";
                }

                $("#replies-container").html(replyHTML);
            },
            error: function() {
                $("#replies-container").html("<p class='text-center text-danger'>Failed to load replies.</p>");
            }
        });
    }

    // Clear previous interval before setting a new one
    clearInterval(fetchRepliesInterval);
    fetchRepliesInterval = setInterval(fetchReplies, 1000);
    
    // Fetch immediately when opening the modal
    fetchReplies();
});



// FETCH LIKERS
$(document).on('click', '.viewlike-btn', function() {
    var button = $(this);
    var postReplyId = button.data('postid');
    var username = button.data('username');

    function fetchlikers() {
        $.ajax({
            url: "fetchlikers.php",
            type: "GET",
            data: { postId: postReplyId },
            success: function(response) {
            

                var likers = JSON.parse(response);
                var likersHTML = "";

                if (likers.length > 0) {
                    likers.forEach(likers => {
                        likersHTML += `
                            <div class='likers p-4 <?php echo $mainbg ?> d-flex gap-2 align-items-start'>
                                <img src='${likers.userImg}' height='35' width='35' class='rounded-circle border' />
                                <div class = ' px-4 py-1'>
                                    <p class=' fs-4 <?php echo $subtext ?>'>${likers.username}</p>
                            
                                </div>
                                
                            </div>
                        `;
                    });
                } else {
                    likersHTML = "";
                }

                $("#viewlike-container").html(likersHTML);
            },
            error: function() {
                $("#viewlike-container").html("<p class='text-center text-danger'>Failed to load viewlike.</p>");
            }
        });
    }

    clearInterval(fetchlikersInterval);
    fetchlikersInterval = setInterval(fetchlikers, 1000);
    
    fetchlikers();
});



$('#viewlike').on('hidden.modal', function () {
    postReplyId = null; // Unset the variable
    $('#viewlike-disp').html(''); // Clear post content
    $('#viewlike-container').html(''); // Clear likers
});

    $('#replyModal').on('hidden.modal', function () {
    postReplyId = null; // Unset the variable
    $('#post-disp').html(''); // Clear post content
    $('#replies-container').html(''); // Clear replies
});



    $(document).on("click", "#send-reply", function () {
    var postId = $("#replyModal").data("postid");
    var replyText = $("#reply-text").val().trim();
    var currentuser = $("#currentuser").val().trim();
    var anonflag = $("#anonflag").prop("checked") ? 1 : 0;



    
    if (replyText === "") {
        alert("Reply cannot be empty!" );
        return;
    }

    $.ajax({
        url: "postReply.php", // Using the new PHP file
        type: "POST",
        data: { postId: postId, replyText: replyText, currentuser: currentuser, anonflag: anonflag},
        
        success: function (response) {
           

            $("#reply-text").val(""); // Clear the text area
            $("#anonflag").prop("checked", false); // Uncheck the checkbox
        },
        error: function () {
            alert("Failed to send reply.");
        }
    });
});

// When clicking the reply button, set the post ID in the modal
$(document).on("click", ".reply-btn", function () {
    var postId = $(this).data("postid");
    $("#replyModal").data("postid", postId); // Store post ID in modal
});




  });






</script>

</div>

