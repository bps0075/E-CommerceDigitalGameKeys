<?php

/* This script contains an HTML form for logging into an account, it also checks the database
    for matching user credentials, and communicates with the user if their
    log in attempt was succcessful */


//Once the user submits their information...
if ($_POST['_check_submission']) {


    //Collect their email and password
    $email = $_POST["email"];
    $password = $_POST["password"];


    //If there are any errors during form processing, show the form again
    //with the mistakes shown to the user, otherwise, perform db query.
    if ($form_errors = validate_form($email, $password)) {
        show_form($form_errors);
    } else {
        process_form($email, $password, $form_errors);
    }
} else {
    show_form();
}

//Begin database query
function process_form($email, $password, $form_errors) {

    try {

        // Acquire JWT functions
        require "JWT.php";


        // Obtain jwt secret key
        $lines = file('..\config\config.txt');
        $jwt_key = $lines[1];


        //Connect to database
        require_once "database.php";


        //Select all records from users table where the email and password match passed parameters
        //Question marks represent variables that are defined in the argument array passed into stmt->execute
        $query = "SELECT * FROM users WHERE email = ? AND password = ?";

        $stmt = $pdo->prepare($query);

        //Execute the query using $email and $password (specified by the user) as arguments
        $stmt->execute([$email, $password]);

        //Place all records in $results
        $results = $stmt->fetchAll();

        //If results has nothing, no user exists and the form is displayed again with appropriate errors
        if (empty($results)) {
            echo "Invalid credentials, please try again";
            show_form($form_errors);
        } else {

            // < -- Begin generating JWT -- >

            // Headers
            $headers = array('alg'=> 'HS256', 'typ'=>'JWT');
            // Create issued at
            $issuedAt = time();

            //Create payload
            $payload = [
                'iss' => 'https://steamkeys.com',
                'aud' => 'https://steamkeys.com',
                'iat' => $issuedAt,
                'nbf' => $issuedAt,
                'exp' => $issuedAt + 30,
                'data' => [
                    'email' => $email
                ]
            ];

            $jwt = generate_jwt($headers, $payload,$jwt_key);
            echo $jwt;

            setcookie("yourtoken", $jwt, time() + 60, '/', '', 0, 1);


            //Clean up connections to the database to improve performance
            $pdo = null;
            $stmt = null;

            print "Login successful!";
            print "<a href = '..\html\homepage.html'>go back home";

        //Exit this function
        die();
        }

    //If something goes wrong with the query
    } catch(PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    
}


//Not used here but might be later on
function validate_form($email, $password) {
    $errors = array();

    return $errors;
}

//HTML LOGIN FORM
function show_form($errors = '') {
    if ($errors) {
        print 'Please correct these errors: <ul><li>';
        print implode('</li><li>', $errors);
        print '</li></ul>';
    }

    print<<<_HTML_
        <h1> Login to an account</h1>
        <form method="POST" action="$_SERVER[PHP_SELF]">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id = "password" name="password" required><br><br>

        <input type = "submit" value="Submit">
        <input type="hidden" name="_check_submission" value ="1">

        </form>
    _HTML_;
}
?>