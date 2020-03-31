<?php
    include_once 'databaseConnection.php';
    $errors = array();
    $username = $_SESSION['username'];
    $query = "SELECT product FROM items WHERE username='$username'";
    $results = mysqli_query($db, $query);
    $getUrlIngredientName = "";
    while($row=mysqli_fetch_array($results)) {
        $getUrlIngredientName = $getUrlIngredientName.$row[0].",+";
    }

    $getUrlIngredientName=substr($getUrlIngredientName,0,-2);

    $getUrlIngredientNameFullURL = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/findByIngredients?number=5&ranking=1&ignorePantry=false&ingredients=".$getUrlIngredientName;

    //array_push($errors,$getUrlIngredientNameFullURL);

    
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "$getUrlIngredientNameFullURL",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "x-rapidapi-host: spoonacular-recipe-food-nutrition-v1.p.rapidapi.com",
            "x-rapidapi-key: 5d72720c6cmsh888d9a70cc7a7bdp12b657jsnacfd9103344d"
        ),
    ));

    $getResponseByIngredient = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        array_push($errors,"cURL Error #:" . $err);
    }
    //echo $response;
    
    $getResponseByIngredientJson = json_decode($getResponseByIngredient, true);

    $datarow = "";

    for ($i=0; $i < 5 ; $i++) {
        
        $id = $getResponseByIngredientJson[$i]['id'];
        $title = $getResponseByIngredientJson[$i]['title'];
        $usedIngredientCount =  $getResponseByIngredientJson[$i]['usedIngredientCount'];
        $missedIngredientCount = $getResponseByIngredientJson[$i]['missedIngredientCount'];

        
        $getUrlByReciepeIdFullURL = "https://api.spoonacular.com/recipes/".$id."/information?includeNutrition=false&apiKey=f4efd82e83c54a2dbcbd7e3bf93e014f";

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "$getUrlByReciepeIdFullURL",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
        ),
        ));

        $getResponseByReciepe = curl_exec($curl);
        curl_close($curl);

        
        $getResponseByReciepeJson = json_decode($getResponseByReciepe, true);
        $spoonacularSourceUrl = $getResponseByReciepeJson['sourceUrl'];

        $requiredIngredientsJson = $getResponseByReciepeJson['extendedIngredients'];
        $requiredIngredients = "";
        
        $numberOfIngredientCounter=0;
        foreach($requiredIngredientsJson as $ingredients){
            if($numberOfIngredientCounter<5) {
                $requiredIngredients = $requiredIngredients.$ingredients['name'].",";
                $numberOfIngredientCounter+=1;
            } else {
                $requiredIngredients = $requiredIngredients."etc,";
                break;
            }
        }

        $requiredIngredients = substr($requiredIngredients,0,-1);

        $buttonBuilder = "<button class=\"btn btn-purple waves-effect waves-light\"onclick=\"window.open('".$spoonacularSourceUrl."')\">Full Reciepe</button>";
        $datarow = $datarow."<tr><td>$title</td><td>$usedIngredientCount</td><td>$missedIngredientCount</td><td>$requiredIngredients</td><td>$buttonBuilder</td></tr>";
    }
    $_SESSION['reciepe']=$datarow;
    
?>