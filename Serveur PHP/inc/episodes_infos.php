<?php

// id de notre sairie
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

// echo $resp;

$objs = json_decode($resp, true);

$serie = array();

foreach ($objs['episodes'] as $value) {
	$serie[$value['season']][$value['episode']]['num_episode'] = $value['episode'];
	$serie[$value['season']][$value['episode']]['ep_title'] = $value['title'];
	$serie[$value['season']][$value['episode']]['ep_description'] = $value['overview'];
}

$serie = json_encode($serie);
echo $serie;

// echo '<pre>';
// print_r($objs);
// echo '</pre>';