<?php

$query = '{"query":"{    countries {      name      code    }}"}';
$queryOne = '{"query":"{  country(code: \"BR\") { name  native  emoji  currency    languages { code   name }}}"}';


$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_POST => true,
    CURLOPT_URL => 'https://countries.trevorblades.com',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS=>$queryOne,
    CURLOPT_HTTPHEADER =>['Content-Type: application/json']
]);
$response = curl_exec($curl);

curl_close($curl);
$result = json_decode(json_encode($response));


header('Content-Type: application/json'); 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin,Content-Type');

echo $response;