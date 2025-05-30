<?php
//
// 20191023
// mnglvreqdtl.php
// fr mngotrequest.php
//
include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$id0 = (isset($_GET['lvid'])) ? $_GET['lvid'] :'';
$id = (isset($_POST['lvid'])) ? $_POST['lvid'] :'';
if($id0!='') { $id=$id0; }

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
    include ("addons.php");
    include ("header.php");
    include ("sidebar.php");
	
	// include '../vc/mhrotreqdetails.php';
	
  $resquery2=""; $result2=""; $found2=0;
	$resquery2 = "SELECT tblcontact.name_first, tblcontact.name_last FROM tblcontact WHERE  tblcontact.employeeid=".$employeeid0." AND contact_type='personnel' LIMIT 1";
	$result2 = $dbh2->query($resquery2);
	if($result2->num_rows>0) {
	while($myrow2 = $result2->fetch_assoc()) {
    $found2=1;
		echo "<input type='hidden' id='fullname' name='fullname' value='".$myrow2['name_first'].' '. $myrow2['name_last']."' />";
    $fullname = "".$myrow2['name_first']." ".$myrow2['name_last']."";
	} // while		
	} // if
	
    $resquery = "SELECT *, tblcontact.employeeid as employee_id from tblhrtalvreq LEFT JOIN tblcontact ON tblcontact.employeeid=tblhrtalvreq.employeeid WHERE idhrtalvreq=".$id."";
	$result = $dbh2->query($resquery);

