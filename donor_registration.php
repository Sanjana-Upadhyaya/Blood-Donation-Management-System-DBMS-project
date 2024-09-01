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

    // Check if age is at least 18
    if ($age < 18) {
        echo "<script>alert('You must be at least 18 years old to register as a donor.'); window.location.href = 'donor_registration.html';</script>";
        exit();
    }

    // Check if email already exists
    $check_email_sql = "SELECT * FROM donor WHERE D_mail = ?";
    $stmt = $conn->prepare($check_email_sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        echo "<script>alert('Email address is already registered.'); window.location.href='donor_registration.html';</script>";
    } else {
        // Email does not exist, proceed with registration
        $sql = "INSERT INTO donor (Dname, D_age, D_type, StateName, City, Pincode, D_pno, D_mail, D_password) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sisssssss', $name, $age, $bloodType, $state, $city, $pincode, $phoneNumber, $email, $password);

        try {
            if ($stmt->execute()) {
                // Retrieve the newly inserted donor's ID
                $new_donor_id = $stmt->insert_id;

                // Store the new donor's ID and name in session variables
                $_SESSION["D_id"] = $new_donor_id;
                $_SESSION["name"] = $name;

                // Redirect to dashboard or any other page
                header("Location: donor_login.html");
                exit();
            } else {
                throw new Exception("Error inserting record: " . $stmt->error);
            }
        } catch (Exception $e) {
            echo "Could not register user: " . $e->getMessage();
        }
    }

    $stmt->close();
}

$conn->close();
?>
