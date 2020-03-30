<?php
    // initializing variables
    $username = "";
    $email    = "";
    $errors = array(); 

    // connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'refrigerg');
    //$db = mysqli_connect('eu-cdbr-west-02.cleardb.net','b24bdb07f8df3b','98354db2','heroku_d0b67b039063502');


    // REGISTER USER
    if (isset($_POST['editUser'])) {
    // receive all input values from the form
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        if(empty($password)) {
            $user_check_query = "UPDATE user SET username = '$username', email = '$email' WHERE username='$username'";
        }
        else {
            $password = md5($password);
            $user_check_query = "UPDATE user SET username = '$username', email = '$email', password = '$password' WHERE username='$username'";
        }
        
        $result = mysqli_query($db, $user_check_query);

    }
?>