<?php 

include("db1.php");
include("datetimenow.php");


$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

  echo "<form action='addproject2.php?loginid=$loginid' method='post' name='testform'>";
?>
  
<div class="row">
  <div class="col-6 mx-1">
  <div class="mb-3">
      <label for="proj_num" class="form-label">Project No.</label>
      <input type="text" class="form-control" id="proj_num" name="proj_num">
    </div>
    </div>

    <div class="col-6">
    <div class="mb-3">
      <label for="proj_code" class="form-label">Project Code*</label>
      <input type="text" class="form-control" id="proj_code" name="proj_code" required>
    </div>
    </div>
    </div>


    <div class="row">
  <div class="col-6">
    <div class="mb-3">
      <label for="proj_sname" class="form-label">Project Acronym*</label>
      <input type="text" class="form-control" id="proj_sname" name="proj_sname" maxlength="30" required>
    </div>
    </div>

<div class="col-6">
    <div class="mb-3">
      <label for="proj_fname" class="form-label">Project Name*</label>
      <input class="form-control" id="proj_fname" name="proj_fname"  required>
    </div>

    </div>
    </div>


    <div class="mb-3">
      <label for="proj_desc" class="form-label">Description</label>
      <textarea class="form-control" id="proj_desc" name="proj_desc"></textarea>
    </div>

    <div class="mb-3">
      <label for="proj_services" class="form-label">Services
<?php

	$res18query=""; $result18=""; $found18=0; $ctr18=0;
        $res18query="SELECT idprojctgservices, code, name FROM tblprojctgservices ORDER BY seq ASC";
        $result18=$dbh2->query($res18query);
	if($result18->num_rows>0) {
		while($myrow18=$result18->fetch_assoc()) {
		$found18=1;
		$ctr18=$ctr18+1;
		$idprojctgservices18=$myrow18['idprojctgservices'];
		$code18=$myrow18['code'];
		$name18=$myrow18['name'];
		// if($projsvc01==$code18||$projsvc02==$code18||$projsvc03==$code18||$projsvc04==$code18||$projsvc05==$code18) { $id18found='checked'; } else { $id18found=''; }
		// echo "<div class='form-group'><input class='form-control' type='checkbox' name='prjsvc[]' value='$code18' $id18found>$code18 - $name18<br>";
    echo "<li>$code18 - $name18</li>";
		} // while
	} // if
?>
      </label>
      <input type="text" class="form-control" id="proj_services" name="proj_services" maxlength="10" placeholder="pls input 2-letter code for services">
    </div>

    <div class="mb-3">
      <label for="proj_duty" class="form-label">Project duty (c/o)</label>
      <input type="text" class="form-control" id="proj_duty" name="proj_duty">
    </div>

    <div class="mb-3">
      <label for="proj_period" class="form-label">Period</label>
      <input type="text" class="form-control" id="proj_period" name="proj_period">
    </div>
  

    <div class="row mb-3 text-center">

    <div class="col-6 m-3">
    
<p class = 'fw-bold mb-0 pb-0'>Duration from</p>

