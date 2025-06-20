<?php
//
// mfileupload.php
// fr: vc/index.php

// set get or post variables here
$uploadsw = (isset($_POST['uploadsw'])) ? $_POST['uploadsw'] :'';
$uploadmode = (isset($_POST['uploadmode'])) ? $_POST['uploadmode'] :'';
$deletedir = (isset($_GET['deletedir'])) ? $_GET['deletedir'] :'';
$deletemode = (isset($_GET['deletemode'])) ? $_GET['deletemode'] :'';
$deletefile = (isset($_GET['deletefile'])) ? $_GET['deletefile'] :'';
$avatar = (isset($_GET['avatar'])) ? $_GET['avatar'] :'';

?>
	<div class=" p-5 <?php echo $hero?>" >
	<div class="text-center"><h3 class = 'mb-5 mt-2 py-5 fw-bold text-uppercase text-white'>FILE UPLOADER</h3></div>

		</div>
	<div class="row mt-5">
		<div class="">
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
		</div>
	</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="container">
	<div class="row   p-5 mb-5 rounded   ">

	<div class="col-auto <?php echo $mainbg ?> p-5 my-4 rounded  mx-auto ">

	
			<div class = "my-5">
	<h4 class = "<?php echo $subtext ?> text-center">Upload <span class = "fw-bold <?php echo $mainbg?> text-uppercase">Private</span> file(s)</h4>
	</div>
<?php
	echo "<form enctype=\"multipart/form-data\" action=\"index.php?lst=1&lid=$loginid&sess=$session&p=31\" method=\"POST\">";
	echo "<input name=\"uploadsw\" type=\"hidden\" value=\"yes\">"; 
	echo "<input name=\"uploadmode\" type=\"hidden\" value=\"private\">";

?>
				<div class="row g-0 my-5">
					<div class="col-md-8 py-2 "><?php echo "<input id='uploaded' name=\"uploaded\" class =\"form-control form-control-lg  fs-4   \"  type=\"file\" />";?></div>
					<div class="col-md-3 py-2  "><?php echo "<input type=\"submit\" class=\"form-control form-control-lg  btn btn-success    \" value=\"Upload\" />";?></div>
				</div>
		<?php
	echo "</form>";
?>
	</td></tr>

<?php
	//
	// display folders - Private
	//
	$dirArray = ReadFolderDirectory0("$pathuserfileupload/$username0");
	$ctr0 = 0;
	foreach ($dirArray as $value0) {
		$dirname = urlencode($value0);
		echo "<tr><td class='text-left'>$value0</td>";
		echo "<td>[folder]</td>";
		echo "<td><a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=31&deletedir=$dirname&deletemode=private\" class='text-primary'><em>Remove</em></a></td></tr>";
	} // foreach
	//
	// display files - Private
	//
	$fileArray = ReadFolderDirectory("$pathuserfileupload/$username0");
	$ctr = 0;
	foreach ($fileArray as $value) {
		$filename = urlencode($value);
		if($filename != "index.htm") {
			echo "<tr><td class='text-left'>$value</td>";
			echo "<td><a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=31&deletefile=$filename&deletemode=private\" class='text-primary'><em>Delete</em></a></td>";
			echo "<td><a href=\"$pathuserfileupload/$username0/$value\" class='text-primary' target='_blank'><em>Download</em></a></td></tr>";
			// echo "<td><a href=\"mfileupload.php?loginid=$loginid&avatar=transfers/$username/$value\">Check path</a></td>";
		} // if
	} // foreach
?>
	<!-- </tr> -->

	</div>








<div class="col-auto <?php echo $mainbg ?> p-5 my-4   rounded   mx-auto  ">



	<div class="my-5">
<h4 class = "<?php echo $subtext ?> text-center">Upload <span class = "fw-bold <?php echo $mainbg?> text-uppercase">Public</span> file(s)</h4>
</div>
<?php
	echo "<form enctype=\"multipart/form-data\" action=\"index.php?lst=1&lid=$loginid&sess=$session&p=31\" method=\"POST\">";
	echo "<input name=\"uploadsw\" type=\"hidden\" value=\"yes\">"; 
	echo "<input name=\"uploadmode\" type=\"hidden\" value=\"public\">";
	?>
				<div class="row g-0 my-5">
					<div class="col-md-8 py-2 "><?php echo "<input id='uploaded' name=\"uploaded\" class =\"form-control form-control-lg  fs-4   \"  type=\"file\" />";?></div>
					<div class="col-md-3 py-2  "><?php echo "<input type=\"submit\" class=\"form-control form-control-lg  btn btn-success    \" value=\"Upload\" />";?></div>
				</div>
		<?php
	echo "</form>"; 
?>
	</td></tr>
	<!-- <tr> -->
<?php
	//
	// display folders - Public
	//
	$dirArray = ReadFolderDirectory0("$pathuserfileupload/public");
	$ctr0 = 0;
	foreach ($dirArray as $value0) {
		$dirname = urlencode($value0);
//          if($dirname != "index.htm")
//          {
		echo "<tr><td class='text-left'>".$value0."</td>";
		echo "<td>[folder]</td>";
		echo "<td><a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=31&deletedir=$dirname&deletemode=public\" class='text-primary'><em>Remove</em></a></td></tr>";
//          }
	} // foreach
	//
	// display files - Public
	//
	$fileArray = ReadFolderDirectory("$pathuserfileupload/public");
	$ctr = 0;
	foreach ($fileArray as $value) {
		$filename = urlencode($value);
		if($filename != "index.htm") {
			echo "<tr><td class='text-left'>$value</td>";
			echo "<td><a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=31&deletefile=$filename&deletemode=public\" class='text-primary'><em>Delete</em></a></td>";
			echo "<td><a href=\"$pathuserfileupload/public/$value\" class='text-primary' target='_blank'><em>Download</em></a></td></tr>";
		} // if
	} // foreach
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
     $target = "../transfers/$userfolder/"; 
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
               echo "<h5 class = 'text-white text-center  '>Sorry, there was a problem uploading your file. Please try again.</h5>"; 
          }
     } 

     echo "<br>";
} 

function UploadFilePublic()
{
     $target = "../transfers/public/"; 
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
