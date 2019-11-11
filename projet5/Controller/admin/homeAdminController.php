<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);
ob_start();
?>


<?php
$content = ob_get_clean();
require __DIR__.'/../../View/admin/templateAdminView.php';
?>