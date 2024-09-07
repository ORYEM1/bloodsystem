<?php
// Start session (if needed)
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
// Check if the donor is logged in if (!isset($_SESSION['donor_id'])) { echo
"Donor ID is not set. Redirecting to login page..."; header("Location:
login.html"); exit(); // Fetch the donor_id from the session $donor_id =
$_SESSION['donor_id']; // Fetch donor's name from the database $sql_donor_name =
"SELECT name FROM donors WHERE id = ?"; $stmt = $conn->prepare($sql_donor_name);
$stmt->bind_param("i", $donor_id); $stmt->execute();
$stmt->bind_result($donor_name); $stmt->fetch(); $stmt->close(); // Fetch
donation history $sql_donations = "SELECT * FROM donations WHERE donor_id = ?";
$stmt = $conn->prepare($sql_donations); $stmt->bind_param("i", $donor_id);
$stmt->execute(); $result_donations = $stmt->get_result(); // Fetch
notifications $sql_notifications = "SELECT * FROM notifications WHERE donor_id =
?"; $stmt = $conn->prepare($sql_notifications); $stmt->bind_param("i",
$donor_id); $stmt->execute(); $result_notifications = $stmt->get_result(); //
Fetch other donors $sql_donors = "SELECT name, blood_type FROM donors";
$result_donors = $conn->query($sql_donors); // Close connection $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Donor Dashboard</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      /* Global Styles */
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
      }

      /* Top Navigation Bar */
      .navbar {
        background-color: #4caf50;
        color: white;
        padding: 15px;
        text-align: center;
        font-size: 20px;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
      }

      /* Sidebar Menu */
      .sidebar {
        height: 100%;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #333;
        padding-top: 60px;
        /* Add 60px top padding to avoid overlap with navbar */
        overflow-x: hidden;
      }

      .sidebar a {
        padding: 15px 20px;
        text-decoration: none;
        font-size: 18px;
        color: white;
        display: block;
        transition: 0.3s;
      }

      .sidebar a:hover {
        background-color: #575757;
      }

      /* Main Content */
      .main-content {
        margin-left: 260px;
        /* Same as the width of the sidebar + some gap */
        padding: 20px;
        padding-top: 80px;
        /* Add 80px top padding to avoid overlap with navbar */
      }

      h1 {
        font-size: 24px;
        color: #333;
      }

      /* Responsive Design */
      @media screen and (max-width: 768px) {
        .sidebar {
          width: 100%;
          height: auto;
          position: relative;
        }

        .sidebar a {
          float: left;
          padding: 15px;
        }

        .main-content {
          margin-left: 0;
        }
      }

      @media screen and (max-width: 400px) {
        .sidebar a {
          text-align: center;
          float: none;
        }
      }
    </style>
  </head>

  <body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Donor Dashboard</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#history">Donation History</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#notifications">Notifications</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#messages">Messages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#appointments">Appointments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#donors">View Donors</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#account">Account Settings</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Welcome Message -->
      <h1>
        Welcome,
        <?php echo htmlspecialchars($donor_name); ?>!
      </h1>

      <!-- Donation History Section -->
      <div id="history" class="container mt-5">
        <h2>Donation History</h2>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Date</th>
              <th>Blood Type</th>
              <th>Units Donated</th>
              <th>Location</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result_donations->fetch_assoc()): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['donation_date']); ?></td>
              <td><?php echo htmlspecialchars($row['blood_type']); ?></td>
              <td><?php echo htmlspecialchars($row['units_donated']); ?></td>
              <td><?php echo htmlspecialchars($row['location']); ?></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>

      <!-- Notifications Section -->
      <div id="notifications" class="container mt-5">
        <h2>Notifications</h2>
        <div class="alert alert-info" role="alert">
          <?php while ($row = $result_notifications->fetch_assoc()): ?>
          <p>
            <?php echo htmlspecialchars($row['message']); ?>
            -
            <?php echo htmlspecialchars($row['date']); ?>
          </p>
          <?php endwhile; ?>
        </div>
      </div>

      <!-- Messages Section -->
      <div id="messages" class="container mt-5">
        <h2>Send Message to Admin</h2>
        <form action="message.php" method="POST">
          <div class="form-group">
            <label for="message">Message</label>
            <textarea
              class="form-control"
              id="message"
              name="message"
              rows="3"
              required
            ></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
      </div>

      <!-- Appointments Section -->
      <div id="appointments" class="container mt-5">
        <h2>Make an Appointment</h2>
        <form action="schedule_appointment.php" method="POST">
          <div class="form-group">
            <label for="appointment_date">Appointment Date</label>
            <input
              type="date"
              class="form-control"
              id="appointment_date"
              name="appointment_date"
              required
            />
          </div>
          <div class="form-group">
            <label for="doctor">Select Doctor</label>
            <select class="form-control" id="doctor" name="doctor" required>
              <!-- Fetch and display doctors from the database -->
            </select>
          </div>
          <button type="submit" class="btn btn-primary">
            Schedule Appointment
          </button>
        </form>
      </div>

      <!-- View Donors Section -->
      <div id="donors" class="container mt-5">
        <h2>Other Donors</h2>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Blood Type</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result_donors->fetch_assoc()): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['name']); ?></td>
              <td><?php echo htmlspecialchars($row['blood_type']); ?></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>

      <!-- Account Settings Section -->
      <div id="account" class="container mt-5">
        <h2>Account Settings</h2>
        <p>Change your password or update contact information here.</p>
        <!-- Account settings form -->
      </div>
    </div>
  </body>
</html>
