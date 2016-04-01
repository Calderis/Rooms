// <?php

// // DONNEES A RECUPERER

// // NON UTILISE DANS LE SITE


// require 'config.php';
// require_once 'fetch_user_data.php';

// $id_room 	= $_GET['id_room'];
// $season 	= $_GET['season'];
// $seasons = 'season'.$_GET['season'];
// $ep 		= $_GET['ep'];
// $id 		= $_GET['id'];

// // Utilisation de Curl
// $curl = curl_init();
// curl_setopt_array($curl, array(
//     CURLOPT_RETURNTRANSFER => 1,
//     CURLOPT_URL => 'http://eztvapi.re/show/'.$id,
//     CURLOPT_USERAGENT => 'Sample cURL Request to EZTV Api'
// ));
// $resp = curl_exec($curl);
// curl_close($curl);

// $objs = json_decode($resp, true);

// // echo '<pre>';
// // print_r($objs);
// // echo '</pre>';

// // boucle dans notre tableau d'épisodes = tous les épisodes toutes saisons confondues
// foreach ($objs['episodes'] as $value) {
// 	switch ($value['season']) {
// 		case 1:
// 			$season1[$value['episode']]['ep_resume'] = $value['overview'];
// 			$season1[$value['episode']]['ep_title'] = $value['title'];
// 			break;

// 		case 2:
// 			$season2[$value['episode']]['ep_resume'] = $value['overview'];
// 			$season2[$value['episode']]['ep_title'] = $value['title'];
// 			if(isset($value['torrents']['720p']['url'])) {
// 				$season2[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
// 			}
// 			else {
// 				$season2[$value['episode']]['torrent_hd'] = "undefined";
// 			}

// 			if(isset($value['torrents']['480p']['url'])) {
// 				$season2[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
// 			}
// 			else {
// 				$season2[$value['episode']]['torrent_normal'] = "undefined";
// 			}
// 			break;

// 		case 3:
// 			$season3[$value['episode']]['ep_resume'] = $value['overview'];
// 			$season3[$value['episode']]['ep_title'] = $value['title'];
// 			if(isset($value['torrents']['720p']['url'])) {
// 				$season3[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
// 			}
// 			else {
// 				$season3[$value['episode']]['torrent_hd'] = "undefined";
// 			}

// 			if(isset($value['torrents']['480p']['url'])) {
// 				$season3[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
// 			}
// 			else {
// 				$season3[$value['episode']]['torrent_normal'] = "undefined";
// 			}
// 			break;

// 		case 4:
// 			$season4[$value['episode']]['ep_resume'] = $value['overview'];
// 			$season4[$value['episode']]['ep_title'] = $value['title'];
// 			if(isset($value['torrents']['720p']['url'])) {
// 				$season4[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
// 			}
// 			else {
// 				$season4[$value['episode']]['torrent_hd'] = "undefined";
// 			}

// 			if(isset($value['torrents']['480p']['url'])) {
// 				$season4[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
// 			}
// 			else {
// 				$season4[$value['episode']]['torrent_normal'] = "undefined";
// 			}
// 			break;

// 		case 5:
// 			$season5[$value['episode']]['ep_resume'] = $value['overview'];
// 			$season5[$value['episode']]['ep_title'] = $value['title'];
// 			if(isset($value['torrents']['720p']['url'])) {
// 				$season5[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
// 			}
// 			else {
// 				$season5[$value['episode']]['torrent_hd'] = "undefined";
// 			}

// 			if(isset($value['torrents']['480p']['url'])) {
// 				$season5[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
// 			}
// 			else {
// 				$season5[$value['episode']]['torrent_normal'] = "undefined";
// 			}
// 			break;

// 		case 6:
// 			$season6[$value['episode']]['ep_resume'] = $value['overview'];
// 			$season6[$value['episode']]['ep_title'] = $value['title'];
// 			if(isset($value['torrents']['720p']['url'])) {
// 				$season6[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
// 			}
// 			else {
// 				$season6[$value['episode']]['torrent_hd'] = "undefined";
// 			}

