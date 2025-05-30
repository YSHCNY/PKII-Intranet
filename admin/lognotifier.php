<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Tools >> View log files</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue><font color=white><b>Notifier Log Files</b></font></td></tr>";

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminloginid=$loginid", $dbh); 

     if($uploadsw == "yes")
     {
          UploadFile();
     }    

     echo "<tr><td>File/s:</td></tr>";

     $fileArray = ReadFolderDirectory("/var/www/pkii/admin/logs/");

     arsort($fileArray);

     $ctr = 0; 

     foreach ($fileArray as $value)
     {
	$filename = urlencode($value);

	if ($filename == 'index.htm')
	{  }
	else
	{ echo "<tr><td><a href=\"logs/$value\" target=\"_blank\">View</a> <b>$value</b></td></tr>"; }
     }
     echo "</table>";

     echo "<p><a href=\"logs.php?loginid=$loginid\">Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminloginid=$loginid", $dbh); 
  
     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);

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
                        $listDir[$sub] = $this->ReadFolderDirectory($dir."/".$sub);
                    }
                }
            } 
            closedir($handler);
        }
        return $listDir;   
} 

?> 
