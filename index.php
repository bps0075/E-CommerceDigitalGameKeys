<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/style.css"></link>
<title>  Digital Keys </title>
<script src="shoppingCart.js"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<body>


<!--Header content-->
   <div class="header"> 
     <a href="index.php" style="text-decoration:none"><img src="key.png" style="width:70px;height:70px;margin-top:5px"></a>
     </div>

    <h3 class="navigation"><a href="Store.php" style="text-decoration:none">STORE</a>
    <a href="About.html" style="text-decoration:none;padding-left:15px">ABOUT</a>
    <a href="Team.html" style="text-decoration:none;padding-left:15px">TEAM</a>
    </h3>
   <p class="logincreate">
    <a href="LoginForm.php">login</a>
	|
	<a href = "RegistrationForm.php"> signup</a>
	</p>


<!--Shopping cart button-->	
	<button class="shoppingcartlink" onClick="goToPayment()">Shopping Cart ( 
<!--can pull shopping cart database "SELECT COUNT()" to display how many items in cart-->
	)</button>

<!--Search Bar-->
	<div class="topnav">

	<form action="Searchbar.php" method="GET">
<input id="search" name="search" type="text" placeholder="Search...">
<input id="submit" type="submit" value="Search">
</form>

	</div>
	</div>
	
	<div class="main">
<p style="padding-left:50px;margin-top:20px;letter-spacing:1px;text-shadow:.3px .3px #D5D4D4;">FEATURED AND TRENDING</p>

<div class="featuredgames">
<a href="game-stardew.html"><img src="stardewvalley.jpg" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:10px;width:300px;height:300px;"></a>
<a href="game-ror.html"><img src="ror.png" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:10px;width:300px;height:300px;"></a>
<a href="game-outlast.html"><img src="outlast.png" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:10px;width:300px;height:300px;"></a>
<a href="game-sotf.html"><img src="sotf.jpg" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:30px;width:300px;height:300px;"></a>
<a href="game-gta5.html"><img src="gta5.jpg" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:30px;width:300px;height:300px;"></a>
<a href="game-er.html"><img src="er.jpg" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:30px;width:300px;height:300px;"></a>
<a href="game-doom.html"><img src="doom.jpg" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:30px;width:300px;height:300px;"></a>
<a href="game-gg.html"><img src="gg.jpg" style="box-shadow: 0px 4px 4px #161E16;margin-left:60px;margin-top:30px;width:300px;height:300px;"></a>
</div>
	
<p>
    <?php 
    	
	include_once('database.php');
    //Use stored procedure to prevent SQLi
    $stmt = $pdo->prepare("CALL get_games();");
    $stmt->execute();
    $items = $stmt->fetchAll();
    echo "<div class='gameitems'>";
    foreach($items as $item)
    {
        $id = $item['id'];
		echo "<article class='gameitem'>";
		echo "<h1>" . $item['name'] . "</h1>";
		echo "<p> $" .$item['price'] . "</p>";
        echo "<button onclick='addToCart($id)'> Add to cart </button>";
		echo "</article>";
	}
    echo "</div>";
	
    $pdo = null;
    $stmt = null;
    ?>
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
