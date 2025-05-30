<?php
//
// 20191023
// mngotreqdtl.php
// fr mngotrequest.php
//
include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$id0 = (isset($_GET['otid'])) ? $_GET['otid'] :'';
$id = (isset($_POST['otid'])) ? $_POST['otid'] :'';
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
	
    $resquery = "SELECT *, tblcontact.employeeid as employee_id from tblhrtaotreq LEFT JOIN tblcontact ON tblcontact.employeeid=tblhrtaotreq.employeeid WHERE idhrtaotreq=".$id."";
	$result = $dbh2->query($resquery);

?>
    <div class='mainContainer'>
	<div class='container-fluid'>
    <div class="row">
		<div class="col-md-12">
      <h4 style="text-align: left">Overtime Details id: <span id="otreqid"><?php echo $id; ?></span></h4>
      <table class='table table-bordered dt-responsive nowrap no-footer dtr-inline collapsed dataTable'>
        <?php 
        while($myrow = $result->fetch_assoc()) {
            $try = strtotime($myrow['durationto']) - strtotime($myrow['durationfrom']);
            $hrs = $try/60/60;
            $status = ($myrow['statusta'] == 0 ? 'Pending' : 'Approved');
            $btn = '';
            if($status == 'Pending'){
							if($myrow['approverempid']==$employeeid0) {
                $btnappr = "<button class='btn btn-success btn-approve' data-id='".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Approve</button>";
                // $btnappr = "<button class='btn btn-success' data-toggle='modal' data-target='#modalApprove' data-id='".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Approve</button>";
                $btndisappr = "<button class='btn btn-danger btn-disapprove' data-id='".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Disapprove</button>";
							} // if
							if($myrow['employeeid']==$employeeid0) {
								// $btnreq = "<button class='btn btn-primary btn-request' data-id='".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Re-request for Approval</button>";
                $btnreq = "<strong>Status: Pending for Approval</strong>";
							} // if
							// note: notedby button is accessible in admin pages
							/* if($myrow['notedbyempid']==$employeeid0) {
								$btnnote = "<button class='btn btn-success btn-approve' data-id='".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Noted</button>";
							} // if */
            }

            echo "<tr>";
            echo "<th colspan = '2'>Date Requested: </th>";
            echo "<td colspan = '1'>".date('F d, Y', strtotime($myrow['datecreated']))."</td>";
            echo "<th colspan = '2'>Date of Overtime: </th>";
            echo "<td colspan = '1'>".date('F d, Y', strtotime($myrow['dateotreq']))."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th colspan = '1'>Employee Name: </th>";
            echo "<td colspan = '3'>".$myrow['name_first']." ".$myrow['name_last']."</span></td>";
            echo "<th colspan = '1'> EmployeeID: </th>";
            echo "<td colspan = '1'>".$myrow['employee_id']."</td>";
            echo "</tr>";


            echo "<tr>";
            echo "<th colspan = '1'>Duration From: </th>";
            echo "<td colspan = '1'>".date('h:i A', strtotime($myrow['durationfrom']))."</td>";
            echo "<th colspan = '1'>Duration To</th>";
            echo "<td colspan = '1'>".date('h:i A', strtotime($myrow['durationto']))."</td>";
            echo "<th colspan = '1'>Total Hrs: </th>";
            echo "<td colspan = '1'>".number_format($hrs,2)."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th colspan = '2'>Reason for Overtime: </th>";
            echo "<td colspan = '4'>".$myrow['reason']."</td>";
            echo "</tr>";

					/* if($myrow['employeeid']==$employeeid0 && $myrow['approverempid']!=$employeeid0) {
						// echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=363\" method=\"POST\" name=\"mhrotfrmreq3\">";
						echo "<input type=\"hidden\" name=\"idhrtaotreq\" value=\"".$myrow['idhrtaotreq']."\">";
						echo "<input type=\"hidden\" name=\"reqctr\" value=\"1\">";
						echo "<tr><td colspan='4'></td><td colspan='2'style='text-align: center;'>$btnreq</td></tr>";
						// echo "</form>";
					} // if
					if($myrow['approverempid']==$employeeid0) {
						echo "<tr><td colspan='4'></td><td style='text-align: center;'>";
						// echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=363\" method=\"POST\" name=\"mhrotfrmreq3\">";
						echo "<input type=\"hidden\" name=\"idhrtaotreq\" value=\"".$myrow['idhrtaotreq']."\">";
						echo "<input type=\"hidden\" name=\"apprctr\" value=\"1\">";
						echo "$btnappr";
						// echo "</form>";
						echo "</td><td style='text-align: center;'>";
						// echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=363\" method=\"POST\" name=\"mhrotfrmreq3\">";
						echo "<input type=\"hidden\" name=\"idhrtaotreq\" value=\"".$myrow['idhrtaotreq']."\">";
						echo "<input type=\"hidden\" name=\"apprctr\" value=\"-1\">";
						echo "$btndisappr";
						// echo "</form>";
						echo "</td></tr>";
					} // if */

          // this->row for admin users
          if($myrow['statusta']==0) {
              $statustxt="Pending for Approval"; $statclr="text-dark";
          } else if($myrow['statusta']==1) {
              $statustxt="Approved"; $statclr="text-success";
          } else if($myrow['statusta']==2) {
              $statustxt="Disapproved"; $statclr="text-danger";
          } else if($myrow['statusta']==3) {
              $statustxt="Approved and Noted"; $statclr="text-success";
          }// if-else
          if($myrow['statusta']!='') {
              echo "<tr><td colspan='4'></td><th>Status: </th><td class='$statclr'><strong>$statustxt</strong></td></tr>";
          } // if

					// note: notedby button is accessible in admin pages
					/* if($myrow['notedbyempid']==$employeeid0) {
						echo "<form action=\"\" method=\"\" name=\"\">";
						echo "<tr><td colspan='4'></td><td colspan='2'>$btnnote</td></tr>";
						echo "</form>";
					} // if */

            $result1=0; $resquery1=""; $result1="";
            $resquery1 = "SELECT * from tblcontact WHERE employeeid='".$myrow['approverid']."'";
            $result1 = $dbh2->query($resquery1);
            while($myrow1 = $result1->fetch_assoc()) {
              $result1=1;
              echo "<tr>";
              echo "<th colspan = '2'>Status: </th>";
              echo "<td colspan = '1'>".$status."</td>";
              echo "<th colspan = '2'>Approver: </th>";
              echo "<td colspan = '1'>".$myrow1['name_first']." ".$myrow1['name_last']."</td>";
              echo "</tr>";
            }
            
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
<?php
                echo "<form action=\"./tjfunctions/updateMessage.php?loginid=$loginid\" method=\"POST\" name=\"updateMessage\">";
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
    </div>
    </div>
	
<?php 
  echo "<p><a href='mngotrequest.php?loginid=$loginid&rt=ot' class='btn btn-secondary'>Back</a></p>";
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
                            url : 'tjfunctions/updateMessage.php',
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
