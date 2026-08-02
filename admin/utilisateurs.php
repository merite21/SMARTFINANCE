<?php
require_once __DIR__ . '/../config/connexion.php';
require_once __DIR__ . '/../includes/header.php';

if (!is_admin()) {
    redirect('index.php');
}

$pdo = init_database();
$utilisateurs = $pdo->query('SELECT * FROM users ORDER BY id DESC')->fetchAll();
?>
<div class="card">
    <h1>Utilisateurs</h1>
    <ul>
        <?php foreach ($utilisateurs as $utilisateur): ?>
            <li><?= e($utilisateur['prenom'] . ' ' . $utilisateur['nom']) ?> — <?= e($utilisateur['role']) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
