<?php
$data = json_decode(file_get_contents('php://input'), true);

var_dump($data);
//echo "Dados via POST: ".$pname." ".$psurname;