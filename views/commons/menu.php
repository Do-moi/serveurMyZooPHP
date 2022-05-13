<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MyZoo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <?php if(!Securite::verifAccessSession()) :?>
        <li class="nav-item">
          <a class="nav-link active" href="<?= URL?>back/login ">Login</a>
        </li>
        <?php else : ?>
        <li class="nav-item">
          <a class="nav-link " href="<?= URL?>back/admin ">Accueil</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">familles</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?= URL ?>back/familles/visualisation">Visualisation</a>
            <a class="dropdown-item" href="<?= URL ?>back/familles/creation">Création</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Animaux</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?= URL ?>back/animaux/visualisation">Visualisation</a>
            <a class="dropdown-item" href="<?= URL ?>back/animaux/creation">Création</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?= URL?>back/deconnexion ">Déconnexion
           
          </a>
        </li>
        <?php endif ;?>
      </ul>
      <form class="d-flex">
        <input class="form-control me-sm-2" type="text" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>