<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);


if(isset($_SESSION) && isset($_SESSION['email']) && isset($_SESSION['password']))
{
    $userExist = $userManager->userExist($_SESSION['email'],$_SESSION['password']);
    if($userExist == 1)
    {
        $userInfos = $userManager->getUserByEmail($_SESSION['email']);
        if($_SESSION['email'] == $userInfos['email'] && $_SESSION['password'] == $userInfos['password'] && $_SESSION['status'] == $userInfos['status'] && $userInfos['status'] == 'administrateur')
        {
            require __DIR__.'/'.$road .'AdminController.php';
        }
        elseif($_SESSION['email'] == $userInfos['email'] && $_SESSION['password'] == $userInfos['password'] && $userInfos['status'] == 'utilisateur')
            {   
                header("Location:error404");
            }
    }
  
}
else
{
    header("Location:error404");
}
?>