<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$newsManager = new \Model\NewsManagerPDO($dao);


$news = $newsManager->getUnique((int) $id);
$newsTitle = $news->title();
$title = 'Article : ' . $newsTitle;
$descriptionMeta = $newsTitle;

ob_start();
?>
<body>

<div class="article">

<?php
echo    '<p>Article publié le ', $news->dateCreated()->format('d/m/Y'),'</p>', 
        '<h2 class="titleNews">',$news->title(),'</h2>',
        '<p>', nl2br($news->content()), '</p>','</div>', "\n";

?>

</div>

<?php
$content = ob_get_clean();
require __DIR__.'/../../View/public/uniqueArticleView.php';
?>




