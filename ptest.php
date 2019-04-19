<?php

$str_json = file_get_contents('php://input');
$params = json_decode ( $str_json );

$action = $params->{'action'};
$target = $params->{'target'};

$servername = "127.0.0.1";
$username = "root";
$password = "UIUC411";
$database = 'diced_tomatoes';

$sdat[0] = new stdClass();
$sdat[0]->err=0;

echo "test"; exit ("xyzzy");

?>
