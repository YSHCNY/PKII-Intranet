
<?php

$page = basename($_SERVER['REQUEST_URI']); 

if ($page == '' || $page == '/' || $page == 'vc') {


    $title = "Dashboard";
    $content = "ddash.php";

}elseif($page =='info'){

    $title = "My Information";
    $content = "vpersoninfo.php";

}


include 'newheader.php';
include 'menuv2.php';

?>



<body>
    <main>
        <!-- Check if true then import the views -->
        <?php
            
            if ($content) {
                include $content;
            }
        ?>

    </main>
</body>
</html>