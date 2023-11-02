<?php

/* This script contains an HTML form for payment information, it will combine
    all items and their prices in the users cart to display a total */

//Once the user submits their information...
if ($_POST['_check_submission']) {
    //Collect their payment info (NEEDS TO BE ENCRYPTED)
    $firstName = $_POST["firstName"];
    $middleInitial = $_POST["middleInitial"];
    $lastName = $_POST["lastName"];
    $cardNumber = $_POST["cardNumber"];
    $csc = $_POST["csc"];
    $expiration = $_POST["expiration"];

    //email will be obtained from jwt token maybe?

    if ($form_errors = validate_form($firstName, $middleInitial, $lastName, $cardNumber, $csc, $expiration)) {
        show_form($form_errors);
    } else {
        process_form($firstName, $middleInitial, $lastName, $cardNumber, $csc, $expiration);
    } 
} else {
    show_form();
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



function show_form($errors = '') {
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