<?php


function type($type,$user){
    setcookie("username", $user[$type."_name"], time()+3600);

 
    if($type == "customer") {
     
      header("Location: ../php/test.php");
      exit;
    } else {
     
      header("Location: ../php/test.php");
     // echo $_SESSION['name'];
      exit;
    }
  }


if($_SERVER["REQUEST_METHOD"] == "POST") {

  $username = $_POST['email'];
  $password = $_POST['password'];
  $type = $_POST['type'];
  $servername = "127.0.0.1";
  $port = "3308";
  $dbname = "se";
  $username_db = "root";
  $password_db = "root";

  try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username_db, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($type == "customer") {
      $stmt = $conn->prepare("SELECT * FROM customer WHERE username = :username AND password = :password");
    } else {
      $stmt = $conn->prepare("SELECT * FROM supplier WHERE username = :username AND password = :password");
    }

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
      $user = $stmt->fetch();

      if($type == "supplier" && !$user['approved']) {
        echo "Hi you need to wait for approval before logging in.";
      } else {
        type($type,$user);
        exit;
      }
    } else {
      echo "Invalid username or password.";
    }
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}
?>
