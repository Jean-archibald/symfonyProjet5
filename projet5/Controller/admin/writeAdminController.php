<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$newsManager = new \Model\NewsManagerPDO($dao);
ob_start();


$title_data = "";
$textarea_data = "";

if (isset($_POST['title']))
{
    $news = new \Entity\News(
        [
            'title' => $_POST['title'],
            'content' => $_POST['textarea'],
        ]
        );


    if($news->isValid())
    {
        $newsManager->save($news);
        $message = '<p id="message" title="valide">L\'article a bien été ajouté.<p/>';
    }
    else
    {   
        $errors = $news->errors();
    }
}

?>

<!-- Editeur de texte -->
<div class="divEdit">
    <form action="<?=$url?>" method="post">
        <p>
            <?php
                if (isset($message))
                {
                    echo $message, '<br />';
                }

                if (isset($messageUpload))
                {
                    echo $messageUpload, '<br />';
                }
                
            ?>
            
            <p>
                <label for="title" class="writeCss">Titre de l'article :</label>  
                <input type="text" name="title" id="title" value="<?=$title_data?>"  placeholder="Titre de l'article" required="required"/>
            </p>
            
            <br/>
            <?php
            require __DIR__.'/../../tinymce/index.php';
            ?>
            <br/> 
            
            <input class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" type="submit" value="Enregistrer"/>
            
        </p>
    </form>
</div>

<?php 
$content = ob_get_clean();
require __DIR__.'/../../View/admin/templateAdminView.php';
?>
