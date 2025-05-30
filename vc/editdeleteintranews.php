<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "sysad";
$dbname = "maindb";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$typeofbtn = isset($_GET['btn']) ? $_GET['btn'] : '';
$postuid = isset($_GET['postid']) ? $_GET['postid'] : '';
$editpost = isset($_GET['editpost']) ? $_GET['editpost'] : null;


$sqlGetPost = "SELECT * FROM intranews WHERE id = $postuid";
$result = mysqli_query($conn, $sqlGetPost);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['user'];
        $content = $row['content'];
        $image = $row['image'];
        $video = $row['video'];
    }
}

if ($typeofbtn == 'editbtn') { 
    ?>

    <div class="container my-5">

    
<!-- show alert after post update -->
<?php if($editpost == 'success'){ ?>
        <div id="alertBox" class="alert alert-success" role="alert">
            Post Updated!
        </div>

    
    <script>
        // Hide alert after 3 seconds
        setTimeout(function() {
            var alertBox = document.getElementById("alertBox");
            if (alertBox) {
                alertBox.style.transition = "opacity 0.5s";
                alertBox.style.opacity = "0";
                setTimeout(() => alertBox.style.display = "none", 500);
            }
        }, 3000);
    </script>
<?php } ?>
<!-- show alert after post update -->



        <form action="<?php echo "index.php?lst=1&lid=$loginid&sess=$session&p=421&title=Intra%20News%20&postid=$postuid&editpost=success&btn=editbtn"?>" method="POST" enctype="multipart/form-data" class='border rounded p-4 <?php echo $mainbg?>'>
            <input type="hidden" name="postid" value="<?php echo $postuid?>">
            <div class="mb-3">
                <label for="title" class='<?php echo $subtext ?>'>News Title</label>
                <input type="text" class="form-control <?php echo "$mainbg $maintext"?>" name="title" id="title" value="<?php echo $title?>" placeholder="Title" required>
            </div>
            <div class="mb-3">
                <label for="content" class='<?php echo $subtext ?>'>News Content</label>
                <textarea class="form-control <?php echo "$mainbg $maintext"?>" name="content" id="content" rows="10" required><?php echo $content?></textarea>
            </div>

            <?php if (!empty($image)) { ?>
                <div class="mb-3 py-3 text-center border rounded">
                    <img src="uploads/<?php echo $image?>" class='' alt="No image">
                    <p class='fs-4 fw-bold'>Current Image</p>
                </div>
            <?php } elseif (!empty($video)) { ?>
                <div class="mb-3 py-3 text-center border rounded">
                    <div class="embed-responsive embed-responsive-16by9 border h-50 my-3">
                        <iframe class="embed-responsive-item" src="uploads/<?php echo $video?>" type="video/mp4" allowfullscreen></iframe>
                    </div>
                    <p class='fs-4 fw-bold'>Current Video</p>
                </div>
            <?php } else { ?>
                <div class="mb-3 py-3 text-center border rounded">
                    <p class='fs-4 fw-bold'>No Display</p>
                </div>
            <?php } ?>

            <div class="mb-3">
                <input class="form-control <?php echo "$mainbg $maintext"; ?>" type="file" name="file" id="file">
                <p class='fs-5 fst-italic text-danger'>File should not be greater than 10MB</p>
                <div id="fileAlert"></div> <!-- Dynamic Alert -->
            </div>

            <script>
                document.getElementById('file').addEventListener('change', function () {
                    let file = this.files[0];
                    let maxSize = 10 * 1024 * 1024; // 10MB
                    let alertDiv = document.getElementById("fileAlert");

                    if (file) {
                        if (file.size > maxSize) {
                            alertDiv.innerHTML = `<div class='alert alert-danger alert-dismissible show' role='alert'>
                                                    File size exceeds 10MB limit.
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>`;
                            this.value = ''; // Clear file input
                        } else {
                            alertDiv.innerHTML = ''; // Remove alert if valid
                        }
                    }
                });
            </script>

            <div class="my-5 d-flex gap-4">
                <a href="index.php?lst=1&lid=<?php echo $loginid ?>&sess=<?php echo $session ?>&p=42&title=Intra%News%20&postuid=<?php echo $postuid?>" class="btn btn-default w-100">Back</a>
                <button type="submit" class="btn btn-success w-100">Update</button>
            </div>
        </form>
    </div>

<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postuid = $_POST['postid'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $fileSizeLimit = 10 * 1024 * 1024; // 10MB
    $newFileName = '';

    function showAlert($message, $type = "danger") {
        echo "<div class='alert alert-$type alert-dismissible' role='alert'>
                $message
                <button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button>
              </div>";
    }

    if (!empty($_FILES['file']['name'])) {
        $file = $_FILES['file'];
        $fileSize = $file['size'];
        $fileName = time() . "_" . basename($file["name"]);
        $targetFile = "uploads/" . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $imageTypes = ['jpg', 'png', 'jpeg', 'gif'];
        $videoTypes = ['mp4', 'mov', 'avi'];

        if ($fileSize > $fileSizeLimit) {
            showAlert("Error: File size exceeds 10MB limit.");
            exit();
        }

        if (in_array($fileType, $imageTypes) ) {
            move_uploaded_file($file["tmp_name"], $targetFile);
            $image = $fileName;

            $sql = "UPDATE intranews 
            SET user = '$title', content = '$content', image = '$image', video = ''
            WHERE id = $postuid";


        } else if (in_array($fileType, $videoTypes)){

            move_uploaded_file($file["tmp_name"], $targetFile);
            $video = $fileName;

            $sql = "UPDATE intranews 
            SET user = '$title', content = '$content', image = '', video = '$video'
            WHERE id = $postuid";


        }else {
            showAlert("Error: Invalid file type.");
            exit();
        }
    }

 

    if ($conn->query($sql)) {
       
    } 




} 


}else {

    
    $sql = "DELETE FROM intranews WHERE id = $postuid";
   
    if ( $conn->query($sql)){
    $_SESSION['DeletedPost'] = "Post Removed";
    ?>
<script>
    var loginid = "<?php echo $loginid; ?>";
    var session = "<?php echo $session; ?>";
    window.location.href = "index.php?lst=1&lid=" + encodeURIComponent(loginid) + 
                           "&sess=" + encodeURIComponent(session) + 
                           "&p=42&title=Intra%20News";
</script>
    <?php
} else {
    $_SESSION['DeletedPost'] = "error on Removing post";
    ?>
<script>
    var loginid = "<?php echo $loginid; ?>";
    var session = "<?php echo $session; ?>";
    window.location.href = "index.php?lst=1&lid=" + encodeURIComponent(loginid) + 
                           "&sess=" + encodeURIComponent(session) + 
                           "&p=42&title=Intra%20News";
</script>
    <?php
}
}




$conn->close();
?>
