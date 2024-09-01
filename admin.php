<?php
include("dbms.php");

$data = [];

// Predefined list of all possible blood groups
$allBloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

// Fetch donors
$sql = "SELECT Dname AS name, D_age AS age, D_type AS bloodGroup, City, StateName AS state FROM donor";
$result = $conn->query($sql);

$data['donors'] = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data['donors'][] = $row;
    }
}

// Fetch patients
$sql = "SELECT Pname AS name, P_age AS age, P_type AS bloodGroup, City, State AS state FROM patient";
$result = $conn->query($sql);

$data['patients'] = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data['patients'][] = $row;
    }
}

// Fetch blood group count for donors
$sql = "SELECT D_type AS bloodGroup, COUNT(*) AS count FROM donor GROUP BY D_type";
$result = $conn->query($sql);

$donorBloodCounts = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $donorBloodCounts[$row['bloodGroup']] = $row['count'];
    }
}

// Fetch blood group count for patients
$sql = "SELECT P_type AS bloodGroup, COUNT(*) AS count FROM patient GROUP BY P_type";
$result = $conn->query($sql);

$patientBloodCounts = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $patientBloodCounts[$row['bloodGroup']] = $row['count'];
    }
}

// Ensure all blood groups are included with count 0 if not present
foreach ($allBloodGroups as $bloodGroup) {
    if (!isset($donorBloodCounts[$bloodGroup])) {
        $donorBloodCounts[$bloodGroup] = 0;
    }
    if (!isset($patientBloodCounts[$bloodGroup])) {
        $patientBloodCounts[$bloodGroup] = 0;
    }
}

// Prepare the final data arrays
$data['donorBloodCounts'] = [];
foreach ($donorBloodCounts as $bloodGroup => $count) {
    $data['donorBloodCounts'][] = ['bloodGroup' => $bloodGroup, 'count' => $count];
}

$data['patientBloodCounts'] = [];
foreach ($patientBloodCounts as $bloodGroup => $count) {
    $data['patientBloodCounts'][] = ['bloodGroup' => $bloodGroup, 'count' => $count];
}

header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
