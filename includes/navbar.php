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

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_URL ?>"><?= t('nav_accueil') ?></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_URL ?>simulateur.php">
                        <?= t('nav_simulateur') ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_URL ?>demande.php">
                        <?= t('nav_demande') ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_URL ?>contact.php">
                        <?= t('nav_contact') ?>
                    </a>
                </li>

              <?php if(isset($_SESSION['user'])): ?>

<?php if($_SESSION['user']['role'] === 'admin'): ?>

<li class="nav-item">
<a class="btn btn-light ms-lg-3" href="<?= SITE_URL ?>admin/index.php">
<?= t('nav_administration') ?>
</a>
</li>

<?php else: ?>

<li class="nav-item">
<a class="btn btn-light ms-lg-3" href="<?= SITE_URL ?>dashboard.php">
<?= t('nav_mon_espace') ?>
</a>
</li>

<?php endif; ?>


<li class="nav-item">

<a class="btn btn-danger ms-lg-2"
href="<?= SITE_URL ?>logout.php">

<?= t('nav_deconnexion') ?>

</a>

</li>


<?php else: ?>


<li class="nav-item">

<a class="btn btn-light ms-lg-3"
href="<?= SITE_URL ?>connexion.php">

<?= t('nav_connexion') ?>

</a>

</li>


<?php endif; ?>

                <li class="nav-item dropdown ms-lg-3 mt-2 mt-lg-0">
                    <a class="nav-link dropdown-toggle text-white lang-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-globe"></i> <?= strtoupper($_SESSION['lang']) ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php foreach(LANGUES_DISPONIBLES as $code => $nom): ?>
                            <li>
                                <a class="dropdown-item <?= $_SESSION['lang'] === $code ? 'active' : '' ?>"
                                   href="<?= SITE_URL ?>langue.php?lang=<?= $code ?>">
                                   <?= e($nom) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

            </ul>

        </div>

    </div>
</nav>
