<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$newsManager = new \Model\NewsManagerPDO($dao);
$userManager = new \Model\UserManagerPDO($dao);
$numberPerPage = 3;
$started = (int)"";
$numberTotal = (int)$newsManager->countPublish();
ob_start();




?>
<!-- Header -->
<?php
include('Web/inc/allpages/header.php'); 
?>

<!-- Articles -->
<?php
include('Web/inc/allpages/articles.php'); 
?>

<!-- Services -->
<?php
include('Web/inc/allpages/services.php'); 
?>

<!-- About -->
<?php
include('Web/inc/allpages/about.php'); 
?>

<!-- Team -->
<?php
include('Web/inc/allpages/team.php'); 
?>

<!-- Contact -->
<?php
include('Web/inc/allpages/contact.php'); 
?>

<?php
$content = ob_get_clean();
require __DIR__.'/../../View/public/templatePublicView.php';
?>