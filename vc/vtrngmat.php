<?php
//
// vtrngmat.php
// fr: vc/index.php #25

// set get or post variables here
$uploadsw = (isset($_POST['uploadsw'])) ? $_POST['uploadsw'] :'';
$uploadmode = (isset($_POST['uploadmode'])) ? $_POST['uploadmode'] :'';
$deletedir = (isset($_GET['deletedir'])) ? $_GET['deletedir'] :'';
$deletemode = (isset($_GET['deletemode'])) ? $_GET['deletemode'] :'';
$deletefile = (isset($_GET['deletefile'])) ? $_GET['deletefile'] :'';
$avatar = (isset($_GET['avatar'])) ? $_GET['avatar'] :'';

?>
	<div class=" my-5 p-5 mainbgc">
		<h4  class = "ms-5 py-5 text-white">Training materials</h4>
          </div>




<?php
//
// controllers
//
if($uploadsw == "yes") {
	if($uploadmode == "private") {
		UploadFile($username0);
	} else {
		UploadFilePublic();
	} // if
} // if

if($deletedir <> "") {
	echo "Folder deleted<br>";
	if($deletemode == "private") {
//            DeleteFile("$defaultpath/$username/" . $deletefile);
	shell_exec('rmdir '.$pathuserfileupload.'/'.$username0.'/'.$deletedir);
	} else if($deletemode == "public") {
//            DeleteFile("$defaultpath/public/" . $deletefile);
	shell_exec('rmdir '.$pathuserfileupload.'/public/'.$deletedir);
	} // if
} // if

if($deletefile <> "") {
	echo "File deleted<br>";
	if($deletemode == "private") {
	DeleteFile("$pathuserfileupload/$username0/" . $deletefile);
	} else if($deletemode == "public") {
	DeleteFile("$pathuserfileupload/public/" . $deletefile);
	} // if
} // if

if($avatar <> "") {
	SetAvatar($loginid, $avatar);
} // if
?>



<div class="container mb-5">
<div class="card mx-5 pb-5 shadow-lg rounded-4">


<?php

	$dirArray = ReadFolderDirectory0("$pathtraining");
	$ctr0 = 0;
	foreach ($dirArray as $value0) {
		$dirname = urlencode($value0);
		echo "<div class='card-header bg-white border-0 p-3 my-5 text-center'> 
          <p class = 'fs-3 mb-0 maintext fw-medium'>NK Engineers Railway Course Training Materials </p>
          <p class ='fs-5 submaintext '>$value0</p>
          
          </div>";
		

	}    ?>

<div class="card-body">




 <nav>
	<div class="nav nav-tabs mb-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <button class="nav-item nav-link maintext fs-4 "  id="v-pills-folder1-tab" data-toggle="pill" href="#v-pills-folder1" role="tab" aria-controls="v-pills-folder1" aria-selected="true">Presentation </button>
  <button class="nav-item nav-link maintext fs-4 "  id="v-pills-subfolder-tab" data-toggle="pill" href="#v-pills-subfolder" role="tab" aria-controls="v-pills-subfolder" aria-selected="false">More</button>
</div>
</nav>

<div class="tab-content" id="v-pills-tabContent">


  <div class="tab-pane fade " id="v-pills-folder1" role="tabpanel" aria-labelledby="v-pills-folder1-tab">
    <?php
    // PHP code for Folder 1
    $dirArray = ReadFolderDirectory0("$pathtraining/$value0");
    $ctr0 = 0;
    foreach ($dirArray as $valued1) {
      $dirname = urlencode($valued1);
    ?>
      <div class="col-md-12 my-4">
        <p class='maintext mb-0  fw-bold '><?php echo "$valued1"; ?></p>
        <p class = 'submaintext fs-5'> Video of Guide And Training Materials from meetings. <span class = 'text-primary fst-italic fs-6'>(Click Cards)</span></p>
      </div>
    <?php
    }
    ?>

    

