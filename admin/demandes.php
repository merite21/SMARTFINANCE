<?php
require_once __DIR__ . '/../config/connexion.php';
require_once __DIR__ . '/../includes/header.php';

if (!is_admin()) {
    redirect('index.php');
}

$pdo = init_database();
$demandes = $pdo->query('SELECT * FROM demandes ORDER BY id DESC')->fetchAll();
?>
<div class="card">
    <h1>Demandes</h1>
    <ul>
        <?php foreach ($demandes as $demande): ?>
            <li>Demande #<?= $demande['id'] ?> — <?= number_format($demande['montant'], 2, ',', ' ') ?> FCFA sur <?= $demande['duree'] ?> mois</li>
        <?php endforeach; ?>
    </ul>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
