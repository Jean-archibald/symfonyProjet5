<?php
$user = "";

if (isset($_POST['trash']))
{
    preg_match('#listeAbonne-([0-9]+)-([0-9]+)#', $url , $params);
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
    $userManager->delete($user_id);
    $message = '<p class="information">L\'utilisateur '. $userFamilyName . ' ' . $userFirstName .' a bien été supprimé.</p>';

}

?>
