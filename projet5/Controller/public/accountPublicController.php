<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);
$newsManager = new \Model\NewsManagerPDO($dao);
$commentManager = new \Model\CommentManagerPDO($dao);

include('Web/inc/allpages/modifyMyAccount.php'); 
$user = $userManager->getUserById($_SESSION['id']);
$userFamilyName = $user['familyName'];
$userFirstName = $user['firstName'];
$userEmail = $user['email'];
$userStatut = $user['status'];
ob_start();

?>
<h2>Informations personnels</h2>
<?php
     if (isset($message))
     {
         echo $message, '<br />';
     }
 ?>
<p>Nom : <?=$userFamilyName?>
<?php 
echo '<form action="',$base.'-',$_SESSION['id'].'" method="post">
<input type="text" name="familyName" placeholder="modifier nom de famille"/>
<input  class="boutonModify" type="submit" value="modifier nom de famille"></form>'
?>
</p>

<p>Prénom : <?=$userFirstName?>
<?php 
echo '<form action="',$base.'-',$_SESSION['id'].'" method="post">
<input type="text" name="firstName" placeholder="modifier prénom"/>
<input  class="boutonModify" type="submit" value="modifier prénom"></form>'
?>
</p>

<p>Email : <?=$userEmail?>
<?php 
echo '<form action="',$base.'-',$_SESSION['id'].'" method="post">
<input type="text" id="email" name="email" placeholder="modifier email" required="required"/>
<input type="email" id="email2" name="email2" placeholder="Confirmer votre email"  required="required"  />
<input  class="boutonModify" type="submit" value="modifier Email"></form>'
?>
</p>

<p>Mot de Passe : *****</p>
<?php 
echo '<form action="',$base.'-',$_SESSION['id'].'" method="post">
<input type="text" id="password" name="password" placeholder="modifier mot de passe" required="required"/>
<input type="text" id="password2" name="password2" placeholder="Confirmer le mot de passe" required="required"/>
<input  class="boutonModify" type="submit" value="modifier mot de passe"></form>'
?>
<br>
<p>Statut : <?=$userStatut?></p>
<?php
$content = ob_get_clean();
require __DIR__.'/../../View/public/uniqueArticleView.php';
?>