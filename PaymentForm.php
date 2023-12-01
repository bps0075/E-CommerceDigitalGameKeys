<?php

/* This script contains an HTML form for payment information, it will combine
    all items and their prices in the users cart to display a total */

    /*NOTE THIS IS A WORK IN PROGRESS AND DOES NOT WORK*/

    //Note that the price is calculated before displaying the payment form

// Debugging code
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['shoppingCart'])) {
        $shoppingCart = json_decode($_POST['shoppingCart'], true);
        echo '<pre>';
        print_r($shoppingCart);
        echo '</pre>';
    } else {
        echo 'Shopping cart data not received.';
    }
} else {
    echo 'Invalid request method.';
}

//Once the user submits their information...
if ($_POST['_check_submission']) {
    //Collect their payment info (NEEDS TO BE ENCRYPTED)
    $firstName = $_POST["firstName"];
    $middleInitial = $_POST["middleInitial"];
    $lastName = $_POST["lastName"];
    $cardNumber = $_POST["cardNumber"];
    $csc = $_POST["csc"];
    $expiration = $_POST["expiration"];
    $shoppingCart = json_decode($_POST['shoppingCart']); // Now you have $shoppingCart containing the item IDs from the cart. Use this data to calculate the total price and process payment

    //email will be obtained from jwt token maybe?

    if ($form_errors = validate_form($firstName, $middleInitial, $lastName, $cardNumber, $csc, $expiration)) {
        $user_total = calculateDisplayTotalPrice($shoppingCart);
        show_form($form_errors);
    } else {
    show_form($userTotal);
    }
} else {
    $shoppingCart = $_GET["shoppingCart"];
    $userTotal = calculateDisplayTotalPrice($shoppingCart);
    show_form($form_errors, $userTotal);
}

function validate_form($firstName, $middleInitial, $lastName, $cardNumber, $csc, $expiration) {
    $errors = array();

    //Quick n' dirty card matching regex, should cover all major vendors
    //Vendors change their standards all the time though, so an alternative 
    // method should be explored.
    if (! preg_match('/^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}
        |6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])
                    [0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/i', $cardNumber)) {
                        $errors[] = 'Please enter a valid card number';
                    }

    if (! preg_match('/[\d][\d][\d]$/i', $csc)) {
        $errors[] = 'Invalid csc format, please enter the three digit csc
                        number on your card';
    }

    return $errors;
}

//Perform this function and use its returned price for the price display
//NEVER return the price information to frontend, only backend gets access to this
function calculateDisplayTotalPrice($shoppingCart) {
    $total = 0.00;
    $cost = 0.00;
    $cartSize = count($shoppingCart);
    try {
        require_once "database.php";

        for($i = 0; $i < $cartSize; $i++) {
            //Check the cost of each item
            //Use stored procedure to prevent SQLi            
            $query = "CALL check_cost(?);";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id]);
            $results = $stmt->fetchAll();

            if (!empty($results)) {
                $cost = $results['price'];
                $total += $cost;
                
                

            } else {
                print "Item does not exist, please load up your shopping cart with items we have for sale!";
                show_form();
                break;
            }
        }
        
        //Clean up connections
        $pdo = null;
        $stmt = null;
        return $total;

    } catch(PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}



function show_form($errors = '', $userTotal) {
    if ($errors) { 
        print 'Please correct these errors: <ul><li>';
        print implode('</li><li>', $errors);
        print '</li></ul>';
    }

    print <<<_HTML_
        <h1> Enter your payment information </h1>
        <form method="POST" action="$_SERVER[PHP_SELF]">
        <label for = "firstName">First Name:</label>
        <input type = "text" id = "firstName" required> <br><br>

        <label for = "middleInitial">Middle Initial:</label>
        <input type = "text" id = "middleInitial"> <br><br>

        <label for = "lastName">Last Name:</label>
        <input type = "text" id = "lastName" required> <br><br>

        <label for = "cardNumber">Card Number:</label>
        <input type = "text" id = "cardNumber" required> <br><br>

        <label for = "csc">CSC: </label>
        <input type = "number" id = "csc" required> <br><br>

        <label for = "expiration">Expiration Date (MM/YY):</label>
        <input type = "text" id = "expiration" required> <br><br>

        <input type = "submit" value="Submit">
        <input type="hidden" name=_check_submission" value = "1">

        </form>
    _HTML_;
}
?>
