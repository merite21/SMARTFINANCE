<?php
require_once __DIR__ . '/config/connexion.php';
require_once __DIR__ . '/includes/header.php';

if (!is_logged_in()) {
    redirect('connexion.php');
}

$pdo = init_database();
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<div class="card">
    <h1>Profil</h1>
    <p><strong>Prénom :</strong> <?= e($user['prenom'] ?? '') ?></p>
    <p><strong>Nom :</strong> <?= e($user['nom'] ?? '') ?></p>
    <p><strong>Email :</strong> <?= e($user['email'] ?? '') ?></p>
    <p><strong>Rôle :</strong> <?= e($user['role'] ?? 'client') ?></p>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>