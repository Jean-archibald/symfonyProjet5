<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$newsManager = new \Model\NewsManagerPDO($dao);
$userManager = new \Model\UserManagerPDO($dao);
$commentManager = new \Model\CommentManagerPDO($dao);
ob_start();
?>