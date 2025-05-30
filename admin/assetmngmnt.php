<?php
//
// emppaycutoffcrea.php // 20200424
// fr cutoff.php
//
require_once("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$submit = (isset($_POST['submit'])) ? $_POST['submit'] :'';

$msginfo="";

$found = 0;
if($loginid != "") {
    include("logincheck.php");

}
include ("header.php");
include ("sidebar.php");
if($found == 1) {


?>


    <div class = 'container'>
        <div class="shadow p-5">
            <div>
                <h3 class="pb-0 mb-0">Asset Management</h3>
                <p class="text-secondary">Manage and monitor office's basic asset</p>
            </div>

            <!-- actions -->
            <div>
                    <div class="p-4 mb-5">
                        <button type="button" data-toggle="modal" data-target="#exampleModalLong" class = 'float-end h4 rounded-3 px-3 py-2 mainbtnclr border-0 text-white'>New Asset +</button>
                    </div>
                
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>
                                    
            </div>
<style>
    table.dataTable thead th{
        color:gray !important;
    }

    table.dataTable tbody tr td{
        padding: 15px;
    }
</style>
<!-- table -->
                    <table class = 'table mt-3' width = '100%' id = 'asswet'>
                        <thead >
                            <tr >
                                <th>Date of Purchase</th>
                                <th>Particulars Description</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Price Unit</th>
                                <th>Amount</th>
                                <th>Release per piece</th>
                                <th>Balance</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php
	// query tblemppayroll
                        $res11qry="";
                        $res11qry="SELECT * FROM amtbl ORDER BY DatePurchased DESC";
                        $result11=""; $found11=0; $ctr11=0;
                        $result11=$dbh2->query($res11qry);
                        if($result11->num_rows>0) {
                            while($myrow11=$result11->fetch_assoc()) {
                                    $dp = $myrow11['DatePurchased'];
                                    $desc = $myrow11['Desc'];
                                    $qty = $myrow11['qty'];
                                    $unit = $myrow11['unit'];
                                    $price = $myrow11['price'];
                                    $amnt = $myrow11['amount'];
                                    $rel = $myrow11['released'];
                                    $bal = $myrow11['balance'];

                    ?>
                            <tr>
                                <td><?php echo $dp?></td>
                                <td><?php echo $desc?></td>
                                <td><?php echo $qty?></td>
                                <td><?php echo $unit?></td>
                                <td>₱<?php echo $price?></td>
                                <td>₱<?php echo $amnt?></td>
                                <td><?php echo $rel?></td>
                                <td><?php echo $bal?></td>
                                <td><button class ='btn btn-success'>Something</button></td>
                            </tr>
                            <?php
                            }}
                            ?>
                        </tbody>
                    </table>
            <div>
                
            </div>
        </div>
    </div>


<?php









} else {
    include ("logindeny.php");
}
$dbh2->close();
?>