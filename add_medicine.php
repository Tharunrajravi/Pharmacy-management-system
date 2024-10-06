<?php
// Database connection settings
$servername = "localhost";
$username = "root"; 
$password = ""; // Change if you have set a password in XAMPP
$dbname = "pharmacy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
$name = $_POST['name'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$expiration_date = $_POST['expiration_date'];

// Insert data into Medicines table
$sql = "INSERT INTO Medicines (name, category, quantity, price, expiration_date) 
        VALUES ('$name', '$category', $quantity, $price, '$expiration_date')";

if ($conn->query($sql) === TRUE) {
    echo "New medicine added successfully. <a href='index.html'>Go back</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
