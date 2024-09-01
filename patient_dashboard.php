<?php
session_start();
include("dbms.php");

if (!isset($_SESSION["id"])) {
    header("Location: patient_login.html");
    exit();
}

$patient_id = $_SESSION["id"];

// Fetch patient info
$sql = "SELECT Pname, P_email, P_phno, State, City FROM patient WHERE P_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $patient_id);
$stmt->execute();
$result = $stmt->get_result();
$patientInfo = $result->fetch_assoc();
$stmt->close();

// Fetch patient history
$sql = "SELECT P_age, Order_date, City, State FROM patientOrder WHERE P_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $patient_id);
$stmt->execute();
$patientHistory = $stmt->get_result();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient Dashboard</title>
  <link rel="stylesheet" href="patient_dashboard.css">
</head>
<body>
  <header>
    <h1>Patient Dashboard</h1>
    <p>Welcome, <?php echo htmlspecialchars($patientInfo['Pname']); ?>!</p>
    <form action="logout.php" method="POST" style="display:inline;">
      <button type="submit">Logout</button>
    </form>
  </header>

  <nav>
    <ul>
      <li><a href="#patient-info">Patient Information</a></li>
      <li><a href="#patient-history">Patient History</a></li>
      <li><a href="#order-blood">Order Blood</a></li>
      <li><a href="#edit-info">Edit Information</a></li>
    </ul>
  </nav>

  <section id="patient-info">
    <h2>Patient Information</h2>
    <div id="patient-details">
      <p><strong>Name:</strong> <?php echo htmlspecialchars($patientInfo['Pname']); ?></p>
      <p><strong>Email:</strong> <?php echo htmlspecialchars($patientInfo['P_email']); ?></p>
      <p><strong>Phone:</strong> <?php echo htmlspecialchars($patientInfo['P_phno']); ?></p>
      <p><strong>City:</strong> <?php echo htmlspecialchars($patientInfo['City']); ?></p>
      <p><strong>State:</strong> <?php echo htmlspecialchars($patientInfo['State']); ?></p>
    </div>
  </section>

  <section id="patient-history">
    <h2>Patient History</h2>
    <table id="history-table">
      <thead>
        <tr>
          <th>Age</th>
          <th>Date of Order</th>
          <th>Recieve On</th>
          <th>City</th>
          <th>State</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($patientHistory->num_rows > 0): ?>
          <?php while ($row = $patientHistory->fetch_assoc()): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['P_age']); ?></td>
              <td><?php echo htmlspecialchars($row['Order_date']); ?></td>
              <td>
                <?php
                $orderDate = new DateTime($row['Order_date']);
                $orderDate->modify('+5 days');
                echo htmlspecialchars($orderDate->format('Y-m-d'));
                ?>
              </td>
              <td><?php echo htmlspecialchars($row['City']); ?></td>
              <td><?php echo htmlspecialchars($row['State']); ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="5">No history</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </section>

  <section id="order-blood">
    <h2>Order Blood</h2>
    <form id="schedule-form" action="P_add_event.php" method="POST">
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" required>

      <label for="age">Age:</label>
      <input type="number" id="age" name="age" required>
      
      <label for="date">Date of Order:</label>
      <input type="date" id="date" name="date" required>
      
      <label for="city">City:</label>
      <input type="text" id="city" name="city" required>
      
      <label for="state">State:</label>
      <input type="text" id="state" name="state" required>
      
      <button type="submit">Confirm Order</button>
    </form>
  </section>

  <section id="edit-info">
    <h2>Edit Information</h2>
    <form id="edit-form" action="update_patient.php" method="POST">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($patientInfo['Pname']); ?>" required>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($patientInfo['P_email']); ?>" required>
      
      <label for="phone">Phone:</label>
      <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($patientInfo['P_phno']); ?>" required>
      
      <button type="submit">Update Information</button>
    </form>
  </section>

  <footer>
    <p>&copy; 2024 Blood Donation Management System</p>
  </footer>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateInput = document.getElementById('date');
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    });
    </script>  
</body>
</html>
