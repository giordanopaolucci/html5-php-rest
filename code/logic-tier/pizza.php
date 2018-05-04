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
$localPath = '/data-tier/data.json';
$host = $_SERVER["HTTP_HOST"];

// on docker for linux, host.docker.internal is not yet supported
// luckily, we need it only for localhost testing! So when the code is 
// deployed on the rpi, we can use the true host (TODO to verify)
if (strcmp($output,"localhost:8080")) {
  $baseUrl = 'host.docker.internal:8080';
} else {
  $baseUrl = $host;
}
$url = 'http://' . $baseUrl . $localPath;
echo $url;
exit;

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
for($x = 0; $x < count($obj->pizzaList); $x++) {
    $obj->pizzaList[$x]->price *= 0.81;
}
$objJson = json_encode($obj);
echo $objJson;

?>
