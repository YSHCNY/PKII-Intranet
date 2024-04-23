<?php

	// prepare variables
	$download_speed = $_REQUEST['download'];
	$upload_speed = $_REQUEST['upload'];
	$latency = $_REQUEST['latency'];
	$ip_address = $_SERVER['REMOTE_ADDR'];
	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	// prepare display
	echo "<html><head><title>PKII speedtest</title></html>";
	echo "<body>";
	echo "<table class=\"fin\">";
	echo "<tr><th align=\"right\">IP</th><td>$ip_address</td></tr>";
	echo "<tr><th align=\"right\">User agent</th><td>$user_agent</td></tr>";
	echo "<tr><th align=\"right\">down</th><td>$download_speed</td></tr>";
	echo "<tr><th align=\"right\">up</th><td>$upload_speed</td></tr>";
	echo "<tr><th align=\"right\">latency</th><td>$latency</td></tr>";
	echo "</table>";
	echo "</body>";
	echo "</html>";

?>
