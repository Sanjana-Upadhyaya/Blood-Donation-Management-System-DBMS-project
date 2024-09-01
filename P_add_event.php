<?php
session_start();
include("dbms.php");

if (!isset($_SESSION["id"])) {
    header("Location: patient_login.html");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $patient_id = $_SESSION["id"];
    // Get form data
    $title = $_POST['title'];
    $age = $_POST['age'];
    $date = $_POST['date'];
    $city = $_POST['city'];
    $state = $_POST['state'];

    // Insert the new order into the database
    $sql = "INSERT INTO patientOrder (P_id, P_age, Order_date, City, State, title) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param('isisss', $patient_id, $age, $date, $city, $state, $title);

    if ($stmt) {
        $stmt->bind_param('iissss', $patient_id, $age, $date, $city, $state, $title);

        if ($stmt->execute()) {
            // Redirect to the patient dashboard or display a success message
            header("Location: patient_dashboard.php?success=1");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}else {
    echo "Invalid request method.";
}
?>
