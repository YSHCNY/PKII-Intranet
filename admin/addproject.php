<?php 

include("db1.php");
include("datetimenow.php");


$loginid = $_GET['loginid'];

$found = 0;

if($loginid != "")
{
     $result = mysql_query("SELECT * FROM tbladminlogin WHERE adminloginid=$loginid AND adminloginstat=1", $dbh); 

     while ($myrow = mysql_fetch_row($result))
     {
          $found = 1;
          
          $loginid = $myrow[0];
          $username = $myrow[1];
          $loginstatus = $myrow[5];
          $level = $myrow[6];
     }
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

  echo "<font size=1>Manage >> Projects >> Add new project</font>";

  echo "<form action=addproject2.php?loginid=$loginid method=post name=testform>";
?>

  <table border=1 spacing=0 cellspacing=0 cellpadding=0>
  <tr><td bgcolor=blue colspan=9><font color=white><b>Add new project</b></font></td></tr>
  
  <tr><td>Project No.*</td><td><input name=proj_num></td></tr>
  <tr><td>Project Code*</td><td><input name=proj_code></td></tr>
  <tr><td>Project Acronym*</td><td><input name=proj_sname size=30></td></tr>
  <tr><td valign=top>Project Name*</td><td valign=top><textarea name=proj_fname rows=2 cols=50></textarea></td></tr>
  <tr><td valign=top>Description</td><td valign=top><textarea name=proj_desc rows=5 cols=50></textarea></td></tr>
  <tr><td>Services</td><td><input name=proj_services size=10></td></tr>
  <tr><td>c/o</td><td><input name=proj_duty></td></tr>
  <tr><td>Period</td><td><input name=proj_period></td></tr>
  
<tr><td>Duration from</td>
<td>
<?php
//start durationfrom w/ current date displayed
    $cutarrdatestart = split("-", $datenow);
    $datestartyyyy = $cutarrdatestart[0];
    $datestartmmm = $cutarrdatestart[1];
    $datestartdd = $cutarrdatestart[2];
    echo "<input name=\"year_start\" size=\"4\" value=\"$datestartyyyy\">";

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
    echo "<select name=\"month_start\">";
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
    echo "</select>";

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
    echo "<select name=\"day_start\">";
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
    echo "</select>";
//end durationfrom
?>
</td></tr>

<tr><td>Duration to</td>
<td>
<input name=year_end size=4 value="0000">
<select name=month_end>
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

<select name=day_end>
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
</td></tr>

<tr><td valign=top>Status</td>
<td><input type=radio name=projstatus value="On-Going" checked>On-Going<br>
<input type=radio name=projstatus value="Finished">Finished<br>
<input type=radio name=projstatus value="Extended">Extended<br>
<input type=radio name=projstatus value="Not Started">Not Started</td></tr>
<br>

<tr><td valign=top>Remarks</td><td valign=top><textarea name=proj_remarks rows=5 cols=50></textarea></td></tr>

<tr><td>Assigned Personnel</td>

  <?php

  $result = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, name_middle FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.term_resign = '0000-00-00' ORDER BY tblcontact.name_last", $dbh);

  echo "<td><select name=employeeid>";
  echo "<option value='' selected>Select</option>";

  while ($myrow = mysql_fetch_row($result))
  {    
     $employeeid = $myrow[0];
     $name_first = $myrow[1];
     $name_last = $myrow[2];
     $name_middle = $myrow[3];

     echo "<option value=$employeeid>$name_last, $name_first $name_middle[0]</option>";
  }
  
  echo "</select></td></tr>"; 

  echo "<tr><td></td><td><input type=submit value='Add to Project'></td></tr>";
  echo "</table>";
  echo "</form>";
  echo "<p>";

  echo "<a href=project2.php?loginid=$loginid>Back</a><br>";

  $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
