<?php

/* This script contains an HTML form for signing up for an account, it also checks the database
    for matching user credentials, and communicates with the user if their
    sign up attempt was succcessful */
    
if ($_POST['_check_submission']) {


    $email = $_POST["email"];
    $password1 = $_POST["password"];
    $password2 = $_POST["confirm_password"];

    if ($form_errors = validate_form($email, $password1, $password2)) {
        show_form($form_errors);
    } else {
        process_form($email, $password1);
    }
} else {
    show_form();
}

//Begin database query, first we want to check if the user exists, if they
//don't we add them to the database.
function process_form($email, $password1) {

    try {
        require_once "database.php";

        //Select all records from users table where email is equal to specified parameter
        $query = "SELECT * FROM users  WHERE email = ?";
        $stmt = $pdo->prepare($query);

        //Perform the query with $email as the specified argument
        $stmt->execute([$email]);

        //Save all records to $results
        $results = $stmt->fetchAll();

        //If results has nothing
        if (empty($results)) {

            //specify the insert query with "?, ?" being the email and password parameters respectively
            $query = "INSERT INTO users (email, password) VALUES (?, ?);";

            //Package the query for execution
            $stmt = $pdo->prepare($query);

            //Execute the query with $email and $password1 being the arguments
            $stmt->execute([$email, $password1]);

            //Clean up connections
            $pdo = null;
            $stmt = null;

            //Give the user a pat on the back
            print "Registration is successful!";
            print "<a href = '..\html\homepage.html'>go back home";

            //Exit
            die();
        } else {
            //User already exists, display the form again
            print "User already exists!";
            show_form();
        }

    } catch(PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    
}

//Check for password matching and email formatting, this goes before database
//checking
function validate_form($email, $password1, $password2) {
    $errors = array();
    //Email address validation
    if (! preg_match('/^[^@\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/i', $email)) {
        $errors[] = 'Please enter a valid e-mail address';
    }

    if ($password1 != $password2) {
        $errors[] = 'Passwords do not match, please try again!';
    }

    return $errors;

}

//Show to HTML form and show users any errors they made
function show_form($errors = '') {

    if ($errors) {
        print 'Please correct these errors: <ul><li>';
        print implode('</li><li>', $errors);
        print '</li></ul>';
    }

    print<<<_HTML_
    <h1>Register a new account</h1>
    <form method="POST" action="$_SERVER[PHP_SELF]">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id = "password" name="password" required><br><br>

            <label for="confirm-password">Confirm Password:</label>
            <input type="confirm_password" id = "confirm_password" name="confirm_password" required><br><br>

            <input type = "submit" value="Submit">
            <input type="hidden" name="_check_submission" value ="1">
            
        </form>
    _HTML_;

}
?>