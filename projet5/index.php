<?php
session_start();
require __DIR__.'/MyFram/vendor/autoload.php';
$url = '';
if (isset($_GET['url']))
{
    $url = $_GET['url'];
}

//PARTIE PUBLIC
//accueil blog 
if($url == '')
{
    $title = 'Blog Delafontaine';
    $descriptionMeta = 'Accueil du blog du développeur Delafontaine';
    require __DIR__.'/Controller/public/homePublicController.php';

}

elseif(preg_match('#accueil#', $url , $params))
{
    $title = 'Blog Delafontaine';
    $descriptionMeta = 'Accueil du blog du développeur Delafontaine';
    require __DIR__.'/Controller/public/homePublicController.php';

}

//connexion 
elseif(preg_match('#connexion#', $url , $params))
{
    $title = 'Blog Delafontaine / Se connecter';
    $descriptionMeta = 'Connexion pour les membres';
    require __DIR__.'/Controller/public/connexionPublicController.php';

}

//inscription
elseif(preg_match('#inscription#', $url , $params))
{
    $title = 'Blog Delafontaine / Inscription';
    $descriptionMeta = 'Devenir membre';
    require __DIR__.'/Controller/public/inscriptionPublicController.php';

}
//PARTIE ADMIN
//Gestion Article
//rédiger
