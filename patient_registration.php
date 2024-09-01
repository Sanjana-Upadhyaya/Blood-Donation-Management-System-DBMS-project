<?php
session_start();
include("dbms.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $bloodType = $_POST["bloodType"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $pincode = $_POST["pincode"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $check_email_sql = "SELECT * FROM patient WHERE P_email = ?";
    $stmt = $conn->prepare($check_email_sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists, display an error message
        echo "<script>alert('Email already registered. Please use a different email.'); window.location.href = 'patient_registration.html';</script>";
    } else {
        // Insert the new patient into the database
        $sql = "INSERT INTO patient (Pname, P_age, P_type, State, City, Pincode, P_phno, P_email, P_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sisssssss', $name, $age, $bloodType, $state, $city, $pincode, $phoneNumber, $email, $password);

        if ($stmt->execute()) {
            // Redirect to the patient login page or display a success message
            header("Location: patient_login.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>
