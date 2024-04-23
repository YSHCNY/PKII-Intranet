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
	<div class=" mt-5 p-5" id = "mainbgc2">
		<h4  class = "ms-5 py-5 text-white">Training materials</h4>


	<div class="row">
		<div class="col-md-12">
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

	<div class="row">

		<div class="col-md-1"></div>

		<div class="col-md-10">
<table class="table">
	<thead>
<!--	<tr><th colspan="3">Public file(s)</th></tr> -->
	</thead>
	<tbody>
<!--	<tr><td colspan="3"> -->
<?php
/*
	echo "<form enctype=\"multipart/form-data\" action=\"index.php?lst=1&lid=$loginid&sess=$session&p=31\" method=\"POST\">";
	echo "<input name=\"uploadsw\" type=\"hidden\" value=\"yes\">"; 
	echo "<input name=\"uploadmode\" type=\"hidden\" value=\"public\">";
	echo "<input name=\"uploaded\" type=\"file\" /><br />";
	echo "<input type=\"submit\" class=\"btn btn-primary btn-lg\" value=\"Upload\" />";
	echo "</form>";
*/
?>
<!--	</td></tr> -->
	<!-- <tr> -->
<?php
	//
	// display folders > Level 0
	//
	$dirArray = ReadFolderDirectory0("$pathtraining");
	$ctr0 = 0;
	foreach ($dirArray as $value0) {
		$dirname = urlencode($value0);
		echo "<tr><th class='text-left' colspan='4'>$value0</th>";
		// echo "<td>[folder]</td>";
		// echo "<td><a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=25&deletedir=$dirname&deletemode=public\" class='text-primary'><em>Remove</em></a></td>";
		// echo "<td></td>";
		echo "</tr>";

	} // foreach of folder level 0

        //
	    // display files > Level 0
	    //
	    $fileArray = ReadFolderDirectory("$pathtraining/$value0/$valuef0");
	    $ctr = 0;
	    foreach ($fileArray as $valuef0) {
		    $filename = urlencode($valuef0);
		    if($filename != "index.htm") {
			    echo "<tr><td class='text-left'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='$pathtraining/$value0/$valuef0' class='text-primary' target='_blank'>$valuef0</a></td>";
			    // echo "<td><a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=25&deletefile=$filename&deletemode=public\" class='text-primary'><em>Delete</em></a></td>";
			    echo "<td></td>";
			    echo "<td><a href=\"$pathtraining/$value0/$valuef0\" class='text-primary' target='_blank'><em>Download</em></a></td></tr>";
		    } // if
	    } // foreach of files level 0

        //
		// display folders > Level 1
		//
		$dirArray = ReadFolderDirectory0("$pathtraining/$value0");
		$ctr0 = 0;
		foreach ($dirArray as $valued1) {
			$dirname = urlencode($valued1);
			echo "<tr><td class='text-left'>&nbsp;&nbsp;&nbsp;&nbsp;$valued1</td>";
			echo "<td>[folder]</td>";
			// echo "<td><a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=25&deletedir=$dirname&deletemode=public\" class='text-primary'><em>Remove</em></a></td>";
			echo "<td></td></tr>";
		} //foreach of folder level 1
			
			//
			// display folders > Level 2
			//
			$dirArray = ReadFolderDirectory0("$pathtraining/$value0/$valued1/$valued2");
			$ctr0 = 0;
			foreach ($dirArray as $valued2) {
				$dirname = urlencode($valued2);
				echo "<tr><td class='text-left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$valued2</td>";
				echo "<td>[folder]</td>";
				// echo "<td><a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=25&deletedir=$dirname&deletemode=public\" class='text-primary'><em>Remove</em></a></td>";
				echo "<td></td></tr>";
				
				//
				// display files > Level 2
				//
				$fileArray = ReadFolderDirectory("$pathtraining/$value0/$valued1/$valued2/$valuef2");
				$ctr = 0;
				foreach ($fileArray as $valuef2) {
					$filename = urlencode($valuef2);
					if($filename != "index.htm") {
						echo "<tr><td class='text-left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='$pathtraining/$value0/$valued1/$valued2/$valuef2' class='text-primary' target='_blank'>$valuef2</a></td>";
						// echo "<td><a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=25&deletefile=$filename&deletemode=public\" class='text-primary'><em>Delete</em></a></td>";
						echo "<td></td>";
						echo "<td><a href=\"$pathtraining/$value0/$valued1/$valued2/$valuef2\" class='text-primary' target='_blank'><em>Download</em></a></td></tr>";
					} // if
				} // foreach of files level 2
				// reset vars
				$valued2=""; $valuef2="";
			} //foreach of folder level 2
			

?>
	<!-- </tr> -->
	</tbody>
</table>
		</div><!-- div class="col-md-5" -->

		<div class="col-md-1"></div>
	</div><!-- div class="row" -->
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
