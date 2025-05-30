<!-- PERSONEDIT HOMEPAGE -->


<div class="modal fade" id="addpersonnel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add New Personnel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
    <?php
    echo "<form action='personneladd2.php?loginid=$loginid&eid=$employeeid' method='post' name=\"personnelprojassignadd2\">";
      include 'personneladd.php';
      echo "";
    ?>
  
      </div>
      <div class="modal-footer">
      <button type="submit" class = 'btn bg-success text-white' name="submit">Upload</button>
      </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>


    </div>
  </div>
</div>








<!-- [[[[[[[[[[[[[[[[[[[[[[PERSONEDIT2]]]]]]]]]]]]]]]]]]]]]] -->
<!-- upload personnel image [[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]]-->
<div class="modal fade" id="perimg" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Upload Employee Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form enctype="multipart/form-data" action="personnelpicupload.php?eid=<?php echo $employeeid?>&loginid=<?php echo $loginid?>" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
Choose a file to upload:<br>
<input class="form-control" type="file" name="uploadedfile" id="file" required>
        <div class="text-end mt-4">
        </div>

      </div>
      <div class="modal-footer">
      <button type="submit" class = 'btn bg-success text-white' name="submit">Upload</button>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
</form>

    </div>
  </div>
</div>










<!-- add project assignment [[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]] -->

<div class="modal fade" id="projassadd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Project Assignment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
    <?php
    echo "<form action='personnelprojassignadd2.php?loginid=$loginid&eid=$employeeid' method='post' name=\"personnelprojassignadd2\">";
      include 'personnelprojassignadd.php';
      echo "";
    ?>
  
      </div>
      <div class="modal-footer">
      <button type="submit" class = 'btn bg-success text-white' name="submit">Upload</button>
      </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>


    </div>
  </div>
</div>





<!-- add bank account [[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]] -->

<div class="modal fade" id="bnkadd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Bank Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


    <?php
    echo "<form action='personnelbankacctadd2.php?loginid=$loginid&eid=$employeeid' method='post'>";
      include 'personnelbankacctadd.php';
      echo "";
    ?>
  
      </div>
      <div class="modal-footer">
      <button type="submit" class = 'btn bg-success text-white' name="submit">Upload</button>
      </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>


    </div>
  </div>
</div>




<!-- add insurance policy [[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]] -->

<div class="modal fade" id="aip" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Insurance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


    <?php
      echo "<form action='personnelinsureempadd2.php?loginid=$loginid&eid=$employeeid' method='post'>";
      include 'personnelinsureempadd.php';

    ?>
  
      </div>
      <div class="modal-footer">
      <button type="submit" class = 'btn bg-success text-white' name="submit">Upload</button>
      </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>


    </div>
  </div>
</div>




<!-- add professional license [[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]] -->

<div class="modal fade" id="apl" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Passport Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


    <?php
    echo "<form action='personnelempproflicedit2.php?loginid=$loginid&eid=$employeeid' method='post'>";
      include 'personnelempproflicadd.php';
      echo "";
    ?>
  
      </div>
      <div class="modal-footer">
      <button type="submit" class = 'btn bg-success text-white' name="submit">Upload</button>
      </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>


    </div>
  </div>
</div>






<!-- add passport policy [[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]] -->

<div class="modal fade" id="aps" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Passport Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


    <?php
    echo "<form action='personnelpassportadd2.php?loginid=$loginid&eid=$employeeid' method='post'>";
      include 'personnelpassportadd.php';
      echo "";
    ?>
  
      </div>
      <div class="modal-footer">
      <button type="submit" class = 'btn bg-success text-white' name="submit">Upload</button>
      </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>


    </div>
  </div>
</div>













<!-- add educational attaintment  [[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]] -->

<div class="modal fade" id="aeb" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Education Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


    <?php
    echo "<form action='personnelempeducedit2.php?loginid=$loginid&eid=$employeeid' method='post'>";
      include 'personnelempeducadd.php';
      echo "";
    ?>
  
      </div>
      <div class="modal-footer">
      <button type="submit" class = 'btn bg-success text-white' name="submit">Upload</button>
      </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>


    </div>
  </div>
</div>









<!-- add emergency details  [[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]] -->

<div class="modal fade" id="aed" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Emergency Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <?php
 
    echo "<form action='personnelemergencyedit2.php?loginid=$loginid&eid=$employeeid' method='post'>";
      include 'personnelemergencyedit.php';
      echo "";
    ?>
  
      </div>
      <div class="modal-footer">
      <button type="submit" class = 'btn bg-success text-white' name="submit">Upload</button>
      </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>


    </div>
  </div>
</div>













<!-- add dependent  [[[[[[[[[[[[[[[[[]]]]]]]]]]]]]]]]] -->

<div class="modal fade" id="adep" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Dependent Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


    <?php
    echo "<form action='personnelempdependentadd2.php?loginid=$loginid&eid=$employeeid' method='post'>";
      include 'personnelempdependentadd.php';
      echo "";
    ?>
  
      </div>
      <div class="modal-footer">
      <button type="submit" class = 'btn bg-success text-white' name="submit">Upload</button>
      </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>


    </div>
  </div>
</div>










