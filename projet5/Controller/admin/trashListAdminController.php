<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);
$newsManager = new \Model\NewsManagerPDO($dao);

if ($trashDirection == "news")
{
$numberTotal = $newsManager->countTrash();
$information = '<p class="information">Il y a '.$numberTotal.' article(s) dans la corbeille.</p>';
}
elseif($trashDirection == "user")
{
    $numberTotal = $userManager->countTrash();
    $information = '<p class="information">Il y a '.$numberTotal.' abonné(s) dans la corbeille.</p>';
}
elseif($trashDirection == "comments")
{
    $numberTotal = $commentManager->countTrash();
    $information = '<p class="information">Il y a '.$numberTotal.' commentaire(s) dans la corbeille.</p>';
}

ob_start();
?>


<!-- systeme pagination top -->
<?php
    include('Web/inc/allpages/pagination1.php'); 
?>


<!-- systeme modification  -->
<?php
    include('Web/inc/admin/modify'.$modifyFormDirection.'Form.php'); 
?>

<!-- systeme to show trash list -->
<?php
    include('Web/inc/admin/'.$trashDirection.'TrashList.php'); 
?>

<!-- systeme pagination bottom -->
<?php
    include('Web/inc/allpages/pagination2.php'); 
?>


<?php
$content = ob_get_clean();
require __DIR__.'/../../View/admin/templateAdminView.php';
?>