<?php

// Creo un oggetto PHP e lo converto in JSON
// $myObj = new stdClass();
// $myObj->id = "100";
// $myObj->list = array(1,2,3);
// $myObj->list[0] = 7;
// $myJSON = json_encode($myObj);
// echo $myJSON;

// Ipotizziamo che il database non sia su questo tier.
// Facciamo una richiesta HTTP al data tier con curl
$domain = $_SERVER['HTTP_HOST'];
$url = $domain . '/data-tier/data.json';

$curl = curl_init();
curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_USERAGENT => 'Marconi test'
    )
);
$resp = curl_exec($curl);
// echo $resp;

$obj = json_decode($resp);
for($x = 0; $x < count($obj->pizzaList); $x++) {
    $obj->pizzaList[$x]->price *= 0.81;
}
$objJson = json_encode($obj);
echo $objJson;

?>