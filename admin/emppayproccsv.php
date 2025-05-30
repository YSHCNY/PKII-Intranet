<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$employeetype = $_POST['employeetype'];

$tablename = 'tblemppaybonus';
$csvfilename = 'emppaybonus.csv';

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
     echo "<html>";
     echo "<img src=pkii_logo.gif>";
     echo "<h2>Employees' Bonus Notifier</h2>";

# assign the tables that you want to import to to the table array
$table = array(
'table1',
'table2',
'table3',
'table4',
'table5',
);

# if the first row of your csv file contains column headings:
# $columnheadings=1
# if the first row does not contain column headings and should be imported:
# $columnheadings=0
$columnheadings = 0;

# contains the email address you want the results sent to
// $emailaddress = "user@domain.com";

# contains the subject you want the message to have
// $subject = "Enter Subject Here";

# contains the email address that will show in the from line
// $emailfrom = "user@domain.com";

# you should not have to edit anything below this line



# perform the required operations for every table listed in the table array
foreach ($table as $tablename) {

# empty the table of its current records
$deleterecords = "TRUNCATE TABLE `$tablename`";
mysql_query($deleterecords);

# intialize your counters for successful and failed record imports
$pass = 0;
$fail = 0;

# the csv file needs to be the same name as the table,
# comma seperated with the columns in the same order as the table,
# and in the same dir as this script
$filecontents = file ("$csvfilename"); # .csv is added to the table name to get the name of the csv file

# every record in the csv file will be inserted into the table unless an error occurs with that record
for($i=$columnheadings; $i<sizeof($filecontents); $i++) {
$insertrecord = "Insert Into `$tablename` Values ($filecontents[$i])";
mysql_query($insertrecord);
if(mysql_error()) {
$fail += 1; # increments if there was an error importing the record
}
else
{
$pass += 1; # increments if the record was successfully imported
}
}

# adds a line to the email message we will send stating how many records were imported
# and how many records failed for each table
$message .= "Table $tablename: Success=$pass Failure=$fail \n";
}

# set to the date and time the script was run
// $runtime = (date("d M Y H:i"));

# add the run time to the body of the email message
// $message .= "\nTime of the message: $runtime (server time zone)\n\n";

# Send the email message
// mail($emailaddress, $subject, $message, "From: '$emailfrom'");

     echo "<p>";
     echo "<p><a href=admlogin.php?loginid=$loginid>Back</a><br>";

     echo "</html>";
}
else
{
     echo "<html>";
     
     echo "You are not logged in<br>";
     echo "<a href=login.htm>Login</a><br>";

     echo "</html>";
}

mysql_close($dbh);
?> 

?>
