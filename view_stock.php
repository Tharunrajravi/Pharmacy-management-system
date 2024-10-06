<?php
// Database connection settings
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "pharmacy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch stock levels
$sql = "SELECT * FROM Medicines";
$result = $conn->query($sql);

echo "<h2>Stock Levels</h2>";
echo "<table border='1'>
        <tr>
            <th>Medicine Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Expiration Date</th>
        </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['name'] . "</td>
                <td>" . $row['category'] . "</td>
                <td>" . $row['quantity'] . "</td>
                <td>$" . $row['price'] . "</td>
                <td>" . $row['expiration_date'] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No medicines found.</td></tr>";
}

echo "</table>";
$conn->close();
?>
