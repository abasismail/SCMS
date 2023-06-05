<?php

if(!isset($_SESSION['name'])) {
  header('Location: http://localhost/php/login.php');
  exit();
}



?>


<html>
<head>
  <title>Dashboard</title>
</head>
<body>
  <h1>Welcome, <?php echo $_SESSION['name']; ?></h1>
</body>
</html>
