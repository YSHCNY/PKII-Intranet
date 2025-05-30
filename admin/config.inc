<?php

/////////////////////////
// database conn details
/////////////////////////
$hostname = 'localhost';
// $hostname = '192.168.0.10';
$dbname = 'maindb';
$dbuser = 'root';
// $dbuser = 'srvintradevuser';
$dbuserpass = 'sysad';
// $dbuserpass = 'Pkii@1111';

////////////////////////
// set timezone and other date/time variables
////////////////////////
	date_default_timezone_set('Asia/Manila');
	$now = date("Y-m-d H:i:s", time());
	$datenow = date("Y-m-d");
	$yearnow = date("Y");
	$monthnow = date("n");

////////////////////////
// set paths
////////////////////////
	$pathavatar="./images"; // path of tblcontact.picfn
	$pathuserfileupload="../uploads";
	$pathmodel="../m";
	$pathtraining="../transfers/training";

////////////////////////
// set other default values
////////////////////////
    // 20220930 for user login acct mgmt
    $usrpwexpiry = 'P30D'; // (in days) login user password expiry
    $usrpwretries = 5; // user login retry attempts
    $usrpwretryresume = 2; // (in hours) user login resumption after reaching max failed retries
	
	// for payroll process 20241002
	$yearMonths = 12;
    $workingHours = 8;
	$yearWorkingDays = 313;
    $mealAllowanceAmount = 100;
    $transportAllowanceAmount = 60;
	$wtaxsched = 'sm';
	$pagibigee = 100; //half-month only (total of P200 per month)
	$pagibiger = 100; //half-month only (total of P200 per month)
	$payrollAcctNumBPIPKII = "0031061954";
	// variables for payroll report signatories
	$preparedbyname = "FELITA D. MANACOP";
	$preparedbyposition = "Accounting Assistant";
	$checkedbyname = "KATHERINE B. CRUZ";
	$checkedbyposition = "Accounting Supervisor";
	$notedbyname = "ANALIE A. ROQUE";
	$notedbyposition = "AVP - Finance";
	$approvedbyname = "PETER S. SAMOZA";
	$approvedbyposition = "President";


?>
