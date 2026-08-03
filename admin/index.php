<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/fonctions.php';

obligerAdmin();

$nb_users = (int) $pdo->query('SELECT COUNT(*) FROM utilisateurs')->fetchColumn();
$nb_demandes = (int) $pdo->query('SELECT COUNT(*) FROM demandes')->fetchColumn();
$nb_demandes_attente = (int) $pdo->query("SELECT COUNT(*) FROM demandes WHERE statut = 'En attente'")->fetchColumn();
$nb_messages = (int) $pdo->query('SELECT COUNT(*) FROM messages')->fetchColumn();

require_once __DIR__ . '/../includes/header.php';
?>
<div class="container mt-4">
    <div class="card p-4 mb-4">
        <h1><?= t('admin_titre') ?></h1>
        <div class="row text-center mt-3">
            <div class="col-md-3">
                <div class="card p-3">
                    <h3 class="stat-number" data-count="<?= $nb_users ?>">0</h3>
                    <p class="mb-0"><?= t('admin_utilisateurs') ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h3 class="stat-number" data-count="<?= $nb_demandes ?>">0</h3>
                    <p class="mb-0"><?= t('admin_demandes') ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h3 class="stat-number" data-count="<?= $nb_demandes_attente ?>">0</h3>
                    <p class="mb-0"><?= t('admin_en_attente') ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h3 class="stat-number" data-count="<?= $nb_messages ?>">0</h3>
                    <p class="mb-0"><?= t('admin_messages') ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-4">
        <h2 class="h5 mb-3"><?= t('admin_gestion') ?></h2>
        <div class="row g-3">
            <div class="col-md-4">
                <a href="demandes.php" class="btn btn-primary w-100 py-3">
                    <?= t('admin_gerer_demandes') ?>
                </a>
            </div>
            <div class="col-md-4">
                <a href="utilisateurs.php" class="btn btn-primary w-100 py-3">
                    <?= t('admin_gerer_utilisateurs') ?>
                </a>
            </div>
            <div class="col-md-4">
                <a href="clients.php" class="btn btn-primary w-100 py-3">
                    <?= t('admin_voir_clients') ?>
                </a>
            </div>
            <div class="col-md-4">
                <a href="remboursements.php" class="btn btn-primary w-100 py-3">
                    <?= t('admin_gerer_remboursements') ?>
                </a>
            </div>
            <div class="col-md-4">
                <a href="parametres.php" class="btn btn-secondary w-100 py-3">
                    <?= t('admin_parametres') ?>
                </a>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
