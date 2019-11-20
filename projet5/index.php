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

//deconnexion
elseif(preg_match('#sessiondestroy#', $url , $params))
{
    require __DIR__.'/Controller/public/deconnexionPublicController.php';
}

//inscription
elseif(preg_match('#inscription#', $url , $params))
{
    $title = 'Blog Delafontaine / Inscription';
    $descriptionMeta = 'Devenir membre';
    require __DIR__.'/Controller/public/inscriptionPublicController.php';

}

//liste des articles
elseif(preg_match('#articles-([0-9]+)#', $url , $params))
{
    $cutUrl = explode("-", $url);
    $base = $cutUrl[0];
    $pag = $params[1];
    $title = 'La liste des articles publiés';
    require __DIR__.'/Controller/public/listPublicController.php';
}

//lire article
elseif(preg_match('#lire-([0-9]+)-([0-9]+)#', $url , $params))
{
    $cutUrl = explode("-", $url);
    $base = $cutUrl[0];
    $id = $params[1];
    $comment = $params[2];
    require __DIR__.'/Controller/public/uniqueNewsPublicController.php';
}

//erreur d'autorisation de statut
elseif(preg_match('#error404#', $url , $params))
{
    $title = 'Blog Delafontaine / Erreur 404';
    $descriptionMeta = 'Accès interdit';
    require __DIR__.'/Controller/public/errorPublicController.php';
}

//PARTIE ADMIN
//accueil Admin
elseif(preg_match('#homeAdmin#', $url , $params))
{
    $title = 'Accueil du backoffice';
    $descriptionMeta = 'Accueil du backoffice du blog';
    $road = 'home';
    require __DIR__.'/Controller/admin/validAdminController.php';
}
//Gestion Article
//rédiger
elseif(preg_match('#redigerArticle#', $url , $params))
{
    $title = 'Rédiger un article';
    $descriptionMeta = 'Rédaction d\'un article';
    $road = 'write';
    require __DIR__.'/Controller/admin/validAdminController.php';
}
//modifier un article
elseif(preg_match('#modifierArticle-([0-9]+)#', $url , $params))
{
    $title = 'Rédaction d\'un article';
    $descriptionMeta = 'Partie Admin de la modification des articles';
    $id = $params[1];
    $road = 'modifyNews';
    require __DIR__.'/Controller/admin/validAdminController.php';
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
    $direction = "news";
    $modifyFormDirection = "News";
    $road = 'list';
    require __DIR__.'/Controller/admin/validAdminController.php';
}
//Gestion Abonné
//liste abonné
elseif(preg_match('#listeAbonnes-([0-9]+)-([0-9]+)#', $url , $params))
{
    $title = 'Liste des abonnés';
    $descriptionMeta = 'La liste des abonnés';
    $cutUrl = explode("-", $url);
    $base = $cutUrl[0];
    $pag = $params[1];
    $id = $params[2];
    $direction = "user";
    $modifyFormDirection = "User";
    $road = 'list';
    require __DIR__.'/Controller/admin/validAdminController.php';
}

//modifier un abonné
elseif(preg_match('#abonne-([0-9]+)#', $url , $params))
{
    $title = 'Modifier un abonné';
    $descriptionMeta = 'Modification abonné';
    $id = $params[1];
    $road = 'modifyUser';
    require __DIR__.'/Controller/admin/validAdminController.php';
}

//Gestion Commentaire
//liste commentaires
elseif(preg_match('#listeCommentaires-([0-9]+)-([0-9]+)#', $url , $params))
{
    $title = 'Liste des commentaire';
    $descriptionMeta = 'La liste des commentaire';
    $cutUrl = explode("-", $url);
    $base = $cutUrl[0];
    $pag = $params[1];
    $id = $params[2];
    $direction = "comment";
    $modifyFormDirection = "Comment";
    $road = 'list';
    require __DIR__.'/Controller/admin/validAdminController.php';
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
    $direction = "userTrash";
    $modifyFormDirection = "User";
    $road = 'list';
    require __DIR__.'/Controller/admin/validAdminController.php';
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
    $direction = "commentTrash";
    $modifyFormDirection = "Comment";
    $road = 'list';
    require __DIR__.'/Controller/admin/validAdminController.php';
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
    $direction = "newsTrash";
    $modifyFormDirection = "News";
    $road = 'list';
    require __DIR__.'/Controller/admin/validAdminController.php';
}