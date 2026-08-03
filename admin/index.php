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
        <h1>Administration</h1>
        <div class="row text-center mt-3">
            <div class="col-md-3">
                <div class="card p-3">
                    <h3 class="stat-number" data-count="<?= $nb_users ?>">0</h3>
                    <p class="mb-0">Utilisateurs</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h3 class="stat-number" data-count="<?= $nb_demandes ?>">0</h3>
                    <p class="mb-0">Demandes</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h3 class="stat-number" data-count="<?= $nb_demandes_attente ?>">0</h3>
                    <p class="mb-0">En attente</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h3 class="stat-number" data-count="<?= $nb_messages ?>">0</h3>
                    <p class="mb-0">Messages</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-4">
        <h2 class="h5 mb-3">Gestion</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <a href="demandes.php" class="btn btn-primary w-100 py-3">
                    Gérer les demandes
                </a>
            </div>
            <div class="col-md-4">
                <a href="utilisateurs.php" class="btn btn-primary w-100 py-3">
                    Gérer les utilisateurs
                </a>
            </div>
            <div class="col-md-4">
                <a href="clients.php" class="btn btn-primary w-100 py-3">
                    Voir les clients
                </a>
            </div>
            <div class="col-md-4">
                <a href="remboursements.php" class="btn btn-primary w-100 py-3">
                    Gérer les remboursements
                </a>
            </div>
            <div class="col-md-4">
                <a href="parametres.php" class="btn btn-secondary w-100 py-3">
                    Paramètres
                </a>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
