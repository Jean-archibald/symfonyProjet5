<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

ob_start();
$numberTotal = $userManager->count();
$information = '<p class="information">Il y a '.$numberTotal.' abonné(s).</p>';
?>


<!-- systeme pagination top -->
<div>
    <?php
        include('Web/inc/allpages/pagination1.php'); 
    ?>
</div>

<!-- systeme modification of users -->
<?php
    include('Web/inc/admin/modifyUserForm.php'); 
?>

<!-- systeme to show table of users -->
<?php
    include('Web/inc/admin/userList.php'); 
?>

<!-- systeme pagination bottom -->
<?php
    include('Web/inc/allpages/pagination2.php'); 
?>


<?php
$content = ob_get_clean();
require __DIR__.'/../../View/admin/templateAdminView.php';
?>