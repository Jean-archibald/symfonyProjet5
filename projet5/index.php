<?php
require __DIR__.'/Web/Bootstrap.php';
$url = '';
if (isset($_GET['url']))
{
    $url = $_GET['url'];
}

//PARTIE PUBLIC
//connexion
if($url == '')
{
    $title = 'Blog Delafontaine';
    $descriptionMeta = 'Accueil du blog sur du developpeur Delafontaine';
    $direction = 'homePublic';
    require __DIR__.'/Controller/public/homePublicController.php';

}

