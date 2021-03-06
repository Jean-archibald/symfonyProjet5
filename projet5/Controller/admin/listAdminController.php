<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);
$newsManager = new \Model\NewsManagerPDO($dao);
$commentManager = new \Model\CommentManagerPDO($dao);

include('Web/inc/admin/modify'.$modifyFormDirection.'Form.php'); 


if ($direction == "newsTrash")
{
    $numberTotal = $newsManager->countTrash();
    $information = '<p class="information">Il y a '.$numberTotal.' article(s) dans la corbeille.</p>';
}
if ($direction == "news")
{
    $numberTotal = $newsManager->count();
    $information = '<p class="information">Il y a '.$numberTotal.' article(s).</p>';
}
elseif($direction == "userTrash")
{
    $numberTotal = $userManager->countTrash();
    $information = '<p class="information">Il y a '.$numberTotal.' abonné(s) dans la corbeille.</p>';
}
elseif($direction == "user")
{
    $numberTotal = $userManager->count();
    $information = '<p class="information">Il y a '.$numberTotal.' abonné(s).</p>';
}
elseif($direction == "commentTrash")
{
    $numberTotal = $commentManager->countTrash();
    $information = '<p class="information">Il y a '.$numberTotal.' commentaire(s) dans la corbeille.</p>';
}
elseif($direction == "comment")
{
    $numberTotal = $commentManager->count();
    $information = '<p class="information">Il y a '.$numberTotal.' commentaire(s).</p>';
}

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
    include('Web/inc/admin/'.$direction.'List.php'); 
}
?>

<!-- systeme pagination bottom -->
<?php
    include('Web/inc/allpages/pagination2.php'); 
?>


<?php
$content = ob_get_clean();
require __DIR__.'/../../View/admin/templateAdminView.php';
?>