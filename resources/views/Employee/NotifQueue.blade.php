<?php
// Establish a database connection
$mysqli = new mysqli("127.0.0.1", "root", "", "demo1");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get the entered queue number from the POST request
$enteredQueue = $_POST['enteredQueue'];

// Query the database to check if the entered queue number exists in the registrar table
$query = "SELECT * FROM registrar WHERE reg_generate = '$enteredQueue'";
$result = $mysqli->query($query);

$response = array();

if ($result && $result->num_rows > 0) {
    // Queue number exists in the registrar table
    $response['match'] = true;
} else {
    // Queue number does not exist in the registrar table
    $response['match'] = false;
}

// Close the database connection
$mysqli->close();

// Send the JSON response back to the client
header('Content-Type: application/json');
echo json_encode($response);
?>
