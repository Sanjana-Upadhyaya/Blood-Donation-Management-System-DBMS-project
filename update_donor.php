<?php
session_start();
include("dbms.php");

if (!isset($_SESSION["id"])) {
    header("Location: donor_login.html");
    exit();
}

$donor_id = $_SESSION["id"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);

    // Update donor info in the database
    $sql = "UPDATE donor SET Dname = ?, D_mail = ?, D_pno = ? WHERE D_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $name, $email, $phone, $donor_id);

    if ($stmt->execute()) {
        header("Location: donor_dashboard.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
