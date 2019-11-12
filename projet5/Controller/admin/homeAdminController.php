<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$newsManager = new \Model\NewsManagerPDO($dao);
ob_start();
?>
<div class="homeAdminContainer">
    
    <div class="buttonHomeAdmin">
        <h2 class="h2HomeAdmin">Intéragir avec les articles</h2>
        <a class="buttonModifyHomeAdmin btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Rédiger un article</a>
        <a class="buttonModifyHomeAdmin btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Liste des articles</a>
    </div>
    <div class="buttonHomeAdmin">
        <h2 class="h2HomeAdmin">Intéragir avec les abonnés</h2>
        <a class="buttonModifyHomeAdmin btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Liste des commentaires</a>
        <a class="buttonModifyHomeAdmin btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Liste des abonnés</a>
    </div>
    <div class="buttonHomeAdmin">
        <h2 class="h2HomeAdmin">Intéragir avec les corbeilles</h2>
        <a class="buttonModifyHomeAdmin btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Corbeille Article</a>
        <a class="buttonModifyHomeAdmin btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Corbeille Abonné</a>
        <a class="buttonModifyHomeAdmin btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Corbeille Commentaire</a>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__.'/../../View/admin/templateAdminView.php';
?>