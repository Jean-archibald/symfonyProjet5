<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$newsManager = new \Model\NewsManagerPDO($dao);
ob_start();
?>
<div class="homeAdminContainer">
    
    <div class="buttonHomeAdmin divColor">
        <h2 class="h2HomeAdmin">Articles</h2>
        <a class="buttonModifyHomeAdmin btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="redigerArticle">Rédiger un article</a>
        <a class="buttonModifyHomeAdmin btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="listeArticles-0-0">Liste des articles</a>
    </div>
    <div class="buttonHomeAdmin divColor">
        <h2 class="h2HomeAdmin">Abonnés</h2>
        <a class="buttonModifyHomeAdmin btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="listeCommentaires-0-0">Liste des commentaires</a>
        <a class="buttonModifyHomeAdmin btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="listeAbonnes-0-0">Liste des abonnés</a>
    </div>
    <div class="buttonHomeAdmin divColor">
        <h2 class="h2HomeAdmin">Corbeilles</h2>
        <a class="buttonModifyHomeAdmin btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="corbeilleArticles-0-0">Corbeille Article</a>
        <a class="buttonModifyHomeAdmin btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="corbeilleAbonnes-0-0">Corbeille Abonné</a>
        <a class="buttonModifyHomeAdmin btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="corbeilleCommentaires-0-0">Corbeille Commentaire</a>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__.'/../../View/admin/templateAdminView.php';
?>