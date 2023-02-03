<?php
session_start();

$json_string = 'http://localhost/orbit/retrieve_json.php';

$jsondata = file_get_contents($json_string);
$json_pss = json_decode($jsondata, true);

include_once 'retrieve.html';
session_reset();