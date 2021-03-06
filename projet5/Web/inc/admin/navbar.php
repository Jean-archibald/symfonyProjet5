  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="homeAdmin">Back Office </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="homeAdmin">Home</a>
          </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="accueilAdmin" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-pencil-alt"></i>
            <span>Articles</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="redigerArticle">Rédiger</a>
            <a class="dropdown-item" href="listeArticles-0-0">Liste articles</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-users" aria-hidden="true"></i>
            <span>Abonnés</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="listeCommentaires-0-0">Commentaires</a>
            <a class="dropdown-item" href="listeAbonnes-0-0">Liste abonnés</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-trash" aria-hidden="true"></i>
            <span>Corbeille</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="corbeilleAbonnes-0-0">Abonnés</a>
            <a class="dropdown-item" href="corbeilleArticles-0-0">Articles</a>
            <a class="dropdown-item" href="corbeilleCommentaires-0-0">Commentaires</a>
          </div>
        </li>
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="sessiondestroy">Deconnexion</a>
          </li>
          <?php if (isset($_SESSION['status']))
          { ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="account-<?=$_SESSION['id']?>">Mon Compte</a>
          </li>
          <?php
          }
            ?>
        </ul>
      </div>
    </div>
  </nav>