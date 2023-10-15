<?php
if ($_POST['_check_submission']) {


    $email = $_POST["email"];
    $password1 = $_POST["password"];
    $password2 = $_POST["confirm_password"];

    if ($form_errors = validate_form($email, $password1, $password2)) {
        show_form($form_errors);
    } else {
        process_form($email);
    }
} else {
    show_form();
}

//What to display when successful
function process_form($email) {
    print "Registration is successful!" . $email;
    print "<a href = '..\html\homepage.html'>go back home";
}

//Check for password matching and email formatting
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
        print '</li>></ul>';
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