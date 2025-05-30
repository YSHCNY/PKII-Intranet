<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$policynum = $_POST['policynum'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Manage Group Insurance</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Add new group insurance policy number</b></font></td></tr>";

  if ($policynum != "")
  {

     echo "<FORM METHOD=post ACTION=personnelinsuregrppolicyadd2.php?loginid=$loginid&pn=$policynum>";

     echo "<tr><td align=center colspan=2>";
     echo "<i>Enter New Policy Details</i></td></tr>";
     echo "<tr><td>Group Policy No.:</td><td><b>$policynum</b></td></tr>";

     echo "<tr><td>Effectivity Date</td><td>";

     echo "<input name=effectyear size=4 value=2010>";
     echo "<select name=effectmonth>";
     echo "<option value=01>Jan</option>";
     echo "<option value=02>Feb</option>";
     echo "<option value=03>Mar</option>";
     echo "<option value=04>Apr</option>";
     echo "<option value=05>May</option>";
     echo "<option value=06>Jun</option>";
     echo "<option value=07>Jul</option>";
     echo "<option value=08>Aug</option>";
     echo "<option value=09>Sep</option>";
     echo "<option value=10>Oct</option>";
     echo "<option value=11>Nov</option>";
     echo "<option value=12>Dec</option>";
     echo "</select>";
     echo "<select name=effectday>";
     echo "<option value=01>01</option>";
     echo "<option value=02>02</option>";
     echo "<option value=03>03</option>";
     echo "<option value=04>04</option>";
     echo "<option value=05>05</option>";
     echo "<option value=06>06</option>";
     echo "<option value=07>07</option>";
     echo "<option value=08>08</option>";
     echo "<option value=09>09</option>";
     echo "<option value=10>10</option>";
     echo "<option value=11>11</option>";
     echo "<option value=12>12</option>";
     echo "<option value=13>13</option>";
     echo "<option value=14>14</option>";
     echo "<option value=15>15</option>";
     echo "<option value=16>16</option>";
     echo "<option value=17>17</option>";
     echo "<option value=18>18</option>";
     echo "<option value=19>19</option>";
     echo "<option value=20>20</option>";
     echo "<option value=21>21</option>";
     echo "<option value=22>22</option>";
     echo "<option value=23>23</option>";
     echo "<option value=24>24</option>";
     echo "<option value=25>25</option>";
     echo "<option value=26>26</option>";
     echo "<option value=27>27</option>";
     echo "<option value=28>28</option>";
     echo "<option value=29>29</option>";
     echo "<option value=30>30</option>";
     echo "<option value=31>31</option>";
     echo "</select></td>";

     echo "<tr><td colspan=2 align=center><br>Period of Insurance</td></tr>";

     echo "<tr><td>From<br>";
     echo "<input name=fromyear size=4 value=2010>";
     echo "<select name=frommonth>";
     echo "<option value=01>Jan</option>";
     echo "<option value=02>Feb</option>";
     echo "<option value=03>Mar</option>";
     echo "<option value=04>Apr</option>";
     echo "<option value=05>May</option>";
     echo "<option value=06>Jun</option>";
     echo "<option value=07>Jul</option>";
     echo "<option value=08>Aug</option>";
     echo "<option value=09>Sep</option>";
     echo "<option value=10>Oct</option>";
     echo "<option value=11>Nov</option>";
     echo "<option value=12>Dec</option>";
     echo "</select>";
     echo "<select name=fromday>";
     echo "<option value=01>01</option>";
     echo "<option value=02>02</option>";
     echo "<option value=03>03</option>";
     echo "<option value=04>04</option>";
     echo "<option value=05>05</option>";
     echo "<option value=06>06</option>";
     echo "<option value=07>07</option>";
     echo "<option value=08>08</option>";
     echo "<option value=09>09</option>";
     echo "<option value=10>10</option>";
     echo "<option value=11>11</option>";
     echo "<option value=12>12</option>";
     echo "<option value=13>13</option>";
     echo "<option value=14>14</option>";
     echo "<option value=15>15</option>";
     echo "<option value=16>16</option>";
     echo "<option value=17>17</option>";
     echo "<option value=18>18</option>";
     echo "<option value=19>19</option>";
     echo "<option value=20>20</option>";
     echo "<option value=21>21</option>";
     echo "<option value=22>22</option>";
     echo "<option value=23>23</option>";
     echo "<option value=24>24</option>";
     echo "<option value=25>25</option>";
     echo "<option value=26>26</option>";
     echo "<option value=27>27</option>";
     echo "<option value=28>28</option>";
     echo "<option value=29>29</option>";
     echo "<option value=30>30</option>";
     echo "<option value=31>31</option>";
     echo "</select></td>";

     echo "<td>To<br>";
     echo "<input name=toyear size=4 value=2010>";
     echo "<select name=tomonth>";
     echo "<option value=01>Jan</option>";
     echo "<option value=02>Feb</option>";
     echo "<option value=03>Mar</option>";
     echo "<option value=04>Apr</option>";
     echo "<option value=05>May</option>";
     echo "<option value=06>Jun</option>";
     echo "<option value=07>Jul</option>";
     echo "<option value=08>Aug</option>";
     echo "<option value=09>Sep</option>";
     echo "<option value=10>Oct</option>";
     echo "<option value=11>Nov</option>";
     echo "<option value=12>Dec</option>";
     echo "</select>";
     echo "<select name=today>";
     echo "<option value=01>01</option>";
     echo "<option value=02>02</option>";
     echo "<option value=03>03</option>";
     echo "<option value=04>04</option>";
     echo "<option value=05>05</option>";
     echo "<option value=06>06</option>";
     echo "<option value=07>07</option>";
     echo "<option value=08>08</option>";
     echo "<option value=09>09</option>";
     echo "<option value=10>10</option>";
     echo "<option value=11>11</option>";
     echo "<option value=12>12</option>";
     echo "<option value=13>13</option>";
     echo "<option value=14>14</option>";
     echo "<option value=15>15</option>";
     echo "<option value=16>16</option>";
     echo "<option value=17>17</option>";
     echo "<option value=18>18</option>";
     echo "<option value=19>19</option>";
     echo "<option value=20>20</option>";
     echo "<option value=21>21</option>";
     echo "<option value=22>22</option>";
     echo "<option value=23>23</option>";
     echo "<option value=24>24</option>";
     echo "<option value=25>25</option>";
     echo "<option value=26>26</option>";
     echo "<option value=27>27</option>";
     echo "<option value=28>28</option>";
     echo "<option value=29>29</option>";
     echo "<option value=30>30</option>";
     echo "<option value=31>31</option>";
     echo "</select></td></tr>";

     echo "<tr><td colspan=2><br>Insurance Vendor (Company Name)<br>";
     echo "<input name=insurancename size=50></td></tr>";

     echo "<tr><td colspan=2>Details<br>";
     echo "<textarea rows=4 cols=50 name=insurancedetails></textarea></td></tr>";

     echo "<tr><td colspan=2 align=center><INPUT TYPE=SUBMIT VALUE=\"Save\"></td></tr></table>";
     echo "</form>";

  }
  else
  {
    echo "<tr><td colspane=2><font color=red><b>Sorry, blank policy number is not allowed</b></font></td></tr>";
  }

     echo "</table>";

     echo "<p><a href=personnelinsurance.php?loginid=$loginid>Back to Manage Insurance</a><br>";    

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
