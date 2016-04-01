<?php

// ceci est l'adresse qu'on donne aux personnes que l'on veut inviter dans la room

// parametre : ID => id_room

session_start();
// die($_GET['id']);
// quoiqu'il arrive si on a pas d'id alors on vire
if(isset($_GET['id']) && empty($_GET['id'])) {
	header('Location: not-found.php');
	exit;
}

// si on est arrivé ici alors c'est qu'on a un id non vide en parametres
$id = $_GET['id'];

require 'inc/config.php';

// nous permet de récupérer les informations de l'utilisateur via la variable $info
require_once 'inc/fetch_user_data.php';

if(empty($_SESSION['fb_token'])) {
	header('Location: index.php?id='.$id);
	exit;
}
else {
	// si l'id donné est présent dans une de nos rooms on redirige 
    //141.138.157.108
	if(($info->id_room_1 == $id) || ($info->id_room_2 == $id) || ($info->id_room_3 == $id)) {
		header('Location: http://room.magnhetic.fr:9000/index.html?id='.$id.'&user_id='.$info->facebook_id);
		exit;
	}
	// id non présent mais a-t-on de la place dans nos rooms
	else if(($info->id_room_1 != '') && ($info->id_room_2 != '') && ($info->id_room_3 != '')) {
		header('Location: error.php');
		exit;
	}
	// tous nos champs ne sont pas pris, lequel prendre ?
	else {
		if($info->id_room_1 == "")
			$room = "id_room_1";
		else if($info->id_room_2 == "")
			$room = "id_room_2";
		else
			$room = "id_room_3";
		// on a trouvé notre champ vide alors on enregistre notre pass pour rentrer dans la salle
		$prepare = $pdo->prepare('INSERT INTO users ('.$room.') VALUES (:room) WHERE fb_token = :fb_token');
		$prepare->bindValue(':room', $id);
		$prepare->bindValue(':fb_token', $_SESSION['fb_token']);
		// si on réussi a enregistré alors on va dans la salle avec nos identifiants
		if($prepare->execute()) {
			header('Location: http://room.magnhetic.fr:9000/index.html?id='.$id.'&user_id='.$info->facebook_id);
			exit;
		}
		// sinon on va sur la page not-found
		else {
			header('Location: not-found.php');
			exit;
		}
	}
}