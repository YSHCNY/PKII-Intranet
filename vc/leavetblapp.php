<?php






  $res2query=""; $result2=""; $found2=0;
          $res2query="SELECT ManagerApproverID FROM tblManagerApproverOTLeave WHERE ManagerApproverID='$employeeid0'";
          $result2=$dbh->query($res2query);
          if($result2->num_rows>0) {
            while($myrow2=$result2->fetch_assoc()) {
            $found2=1;
            $iditsupportapprover=$myrow2['iditsupportapprover'];
            } // while
          } // if
          // if($myrow['approverid'] == $employeeid0) {
          if($found2==1) {


          while($myrow = $result1->fetch_assoc()) {
            $try = strtotime($myrow['durationto']) - strtotime($myrow['durationfrom']);
            $days = $try/60/60/24;
            $lvir = $myrow['idhrtalvreq'];
            // $status = ($myrow['statusta'] == 0 ? 'Pending' : 'Approved');
            if($myrow['statusta'] == 0){
              $status = 'Pending'; $statclr='text-dark';
            }elseif($myrow['statusta'] == 1){
              $status = 'Approved'; $statclr='text-success';
            }
            elseif($myrow['statusta'] == 2){
              $status = 'Disapproved'; $statclr='text-danger';
            }
            elseif($myrow['statusta'] == 3){
              $status = 'Noted'; $statclr='text-success';
            }
            $btn = '';
            if($status == 'Pending'){
                $btn = "<button class='btn btn-success text-white btn-approve' data-id='".$myrow['tblhrtalvreq'].">Approve</button>";
                $btn .= "<button class='btn btn-danger text-white btn-disapprove' data-id='".$myrow['tblhrtalvreq'].">Disapprove</button>";
            }

            echo "<tr class = 'text-center'>";
            // echo "<td><input type = 'checkbox' name = 'checkbox_value[]' value = '".$myrow['idhrtalvreq']."'></td>";
            echo "<td class = 'fw-semibold'>".$myrow['datecreated']."</td>";
            echo "<td>".$myrow['employee_id']."</td>";
            echo "<td>".$myrow['name_first']." ".$myrow['name_last']."</td>";
            echo "<td>".date('F d, Y - h:i A', strtotime($myrow['durationfrom']))."</td>";
            echo "<td>".date('F d, Y - h:i A', strtotime($myrow['durationto']))."</td>";
            // echo "<td>".number_format($days,2)."</td>";
            echo "<td>".$myrow['reason']."</td>";
            echo "<td class='$statclr'>".$status."</td>";
            // echo "<td>".$myrow['approverid']."</td>";
            
            if($myrow['approverid'] == $employeeid0){
              echo "<td><a class='secondarybgc rounded-3 px-3 py-2 border-0 btn-view text-white' href='index.php?lst=1&lid=".$loginid."&sess=".$session."&p=368&lvid=".$myrow['idhrtalvreq']."'>Details</a>".$btn."</td>";
            }
            else{
              echo "<td><a class='secondarybgc rounded-3 px-3 py-2 border-0 btn-view text-white' href='index.php?lst=1&lid=".$loginid."&sess=".$session."&p=368&lvid=".$myrow['idhrtalvreq']."'>Details</a></td>"; 
            }


            echo "</tr>";
          } // if

          }


        
          // $resquery = "SELECT *, tblcontact.employeeid as employee_id FROM tblhrtalvreq LEFT JOIN tblcontact ON tblcontact.employeeid=tblhrtalvreq.employeeid WHERE idhrtalvreq=$lvir";
          // $result = $dbh->query($resquery);
          
          // while($myrow = $result->fetch_assoc()) {
          //     $lvid = $myrow['idhrtalvreq'];
          // }
          // // if($myrow['approverempid']==$employeeid0 && $myrow['statusta']==0) {
          //   // input field
          //   echo "<input type='number' class = 'border rounded-3 bg-white px-3 py-2' size='2' name='daysapproved' id='approveddays' value=\"$daysapproved\">";
          // // }
          
          //            echo "<input type=\"\" name=\"lvrid\" value=\"$id\">";
          //             echo "<input type=\"\" name=\"idhrtalvreq\" value=\"$lvid\">";
          //             echo "<input type=\"\" name=\"apprctr\" value=\"1\">";
          //             echo "<input type=\"\" name=\"statusta\" value=\"1\">";


                      
          ?>
          

