<div class="text-center">
<div class="modal fade thisapp" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pinModalLabel">Enter Approval Code</h5>
                 
                </div>
                <div class="modal-body">
                <p>This Leave Request will be <span class = 'fw-semibold text-success'>APPROVED</span></p>

                    <input type="password" id="pinInput" class="form-control" placeholder="Enter PIN">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-white primary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn bg-success text-white" onclick="verifyPin()">Approve</button>
                </div>
            </div>
        </div>
    </div>
    </div>







    <div class="text-center">
<div class="modal fade  thismods" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pinModalLabel">Enter Dissapproval Code</h5>

                </div>
                <div class="modal-body">
                  <p>This Leave Request will be <span class = 'fw-semibold text-danger'>DISAPPROVED</span></p>
                    <input type="password" id="pinInputDiss" class="form-control" placeholder="Enter PIN">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-white primary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn bg-danger text-white" onclick="verifyDissPin()">Disapprove</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    
 
<?php
//
// mhrotlvfrm.php
// fr: vc/index.php
// indexlinks: $page==364

require_once '../includes/config.inc';
require '../includes/dbh.php';
require 'addons.php';



  $result = "SELECT * FROM tblManagerApproverOTLeave WHERE ManagerApproverID = '$employeeid0 'LIMIT 1";
$result = $dbh->query($result);
$value1 = '';
$value2 = '';

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $value1 = $row['apprpin']; 
    $value2 = $row['apprpin']; // Replace 'value_column' with your actual column name

}


$resquery2 = "SELECT * from tbllogin LEFT JOIN tblcontact ON tblcontact.employeeid=tbllogin.employeeid WHERE tbllogin.loginid=".$loginid;
$result2 = $dbh->query($resquery2);

while($myrow2 = $result2->fetch_assoc()) {
 
  echo "<input type='hidden' id='fullname' value='".$myrow2['name_first'].' '. $myrow2['name_last']."' />";
}

      $leavetype = '';

$id = $_GET['lvid'];
$resquery = "SELECT *, tblcontact.employeeid as employee_id FROM tblhrtalvreq LEFT JOIN tblcontact ON tblcontact.employeeid=tblhrtalvreq.employeeid WHERE idhrtalvreq=".$id;
$result = $dbh->query($resquery);



?>
  <!-- <div class="row">
		<div class="col-md-12"><h3>Leave ID: <span id="lvreqid"><?php echo $id; ?></span> </h3></div>
	</div> -->

	<div class="container pt-5">
		<div class="border shadow rounded-3 p-5 my-5">
    <?php echo "<a href='./index.php?lst=1&lid=$loginid&sess=$session&p=36&ps=ot' class='btn mb-5 btn-default'>back</a>"; ?></button>
      <p class = 'fw-bold text-center <?php echo $maintext?> fs-3'>Leave Details <span id="lvreqid" class = 'hidden'><?php  echo $id; ?></span></p>
     


    <div class="">
      <table class = 'table table-hover table-bordered <?php echo $tableinfo?> table-sm'>


        <tbody>
       

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
                $btnappr = "<button id = 'myButton' class='bg-success px-4 py-3 rounded-3 text-white border-0 my-2' data-toggle='modal' type = 'button' data-target='.thisapp'>Approve</button>";
                // $btndisappr = "<button class='btn btn-danger btn-disapprove' data-id='".$myrow['idhrtalvreq']."' style='margin-right:5px;'>Disapprove</button>";
                $btndisappr = "<button id = 'myButton' class='bg-danger px-4 py-3 rounded-3 text-white border-0 my-2' data-toggle='modal' type = 'button' data-target='.thismods'>Disapprove</button>";
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
              $leaveid = $myrow21['idhrtaleavectg'];
              $lcode = $myrow21['code'];

            }   
           


        
           
      