// 			if(isset($value['torrents']['480p']['url'])) {
// 				$season6[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
// 			}
// 			else {
// 				$season6[$value['episode']]['torrent_normal'] = "undefined";
// 			}
// 			break;

// 		case 7:
// 			$season7[$value['episode']]['ep_resume'] = $value['overview'];
// 			$season7[$value['episode']]['ep_title'] = $value['title'];
// 			if(isset($value['torrents']['720p']['url'])) {
// 				$season7[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
// 			}
// 			else {
// 				$season7[$value['episode']]['torrent_hd'] = "undefined";
// 			}

// 			if(isset($value['torrents']['480p']['url'])) {
// 				$season7[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
// 			}
// 			else {
// 				$season7[$value['episode']]['torrent_normal'] = "undefined";
// 			}
// 			break;

// 		case 8:
// 			$season8[$value['episode']]['ep_resume'] = $value['overview'];
// 			$season8[$value['episode']]['ep_title'] = $value['title'];
// 			if(isset($value['torrents']['720p']['url'])) {
// 				$season8[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
// 			}
// 			else {
// 				$season8[$value['episode']]['torrent_hd'] = "undefined";
// 			}

// 			if(isset($value['torrents']['480p']['url'])) {
// 				$season8[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
// 			}
// 			else {
// 				$season8[$value['episode']]['torrent_normal'] = "undefined";
// 			}
// 			break;

// 		case 9:
// 			$season9[$value['episode']]['ep_resume'] = $value['overview'];
// 			$season9[$value['episode']]['ep_title'] = $value['title'];
// 			if(isset($value['torrents']['720p']['url'])) {
// 				$season9[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
// 			}
// 			else {
// 				$season9[$value['episode']]['torrent_hd'] = "undefined";
// 			}

// 			if(isset($value['torrents']['480p']['url'])) {
// 				$season9[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
// 			}
// 			else {
// 				$season9[$value['episode']]['torrent_normal'] = "undefined";
// 			}
// 			break;

// 		case 10:
// 			$season10[$value['episode']]['ep_resume'] = $value['overview'];
// 			$season10[$value['episode']]['ep_title'] = $value['title'];
// 			if(isset($value['torrents']['720p']['url'])) {
// 				$season10[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
// 			}
// 			else {
// 				$season10[$value['episode']]['torrent_hd'] = "undefined";
// 			}

// 			if(isset($value['torrents']['480p']['url'])) {
// 				$season10[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
// 			}
// 			else {
// 				$season10[$value['episode']]['torrent_normal'] = "undefined";
// 			}
// 			break;

// 		case 11:
// 			$season11[$value['episode']]['ep_resume'] = $value['overview'];
// 			$season11[$value['episode']]['ep_title'] = $value['title'];
// 			if(isset($value['torrents']['720p']['url'])) {
// 				$season11[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
// 			}
// 			else {
// 				$season11[$value['episode']]['torrent_hd'] = "undefined";
// 			}

// 			if(isset($value['torrents']['480p']['url'])) {
// 				$season11[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
// 			}
// 			else {
// 				$season11[$value['episode']]['torrent_normal'] = "undefined";
// 			}
// 			break;

// 		case 12:
// 			$season12[$value['episode']]['ep_resume'] = $value['overview'];
// 			$season12[$value['episode']]['ep_title'] = $value['title'];
// 			if(isset($value['torrents']['720p']['url'])) {
// 				$season12[$value['episode']]['torrent_hd'] = $value['torrents']['720p']['url'];
// 			}
// 			else {
// 				$season12[$value['episode']]['torrent_hd'] = "undefined";
// 			}

// 			if(isset($value['torrents']['480p']['url'])) {
// 				$season12[$value['episode']]['torrent_normal'] = $value['torrents']['480p']['url'];
// 			}
// 			else {
// 				$season12[$value['episode']]['torrent_normal'] = "undefined";
// 			}
// 			break;
// 	}
// }

