<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);
ob_start();

if (isset($_POST['familyName']))
{
    $user = new \Entity\User(
        [
            'familyName' => htmlspecialchars($_POST['familyName']),
            'firstName' => htmlspecialchars($_POST['firstName']),
            'password' => sha1($_POST['password']),
            'email' => htmlspecialchars($_POST['email'])
        ]
        );


    if (isset($_POST['id']))
    {
        $user->setId($_POST['id']);
    }

    $familyName = htmlspecialchars($_POST['familyName']);
    $firstName = htmlspecialchars($_POST['firstName']);
    $password = sha1($_POST['password']);
    $password2 = sha1($_POST['password2']);
    $email = htmlspecialchars($_POST['email']);
    $email2 = htmlspecialchars($_POST['email2']);

    if (strlen($familyName) <= 255)
    {
        if (strlen($firstName) <= 255)
        {
            if ($password == $password2)
            {
                if ($email == $email2)
                {
                    if(filter_var($email,FILTER_VALIDATE_EMAIL))
                    {
                        if($userManager->mailExist($email) == 0)
                        {
                            if($user->isValid())
                            {
                                $userManager->save($user);
                                $message = '<p class="message" style="color:black"; title="ok">L\'utilisateur a bien été ajouté !<p/>';
                            }
                        }
                        else
                        {
                            $message = '<p class="message" style="color:black"; title="no">L\'adresse mail est déjà utilisé dans un autre compte !<p/>';
                        }
                    }
                    else
                    {
                        $message = '<p class="message" style="color:black"; title="no">L\'adresse mail n\'est pas valide !<p/>';
                    }
                }
                else
                {
                    $message = '<p class="message" style="color:black"; title="no">Les emails ne correspondent pas !<p/>';
                }
            }
            else
            {
                $message = '<p class"message" style="color:black"; title="no">Les mots de passe ne correspondent pas !<p/>';
            }
        }
        else
        {
            $message = '<p class="message" style="color:black"; title="no">Le prénom ne doit pas dépasser 255 caractères !<p/>';
        }
    }
    else
    {
        $message = '<p class="message" style="color:black"; title="no">Le nom de famille ne doit pas dépasser 255 caractères !<p/>';
    }
}
?>
<header class="masthead">
    <div class="container">
      <div class="intro-text">
        <div class="intro-lead-in"><form action="" method="post">
       
       <div class="container">
             <div class="card card-register mx-auto mt-5">
             <div class="card-header" style="color:black;">Formulaire d'inscription</div>
               <div class="card-body">
               <form action="ajouter-abonne" method="post">
                   <p>
                       <?php
                           if (isset($message))
                           {
                               echo $message, '<br />';
                           }
                       ?>
                   </p>
                   <div class="form-group">
                     <div class="form-row">
                       <div class="col-md-6">
                         <div class="form-label-group">
                        <!-- <label for="firstName" class="inscription">Prénom</label> -->
                           <input type="text" name="firstName" id="firstName" placeholder="Votre prénom" class="form-control" autofocus="autofocus" required="required" />
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-label-group">
                        <!--  <label for="familyName" class="inscription">Nom de famille</label> -->
                         <input type="text" name="familyName" id="familyName" placeholder="Votre nom de famille" class="form-control" required="required" />
                         </div>
                       </div>
                     </div>
                   </div>
                   <div class="form-group">
                     <div class="form-label-group">
                    <!--  <label for="email" class="inscription">Adresse email</label> -->
                     <input type="email" id="email" name="email" placeholder="Votre email"  required="required" class="form-control" />               
                     </div>
                   </div>
                   <div class="form-group">
                     <div class="form-label-group">
                    <!--  <label for="email2" class="inscription">Confirmer l'adresse email</label> -->
                     <input type="email" id="email2" name="email2" placeholder="Confirmer votre email"  required="required" class="form-control" />               
                     </div>
                   </div>
                   <div class="form-group">
                     <div class="form-row">
                       <div class="col-md-6">
                         <div class="form-label-group">
                       <!--   <label for="password" class="inscription">Mot de Passe</label> -->
                           <input type="text" id="password" name="password" placeholder="votre mot de passe"  class="form-control" required="required"/>
                         </div>
                       </div>
                       <div class="col-md-6">
                           <div class="form-label-group">
                       <!--     <label for="password2" class="inscription">Confirmer mot de passe</label> -->
                           <input type="text" id="password2" name="password2" placeholder="Confirmation du mot de passe" class="form-control"  required="required"/>
                           </div>
                       </div>
                       </div>
                       </div>
                   <input type="submit" value="Inscription" name="inscription" class="btn btn-primary btn-block"/>
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