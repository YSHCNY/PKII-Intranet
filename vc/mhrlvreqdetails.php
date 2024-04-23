<?php
//
// mhrotlvfrm.php
// fr: vc/index.php
// indexlinks: $page==364

require_once '../includes/config.inc';
require '../includes/dbh.php';
require 'addons.php';

$resquery2 = "SELECT * from tbllogin LEFT JOIN tblcontact ON tblcontact.employeeid=tbllogin.employeeid WHERE tbllogin.loginid=".$loginid;
$result2 = $dbh->query($resquery2);

while($myrow2 = $result2->fetch_assoc()) {
  echo "<input type='hidden' id='fullname' value='".$myrow2['name_first'].' '. $myrow2['name_last']."' />";
}

      $leavetype = '';

$id = $_GET['lvid'];
$resquery = "SELECT *, tblcontact.employeeid as employee_id FROM tblhrtalvreq LEFT JOIN tblcontact ON tblcontact.employeeid=tblhrtalvreq.employeeid WHERE idhrtalvreq=".$id;
$result = $dbh->query($resquery);
// echo "<input type='hidden' id='lvreqid' value='".$id."' />";
?>
  <!-- <div class="row">
		<div class="col-md-12"><h3>Leave ID: <span id="lvreqid"><?php echo $id; ?></span> </h3></div>
	</div> -->

	<div class="container pt-5">
		<div class="border shadow rounded-3 p-5 my-5">
    <?php echo "<a href='./index.php?lst=1&lid=$loginid&sess=$session&p=36&ps=ot' class='btn mb-5 btn-default'>back</a>"; ?></button>
      <p class = 'fw-bold text-center  fs-3'>Leave Details <span id="lvreqid" class = 'hidden'><?php  echo $id; ?></span></p>
     

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
            } // if-else
            $btn = '';
            if($status == 'Pending'){
							if($myrow['approverempid']==$employeeid0) {
                // $btnappr = "<button class='btn btn-success btn-approve' data-id='".$myrow['idhrtalvreq']."' style='margin-right:5px;'>Approve</button>";
                $btnappr = "<button class='bg-success px-4 py-3 rounded-3 text-white border-0 my-2'>Approve</button>";
                // $btndisappr = "<button class='btn btn-danger btn-disapprove' data-id='".$myrow['idhrtalvreq']."' style='margin-right:5px;'>Disapprove</button>";
                $btndisappr = "<button class='bg-danger px-4 py-3 rounded-3 text-white border-0 my-2' >Disapprove</button>";
							} // if
							if($myrow['employeeid']==$employeeid0) {
                
								$btnreq = "<button class='secondarybgc text-white rounded-3 px-3 py-2 border-0' data-id='".$myrow['idhrtalvreq']."' style='margin-right:5px;'>Re-request for Approval</button>";
							} // if
							// note: notedby button is accessible in admin pages
							/* if($myrow['notedbyempid']==$employeeid0) {
								$btnnote = "<button class='btn btn-success btn-approve' data-id='".$myrow['idhrtalvreq']."' style='margin-right:5px;'>Noted</button>";
							} // if */
            }

            $resquery21 = "SELECT * from tblhrtaleavectg where idhrtaleavectg = ". $myrow['idhrtaleavectg'];
            $result21 = $dbh->query($resquery21);

            while($myrow21 = $result21->fetch_assoc()) {
              $leavetype = $myrow21['name'];
            }   


         
            echo "
            <div class = 'row mt-5 mb-4 '>

            <div class = 'col-lg-4'>
            <p class = 'fs-6 text-center mb-0 text-muted'>Employee Name: </p>
            <p class = 'fs-4 text-center maintext'>".$myrow['name_first']." ".$myrow['name_last']." (".$myrow['employee_id'].")</span>
            </div>

            <div class = 'col-lg-4 '>
            <p class = 'fs-6 text-center mb-0  text-muted' >Date Requested: </p>
            <p class = 'fs-4 text-center  maintext' >".date('F d, Y', strtotime($myrow['datecreated']))."</p>
             </div>
           
            
             <div class = 'col-lg-4'>
             <p class = 'fs-6 text-center mb-0 text-muted'>Leave Type: </p>
             <p class = 'fs-4 text-center maintext' >".$leavetype."</p>
             </div>

             </div>
             ";
           
            
            
            

            

         
            echo "
            <div class = ' my-4'>
            <p class = 'fs-6 mb-0 text-muted'>Duration: </p>
            <p class = 'fs-4 maintext'>".date('F d, Y', strtotime($myrow['durationfrom']))." - ".date('F d, Y', strtotime($myrow['durationto'])). "</p>
            </div>";


            echo "<form action='index.php?lst=1&lid=$loginid&sess=$session&p=369' method='POST' name='mhrlvfrmreq3'>";
            echo "<input type=\"hidden\" name=\"lvrid\" value=\"$id\">";


            echo "<p class = 'fs-6 mb-0 text-muted'>No. of days approved: </p>";
            // echo "<td colspan = '1'>".number_format($hrs,1)."</td>";
            if($myrow['approverempid']==$employeeid0 && $myrow['statusta']==0) {
              // input field
              echo "<input type='number' class = 'border rounded-3 bg-white px-3 py-2' size='2' name='daysapproved' id='approveddays' value=\"$daysapproved\">";
            } else {
              echo "<p>".$myrow['daysapproved']."</p>";
            } // if-else
         

         

            echo "
            <div class = ' my-4'>
            <p class = 'fs-6 mb-0 text-muted'>Reason for Overtime: </p>
            <p class = 'fs-4 maintext'>".$myrow['reason']."</p>
            </div>";
           

            $found1=0; $resquery1=""; $result1="";
            $resquery1 = "SELECT * from tblcontact WHERE employeeid='".$myrow['approverempid']."'";
            $result1 = $dbh->query($resquery1);
            while($myrow1 = $result1->fetch_assoc()) {
              $found1=1;
           
              echo "
              <div class = ' my-4'>
              <p class = 'fs-6 mb-0 text-muted'>Status: </p>
              <p class='$statclr fs-4'><strong>".$status."</strong></p>
              </div>
              ";


              // echo "<td colspan = '2'>".$myrow['statusta']."</td>";
              echo "
              <div class = ' my-4'>
              <p class = 'fs-6 mb-0 text-muted'>Approver: </p>
              <p class = 'fs-4 maintext'>".$myrow1['name_first']." ".$myrow1['name_last']."</p>
              </div>
              ";
           
            }
    // echo "<tr><td>f1:$found1, stat:$status, appr:$myrow1 $myrow1</td></tr>";
    echo "<div class = 'text-end'>";
					if($myrow['employeeid']==$employeeid0 && $myrow['approverempid']!=$employeeid0) {
						// echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=367\" method=\"POST\" name=\"mhrotfrmreq3\">";
            if($status!='Pending') {
						echo "<input type=\"hidden\" name=\"idhrtalvreq\" value=\"".$myrow['idhrtalvreq']."\">";
						echo "<input type=\"hidden\" name=\"reqctr\" value=\"1\">";
						echo "$btnreq";
            } // if($status!='Pending')
						// echo "</form>";
					} // if
					if($myrow['approverempid']==$employeeid0) {
            if($myrow['statusta']==0) {
						
						// echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=367\" method=\"POST\" name=\"mhrotfrmreq3\">";
						echo "<input type=\"hidden\" name=\"idhrtalvreq\" value=\"".$myrow['idhrtalvreq']."\">";
						echo "<input type=\"hidden\" name=\"apprctr\" value=\"1\">";
						echo "<input type=\"hidden\" name=\"statusta\" value=\"1\">";
						echo "$btnappr";
						echo "</form>";
				
						echo "<form action='index.php?lst=1&lid=$loginid&sess=$session&p=369' method='POST' name='mhrlvfrmreq3'>";
            echo "<input type=\"hidden\" name=\"lvrid\" value=\"$id\">";
						echo "<input type=\"hidden\" name=\"idhrtalvreq\" value=\"".$myrow['idhrtalvreq']."\">";
						echo "<input type=\"hidden\" name=\"apprctr\" value=\"1\">";
						echo "<input type=\"hidden\" name=\"statusta\" value=\"2\">";
						echo "$btndisappr";
					
            } // if
					} // if
          echo "</div>";
					// note: notedby button is accessible in admin pages
					/* if($myrow['notedbyempid']==$employeeid0) {
						echo "<form action=\"\" method=\"\" name=\"\">";
						echo "<tr><td colspan='4'></td><td colspan='2'>$btnnote</td></tr>";
						echo "</form>";
					} // if */
            
        ?>
   

        <div class = 'p-4 border my-5 rounded-3'>
        <p class = 'fs-4 fw-bold maintext'>Comments and Remarks</p>
       
          <div id="messagecontainer">
            <div id="messageDiv" class="">
              <?php 

                echo $myrow['comments'];
              ?>
            </div>
          </div>
          <div class = 'py-5'>
            <div class="col-md-9">
              <textarea placeholder="Comment Here...." id="commentTextArea" class="form-control"></textarea>
            </div>
            <div class="col-md-3 mt-5">
              <button type="button" id="btnSubmit" class="btn btn-success">Submit</button>
            </div>
          </div>
        </div>

        <?php 

          }

        ?>

    </div>
	</div> <!-- div class=row -->

  <div class="">
    <div class="">
   
    </div>
  </div> <!-- div class=row -->

