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

?>
<div class="px-4">
<div class="form-row">
    <div class="form-group mt-2 col-md-4">
      <label for="inputEmail4">Last</label>
      <input type="text" class="form-control" placeholder = 'Last Name Here...' name = 'dependentlast' >
    </div>

	<div class="form-group mt-2 col-md-4">
      <label for="inputEmail4">First</label>
      <input type="text" class="form-control" placeholder = 'First Name Here...' name = 'dependentfirst' >
    </div>

	<div class="form-group mt-2 col-md-4">
      <label for="inputEmail4">Middle</label>
      <input type="text" class="form-control" placeholder = 'Middle Name Here...' name = 'dependentmiddle' >
    </div>
   
  </div>


  <div class="form-group">
  <label for="inputEmail4">Birthday</label>
     <input type="date" class="form-control" name = 'dependentbday'>
  </div>

  
  <div class="form-group">
  <label for="inputEmail4">Relation</label>
     <input type="text" class="form-control" placeholder ='Relation here..' name = 'dependentrelation'>
  </div>

  </div>
<?php

// end add dependent

     // echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

  ?>

<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect61');
        new Choices(element, { searchEnabled: true });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect71');
        new Choices(element, { searchEnabled: true });
    });
</script>
</body>
</html>