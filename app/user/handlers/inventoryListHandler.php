<?php

    include_once 'databaseConnection.php';
    $errors = array();
    $username = $_SESSION['username'];
    $query = "SELECT * FROM items WHERE username='$username'";
    $results = mysqli_query($db, $query);
    $datarow = "";
    while($row=mysqli_fetch_array($results)) {
        $totalPrice = (int)$row[2]*(int)$row[3];
        $datarow = $datarow."<tr><td>$row[1]</td><td>$row[2]</td><td>$$row[3]</td><td>$$totalPrice</td></tr>";
    }
    $_SESSION['datarow']=$datarow;
?>