<?php
// Get the data from the JavaScript fetch request
$data = json_decode(file_get_contents('php://input'), true);

$enteredPin = $data['pin']; // The PIN entered by the user
$storedHash = $data['storedHash']; // The hash from the database

// Log entered PIN and stored hash for debugging
error_log("Entered PIN: " . $enteredPin);
error_log("Stored Hash: " . $storedHash);

// Verify the entered PIN using crypt() against the stored hash
if (crypt($enteredPin, $storedHash) === $storedHash) {
    // PIN matches the stored hash
    echo json_encode(['valid' => true]);
} else {
    // PIN does not match the stored hash
    echo json_encode(['valid' => false]);
}
?>
