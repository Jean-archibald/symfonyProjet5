<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$usersManager = new \Model\UsersManagerPDO($dao);
ob_start();

include('Web/inc/allpages/header.php'); 


if(isset($_POST['email']))
{  
    $password = sha1($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $userExist = $usersManager->userExist($email,$password);
    
    if(!empty($password) AND !empty($email))
    {
        if($userExist == 1)
        {
           $userInfos = $usersManager->getUserByEmail($email);
           $_SESSION['id'] = $userInfos['id'];
           $_SESSION['familyName'] = $userInfos['familyName'];
           $_SESSION['firstName'] = $userInfos['firstName'];
           $_SESSION['email'] = $userInfos['email'];
           $_SESSION['password'] = $userInfos['password'];
           $_SESSION['status'] = $userInfos['status'];
           header('Location: blogAccueil');
        }
        else
        {
            $message = '<p id="message" title="noConnect">L\'adresse mail n\'est pas répertorié ou le mot de passe est invalide !<p/>';
        }
    }
}
?>
<meta name="format-detection" content="telephone=no" />
<div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Se connecter à l'espace membre</div>
        <div class="card-body">
          <form method="post">
            <p>
                <?php
                    if (isset($message))
                    {
                        echo $message, '<br />';
                    }
                ?>
            </p>
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="email" name="email" class="form-control" placeholder="Votre email" required="required" autofocus="autofocus">
                <label for="email">Adresse email</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Votre mot de passe" required="required">
                <label for="password">Mot de passe</label>
              </div>
            </div>
          </form>
        </div>
        </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__.'/../../View/public/templatePublicView.php';
?>