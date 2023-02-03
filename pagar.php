<?php
$baseUrl = 'https://webpay3g.transbank.cl/rswebpaytransaction/api/webpay/v1.2/transactions';
/*$ch = curl_init($baseUrl);

$body = array("buy_order"=>"27838", "session_id"=>"sesion127838", "amount"=>50, "return_url"=>"https://https://clsdev.com.br/resposta.php");
$options = [CURLOPT_PUT => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json',
                                    'Tbk-Api-Key-Secret: ',
                                    'Tbk-Api-Key-Id:597035901884'], 
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => json_encode($body)
            ];
curl_setopt_array($ch, $options); 
$data = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
curl_close($ch);
var_dump($data);
*/