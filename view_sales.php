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

// Fetch sales data along with customer details
$sql = "SELECT Sales.sale_id, Medicines.name AS medicine_name, Sales.quantity_sold, Sales.sale_date, 
               Customers.name AS customer_name, Customers.contact, Customers.address 
        FROM Sales 
        JOIN Medicines ON Sales.medicine_id = Medicines.medicine_id
        JOIN Customers ON Sales.customer_id = Customers.customer_id";
$result = $conn->query($sql);

echo "<h2>Sales Data</h2>";
echo "<table border='1'>
        <tr>
            <th>Sale ID</th>
            <th>Medicine Name</th>
            <th>Quantity Sold</th>
            <th>Sale Date</th>
            <th>Customer Name</th>
            <th>Contact</th>
            <th>Address</th>
        </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['sale_id'] . "</td>
                <td>" . $row['medicine_name'] . "</td>
                <td>" . $row['quantity_sold'] . "</td>
                <td>" . $row['sale_date'] . "</td>
                <td>" . $row['customer_name'] . "</td>
                <td>" . $row['contact'] . "</td>
                <td>" . $row['address'] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No sales data found.</td></tr>";
}

echo "</table>";
$conn->close();
?>
