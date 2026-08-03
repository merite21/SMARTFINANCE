<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/fonctions.php';

obligerConnexion();

$stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE id = ?');
$stmt->execute([$_SESSION['user']['id']]);
$user = $stmt->fetch();

require_once __DIR__ . '/includes/header.php';
?>
<div class="container mt-4">
    <div class="card p-4">
        <h1>Profil</h1>
        <p><strong>Prénom :</strong> <?= e($user['prenom'] ?? '') ?></p>
        <p><strong>Nom :</strong> <?= e($user['nom'] ?? '') ?></p>
        <p><strong>Email :</strong> <?= e($user['email'] ?? '') ?></p>
        <p><strong>Téléphone :</strong> <?= e($user['telephone'] ?? '') ?></p>
        <p><strong>Rôle :</strong> <?= e($user['role'] ?? 'client') ?></p>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
