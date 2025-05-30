



<form action="mngadmuseradd2.php?loginid=<?php echo $loginid; ?>" method="post">
    <div class="form-group">
        <label for="adminuid">Username</label>
        <input type="text" class="form-control" id="adminuid" name="adminuid">
    </div>
    <div class="form-group">
        <label for="adminpw1">Password</label>
        <input type="password" class="form-control" id="adminpw1" name="adminpw1">
    </div>
    <div class="form-group">
        <label for="adminpw2">Confirm Password</label>
        <input type="password" class="form-control" id="adminpw2" name="adminpw2">
    </div>
    <div class="form-group">
        <label for="employeeid">Link to Personnel</label>
        <input list = 'persona' placeholder="Type Employee ID or Name..." class="form-control" id="employeeid" name="employeeid">
        <datalist id = 'persona'>
         
            <?php
            $res11query = "SELECT employeeid FROM tblemployee WHERE emp_record = 'active' ORDER BY employeeid ASC";
            $result11 = ""; $found11 = 0; $ctr11 = 0;
            $result11 = $dbh2->query($res11query);
            if ($result11->num_rows > 0) {
                while ($myrow11 = $result11->fetch_assoc()) {
                    $found11 = 1;
                    $employeeid11 = $myrow11['employeeid'];
                    $res12query = "SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid='$employeeid11'";
                    $result12 = ""; $found12 = 0; $ctr12 = 0;
                    $result12 = $dbh2->query($res12query);
                    if ($result12->num_rows > 0) {
                        while ($myrow12 = $result12->fetch_assoc()) {
                            $found12 = 1;
                            $name_last12 = $myrow12['name_last'];
                            $name_first12 = $myrow12['name_first'];
                            $name_middle12 = $myrow12['name_middle'];
                            echo "<option value=\"$employeeid11\">$employeeid11 - $name_first12 $name_middle12[0] $name_last12</option>";
                        }
                    }
                }
            }
            ?>
        </datalist>
    </div>
    <div class="form-group">
        <label for="accesslevel">Access Level</label>
        <select class="form-control" id="accesslevel" name="accesslevel">
            <option value="1">1 - Guest user</option>
            <option value="2">2 - Standard user</option>
            <option value="3">3 - Encoder</option>
            <option value="4">4 - Supervisor/Manager</option>
            <option value="5">5 - Super User</option>
        </select>
    </div>
    <div class = 'text-end'>
    <button type="submit" class="px-3 py-2 border-0 text-white rounded-3 mainbtnclr">Add new admin user</button>
    </div>
</form>



<?php
// Additional PHP code...
$resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
$result = $dbh2->query($resquery);
?>
