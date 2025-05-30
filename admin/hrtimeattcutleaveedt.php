<?php
include("db1.php");
include("addons.php");

$loginid = isset($_GET['loginid']) ? $_GET['loginid'] : '';
$employeeid = isset($_POST['empid']) ? $_POST['empid'] : '';
$leavetype = isset($_GET['leavetype']) ? $_GET['leavetype'] : '';

$found = 0;

if ($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {
    include("header.php");
    include("sidebar.php");






    // $res14query="SELECT * FROM tblhrtaemptimelog LEFT JOIN tblcontact ON tblhrtaemptimelog.employeeid=tblcontact.employeeid LEFT JOIN tblemployee ON tblemployee.employeeid=tblcontact.employeeid LEFT JOIN tblhrtaempleavesumm ON tblhrtaemptimelog.idpaygroup=tblhrtaempleavesumm.idhrtaempleavesumm LEFT JOIN tblhrtapaygrpemplst ON tblhrtaemptimelog.idpaygroup=tblhrtapaygrpemplst.idtblhrtapaygrp WHERE tblcontact.contact_type=\"personnel\" AND tblcontact.employeeid=\"$employeeid\" LIMIT 1";
	// 	$result14=$dbh2->query($res14query);
	// 	if($result14->num_rows>0) {
	// 		while($myrow14=$result14->fetch_assoc()) {
	// 		$found14=1;
	// 		$name_last14 = $myrow14['name_last'];
	// 		$name_first14 = $myrow14['name_first'];
	// 		$name_middle14 = $myrow14['name_middle'];
	// 		$contact_gender14 = $myrow14['contact_gender'];
	// 		$date_hired14 = $myrow14['date_hired'];
	// 		$restday14 = $myrow14['restday'];
	// 		$vl = $myrow14['vacation'];
	// 		$sl = $myrow14['sick'];
	// 		$pl = $myrow14['paternity'];
	// 		$mc = $myrow14['maternityc'];
	// 		$mn = $myrow14['maternityn'];
	// 		$spl = $myrow14['special'];
	// 		$asl = $myrow14['aspl'];
	// 		} // while
	// 	} // if
?>



<div class="shadow">
    <div class="p-5">
        
        <div class="">
            <h3>Edit Leave Information</h3>
        </div>
        <div class="py-5 mb-5">
            <form action="hrtimeattcutleaveedt2.php?loginid=<?php echo $loginid; ?>" method="POST" class="m-0">
                <div class="">
                <div>
                    <div class="mb-4">
                    
                        <input type="hidden" name="loginid" value="<?php echo htmlspecialchars($loginid); ?>">
                        <input type="hidden" name="idhrtalvreq" value="<?php echo isset($_GET['idhrtalvreq']) ? htmlspecialchars($_GET['idhrtalvreq']) : ''; ?>">
                        <input type="hidden" name="idhrtaleavectg" value="<?php echo isset($_GET['idhrtaleavectg']) ? htmlspecialchars($_GET['idhrtaleavectg']) : ''; ?>">
                        <input type="hidden" name="leavedate" value="<?php echo isset($_GET['durationfrom']) ? date('M d, Y (D)', strtotime($_GET['durationfrom'])) : ''; ?>" required readonly class="form-control">


                        <input type="hidden" name="origleavedate" value="<?php echo isset($_GET['durationfrom']) ?  date('Y-m-d', strtotime($_GET['durationfrom'])) : ''; ?>" ">
                        <input type="hidden" name="origenddate" value="<?php echo isset($_GET['durationto']) ?  date('Y-m-d', strtotime($_GET['durationto'])) : ''; ?>" ">


                        <input type="hidden" name="leavetype" value="<?php echo isset($_GET['leavetype']) ? htmlspecialchars($_GET['leavetype']) : ''; ?>">
                        <input type="hidden" name="idpaygroup"  value="<?php echo isset($_GET['idpaygroup']) ? htmlspecialchars($_GET['idpaygroup']) : ''; ?>">
                        <input type="hidden" name="employeeid"  value="<?php echo isset($_GET['employeeid']) ? htmlspecialchars($_GET['employeeid']) : ''; ?>">

                    </div>
                    <div class="mb-4">
                    
                        <div class="d-flex gap-2"">
                            <div class="w-50">
                                <p class = ' mb-0'>From</p>
                                <input id = 'leavedates' type="date" name="durationfrom" value="<?php echo isset($_GET['durationfrom']) ? date('Y-m-d', strtotime($_GET['durationfrom'])) : ''; ?>" required class="form-control" onchange="countWeekdays()">
                            </div>
                            <div class="w-50">
                                <p class = ' mb-0'>To</p>
                                <input id = 'endleaves' type="date" name="durationto" value="<?php echo isset($_GET['durationto']) ? date('Y-m-d', strtotime($_GET['durationto'])) : ''; ?>" required class="form-control" onchange="countWeekdays()">
                            </div>
                           
                        </div>
                        <p class = 'text-warning my-2 ' id="dateText"></p>
                    </div>



                    <div class="mb-4 hidden">
                        <p class = ' mb-0'>From</p>
                        <div class="d-flex gap-2">
                            <div class="w-50">
                                <label>From</label>
                                <input type="time" name="durationfromh" value="<?php echo isset($_GET['durationfrom']) ? date('H:i', strtotime($_GET['durationfrom'])) : ''; ?>"  class="w-100 poppins border border-1 border-black rounded-3 px-2">
                            </div>
                            <div class="w-50">
                                <label>To</label>
                                <input type="time" name="durationtoh" value="<?php echo isset($_GET['durationto']) ? date('H:i', strtotime($_GET['durationto'])) : ''; ?>"  class="w-100 poppins border border-1 border-black rounded-3 px-2">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                    <p class = ' mb-0'>Leave Type</p>
                        <!-- <input type="text" name="leavetype" value="<?php echo isset($_GET['leavetype']) ? htmlspecialchars($_GET['leavetype']) : ''; ?>"  class="form-control"> -->

                        

                        <?php

$res16query="SELECT * FROM tblhrtaleavectg WHERE `name` = '$leavetype'";
$result16=""; $found16=0; $ctr16=0;
$result16=$dbh2->query($res16query);
        if($result16->num_rows>0) {
            while($myrow16=$result16->fetch_assoc()) {
        $found16=1;
        $idhrtaleavectg16 = $myrow16['idhrtaleavectg'];
        $code16 = $myrow16['code'];
        $name16 = $myrow16['name'];
       
    }

    
}
?>



                        <select name="leavetype" class="form-control disabled" >
                            <option id = 'leavetypeval' value="<?php echo $idhrtaleavectg16?>" selected  ><?php echo $leavetype?></option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <p class = 'mb-0 '>Leave Duration</p>
                        <input id = 'leavedur' type="text" name="leaveduration" value="" required  class="form-control">
                    </div>
                    <div class="mb-4">
                        <p class = 'mb-0 '>Reason/Remarks (optional)</p>
                        <textarea name="reason" rows="5" required class="form-control"><?php echo isset($_GET['reason']) ? htmlspecialchars($_GET['reason']) : ''; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="border-top mx-5">
                    <div id="" class="py-5 mx-5 float-end">
                        <a href='<?php echo "hrtimeattcutleave.php?loginid=$loginid&idpg=$idpaygroup&idct=$idcutoff&eid=$employeeid" ?>' class="btn text-dark">Cancel</a>
                        <input type="submit" value="Submit" id = 'myButton' name="submit" class="btn text-white bg-success">


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    
    
    function countWeekdays() {
            const startDate = new Date(document.getElementById('leavedates').value);
            const endDate = new Date(document.getElementById('endleaves').value);
            console.log (startDate, endDate);
			let count = 0;
			let dayValue;
			let fixt;
			const selectedValue = document.getElementById('leavetypeval');;
			const button = document.getElementById('myButton');
			const p = document.getElementById('dateText');
			

			if (startDate && endDate && new Date(endDate) < new Date(startDate)) {
				button.disabled = true;
				p.textContent = 'End date Earlier than start...'

			} else {
				button.disabled = false;
				p.textContent = ''


			}


			if (selectedValue == 17 || selectedValue == 18 || selectedValue == 19) {
				dayValue = 0.5; // Half day
				fixt = 2;
			} else {
				dayValue = 1; // Full day
				fixt = 1
			}

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
                    count+= dayValue;
                }
            }

            // Display the count in the input field
            document.getElementById('leavedur').value = count.toFixed(1) + " Days";
        }
</script>

<?php

include("footer.php");
} else {
    include("logindeny.php");
}

?>