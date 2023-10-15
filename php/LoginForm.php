<?php
if ($_POST['_check_submission']) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($form_errors = validate_form($email, $password)) {
        show_form($form_errors);
    } else {
        process_form();
    }
} else {
    show_form();
}

//What to display when successful
function process_form() {
    print "Login successful!";
    print "<a href = '..\html\homepage.html'>go back home";
}


//This will check the database if the user exists
function validate_form($email, $password) {
    $errors = array();

    return $errors;
}

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