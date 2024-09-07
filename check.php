<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Fetch total number of donors
$sql_total = "SELECT COUNT(*) as total_donors FROM donors";
$result_total = $conn->query($sql_total);

$total_donors = 100;
if ($result_total->num_rows > 0) {
    $row_total = $result_total->fetch_assoc();
    $total_donors = $row_total['total_donors'];
}

// Fetch number of donors added in the past week
$one_week_ago = date("Y-m-d", strtotime("-1 week"));
$sql_weekly = "SELECT COUNT(*) as weekly_donors FROM donors WHERE registration_date >= '$one_week_ago'";
$result_weekly = $conn->query($sql_weekly);

$weekly_donors = 100;
if ($result_weekly->num_rows > 0) {
    $row_weekly = $result_weekly->fetch_assoc();
    $weekly_donors = $row_weekly['weekly_donors'];
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: whitesmoke;
        }

        .chart-container {
            width: 70%;
            margin: auto;
            padding-top: 50px;
        }
    </style>
</head>

<body>

    <div class="chart-container">
        <canvas id="donorChart"></canvas>
    </div>

    <script>
        // Get the total number of donors and weekly donors from PHP
        const totalDonors = <?php echo json_encode($total_donors); ?>;
        const weeklyDonors = <?php echo json_encode($weekly_donors); ?>;

        // Setup chart data
        const data = {
            labels: ['Total Donors', 'Donors This Week'],
            datasets: [{
                label: 'Number of Donors',
                data: [totalDonors, weeklyDonors],
                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        };

        // Configurations for the chart
        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Render the chart
        const donorChart = new Chart(
            document.getElementById('donorChart'),
            config
        );
    </script>

</body>

</html>