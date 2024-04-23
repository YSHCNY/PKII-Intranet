<?php 

          while($myrow = $result->fetch_assoc()) {
            $try = strtotime($myrow['durationto']) - strtotime($myrow['durationfrom']);
            $hrs = $try/60/60;
            if($myrow['statusta'] == 0){
              $status = 'Pending'; $statclr='text-dark';
            } else if($myrow['statusta'] == 1){
              $status = 'Approved'; $statclr='text-success';
            } else if($myrow['statusta'] == 2){
              $status = 'Disapproved'; $statclr='text-danger';
            } else if($myrow['statusta'] == 3){
              $status = 'Noted'; $statclr='text-success';
            }
            $btn = '';
            if($status == 'Pending'){
                $btn = "<button class='btn btn-success btn-approve text-white' data-id='".$myrow['idhrtaotreq']."' >Approve</button>";
                $btn .= "<button class='btn btn-danger btn-disapprove text-white' data-id='".$myrow['idhrtaotreq']."' >Disapprove</button>";
            }

            echo "<tr>";
            echo "<td>".$myrow['employee_id']."</td>";
            echo "<td>".$myrow['name_first']." ".$myrow['name_last']."</td>";
            echo "<td>".date('F d, Y - h:i A', strtotime($myrow['durationfrom']))."</td>";
            echo "<td>".date('F d, Y - h:i A', strtotime($myrow['durationto']))."</td>";
            echo "<td>".number_format($hrs,2)."</td>";
            echo "<td>".$myrow['reason']."</td>";
            echo "<td class='$statclr'>".$status."</td>";
            // echo "<td>".$myrow['approverid']."</td>";

            if($myrow['approverid'] == $employeeid0){
              echo "<td><a class='secondarybgc rounded-3 px-3 py-2 border-0 btn-view text-white' href='index.php?lst=1&lid=".$loginid."&sess=".$session."&p=364&otid=".$myrow['idhrtaotreq']."'>Details</a>".$btn."</td>";
            }
            else{
              echo "<td><a class='secondarybgc rounded-3 px-3 py-2 border-0 btn-view text-white' href='index.php?lst=1&lid=".$loginid."&sess=".$session."&p=364&otid=".$myrow['idhrtaotreq']."'>Details</a></td>"; 
            }
            echo "</tr>";
            
          }

// echo "<p '>Below list, for approvers only...</p>"; // this->label for devenv only
//           while($myrow = $result1->fetch_assoc()) {
//             $try = strtotime($myrow['durationto']) - strtotime($myrow['durationfrom']);
//             $hrs = $try/60/60;
//             if($myrow['statusta'] == 0){
//               $status = 'Pending'; $statclr='text-dark';
//             } else if($myrow['statusta'] == 1){
//               $status = 'Approved'; $statclr='text-success';
//             } else if($myrow['statusta'] == 2){
//               $status = 'Disapproved'; $statclr='text-danger';
//             } else if($myrow['statusta'] == 3){
//               $status = 'Noted'; $statclr='text-success';
//             }
//             $btn = '';
//             if($status == 'Pending'){
//                 $btn = "<button class='btn btn-success btn-approve' data-id='".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Approve</button>";
//                 $btn .= "<button class='btn btn-danger btn-disapprove' data-id='".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Disapprove</button>";
//             }

//             echo "<tr>";
//             echo "<td>".$myrow['employee_id']."</td>";
//             echo "<td>".$myrow['name_first']." ".$myrow['name_last']."</td>";
//             echo "<td>".date('F d, Y - h:i A', strtotime($myrow['durationfrom']))."</td>";
//             echo "<td>".date('F d, Y - h:i A', strtotime($myrow['durationto']))."</td>";
//             echo "<td>".number_format($hrs,2)."</td>";
//             echo "<td>".$myrow['reason']."</td>";
//             echo "<td class='$statclr'>".$status."</td>";
//             // echo "<td>".$myrow['approverid']."</td>";

//             if($myrow['approverid'] == $employeeid0){
//               echo "<td><a class='btn btn-info btn-view' href='index.php?lst=1&lid=".$loginid."&sess=".$session."&p=364&otid=".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Details</a>".$btn."</td>";
//             }
//             else{
//               echo "<td><a class='btn btn-info btn-view' href='index.php?lst=1&lid=".$loginid."&sess=".$session."&p=364&otid=".$myrow['idhrtaotreq']."' style='margin-right:5px;'>Details</a></td>"; 
//             }
//             echo "</tr>";
//           }
//           ?>