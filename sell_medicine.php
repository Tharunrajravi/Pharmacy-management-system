<?php
// Database connection settings
$servername = "localhost";
$username = "root"; 
$password = ""; // Update this if you set a password in XAMPP
$dbname = "pharmacy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
$customer_name = $_POST['customer_name'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$medicine_name = $_POST['medicine_name'];
$quantity_sold = $_POST['quantity_sold'];

// Check if the medicine exists and get its details
$medicine_query = "SELECT * FROM Medicines WHERE name = '$medicine_name'";
$medicine_result = $conn->query($medicine_query);

if ($medicine_result->num_rows > 0) {
    $medicine = $medicine_result->fetch_assoc();

    // Check if there is enough stock
    if ($medicine['quantity'] >= $quantity_sold) {
        // Insert customer information
        $customer_query = "INSERT INTO Customers (name, contact, address) 
                           VALUES ('$customer_name', '$contact', '$address')";
        $conn->query($customer_query);
        $customer_id = $conn->insert_id;

        // Update the stock level
        $new_quantity = $medicine['quantity'] - $quantity_sold;
        $update_stock_query = "UPDATE Medicines 
                               SET quantity = $new_quantity 
                               WHERE medicine_id = " . $medicine['medicine_id'];
        $conn->query($update_stock_query);

        // Record the sale
        $sale_query = "INSERT INTO Sales (medicine_id, customer_id, quantity_sold) 
                       VALUES (" . $medicine['medicine_id'] . ", $customer_id, $quantity_sold)";
        $conn->query($sale_query);

        echo "Sale successful! <a href='index.html'>Go back</a>";
    } else {
        echo "Error: Not enough stock available for the medicine. <a href='index.html'>Go back</a>";
    }
} else {
    echo "Error: Medicine not found. <a href='index.html'>Go back</a>";
}

$conn->close();
?>
