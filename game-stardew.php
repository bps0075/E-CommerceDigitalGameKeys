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
<img src="stardewvalley.jpg" style="box-shadow: 0px 4px 4px #161E16;margin-left:55px;margin-top:10px;width:300px;height:300px;">
<p class="gametxt">
</br>
<b>Stardew Valley</b>
</br>
</br>
Price: $15
</br>
</br>
Stardew Valley is a game where you create your own farm, live off the land, and interact with the local community. You can raise animals, fish, tend crops, craft items, date, and explore caves with over 30 characters and 12 townsfolk.
</p>


	

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
