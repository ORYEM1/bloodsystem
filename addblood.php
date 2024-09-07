<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blood_type = $_POST['blood_type'];
    $quantity_units = $_POST['quantity_units'];
    $expiration_date = $_POST['expiration_date'];
    $last_updated = date("Y-m-d");


    // Insert the data into the blood_inventory table
    $sql = "INSERT INTO blood_inventory (blood_type, quantity_units, expiration_date, last_updated) 
            VALUES ('$blood_type', '$quantity_units', '$expiration_date', '$last_updated')";



    if ($conn->query($sql) === TRUE) {
        // Notify admin (can be email, SMS, or just a session message)
        $_SESSION['message'] = "New blood inventory added: $blood_type, $quantity_units units.";

        // Redirect to admin dashboard or refresh the page
        header("Location: admindashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Blood Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        background-color: aquamarine;

    }
</style>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4" style="background-color: brown; color:aquamarine;">Add New Blood Inventory</h1>

        <!-- Add Blood Inventory Form -->
        <form action="adding.php" method="POST" class="mb-5">
            <div class="row mb-3">
                <div class="col">
                    <label for="blood_type" class="form-label " style="font-size: larger; font-weight:500">Blood Type</label> <br>
                    <select id="blood_type" name="blood_type" required>
                        <option value="A+">A+</option>

                        <option value="B+">B+</option>

                        <option value="AB+">AB+</option>

                        <option value="O+">O+</option>


                    </select>
                </div>
                <div class="col">
                    <label for="quantity_units" class="form-label" style="font-size: larger; font-weight:500;">Quantity (Units)</label>
                    <input type="number" class="form-control" id="quantity_units" name="quantity_units" required step="0.01" min="0" oninput="checkValue(this)">
                </div>
                <div class="col">
                    <label for="expiration_date" class="form-label" style="font-size: larger; font-weight:500">Expiration Date</label>
                    <input type="date" class="form-control" id="expiration_date" name="expiration_date" required min="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: larger; font-weight:500">Add Blood Inventory</button>
        </form>
    </div>
    <script>
        function checkValue(input) {
            if (input.value < 0) {
                input.value = 0;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>