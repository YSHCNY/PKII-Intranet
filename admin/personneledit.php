


<?php 

include("db1.php");
include ("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$pid = (isset($_GET['pid'])) ? $_GET['pid'] :'';

$employeetype = (isset($_POST['employeetype'])) ? $_POST['employeetype'] :'';
$employeeorder = (isset($_POST['employeeorder'])) ? $_POST['employeeorder'] :'';

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     include 'pereditmodals.php';
?>


<style>
     td, th{
          text-align: center !important;
     }

    
</style>
<a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="btn mb-4 text-white mainbtnclr ">
             Back
          </a>

          <div class="mb-5 p-5 shadow border">



   <h4 class="mb-0 pb-0">Personnel List</h4>
   <p>Manage all personnel information</p>

<div class="d-flex justify-content-center gap-5 my-3">
     <div>
     <button type="button" class="btn text-white bg-primary" data-toggle="modal" data-target="#addpersonnel">
     Add new record
</button>

     </div>
     <div>
          <form action="personnelinsurance.php?loginid=<?php echo $loginid; ?>" method="POST" name="personnelinsurance">
               <input type="submit" value="Manage Group Insurance" class="btn bg-primary text-white" >
          </form>
     </div>
     <div>
          <form action="personneltmpprojassignmng.php?loginid=<?php echo $loginid; ?>" method="POST" name="personneltmpprojassignmng">
               <input type="submit" value="Manage tmp.Proj.Assignments" class="btn bg-primary text-white" >
          </form>
     </div>
</div>






    
    
          <form action="personneledit.php?loginid=<?php echo $loginid; ?>" method="POST" name="personneledit" class="">
          <div class="row">
              <div class="col-5">
                  <p class=" m-0">Choose Criteria</p>
                  <select name="employeetype" class='form-select h5 px-4 py-2'>
                      <option value="active-employees">Active Employees</option>
                      <option value="active-consultants">Active Consultants</option>
                      <option value="active-employees-consultants" selected>Active Employees & Consultants</option>
                      <option value="inactive-employees">Inactive Employees</option>
                      <option value="inactive-consultants">Inactive Consultants</option>
                      <option value="inactive-employees-consultants">Inactive Employees & Consultants</option>
                      <br>
                      <hr>
                      <br>

                      <option value="all-employees">All Employees</option>
                      <option value="all-consultants">All Consultants</option>
                      <option value="all-personnel">ALL</option>
                  </select>
              </div>

              <div class="col-5">
                  <p class=" m-0">Sort by</p>
                  <select name="employeeorder" class='form-select h5 px-4 py-2'>
                      <option value="tblcontact.employeeid">Employee Number</option>
                      <option value="tblcontact.name_last" selected>Last Name</option>
                      <option value="tblcontact.name_first">First Name</option>
                      <option value="tblcontact.email1">E-mail</option>
                  </select>
              </div>


              <div class = 'col-2'>
                  <button type="submit" class="mt-4 btn mainbtnclr px-3 text-white" >Sort List </button>
              </div>
              </div>

          </form>
     </div>


     <div class="shadow p-5 border border-1 rounded">

<?php
     if($employeetype == 'active-employees')
     {
          $resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder";
     }
     else if($employeetype == 'inactive-employees')
     {
          $resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder";
     }
     else if($employeetype == 'all-employees')
     {
          $resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type != 'consultant' ORDER BY $employeeorder";
     }
     else if($employeetype == 'active-consultants')
     {
	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder";
     }
     else if($employeetype == 'inactive-consultants')
     {
	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder";
     }
     else if($employeetype == 'all-consultants')
     {
	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.employee_type = 'consultant' ORDER BY $employeeorder";
     }
     else if($employeetype == 'all-personnel')
     {
	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' ORDER BY $employeeorder";
     }
     else if($employeetype == 'active-employees-consultants')
     {
	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.emp_record = 'active' ORDER BY $employeeorder";
     }
     else if($employeetype == 'inactive-employees-consultants')
     {
	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.emp_record = 'inactive' ORDER BY $employeeorder";
     } else {
	$resquery = "SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle, tblcontact.email1, tblcontact.email2, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2 FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel'";

     }
     ?>
<table id="personinfo" class="table table-hover table-bordered table-striped my-3" width = '100%'>

<thead>
<tr>
   
     <th class="">Employee ID</th>
     <th class="">LastName, FirstName M.I.</th>
     <th class="">Personal Contact Number</th>
     <th class="">Personal Email</th>
     <th class="">Action</th>
</tr>
</thead>
<tbody>
     <?php
     $count = 0;

	$result = $dbh2->query($resquery);
	if($result->num_rows>0) {
		while($myrow = $result->fetch_assoc()) {
               $count = $count + 1;
               $pid = $myrow['employeeid'];
               $employeeid = $pid;
               $namefirst = $myrow['name_first'];
               $namelast = $myrow['name_last'];
               $namemiddle = $myrow['name_middle'];
               $email1 = $myrow['email1'];
               $email2 = $myrow['email2'];
               $contact_address1 = $myrow['contact_address1'];
               $contact_address2 = $myrow['contact_address2'];
               $contact_city = $myrow['contact_city'];
               $contact_province = $myrow['contact_province'];
               $contact_zipcode = $myrow['contact_zipcode'];
               $contact_country = $myrow['contact_country'];
               $num_res1_cc = $myrow['num_res1_cc'];
               $num_res1_ac = $myrow['num_res1_ac'];
               $num_res1 = $myrow['num_res1'];
               $num_res2_cc = $myrow['num_res2_cc'];
               $num_res2_ac = $myrow['num_res2_ac'];
               $num_res2 = $myrow['num_res2'];
               $num_mobile1_cc = $myrow['num_mobile1_cc'];
               $num_mobile1_ac = $myrow['num_mobile1_ac'];
               $num_mobile1 = $myrow['num_mobile1'];
               $num_mobile2_cc = $myrow['num_mobile2_cc'];
               $num_mobile2_ac = $myrow['num_mobile2_ac'];
               $num_mobile2 = $myrow['num_mobile2'];
          ?>
          
      
          <tr>
              
               <td class=""><?php echo "<input value = '$count'  type='hidden'>"; ?> <?php echo $employeeid; ?></td>
               <?php
               $midint = $namemiddle;
               ?>

               <td class=""><?php echo "$namelast,  $namefirst $midint[0]."; ?></td>

              


               <td class="">
                   <?php
                   if($num_mobile1 <> '') {
                       echo "$num_mobile1_cc $num_mobile1_ac $num_mobile1";
                   }
                   if(($num_mobile2 <> '') && ($num_mobile1 <> '')) {
                       echo "<br>$num_mobile2_cc $num_mobile2_ac $num_mobile2";
                   }
                   else if(($num_mobile2 <> '') && ($num_mobile1 == '')) {
                       echo "$num_mobile2_cc $num_mobile2_ac $num_mobile2";
                   }
                   ?>
               </td>


               <td class="">
                   <?php
                   if($email1 <> '') {
                       echo "<a href=\"mailto:$email1\">$email1</a><br>";
                   }
                   if(($email2 <> '') && ($email1 <> '')) {
                       echo "<a href=\"mailto:$email2\">$email2</a><br>";
                   }
                   else if(($email2 <> '') && ($email1 == '')) {
                       echo "<a href=\"mailto:$email2\">$email2</a>";
                   }
                   ?>
               </td>


               <td class="">
                    <a href="personneledit2.php?pid=<?php echo $pid; ?>&loginid=<?php echo $loginid; ?>" class="btn bg-success text-white " >
                        Edit
                    </a>
               </td>
               
           </tr>
           <?php
           }
           }
     ?>
     </tbody>
     </table>

     </div>

  
     <?php
     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