<script>
$(document).ready(function(){
  $('#btnSubmit').on('click',function(){
      var id = $('#lvreqid').text();
      var fullname = $('#fullname').val();
      var messageDivHtml = $('#messageDiv').html();
      var newMessageDivHtml = '<div class="messageItem">';
      newMessageDivHtml += '<div class="messageFirstRow">';

      newMessageDivHtml += '<div class="px-4">';
      newMessageDivHtml += '<p class = "fs-5 maintext mb-0 fw-bold">'+fullname+'</p>';
      newMessageDivHtml += '<p class = "fs-6 mt-0 text-muted">'+new Date().toLocaleString()+'</p>';
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


   $('body').delegate('.btn-approve','click',function(){
                var id = $(this).data('id');
                swal({   
                    title: "Are you sure?", 
                    text: "You want to approve this request.",   
                    type: "info",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes!",   
                    closeOnConfirm: false }, 
                    function(){
                          $.ajax({
                            url : 'tjfunctions/approvelvrequest.php',
                            type : 'POST',
                            data : {id: id},
                            success : function(data){
                            swal("Approved!", "Your request has been approved.", "success"); 
                            loadDatatable();
                            location.reload();
                            }
                        }); 
                    }
                );
            });


            $('body').delegate('.btn-disapprove','click',function(){
                var id = $(this).data('id');
                swal({   
                    title: "Are you sure?", 
                    text: "You want to disapprove this request.",   
                    type: "info",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes!",   
                    closeOnConfirm: false }, 
                    function(){
                          $.ajax({
                            url : 'tjfunctions/disapprovelvrequest.php',
                            type : 'POST',
                            data : {id: id},
                            success : function(data){
                            swal("Cancelled!", "Your request has been disapproved.", "success"); 
                            loadDatatable();
                            location.reload();
                            }
                        }); 
                    }
                );
            });


             $('body').delegate('.btn-request','click',function(){
                var id = $(this).data('id');
                var buttonRequest = $(this);
                swal({   
                    title: "Are you sure?", 
                    text: "You want to request again.",   
                    type: "info",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes!",   
                    closeOnConfirm: false }, 
                    function(){
                        swal("Success!", "Your request has been sent.", "success"); 
                        buttonRequest.prop('disabled', true);
                        location.reload();
                    }
                );
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
  padding: 10px;
  border-radius: 5px;

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
  border-bottom: 1px solid #777777;
  margin-bottom: 1rem;
}
.borderGray{
  border:2px solid #efefef;
}

.secondRowColumn h3{
  text-align: left;
  font-size: 16px;
}
</style>
