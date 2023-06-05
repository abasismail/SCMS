<?php
if (isset($_COOKIE['username']) && isset($_POST['logout'])) {
   
   
    header("Location: ..\php\login.php");
    exit;
}
if(!isset($_COOKIE['username'])){
    header("Location: ..\php\login.php");
    exit();
}

?>
<html>
<head>
  <title>Dashboard</title>
  <style>
body {
	background-image: url("../Images/bg-01.jpg");
	background-size: cover;
	background-repeat: no-repeat;
	color: #fff;
	font-family: Arial, sans-serif;
	margin: 0;
	padding: 0;
}

main {
	display: flex;
	justify-content: center;
	align-items: center;
	height: 100vh;
}

.signup-container {
	background-color: #333;
	padding-left:10px;
	border-radius: 20px;
	box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
	display: flex;
	flex-direction: row;
	max-width: 75%;
}

.signup-left {
	display: flex;
	flex-direction: column;
	max-width: 75%;
	
}

.signup-right {
	padding:inherit;
	padding: 10px;
	display: flex;
	justify-content: center;
	align-items: center;
	
}

.signup-logo {
	max-width: 250px;
	margin-bottom: 10px;
}

h1 {
	margin-top: 0;
	font-size: 28px;
}

p {
	font-size: 18px;
	margin-top: 0;
	line-height: 1.5;
}

label, input {
	display: block;
	margin-bottom: 10px;
}

label {
	color: #fff;
	font-weight: bold;
}

input[type="text"], input[type="email"], input[type="password"] {
	width: 70%;
	
	border-radius: 5px;
	border: none;
	box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	font-size: 16px;
}

.submit{
	background-color: #4CAF50;
	color: #fff;
	padding: 10px;
	border: none;
	border-radius: 5px;
	cursor: pointer;
	font-size: 16px;
}
input[type="submit"] {
	background-color: #4CAF50;
	color: #fff;
	padding: 10px;
	border: none;
	border-radius: 5px;
	cursor: pointer;
	font-size: 16px;
}
.butt{
    background-color: #4CAF50;
	color: #fff;
	padding: 10px;
	border: none;
	border-radius: 5px;
	cursor: pointer;
	font-size: 16px; 
}


  
  .radio-toolbar input[type="radio"] {
	opacity: 0;
	position: fixed;
	width: 0;
  }
  
  .radio-toolbar label {
	  display: inline-block;
	  background-color: #ddd;
	  padding: 10px 20px;
	  font-family: sans-serif, Arial;
	  font-size: 16px;
	  border: 2px solid #444;
	  border-radius: 4px;
  }
  
  .radio-toolbar label:hover {
	background-color: #dfd;
  }
  
  
  .radio-toolbar input[type="radio"]:checked + label {
	  background-color: #bfb;
	  border-color: #4c4;
  }
 
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); 
  z-index: 9999;
  display: none; 
}


.menu {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80%;
  max-width: 600px;
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  padding: 20px;
  z-index: 10000;
  display: none; 
}


.menu-close {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 24px;
  color: black;
  cursor: pointer;
}


.menu-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}


.menu-table th {
  text-align: left;
  background-color: #f2f2f2;
  padding: 8px;
}


.menu-table td {
  border-bottom: 1px solid #ddd;
  padding: 8px;
}


.menu-table tr:hover {
  background-color: #f5f5f5;
  cursor: pointer;
}

.overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5); /* This creates the faded effect */
  z-index: 9999; /* This puts the overlay on top of everything */
  display: flex;
  justify-content: center;
  align-items: center;
}

.content {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  position: relative;
}

.exit-button {
  position: absolute;
  top: -15px;
  right: -15px;
  background-color: #fff;
  border: none;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  font-size: 16px;
  font-weight: bold;
  color: #333;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
  cursor: pointer;
}


	</style>
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "se";
 
