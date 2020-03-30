<?php
    session_start();
    $errors = array(); 

    //Connect to the database
    //$db = mysqli_connect('localhost', 'root', '', 'refrigerg');
    $db = mysqli_connect('eu-cdbr-west-02.cleardb.net','b24bdb07f8df3b','98354db2','heroku_d0b67b039063502');


    if (isset($_POST['login_user'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
    
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
    
        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['success'] = "You are now logged in";

                $row = $results->fetch_assoc();

                $_SESSION['email'] = $row["email"];
                if($row["type"]=='admin'){
                    $_SESSION['type']=$row['type'];
                    header('location: app/admin/index.php');
                }
                else {
                    header('location: app/user/index.php');
                }
                
            }else {
                array_push($errors, "Wrong username/password combination");
            }
        }
    }
?>