<?php
	    $fileArray = ReadFolderDirectory("$pathtraining/$value0/$valuef0");
	    $ctr = 0;
	    foreach ($fileArray as $valuef0) {
		    $filename = urlencode($valuef0);
		    if($filename != "index.htm") {
			 ?>




			<div class=" p-2 ">
				<div class="row px-4  ">	
                    <?php echo "<a href=\"$pathtraining/$value0/$valuef0\" class='  ' target='_blank'>"?>
                         <div class = 'border rounded-3 p-3 viewss'>

					<?php  echo "<h5  target='_blank'>$valuef0 </h5>"; ?>
					
				
                         </div>
                         
                         
                         </a>
                      

                        


				</div>	
			</div>
				<?php
			
		    }   
			?>
			
				
			<?php
	    } 

     ?>
	
  </div>

  <div class="tab-pane fade" id="v-pills-subfolder" role="tabpanel" aria-labelledby="v-pills-subfolder-tab">
  <div class="col-md-12 my-4">
        <p class='maintext mb-0  fw-bold '>Training Materials</p>
        <p class = 'submaintext fs-5'> More Guide and Training Materials from meetings <span class = 'text-primary fst-italic fs-6'>(Click Cards)</span></p>
      </div>
    <?php
    // PHP code for Subfolder
    $dirArray = ReadFolderDirectory0("$pathtraining/$value0/$valued1/$valued2");
    $ctr0 = 0;
    foreach ($dirArray as $valued2) {
      $dirname = urlencode($valued2);
    ?>
 
        <p class='submaintext fst-italic text-end fs-5 mb-0 py-2 px-4'> <?php echo "$valued2"; ?></p>
       
   
    <?php
      $fileArray = ReadFolderDirectory("$pathtraining/$value0/$valued1/$valued2/$valuef2");
      $ctr = 0;
      foreach ($fileArray as $valuef2) {
        $filename = urlencode($valuef2);
        if ($filename != "index.htm") {
    ?>
          <div class=" p-2 ">
            <div class="row px-4">
            <?php echo "<a href=\"$pathtraining/$value0/$valued1/$valued2/$valuef2\" target='_blank'>"?>
               <div class="border rounded-3 p-3 viewss">
                <?php echo "<h5 href='$pathtraining/$value0/$valued1/$valued2/$valuef2'target='_blank'>$valuef2</h5>"; ?>
           
                </div>
              </a>
            
            </div>
          </div>
    <?php
        }
      }
      $valued2 = "";
      $valuef2 = "";
    }
    ?>
  </div>
</div>

	
	
	</div>




	
<?php
//
// functions below
//

function ReadFolderDirectory0($dir0)
{
        $listDir0 = array();

        if($handler0 = opendir($dir0))
        {
            while (($sub0 = readdir($handler0)) !== FALSE)
            {
                if ($sub0 != "." && $sub0 != ".." && $sub0 != "Thumb.db")
                {
                    if(is_file($dir0."/".$sub0))
                    {
//                        $listDir[] = $sub0;
                    }
                    elseif(is_dir($dir0."/".$sub0))
                    {
                        $listDir0[] = $sub0;
		    }
                }
            }   
            closedir($handler0);
        }
        return $listDir0;   
} 

function ReadFolderDirectory($dir)
{
        $listDir = array();

        if($handler = opendir($dir))
        {
            while (($sub = readdir($handler)) !== FALSE)
            {
                if ($sub != "." && $sub != ".." && $sub != "Thumb.db")
                {
                    if(is_file($dir."/".$sub))
                    {
                        $listDir[] = $sub;
                    }
                    elseif(is_dir($dir."/".$sub))
                    {
//                        $listDir[$sub] = $this->ReadFolderDirectory($dir."/".$sub);
//                        $listDir[] = $sub;
		    }
                }
            }   
            closedir($handler);
        }
        return $listDir;   
} 

function DeleteFile($file)
{
     unlink($file);
}

//functionnction CreateFolder($folder)
//{
//   mkdir($key."/var/www/transfers/$folder", 777); 
//}

function UploadFile($userfolder)
{
     $target = "../transfers/training/"; 
     $target = $target . basename( $_FILES['uploaded']['name']) ; 
     $ok=1;

     //This is our size condition 
     // if ($uploaded_size > 350000) 
     //{ 
     //     echo "Your file is too large.<br>"; 
     //     $ok=0; 
     //} 

     //This is our limit file type condition 
     if ($uploaded_type =="text/php") 
     { 
          echo "No PHP files<br>"; 
          $ok=0; 
     } 

     //Here we check that $ok was not set to 0 by an error 
     if ($ok==0) 
     { 
          echo "<font color=red>Sorry your file was not uploaded. Please try again.</font>";
     } 

     //If everything is ok we try to upload it 
     else 
     { 
          if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
          { 
               echo "<tr<td><font color=\"green\">The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded</font></td></tr>";
          } 
          else 
          { 
               echo "<font color=red>Sorry, there was a problem uploading your file. Please try again.</font>"; 
          }
     } 

     echo "<br>";
} 

function UploadFilePublic()
{
     $target = "../transfers/training/"; 
     $target = $target . basename( $_FILES['uploaded']['name']) ; 
     $ok=1; 

     //This is our size condition 
     // if ($uploaded_size > 350000) 
     //{ 
     //     echo "Your file is too large.<br>"; 
     //     $ok=0; 
     //} 

     //This is our limit file type condition 
     if ($uploaded_type =="text/php") 
     { 
          echo "No PHP files<br>"; 
          $ok=0; 
     } 

     //Here we check that $ok was not set to 0 by an error 
     if ($ok==0) 
     { 
          echo "<font color=red>Sorry your file was not uploaded. Please try again.</font>";
     } 

     //If everything is ok we try to upload it 
     else 
     { 
          if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
          { 
               echo "<tr><td><font color=\"green\">The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded</font></td></tr>";
          } 
          else 
          { 
               echo "<font color=red>Sorry, there was a problem uploading your file. Please try again.</font>"; 
          }
     } 

     echo "<br>";
}

function SetAvatar($id, $path) {
     echo "Avatar path: $path<br>";
}
?>




