<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$newsManager = new \Model\NewsManagerPDO($dao);
$userManager = new \Model\UserManagerPDO($dao);
$commentManager = new \Model\CommentManagerPDO($dao);
include('Web/inc/allpages/modifyCommentPublic.php'); 
$news = $newsManager->getUnique((int) $id);
$newsTitle = $news->title();
$newsId = $news->id();
$title = 'Article : ' . $newsTitle;
$descriptionMeta = $newsTitle;

$autor_id = $news->user_id();
$autor = $userManager->getUserById($autor_id);
$autorFamilyName = $autor['familyName'];
$autorFirstName = $autor['firstName'];

$commentsExistInNewsToPublish = $commentManager->commentsExistInNewsToPublish($newsId);
if($commentsExistInNewsToPublish >= 1)
{

    $numberTotal = $commentManager->countCommentsInNewsToPublish($newsId);
    $infoNumberComments = '<p class="information">Il y a '.$numberTotal.' commentaire(s) publié(s).</p>';
}
else
{
    $numberTotal = 0;
    $infoNumberComments = '<p class="information">Il n\'existe pas encore de commentaire.</p>';
}

ob_start();


?>

<body>

<div class="article">
<?php


echo    '<p>Article publié le ', $news->dateCreated()->format('d/m/Y'),'</p>',
        '<p>Auteur : ',$autorFamilyName,' ', $autorFirstName,'</p>', 
        '<h2 class="titleNews">',$news->title(),'</h2>',
        '<p>', nl2br($news->content()), '</p>','</div>', "\n";
       
?>

</div>

<div class="listComments">
<!-- systeme pagination top -->
<?php
    include('Web/inc/allpages/pagination1.php'); 
?>

<h2 class="h2List">Liste des commentaires</h2>
<?php
        if (isset($message))
        {
            echo '<p class="notificationGreen">',$message, '</p><br />';
        }
    ?>
<?php

if (isset($infoNumberComments))
{
    echo '<p class="information">'.$infoNumberComments.'</p>'; '<br />';
}

    foreach ($commentManager->getListOfCommentToPulishByNews($started,$numberPerPage,$newsId) as $comment)
        {
            $commentAutor_id = $comment->user_id();
            $commentAutor = $userManager->getUserById($commentAutor_id);
            $commentAutorFamilyName = $commentAutor['familyName'];
            $commentAutorFirstName = $commentAutor['firstName'];
            echo 
            'Auteur : ',$commentAutorFamilyName,' ',$commentAutorFirstName,'<br>',
            'Date : ',$comment->dateCreated()->format('d/m/Y'),'<br>',
            'Contenu : ', $comment->content(),'<br>',
            '<form action="',$base.'-',$pag.'-',$newsId.'-',$comment->id(),'" method="post">
            <input name="signal" class="boutonSignal" type="submit" value="Signaler ce commentaire"></form><br>'
            ;
        }
include('Web/inc/allpages/pagination2.php'); 
?>
</div>
<div class="comments">
<?php 
if (isset($_SESSION) && isset($_SESSION['status']) && !empty($_SESSION['status']))
{
?>

    <form action="<?=$url?>" method="post">    
        <p>
            <label for="comment">Laissez un commentaire : </label><br>  
            <textarea name="comment" id="comment" cols="30" rows="3" ></textarea>
        </p>
        
        <p>
            <input class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" type="submit" value="Envoyer"/>
        </p>
    </form>

<?php
}
else
{
?>
<p>Vous devez être membre pour laisser un commentaire : <a href="inscription">inscrivez vous</a> / <a href="connexion">connectez vous</a>.</p>
<?php
}
?>
</div>

<?php
$content = ob_get_clean();
require __DIR__.'/../../View/public/uniqueArticleView.php';
?>