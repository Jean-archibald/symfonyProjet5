<?php
$user = "";

if (isset($_POST['trash']))
{
    preg_match('#listeAbonnes-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $user = $userManager->getUserById($id);
    $userFamilyName = $user->familyName();
    $userFirstName = $user->firstName();
    $user->setTrash(1);
   
    if($user->isValid())
    {
        $userManager->save($user);

        $message = '<p class="information">L\'utilisateur '. $userFamilyName . ' ' . $userFirstName . ' a bien été mis dans la corbeille.</p>';
    }
}

if (isset($_POST['untrash']))
{
    preg_match('#corbeilleAbonnes-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $user = $userManager->getUserById($id);
    $userFamilyName = $user->familyName();
    $userFirstName = $user->firstName();
    $user->setTrash(0);
    
    if($user->isValid())
    {
        $userManager->save($user);

        $message = '<p class="information">L\'utilisateur '. $userFamilyName . ' ' . $userFirstName .' a bien été sorti de la corbeille.</p>';
    }
}

if (isset($_POST['delete']))
{
    preg_match('#corbeilleAbonnes-([0-9]+)-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[2];
    $user = $userManager->getUserById($id);
    $userFamilyName = $user->familyName();
    $userFirstName = $user->firstName();
    $user_id = $user->id();

    $newsExist = $newsManager->newsExist($user_id);
    if($newsExist >= 1)
    {   
        foreach ($newsManager->getListByAutor($user_id) as $news)
            {   
                $news_id = $news->id();
                $commentsExist = $commentManager->commentsExistInNews($news_id);
                if($commentsExist >= 1)
                {   
                    foreach ($commentManager->getListOfCommentByNews($news_id) as $comment)
                        {
                            $comment_id = $comment->id();
                            $commentManager->delete($comment_id);
                        }
                }
                $newsManager->delete($news_id);
            }
    }
    
    $commentsExistOfUser = $commentManager->commentsExistOfUser($user_id);
    if($commentsExistOfUser >= 1)
    {   
        foreach ($commentManager->getListOfCommentByUser($user_id) as $comment)
            {   
                $comment_id = $comment->id();
                $commentManager->delete($comment_id);
            }
    }


    $userManager->delete($user_id);
    $message = '<p class="information">L\'utilisateur '. $userFamilyName . ' ' . $userFirstName .' a bien été supprimé.</p>';

}

?>

