<?php
    include_once 'databaseConnection.php';
    // initializing variables
    $name = "";
    $email    = "";
    $subject = "";
    $message = "";
    $errors = array(); 

    // connect to the database
    //$db = mysqli_connect('localhost', 'root', '', 'refrigerg');

    //array_push($errors,"Here"); //--> Debug step ignore
    



    if (isset($_POST['contactForm'])) {
    // receive all input values from the form
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $subject = mysqli_real_escape_string($db, $_POST['subject']);
        $message = $_POST['message'];

         //--> Debug step ignore

        // Finally, register user if there are no errors in the form
        $query = "INSERT INTO contact (username, email, subject, message) 
                VALUES('$username', '$email', '$subject', '$message')";

        //INSERT INTO `contact` (`name`, `email`, `subject`, `message`) VALUES('Shounak Ghosh', 'sghsoh1810@gmail.com', 'Test', 'Test')
        
        
        try{
            $result = mysqli_query($db, $query);
        }
        catch(Exception $e) {
            array_push($errors,"Except");
        }
    }
?>