<?php

$news = "";

if (isset($_POST['publish']))
{
    preg_match('#listeArticles-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $news = $newsManager->getUnique($id);
    $newsTitle = $news->title();
    $news->setStatus('publié');
    
    if($news->isValid())
    {
        $newsManager->save($news);

        $message = '<p class="information">L\'article '. $newsTitle .' a bien été publié.</p>';
    }
}

if (isset($_POST['unpublish']))
{
    preg_match('#listeArticles-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $news = $newsManager->getUnique($id);
    $newsTitle = $news->title();
    $news->setStatus('brouillon');
    
    if($news->isValid())
    {
        $newsManager->save($news);

        $message = '<p class="information">L\'article '. $newsTitle .' a bien été mis à l\'état de brouillon.</p>';
    }
}


if (isset($_POST['trash']))
{
    preg_match('#listeArticles-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $news = $newsManager->getUnique($id);
    $newsTitle = $news->title();
    $news->setStatus('brouillon');
    $news->setTrash(1);
    
    if($news->isValid())
    {
        $newsManager->save($news);

        $message = '<p class="information">L\'article '. $newsTitle .' a bien été mis dans la corbeille.</p>';
    }
}

if (isset($_POST['untrash']))
{
    preg_match('#corbeilleArticles-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $news = $newsManager->getUnique($id);
    $newsTitle = $news->title();
    $news->setTrash(0);
    
    if($news->isValid())
    {
        $newsManager->save($news);

        $message = '<p class="information">L\'article '. $newsTitle .' a bien été sorti de la corbeille.</p>';
    }
}

if (isset($_POST['delete']))
{
    preg_match('#corbeilleArticles-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $news = $newsManager->getUnique($id);
    $news_id = $news->id();
    $newsTitle = $news->title();

    $commentsExist = $commentManager->commentsExist($news_id);
    if($commentsExist >= 1)
    {   
        foreach ($commentManager->getListByComment($news_id) as $comment)
            {
                $comment_id = $comment->id();
                $commentManager->delete($comment_id);
            }
    }

    $newsManager->delete($news_id);
    $message = '<p class="information">L\'article '. $newsTitle .' a bien été supprimé.</p>';

}

?>

