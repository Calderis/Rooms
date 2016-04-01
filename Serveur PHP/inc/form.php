<?php

require 'fetch_user_data.php';

// Tester si on a envoyé qqch depuis la barre de recherche
if(isset($_POST) && !empty($_POST['search'])) {
	$search = $_POST['search'];
	$prepare = $pdo->prepare('SELECT * FROM search WHERE name LIKE :name LIMIT 1');
	$prepare->bindValue(':name', "%".$search."%");
	$prepare->execute();
	$info = $prepare->fetch();
	header('Location: show.php?id='.$info->id_serie);
	exit;
}

function get_errors() {
	$result = array();
	if(empty($_POST['day']))
		$result['day'] = true;
	if(empty($_POST['num']))
		$result['num'] = true;
	if(empty($_POST['month']))
		$result['month'] = true;
	if(empty($_POST['hour']))
		$result['hour'] = true;
	if(empty($_POST['min']))
		$result['min'] = true;
	if(empty($_POST['id_serie']))
		$result['id_serie'] = true;
	if(empty($_POST['num_epi']))
		$result['num_epi'] = true;
	if(empty($_POST['num_sais']))
		$result['num_sais'] = true;

	return $result;
}

function str2hex($string) {
  $hex = "";
  for ($i = 0; $i < strlen($string); $i++) {
    $hex .= (strlen(dechex(ord($string[$i]))) < 2) ?
    "0" . dechex(ord($string[$i])) : dechex(ord($string[$i]));
  }
  return $hex;
}

function rand_name() {
	$names = array(
		"Room 1",
		"Room 2",
		"Room 3",
		"The place to be",
		"Better than Counter Strike",
		"Miami Bitch",
		"Hotter than your bedroom",
		"Walter White was here",
		"Benderbrau",
		"Baccon and eggs",
		"Whiskey soda",
		"I.C Wiener",
		"Where is the bathroom ?",
		"Room service",
		"Mushrooms",
		"Showromm",
		"Playroom",
	);

	$rand_name = array_rand($names, 1);
	return $names[$rand_name];
}

$errors = array();
$success = array();

if(isset($_POST['submit']) && ($_POST['submit'] == "It's done !")) {
	// tester si on a encore une room de libre
	if(($info->id_room_1 != '') && ($info->id_room_2 != '') && ($info->id_room_3 != '')) {
		header('Location: error.php');
		exit;
	}

	$errors = get_errors();

	if(empty($errors)) {

		if(empty($_POST['roomName']))
			$room_name = rand_name();
		else
			$room_name = $_POST['roomName'];

		$prepare = $pdo->prepare('INSERT INTO room (id_room,id_serie,room_name,timer,current_episode,saison) VALUES (:id_room,:id_serie,:room_name,:timer,:current_episode,:saison)');
		$id_room = date('YmdHis');
		$id_room = str2hex($id_room);
		$prepare->bindValue(':id_room', $id_room);
		$prepare->bindValue(':id_serie', strtolower($_POST['id_serie']));
		$prepare->bindValue(':room_name', $room_name);
		$prepare->bindValue('timer', $_POST['day'].'-'.$_POST['num'].'-'.$_POST['month'].':'.$_POST['hour'].':'.$_POST['min']);
		$prepare->bindValue(':current_episode', $_POST['num_epi']);
		$prepare->bindValue(':saison', $_POST['num_sais']);
		if($prepare->execute()) {
			// on regarde quelle room n'est pas utilisée
			if($info->id_room_1 == 0 || $info->id_room_1 == "")
				$room = "id_room_1";
			else if($info->id_room_2 == 0 || $info->id_room_2 == "")
				$room = "id_room_2";
			else
				$room = "id_room_3";

			// on met a jour les informations du compte
			$update = $pdo->prepare('UPDATE users SET '. $room .' = "'. $id_room .'" WHERE fb_token = "'. $_SESSION['fb_token'] .'"');
			
			if($update->execute()) {
				header('Location: inc/put_data.php?id_room='.$id_room.'&season='.$_POST['num_sais'].'&ep='.$_POST['num_epi'].'&id='.strtolower($_POST['id_serie']));
				exit;
			}
			else{
				header('Location: not-found.php');
				exit;
			}
		}
		else{
			header('Location: not-found.php');
			exit;
		}
	}
}