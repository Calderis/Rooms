<?php

require 'config.php';

$id_room 	= $_GET['id_room'];
$season 	= $_GET['season'];
$seasons = 'season'.$_GET['season'];
$ep 		= $_GET['ep'];
$id 		= $_GET['id'];

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

$objs = json_decode($resp, true);

foreach ($objs['episodes'] as $value) {
	switch ($value['season']) {
		case 1:
			// $season1[$value['episode']]['num_episode'] = $value['episode'];
			// $season1[$value['episode']]['ep_title'] = $value['title'];
			if(isset($value['torrents']['720p']['url'])) {
				$season1[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
			}
			else {
				$season1[$value['episode']]['torrent_hd'] = "undefined";
			}

			if(isset($value['torrents']['480p']['url'])) {
				$season1[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
			}
			else {
				$season1[$value['episode']]['torrent_normal'] = "undefined";
			}
			break;

		case 2:
			// $season2[$value['episode']]['num_episode'] = $value['episode'];
			// $season2[$value['episode']]['ep_title'] = $value['title'];
			if(isset($value['torrents']['720p']['url'])) {
				$season2[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
			}
			else {
				$season2[$value['episode']]['torrent_hd'] = "undefined";
			}

			if(isset($value['torrents']['480p']['url'])) {
				$season2[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
			}
			else {
				$season2[$value['episode']]['torrent_normal'] = "undefined";
			}
			break;

		case 3:
			// $season3[$value['episode']]['num_episode'] = $value['episode'];
			// $season3[$value['episode']]['ep_title'] = $value['title'];
			if(isset($value['torrents']['720p']['url'])) {
				$season3[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
			}
			else {
				$season3[$value['episode']]['torrent_hd'] = "undefined";
			}

			if(isset($value['torrents']['480p']['url'])) {
				$season3[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
			}
			else {
				$season3[$value['episode']]['torrent_normal'] = "undefined";
			}
			break;

		case 4:
			// $season4[$value['episode']]['num_episode'] = $value['episode'];
			// $season4[$value['episode']]['ep_title'] = $value['title'];
			if(isset($value['torrents']['720p']['url'])) {
				$season4[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
			}
			else {
				$season4[$value['episode']]['torrent_hd'] = "undefined";
			}

			if(isset($value['torrents']['480p']['url'])) {
				$season4[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
			}
			else {
				$season4[$value['episode']]['torrent_normal'] = "undefined";
			}
			break;

		case 5:
			// $season5[$value['episode']]['num_episode'] = $value['episode'];
			// $season5[$value['episode']]['ep_title'] = $value['title'];
			if(isset($value['torrents']['720p']['url'])) {
				$season5[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
			}
			else {
				$season5[$value['episode']]['torrent_hd'] = "undefined";
			}

			if(isset($value['torrents']['480p']['url'])) {
				$season5[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
			}
			else {
				$season5[$value['episode']]['torrent_normal'] = "undefined";
			}
			break;

		case 6:
			// $season6[$value['episode']]['num_episode'] = $value['episode'];
			// $season6[$value['episode']]['ep_title'] = $value['title'];
			if(isset($value['torrents']['720p']['url'])) {
				$season6[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
			}
			else {
				$season6[$value['episode']]['torrent_hd'] = "undefined";
			}

			if(isset($value['torrents']['480p']['url'])) {
				$season6[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
			}
			else {
				$season6[$value['episode']]['torrent_normal'] = "undefined";
			}
			break;

		case 7:
			// $season7[$value['episode']]['num_episode'] = $value['episode'];
			// $season7[$value['episode']]['ep_title'] = $value['title'];
			if(isset($value['torrents']['720p']['url'])) {
				$season7[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
			}
			else {
				$season7[$value['episode']]['torrent_hd'] = "undefined";
			}

			if(isset($value['torrents']['480p']['url'])) {
				$season7[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
			}
			else {
				$season7[$value['episode']]['torrent_normal'] = "undefined";
			}
			break;

		case 8:
			// $season8[$value['episode']]['num_episode'] = $value['episode'];
			// $season8[$value['episode']]['ep_title'] = $value['title'];
			if(isset($value['torrents']['720p']['url'])) {
				$season8[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
			}
			else {
				$season8[$value['episode']]['torrent_hd'] = "undefined";
			}

			if(isset($value['torrents']['480p']['url'])) {
				$season8[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
			}
			else {
				$season8[$value['episode']]['torrent_normal'] = "undefined";
			}
			break;

		case 9:
			// $season9[$value['episode']]['num_episode'] = $value['episode'];
			// $season9[$value['episode']]['ep_title'] = $value['title'];
			if(isset($value['torrents']['720p']['url'])) {
				$season9[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
			}
			else {
				$season9[$value['episode']]['torrent_hd'] = "undefined";
			}

			if(isset($value['torrents']['480p']['url'])) {
				$season9[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
			}
			else {
				$season9[$value['episode']]['torrent_normal'] = "undefined";
			}
			break;

		case 10:
			// $season10[$value['episode']]['num_episode'] = $value['episode'];
			// $season10[$value['episode']]['ep_title'] = $value['title'];
			if(isset($value['torrents']['720p']['url'])) {
				$season10[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
			}
			else {
				$season10[$value['episode']]['torrent_hd'] = "undefined";
			}

			if(isset($value['torrents']['480p']['url'])) {
				$season10[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
			}
			else {
				$season10[$value['episode']]['torrent_normal'] = "undefined";
			}
			break;

		case 11:
			// $season11[$value['episode']]['num_episode'] = $value['episode'];
			// $season11[$value['episode']]['ep_title'] = $value['title'];
			if(isset($value['torrents']['720p']['url'])) {
				$season11[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
			}
			else {
				$season11[$value['episode']]['torrent_hd'] = "undefined";
			}

			if(isset($value['torrents']['480p']['url'])) {
				$season11[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
			}
			else {
				$season11[$value['episode']]['torrent_normal'] = "undefined";
			}
			break;

		case 12:
			// $season12[$value['episode']]['num_episode'] = $value['episode'];
			// $season12[$value['episode']]['ep_title'] = $value['title'];
			if(isset($value['torrents']['720p']['url'])) {
				$season12[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
			}
			else {
				$season12[$value['episode']]['torrent_hd'] = "undefined";
			}

			if(isset($value['torrents']['480p']['url'])) {
				$season12[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
			}
			else {
				$season12[$value['episode']]['torrent_normal'] = "undefined";
			}
			break;
	}
}

// Get right value of desired season to update database

switch ($season) {
		case 1:
			$torrent_normal = $season1[$ep]['torrent_normal'];
			$torrent_hd = $season1[$ep]['torrent_hd'];
			break;
		case 2:
			$torrent_normal = $season2[$ep]['torrent_normal'];
			$torrent_hd = $season2[$ep]['torrent_hd'];
			break;
		case 3:
			$torrent_normal = $season3[$ep]['torrent_normal'];
			$torrent_hd = $season3[$ep]['torrent_hd'];
			break;
		case 4:
			$torrent_normal = $season4[$ep]['torrent_normal'];
			$torrent_hd = $season4[$ep]['torrent_hd'];
			break;
		case 5:
			$torrent_normal = $season5[$ep]['torrent_normal'];
			$torrent_hd = $season5[$ep]['torrent_hd'];
			break;
		case 6:
			$torrent_normal = $season6[$ep]['torrent_normal'];
			$torrent_hd = $season6[$ep]['torrent_hd'];
			break;
		case 7:
			$torrent_normal = $season7[$ep]['torrent_normal'];
			$torrent_hd = $season7[$ep]['torrent_hd'];
			break;
		case 8:
			$torrent_normal = $season8[$ep]['torrent_normal'];
			$torrent_hd = $season8[$ep]['torrent_hd'];
			break;
		case 9:
			$torrent_normal = $season9[$ep]['torrent_normal'];
			$torrent_hd = $season9[$ep]['torrent_hd'];
			break;
		case 10:
			$torrent_normal = $season10[$ep]['torrent_normal'];
			$torrent_hd = $season10[$ep]['torrent_hd'];
			break;
		case 11:
			$torrent_normal = $season11[$ep]['torrent_normal'];
			$torrent_hd = $season11[$ep]['torrent_hd'];
			break;
		case 12:
			$torrent_normal = $season12[$ep]['torrent_normal'];
			$torrent_hd = $season12[$ep]['torrent_hd'];
			break;
	}

	// echo $test.'<br/>'.$test1;
// $result = json_encode($test[$ep]);
// echo $result;