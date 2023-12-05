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
<p class="categorytxt">FEATURED AND TRENDING</p>

<div class="featuredgames">
<a href="game-stardew.php"><img src="stardewvalley.jpg" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:10px;width:300px;height:300px;"></a>
<a href="game-ror.php"><img src="ror.png" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:10px;width:300px;height:300px;"></a>
<a href="game-outlast.php"><img src="outlast.png" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:10px;width:300px;height:300px;"></a>
<a href="game-sotf.php"><img src="sotf.jpg" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:10px;width:300px;height:300px;"></a>
<a href="game-gta5.php"><img src="gta5.jpg" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:10px;width:300px;height:300px;"></a>
<a href="game-er.php"><img src="er.jpg" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:10px;width:300px;height:300px;"></a>
<a href="game-doom.php"><img src="doom.jpg" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:10px;width:300px;height:300px;"></a>
<a href="game-gg.php"><img src="gg.jpg" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:10px;width:300px;height:300px;"></a>
</div>

</div>	

<!--Footer content-->
<div class="footer">
  <p class="footertxt">
    Copyright © 2023 Digital Keys. All rights reserved.
  </p>
</div>

</body>
</html>
