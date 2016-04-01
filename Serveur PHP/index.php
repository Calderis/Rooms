<?php
 
// start session
session_start();

// if(!empty($_SESSION['fb_token'])) {
//   header('Location: shows.php');
//   exit;
// }

require_once 'inc/config.php';

require_once( 'Facebook/HttpClients/FacebookHttpable.php' );
require_once( 'Facebook/HttpClients/FacebookCurl.php' );
require_once( 'Facebook/HttpClients/FacebookCurlHttpClient.php' );
require_once( 'Facebook/Entities/AccessToken.php' );
require_once( 'Facebook/Entities/SignedRequest.php' );
require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/GraphSessionInfo.php' );

use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;

if(isset($_GET['id']) && !empty($_GET['id'])) {
  $id = $_GET['id'];
  if(isset($_COOKIE['id_room']) && !empty($_COOKIE['id_room'])) {
    header('Location: link.php?id='.$_COOKIE['id_room']);
    exit;
  }
  else {
    setcookie('id_room',$id,time()+60*5);
  }
}
// init app with app id and secret
FacebookSession::setDefaultApplication( '842287929153617','e3d6c4e2db8708229df9839cc1829814' );

// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper( 'http://magnhetic.fr/Room/shows.php' );

// see if a existing session exists
if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
  // create new session from saved access_token
  $fbsession = new FacebookSession( $_SESSION['fb_token'] );
  // on teste si on a un cookie de créé
  if(isset($_COOKIE['id_room']) && !empty($_COOKIE['id_room'])) {
    header('Location: link.php?id='.$_COOKIE['id_room']);
    exit;
  }
  // si on a deja une session d'ouverte alors on redirige vers la page de séries
  header('Location: http://magnhetic.fr/Room/shows.php');
  exit;
  
  // validate the access_token to make sure it's still valid
  try {
    if ( !$fbsession->validate() ) {
      $fbsession = null;
    }
  } catch ( Exception $e ) {
    // catch any exceptions
    echo '<pre>';
    print_r($e);
    echo '</pre>';
    $fbsession = null;
  }
}  

if ( !isset( $fbsession ) || $fbsession === null ) {
  // no session exists
  
  try {
    $fbsession = $helper->getSessionFromRedirect();
  } catch( FacebookRequestException $ex ) {
    // When Facebook returns an error
    echo '<pre>';
    print_r($ex);
    echo '</pre>';
  } catch( Exception $ex ) {
    // When validation fails or other local issues
    echo '<pre>';
    print_r($ex);
    echo '</pre>';
  }
  
}

// if (!isset($_SESSION['access_token'])){
 // header('Location:index.php');
//}

// see if we have a session
if ( isset( $fbsession ) ) {

  
  
  // save the session
  $_SESSION['fb_token'] = $fbsession->getToken();
  // create a session using saved token or the new one we generated at login
  $fbsession = new FacebookSession( $fbsession->getToken() );
  
  // graph api request for user data
  $request = new FacebookRequest( $fbsession, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject()->asArray();
  
  // print profile data
  /*echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';*/

  //récupérer image : 

   /* 
    $prepare = $pdo->prepare('SELECT * FROM users WHERE facebook_id = :fb_id LIMIT 1');
    $prepare->bindValue(':fb_id',$_POST['$facebook_id']);
    $prepare->execute();

    $reg = $prepare->fetch();
    
    if($reg===true){

      // create the url 
      $profile_pic =  "http://graph.facebook.com/".$graphObject["id"]."/picture";
      // echo the image out
      echo "<img src=\"" . $profile_pic . "\" />";
    }
    */

  
  $facebook_id = $graphObject['id'];
  $facebook_name = $graphObject['first_name'];

  $requete = $pdo->prepare('SELECT * FROM users WHERE facebook_id = :facebook_id'); 
  $requete->bindValue(':facebook_id',$facebook_id);
  $requete->execute();

  $rep = $requete->fetch();

  if (empty($rep))
  {
    $prepare = $pdo->prepare('INSERT INTO users (facebook_id,fb_token, prenom) VALUES (:id, :fb_token, :name)');
    $prepare->bindValue(':id', $facebook_id);
    $prepare->bindValue(':fb_token', $_SESSION['fb_token']);
    $prepare->bindValue(':name', $facebook_name);
    $prepare->execute();

    $requete = $pdo->prepare('SELECT * FROM users WHERE facebook_id = :facebook_id'); 
    $requete->bindValue(':facebook_id',$facebook_id);
    $requete->execute();

    $rep = $requete->fetch();

      // print logout url using session and redirect_uri (logout.php page should destroy the session)
    echo '<a href="' . $helper->getLogoutUrl( $fbsession, 'http://magnhetic.fr/Room/logout.php' ) . '">Logout</a>';
  
  }
  $_SESSION['id'] = $facebook_id; 
     
/*
function is_facebookid_in_db($facebook_id){
  //requete sql qui regarde si il est présent dans la DB
  return true // return false
}*/

 /* echo '<pre>';
  print_r($rep);
  echo '</pre>';*/
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Room - Connexion</title>
		<link rel="stylesheet" href="http://magnhetic.fr/Room/css/reset.css">
	    <link rel="stylesheet" href="http://magnhetic.fr/Room/css/styles.css">
	    <link rel="stylesheet" href="http://magnhetic.fr/Room/polices/gotham.css">
	</head>
	<body class="login">
		<div class="center">
           	<div class="logo"></div>
           	<h1>Create your TV Show evening with your friends</h1>
           	<?php 
           	// show login url
         	echo '<a class ="fbC" href="' . $helper->getLoginUrl( array( 'public_profile', 'email' ) ) . '">Connect with facebook</a>';
          	?>
       </div>
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
		<script src="http://magnhetic.fr/Room/js/script.js"></script>
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