<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\NewsManagerPDO($dao);

ob_start();
$newsToModify = "";
$newsToModify =  $manager->getUnique($id);

$title = 'Modification de l\'article : ' . $newsToModify->title() ;

if (isset($_POST['title']))
{   
    $newsToModify->setTitle($_POST['title']);
    $newsToModify->setContent($_POST['textarea']);

    if($newsToModify->isValid())
    {
        $manager->save($newsToModify);
        $message = '<p id="message" title="valide">L\'article a bien été modifié.<p/>';
    }
    else
    {   
        $errors = $newsToModify->errors();
    }
  
}
?>



<div class="divEdit">
    <form action="<?=$url?>" method="post">
        <p>
            <?php
                if (isset($message))
                {
                    echo $message, '<br />';
                } 
            ?>
            
            <p>
                <label for="title">Titre de l'article</label> : 
                <input type="text" name="title" id="title" value="<?php if (isset($newsToModify)) echo $newsToModify->title() ?>" placeholder="Titre de l'article" required="required"/>
            </p>
            <br/>
            <?php
                require __DIR__.'/../../tinymce/indexModifyingNews.php';
            ?>      
            <br/>
            <input class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" type="submit" value="Enregistrer la modification"/>
        </p>
    </form>
<div>

<?php 
$content = ob_get_clean();
require __DIR__.'/../../View/admin/templateAdminView.php';
?>

