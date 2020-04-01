<?php

    include_once 'databaseConnection.php';
    $errors = array();
    $username = $_SESSION['username'];
    $query = "SELECT * FROM items WHERE username='$username'";
    $results = mysqli_query($db, $query);
    $datarow = "";
    $numberOfItems = 0;
    $totalPrice = 0;
    $numberOfVariety = 0;

    $itemNamesArray = array();
    $itemQuantityArray = array();
    $itemPriceArray = array();
    $itemTotalPriceArray = array();

    while($row=mysqli_fetch_array($results)) {
        $totalPricePerItem = (int)$row[2]*(int)$row[3];
        $totalPrice += $totalPricePerItem;
        $numberOfItems += $row[2];
        $numberOfVariety += 1;
        array_push($itemNamesArray,$row[1]);
        array_push($itemQuantityArray,$row[2]);
        array_push($itemPriceArray,$row[3]);
        array_push($itemTotalPriceArray,$totalPricePerItem);
        $datarow = $datarow."<tr><td>$row[1]</td><td>$row[2]</td><td>$$row[3]</td><td>$$totalPricePerItem</td></tr>";
    }

    $_SESSION['inventory'] = $datarow;
    $_SESSION['totalPrice'] = $totalPrice;
    $_SESSION['numberOfItems'] = $numberOfItems;
    $_SESSION['numberOfVariety'] = $numberOfVariety;
    $_SESSION['itemPriceArray'] = $itemPriceArray;
    $_SESSION['itemNamesArray'] = $itemNamesArray;
    $_SESSION['itemQuantityArray'] = $itemQuantityArray;
    $_SESSION['itemTotalPriceArray'] = $itemTotalPriceArray;

?>