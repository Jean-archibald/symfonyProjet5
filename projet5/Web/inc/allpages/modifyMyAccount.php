<?php
if (isset($_POST['familyName']))
{
    preg_match('#account-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[1];
    $user = $userManager->getUserById($id);
    $user->setFamilyName(htmlspecialchars($_POST['familyName']));
    if($user->isValid())
    {
        $userManager->save($user);
        $message = '<p class="information">Votre nom de famille a été modifié.</p>';
    }
}

if (isset($_POST['firstName']))
{
    preg_match('#account-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[1];
    $user = $userManager->getUserById($id);
    $user->setFirstName(htmlspecialchars($_POST['firstName']));
    if($user->isValid())
    {
        $userManager->save($user);
        $message = '<p class="information">Votre prénom a été modifié.</p>';
    }
}


if (isset($_POST['email']))
{
    preg_match('#account-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[1];
    $email = $_POST['email'];
    $email2 = $_POST['email2'];
    $user = $userManager->getUserById($id);
    if ($email == $email2)
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            if($userManager->mailExist($email) == 0)
            {
                if($user->isValid())
                {
                    $user->setEmail($_POST['email']);
                    $_SESSION['email'] = $_POST['email'];
                    $userManager->save($user);
                    $message = '<p class="information">Votre email a été modifié.</p>';
                }
            }
            else
            {
                $message = '<p class="information">L\'adresse mail est déjà utilisé dans un autre compte !<p/>';
            }
        }
        else
        {
            $message = '<p class="information">L\'adresse mail n\'est pas valide !<p/>';
        }
    }
    else
    {
        $message = '<p class="information">Les emails ne correspondent pas !<p/>';
    }     
}

if (isset($_POST['password']))
{
    preg_match('#account-([0-9]+)#', $url , $params);
    $cutUrl = explode("-", $url);
    $id = $params[1];
    $password = sha1($_POST['password']);
    $password2 = sha1($_POST['password2']);
    $user = $userManager->getUserById($id);
    if ($password == $password2)
    {
        if($user->isValid())
        {
            $user->setPassword($password);
            $_SESSION['password'] = $password;
            $userManager->save($user);
            $message = '<p class="information">Votre mot de passe a été modifié.</p>';
        }
    }
    else
    {
        $message = '<p class="information">Les mots de passe ne correspondent pas !<p/>';
    }
    
}