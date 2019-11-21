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
                            <th>Auteur</th>
                            <th  class="responsiveTable">Date d'ajout</th>
                            <th  class="responsiveTable">Dernière modification</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Titre</th>
                            <th>Auteur</th>                           
                            <th  class="responsiveTable">Date d'ajout</th>
                            <th  class="responsiveTable">Dernière modification</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($newsManager->getList($started, $numberPerPage) as $news)
                        {
                            
                            $autor_id = $news->user_id();
                            $autor = $userManager->getUserById($autor_id);
                            $autorFamilyName = $autor['familyName'];
                            $autorFirstName = $autor['firstName'];
                            echo '<tr><td>',
                            $news->title(), '</td><td>',
                            $autorFamilyName,' ',$autorFirstName,'</td><td  class="responsiveTable">',
                            $news->dateCreated()->format('d/m/Y'),'</td><td  class="responsiveTable">',
                            ($news->dateCreated() == $news->dateModified() ? '-' : $news->dateModified()->format('d/m/Y')),'</td><td>
                            <a class="boutonModify linkModify" target="_blank" href="lire-0-',$news->id(), '-0">Lire</a>
                            </td></tr>', "\n";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