try {
  $conn = new PDO("mysql:host=$servername;port=3308;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
  $stmt = $conn->prepare("SELECT * FROM supplier WHERE approved=TRUE");
  $stmt->execute();
 
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
 
?>

<html>
<head>
  <title>Supplier Table</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
$(document).ready(function() {
    
    var $supplierTable = $('#supplier-table');
    var $menuOverlay = $('#menu-overlay');
    var $menu = $('#menu');
    var $menuClose = $('#menu-close');
    var $menuHeader = $('#menu-header');
    var $menuSupplierName = $('#menu-supplier-name');
    var $menuItems = $('#menu-items');
    var $menuAddToCart = $('#menu-add-to-cart');
    var $orderForm = $('#order-form');
    var $orderItems = $('#order-items');
    
    var cart = {};
    var orders = {};
    
    // Function to update the local cart display
    function updateCart() {
        $orderItems.html('');
        var total = 0;
        for (var id in cart) {
            var item = cart[id];
            var subtotal = item.price * item.quantity;
            total += subtotal;
            $orderItems.append('<div class="order-item">' +
                              '<span class="item-name">' + item.name + '</span>' +
                              '<span class="item-quantity">Quantity: ' + item.quantity + '</span>' +
                              '<span class="item-subtotal">Subtotal: $' + subtotal.toFixed(2) + '</span>' +
                              '<button class="remove-item" data-item-id="' + id + '">Remove</button>' +
                              '</div>');
        }
        $orderItems.append('<div class="order-total">Total: $' + total.toFixed(2) + '</div>');
    }
    
    // Function to update the supplier order display
    function updateOrders() {
        for (var supplierId in orders) {
            var $orderTable = $('#' + supplierId + '-order-table');
            var orderItems = orders[supplierId];
            $orderTable.html('');
            var total = 0;
            for (var i = 0; i < orderItems.length; i++) {
                var item = orderItems[i];
                var subtotal = item.price * item.quantity;
                total += subtotal;
                $orderTable.append('<div class="order-item">' +
                                  '<span class="item-name">' + item.name + '</span>' +
                                  '<span class="item-quantity">Quantity: ' + item.quantity + '</span>' +
                                  '<span class="item-subtotal">Subtotal: $' + subtotal.toFixed(2) + '</span>' +
                                  '</div>');
            }
            $orderTable.append('<div class="order-total">Total: $' + total.toFixed(2) + '</div>');
        }
    }
    
    // Function to display the menu for a selected supplier
    function showMenu(supplierId) {
        $.ajax({
            url: 'get_catalog.php',
            method: 'POST',
            data: { supplierId: supplierId },
            success: function(data) {
                $menuOverlay.show();
                $menu.show();
                $menuSupplierName.text($('#supplier-' + supplierId + '-name').text());
                $menuItems.html(data);
                $menuItems.on('click', '.item', function() {
                    $menuItems.find('.item').removeClass('selected');
                    $(this).addClass('selected');
                });
                $menuClose.on('click', function() {
                    $menuOverlay.hide();
                    $menu.hide();
                });
                $menuAddToCart.on('click', function() {
                    var $selectedItem = $menuItems.find('.item.selected');
                    var itemId = $selectedItem.data('item-id');
                    var itemName = $selectedItem.find('.item-name').text();
                    var itemPrice = $selectedItem.find('item-price').text().replace('$', '');
var itemQuantity = parseInt($selectedItem.find('.item-quantity').val());
if (isNaN(itemQuantity) || itemQuantity <= 0) {
alert('Please enter a valid quantity.');
return;
}
if (!cart[itemId]) {
cart[itemId] = {
name: itemName,
price: parseFloat(itemPrice),
quantity: 0
};
}
cart[itemId].quantity += itemQuantity;
updateCart();
$menuOverlay.hide();
$menu.hide();
});
}
});
}


$orderItems.on('click', '.remove-item', function() {
    var itemId = $(this).data('item-id');
    delete cart[itemId];
    updateCart();
});

// Function to handle the submission of an order
$orderForm.on('submit', function(event) {
    event.preventDefault();
    for (var id in cart) {
        var item = cart[id];
        var supplierId = $('#item-' + id).data('supplier-id');
        if (!orders[supplierId]) {
            orders[supplierId] = [];
        }
        orders[supplierId].push({
            name: item.name,
            price: item.price,
            quantity: item.quantity
        });
    }
    cart = {};
    updateCart();
    updateOrders();
});

// Event listener to display the menu for a selected supplier
$supplierTable.on('click', '.supplier', function() {
    var supplierId = $(this).data('supplier-id');
    showMenu(supplierId);
});
});

</script>







</head>
<body>
  <div style="margin:10px">
	<h1>Supplier List</h1>
	<?php

  $servername = "127.0.0.1";
  $port = "3308";
  $dbname = "se";
  $username_db = "root";
  $password_db = "root";

  try {
    $pdo= new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username_db, $password_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM supplier";

	
	$stmt = $pdo->prepare($sql);


	$stmt->execute();


	$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);


	if (count($suppliers) > 0) {
	
		foreach ($suppliers as $supplier) {
			echo '<h2>' . $supplier['supplier_name'] . '</h2>';
			echo '<p>Location: ' . $supplier['supplier_location'] . '</p>';
			echo '<button onclick="getCatalog(' . $supplier['supplier_id'] . ')">View Catalog</button>';
			echo '<hr>';
		}
	} else {
		echo '<p>No suppliers found.</p>';
	}
  }
  
  catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

	
	
	?>
	<script>
		function getCatalog(supplierId) {
		
			var xhr = new XMLHttpRequest();
			xhr.open('GET', 'get_catalog.php?supplier_id=' + supplierId);
			xhr.onload = function() {
				if (xhr.status === 200) {
					
					var catalog = xhr.responseText.split('||');
					var supplierName = catalog[0];
					var items = catalog[1].split(';');
					var catalogHtml = '<h2>' + supplierName + ' Catalog</h2>';
         catalogHtml+="<div class='overlay' > <div class='content'>";
    
    

					for (var i = 0; i < items.length; i++) {
						var item = items[i].split(',');
						catalogHtml += '<p>' + item[0] + ' - $' + item[1] + ' <button onclick="addToCart(' + item[2] + ', ' + supplierId + ')">Add to Cart</button></p>';
					}
          catalogHtml+="<button class='exit-button'>Close</button></div></div>";
					document.getElementById('catalog').innerHTML = catalogHtml;
				} else {
					console.log('Request failed.  Returned status of ' + xhr.status);
				}
			};
			xhr.send();
		}

		function addToCart(itemId, supplierId) {
	
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'submit_order.php');
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhr.onload = function() {
				if (xhr.status === 200) {
					console.log('Item added to cart.');
				} else {
					console.log('Request failed.  Returned status of ' + xhr.status);
				}
			};
			xhr.send('supplier_id=' + supplierId + '&item_id=' + itemId);
		}
	</script>
	<div id="catalog"></div>

<script>
 function getCatalog(supplierId) {
    // Send an AJAX request to get the catalog for the selected supplier
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_catalog.php?supplier_id=' + supplierId);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Get the response text and create a new element to hold the catalog items
            var catalog = xhr.responseText;
            var
            catalogHtml = catalog;
            

            // Display the catalog items
            document.getElementById('catalog').innerHTML = catalogHtml;
        } else {
            console.log('Request failed.  Returned status of ' + xhr.status);
        }
    };
    xhr.send();
}



  function addToCart(itemId, supplierId) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'submit_order.php');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (xhr.status === 200) {
        console.log('Item added to cart.');
      } else {
        console.log('Request failed.  Returned status of ' + xhr.status);
      }
    };
    xhr.send('supplier_id=' + supplierId + '&item_id=' + itemId);
  }
</script>
  </div></body>