<?php
//start durationfrom w/ current date displayed
    $cutarrdatestart = split("-", $datenow);
    $datestartyyyy = $cutarrdatestart[0];
    $datestartmmm = $cutarrdatestart[1];
    $datestartdd = $cutarrdatestart[2];
    echo "<div class = 'row'><div class = 'col'><input name=\"year_start\" class = 'form-control' size=\"4\" value=\"$datestartyyyy\"></div>";

    $selectjan=""; $selectfeb=""; $selectmar=""; $selectapr=""; $selectmay=""; $selectjun="";
    $selectjul=""; $selectaug=""; $selectsep=""; $selectoct=""; $selectnov=""; $selectdec="";
    if($datestartmmm == "01") { $selectjan = "selected"; }
    else if($datestartmmm == "02") { $selectfeb = "selected"; }
    else if($datestartmmm == "03") { $selectmar = "selected"; }
    else if($datestartmmm == "04") { $selectapr = "selected"; }
    else if($datestartmmm == "05") { $selectmay = "selected"; }
    else if($datestartmmm == "06") { $selectjun = "selected"; }
    else if($datestartmmm == "07") { $selectjul = "selected"; }
    else if($datestartmmm == "08") { $selectaug = "selected"; }
    else if($datestartmmm == "09") { $selectsep = "selected"; }
    else if($datestartmmm == "10") { $selectoct = "selected"; }
    else if($datestartmmm == "11") { $selectnov = "selected"; }
    else if($datestartmmm == "12") { $selectdec = "selected"; }
    else if($datestartmmm == "") { $selectmonth = "selected"; }
    else { $selectmonth = "selected"; }
    echo "<div class = 'col'><select class = 'form-control' name=\"month_start\">";
      echo "<option value=\"01\" $selectjan>Jan</option>";
      echo "<option value=\"02\" $selectfeb>Feb</option>";
      echo "<option value=\"03\" $selectmar>Mar</option>";
      echo "<option value=\"04\" $selectapr>Apr</option>";
      echo "<option value=\"05\" $selectmay>May</option>";
      echo "<option value=\"06\" $selectjun>Jun</option>";
      echo "<option value=\"07\" $selectjul>Jul</option>";
      echo "<option value=\"08\" $selectaug>Aug</option>";
      echo "<option value=\"09\" $selectsep>Sep</option>";
      echo "<option value=\"10\" $selectoct>Oct</option>";
      echo "<option value=\"11\" $selectnov>Nov</option>";
      echo "<option value=\"12\" $selectdec>Dec</option>";
    echo "</select></div>";

    $select01=""; $select02=""; $select03=""; $select04=""; $select05=""; $select06=""; $select07=""; $select08=""; $select09=""; $select10="";
    $select11=""; $select12=""; $select13=""; $select14=""; $select15=""; $select16=""; $select17=""; $select18=""; $select19=""; $select20="";
    $select21=""; $select22=""; $select23=""; $select24=""; $select25=""; $select26=""; $select27=""; $select28=""; $select29=""; $select30=""; $select31="";
    if($datestartdd == "01") { $select01 = "selected"; }
    else if ($datestartdd == "02") { $select02 = "selected"; }
    else if ($datestartdd == "03") { $select03 = "selected"; }
    else if ($datestartdd == "04") { $select04 = "selected"; }
    else if ($datestartdd == "05") { $select05 = "selected"; }
    else if ($datestartdd == "06") { $select06 = "selected"; }
    else if ($datestartdd == "07") { $select07 = "selected"; }
    else if ($datestartdd == "08") { $select08 = "selected"; }
    else if ($datestartdd == "09") { $select09 = "selected"; }
    else if ($datestartdd == "10") { $select10 = "selected"; }
    else if ($datestartdd == "11") { $select11 = "selected"; }
    else if ($datestartdd == "12") { $select12 = "selected"; }
    else if ($datestartdd == "13") { $select13 = "selected"; }
    else if ($datestartdd == "14") { $select14 = "selected"; }
    else if ($datestartdd == "15") { $select15 = "selected"; }
    else if ($datestartdd == "16") { $select16 = "selected"; }
    else if ($datestartdd == "17") { $select17 = "selected"; }
    else if ($datestartdd == "18") { $select18 = "selected"; }
    else if ($datestartdd == "19") { $select19 = "selected"; }
    else if ($datestartdd == "20") { $select20 = "selected"; }
    else if ($datestartdd == "21") { $select21 = "selected"; }
    else if ($datestartdd == "22") { $select22 = "selected"; }
    else if ($datestartdd == "23") { $select23 = "selected"; }
    else if ($datestartdd == "24") { $select24 = "selected"; }
    else if ($datestartdd == "25") { $select25 = "selected"; }
    else if ($datestartdd == "26") { $select26 = "selected"; }
    else if ($datestartdd == "27") { $select27 = "selected"; }
    else if ($datestartdd == "28") { $select28 = "selected"; }
    else if ($datestartdd == "29") { $select29 = "selected"; }
    else if ($datestartdd == "30") { $select30 = "selected"; }
    else if ($datestartdd == "31") { $select31 = "selected"; }
    else if ($datestartdd = "") { $selectday = "selected"; }
    else { $selectday = "selected"; }
    echo "<div class = 'col'><select class = 'form-control' name=\"day_start\">";
      echo "<option value=\"01\" $select01>01</option>";
      echo "<option value=\"02\" $select02>02</option>";
      echo "<option value=\"03\" $select03>03</option>";
      echo "<option value=\"04\" $select04>04</option>";
      echo "<option value=\"05\" $select05>05</option>";
      echo "<option value=\"06\" $select06>06</option>";
      echo "<option value=\"07\" $select07>07</option>";
      echo "<option value=\"08\" $select08>08</option>";
      echo "<option value=\"09\" $select09>09</option>";
      echo "<option value=\"10\" $select10>10</option>";
      echo "<option value=\"11\" $select11>11</option>";
      echo "<option value=\"12\" $select12>12</option>";
      echo "<option value=\"13\" $select13>13</option>";
      echo "<option value=\"14\" $select14>14</option>";
      echo "<option value=\"15\" $select15>15</option>";
      echo "<option value=\"16\" $select16>16</option>";
      echo "<option value=\"17\" $select17>17</option>";
      echo "<option value=\"18\" $select18>18</option>";
      echo "<option value=\"19\" $select19>19</option>";
      echo "<option value=\"20\" $select20>20</option>";
      echo "<option value=\"21\" $select21>21</option>";
      echo "<option value=\"22\" $select22>22</option>";
      echo "<option value=\"23\" $select23>23</option>";
      echo "<option value=\"24\" $select24>24</option>";
      echo "<option value=\"25\" $select25>25</option>";
      echo "<option value=\"26\" $select26>26</option>";
      echo "<option value=\"27\" $select27>27</option>";
      echo "<option value=\"28\" $select28>28</option>";
      echo "<option value=\"29\" $select29>29</option>";
      echo "<option value=\"30\" $select30>30</option>";
      echo "<option value=\"31\" $select31>31</option>";
    echo "</select></div>";
