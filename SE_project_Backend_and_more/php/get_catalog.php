<?php
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "se";
$port=3308;

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $supplier_id = $_GET['supplier_id'];


$stmt = $conn->prepare("SELECT * FROM supplier_catalog_item WHERE catalog_id IN (SELECT id FROM supplier_catalog WHERE supplier_id = :supplier_id)");
$stmt->bindParam(':supplier_id', $supplier_id);
$stmt->execute();


$catalog_items = $stmt->fetchAll(PDO::FETCH_ASSOC);


header('Content-Type: text/plain');
foreach ($catalog_items as $item) {
    echo $item['name'] . ', ' . $item['quantity'] . ', ' . $item['price'] . "\n";
}


} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}



?>