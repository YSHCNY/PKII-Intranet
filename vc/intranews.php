<?php
session_start();

?>
  
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    .post img, video {
    width: 90%; 
    max-height: 400px; 
    object-fit: contain; 
    border-radius: 10px; 
    cursor: pointer; 
}


.btn:focus, .btn:active,
.dropdown-toggle:focus, .dropdown-toggle:active {
    outline: none !important;
    box-shadow: none !important;
}

.dropdown-item:focus, .dropdown-item:active {
    outline: none !important;
    box-shadow: none !important;
}

.btn:focus-visible, 
.dropdown-item:focus-visible {
    outline: none !important;
    box-shadow: none !important;
}

.btn:hover {
    background-color: #3b3d3d !important;
}

@keyframes blink {
    0% {
        border-color: transparent;
        opacity: 1;
    }
    50% {
        border-color: rgb(27, 50, 97, 0.8);
        opacity: 0.5;
    }
    100% {
        border-color: transparent;
        opacity: 1;
    }
}

.pulse-border {
    border: 1px solid rgb(27, 50, 97, 0.8) !important;
    animation: blink .8s infinite;
}




</style>

    <div class="post-container">
	<div class=" px-5 pt-5 pb-2 <?php echo $hero?>" >
		<div class="text-center"><h3 class = 'mb-5 mt-2 py-5 fw-bold text-uppercase text-white'>Intra News</h3></div>
        </div>

    <?php
    $DeletedPost =  $_SESSION['DeletedPost'] ? $_SESSION['DeletedPost'] : null;
     $postuid = isset($_GET['postuid']) ? $_GET['postuid'] : null;



     
       include '../m/qryvpersinfo.php';
       if ($department == 'ITD'){
    ?>


    <!-- create post dispplayed only on itd -->







    <div class="container mt-4">
      
        <div class="card shadow-sm <?php echo $mainbg?>  ">
            <div class="card-body <?php echo $mainbg?>">

<h5 class="card-title <?php echo $subtext?>">Create Post  </h5>
                <form id="postForm" >
                    <div class="mb-3">
                        <input type="text" class="form-control  <?php echo "$mainbg $maintext"?> "name="user" id="user" placeholder="Title" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control  <?php echo "$mainbg $maintext"?> " name="content" id="content" placeholder="What's on your mind?" rows="3" required></textarea>
                        <p class = 'fs-5 fst-italic text-danger'>Note: Use plain text only—formatted or special characters may display incorrectly.</p>

                    </div>
                    <div class="mb-3">
                        <input class="form-control  <?php echo "$mainbg $maintext"?> " type="file" name="file" id="file">
                        <p class = 'fs-5 fst-italic text-danger'>File should not be greater than 7mb</p>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Post</button>
                </form>
                    <!-- <a href="95" id="">go to post 95</a> -->
            </div>
        </div>
        </div>
<?php
}
?>

    <!-- redirects to post from dashboard-->
    <a href="#<?php echo $postuid; ?>" class = 'myLink'></a> 
    <script>
  window.onload = function() {
    setTimeout(function() {
      document.querySelector(".myLink").click();
    }, 500);
  };

  document.addEventListener("DOMContentLoaded", function() {
    document.querySelector(".myLink").addEventListener("click", function() {
      let postDiv = document.getElementById("<?php echo $postuid; ?>");
      if (postDiv) {
        postDiv.classList.add("pulse-border");
        setTimeout(() => {
          postDiv.classList.remove("pulse-border");
        }, 1500); // Remove class after animation completes
      }
    });
  });
  
</script>
<div class="container mt-5">


<?php if (!empty($_SESSION['DeletedPost'])): ?>
    <div id="alertBox" class="alert alert-danger alert-dismissible  show" role="alert">
        <?php echo $_SESSION['DeletedPost']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        setTimeout(function() {
            let alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.classList.remove('show');
                alertBox.classList.add('fade');
                setTimeout(() => alertBox.remove(), 500);
            }
        }, 3000);
    </script>
    
    <?php unset($_SESSION['DeletedPost']); ?>
