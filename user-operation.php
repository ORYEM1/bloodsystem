<?php

// Database connection settings
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "your_database_name"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle different operations
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == "fetch") {
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        $output = '';

        while ($row = $result->fetch_assoc()) {
            $output .= "
            <tr>
                <td class='people'>
                    <img src='c:\Users\rtr\Pictures\IMG-20240222-WA0068.jpg' alt='' />
                    <div class='people-de'>
                        <h5>{$row['name']}</h5>
                        <p>{$row['contact']}</p>
                    </div>
                </td>
                <td class='people-des'>
                    <h5>{$row['title']}</h5>
                </td>
                <td>{$row['contact']}</td>
                <td>{$row['blood_type']}</td>
                <td>{$row['amount']}</td>
                <td>{$row['date']}</td>
                <td>{$row['status']}</td>
                <td class='edit'><button onclick='editUser({$row['id']})'>Edit</button></td>
                <td class='delete'><button onclick='deleteUser({$row['id']})'>Delete</button></td>
            </tr>";
        }

        echo $output;
    } elseif ($action == "add") {
        $name = $_POST['name'];
        $title = $_POST['title'];
        $contact = $_POST['contact'];
        $blood_type = $_POST['blood_type'];
        $amount = $_POST['amount'];
        $date = $_POST['date'];
        $status = $_POST['status'];

        $sql = "INSERT INTO users (name, title, contact, blood_type, amount, date, status) VALUES ('$name', '$title', '$contact', '$blood_type', '$amount', '$date', '$status')";
        $conn->query($sql);
        echo "User added successfully";
    } elseif ($action == "delete") {
        $id = $_POST['id'];
        $sql = "DELETE FROM users WHERE id=$id";
        $conn->query($sql);
        echo "User deleted successfully";
    } elseif ($action == "edit") {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $title = $_POST['title'];
        $contact = $_POST['contact'];
        $blood_type = $_POST['blood_type'];
        $amount = $_POST['amount'];
        $date = $_POST['date'];
        $status = $_POST['status'];

        $sql = "UPDATE users SET name='$name', title='$title', contact='$contact', blood_type='$blood_type', amount='$amount', date='$date', status='$status' WHERE id=$id";
        $conn->query($sql);
        echo "User updated successfully";
    }
}

$conn->close();
