<!DOCTYPE html>
<html>
<head>
<?php
$random = bin2hex(openssl_random_pseudo_bytes(32));


echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
echo "<meta http-equiv='Content-Security-Policy' content='default-src: 'self'; script-src: 'self' 'shoppingCart.js' 'nonce-" . $random . "'; connect-src 'self'; base-uri 'self';form-action 'self';>";
?>

<link rel="stylesheet" type="text/css" href="css/style.css"></link>
<script src="shoppingCart.js"></script>
<title>  Digital Keys </title>
</head>
<body>


<!--Header content-->
<div class="header"> 
<a href="index.php" style="text-decoration:none"><img src="key.png" style="width:70px;height:70px;margin-top:5px;"></a>

<h3 class="navigation"><a href="storepage.php" style="text-decoration:none">STORE</a>
<a href="about.php" class="navtxt">ABOUT</a>
</h3>
<p class="logincreate">
<a href="LoginForm.php">login</a>
|
<a href = "RegistrationForm.php"> signup</a>
</p>
</div>

<!--Shopping cart button-->	
<div class="shoppingcartlink">
<?php
echo "<button nonce='" . $random . "' onClick='goToPayment()'>Shopping Cart</button>";
?>
</div>
</div>
	
<div class="main">
<p class="categorytxt">ALL GAMES</p>

<div class="storegames">
    <?php 
    	
	include_once('database.php');
    //Use stored procedure to prevent SQLi
    $stmt = $pdo->prepare("CALL get_games();");
    $stmt->execute();
    $items = $stmt->fetchAll();
    echo "<table>";
  echo "<tr>
    <th>Title</th>
    <th>Price</th> 
    <th></th>
  </tr>";

    foreach($items as $item)
    {
        $id = $item['id'];
        echo "<tr>";
		echo "<td><h1><a href=game-" . $item['name'] . ">". $item['name'] ."</a></h1></td>";
		echo "<td><p> $" .$item['price'] . "</p></td>";
        echo "<td><button  nonce='". $random . "' onclick='addToCart($id)'> Add to cart </button></td>";
        echo "</tr>";
	}
	echo"</table>";
    $pdo = null;
    $stmt = null;
    ?>
</div>
	

</div>	

<!--Footer content-->
<div class="footer">
  <p style="padding-top:8px">
    Copyright © 2023 Digital Keys. All rights reserved.
  </p>
</footer>
</div>

</body>
</html>
