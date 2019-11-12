<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$newsManager = new \Model\NewsManagerPDO($dao);

ob_start();
$numberTotal = $newsManager->count();
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
    include('Web/inc/admin/modifyNewsForm.php'); 
?>

<!-- systeme to show table of news -->
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