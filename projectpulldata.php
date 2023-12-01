<!DOCTYPE html>
<html>
<style>
  button {
        cursor: pointer;
        border: none;
        font-size: 25px;
        background-color: white;
    }
    button:hover{

        background-color: #DDE1E4;
        text-decoration: underline;

    }
    .gameitem {
        color: black;
        border: 5px solid gray;
        height: 300px;
        width: 250px;
        text-align: center;
        display: inline-block;
        font-size: 25px;
        margin: 5px 5px;
        font-weight: normal;
        box-shadow: 5px  5px 5px #667;
        overflow: hidden;

    }
img {
  width: 125px;
  height: 200px;
}

</style>
<head>
<title>Page Title</title>
</head>
<body>

<h1>Game Key Website</h1>
<?php
	
	include_once('database.php');
    //Use stored procedure to prevent SQLi
    $stmt = $pdo->prepare("CALL get_games();");
    $stmt->execute();
    $items = $stmt->fetchAll();
    foreach($items as $item)
    {
		echo "<div class='gameitem'>";
		echo "<button>" . $item['name'] . "</button>";
		echo "<p> $" .$item['price'] . "</p>";
		echo "</div>";
	}
	
$pdo = null;
$stmt = null;
?>

</div>





</body>
</html>

