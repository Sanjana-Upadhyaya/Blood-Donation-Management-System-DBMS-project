<?php
session_start();
include("dbms.php");

if (!isset($_SESSION["id"])) {
    header("Location: donor_login.html");
    exit();
}

$donor_id = $_SESSION["id"];

// Fetch donor info
$sql = "SELECT Dname, D_mail, D_pno, StateName, City FROM donor WHERE D_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $donor_id);
$stmt->execute();
$result = $stmt->get_result();
$donorInfo = $result->fetch_assoc();
$stmt->close();

// Fetch donation history
$sql = "SELECT Donation_date, City, StateName FROM donation_events WHERE D_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $donor_id);
$stmt->execute();
$donationHistory = $stmt->get_result();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donor Dashboard</title>
  <link rel="stylesheet" href="donor_dashboard.css">
</head>
<body>
  <header>
    <h1>Donor Dashboard</h1>
    <p>Welcome, <?php echo htmlspecialchars($donorInfo['Dname']); ?>!</p>
    <form action="logout.php" method="POST" style="display:inline;">
      <button type="submit">Logout</button>
    </form>
  </header>

  <nav>
    <ul>
      <li><a href="#donor-info">Donor Information</a></li>
      <li><a href="#donation-history">Donation History</a></li>
      <li><a href="#schedule-donation">Schedule Donation</a></li>
      <li><a href="#edit-info">Edit Information</a></li>
    </ul>
  </nav>

  <section id="donor-info">
    <h2>Donor Information</h2>
    <div id="donor-details">
      <p><strong>Name:</strong> <?php echo htmlspecialchars($donorInfo['Dname']); ?></p>
      <p><strong>Email:</strong> <?php echo htmlspecialchars($donorInfo['D_mail']); ?></p>
      <p><strong>Phone:</strong> <?php echo htmlspecialchars($donorInfo['D_pno']); ?></p>
      <p><strong>City:</strong> <?php echo htmlspecialchars($donorInfo['City']); ?></p>
      <p><strong>State:</strong> <?php echo htmlspecialchars($donorInfo['StateName']); ?></p>
    </div>
  </section>

  <section id="donation-history">
    <h2>Donation History</h2>
    <table id="history-table">
      <thead>
        <tr>
          <th>Date</th>
          <th>City</th>
          <th>State</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($donationHistory->num_rows > 0): ?>
          <?php while ($row = $donationHistory->fetch_assoc()): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['Donation_date']); ?></td>
              <td><?php echo htmlspecialchars($row['City']); ?></td>
              <td><?php echo htmlspecialchars($row['StateName']); ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="3">No history</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </section>

  <section id="schedule-donation">
    <h2>Schedule Donation</h2>
    <form id="schedule-form" action="add_event.php" method="POST">
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" required>
      
      <label for="date">Date of Donation:</label>
      <input type="date" id="date" name="date" required>
      
      <label for="city">City:</label>
      <input type="text" id="city" name="city" required>
      
      <label for="state">State:</label>
      <input type="text" id="state" name="state" required>
      
      <button type="submit">Schedule Donation</button>
    </form>
  </section>

  <section id="edit-info">
    <h2>Edit Information</h2>
    <form id="edit-form" action="update_donor.php" method="POST">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($donorInfo['Dname']); ?>" required>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($donorInfo['D_mail']); ?>" required>
      
      <label for="phone">Phone:</label>
      <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($donorInfo['D_pno']); ?>" required>
      
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