<?php endif; ?>

<div class="container mt-4">
<div class="alert alert-info alert-dismissible  " role="alert">
  
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <span class = "">Got a hot scoop or an exciting story to share? Send your news articles to<a class = 'text-primary text-decoration-underline' href="mailto:support@philkoei.com.ph">support@philkoei.com.ph,</a>and our team will review them for approval. We can’t wait to hear from you! 🚀</span>
</div>
</div>

    
<div id="alertBox" class="alert alert-danger d-none" role="alert"></div>
        <div class = ''>
       <h4 class="<?php echo $subtext ?> fst-italic fw-bold">Recent PKII News</h4>
       </div>

        <div id="postList"></div>
    </div>
    </div>


    <script>
$(document).ready(function() {
    // console.log("Document ready!");

    loadPosts(); // Load existing posts

$("#postForm").submit(function(event) {
        event.preventDefault(); // Prevent page reload
        // console.log("Form submission started!");

        let formData = new FormData(this);
        
        $.ajax({
            url: "intranews_upload.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // console.log("Response received:", response);
                
                try {
                    let post = JSON.parse(response);
                    // console.log("Parsed JSON:", post);
                    
                    if (post.error) {
                        showAlert(post.error, "danger"); // Show Bootstrap alert for errors
                    } else {
                        $("#postList").prepend(formatPost(post)); // Add new post dynamically
                        $("#postForm")[0].reset();
                        showAlert("Post uploaded successfully!", "success");
                    }
                } catch (e) {
                    console.error("Error parsing JSON:", e, response);
                    showAlert("Unexpected server response.", "danger");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                showAlert("Failed to upload post. Try again.", "danger");
            }
        });
    });


    function showAlert(message, type) {
        // console.log("Showing alert:", message, type);
        let alertBox = $("#alertBox");
        alertBox.removeClass("d-none alert-success alert-danger").addClass(`alert-${type}`);
        alertBox.html(message);

        // Auto-dismiss alert after 3 seconds
        setTimeout(function() {
            alertBox.addClass("d-none");
        }, 3000);
    }






    function loadPosts() {
    let videoStates = {};

    // Save playback time of existing videos before refresh
    $("#postList .embed-responsive-item").each(function () {
        let postId = $(this).closest(".post").attr("data-post-id");
        videoStates[postId] = this.currentTime;
    });

    $.ajax({
        url: "intranews_fetch_post.php", // This returns ready-to-render HTML
        type: "GET",
        data: {
        department: "<?= $department ?>",
        mainbg: "<?php echo $mainbg ?>",
        maintext: "<?php echo $maintext ?>",
        subtext: "<?php echo $subtext ?>",
        loginid: "<?php echo $loginid ?>",
        session: "<?php echo $session ?>"
    },
        success: function(response) {
            // Parse response into a temporary DOM to filter new posts
            let tempContainer = $("<div>").html(response);
            let existingPostIds = new Set();

            $("#postList .post").each(function () {
                existingPostIds.add($(this).attr("data-post-id"));
            });

            let newHtml = "";

            tempContainer.find(".post").each(function () {
                let postId = $(this).attr("data-post-id");
                if (!existingPostIds.has(postId)) {
                    newHtml += $(this).prop("outerHTML");
                }
            });

            if (newHtml) {
                $("#postList").prepend(newHtml);
            }

            restoreReadMoreState();

            // Restore video playback time
            $("#postList .embed-responsive-item").each(function () {
                let postId = $(this).closest(".post").attr("data-post-id");
                if (videoStates[postId]) {
                    this.currentTime = videoStates[postId];
                }
            });
        },
        error: function(xhr, status, error) {
            console.error("Error fetching posts:", status, error);
        }
    });
}









// Store Read More / Read Less state (per user using sessionStorage)
function storeReadMoreState() {
    let states = {};
    $(".post").each(function () {
        let postId = $(this).attr("data-post-id"); 
        let isExpanded = $(this).find(".full-content").is(":visible");
        states[postId] = isExpanded;
    });
    sessionStorage.setItem("readMoreStates", JSON.stringify(states)); // Stores only per user session
}

// Restore Read More / Read Less state
function restoreReadMoreState() {
    let states = JSON.parse(sessionStorage.getItem("readMoreStates")) || {};
    $(".post").each(function () {
        let postId = $(this).attr("data-post-id");
        if (states[postId]) {
            $(this).find(".short-content").addClass("d-none");
            $(this).find(".full-content").removeClass("d-none");
            $(this).find(".toggle-read").text("Read Less");
        }
    });
}



document.addEventListener("DOMContentLoaded", function () {
        // Get the URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const postUid = urlParams.get('postUid'); // Get postUid from the URL

        if (postUid) {
            // Use setTimeout to wait for dynamic content loading
            setTimeout(() => {
                const targetDiv = document.getElementById(postUid);
                if (targetDiv) {
                    targetDiv.scrollIntoView({ behavior: "smooth", block: "start" });
                }
            }, 500); // Adjust timeout if needed
        }
    });

$(document).on("click", ".clickable-image", function () {
    let imageSrc = $(this).attr("src");

    // Prevent body scrolling
    $("body").css("overflow", "hidden");

    // Create the full-screen container dynamically if it doesn't exist
    if ($("#fullScreenContainer").length === 0) {
        $("body").append(`
            <div id="fullScreenContainer" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.9); display: flex; align-items: center; justify-content: center; z-index: 10000; cursor: pointer;">
                <img id="fullScreenImage" src="${imageSrc}" style="max-width: 90%; max-height: 90%; transition: transform 0.2s ease;">
            </div>
        `);
    } else {
        $("#fullScreenImage").attr("src", imageSrc);
        $("#fullScreenContainer").show();
    }

    let scale = 1; // Initial zoom level

    // Zoom in/out on mouse wheel
    $("#fullScreenImage").on("wheel", function (event) {
        event.preventDefault();
        let delta = event.originalEvent.deltaY > 0 ? -0.1 : 0.1;
        scale = Math.min(Math.max(1, scale + delta), 3); // Limit zoom between 1x and 3x
        $(this).css("transform", `scale(${scale})`);
    });

    // Close full screen when clicking outside the image
    $("#fullScreenContainer").on("click", function (event) {
        if (!$(event.target).is("#fullScreenImage")) {
            $(this).hide();
            $("body").css("overflow", "auto"); // Restore body scrolling
        }
    });

    // Close with ESC key
    $(document).on("keydown", function (event) {
        if (event.key === "Escape") {
            $("#fullScreenContainer").hide();
            $("body").css("overflow", "auto"); // Restore body scrolling
        }
    });
});



// Read More / Read Less toggle
$(document).on("click", ".toggle-read", function (event) {
    event.preventDefault();
    let postElement = $(this).closest(".post");
    let shortContent = postElement.find(".short-content");
    let fullContent = postElement.find(".full-content");
    
    if (shortContent.hasClass("d-none")) {
        shortContent.removeClass("d-none");
        fullContent.addClass("d-none");
        $(this).text("Read More");
    } else {
        shortContent.addClass("d-none");
        fullContent.removeClass("d-none");
        $(this).text("Read Less");
    }

    storeReadMoreState(); // Save state after toggle
});

// Refresh posts every 4 seconds
setInterval(loadPosts, 1000);



    function timeSince(date) {
    let seconds = Math.floor((new Date() - date) / 1000);
    let interval = Math.floor(seconds / 31536000);

    if (interval > 1) return interval + " years ago";
    interval = Math.floor(seconds / 2592000);
    if (interval > 1) return interval + " months ago";
    interval = Math.floor(seconds / 86400);
    if (interval > 1) return interval + " days ago";
    interval = Math.floor(seconds / 3600);
    if (interval > 1) return interval + " hours ago";
    interval = Math.floor(seconds / 60);
    if (interval > 1) return interval + " minutes ago";

    return "Just now";
}

});







    </script>

