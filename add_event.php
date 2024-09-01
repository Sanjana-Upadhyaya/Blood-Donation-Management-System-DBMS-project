<?php
session_start();
include("dbms.php");

if (!isset($_SESSION["id"])) {
    header("Location: donor_login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donor_id = $_SESSION["id"];
    $title = $_POST["title"];
    $date = $_POST["date"];
    $city = $_POST["city"];
    $state = $_POST["state"];

    // Server-side validation for date
    $currentDate = date("Y-m-d");
    if ($date < $currentDate) {
        // Redirect back with an error message
        header("Location: donor_dashboard.php?error=date");
        exit();
    }

    // Insert event into the database
    $sql = "INSERT INTO donation_events (D_id, title, Donation_date, City, StateName) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('issss', $donor_id, $title, $date, $city, $state);
    if ($stmt->execute()) {
        // Redirect to the dashboard with a success message
        header("Location: donor_dashboard.php?success=1");
    } else {
        // Redirect back with an error message
        header("Location: donor_dashboard.php?error=db");
    }
    $stmt->close();
    $conn->close();
}
?>
