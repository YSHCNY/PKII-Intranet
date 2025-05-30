<?php
session_start();

// Toggle dark mode
if (!isset($_SESSION['drkmd']) || $_SESSION['drkmd'] == 0) {
    $_SESSION['drkmd'] = 1;
} else {
    $_SESSION['drkmd'] = 0;
}

// Return the new value as a response
echo $_SESSION['drkmd'];
?>