// echo "<h1>$leaveid</h1>";
echo "<tr>";
            echo "
            <td class = 'fw-semibold text-end $subtext'>Employee Name</td>
            <td>".$myrow['name_first']." ".$myrow['name_last']." (".$myrow['employee_id'].")</td>
            
            </tr>

            <tr>
              <td class = 'fw-semibold text-end $subtext'>Date of request</td>
              <td>".date('F d, Y', strtotime($myrow['datecreated']))."</td>
            </tr>


            <tr>
              <td class = 'fw-semibold text-end $subtext'>Leave Type</td>
              <td>".$leavetype."</td>
             </tr>";

             $startoo = date('Y-m-d', strtotime($myrow['durationfrom']));
             $endto = date('Y-m-d', strtotime($myrow['durationto']));

             echo "<form action='index.php?lst=1&lid=$loginid&sess=$session&p=369' id='myForm' method='POST' name='mhrlvfrmreq3'>";
           ?>
                 
            <tr>
            <td class = 'fw-semibold text-end <?php echo $subtext?> '>Duration</td>
            <td>  
            <div class = 'row'>
            <div class = 'col'>
             <input id = 'leavedates' type='date' name='leavedate' value='<?php echo $startoo ?>' required class='form-control <?php echo "$mainbg $maintext"?>' onchange="countWeekdays()">
            </div>
            -

            <div class = 'col'>
            <input id = 'endleaves' type='date' name='endleave' value='<?php echo  $endto ?>' required class='form-control <?php echo "$mainbg $maintext"?>' onchange="countWeekdays()">
            </div>
            </div>
                        <p class = 'text-warning my-2 ' id='dateText'></p>

            </td>
            </tr>

            <?php

    
            echo "<input type=\"hidden\" name=\"lvrid\" value=\"$id\">";


             echo "<input type = 'hidden' name = 'lcode' value = '$lcode'>";
             echo "<input type = 'hidden' id = 'leavetypeval' name = 'leaveid' value = '$leaveid'>";
             echo "<input type = 'hidden' name = 'requestorid' value= '".$myrow['employee_id']."'>";

            echo "
            <tr>
            <td class = 'fw-semibold text-end $subtext'>Total number of days</td>
            <td>
           
