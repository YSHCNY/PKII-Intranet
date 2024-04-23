<?php
include("db1.php");
include("addons.php");

$loginid = isset($_GET['loginid']) ? $_GET['loginid'] : '';
$employeeid = isset($_POST['empid']) ? $_POST['empid'] : '';

$found = 0;

if ($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {
    include("header.php");
    include("sidebar.php");

?>

<style>
    #close:active{
        background-color: red !important;
        border: 1px solid red !important;
        border-radius: 5px;
        padding: 4.5px !important;
    }
    #close:hover{
        background-color: #ff5252;
        border: 1px solid #ff5252;
        border-radius: 5px;
        padding: 4.5px !important;
    }
    #ELIsub-parent{
        height: 100%;
    }
    .mb-4 input, select{
        height: 35px;
    }
    #svbtn input{
        height: 45px;
        transition: transform 0.5s ease;
    }
    #svbtn input:active{
        transform: scale(0.9);
    }
    #svbtn input:hover{
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }
</style>

<div class="container d-flex justify-content-center">
    <div id="ELIsub-parent" class="w-75 poppins d-flex flex-column align-items-center border border-1 rounded-4 shadow my-5 p-3">
        <div class="w-100 d-flex justify-content-end">
            <h4 id="close" class="m-0 p-2"><a href="hrtimeattcutleave.php?loginid=<?php echo $loginid; ?>" class="text-dark">✖</a></h4>
        </div>
        <div class="w-75 poppins d-flex justify-content-center border-bottom border-2 py-3">
            <h2>Edit Leave Information</h2>
        </div>
        <div class="w-100 h-100 mt-5">
            <form action="hrtimeattcutleaveedt2.php?loginid=<?php echo $loginid; ?>" method="POST" class="m-0">
                <div class="w-100 d-flex flex-column justify-content-center align-items-center mb-4 text-black">
                <div style="width: 60%;">
                    <div class="mb-4">
                        <label>Leave Date</label>
                        <input type="hidden" name="loginid" value="<?php echo htmlspecialchars($loginid); ?>">
                        <input type="hidden" name="idhrtalvreq" value="<?php echo isset($_GET['idhrtalvreq']) ? htmlspecialchars($_GET['idhrtalvreq']) : ''; ?>">
                        <input type="hidden" name="idhrtaleavectg" value="<?php echo isset($_GET['idhrtaleavectg']) ? htmlspecialchars($_GET['idhrtaleavectg']) : ''; ?>">
                        <input type="text" name="leavedate" value="<?php echo isset($_GET['durationfrom']) ? date('M d, Y (D)', strtotime($_GET['durationfrom'])) : ''; ?>" required readonly class="w-100 poppins border border-1 border-black rounded-3 px-2">
                    </div>
                    <div class="mb-4">
                        <label class="text-info">Duration Date</label>
                        <div class="d-flex gap-2"">
                            <div class="w-50">
                                <label>From</label>
                                <input type="date" name="durationfrom" value="<?php echo isset($_GET['durationfrom']) ? date('Y-m-d', strtotime($_GET['durationfrom'])) : ''; ?>" required class="w-100 poppins border border-1 border-black rounded-3 px-2">
                            </div>
                            <div class="w-50">
                                <label>To</label>
                                <input type="date" name="durationto" value="<?php echo isset($_GET['durationto']) ? date('Y-m-d', strtotime($_GET['durationto'])) : ''; ?>" required class="w-100 poppins border border-1 border-black rounded-3 px-2">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="text-info">Duration Time</label>
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
                        <label>Leave Type</label>
                        <input type="text" name="leavetype" value="<?php echo isset($_GET['leavetype']) ? htmlspecialchars($_GET['leavetype']) : ''; ?>" required readonly class="w-100 poppins border border-1 border-black rounded-3 px-2">
                        <!-- <select name="leavetype" class="poppins w-100 border border-1 border-black rounded-3">
                            <option value="Sick leave" <?php if (isset($_GET['leavetype']) && $_GET['leavetype'] == 'Sick leave') echo 'selected'; ?>>Sick Leave</option>
                            <option value="Vacation leave" <?php if (isset($_GET['leavetype']) && $_GET['leavetype'] == 'Vacation leave') echo 'selected'; ?>>Vacation Leave</option>
                            <option value="Paternity leave" <?php if (isset($_GET['leavetype']) && $_GET['leavetype'] == 'Paternity leave') echo 'selected'; ?>>Paternity Leave</option>
                            <option value="Maternity (C) leave" <?php if (isset($_GET['leavetype']) && $_GET['leavetype'] == 'Maternity (C) leave') echo 'selected'; ?>>Maternity (C) Leave</option>
                            <option value="Maternity (N) leave" <?php if (isset($_GET['leavetype']) && $_GET['leavetype'] == 'Maternity (N) leave') echo 'selected'; ?>>Maternity (N) Leave</option>
                            <option value="Special leave" <?php if (isset($_GET['leavetype']) && $_GET['leavetype'] == 'Special leave') echo 'selected'; ?>>Special Leave</option>
                            <option value="Additional Sp. Leave" <?php if (isset($_GET['leavetype']) && $_GET['leavetype'] == 'Additional Sp. Leave') echo 'selected'; ?>>Additional Sp. Leave</option>
                            <option value="Retained Sick Leave" <?php if (isset($_GET['leavetype']) && $_GET['leavetype'] == 'Retained Sick Leave') echo 'selected'; ?>>Retained Sick Leave</option>
                        </select> -->
                    </div>
                    <div class="mb-4">
                        <label>Leave Duration</label>
                        <input type="text" name="leaveduration" value="<?php echo isset($_GET['leaveduration']) ? htmlspecialchars($_GET['leaveduration']) : ''; ?> days" required readonly class="w-100 poppins border border-1 border-black rounded-3 px-2">
                    </div>
                    <div class="mb-4">
                        <label>Reason/Remarks (optional)</label>
                        <textarea name="reason" rows="5" required class="w-100 poppins border border-1 border-black rounded-3 p-2"><?php echo isset($_GET['reason']) ? htmlspecialchars($_GET['reason']) : ''; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="w-100 d-flex justify-content-center align-items-center">
                    <div id="svbtn" class="w-75 d-flex justify-content-center align-items-center border-top border-2 py-5">
                        <input type="submit" value="Submit" name="submit" class="w-50 fw-medium fs-4 text-white poppins border border-1 border-success bg-success rounded-3">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

include("footer.php");
} else {
    include("logindeny.php");
}

?>