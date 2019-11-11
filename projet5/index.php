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
//accueil Admin
elseif(preg_match('#homeAdmin#', $url , $params))
{
    $title = 'Accueil du backoffice';
    $descriptionMeta = 'Accueil du backoffice du blog';
    require __DIR__.'/Controller/admin/homeAdminController.php';
}
//Gestion Article
//rédiger
elseif(preg_match('#redigerArticle#', $url , $params))
{
    $title = 'Rédiger un article';
    $descriptionMeta = 'Rédaction d\'un article';
    require __DIR__.'/Controller/admin/writeAdminController.php';
}
//modifier un article
elseif(preg_match('#modifierArticle-([0-9]+)#', $url , $params))
{
    $title = 'Rédaction d\'un article';
    $descriptionMeta = 'Partie Admin de la modification des articles';
    $id = $params[1];
    require __DIR__.'/Controller/admin/modifyNewsAdminController.php';
}
//liste article
elseif(preg_match('#listeArticles-([0-9]+)-([0-9]+)#', $url , $params))
{
    $title = 'Liste des articles';
    $descriptionMeta = 'La liste des articles';
    $cutUrl = explode("-", $url);
    $base = $cutUrl[0];
    $pag = $params[1];
    $id = $params[2];
    require __DIR__.'/Controller/admin/newsListAdminController.php';
}