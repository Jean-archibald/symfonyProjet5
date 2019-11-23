<!-- Articles -->
<?php
if($numberTotal >= 3)
{
    $started = $numberTotal - 3;
}
elseif($numberTotal == 2)
{
    $started = $numberTotal - 2;
}
elseif($numberTotal == 1)
{
    $started = $numberTotal - 1;
}

if($started >= 0 && $numberTotal != 0)
{
?>
<section class="page-section" id="articles">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Les derniers articles</h2>
        </div>
      </div>
      <div class="row text-center">
        <?php
        foreach ($newsManager->getListPublish($started, $numberPerPage) as $news)
        {
            $autor_id = $news->user_id();
            $autor = $userManager->getUserById($autor_id);
            $autorFamilyName = $autor['familyName'];
            $autorFirstName = $autor['firstName'];
            echo '<div class="col-md-4"><h4 class="service-heading">',
            $news->title(), '</h4>
            <p class="text-muted">Auteur : ',
            $autorFamilyName,' ',$autorFirstName,'</p><p>Publié le ',
            $news->dateCreated()->format('d/m/Y'),'</p><p>',
            ($news->dateCreated() == $news->dateModified() ? '' : $news->dateModified()->format('d/m/Y')),'</p><p>
            <a class="boutonModify linkModify" target="_blank" href="lire-0-',$news->id(), '-0">Lire</a>
            </p></div>', "\n";
        }
        ?>
      </div>
    </div>
</section>
<?php
}
?>