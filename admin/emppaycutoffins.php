<?php
  // add/remove personnel
  session_start();
  require_once("db1.php");

  $loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
  $empids = (isset($_POST['empid'])) ? $_POST['empid'] :'[]';
  $cutoff = (isset($_POST['cutoff'])) ? $_POST['cutoff'] :'';
  $cutend = (isset($_POST['cutend'])) ? $_POST['cutend'] :'';
  $cutstart = (isset($_POST['cutstart'])) ? $_POST['cutstart'] :'';





echo "<input value = '$cutoff' name = 'thisurl'>";
//   foreach($empids as $eem){
//     echo "$eem <br>";
//   }
//   echo "$empids, $cutoff, $cutend, $cutstart";


//   echo "<p colspan='3'>Preparing and saving list of personnel for $cutstart -to- $cutend</p>";
	
//   // verify checked employeeid
  foreach($empids as $value) {

    //   query tblemppayroll based on cutoff and compare employeeid's
      $res14qry=""; $result14=""; $found14=0;
      $res14qry="SELECT employeeid FROM tblemppayroll WHERE cut_start='$cutstart' AND cut_end='$cutend' AND employeeid='$value' ORDER BY employeeid ASC";
  // echo "$res14qry<br>";
      $result14=$dbh2->query($res14qry);
      if($result14->num_rows>0) {
          while($myrow14=$result14->fetch_assoc()) {
              $found14=1;
              $employeeid14 = $myrow14['employeeid'];
          } // while
      } // if
      if($found14==0) {
          // insert query new employeeid.
          $res14aqry=""; $result14a=""; $found14a=0;
          $res14aqry="SELECT ref_no, proj_code, proj_name, salary, salarycurrency, salarytype, ecola1, durationfrom, durationto FROM tblprojassign WHERE employeeid='$value' AND salary<>0 ORDER BY durationfrom DESC LIMIT 1";
          $result14a=$dbh2->query($res14aqry);
          if($result14a->num_rows>0) {
              while($myrow14a=$result14a->fetch_assoc()) {
                  $found14a=1;
                  $ref_no14a = $myrow14a['ref_no'];
                  $proj_code14a = $myrow14a['proj_code'];
                  $proj_name14a = $myrow14a['proj_name'];
                  $salary14a = $myrow14a['salary'];
                  $salarycurrency14a = $myrow14a['salarycurrency'];
                  $salarytype14a = $myrow14a['salarytype'];
                  $ecola114a = $myrow14a['ecola1'];
                  $durationfrom14a = $myrow14a['durationfrom'];
                  $durationto14a = $myrow14a['durationto'];
              } // while
          } // if
          if($found14a==1) {
              if($salarytype14a=='daily') {
                  $salary14a = $salary14a*26;
              } elseif($salarytype14a=='weekly') {
                  $salary14a = $salary14a*4;
              } // if
              if($ecola114a=='') {
                  $ecola114a=0;
              } // if
          } else {
              $salary14a=0; $proj_name14a=''; $ecola114a=0;
          } // if
          $res14bqry="";
          $res14bqry="INSERT INTO tblemppayroll SET employeeid='$value', emp_salary=$salary14a, deduction=0, phil_ded=0, tax=0, emp_over_duration=0, net_pay=0, emp_date_wrk=0, emp_sick='', emp_vacation='', cut_start='$cutstart', cut_end='$cutend', regholiday=0, speholiday=0, emp_late_duration=0, otsunday=0, regholidayamt=0, speholidayamt=0, otsundayamt=0, overamt=0, nightdiffminutes=0, nightdiffamt=0, totaltardy=0, otherincome=0, otherincometaxable=0, otherdeduction=0, emp_dep='$proj_name14a', pagibig=0, vlused=0, slused=0, philemp=0, ss=0, ec=0, bracket=0, absentamt=0";
          $result14b="";
          $result14b=$dbh2->query($res14bqry);
          if(mysqli_insert_id($dbh2)!='') {
              // insert record success
              echo "$value > <font color='green'>new. record inserted.</font><br>";
              header("location: emppaycutoffaddremove.php?ctoff=". $cutoff ."&loginid=".$loginid);

          } else {
              // insert record error
              echo "$value > <font color='red'>new. record insert error.</font><br>";
              header("location: emppaycutoffaddremove.php?ctoff=". $cutoff ."&loginid=".$loginid);
      
          } // if-else(mysqli_insert_id)
          
          if($ecola114a!=0) {
              // insert ecola as employment benefits in tblemppayincomenontaxable
              // set last day of year based on durationfrom
              $durationtoyyyy = date('Y', strtotime($yearnow));
              $durationto = $durationtoyyyy."-12-31";
              $res14cqry="";
              $res14cqry="INSERT INTO tblemppayincomenontaxable SET employeeid='$value', add_desc='Employment Benefits', start='$durationfrom14a', end='$durationto', amount=$ecola114a";
              $result14c=""; $found14c=0;
              $result14c=$dbh2->query($res14cqry);
              /* if(mysqli_insert_id($dbh2)!='') {
                  // insert record success
              echo "$value > <font color='green'>ecola record inserted.</font><br>";
              } else {
                  // insert record error
              echo "$value > <font color='red'>ecola record insert error.</font><br>";
              } // if-else(mysqli_insert_id) */
          } // if

      } 
      // echo "$value f14:$found14<br>f14a:$found14a $res14aqry<br>$res14bqry<br>$res14cqry<br>";
      $employeeid14=''; $res14aqry=''; $res14bqry=''; $res14cqry='';
  } // foreach


  if ($found14 == 1){
    // determine unchecked employeeid
$res14qry="";
$res14qry="SELECT employeeid FROM tblemppayroll WHERE cut_start='$cutstart' AND cut_end='$cutend' ORDER BY employeeid ASC";
// echo "$res14qry<br>";
$result14=""; $found14=0;
$result14=$dbh2->query($res14qry);
if($result14->num_rows>0) {
while($myrow14=$result14->fetch_assoc()) {
    $found14=1;
    $employeeid14 = $myrow14['employeeid'];
    if (in_array($employeeid14, $empids) == false) {
        // delete query
        $res14aqry="";
        $res14aqry="DELETE FROM tblemppayroll WHERE employeeid='$employeeid14' AND cut_start='$cutstart' AND cut_end='$cutend'";
        $result14a="";
        $result14a=$dbh2->query($res14aqry);
        if($result14a!='') {
            // delete record
        echo $employeeid14."<font color='green'> > deleting record.</font><br>";
        header("location: emppaycutoffaddremove.php?ctoff=". $cutoff ."&loginid=".$loginid);


    
        } else {
            // error in deleting record.
        echo $employeeid14."<font color='red'> > error in deleting record.</font><br>";
        header("location: emppaycutoffaddremove.php?ctoff=". $cutoff ."&loginid=".$loginid);



        } // if-else
    } // if
// echo "$res14aqry<br>";
    $employeeid14=''; $res14aqry='';
} // while
} // if
} 
  
  // insert logs
  $adminlogdetails = "$loginid:$username - add-remove personnel thru empID for cutoff $cutstart -to- $cutend in employees payslip > custom cutoff";
  $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$username\", adminlogdetails=\"$adminlogdetails\"";
  $result17 = $dbh2->query($res17query);
  


  $dbh2->close();

?>