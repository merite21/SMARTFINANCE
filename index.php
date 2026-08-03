<?php
require_once "config/config.php";
require_once "config/fonctions.php";
require_once "includes/header.php";
?>

<section class="hero">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 text-lg-start text-center">

                <h1 class="mb-3">Obtenez votre financement simplement</h1>

                <p class="mb-4">
                    SmartFinance vous accompagne dans vos projets
                    avec des solutions de prêt rapides et sécurisées.
                </p>

                <?php if(utilisateurConnecte()): ?>
                    <a href="demande.php" class="btn btn-smart btn-lg">Demander un prêt</a>
                <?php else: ?>
                    <a href="inscription.php" class="btn btn-smart btn-lg">Demander un prêt</a>
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
                <h4>Simulation rapide</h4>
                <p>Calculez votre capacité de remboursement en quelques secondes.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100">
                <div class="feature-icon"><i class="fas fa-shield-halved"></i></div>
                <h4>Sécurité</h4>
                <p>Vos informations sont protégées et traitées en toute confidentialité.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100">
                <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                <h4>Suivi facile</h4>
                <p>Consultez l'état de vos demandes en temps réel, où que vous soyez.</p>
            </div>
        </div>

    </div>
</section>

<?php require_once "includes/footer.php"; ?>
