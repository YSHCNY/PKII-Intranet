
	<?php
//
// vprojmore.php
// fr: vc/vprojects.php
// page 211 of index.php

$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';

$projectid = (isset($_POST['projectid'])) ? $_POST['projectid'] :'';
$projcode = (isset($_POST['projcode'])) ? $_POST['projcode'] :'';
?>


<div class="">
	<div class="py-5 mainbgc">
	<h3 class = "text-white ms-5 fs-2 p-5">PKII Projects Listing</h3>
				</div>
	<div class="container my-5 mx-auto">
<div class="bg-white rounded-3 border">
<div class="card">
    <?php 
        include '../m/qryproj2.php';
		// <p class='card-text text-center'>Acronym</p>
		// 	<p class='card-text text-center'>Project Code</p>
        if($found11==1) {
            echo "<div class='card-body px-5'>";
            echo "
			<div class='row border-bottom  pb-3 mx-2 '>
			<div class='col-6'>
			<div class = 'mb-4 '>
			<h3 class='card-text maintext mb-0'>$proj_sname11 ($proj_code11)</h3>
			<p class='card-text submaintext'>$proj_fname11</p>
			</div>
			</div>";
      

			echo "
			<div class='col-6'>
			<div class = 'py-5'>
			<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=21\" class ='float-end' method=\"POST\" name=\"index\">";
			echo "<button type=\"submit\" class='btn btn-danger btn-sm'><svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' fill='white' class='bi bi-x-lg' viewBox='0 0 16 16'>
			<path d='M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z'/>
		  </svg></button>";
			echo "</form>
			</div>
			</div>



			</div>
			";
        
            echo "
			<div class ='px-3 my-4'>
			<p class='card-text text-secondary fs-5  mb-0'>Description</p>
			<p class='card-text  maintext'>$proj_desc11</p>
			</div>
			";
    
            echo "
			<div class='row gap-0 border text-center mx-3'>
			
			<div class='col-lg-3 col-12'>
			<div class ='px-3 my-4'>
			<p class='card-text text-secondary fs-5  mb-0'>Status</p>";

            if($projstatus11=='Finished') { 
                $projstatus11="Completed"; 
            }
            echo "<p class='card-text maintext'>$projstatus11</p>
			</div>
			</div>
			";


            echo "
		
			<div class='col-lg-3 col-12'>
			<div class ='px-3 my-4'>
			<p class='card-text text-secondary fs-5  mb-0'>Date Started</p>";
            echo "<p class='card-text maintext'>";
            if($date_start11!='0000-00-00') {
                echo date("Y-M-d", strtotime($date_start11));
            } else {
                echo $date_start11;
            }
            echo "</p>
			</div>
			</div>
			";


            echo "
			<div class='col-lg-3 col-12'>
			<div class ='px-3 my-4'>
			<p class='card-text text-secondary fs-5  mb-0'>Date Finished</p>";
            echo "<p class='card-text maintext'>";
            if($date_end11!='0000-00-00') {
                echo date("Y-M-d", strtotime($date_end11));
            } else {
                echo $date_end11;
            }
            echo "</p>
			</div>
			</div>
			";


            echo "
			<div class='col-lg-3 col-12'>
			<div class ='px-3 my-4'>
			<p class='card-text text-secondary fs-5  mb-0'>Services</p>
			<p class='card-text maintext'>$proj_services11</p>
			</div>
			</div>

			</div>
			";


        
            echo "
			<div class ='px-3 my-4'>
			<p class='card-text text-secondary fs-5  mb-0'>Remarks</p>
			<p class='card-text maintext'>$projremarks11</p>
			</div>";
           


			echo "
			<div class ='px-3 my-4'>
			<p class='card-text text-secondary fs-5  mb-0'>Project coordinator</p>";
            // Query assigned personnel
            include '../m/qryproj2b.php';
            if($found12==1 && $employeeid11!='') {
                
                echo "<p class='card-text maintext'>$name_last12, $name_first12 $name_middle12[0]</p>
				</div>";
            }



			echo "
			<div class =' my-4'>
			<p class='card-text text-secondary fs-5  mb-0'>Assigned personnel/s</p>";
            // Query personnel involved on this project
            include '../m/qryproj2c.php';
            $param14 = count($employeeid14Arr);
            if($param14>0) {
                
                echo "<p class='card-text maintext'>";
                for($x14 = 0; $x14 < $param14; $x14++) {
                    $ctr14=$ctr14+1;
                    echo "<br>• ".$name_last14Arr[$x14].", ".$name_first14Arr[$x14]." ".substr($name_middle14Arr[$x14],0,1)."";
                }
                echo "</p>
				</div>";
            }



            echo "</div>";
        } // if($found11==1)

    ?> 
</div>

</div>


</div>
</div>