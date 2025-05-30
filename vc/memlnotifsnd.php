<?php
// set get vars
$loginstat = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = trim((isset($_GET['sess'])) ? $_GET['sess'] :'');
$page = trim((isset($_GET['p'])) ? $_GET['p'] :'');

// set post vars
$from = $_POST['emlsender'];
$to = $_POST['emlrecipient'];
$subject = $_POST['emlsubject'];
$message = $_POST['emlmessage'];

$ok = mail("$to", "$subject", "$message", "From: $from");

if($ok) {
			echo '<h4 class="modal-title" id="myModalLabel"><font color="green">E-Mail sent!</font></h4>';
} else {
			echo '<h4 class="modal-title" id="myModalLabel"><font color="red">Error in sending e-mail</font></h4>';
} 
?>

