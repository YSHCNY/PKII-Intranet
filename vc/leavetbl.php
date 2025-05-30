<?php while($myrow = $result->fetch_assoc()) {
                $try = strtotime($myrow['durationto']) - strtotime($myrow['durationfrom']);
                $days = $try / 60 / 60 / 24;

                // Status and color class based on status code
                if ($myrow['statusta'] == 0) {
                    $status = 'Pending';
                    $statclr = 'text-dark';
                } elseif ($myrow['statusta'] == 1) {
                    $status = 'Approved';
                    $statclr = 'text-success';
                } elseif ($myrow['statusta'] == 2) {
                    $status = 'Disapproved';
                    $statclr = 'text-danger';
                } elseif ($myrow['statusta'] == 3) {
                    $status = 'Noted';
                    $statclr = 'text-success';
                }

                $btn = '';
                if ($status == 'Pending') {
                    $btn = "<button class='btn btn-success text-white btn-approve' data-id='".$myrow['idhrtalvreq']."'>Approve</button>";
                    $btn .= "<button class='btn btn-danger text-white btn-disapprove' data-id='".$myrow['idhrtalvreq']."'>Disapprove</button>";
                }

                echo "<tr>";
                echo "<td>".$myrow['employee_id']."</td>";
                echo "<td>".$myrow['name_first']." ".$myrow['name_last']."</td>";
                echo "<td>".date('F d, Y - h:i A', strtotime($myrow['durationfrom']))."</td>";
                echo "<td>".date('F d, Y - h:i A', strtotime($myrow['durationto']))."</td>";
                // echo "<td>".number_format($days,2)."</td>";
                echo "<td>".$myrow['reason']."</td>";
                echo "<td class='$statclr'>".$status."</td>";
                // echo "<td>".$myrow['approverid']."</td>";

                if ($myrow['approverid'] == $employeeid0) {
                    echo "<td><a class='secondarybgc rounded-3 px-3 py-2 border-0 btn-view text-white' href='index.php?lst=1&lid=".$loginid."&sess=".$session."&p=368&lvid=".$myrow['idhrtalvreq']."'>Details</a>".$btn."</td>";
                } else {
                    echo "<td><a class='secondarybgc rounded-3 px-3 py-2 border-0 btn-view text-white' href='index.php?lst=1&lid=".$loginid."&sess=".$session."&p=368&lvid=".$myrow['idhrtalvreq']."'>Details</a></td>";
                }

                echo "</tr>"; 
            } ?>