?>
	<div class="row">
		<div class="col-md-12">
      <h4 style="text-align: left">Leave Details id: <span id="lvreqid"><?php echo $id; ?></span></h4>
      <table class='table table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
        <?php 
        while($myrow = $result->fetch_assoc()) {
            // $try = strtotime($myrow['durationto']) - strtotime($myrow['durationfrom']);
            // $hrs = $try/(60*60*24);
            // $daysapproved = $myrow['daysapproved'];
            $daysapproved = $myrow['daysapproved'];
            if($daysapproved==0) {
            $datefrom = new DateTime($myrow['durationfrom']);
            $dateto = new DateTime($myrow['durationto']);
            $daysapproved = $dateto->diff($datefrom)->format("%a");
            if(strtotime($myrow['durationto'])==strtotime($myrow['durationfrom'])) {
              $hrs=1;
              $daysapproved=$hrs;
            } else {
              $daysapproved = $daysapproved+1;
            } // if-else
            } // if
            $status = ($myrow['statusta'] == 0 ? 'Pending' : 'Approved');
            if($myrow['statusta']==2) {
              $status="Disapproved"; $statclr='text-danger';
            } else if($myrow['statusta']==1) {
              $statclr='text-success';
            } else if($myrow['statusta']==0) {
              $statclr='text-dark';
            } else if($myrow['statusta']==3) {
              $statclr='text-success';
            } // if-else
            $btn = '';
            if($status == 'Pending'){
							if($myrow['approverempid']==$employeeid0) {
                // $btnappr = "<button class='btn btn-success btn-approve' data-id='".$myrow['idhrtalvreq']."' style='margin-right:5px;'>Approve</button>";
                $btnappr = "<button class='btn btn-success' style='margin-right:5px;'>Approve</button>";
                // $btndisappr = "<button class='btn btn-danger btn-disapprove' data-id='".$myrow['idhrtalvreq']."' style='margin-right:5px;'>Disapprove</button>";
                $btndisappr = "<button class='btn btn-danger' style='margin-right:5px;'>Disapprove</button>";
							} // if
							if($myrow['employeeid']==$employeeid0) {
                
								$btnreq = "<button class='btn btn-primary btn-request' data-id='".$myrow['idhrtalvreq']."' style='margin-right:5px;'>Re-request for Approval</button>";
							} // if
							// note: notedby button is accessible in admin pages
							/* if($myrow['notedbyempid']==$employeeid0) {
								$btnnote = "<button class='btn btn-success btn-approve' data-id='".$myrow['idhrtalvreq']."' style='margin-right:5px;'>Noted</button>";
							} // if */
            }

            echo "<tr>";
            echo "<th colspan = '1'>Employee Name: </th>";
            echo "<td colspan = '2'>".$myrow['name_first']." ".$myrow['name_last']."</span></td>";
            echo "<th colspan = '1'> EmployeeID: </th>";
            echo "<td colspan = '2'>".$myrow['employee_id']."</td>";
            echo "</tr>";

            $resquery21 = "SELECT * from tblhrtaleavectg where idhrtaleavectg = ". $myrow['idhrtaleavectg']."";
            $result21 = $dbh2->query($resquery21);
            while($myrow21 = $result21->fetch_assoc()) {
              $leavetype = $myrow21['name'];
            }

            echo "<tr>";
            echo "<th colspan = '1'>Date Requested: </th>";
            echo "<td colspan = '2'>".date('Y-M-d', strtotime($myrow['datecreated']))."</td>";
            echo "<th colspan = '1'>Leave Type: </th>";
            echo "<td colspan = '2'>".$leavetype."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th colspan = '1'>Duration: </th>";
            echo "<td colspan = '2'>".date('Y-M-d', strtotime($myrow['durationfrom']))." - ".date('Y-M-d', strtotime($myrow['durationto'])). "</td>";
            // echo "<form action='index.php?lst=1&lid=$loginid&sess=$session&p=369' method='POST' name='mhrlvfrmreq3'>";
            // echo "<input type=\"hidden\" name=\"lvrid\" value=\"$id\">";
            echo "<th colspan = '1'>No. of days approved: </th>";
            // echo "<td colspan = '1'>".number_format($hrs,1)."</td>";
            /* if($myrow['approverempid']==$employeeid0 && $myrow['statusta']==0) {
              // input field
              echo "<td><input type='number' size='2' name='daysapproved' id='approveddays' value=\"$daysapproved\"></td>";
            } else { */
              echo "<td>".$myrow['daysapproved']."</td>";
            // } // if-else
            echo "</tr>";

            echo "<tr>";
            echo "<th colspan = '1'>Reason for Overtime: </th>";
            echo "<td colspan = '5'>".$myrow['reason']."</td>";
            echo "</tr>";

            $found1=0; $resquery1=""; $result1="";
            $resquery1 = "SELECT * from tblcontact WHERE employeeid=".$myrow['approverempid']."";
            $result1 = $dbh2->query($resquery1);
            while($myrow1 = $result1->fetch_assoc()) {
              $found1=1;
              echo "<tr>";
              echo "<th colspan = '1'>Status: </th>";
              echo "<td colspan = '2' class='$statclr'><strong>".$status."</strong></td>";
              // echo "<td colspan = '2'>".$myrow['statusta']."</td>";
              echo "<th colspan = '1'>Approver: </th>";
              echo "<td colspan = '2'>".$myrow1['name_first']." ".$myrow1['name_last']."</td>";
              echo "</tr>";
            }
    // echo "<tr><td>f1:$found1, stat:$status, appr:$myrow1 $myrow1</td></tr>";
/*					if($myrow['employeeid']==$employeeid0 && $myrow['approverempid']!=$employeeid0) {
						// echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=367\" method=\"POST\" name=\"mhrotfrmreq3\">";
            if($status!='Pending') {
						echo "<input type=\"hidden\" name=\"idhrtalvreq\" value=\"".$myrow['idhrtalvreq']."\">";
						echo "<input type=\"hidden\" name=\"reqctr\" value=\"1\">";
						echo "<tr><td colspan='4'></td><td colspan='2'>$btnreq</td></tr>";
            } // if($status!='Pending')
						// echo "</form>";
					} // if
					if($myrow['approverempid']==$employeeid0) {
            if($myrow['statusta']==0) {
						echo "<tr><td colspan='3'></td><td style='text-align: center;'>";
						// echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=367\" method=\"POST\" name=\"mhrotfrmreq3\">";
						echo "<input type=\"hidden\" name=\"idhrtalvreq\" value=\"".$myrow['idhrtalvreq']."\">";
						echo "<input type=\"hidden\" name=\"apprctr\" value=\"1\">";
						echo "<input type=\"hidden\" name=\"statusta\" value=\"1\">";
						echo "$btnappr";
						echo "</form>";
						echo "</td><td style='text-align: center;'>";
						echo "<form action='index.php?lst=1&lid=$loginid&sess=$session&p=369' method='POST' name='mhrlvfrmreq3'>";
            echo "<input type=\"hidden\" name=\"lvrid\" value=\"$id\">";
						echo "<input type=\"hidden\" name=\"idhrtalvreq\" value=\"".$myrow['idhrtalvreq']."\">";
						echo "<input type=\"hidden\" name=\"apprctr\" value=\"1\">";
						echo "<input type=\"hidden\" name=\"statusta\" value=\"2\">";
						echo "$btndisappr";
						// echo "</form>";
						echo "</td></tr>";
            } // if
					} // if
*/
					// note: notedby button is accessible in admin pages
					/* if($myrow['notedbyempid']==$employeeid0) {
						echo "<form action=\"\" method=\"\" name=\"\">";
						echo "<tr><td colspan='4'></td><td colspan='2'>$btnnote</td></tr>";
						echo "</form>";
					} // if */
        ?>
      </table>

        <div id='commentSection'>
          <h4>Comments and Remarks</h4>
          <div id="line"></div>
          <div id="messagecontainer">
            <div id="messageDiv" class="messageDiv">
              <?php 
                echo $myrow['comments'];
              ?>
            </div>
          </div>

          <!-- <div id="messagesubmit">
            <div class="col-md-9">
              <textarea placeholder="Comment Here...." id="commentTextArea" class="form-control"></textarea>
            </div>
            <div class="col-md-3">
              <button type="button" id="btnSubmit" class="btn btn-success">Submit</button>
            </div>
          </div> -->

<?php
                echo "<form action=\"./tjfunctions/updateMessage2.php?loginid=$loginid\" method=\"POST\" name=\"updateMessage2\">";
				echo "<input type='hidden' name='id' value='$id' />";
        echo "<input type='hidden' name='fullname' value='$fullname' />";
?>
          <div id="messagesubmit">
            <div class="col-md-9">
              <?php echo "<textarea placeholder=\"Comment Here....\" id=\"commentTextArea\" class=\"form-control\" name=\"message\"></textarea>"; ?>
            </div>
            <div class="col-md-3">
              <!-- <button type="button" id="btnSubmit" class="btn btn-success">Submit</button> -->
<?php
				echo "<button type='submit' class='btn btn-success'>Submit</button>";
				echo "</form>";
?>
            </div>
          </div>

        </div>
        <?php 
          }
        ?>

    </div>
	</div> <!-- div class=row -->
	
