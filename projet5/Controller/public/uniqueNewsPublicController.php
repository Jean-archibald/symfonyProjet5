<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$newsManager = new \Model\NewsManagerPDO($dao);
$userManager = new \Model\UserManagerPDO($dao);
$commentManager = new \Model\CommentManagerPDO($dao);

$news = $newsManager->getUnique((int) $id);
$newsTitle = $news->title();
$newsId = $news->id();
$title = 'Article : ' . $newsTitle;
$descriptionMeta = $newsTitle;

$autor_id = $news->user_id();
$autor = $userManager->getUserById($autor_id);
$autorFamilyName = $autor['familyName'];
$autorFirstName = $autor['firstName'];



ob_start();

if (isset($_POST['comment']))
{
    $comment = new \Entity\Comment(
        [
            'content' => htmlspecialchars($_POST['comment'])
        ]
        );


    if($comment->isValid())
    {
        $comment -> setUser_Id($_SESSION['id']);
        $comment -> setNews_Id($newsId);
        $commentManager->save($comment);
        $message = '<p id="message" title="valide">Le commentaire a bien été envoyé.<p/>';
    }
    else
    {   
        $errors = $news->errors();
    }
}

if (isset($_POST['signal']))
{

    preg_match('#lire-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $comment = $commentManager->getUnique($id);
    $comment->setStatus('brouillon');

    if($comment->isValid())
    {
        $commentManager->save($comment);
        $message = '<p class="information">Le commentaire a bien été signalé.</p>';
    }
}

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
<h2 class="h2List">Liste des commentaires</h2>
<?php
    foreach ($commentManager->getListPublish() as $comment)
        {
            $autor_id = $news->user_id();
            $autor = $userManager->getUserById($autor_id);
            $autorFamilyName = $autor['familyName'];
            $autorFirstName = $autor['firstName'];
            echo 
            'Auteur : ',$autorFamilyName,' ',$autorFirstName,'<br>',
            'Date : ',$comment->dateCreated()->format('d/m/Y'),'<br>',
            'Contenu : ', $comment->content(),'<br>',
            '<form action="',$base.'-',$id.'-',$comment->id(),'" method="post">
            <input name="signal" class="boutonSignal" type="submit" value="Signaler ce commentaire"></form><br>'
            ;
        }
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




