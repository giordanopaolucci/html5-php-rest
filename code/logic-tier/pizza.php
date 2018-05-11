<?php

// Creo un oggetto PHP e lo converto in JSON
// $myObj = new stdClass();
// $myObj->id = "100";
// $myObj->list = array(1,2,3);
// $myObj->list[0] = 7;
// $myJSON = json_encode($myObj);
// echo $myJSON;

$url = 'https://marconi-197806.firebaseio.com/pizzaApp.json';

$curl = curl_init();
curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_USERAGENT => 'Marconi test'
    )
);
$output = curl_exec($curl);
curl_close($curl);
if ($output) {
    // Just for debug
    // echo $output;
} else {
    echo $url;
}


$obj = json_decode($output);
// Convert to EUR, if needed
if ($obj->currency == "USD") {
    $obj->currency = "EUR";
    for($x = 0; $x < count($obj->pizzaList); $x++) {
        $obj->pizzaList[$x]->price *= 0.81;
    }
}
$objJson = json_encode($obj);
echo $objJson;

?>