<?php 
  echo "<p><a href='mngotrequest.php?loginid=$loginid&rt=lv' class='btn btn-secondary'>Back</a></p>";
     $resquery="UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
    $result=$dbh2->query($resquery);	 

     include ("footer.php");
} else {
     include("logindeny.php");
}
?>

<script>
$(document).ready(function(){
  $('#btnSubmit').on('click',function(){
      var id = $('#otreqid').text();
      var fullname = $('#fullname').val();
      var messageDivHtml = $('#messageDiv').html();
      var newMessageDivHtml = '<div class="messageItem">';
      newMessageDivHtml += '<div class="messageFirstRow">';
      newMessageDivHtml += '<div class="col-md-8">';
      newMessageDivHtml += '<h6>'+fullname+'</h6>';
      newMessageDivHtml += '</div>';
      newMessageDivHtml += '<div class="col-md-4">';
      newMessageDivHtml += '<span>'+new Date().toLocaleString()+'</span>';
      newMessageDivHtml += '</div>';
      newMessageDivHtml += '</div>';
      newMessageDivHtml += '<div class="messageSecondRow">';
      newMessageDivHtml += '<div class="col-md-12">';
      newMessageDivHtml += '<p>'+$('#commentTextArea').val()+'</p>';
      newMessageDivHtml += '</div>';
      newMessageDivHtml += '<div style="clear:both;"></div>';
      newMessageDivHtml += '</div>';
      newMessageDivHtml += '</div>';

      allMessage = newMessageDivHtml + messageDivHtml;
      
      $('#messageDiv').html(allMessage);
      $('#commentTextArea').val('');

      $.ajax({
                            url : 'tjfunctions/updateMessage2.php',
                            type : 'POST',
                            data : {id: id, message: allMessage},
                            success : function(data){
                            

                            }
                        }); 


  });
</script>

<style>
table{
  background: white;
}
  table td{
    text-align: left;
  }

  #commentSection h1,h2,h3,h4,h5,h6,p{
    text-align: left;
  }

  #commentSection{
  width: 100%;
  height: 450px;
  background: #efefef;
  padding:10px; 
  border-radius: 10px;
  border: 1px solid #777777;
}

#commentSection h4{
  margin: 0;
  text-align: left;
  padding-left: 10px;

}
#line{
  width: 100%;
  margin-top:5px;
  height: 2px;
  background: #000000;
  margin-bottom: 5px;
}

#messagecontainer{
  width: 100%;
  height: 320px;
  margin-bottom: 5px;
  border: 1px solid #000000;
  overflow: auto;
}
#messagesubmit{
  width: 100%;
  height: 75px;
  padding:10px;
  border: 1px solid #000000;
  border-radius: 0px 0px 10px 10px;
}
#messagesubmit .col-md-9{
  padding: 0;
}
#messagesubmit .col-md-3{
  padding-right: 0;
}

button#btnSubmit {
    width: 100%;
    height: 100%;
    background: #3d2c7d;
    text-transform: uppercase;
    border: 2px solid #3d2c7d;
    transition: all 0.5s ease;
}

button#btnSubmit:hover{
  background: #f7f7f7;
  color:#3d2c7d;
}

.messageDiv h6{
  font-size: 16px;
  margin-top:5px;
}
.messageDiv .col-md-4{
  margin-top:5px;
}

.messageSecondRow{
  border-bottom: 2px solid #000000;
}
.borderGray{
  border:2px solid #efefef;
}

.secondRowColumn h3{
  text-align: left;
  font-size: 16px;
}
</style>

<?php
mysql_close($dbh);
$dbh2->close();
?>
