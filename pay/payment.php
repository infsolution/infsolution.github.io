<?php

$content = trim(file_get_contents("php://input"));
$post = json_decode($content);
//var_dump($post->transaction_amount);
$data =[];
$data["transaction_amount"]=floatval($post->transaction_amount);
$data["token"]=$post->token;
$data["description"]="Carro de boi sem rodas.";
$data["installments"]=$post->installments;
$data["payment_method_id"]=$post->payment_method_id;
$data["issuer_id"]=$post->issuer_id;
$data["payer"]["email"]=$post->payer->email;

//var_dump($data);

$mpUrl = "https://api.mercadopago.com/v1/payments";
$ch = curl_init($mpUrl);
$options = [CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json',
                                    'Authorization: Bearer TEST-7608988660775768-032015-79c61f18ea0d1936a9215a5dc1ba12b4-167119886'
                                ], 
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS=>json_encode($data)
            ];
curl_setopt_array($ch, $options); 

$result = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
curl_close($ch);
$response =  json_decode($result);


echo json_encode($response);