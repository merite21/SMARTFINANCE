<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/fonctions.php';

obligerAdmin();

$clients = $pdo->query("SELECT * FROM utilisateurs WHERE role = 'client' ORDER BY id DESC")->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>
<div class="container mt-4">
    <div class="card p-4">
        <h1><?= t('admin_clients_titre') ?></h1>
        <a href="index.php" class="btn btn-secondary mb-3"><?= t('admin_retour') ?></a>
        <ul class="list-group">
            <?php foreach ($clients as $client): ?>
                <li class="list-group-item">
                    <?= e($client['prenom'] . ' ' . $client['nom']) ?> — <?= e($client['email']) ?>
                    — <?= e($client['telephone'] ?? '') ?>
                    — <span class="badge bg-<?= $client['statut'] === 'actif' ? 'success' : 'secondary' ?>">
                        <?= e($client['statut']) ?>
                    </span>
                </li>
            <?php endforeach; ?>
            <?php if (empty($clients)): ?>
                <li class="list-group-item"><?= t('admin_aucun_client') ?></li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
