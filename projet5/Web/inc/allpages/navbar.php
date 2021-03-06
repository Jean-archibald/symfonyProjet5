  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="accueil">Delafontaine Web Agency</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="accueil">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="articles-0">Articles</a>
          </li>
          <?php if (!isset($_SESSION['status']))
          { ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="inscription">S'inscrire</a>
          </li>
          <?php
          }
          ?>
          <?php if (!isset($_SESSION['status']))
          { ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="connexion">Connexion</a>
          </li>
          <?php
          }
          ?>
          <?php if (isset($_SESSION['status']))
          { ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="sessiondestroy">Deconnexion</a>
          </li>
          <?php
          }
            ?>
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