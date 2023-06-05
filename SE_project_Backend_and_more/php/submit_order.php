<?php
// Set up database connection
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "se";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Get order data from POST parameters
$order_date = date('Y-m-d');
$item_name = $_POST['item_name'];
$item_price = $_POST['item_price'];
$customer_id = $_POST['customer_id'];
$supplier_id = $_POST['supplier_id'];

// Prepare and execute SQL statement to insert order into database
$stmt = $conn->prepare("INSERT INTO `order` (order_date, item_name, item_price, customer_id, supplier_id) VALUES (:order_date, :item_name, :item_price, :customer_id, :supplier_id)");
$stmt->bindParam(':order_date', $order_date);
$stmt->bindParam(':item_name', $item_name);
$stmt->bindParam(':item_price', $item_price);
$stmt->bindParam(':customer_id', $customer_id);
$stmt->bindParam(':supplier_id', $supplier_id);
$stmt->execute();

// Return success message
echo "Order submitted successfully";
