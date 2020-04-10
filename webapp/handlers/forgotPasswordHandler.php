<?php
    include_once 'databaseConnection.php';
    // initializing variables
    $username = "";
    $email    = "";
    $errors = array(); 

    // connect to the database
    //$db = mysqli_connect('localhost', 'root', '', 'refrigerg');


    // FORGOT PASSWORD
    if (isset($_POST['editUser'])) {
    // receive all input values from the form
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $query = "SELECT * FROM user WHERE email='$email'";
        $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1) {
                //TO DO: Decide forgot pass method
            }

    }
?>