<?php

$comment = "";

if (isset($_POST['publish']))
{
    preg_match('#listeCommentaires-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $comment = $commentManager->getUnique($id);
    $comment->setStatus('publié');
    
    if($comment->isValid())
    {
        $commentManager->save($comment);

        $message = '<p class="information">Le commentaire a bien été publié.</p>';
    }
}

if (isset($_POST['unpublish']))
{
    preg_match('#listeCommentaires-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $comment = $commentManager->getUnique($id);
    $comment->setStatus('brouillon');
    
    if($comment->isValid())
    {
        $commentManager->save($comment);

        $message = '<p class="information">Le commentaire a bien été mis à l\'état de brouillon.</p>';
    }
}


if (isset($_POST['trash']))
{
    preg_match('#listeCommentaires-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $comment = $commentManager->getUnique($id);

    $comment->setStatus('brouillon');
    $comment->setTrash(1);
    
    if($comment->isValid())
    {
        $commentManager->save($comment);

        $message = '<p class="information">Le commentaire a bien été mis dans la corbeille.</p>';
    }
}

if (isset($_POST['untrash']))
{
    preg_match('#corbeilleCommentaires-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $comment = $commentManager->getUnique($id);
    $comment->setTrash(0);
    
    if($comment->isValid())
    {
        $commentManager->save($comment);

        $message = '<p class="information">Le commentaire a bien été sorti de la corbeille.</p>';
    }
}

if (isset($_POST['delete']))
{
    preg_match('#corbeilleCommentaires-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $comment = $commentManager->getUnique($id);
    $comment_id = $comment->id();
    $commentManager->delete($comment_id);
    $message = '<p class="information">Le commentaire a bien été supprimé.</p>';

}

?>

