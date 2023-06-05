<?php

function isSupplierApproved($name){
  $db=DB_Connect();
  $stmt = "SELECT COUNT(*) FROM supplier WHERE supplier_name = ?";
  $prep = $db->prepare($stmt);
  $prep->execute([$name]);
  $count = $prep->fetchColumn();
  if ($count == 0) {
      
      return false;
  } else {
     
      $stmt2 = "SELECT approved FROM supplier WHERE supplier_name = ?";
      $prep2 = $db->prepare($stmt2);
      $prep2->execute([$name]);
      $approved = $prep2->fetchColumn();
      return $approved == 1;
  }
}
function DB_Connect(){
    $server_name = "127.0.0.1";
    $dbname="se";
    $username = "root";
    $password = "root";
    $port = 3308;
    
    try {
      $conn = new PDO("mysql:host=$server_name;port=$port;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
      return $conn;
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
}

if($_POST["type"]=='customer'){
    $db=DB_Connect();
    $id=$_POST['email'];
    $name=$_POST["name"];
    $location=$_POST['location'];
    $un=$_POST['email'];
    $pass=$_POST["password"];

    
    $stmt1 = "SELECT COUNT(*) FROM customer WHERE customer_id = ? OR username = ?";
    $prep1 = $db->prepare($stmt1);
    $prep1->execute([$id, $un]);
    $result1 = $prep1->fetchColumn();
    if ($result1 > 0) {
        header("location: ..\PAGES\signup.html");
        exit();
    }

    $query = "INSERT INTO customer (customer_id, customer_name, customer_location, username, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$id, $name, $location, $un, $pass]);
    echo "success";
    header("location: ../PAGES/Login.html");

} else {
    $db=DB_Connect();
    $id=$_POST['email'];
    $name=$_POST["name"];
    $location=$_POST['location'];
    $un=$_POST['email'];
    $pass=$_POST["password"];

    
    $stmt1 = "SELECT COUNT(*) FROM supplier WHERE supplier_id = ? OR username = ?";
    $prep1 = $db->prepare($stmt1);
    $prep1->execute([$id, $un]);
    $result1 = $prep1->fetchColumn();
    if ($result1 > 0) {
        header("location: ../PAGES/Login.html ");
        exit();
    }

    $query = "INSERT INTO supplier (supplier_id, supplier_name, supplier_location, username, password, approved) VALUES (?, ?, ?, ?, ?, 0)";
    $stmt = $db->prepare($query);
    $stmt->execute([$id, $name, $location, $un, $pass]);
    header("location: location: ../PAGES/Login.html");
}
?>
