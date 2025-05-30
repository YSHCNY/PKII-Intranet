<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

<!-- Include JS -->


</head>
<body>

<?php 
session_start();

echo "<div class = 'px-4'>";
	echo "<div class = 'mt-4'>Course<input class ='form-control' placeholder='Course' name='coursegraduated'></div>";
	echo "<div class = 'mt-4'>Year Graduated<input class ='form-control' type = 'date' placeholder='' name='yeargraduated'></div>";
	echo "<div class = 'mt-4'>School/University Graduated<input class ='form-control' placeholder='University Graduated' name='schoolgraduated'></div>";
	echo "<div class = 'mt-4'>School/University Address<input class ='form-control' placeholder='Address' name='schooladdress'></div>";
echo "</div>";
// end add education

     
 
    

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

?> 
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect61');
        new Choices(element, { searchEnabled: divue });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect71');
        new Choices(element, { searchEnabled: divue });
    });
</script>
</body>
</html>