<?php
    include("./addons.php");

    $currentMonth = date('F');
    $birthmonth = $currentMonth;

    $currentDate = date('Y-m-d');
?>

    <style>
        .highlight {
            background-image: repeating-radial-gradient(circle at 0 0, transparent 0, #6e0a0a 40px), repeating-linear-gradient(#56070755, #560707);
            background-color: #6e0a0a !important;
        }
        .highlight #date {
            color: white !important;
        }
        .highlight #name {
            color: white !important;
        }
    </style>

    <div class="bg-white">
        <div class="">
            <p class="text-muted fs-4 "><span class='fw-bold'><?php echo "$birthmonth"; ?></span> Birthday Celebrants</p>
        </div>
        <?php
            // $res011query = "SELECT tblemployee.emp_birthdate, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE MONTH(tblemployee.emp_birthdate) = MONTH(CURDATE()) AND tblemployee.emp_record='active' AND tblemployee.employee_type='employee' ORDER BY DATE_FORMAT(tblemployee.emp_birthdate, '%m-%d')";
			$res011query = "SELECT tblemployee.emp_birthdate, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.picfn, tblemployee.employee_type FROM tblemployee LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE (DATE(CONCAT(YEAR(CURDATE()), RIGHT(tblemployee.emp_birthdate, 6))) BETWEEN DATE_SUB(CURDATE(), INTERVAL 0 DAY) AND DATE_ADD(CURDATE(), INTERVAL 15 DAY)) AND tblemployee.emp_record='active' AND (tblemployee.employee_type='employee' OR tblemployee.employee_type='consultant') ORDER BY DATE_FORMAT(tblemployee.emp_birthdate, '%m-%d') ASC, tblcontact.name_last ASC";
            $result011 = $dbh2->query($res011query);
            if ($result011->num_rows > 0) {
                while ($myrow011 = $result011->fetch_assoc()) {
                    $birthdate011 = $myrow011['emp_birthdate'];
                    $employeeid011 = $myrow011['employeeid'];
                    $name_last011 = $myrow011['name_last'];
                    $name_first011 = $myrow011['name_first'];
					
					$employee_type011 = $myrow011['employee_type'];

                    $isToday = (date("m-d", strtotime($birthdate011)) == date("m-d", strtotime($currentDate)));

                    if (date("m-d", strtotime($birthdate011)) >= date("m-d", strtotime($currentDate))) {
                        $day_of_birthdate011 = date("d", strtotime($birthdate011));
                        $current_year = date("Y");
                        $formatted_birthdate = date_create_from_format("Y-m-d", "$current_year-".date("m-d", strtotime($birthdate011)));
                        $day_of_week_for_birthdate011 = $formatted_birthdate->format('D');
                        $final_date = date("M d", strtotime($birthdate011)) . " ($day_of_week_for_birthdate011)";

                        $highlightClass = $isToday ? 'highlight' : '';
                        ?>
                  
                            <div class="border px-3 pt-4 pb-3 rounded-4 mb-3  <?php echo $highlightClass; ?>">
							<div class=" mt-0 ">
                                <div class="text-center"> 
                                    <p id="name" class='fs-4 text-primary fw-bold '><?php echo "$name_first011 $name_last011"; ?></p> 
                                    <p id="date" class='fs-4 '><?php echo "&nbsp;-&nbsp;".$final_date; ?>
									<?php if($employee_type011=='consultant') { echo "<br>(".$employee_type011.")"; } ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
					// var_dump($birthdate011,$currentDate);
                }
// var_dump($result011);
            } else {
                ?>
                <div id="content" class="d-flex justify-content-center align-items-center ">
                    <p class="text-danger fs-4 fw-medium  m-0 py-1">No Upcoming Birthdays</p>
                </div>
                <?php
// var_dump($result011);
            }
        ?>
    </div>
    
