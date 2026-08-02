<?php
require_once __DIR__ . '/../config/connexion.php';
require_once __DIR__ . '/../includes/header.php';

if (!is_admin()) {
    redirect('index.php');
}

$pdo = init_database();
$clients = $pdo->query('SELECT * FROM users WHERE role = "client" ORDER BY id DESC')->fetchAll();
?>
<div class="card">
    <h1>Clients</h1>
    <ul>
        <?php foreach ($clients as $client): ?>
            <li><?= e($client['prenom'] . ' ' . $client['nom']) ?> — <?= e($client['email']) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
