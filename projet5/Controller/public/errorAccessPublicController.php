<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);
ob_start();
?>
<header class="masthead">
    <div class="container">
      <div class="intro-text">
        <div class="intro-lead-in">Accès interdit à la partie administrative</div>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="accueil">Revenir à l'accueil</a>
      </div>
    </div>
</header>
<?php
$content = ob_get_clean();
require __DIR__.'/../../View/public/templatePublicView.php';
?>