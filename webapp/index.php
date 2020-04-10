<?php

session_start();
if(!isset($_SESSION['username'])){
    header('location: login.php');
}
else {
    if(!isset($_SESSION['type'])){
        header('location: app/user/index.php');
    }
    else {
        header('location: app/admin/index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
</head>
</html>