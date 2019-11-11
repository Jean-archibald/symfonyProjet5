<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();
$numberTotal = $manager->count();
$information = '<p class="information">Il y a '.$numberTotal.' article(s).</p>';
?>


<!-- systeme pagination top -->
<div>
    <?php
        include('Web/inc/allpages/pagination1.php'); 
    ?>
</div>

<!-- systeme modification de news -->
<?php
    include('Web/inc/admin/modifyForm.php'); 
?>

<!-- systeme affichage de news -->
<?php
    include('Web/inc/admin/newsList.php'); 
?>

<!-- systeme pagination bottom -->
<?php
    include('Web/inc/allpages/pagination2.php'); 
?>


<?php
$content = ob_get_clean();
require __DIR__.'/../../View/admin/templateAdminView.php';
?>