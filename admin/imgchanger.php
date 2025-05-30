
  

<div class="shadow p-4">
  <h5>Upload an Image</h5>
  <h6 class="text-danger"><i>Note: It is suggested to have a portrait size image.</i></h6>
    <form action="uploadimg.php?loginid=<?php echo $loginid;?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="10485760"> 
        <input class="form-control" type="file" name="file" id="file" required>
        <div class="text-end mt-4">
        <button type="submit" class = 'btn bg-success text-white' name="submit">Upload</button>
        </div>
    </form>




    </div>
    <div class="my-3">
    <p class="text-center">OR</p>
    </div>
    <div class="shadow p-3">
        <?php 
        
        $getsql2 = "SELECT * FROM logimg WHERE activeimg = 1";
        $resultsql2 = $dbh2->query($getsql2);
        if($resultsql2->num_rows > 0){
            while($rowcols2 = $resultsql2->fetch_assoc()){
                $imgname2 = $rowcols2['filename'];
                $idcurrimg = $rowcols2['id'];

            }
        }

        if ($idcurrimg == 0){
            $hidethis = 'hidden';
            $text = 'default image';
            $dis = 'disabled';
            $imgname2 = 'Group 35.png';
        } else {
            $dis = '';
            $hidethis = '';
            $text = 'Remove Image';
        }
        ?>


        <div class="row my-3 border mx-3 p-4 rounded-3">
            <div class="col"><p>Current Displayed Image</p></div>
            <div class="col"> <img src='../vc/img/<?php echo $imgname2?>' alt='<?php echo $imgname2?>' width='50'><input type="hidden" value = '<?php echo $idcurrimg?>'></div>

            <div class="col"><?php  echo "<td><a href = 'useimage.php?loginid=$loginid&remid=removecurrimg&idcur=$idcurrimg' class = 'btn  bg-success text-white' $dis> $text</a></td>";?></div>
           

        </div>
       

    <table class='table table-hover'>
    <thead>
        <tr>
            <th class='h5'>Image</th>
            <th class='h5'>File Name</th>
            <th class='h5'>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $getsql = "SELECT * FROM logimg";
    $resultsql = $dbh2->query($getsql);
    if($resultsql->num_rows > 0){
        while($rowcols = $resultsql->fetch_assoc()){
            $imgname = $rowcols['filename'];
            $idofimg = $rowcols['id'];
            
            echo "<tr>";
            echo "<td><img src='../vc/img/{$imgname}' alt='{$imgname}' width='50'></td>";
            echo "<td>{$imgname}</td>";
            echo "<td><a href = 'useimage.php?loginid=$loginid&imgid=$idofimg&useid=usenotdel&idcur=$idcurrimg' class = 'btn bg-success text-white'>Use Image</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No records found.</td></tr>";
    }
    ?>
    </tbody>
</table>


    </div>   
  
  
  