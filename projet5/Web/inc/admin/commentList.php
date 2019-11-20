<p>
 <?php
     if (isset($message))
     {
         echo $message, '<br />';
     }
 ?>
</p><!-- News list -->
<div class="card mb-3">
    <div class="card-header"><i class="fas fa-table"></i>Liste des commentaires</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Article</th>
                            <th>Contenu</th>
                            <th>Date d'ajout</th>
                            <th>Date de modification</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Article</th>
                            <th>Contenu</th>
                            <th>Date d'ajout</th>
                            <th>Date de modification</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($commentManager->getList($started, $numberPerPage) as $comment)
                        {
                            $news_id = $comment->news_id();
                            $news = $newsManager->getUnique($news_id);
                            $newsTitle = $news['title'];
                            
                            echo '<tr><td>',
                            $newsTitle,'</td><td>',
                            $comment->content(), '</td><td>',
                            $comment->dateCreated()->format('d/m/Y'),'</td><td class="responsiveTable">',
                            ($comment->dateCreated() == $comment->dateModified() ? '-' : $comment->dateModified()->format('d/m/Y')),'</td><td>',
                            $comment->status(),'</td><td>
                            <div class="divBoutonModify">
                            <form action="',$base.'-',$pag.'-',$comment->id(),'" method="post">
                            <input name="publish" class="boutonModify" type="submit" value="Publier"></form>
                            | <form action="',$base.'-',$pag.'-',$comment->id(),'" method="post">
                            <input name="unpublish" class="boutonModify" type="submit" value="Brouillon"></form>
                            | <form action="',$base.'-',$pag.'-',$comment->id(),'" method="post">
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