// // Get right value of desired season to update database

// switch ($season) {
// 		case 1:
// 			$title_episode = $season1[$value['episode']]['ep_title'];
// 			$torrent_normal = $season1[$ep]['torrent_normal'];
// 			$torrent_hd = $season1[$ep]['torrent_hd'];
// 			break;
// 		case 2:
// 			$title_episode = $season2[$value['episode']]['ep_title'];
// 			$torrent_normal = $season2[$ep]['torrent_normal'];
// 			$torrent_hd = $season2[$ep]['torrent_hd'];
// 			break;
// 		case 3:
// 			$title_episode = $season3[$value['episode']]['ep_title'];
// 			$torrent_normal = $season3[$ep]['torrent_normal'];
// 			$torrent_hd = $season3[$ep]['torrent_hd'];
// 			break;
// 		case 4:
// 			$title_episode = $season4[$value['episode']]['ep_title'];
// 			$torrent_normal = $season4[$ep]['torrent_normal'];
// 			$torrent_hd = $season4[$ep]['torrent_hd'];
// 			break;
// 		case 5:
// 			$title_episode = $season5[$value['episode']]['ep_title'];
// 			$torrent_normal = $season5[$ep]['torrent_normal'];
// 			$torrent_hd = $season5[$ep]['torrent_hd'];
// 			break;
// 		case 6:
// 			$title_episode = $season6[$value['episode']]['ep_title'];
// 			$torrent_normal = $season6[$ep]['torrent_normal'];
// 			$torrent_hd = $season6[$ep]['torrent_hd'];
// 			break;
// 		case 7:
// 			$title_episode = $season7[$value['episode']]['ep_title'];
// 			$torrent_normal = $season7[$ep]['torrent_normal'];
// 			$torrent_hd = $season7[$ep]['torrent_hd'];
// 			break;
// 		case 8:
// 			$title_episode = $season8[$value['episode']]['ep_title'];
// 			$torrent_normal = $season8[$ep]['torrent_normal'];
// 			$torrent_hd = $season8[$ep]['torrent_hd'];
// 			break;
// 		case 9:
// 			$title_episode = $season9[$value['episode']]['ep_title'];
// 			$torrent_normal = $season9[$ep]['torrent_normal'];
// 			$torrent_hd = $season9[$ep]['torrent_hd'];
// 			break;
// 		case 10:
// 			$title_episode = $season10[$value['episode']]['ep_title'];
// 			$torrent_normal = $season10[$ep]['torrent_normal'];
// 			$torrent_hd = $season10[$ep]['torrent_hd'];
// 			break;
// 		case 11:
// 			$title_episode = $season11[$value['episode']]['ep_title'];
// 			$torrent_normal = $season11[$ep]['torrent_normal'];
// 			$torrent_hd = $season11[$ep]['torrent_hd'];
// 			break;
// 		case 12:
// 			$title_episode = $season12[$value['episode']]['ep_title'];
// 			$torrent_normal = $season12[$ep]['torrent_normal'];
// 			$torrent_hd = $season12[$ep]['torrent_hd'];
// 			break;
// 	}

// 	echo '<pre>';
// 	print_r($seaons1);
// 	echo '</pre>';

// 	// mettre a jour les information de la room que l'on vient de créer
// 	$update = $pdo->prepare('UPDATE room SET torrent_hd = "'. $torrent_hd .'" WHERE id_room ="'.$id_room.'"');
// 	$update_2 = $pdo->prepare('UPDATE room SET torrent_normal = "'. $torrent_normal .'" WHERE id_room ="'.$id_room.'"');
// 	$update_x = $pdo->prepare('UPDATE users SET '. $room .' = '. $id_room .' WHERE fb_token = '. $_SESSION['fb_token'] .'');

// 	if($update->execute() && $update_2->execute()) {
// 		header('Location: room.html?id='.$id_room);
// 		exit;
// 	}
// 	else{
// 		header('Location: ../not-found.php');
// 		exit;
// 	}