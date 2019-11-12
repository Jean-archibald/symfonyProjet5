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

//lire article
elseif(preg_match('#lire-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    require __DIR__.'/Controller/public/uniqueNewsPublicController.php';
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
//Gestion Abonné
//liste abonné
elseif(preg_match('#listeAbonne-([0-9]+)-([0-9]+)#', $url , $params))
{
    $title = 'Liste des abonnés';
    $descriptionMeta = 'La liste des abonnés';
    $cutUrl = explode("-", $url);
    $base = $cutUrl[0];
    $pag = $params[1];
    $id = $params[2];
    require __DIR__.'/Controller/admin/userListAdminController.php';
}
//Gestion Corbeille
//liste abonné dans corbeille
elseif(preg_match('#corbeilleAbonnes-([0-9]+)-([0-9]+)#', $url , $params))
{
    $title = 'Liste des abonnés dans la corbeille';
    $descriptionMeta = 'Corbeille : La liste des abonnés';
    $cutUrl = explode("-", $url);
    $base = $cutUrl[0];
    $pag = $params[1];
    $id = $params[2];
    $trashDirection = "user";
    $modifyFormDirection = "User";
    require __DIR__.'/Controller/admin/trashListAdminController.php';
}
//liste commentaire dans corbeille
elseif(preg_match('#corbeilleCommentaires-([0-9]+)-([0-9]+)#', $url , $params))
{
    $title = 'Liste des commentaires dans la corbeille';
    $descriptionMeta = 'Corbeille : La liste des commentaires';
    $cutUrl = explode("-", $url);
    $base = $cutUrl[0];
    $pag = $params[1];
    $id = $params[2];
    $trashDirection = "comment";
    $modifyFormDirection = "Comment";
    require __DIR__.'/Controller/admin/trashListAdminController.php';
}
//liste article dans corbeille
elseif(preg_match('#corbeilleArticles-([0-9]+)-([0-9]+)#', $url , $params))
{
    $title = 'Liste des articles dans la corbeille';
    $descriptionMeta = 'Corbeille : La liste des articles';
    $cutUrl = explode("-", $url);
    $base = $cutUrl[0];
    $pag = $params[1];
    $id = $params[2];
    $trashDirection = "news";
    $modifyFormDirection = "News";
    require __DIR__.'/Controller/admin/trashListAdminController.php';
}