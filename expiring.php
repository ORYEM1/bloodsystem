<?php
session_start();

// Display notification if a new blood inventory is added
if (isset($_SESSION['message'])) {
    echo "<div class='alert alert-success text-center'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch blood inventory data
$sql = "SELECT * FROM blood_inventory";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Blood Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        background-color: aquamarine;
    }
</style>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4" style="background-color: grey; color:brown;">Blood Inventory</h1>

        <!-- Blood Inventory Table -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Blood Type</th>
                    <th>Quantity (Units)</th>
                    <th>Expiration Date</th>
                    <th>Last Updated</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Get the current date
                    $current_date = date('Y-m-d H:i:s');

                    while ($row = $result->fetch_assoc()) {
                        $status = (strtotime($row["expiration_date"]) < strtotime($current_date)) ? "Expired" : "Active";

                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["blood_type"] . "</td>";
                        echo "<td>" . $row["quantity_units"] . "</td>";
                        echo "<td>" . $row["expiration_date"] . "</td>";
                        echo "<td>" . $row["last_updated"] . "</td>";
                        echo "<td>" . $status . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>