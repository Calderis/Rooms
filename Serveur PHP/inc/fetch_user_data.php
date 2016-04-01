<?php

// récupérer les infos de la personne
$prepare = $pdo->prepare('SELECT * FROM users WHERE fb_token = :fb_token LIMIT 1');
$prepare->bindValue(':fb_token', $_SESSION['fb_token']);
$prepare->execute();
$info = $prepare->fetch();