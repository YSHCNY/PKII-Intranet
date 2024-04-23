<?php 

require("db1.php");
include("clsmcrypt.php");

/*
//
// start class mcrypt
//
$pin="8888888888888888";

class MCrypt
{
	public $param;  

  private $iv = 'pkiipkiipkiipkii'; #Same as in JAVA
  private $key = 'X2BpnPZXsTJZUbfT'; #Same as in JAVA

  function __construct($param)
  {
  	$this->key = $param;
  }

  function encrypt($str) {

  //$key = $this->hex2bin($key);    
  $iv = $this->iv;

  $td = mcrypt_module_open('rijndael-128', '', 'cbc', $iv);

  mcrypt_generic_init($td, $this->key, $iv);
  $encrypted = mcrypt_generic($td, $str);

  mcrypt_generic_deinit($td);
  mcrypt_module_close($td);

	return bin2hex($encrypted);
  }

  function decrypt($code) {
  //$key = $this->hex2bin($key);
  $code = $this->hex2bin($code);
  $iv = $this->iv;

  $td = mcrypt_module_open('rijndael-128', '', 'cbc', $iv);

  mcrypt_generic_init($td, $this->key, $iv);
  $decrypted = mdecrypt_generic($td, $code);

  mcrypt_generic_deinit($td);
  mcrypt_module_close($td);

  return utf8_encode(trim($decrypted));
  }

  protected function hex2bin($hexdata) {
  $bindata = '';

  for ($i = 0; $i < strlen($hexdata); $i += 2) {
  	$bindata .= chr(hexdec(substr($hexdata, $i, 2)));
  }

  return $bindata;
  }

}

$mcrypt = new MCrypt($pin);
//
// end class mcrypt
//
*/

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> Confi-payroll >> Post-process tools</font></p>";

     echo "<p><a href=confipay.php?loginid=$loginid>Back to ConfiPay Menu</a></p>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th align=\"left\">Custom Payroll - Post-Process Tools</th></tr>";

  if(substr($level, -6, 1) == 1) {

		$res0query="SELECT employeeid, accesslevel FROM tbladminlogin WHERE adminloginid=$loginid";
		$result0=""; $found0=0; $ctr0=0;
		$result0=$dbh2->query($res0query);
		if($result0->num_rows>0) {
			while($myrow0=$result0->fetch_assoc()) {
			$found0 = 1;
			$employeeid = $myrow0['employeeid'];
			$accesslevel = $myrow0['accesslevel'];
			} // while($myrow0=$result0->fetch_assoc())
		} // if($result0->num_rows>0)


     echo "<form action=\"confipaytools2.php?loginid=$loginid\" method=\"POST\" target=\"frame\" name=\"confipaytools2\">";
     // echo "<form action=\"confipaytools2.php?loginid=$loginid\" method=\"POST\" target=\"_self\" name=\"confipaytools2\">";
     echo "<tr><td>Select Payroll Group and Cutoff period:<br>";
     echo "<select class='form-select' name=\"groupcut\">";

    if($accesslevel == "5") {
     $resquery = "SELECT DISTINCT cutstart, cutend, groupname, accesslevel FROM tblconfipayroll WHERE accesslevel <= \"5\" ORDER BY groupname ASC, cutstart DESC";
    } else if($accesslevel <= "4") {
     $resquery = "SELECT DISTINCT cutstart, cutend, groupname, accesslevel FROM tblconfipayroll WHERE accesslevel <= \"4\" ORDER BY groupname ASC, cutstart DESC";
    } // if($accesslevel == "5")
		$result="";
		$result=$dbh2->query($resquery);
		if($result->num_rows>0) {
			while($myrow=$result->fetch_assoc()) {
		$cutstart = $myrow['cutstart'];
		$cutend = $myrow['cutend'];
		$groupname = $myrow['groupname'];
		$confiaccesslevel = $myrow['accesslevel'];
		if($confiaccesslevel==5) {
		echo "<option value=\"$groupname,$cutstart,$cutend\">";
			include("mcryptdec.php");
			echo "$groupname";
			// include("mcryptenc.php");
		  echo ": $cutstart to $cutend</option>";
        // $confiaccesslevel11=$confiaccesslevel;
		} else if($confiaccesslevel<=4) {
		echo "<option value=\"$groupname,$cutstart,$cutend\">$groupname: $cutstart to $cutend</option>";
		} // if($confiaccesslevel==5 && $accesslevel==5)
			} // while($myrow=$result->fetch_assoc())
		} // if($result->num_rows>0)
     echo "</select>";
     echo "<br><button type=\"submit\" class='btn btn-primary'>Submit query</button>";
     echo "</td></tr>";
		echo "</form>";

     echo "<tr><td><iframe src=\"blank3.htm\" width=\"900\" height=\"500\" name=\"frame\"><iframe></td></tr>";

  } else {

    echo "<tr><td><font color=\"red\">Sorry, you don't have access to this page.</font></td></tr>";

  } // if(substr($level, -6, 1) == 1)

     echo "</table>";

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();

		/*
		echo "<option value=\"$groupname,$cutstart,$cutend\">";
		if($confiaccesslevel==5 && $accesslevel==5) {
			include("mcryptdec.php");
			echo "$groupname";
			include("mcryptenc.php");
		} else if($confiaccesslevel<=4) {
			echo "$groupname";
		} // if($confiaccesslevel==5 && $accesslevel==5)
		echo ": $cutstart to $cutend</option>";
		*/

?>
