<?php
include_once "connection.php";      

// connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $time_in = $_POST['time-in'];
    $time_out = $_POST['time-out'];
    $plate_num = $_POST['plate-num'];
    $total_fees = 500;  

    //insert form data into the database
    $stmt = $conn->prepare("INSERT INTO historydb (name, age, time_in, time_out, plate_num, total_fees) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissii", $name, $age, $time_in, $time_out, $plate_num, $total_fees);

    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
 
    // Close
    $stmt->close();
}

// Fetch all records from the database
$result = $conn->query("SELECT * FROM historydb");
// Closeconnection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slot Info</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="slot-info">
        <h2>Slot Information</h2>
   
        <form action="slotinfo.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter name" required>
            <br><br>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" placeholder="Enter age" required>
            <br><br>

            <label for="time-in">Time In:</label>
            <input type="time" id="time-in" name="time-in" required>
            <br><br>

            <label for="time-out">Time Out:</label>
            <input type="time" id="time-out" name="time-out" required>
            <br><br>

            <label for="plate-num">Plate Number:</label>
            <input type="text" id="plate-num" name="plate-num" placeholder="Enter plate number" required>
            <br><br>

            <label for="total-fees">Total Fees:</label>
            <p id="total-fees">500</p>
            <br><br>

            <button type="submit">Park</button>
        </form>
    </div>

    <div class="records">
        <h2>Records</h2>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Plate Number</th>
                <th>Total Fees</th>
            </tr>

            <?php
            // Check if records exist in the database
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['age']) . "</td>
                            <td>" . htmlspecialchars($row['time_in']) . "</td>
                            <td>" . htmlspecialchars($row['time_out']) . "</td>
                            <td>" . htmlspecialchars($row['plate_num']) . "</td>
                            <td>" . htmlspecialchars($row['total_fees']) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records</td></tr>";
            }
            ?>
        </table>
    </div>

    <script src="index.js"></script>

</body>
</html>
