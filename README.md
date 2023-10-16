# E-Commerce Digital Game Keys

## Names
* Brandon Sharp
* Nick Newbury
* Aaron Jacob
* Danielle Hess
* Ethan Willinger

## About
This E-Commerce project will be about selling digital game keys that allow a user to input into a video game platform such as Steam or Origin, which means that we will not need to store user shipping information.

## To access webpage
1. Install XAMPP
2. Clone repo into C:/\<xampp application location\>/htdocs/
3. Turn on APACHE in XAMPP (should be in your system tray)
4. In the address bar in your web browser type: http://localhost/E-CommerceDigitalGameKeys/html/homepage.html

## To run backend for the first time on your local machine
In order to avoid giving away development passwords for each local machine, you must manually change the 
database name and mysql host in \php\database.php (host for local development will be localhost, production config will be different) upon initial installation

1. Create a database in myphpadmin, give it a name.

2. Add a table, name it "users" and give it these specifications. It will have 3 columns, and these columns
    and these columns have the following properties.
        a. id || INT || auto increment
        b. email || VARCHAR || length 250
        c. password || VARCHAR || length 500

3. In \php\database.php set "mysql::host" to "localhost". Then set "dbname=" to the database you created earlier.
4. In \php\database.php, the Default username is "root" and default password is "". If you decide to change these things in PhpMyAdmin (recommended) you need to change these variables to reflect those credentials.
    Make sure your credentials have full access to your database.

5. Go to XAMPP, and turn on "apache" and "mysql".

6. Follow the "to start access webpage" to test out the website!

 
