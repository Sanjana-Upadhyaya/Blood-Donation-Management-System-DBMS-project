<?php
session_start();

include("dbms.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // SQL query to check if the email and password match
    $sql = "SELECT * FROM patient WHERE P_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Email and password match, redirect to a dashboard or homepage
        $row=$result->fetch_assoc();
        echo $row["P_email"];
        $hashed_password=$row["P_password"];
        $name=$row["Pname"];
        $id=$row["P_id"];

        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session and redirect
            $_SESSION["name"] = $name;
            $_SESSION["id"] = $id;
            header("Location: patient_dashboard.php"); // Redirect to dashboard.php or any other page
            exit();
        } else {
            // Password is incorrect, display error message
            echo "Invalid email or password.";
        }
    }    
    else{
         // Email does not exist, display error message
            echo "Invalid email or password.";
        }    
}
mysqli_close($conn);
?>