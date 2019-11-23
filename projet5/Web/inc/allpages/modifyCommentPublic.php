<?php
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
        $message = 'Le commentaire a bien été envoyé.';
    }
    else
    {   
        $errors = $news->errors();
    }
}

if (isset($_POST['signal']) && preg_match('#lire-([0-9]+)-([0-9]+)-([0-9]+)#', $url , $params))
{
    $cutUrl = explode("-", $url);
    $base = $cutUrl[0];
    $pag = $params[1];
    $id = $params[2];
    $comment = $params[3];
    $commentToSignal = $commentManager->getUnique($comment);
    $commentToSignal->setStatus('brouillon');

    if($commentToSignal->isValid())
    {
        $commentManager->save($commentToSignal);
        $message = '<p class="information">Le commentaire a bien été signalé.</p>';
    }
}
?>