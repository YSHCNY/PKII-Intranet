<?php
//
// vpersonnel.php
// fr: vc/index.php
//page 22

// get variables
$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';

$disptyp = (isset($_POST['disptyp'])) ? $_POST['disptyp'] :'';

if($page=='') { $page=22; }
?>

<div class=" p-5 <?php echo $hero?>" >
<div class="text-center"><h3 class = 'mb-5 mt-2 py-5 fw-bold text-uppercase text-white'>PKII active personnel</h3></div>
		
<div class="container">
	<div class="flex p-5 <?php echo $mainbg?>  rounded shadow">
<?php
	echo "<form action=\"index.php?lst=$lst&lid=$loginid&sess=$session&p=$page\" class =\"mx-auto\" method=\"POST\" name=\"vpersonnel\">";
?>
	<div class="mx-auto text-center justify-content-center-align-items-center">
<?php
	if($disptyp=='' || $disptyp=='all') {
		$disptypallsel="selected"; $disptypempsel=""; $disptypconsel="";
	} else if($disptyp=='employee') {
		$disptypallsel=""; $disptypempsel="selected"; $disptypconsel="";
	} else if($disptyp=='consultant') {
		$disptypallsel=""; $disptypempsel=""; $disptypconsel="selected";
	} // if
	echo "<label for='disptyp' class='me-2 $subtext'>Sort: </label>";
	echo "<select name = 'disptyp' class =\" rounded-3 border-0 px-3 py-2 align-items-center\" name=\"disptyp\">";
	echo "<option value='all' $disptypallsel>All</option>";
	echo "<option value='employee' $disptypempsel>Employees</option>";
	echo "<option value='consultant' $disptypconsel>Consultants</option>";
	echo "</select>";
?>
	
	<button type="submit" class="btn btn-primary mx-1 mb-1 rounded text-center" value="submit">Submit</button>
	</div>

<?php
	echo "</form>";
?>
</div>
</div>

</div>


<div class="container">
    <div class='mt-5 text-center'>
        <p class='fw-bold fs-4 <?php echo $maintext?> mb-0'>Our Active Personnel</p>
        <p class='<?php echo $subtext?> fs-5'>List of our Active Personnel <span class='fst-italic text-primary fs-6'>(Click row to email)</span></p>
    </div>
    
    <div class="table-responsive shadow p-5">
        <table  id="personnelTable" class="table <?php echo $tableinfo?> table-hover table-bordered table-striped text-center">
            <thead class="<?php echo $mainbg; ?>">
                <tr class = 'align-center'>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include '../m/qrypersonnel.php';
                $param11 = count($employeeidArr);
                for($x11 = 0; $x11 < $param11; $x11++) { 
					echo "<tr onclick=\"window.location='mailto:".$email1Arr[$x11]."';\" style='cursor:pointer;'>";
                    echo "<td><img src='$pathavatar/".$picfnArr[$x11]."' class='border rounded-circle' style='width: 80px; height: 80px;'></td>";
                    echo "<td class='fw-bold fs-5'>".$name_lastArr[$x11].", ".$name_firstArr[$x11]." ".substr($name_middleArr[$x11], 0, 1).".</td>";
                    echo "<td><a href='mailto:".$email1Arr[$x11]."' class=''>".$email1Arr[$x11]."</a></td>";
                    echo "</tr>";
                }
                $dbh->close();
                ?> 
            </tbody>
        </table>
    </div>
</div>




<script>
    $(document).ready(function() {
        $('#personnelTable').DataTable();
    });
</script>



<?php 

$dbh->close();
?> 

