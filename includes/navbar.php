<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="<?= SITE_URL ?>">
            <i class="fas fa-landmark"></i> SMARTFINANCE
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_URL ?>">Accueil</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_URL ?>simulateur.php">
                        Simulateur
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_URL ?>demande.php">
                        Demander un prêt
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_URL ?>contact.php">
                        Contact
                    </a>
                </li>

              <?php if(isset($_SESSION['id'])): ?>

<li class="nav-item">

<a class="btn btn-light ms-3"
href="<?= SITE_URL ?>dashboard.php">

Mon espace

</a>

</li>


<li class="nav-item">

<a class="btn btn-danger ms-2"
href="<?= SITE_URL ?>logout.php">

Déconnexion

</a>

</li>


<?php else: ?>


<li class="nav-item">

<a class="btn btn-light ms-3"
href="<?= SITE_URL ?>connexion.php">

Connexion

</a>

</li>


<?php endif; ?>

            </ul>

        </div>

    </div>
</nav>