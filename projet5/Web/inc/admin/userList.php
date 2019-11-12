<p>
 <?php
     if (isset($message))
     {
         echo $message, '<br />';
     }
 ?>
</p><!-- News list -->
<div class="card mb-3">
    <div class="card-header"><i class="fas fa-table"></i>Liste des abonnés</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Statut</th>
                            <th>Date Ajout</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Statut</th>
                            <th>Date Ajout</th>
                            <th>Action</th>
                            </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($userManager->getList($started, $numberPerPage) as $user)
                        {
                            echo '<tr><td>',
                            $user->familyName(), '</td><td>',
                            $user->firstName(), '</td><td>',
                            $user->email(), '</td><td>',
                            $user->status(), '</td><td>',
                            $user->date_created()->format('d/m/Y'),'</td><td>
                            <div class="divBoutonModify">
                            <a class="boutonModify linkModify" href="modifierUtilisateur-',$user->id(), '">Modifier</a>
                            | <form action="',$base.'-',$pag.'-',$user->id(),'" method="post">
                            <input name="trash" class="boutonModify" type="submit" value="Corbeille"></form>
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