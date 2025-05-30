<?php
session_start(); // Start the session to access session variables

if (isset($_POST['conns'])) {
    $conns = intval($_POST['conns']); // Get the conns value from POST and convert it to an integer
    $_SESSION['conns'] = $conns; // Store the value in the session
    echo "Conns updated to $conns"; // Optional: Response message for debugging
}
?>