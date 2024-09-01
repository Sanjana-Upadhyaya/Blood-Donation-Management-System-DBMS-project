<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $bloodType = $_POST["bloodType"];
    $quantity = $_POST["quantity"];
    $urgent = isset($_POST["urgent"]) ? 'Yes' : 'No';

    // TODO: Process the form data (e.g., save it to a database)
    
    // Example response (you can customize it based on your requirements)
    $response = array('success' => true, 'message' => 'Request submitted successfully');
    echo json_encode($response);
} else {
    // Handle invalid request method
    $response = array('success' => false, 'message' => 'Invalid request method');
    echo json_encode($response);
}
?>
