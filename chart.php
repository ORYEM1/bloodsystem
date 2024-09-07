<?php
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
$sql = "SELECT COUNT(*) as total_donors FROM donors";
$result = $conn->query($sql);

$total_donors = 100;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_donors = $row['total_donors'];
}

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
            background-color: aquamarine;
        }

        .chart-container {
            width: 50%;
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
        // Get the total number of donors from PHP
        const totalDonors = <?php echo $total_donors; ?>;

        // Setup chart data
        const data = {
            labels: ['Total Donors'],
            datasets: [{
                label: 'Number of Donors',
                data: [totalDonors],
                backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)'],
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