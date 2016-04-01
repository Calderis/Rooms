<?php

if(isset($_GET['id']))
	$id = $_GET['id'];
	
// Utilisation de Curl
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://eztvapi.re/show/'.$id,
    CURLOPT_USERAGENT => 'Sample cURL Request to EZTV Api'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

echo $resp;
// $objs = json_decode($resp, true);

// echo '<pre>';
// print_r($objs);
// echo '</pre>';