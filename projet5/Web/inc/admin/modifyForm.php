<?php
$news = "";

if (isset($_POST['publish']))
{
    preg_match('#listeArticles-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $news = $manager->getUnique($id);
    $newsTitle = $news->title();
    $news->setStatus('publié');
    
    if($news->isValid())
    {
        $manager->save($news);

        $message = '<p class="information">L\'article '. $newsTitle .' a bien été publié.</p>';
    }
}

if (isset($_POST['unpublish']))
{
    preg_match('#listeArticles-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $news = $manager->getUnique($id);
    $newsTitle = $news->title();
    $news->setStatus('brouillon');
    
    if($news->isValid())
    {
        $manager->save($news);

        $message = '<p class="information">L\'article '. $newsTitle .' a bien été mis à l\'état de brouillon.</p>';
    }
}


if (isset($_POST['trash']))
{
    preg_match('#listeArticles-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $news = $manager->getUnique($id);
    $newsTitle = $news->title();
    $news->setTrash(1);
    
    if($news->isValid())
    {
        $manager->save($news);

        $message = '<p class="information">L\'article '. $newsTitle .' a bien été mis dans la corbeille.</p>';
    }
}

?>

