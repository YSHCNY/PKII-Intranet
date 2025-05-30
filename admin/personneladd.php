<?php 

include("db1.php");
include ("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$tmpemployeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';
$tmpname_last = (isset($_GET['nl'])) ? $_GET['nl'] :'';
$tmpname_first = (isset($_GET['nf'])) ? $_GET['nf'] :'';
$tmpname_middle = (isset($_GET['nm'])) ? $_GET['nm'] :'';
$tmpemployee_type = (isset($_GET['pt'])) ? $_GET['pt'] :'';

$postemployeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$postname_last = (isset($_POST['name_last'])) ? $_POST['name_last'] :'';
$postname_first = (isset($_POST['name_first'])) ? $_POST['name_first'] :'';
$postname_middle = (isset($_POST['name_middle'])) ? $_POST['name_middle'] :'';
$postpersonnel_type = (isset($_POST['personnel_type'])) ? $_POST['personnel_type'] :'';

if ($postemployeeid != '') {
    $tmpemployeeid = $postemployeeid;
    $tmpname_last = $postname_last;
    $tmpname_first = $postname_first;
    $tmpname_middle = $postname_middle;
    $tmpemployee_type = $postpersonnel_type;
}

$found = 0;
?>

<div class="p-4">

  
        <div class=" mb-4">
            <label for='input'>Employee Number</label>
            <div class="">
            <input name="employeeid" value="<?php echo $tmpemployeeid ?>" placeholder = '0000' class="form-control">
            </div>
        </div>
        <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Last name</label>
      <input type="text"  class="form-control" name = 'name_last' value = '<?php echo $tmpname_last ?>' id="validationDefault01" placeholder="Last name" >
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">First name</label>
      <input type="text" class="form-control"  name = 'name_first' value = '<?php echo $tmpname_first ?>' id="validationDefault02" placeholder="First name" >
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefaultUsername">Middle Name</label>
      <input type="text" class="form-control"  name = 'name_middle' value = '<?php echo $tmpname_middle ?>' id="validationDefault02" placeholder="Middle name" >
    
    </div>

      
        </div>
        <div class="">
            <label for='input'>Personnel Type</label>
			<div class="">
            <select name="personnel_type" class="form-select h4 p-2">
                <option value="select" <?php echo $tmpemployee_type == 'select' ? 'selected' : '' ?>>Select</option>
                <option value="employee" <?php echo $tmpemployee_type == 'employee' ? 'selected' : '' ?>>Employee</option>
                <option value="consultant" <?php echo $tmpemployee_type == 'consultant' ? 'selected' : '' ?>>Consultant</option>
                <option value="others" <?php echo $tmpemployee_type == 'others' ? 'selected' : '' ?>>Others</option>
            </select>
			</div>

        </div>
      
    
</div>



<?php
    $resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);	

 


?>