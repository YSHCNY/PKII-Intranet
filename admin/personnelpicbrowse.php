<?php 

$employeeid = $_GET['eid'];


?> 

<form enctype="multipart/form-data" action="personnelpicupload.php?eid=<?=$employeeid?>" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
Choose a file to upload:<br>
<input name="uploadedfile" type="file" /><br />
<input type="submit" value="Upload File" />
</form>
