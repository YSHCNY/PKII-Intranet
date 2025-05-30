<?php
$host = "localhost";
$user = "root";
$pass = "sysad";
$dbname = "maindb";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

$department = $_GET['department'];
$mainbg = $_GET['mainbg'];
$maintext = $_GET['maintext'];
$subtext = $_GET['subtext'];
$loginid =$_GET['loginid'];
$session = $_GET['session'];


function timeSince($datetime) {
    date_default_timezone_set('Asia/Manila'); // Set timezone to Manila

    $time = strtotime($datetime);
    $diff = time() - $time;

    if ($diff < 60)
        return "$diff seconds ago";
    $diff = round($diff / 60);
    if ($diff < 60)
        return "$diff minutes ago";
    $diff = round($diff / 60);
    if ($diff < 24)
        return "$diff hours ago";
    $diff = round($diff / 24);
    if ($diff < 30)
        return "$diff days ago";
    $diff = round($diff / 30);
    if ($diff < 12)
        return "$diff months ago";
    $diff = round($diff / 12);
    return "$diff years ago";
}


function formatPost($post, $department, $mainbg, $maintext, $subtext, $loginid, $session) {
    $timeAgo = timeSince($post['created_at']);
    $maxLength = 300;
    $shortContent = strlen($post['content']) > $maxLength ? substr($post['content'], 0, $maxLength) . "..." : $post['content'];

    ob_start(); ?>
    <div class="post shadow-sm px-5 py-4 my-5 rounded <?= $mainbg ?>" 
         id="<?= $post['id'] ?>" 
         data-post-id="<?= $post['id'] ?>">
        <?php if ($department == "ITD") { ?>
            
            <div class="text-end">
                <div class="dropstart btn-group">
                    <button class="btn rounded border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#8e9194" class="bi bi-three-dots-vertical" viewBox="0 0 16 16"><path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg>
                    </button>
                    <ul class="dropdown-menu <?= $mainbg ?> gap-4">
                        <li>
                            <a class="dropdown-item text-capitalize <?= $maintext ?>" 
                               href="index.php?lst=1&lid=<?= $loginid ?>&sess=<?= $session ?>&p=421&btn=editbtn&postid=<?= $post['id'] ?>">
                               🖊 Edit Post
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-capitalize <?= $maintext ?>" 
                               href="index.php?lst=1&lid=<?= $loginid ?>&sess=<?= $session ?>&p=421&btn=deletebtn&postid=<?= $post['id'] ?>" 
                               onclick="return confirm('Are you sure you want to proceed?')" 
                               data-post-id="<?= $post['id'] ?>">
                               🗑 Remove Post
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php } ?>

        <?php //echo " $department, $mainbg, $maintext, $subtext, $loginid, $session <br> test"; ?>
        <figure class="mb-3">
            <blockquote class="blockquote">
                <p class="fs-1 text-capitalize fw-semibold mb-0 pb-0 <?= $maintext ?>"><?= htmlspecialchars($post['user']) ?></p>
            </blockquote>
            <figcaption class="blockquote-footer <?= $subtext ?>">
                Intra News <cite title="Source Title">Moderator</cite>
            </figcaption>
        </figure>

        <?php if (!empty($post['image'])): ?>
            <div class="mx-auto d-flex my-3">
                <img src="uploads/<?= htmlspecialchars($post['image']) ?>" class="mx-auto d-flex clickable-image" alt="Post Image">
            </div>
        <?php endif; ?>

        <?php if (!empty($post['video'])): ?>
            <div class="embed-responsive embed-responsive-16by9 my-3">
                <iframe class="embed-responsive-item" src="uploads/<?= htmlspecialchars($post['video']) ?>" type="video/mp4" allowfullscreen></iframe>
            </div>
        <?php endif; ?>

        <p class="<?= $subtext ?> fst-italic mb-5"><span class="fw-bold">Posted:</span> <?= $timeAgo ?></p>

        <p class="fs-4 my-4 <?= $maintext ?>">
    <span class="short-content"><?= nl2br(htmlspecialchars($shortContent)) ?></span>
    <span class="full-content d-none"  style="white-space: pre-wrap;"><?= nl2br(htmlspecialchars($post['content'])) ?></span>
    <?php if (strlen($post['content']) > $maxLength): ?>
        <a href="#" class="toggle-read text-info fst-italic">Read More</a>
    <?php endif; ?>
</p>

    </div>
    <?php
    return ob_get_clean();
}



$result = $conn->query("SELECT * FROM intranews ORDER BY created_at DESC");
while ($row = $result->fetch_assoc()) {
    echo formatPost($row, $department, $mainbg, $maintext, $subtext, $loginid, $session);
}

$conn->close();
?>
