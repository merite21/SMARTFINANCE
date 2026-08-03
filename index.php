<?php
require_once "config/config.php";
require_once "config/fonctions.php";
require_once "includes/header.php";
?>

<section class="hero">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 text-lg-start text-center">

                <h1 class="mb-3"><?= t('accueil_titre') ?></h1>

                <p class="mb-4">
                    <?= t('accueil_texte') ?>
                </p>

                <?php if(utilisateurConnecte()): ?>
                    <a href="demande.php" class="btn btn-smart btn-lg"><?= t('accueil_bouton') ?></a>
                <?php else: ?>
                    <a href="inscription.php" class="btn btn-smart btn-lg"><?= t('accueil_bouton') ?></a>
                <?php endif; ?>

            </div>

            <div class="col-lg-6 mt-5 mt-lg-0">
                <img src="<?= SITE_URL ?>assets/img/hero-banque.svg"
                     alt="Agence SmartFinance"
                     class="img-fluid hero-illustration">
            </div>

        </div>
    </div>
</section>

<section class="container py-5">
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100">
                <div class="feature-icon"><i class="fas fa-calculator"></i></div>
                <h4><?= t('accueil_feature1_titre') ?></h4>
                <p><?= t('accueil_feature1_texte') ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100">
                <div class="feature-icon"><i class="fas fa-shield-halved"></i></div>
                <h4><?= t('accueil_feature2_titre') ?></h4>
                <p><?= t('accueil_feature2_texte') ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100">
                <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                <h4><?= t('accueil_feature3_titre') ?></h4>
                <p><?= t('accueil_feature3_texte') ?></p>
            </div>
        </div>

    </div>
</section>

<section class="container py-5">

    <div class="text-center mb-5">
        <h2><?= t('temoignages_titre') ?></h2>
        <p class="text-muted"><?= t('temoignages_soustitre') ?></p>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100 testimonial-card">
                <div class="mb-3 text-warning">★★★★★</div>
                <p class="fst-italic">
                    « <?= t('temoignage1_texte') ?> »
                </p>
                <div class="d-flex align-items-center mt-3">
                    <div class="testimonial-avatar">AK</div>
                    <div class="ms-3">
                        <div class="fw-bold">Aïcha K.</div>
                        <div class="text-muted small"><?= t('temoignage1_role') ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100 testimonial-card">
                <div class="mb-3 text-warning">★★★★★</div>
                <p class="fst-italic">
                    « <?= t('temoignage2_texte') ?> »
                </p>
                <div class="d-flex align-items-center mt-3">
                    <div class="testimonial-avatar">MT</div>
                    <div class="ms-3">
                        <div class="fw-bold">Marius T.</div>
                        <div class="text-muted small"><?= t('temoignage2_role') ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100 testimonial-card">
                <div class="mb-3 text-warning">★★★★★</div>
                <p class="fst-italic">
                    « <?= t('temoignage3_texte') ?> »
                </p>
                <div class="d-flex align-items-center mt-3">
                    <div class="testimonial-avatar">SL</div>
                    <div class="ms-3">
                        <div class="fw-bold">Sandrine L.</div>
                        <div class="text-muted small"><?= t('temoignage3_role') ?></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <p class="text-center text-muted small mt-4">
        <?= t('temoignages_note') ?>
    </p>

</section>

<?php require_once "includes/footer.php"; ?>
