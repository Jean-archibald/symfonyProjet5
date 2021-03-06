<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);
$newsManager = new \Model\NewsManagerPDO($dao);

$numberTotal = $newsManager->countPublish();
$information = '<p class="information">Il y a '.$numberTotal.' article(s) publié(s).</p>';
ob_start();
?>


<!-- systeme pagination top -->
<?php
    include('Web/inc/allpages/pagination1.php'); 
?>

<!-- systeme to show trash list -->
<?php
if($numberTotal >= 1)
{
    include('Web/inc/allpages/newsList.php'); 
}
?>

<!-- systeme pagination bottom -->
<?php
    include('Web/inc/allpages/pagination2.php'); 
?>


<?php
$content = ob_get_clean();
require __DIR__.'/../../View/public/uniqueArticleView.php';
?>