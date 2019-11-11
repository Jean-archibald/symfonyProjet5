<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);
ob_start();
?>
<!-- Header -->
<?php
include('Web/inc/allpages/header.php'); 
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

<?php
$content = ob_get_clean();
require __DIR__.'/../../View/public/templatePublicView.php';
?>