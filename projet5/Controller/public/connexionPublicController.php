<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);
ob_start();

if(isset($_POST['email']))
{  
    $password = sha1($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $userExist = $userManager->userExist($email,$password);
    
    if(!empty($password) AND !empty($email))
    {
        if($userExist == 1)
        {
           $userInfos = $userManager->getUserByEmail($email);
           $_SESSION['id'] = $userInfos['id'];
           $_SESSION['familyName'] = $userInfos['familyName'];
           $_SESSION['firstName'] = $userInfos['firstName'];
           $_SESSION['email'] = $userInfos['email'];
           $_SESSION['password'] = $userInfos['password'];
           $_SESSION['status'] = $userInfos['status'];
           header('Location: accueil');
        }
        else
        {
            $message = '<p style="color:black";>L\'adresse mail n\'est pas répertorié ou le mot de passe est invalide !<p/>';
        }
    }
}
?>
<header class="masthead">
    <div class="container">
      <div class="intro-text">
        <div class="intro-lead-in"><meta name="format-detection" content="telephone=no" />
<div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header" style="color:black;">Se connecter à l'espace membre</div>
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
            <input type="submit" value="Se connecter" name="connexion" class="btn btn-primary btn-block"/>
          </form>
        </div>
        </div>

      </div>
    </div>
  </header>


<?php
$content = ob_get_clean();
require __DIR__.'/../../View/public/templatePublicView.php';
?>