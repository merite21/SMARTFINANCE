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

    <!-- Témoignage 1 -->
    <div class="col-md-4">
        <div class="card shadow-sm p-4 h-100 testimonial-card">
            <div class="mb-3 text-warning">★★★★★</div>
            <p class="fst-italic">
                « <?= t('temoignage1_texte') ?> »
            </p>
            <div class="d-flex align-items-center mt-3">
                <div class="testimonial-avatar">LS</div>
                <div class="ms-3">
                    <div class="fw-bold">Lukas Schneider</div>
                    <div class="text-muted small"><?= t('temoignage1_role') ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Témoignage 2 -->
    <div class="col-md-4">
        <div class="card shadow-sm p-4 h-100 testimonial-card">
            <div class="mb-3 text-warning">★★★★★</div>
            <p class="fst-italic">
                « <?= t('temoignage2_texte') ?> »
            </p>
            <div class="d-flex align-items-center mt-3">
                <div class="testimonial-avatar">AM</div>
                <div class="ms-3">
                    <div class="fw-bold">Anna Müller</div>
                    <div class="text-muted small"><?= t('temoignage2_role') ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Témoignage 3 -->
    <div class="col-md-4">
        <div class="card shadow-sm p-4 h-100 testimonial-card">
            <div class="mb-3 text-warning">★★★★★</div>
            <p class="fst-italic">
                « <?= t('temoignage3_texte') ?> »
            </p>
            <div class="d-flex align-items-center mt-3">
                <div class="testimonial-avatar">MW</div>
                <div class="ms-3">
                    <div class="fw-bold">Michael Weber</div>
                    <div class="text-muted small"><?= t('temoignage3_role') ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Témoignage 4 -->
    <div class="col-md-4">
        <div class="card shadow-sm p-4 h-100 testimonial-card">
            <div class="mb-3 text-warning">★★★★★</div>
            <p class="fst-italic">
                « <?= t('temoignage4_texte') ?> »
            </p>
            <div class="d-flex align-items-center mt-3">
                <div class="testimonial-avatar">SF</div>
                <div class="ms-3">
                    <div class="fw-bold">Sophie Fischer</div>
                    <div class="text-muted small"><?= t('temoignage4_role') ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Témoignage 5 -->
    <div class="col-md-4">
        <div class="card shadow-sm p-4 h-100 testimonial-card">
            <div class="mb-3 text-warning">★★★★★</div>
            <p class="fst-italic">
                « <?= t('temoignage5_texte') ?> »
            </p>
            <div class="d-flex align-items-center mt-3">
                <div class="testimonial-avatar">TB</div>
                <div class="ms-3">
                    <div class="fw-bold">Thomas Becker</div>
                    <div class="text-muted small"><?= t('temoignage5_role') ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Témoignage 6 -->
    <div class="col-md-4">
        <div class="card shadow-sm p-4 h-100 testimonial-card">
            <div class="mb-3 text-warning">★★★★★</div>
            <p class="fst-italic">
                « <?= t('temoignage6_texte') ?> »
            </p>
            <div class="d-flex align-items-center mt-3">
                <div class="testimonial-avatar">JH</div>
                <div class="ms-3">
                    <div class="fw-bold">Julia Hoffmann</div>
                    <div class="text-muted small"><?= t('temoignage6_role') ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Témoignage 7 -->
    <div class="col-md-4">
        <div class="card shadow-sm p-4 h-100 testimonial-card">
            <div class="mb-3 text-warning">★★★★☆</div>
            <p class="fst-italic">
                « <?= t('temoignage7_texte') ?> »
            </p>
            <div class="d-flex align-items-center mt-3">
                <div class="testimonial-avatar">DW</div>
                <div class="ms-3">
                    <div class="fw-bold">Daniel Wagner</div>
                    <div class="text-muted small"><?= t('temoignage7_role') ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Témoignage 8 -->
    <div class="col-md-4">
        <div class="card shadow-sm p-4 h-100 testimonial-card">
            <div class="mb-3 text-warning">★★★★☆</div>
            <p class="fst-italic">
                « <?= t('temoignage8_texte') ?> »
            </p>
            <div class="d-flex align-items-center mt-3">
                <div class="testimonial-avatar">LK</div>
                <div class="ms-3">
                    <div class="fw-bold">Laura König</div>
                    <div class="text-muted small"><?= t('temoignage8_role') ?></div>
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
