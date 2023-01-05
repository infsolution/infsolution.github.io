<?php
$token = $_GET["token_ws"];

//$data = json_decode(file_get_contents('php://input'), true);
$baseUrl = 'https://webpay3gint.transbank.cl/rswebpaytransaction/api/webpay/v1.2/transactions/';
$ch = curl_init($baseUrl.$token);

$options = [CURLOPT_PUT => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json',
                                    'Tbk-Api-Key-Secret: 579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C',
                                    'Tbk-Api-Key-Id:597055555532'], 
            CURLOPT_RETURNTRANSFER => true,
            ];
curl_setopt_array($ch, $options); 
$data = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
curl_close($ch);

var_dump($data);