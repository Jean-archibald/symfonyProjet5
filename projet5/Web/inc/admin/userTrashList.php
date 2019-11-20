<p>
 <?php
     if (isset($message))
     {
         echo $message, '<br />';
     }
 ?>
</p><!-- News list -->
<div class="card mb-3">
    <div class="card-header"><i class="fas fa-table"></i>Liste des abonnés dans la corbeille</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                        <tr>
                            <th>Nom</th>
                            <th class="responsiveTable">Prénom</th>
                            <th>Email</th>
                            <th class="responsiveTable">Statut</th>
                            <th class="responsiveTable">Date Ajout</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th class="responsiveTable">Prénom</th>
                            <th>Email</th>
                            <th class="responsiveTable">Statut</th>
                            <th class="responsiveTable">Date Ajout</th>
                            <th>Action</th>
                            </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        foreach ($userManager->getListTrash($started, $numberPerPage) as $user)
                        {
                            echo '<tr><td>',
                            $user->familyName(),'<p class="responsiveStatus"><br/>',$user->status(),'</p>', '</td><td class="responsiveTable">',
                            $user->firstName(), '</td><td>',
                            $user->email(), '</td><td class="responsiveTable">',
                            $user->status(), '</td><td class="responsiveTable">',
                            $user->date_created()->format('d/m/Y'),'</td><td>
                            <div class="divBoutonModify">
                            <form action="',$base.'-',$pag.'-',$user->id(),'" method="post">
                            <input name="delete" class="boutonModify" type="submit" value="Supprimer"></form>
                            | <form action="',$base.'-',$pag.'-',$user->id(),'" method="post">
                            <input name="untrash" class="boutonModify" type="submit" value="Sortir"></form>
                            </div>
                            </td></tr>', "\n";
                           ;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>