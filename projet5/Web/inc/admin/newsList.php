<p>
 <?php
     if (isset($message))
     {
         echo $message, '<br />';
     }
 ?>
</p><!-- News list -->
<div class="card mb-3">
    <div class="card-header"><i class="fas fa-table"></i>Liste des articles</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Statut</th>
                            <th>Date d'ajout</th>
                            <th>Dernière modification</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Titre</th>
                            <th>Statut</th>
                            <th>Date d'ajout</th>
                            <th>Dernière modification</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($newsManager->getList($started, $numberPerPage) as $news)
                        {
                            echo '<tr><td>',
                            $news->title(), '</td><td>',
                            $news->status(), '</td><td>',
                            $news->dateCreated()->format('d/m/Y'),'</td><td>',
                            ($news->dateCreated() == $news->dateModified() ? '-' : $news->dateModified()->format('d/m/Y')),'</td><td>
                            <div class="divBoutonModify">
                            <form action="',$base.'-',$pag.'-',$news->id(),'" method="post">
                            <input name="publish" class="boutonModify" type="submit" value="Publier"></form>
                            | <a class="boutonModify linkModify" target="_blank" href="lire-',$news->id(), '">Aperçu</a>
                            | <form action="',$base.'-',$pag.'-',$news->id(),'" method="post">
                            <input name="unpublish" class="boutonModify" type="submit" value="Brouillon"></form>
                            | <a class="boutonModify linkModify" href="modifierArticle-',$news->id(), '"> Modifier</a>
                            | <form action="',$base.'-',$pag.'-',$news->id(),'" method="post">
                            <input name="trash" class="boutonModify" type="submit" value="Corbeille"></form>
                            </div>
                            </td></tr>', "\n";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>