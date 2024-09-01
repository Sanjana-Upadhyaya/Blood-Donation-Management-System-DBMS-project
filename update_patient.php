<?php
session_start();
include("dbms.php");

if (!isset($_SESSION["id"])) {
    header("Location: patient_login.html");
    exit();
}

$patient_id = $_SESSION["id"];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Update patient info
$sql = "UPDATE patient SET Pname = ?, P_email = ?, P_phno = ? WHERE P_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssi', $name, $email, $phone, $patient_id);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: patient_dashboard.php");
exit();
?>