";
            // echo "<td colspan = '1'>".number_format($hrs,1)."</td>";
            if($myrow['approverempid']==$employeeid0 && $myrow['statusta']==0) {
              // input field
              echo "<input type='text' class = 'border-0 rounded-3 $mainbg $maintext px-3 py-2' size='2' name='daysapproved' id='leavedur' readonly value=\"$daysapproved\">";
            } else {
              echo "<p>".$myrow['daysapproved']."</p>  <input type='hidden' class = 'border-0 rounded-3 $mainbg $maintext px-3 py-2' size='2' name='daysapproved' id='leavedur' readonly value=\"$daysapproved\"> </td></tr>";
            } // if-else
         

         

            echo "
            <tr>
            <td class = 'fw-semibold text-end $subtext'>Reason for Overtime</td>
            <td>".$myrow['reason']."</td>
            </tr>";
           

            $found1=0; $resquery1=""; $result1="";
            $resquery1 = "SELECT * from tblcontact WHERE employeeid='".$myrow['approverempid']."'";
            $result1 = $dbh->query($resquery1);
            while($myrow1 = $result1->fetch_assoc()) {
              $found1=1;
           
              echo "
              <tr>
              <td class = 'fw-semibold text-end $subtext'>Status</td>
              <td class='$statclr'><strong>".$status."</strong></td>
              </tr>
              ";


              // echo "<td colspan = '2'>".$myrow['statusta']."</td>";
              echo "
              <tr class = ' my-4'>
              <td class = 'fw-semibold text-end $subtext'>Approver</td>
              <td>".$myrow1['name_first']." ".$myrow1['name_last']."</td>
              </tr>
              ";
           
            }
    // echo "<tr><td>f1:$found1, stat:$status, appr:$myrow1 $myrow1</td></tr>";
    echo "<tr class = 'text-end $subtext'>";
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
            echo "<td class = 'fw-semibold text-end $subtext'>Action</td>";
            
						echo "<td><input type=\"hidden\" name=\"idhrtalvreq\" value=\"".$myrow['idhrtalvreq']."\">";
						echo "<input type=\"hidden\" name=\"apprctr\" value=\"1\">";
						echo "<input type=\"hidden\" name=\"statusta\" value=\"1\">";
						echo "$btnappr";
						echo "</form>";
				
						echo "<form action='index.php?lst=1&lid=$loginid&sess=$session&p=369' id='DissapproveForm' method='POST' name='mhrlvfrmreq3'>";
            echo "<input type=\"hidden\" name=\"lvrid\" value=\"$id\">";
						echo "<input type=\"hidden\" name=\"idhrtalvreq\" value=\"".$myrow['idhrtalvreq']."\">";
						echo "<input type=\"hidden\" name=\"apprctr\" value=\"1\">";
						echo "<input type=\"hidden\" name=\"statusta\" value=\"2\">";
						echo "$btndisappr</td>";
					
            } // if
					} // if
      
					// note: notedby button is accessible in admin pages
					/* if($myrow['notedbyempid']==$employeeid0) {
						echo "<form action=\"\" method=\"\" name=\"\">";
						echo "<tr><td colspan='4'></td><td colspan='2'>$btnnote</td></tr>";
						echo "</form>";
					} // if */
            
        ?>
   </tr>
   </tbody>
   </table>
       
        <p class = '<?php echo $subtext?>'>Comments and Remarks</p>
  
          <div id="messagecontainer" class = 'border <?php echo "$maing $subtext"?>'>
            <div id="messageDiv" class="<?php echo $subtext?>">
              <?php 

                echo $myrow['comments'];
              ?>
            </div>
          </div>

         
            <div class="mt-2">
              <textarea placeholder="Comment Here...." id="commentTextArea" class='<?php echo "$maintext $mainbg"?> border form-control'></textarea>
              </div>
              <div class="mt-2 text-end $subtext">
              <button type="button" id="btnSubmit" class="btn text-white bg-success">Submit</button>
              </div>

          </div>
    

        <?php 

          }

        ?>


    
      </div>

    </div>
	</div> <!-- div class=row -->

  <div class="">
    <div class="">
   
    </div>
  </div>
  <script>
   // Get the hidden input element
   const selectedValueElement = document.getElementById('leavetypeval');
    let dayValue;
    let fixt;

    // Parse the value from the hidden input
    const leaveTypeValue = parseInt(selectedValueElement.value);

    if (leaveTypeValue === 17 || leaveTypeValue === 18) {
        dayValue = 0.5; // Half day
        fixt = 2;
    } else {
        dayValue = 1; // Full day
        fixt = 1;
    }

    function countWeekdays() {
        const startDate = new Date(document.getElementById('leavedates').value);
        const endDate = new Date(document.getElementById('endleaves').value);
        console.log(startDate, endDate);

        let count = 0;

        const button = document.getElementById('myButton');
        const p = document.getElementById('dateText');

        // Check if the end date is earlier than the start date
        if (startDate && endDate && new Date(endDate) < new Date(startDate)) {
            button.disabled = true;
            p.textContent = 'End date earlier than start...';
        } else {
            button.disabled = false;
            p.textContent = '';
        }

        console.log(leaveTypeValue, dayValue);

        // Ensure startDate is before endDate
        if (startDate > endDate || isNaN(startDate) || isNaN(endDate)) {
            document.getElementById('leavedur').value = '';
            return;
        }

        // Loop through the dates
        for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
            const day = d.getDay();
            // Count only Monday to Friday (1-5)
            if (day !== 0 && day !== 6) {
                count += dayValue;
            }
        }

        // Display the count in the input field
        document.getElementById('leavedur').value = count.toFixed(1);
    }
  </script>
  <script>
       function verifyPin() {
    const pin = document.getElementById('pinInput').value;

    // Send the entered PIN to the server for validation
    fetch('verify_pin.php', {
        method: 'POST',
        body: JSON.stringify({ pin: pin, storedHash: '<?php echo $value1 ?>' }), // Sending entered PIN and stored hash to PHP
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json()) // Parsing the response
    .then(data => {
        if (data.valid) { // Check if PIN is correct
            alert('PIN is correct! Proceeding...');
            document.getElementById('myForm').submit(); // Submit the form on successful verification
        } else {
            alert('Incorrect PIN. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while verifying the PIN.');
    });
}




function verifyDissPin() {
    const pin = document.getElementById('pinInputDiss').value;

    fetch('verify_pin.php', {
        method: 'POST',
        body: JSON.stringify({ pin: pin, storedHash: '<?php echo $value1 ?>' }), // Sending entered PIN and stored hash to PHP
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json()) // Parsing the response
    .then(data => {
        if (data.valid) { // Check if PIN is correct
            alert('PIN is correct! Proceeding...');
            document.getElementById('DissapproveForm').submit(); // Submit the form on successful verification
        } else {
            alert('Incorrect PIN. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while verifying the PIN.');
    });
}


 


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

<script>
      
    
</script>