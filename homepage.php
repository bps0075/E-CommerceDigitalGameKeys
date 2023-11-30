<!DOCTYPE html>
<html>
<head class="Header" style="background-color:grey">
    <link rel="stylesheet" type="text/css" href="css/style.css"></link>
    <script src="shoppingCart.js"></script>
    <title>Digital Game Keys</title>
    <h1 style="text-align: center">Digital Game Keys</h1>
</head>

<body>
    <h1 id="h1">Welcome! You may create an account or sign in below:</h1>
    <!--<p id="p2">Testing the color red with the css file</p>-->
    <table>
        <button id="centerB"><a href = "RegistrationForm.php" style="text-align: center" class="btn btn-secondary"> Create Account </button><br> <br>
        <button id="centerB"><a href = "LoginForm.php" style="text-align: center"> Login </a> </button><br> <br>
    </table>
    <button onclick="addToCart(1)">Add item to cart</button>
    <button onclick="goToPayment()">Proceed to Payment</button> <!-- this is the button to go to payment -->
    <p>
    <?php 
    	
	include_once('database.php');

    $stmt = $pdo->prepare(
		"SELECT * FROM items");
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
</body>
</html>
