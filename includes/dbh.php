<?php

require 'config.inc';

$dbh = new mysqli("$hostname", "$dbusername", "$dbuserpass", "$dbname") or die ("Unable to connect to database");

if ($dbh -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

?>
