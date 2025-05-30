<?php
//
// mchgpass2.php
// fr: vc/index.php
//page 411

$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';

$username = trim((isset($_POST['username'])) ? $_POST['username'] :'');
$password = trim((isset($_POST['password'])) ? $_POST['password'] :'');
$newpass = trim((isset($_POST['newpass'])) ? $_POST['newpass'] :'');
$cnewpass = trim((isset($_POST['cnewpass'])) ? $_POST['cnewpass'] :'');

$pwminlength=6;

?>

	
<!--	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<?php echo "<p>testvar lst:$lst,lid:$loginid,sess:$session,pg:$page<br>usrnm:$username,pw:$password,npw:$newpass,cnpw:$cnewpass</p>"; ?>
		</div>
		<div class="col-md-1"></div>
	</div> -->
<?php
// check if loginid and username is not null then proceed
if($loginid!='' && $username!='') {
	// check if current password, new password and confirm new password are not blank
	if($password!='' && $newpass!='' && $cnewpass!='') {
		// query password if correct
		include '../m/qrycpasswd.php';
		if($found11==1) {
			// check if newpass=cnewpass
			if($newpass==$cnewpass) {
				// password validations
		if(strlen($cnewpass) <= $pwminlength) {
        $passwordErr = "Your Password Must Contain At Least 7 Characters!";
	$header = "!!!";
	$bgclass = "bg-danger";
	$clstxtclr="text-danger";
	$h4txtdisp=$passwordErr;
	$frmact="index.php?lst=1&lid=$loginid&sess=$session&p=41";
	$frmnm="mchgpass";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-outline-light border border-white py-4 px-5";
	$btnnm="Back";
	include 'vnotif.php';
    } elseif(!preg_match("#[0-9]+#",$cnewpass)) {
		$header = "!!!";
        $passwordErr = "Your Password Must Contain At Least 1 Number!";
	$bgclass = "bg-warning";
	$clstxtclr="text-warning";
	$h4txtdisp=$passwordErr;
	$frmact="index.php?lst=1&lid=$loginid&sess=$session&p=41";
	$frmnm="mchgpass";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-outline-light border border-white py-4 px-5";
	$btnnm="Back";
	include 'vnotif.php';
    } elseif(!preg_match("#[A-Z]+#",$cnewpass) && !preg_match("#[a-z]+#",$cnewpass)) {
        $passwordErr = "Your Password Must Contain At Least 1 Letter!";
		$header = "!!!";
	$bgclass = "bg-warning";
	$clstxtclr="text-warning";
	$h4txtdisp=$passwordErr;
	$frmact="index.php?lst=1&lid=$loginid&sess=$session&p=41";
	$frmnm="mchgpass";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-outline-light border border-white py-4 px-5";
	$btnnm="Back";
	include 'vnotif.php';
/*    } elseif(!preg_match("#[a-z]+#",$cnewpass)) {
        $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
	$clstxtclr="text-danger";
	$h4txtdisp=$passwordErr;
	$frmact="index.php?lst=1&lid=$loginid&sess=$session&p=41";
	$frmnm="mchgpass";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-primary";
	$btnnm="Back";
	include 'vnotif.php'; */
    } else {
        // $cpasswordErr = "Please Check You've Entered Or Confirmed Your Password!";
				// proceed update query
				include '../m/qryupdatepwd.php';
				// if update query is successful, display success notification
				if($result12 && $result15) {
					// display success and logout button
					$header = "Success!";
	$bgclass = "bg-success";
	$clstxtclr="text-success";
	$h4txtdisp="Password changed! You need to logout, then login again with your new password.";
	$frmact="logout.php?lst=1&lid=$loginid&sess=$session";
	$frmnm="logout";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-outline-light border border-white py-4 px-5";
	$btnnm="Logout";
	include 'vnotif.php';
					// log
					          // Format the date (YYYY-MM-DD)
				
					$logdetails="Password changed for user:$username with loginid:$loginid";
					include '../m/qryinslog.php';
				
					date_default_timezone_set('Asia/Manila');  // Set the timezone to Philippines (Manila)
					$currentDate = date('Y-m-d');     
					$tomaster = 'support@philkoei.com.ph';
					// $test = 'canoy.yoshiyuki@gmail.com';
					
					// Include file if necessary
					// include '../m/qryemlsender.php';
					
					$from = $tomaster;
					$tofinal = $email10.",".$tomaster;
					$to = $tofinal; // Assuming you want to send the email to the test address
					$subject = 'Hello '. $username .'! Change of Intranet Password' ;
					
					$message = "
					<html>
					<head>
						<style>
						
						body{
							font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
						}/* Inline CSS */
							span {
				color: #354E7E;
				
				}
				
				a{
					color: #1b469c;
				}
				
				.container{
					position: absolute;
					text-align: center;
					top: 50%;
					left: 50%;
					transform: translate(-50%, -50%);
					border: 1px solid #354E7E ;
					padding: 5px 40px 5px 40px ;
				}
				</style>
						</head>
							<body>
								<div class='container'> 
							<h1>Hello <span>$username,</span></h1>
							<h2>You updated your password to <span>$newpass</span> on <span><em>$currentDate</span></em>.</h2>
							<h3>From <span>IT Department</span></h3>
							<p>If you forgot consider visiting this email again and or contact IT department via</p>
							<p>email directly at <a href='mailto:support@philkoei.com.ph'>support@philkoei.com.ph</a></p>
						</div>
							</body>
				</html>
					";
					
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$headers .= "From: $from" . "\r\n";
					
					// Send email
					$ok = mail($to, $subject, $message, $headers);
					
					if ($ok) {
				
					} else {
						echo '<h4 class="modal-title" id="myModalLabel"><font color="red">Error in sending e-mail</font></h4>';
					} 
				
					
				} else {
					// display update query error and contact sysad and display back to home button
					$header = "ERRRR505";
	$bgclass = "bg-black";
	$clstxtclr="text-danger";
	$h4txtdisp="Error in changing password. Please contact your IT administrator.";
	$frmact="index.php?lst=1&lid=$loginid&sess=$session&p=41";
	$frmnm="home";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-outline-light border border-white py-4 px-5";
	$btnnm="Back";
	include 'vnotif.php';
				} // if-else
    } // if-else password validations
			} else {
				// display new passwords do not match error
				$header = "!!!";
	$bgclass = "bg-warning";
	$clstxtclr="text-warning";
	$h4txtdisp="New password entered, do not match.";
	$frmact="index.php?lst=1&lid=$loginid&sess=$session&p=41";
	$frmnm="home";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-outline-light border border-white py-4 px-5";
	$btnnm="Back";
	include 'vnotif.php';
			} // if-else
		} else {
			// display password error
			$header = "ERRR";
	$bgclass = "bg-danger";
	$clstxtclr="text-danger";
	$h4txtdisp="Error in current password. Please try again.";
	$frmact="index.php?lst=1&lid=$loginid&sess=$session&p=41";
	$frmnm="home";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-outline-light border border-white py-4 px-5";
	$btnnm="Back";
	include 'vnotif.php';
		} // if-else
	} else {
		// display blank form error and back to chg password page 41
		$header = "404";
	$bgclass = "bg-black";
	$clstxtclr="text-dark";
	$h4txtdisp="Error: blank input fields. Please try again.";
	$frmact="index.php?lst=1&lid=$loginid&sess=$session&p=41";
	$frmnm="home";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-outline-light border border-white py-4 px-5";
	$btnnm="Back";
	include 'vnotif.php';
	} // if
} else {
	// display error and display redirect button to home
	$header = "???";
	$bgclass = "bg-warning";
	$clstxtclr="text-warning";
	$h4txtdisp="Invalid Username or LoginID";
	$frmact="index.php?lst=1&lid=$loginid&sess=$session&p=41";
	$frmnm="home";
	$frmmtd="POST";
	$btntyp="submit";
	$btncls="btn btn-outline-light border border-white py-4 px-5";
	$btnnm="back to Home";
	include 'vnotif.php';
} // if
?>
