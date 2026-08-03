<?php

require_once "config/config.php";
require_once "config/fonctions.php";

obligerConnexion();

$user = $_SESSION['user'];

// Si un admin atterrit ici par erreur, on le renvoie vers son propre espace
if($user['role'] === 'admin'){
    redirect("admin/index.php");
}

// Petites stats dynamiques du client
$req = $pdo->prepare("SELECT * FROM demandes WHERE utilisateur_id = ? ORDER BY date_demande DESC");
$req->execute([$user['id']]);
$demandes = $req->fetchAll();

$nb_demandes = count($demandes);
$nb_en_attente = count(array_filter($demandes, fn($d) => $d['statut'] === 'En attente'));
$derniere = $demandes[0] ?? null;

include "includes/header.php";
?>

<div class="container py-5">

    <div class="mb-4">
        <h1 class="fw-bold"><?= t('dashboard_bienvenue') ?>, <?= e($user['prenom']) ?> 👋</h1>
        <p class="text-muted"><?= t('dashboard_sous_titre') ?></p>
    </div>

    <div class="row g-3 mb-5">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-number" data-count="<?= (int) $nb_demandes ?>">0</div>
                <div class="stat-label"><?= t('dashboard_stat_demandes') ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-number" data-count="<?= (int) $nb_en_attente ?>">0</div>
                <div class="stat-label"><?= t('dashboard_stat_attente') ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-number">
                    <?php if($derniere): ?>
                        <span class="badge bg-<?= $derniere['statut'] === 'Approuvé' ? 'success' : ($derniere['statut'] === 'Refusé' ? 'danger' : 'warning') ?>">
                            <?php if ($derniere['statut'] === 'Approuvé'): ?>
                                <?= t('admin_statut_approuve') ?>
                            <?php elseif ($derniere['statut'] === 'Refusé'): ?>
                                <?= t('admin_statut_refuse') ?>
                            <?php else: ?>
                                <?= t('admin_statut_attente') ?>
                            <?php endif; ?>
                        </span>
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </div>
                <div class="stat-label"><?= t('dashboard_stat_derniere') ?></div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100 dashboard-card">
                <h4><i class="fas fa-calculator text-primary"></i> <?= t('dashboard_simulation') ?></h4>
                <p><?= t('dashboard_simulation_texte') ?></p>
                <a href="simulateur.php" class="btn btn-smart w-100 mt-auto"><?= t('dashboard_simuler') ?></a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100 dashboard-card">
                <h4><i class="fas fa-hand-holding-dollar text-primary"></i> <?= t('dashboard_demande') ?></h4>
                <p><?= t('dashboard_demande_texte') ?></p>
                <a href="demande.php" class="btn btn-smart w-100 mt-auto"><?= t('dashboard_demande') ?></a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100 dashboard-card">
                <h4><i class="fas fa-clock-rotate-left text-primary"></i> <?= t('dashboard_historique') ?></h4>
                <p><?= t('dashboard_historique_texte') ?></p>
                <a href="historique.php" class="btn btn-smart w-100 mt-auto"><?= t('dashboard_voir_historique') ?></a>
            </div>
        </div>

    </div>

</div>

<?php include "includes/footer.php"; ?>