//end durationfrom
?>

</div>
</div>

<div class="col-6 m-3">
<p  class = 'fw-bold mb-0 pb-0'>Duration to</p>


<div class = 'row'>

<div class="col">
<input class = 'form-control' name=year_end size=4 value="0000">

</div>

<div class="col">
<select class = 'form-control' name=month_end>
<option value="00">Month</option>
<option value=01>Jan</option>
<option value=02>Feb</option>
<option value=03>Mar</option>
<option value=04>Apr</option>
<option value=05>May</option>
<option value=06>Jun</option>
<option value=07>Jul</option>
<option value=08>Aug</option>
<option value=09>Sep</option>
<option value=10>Oct</option>
<option value=11>Nov</option>
<option value=12>Dec</option>
</select>
</div>

<div class="col">
<select class = 'form-control' name=day_end>
<option value="00">Day</option>
<option value=01>1</option>
<option value=02>2</option>
<option value=03>3</option>
<option value=04>4</option>
<option value=05>5</option>
<option value=06>6</option>
<option value=07>7</option>
<option value=08>8</option>
<option value=09>9</option>
<option value=10>10</option>
<option value=11>11</option>
<option value=12>12</option>
<option value=13>13</option>
<option value=14>14</option>
<option value=15>15</option>
<option value=16>16</option>
<option value=17>17</option>
<option value=18>18</option>
<option value=19>19</option>
<option value=20>20</option>
<option value=21>21</option>
<option value=22>22</option>
<option value=23>23</option>
<option value=24>24</option>
<option value=25>25</option>
<option value=26>26</option>
<option value=27>27</option>
<option value=28>28</option>
<option value=29>29</option>
<option value=30>30</option>
<option value=31>31</option>
</select>
</div>
</div>



</div>
</div>


<div class = 'mb-3'>
<p  class = 'fw-bold mb-0'>Status</p>
<input class = 'mx-2' type=radio name=projstatus value="On-Going" checked>On-Going
<input class = 'mx-2' type=radio name=projstatus value="Finished">Finished
<input class = 'mx-2' type=radio name=projstatus value="Extended">Extended
<input class = 'mx-2' type=radio name=projstatus value="Not Started">Not Started
</div>


<div class="form-group row">
            <label for="proj_remarks" class="col-sm-2 col-form-label">Remarks</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="proj_remarks" name="proj_remarks" rows="5"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="employeeid" class="col-sm-2 col-form-label">Assigned Personnel</label>
            <div class="col-sm-10">
                <select class="form-control" id="employeeid" name="employeeid">
                    <option value="" selected>Select</option>
                    <?php
                    $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, name_middle FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.term_resign = '0000-00-00' ORDER BY tblcontact.name_last", $dbh);

                    while ($myrow = mysql_fetch_assoc($result)) {
                        $employeeid = htmlspecialchars($myrow['employeeid']);
                        $name_first = htmlspecialchars($myrow['name_first']);
                        $name_last = htmlspecialchars($myrow['name_last']);
                        $name_middle = htmlspecialchars($myrow['name_middle']);
                        echo "<option value='$employeeid'>$name_last, $name_first {$name_middle[0]}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="thisdiv text-end bg-white px-2 py-3 border rounded-3 shadow">
   
                <button type="submit" class="btn text-white w-50 bg-success">Add Project</button>
       
        </div>

<style>
  .thisdiv{
    position: sticky !important;
    bottom: 10 !important;
    z-index: 1;
  }
</style>
<?php

  echo "</form>";
  echo "<p>";



  $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminloginid=$loginid", $dbh);


?> 

