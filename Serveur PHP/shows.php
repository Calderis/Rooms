<?php
session_start();
if(empty($_SESSION['fb_token'])) {
	header('Location: index.php');
	exit;
}

require 'inc/config.php';
include 'inc/form.php';

// nous permet de récupérer les informations de l'utilisateur via la variable $info
require_once 'inc/fetch_user_data.php';
// die($_SESSION['fb_token']);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Room - Page n° 1</title>
	    <meta name="description" content="Description du site">
	    <link rel="stylesheet" href="css/reset.css">
	    <link rel="stylesheet" href="css/styles.css">
	    <link rel="stylesheet" href="polices/gotham.css">
	</head>
	<body class="series">
	<!-- HEADER = déconnexion, boutons interactions -->
		<header>
           	<div class="logo"></div>
           	<ul class="nav" id="nav">
               	<li name="rooms" class="rooms" onclick="showBan('A','rooms')"></li>
               	<li name="programm" class="programm" onclick="showBan('B','programm')"></li>
               	<li name="mostViews" class="mostViews" onclick="showBan('C','mostViews')"></li>
               	<li name="search" class="search" onclick="showBan('D','search')"></li>
           	</ul>
           	<div class="profil">
               	<img id="pict" src="http://graph.facebook.com/<?= $info->facebook_id ?>/picture" alt="Picture <?= $info->prenom ?>">
               	<span id="name"><?= $info->prenom ?></span>
               	<input type="button" class="disconnect">
           	</div>
       	</header>
       	<!-- FIN HEADER -->
       	<section class="suggestions">
           	<ul class="carroussel">
               	<li id="rooms" class="stateD">
                  	<h1>your rooms</h1>
                  	<div class="firstroom" data-url="<?= $info->id_room_1 ?>">
                    	<p class="timer">7 days left</p>
                    	<div class="legend">
                        	<h2>house of cards</h2>
                        	<p>Season 2 Episode 23</p>
                    	</div>
                  	</div>
                  	<div class="secondroom" data-url="<?= $info->id_room_2 ?>">
                    	<p class="timer">7 days left</p>
                    	<div class="legend">
                        	<h2>house of cards</h2>
                        	<p>Season 2 Episode 23</p>
                    	</div>
                  	</div>
               	</li>
               	<li id="programm" class="stateD">
                  	<div class="top">
                     	<ul class="pos" id="selectPgrm">
                           	<li onclick="pgrm('A','Feb 20, 2014',4,21,564)" class="selected"></li>
                           	<li onclick="pgrm('B','DEC 20, 2015',5,89,1264)"></li>
                           	<li onclick="pgrm('C','JAN 20, 2014',1,12,673)"></li>
                       	</ul>
                       	<div class="anounce">
                           	<h2>This evening at</h2>
                           	<h3 id='rdv'>19h30</h3>
                           	<input type="button" value="enter room">
                       	</div>
                  	</div>
                  	<div class="down">
                      	<ul class="selection" id="selection">
                          	<li id="GoT"></li>
                          	<li id="walkingdead"></li>
                          	<li id="bigbang"></li>
                      	</ul>
                  	</div>
                  	<div class="blur"></div>
                   	<div class="blurup">
                       	<div class="infoA">
                           	<div class="col-2">published <span id="date">feb 20, 2014</span></div>
                           	<div class="col-2">rating 
                                <span id="stars">
                                   	<div class="full"></div>
                                   	<div class="full"></div>
                                   	<div class="full"></div>
                                   	<div class="full"></div>
                                   	<div class="empty"></div>
                               	</span>
                           	</div>
                       	</div>
                       	<div class="infoB">
                           	<div class="connected"><span id="connected">21</span></div>
                           	<div class="views"><span id="views">564</span></div>
                       	</div>
                   	</div>
               </li>
               <li id="mostViews" class="stateD">
                  <div class="black">
                    <h1>most seen</h1>
                    <div class="result">
                      <h2 id="namesecond">NCIS</h2>
                      <h2 id="namefirst">the big bang theory</h2>
                      <h2 id="namethird">the walking dead</h2>
                      <div class="second"></div>
                      <div class="first"></div>
                      <div class="third"></div>
                    </div>
                  </div>
               </li>
               <li id="search" class="stateD">
                <div class="img">
                    <img src="images/peinture.png" alt="">
                </div>
                <div class="search">
                    <form action="#" class="searchbar" method="post">
                    	<input type="text" class="search_input" name="search" placeholder="Click me to search">
                    </form>
                </div>
               </li>
           </ul>
       </section>
       	<!-- Requête pour avoir les posters de films + informations de bases -->
       	<?php
       	// page a appeler pour avoir les informations
		$ch = curl_init('http://eztvapi.re/shows/1'); // Le 1 correspond à la page n°1 sur l'api
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Send the request & save response to $resp
		$resp = curl_exec($ch);
		// Close request to clear up some resources
		curl_close($ch);
		// on décode les informations pour les exploiter
		$objs = json_decode($resp, true);
		// définition des variables utilisées
		$ul_id = 'A'; // correspond a la 'rows' affichée
		$i = 1; // coorrespond au numéro du film
		$j = 1; // correspond à la position dans la 'rows' => 1 rows = 5 affiches en ligne

		?>
       	<!-- CORPS DU SITE -->
       	<section class="listItems">
			<ul id="<?= $ul_id ?>" class="series">
				<?php
				foreach ($objs as $obj) :
					$id = $obj['_id']; // id de la série
					$poster = $obj['images']['poster']; // image de la série
				?>
				<!-- Affichage de l'affiche/série -->
				<li name="<?= $id ?>" data-ulid="<?= $ul_id ?>" data-j="<?= $j ?>" data-id="<?= $id ?>">
					<img src="<?= $poster ?>" alt="">
					<span class="hover">
	           			<div class="see"></div>
	       			</span>
	   			</li>

				<?php
					// Si on est arrivé à 5 affiches sur notre ligne alors on ferme celle actuelle pour en ouvrir une autre
					if($i%5 == 0) :
						$j = 1; // on réinitialise notre position d'affiche sur la ligne
				?>
			<!-- Fermer la ligne -->
			</ul>
			<!-- Afficher le bloc de description -->
			<?= '<div id="desc'.$ul_id.'" class="descBlock">' ?>
			<!-- <div id="desc"> -->
	          	<div class="cross" onclick="closeIt('<?= $ul_id ?>')"></div>
	               	<div class="center">
	                   	<div class="hist">
	                       	<h1 class="title"></h1>
	                       	<h1 class="id_serie_title"></h1>
	                       	<br />
	                       	<h4 class="type"></h4>
	                       	<div id="rank">
	                           	<span id="stars">
	                               	<div class="full"></div>
	                               	<div class="full"></div>
	                               	<div class="full"></div>
	                               	<div class="full"></div>
	                               	<div class="empty"></div>
	                           	</span>
	                       	</div>
	                       	<p class="synopsis"></p>
	                   	</div>
	                   	<div class="episodes">
	                       	<ul class="listSais"></ul>
	                       	<div class="setup" id="setup<?= $ul_id ?>">
	                            <div class="fen">
                                  	<div class="padding">
	                                   	<h1>Configure name and date</h1>
	                                   	<form action="#" method="post">
	                                    <!-- <input type="text" name="id_room" value="" id="id_room<?= $ul_id ?>"> -->
	                                       	<input type="text" value="" class="roomName" name="roomName" placeholder="Name of your room"><br>
	                                       	<select name="day" id="day">
	                                           	<option value="1">Monday</option>
	                                           	<option value="2">Tuesday</option>
	                                           	<option value="3">Wednesday</option>
	                                           	<option value="4">Thursday</option>
	                                           	<option value="5" selected>Friday</option>
	                                           	<option value="6">Saturday</option>
	                                           	<option value="7">Sunday</option>
	                                       	</select>
	                                       	<select name="num" id="num">
	                                           	<option value="1">1</option>
	                                           	<option value="2">2</option>
	                                           	<option value="3">3</option>
	                                           	<option value="4">4</option>
	                                           	<option value="5">5</option>
	                                           	<option value="6">6</option>
	                                           	<option value="7">7</option>
	                                           	<option value="8">8</option>
	                                           	<option value="9">9</option>
	                                           	<option value="10">10</option>
	                                           	<option value="11">11</option>
	                                           	<option value="12">12</option>
	                                           	<option value="13">13</option>
	                                           	<option value="14">14</option>
	                                           	<option value="15">15</option>
	                                           	<option value="16">16</option>
	                                           	<option value="17" selected>17</option>
	                                           	<option value="18">18</option>
	                                           	<option value="19">19</option>
	                                           	<option value="20">20</option>
	                                           	<option value="21">21</option>
	                                           	<option value="22">22</option>
	                                           	<option value="23">23</option>
	                                           	<option value="24">24</option>
	                                           	<option value="25">25</option>
	                                           	<option value="26">26</option>
	                                           	<option value="27">27</option>
	                                           	<option value="28">28</option>
	                                           	<option value="29">29</option>
	                                           	<option value="30">30</option>
	                                           	<option value="21">31</option>
	                                       	</select>
	                                       	<select name="month" id="month">
	                                           	<option value="1">January</option>
	                                           	<option value="2">February</option>
	                                           	<option value="3">Wednesday</option>
	                                           	<option value="4">March</option>
	                                           	<option value="5" selected>April</option>
	                                           	<option value="6">May</option>
	                                           	<option value="7">June</option>
	                                           	<option value="8">July</option>
	                                           	<option value="9">August</option>
	                                           	<option value="7">September</option>
	                                           	<option value="10">October</option>
	                                           	<option value="11">November</option>
	                                           	<option value="12">December</option>
	                                       	</select>
	                                       	<select name="hour" id="hour">
	                                           	<option value="0">00</option>
	                                           	<option value="1">1</option>
	                                           	<option value="2">2</option>
	                                           	<option value="3">3</option>
	                                           	<option value="4">4</option>
	                                           	<option value="5">5</option>
	                                           	<option value="6">6</option>
	                                           	<option value="7">7</option>
	                                           	<option value="8">8</option>
	                                           	<option value="9">9</option>
	                                           	<option value="10" selected>10</option>
	                                           	<option value="11">11</option>
	                                           	<option value="12">12</option>
	                                           	<option value="13">13</option>
	                                           	<option value="14">14</option>
	                                           	<option value="15">15</option>
	                                           	<option value="16">16</option>
	                                           	<option value="17">17</option>
	                                           	<option value="18">18</option>
	                                           	<option value="19">19</option>
	                                           	<option value="20">20</option>
	                                           	<option value="21">21</option>
	                                           	<option value="22">22</option>
	                                           	<option value="23">23</option>
	                                       	</select>
	                                       	h
	                                       	<select name="min" id="min">
	                                           	<option value="0">00</option>
	                                           	<option value="1">1</option>
	                                           	<option value="2">2</option>
	                                           	<option value="3">3</option>
	                                           	<option value="4">4</option>
	                                           	<option value="5">5</option>
	                                           	<option value="6">6</option>
	                                           	<option value="7">7</option>
	                                           	<option value="8">8</option>
	                                           	<option value="9">9</option>
	                                           	<option value="10">10</option>
	                                           	<option value="11">11</option>
	                                           	<option value="12">12</option>
	                                           	<option value="13">13</option>
	                                           	<option value="14">14</option>
	                                           	<option value="15">15</option>
	                                           	<option value="16">16</option>
	                                           	<option value="17">17</option>
	                                           	<option value="18">18</option>
	                                           	<option value="19">19</option>
	                                           	<option value="20">20</option>
	                                           	<option value="21">21</option>
	                                           	<option value="22">22</option>
	                                           	<option value="23">23</option>
	                                           	<option value="24">24</option>
	                                           	<option value="25">25</option>
	                                           	<option value="26">26</option>
	                                           	<option value="27">27</option>
	                                           	<option value="28">28</option>
	                                           	<option value="29">29</option>
	                                           	<option value="30">30</option>
	                                           	<option value="31">31</option>
	                                           	<option value="32">32</option>
	                                           	<option value="33">33</option>
	                                           	<option value="34">34</option>
	                                           	<option value="35">35</option>
	                                           	<option value="36">36</option>
	                                           	<option value="37">37</option>
	                                           	<option value="38">38</option>
	                                           	<option value="39">39</option>
	                                           	<option value="40">40</option>
	                                           	<option value="41">41</option>
	                                           	<option value="42">42</option>
	                                           	<option value="43">43</option>
	                                           	<option value="44">44</option>
	                                           	<option value="45">45</option>
	                                           	<option value="46">46</option>
	                                           	<option value="47">47</option>
	                                           	<option value="48" selected>48</option>
	                                           	<option value="49">49</option>
	                                           	<option value="50">50</option>
	                                           	<option value="51">51</option>
	                                           	<option value="52">52</option>
	                                           	<option value="53">53</option>
	                                           	<option value="54">54</option>
	                                           	<option value="55">55</option>
	                                           	<option value="56">56</option>
	                                           	<option value="57">57</option>
	                                           	<option value="58">58</option>
	                                           	<option value="59">59</option>
	                                           	<option value="60">60</option>
	                                       	</select>
	                                       	min
	                                       	<br />
	                                     	<input type="number" name="num_sais"value="" placeholder="Numéro de saison" id="num_sais<?= $ul_id ?>">
	                                     	<input type="number" name="num_epi" value="" placeholder="Episode" id="num_epi<?= $ul_id ?>">
	                                     	<input type="text" name="id_serie" value="" placeholder="ID de la série (sous le nom)" id="id_serie<?= $ul_id ?>">
	                                       	<input type="submit" name="submit" id="submit" value="It's done !">
	                                   	</form>
	                               	</div>
	                            </div>
	                       	</div>
	                       	<ul class="listEpi open" id="listEpi<?= $ul_id ?>"></ul>
	                   	</div>
	               	</div>
	       		</div>
	       	</div>
	       	<?php $ul_id++; ?> <!-- Incrémenter le nom de la ligne / Passer de la ligne A a la ligne B et ainsi de suite -->
			<!-- Rouvrir une ligne avec les bons paramètres -->
			<ul id="<?= $ul_id ?>" class="series">
				<?php
					endif; // on sort de notre test si on est a 5 affiches pour la ligne
					$i++; // incrémenter notre numéro d'affiche par rapport à la page
					$j++; // incrémenter notre numéro d'affiche pour notre nouvelle ligne
				endforeach;
				?>
			</ul>
		</section>
       	<!-- FIN CORPS DU SITE -->
       	<!-- FOOTER -->
		<footer>
	       	<ul>
	           	<li><a href="policy.php">Piracy policy</a></li>
	           	<li><a href="contact.php">Contacts</a></li>
	           	<li class="logo"><a href="shows.php"></a></li>
	       	</ul>
	   	</footer>
	   	<!-- FIN FOOTER -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="js/script.js"></script>
	    <script>
	      window.fbAsyncInit = function() {
	        FB.init({
	          appId      : '1404339073219884',
	          xfbml      : true,
	          version    : 'v2.3'
	        });
	      };

	      (function(d, s, id){
	         var js, fjs = d.getElementsByTagName(s)[0];
	         if (d.getElementById(id)) {return;}
	         js = d.createElement(s); js.id = id;
	         js.src = "//connect.facebook.net/en_US/sdk.js";
	         fjs.parentNode.insertBefore(js, fjs);
	       }(document, 'script', 'facebook-jssdk'));
	    </script>
    </body>
</html>