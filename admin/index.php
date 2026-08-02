<?php
require_once __DIR__ . '/../config/connexion.php';
require_once __DIR__ . '/../includes/header.php';

if (!is_admin()) {
    redirect('index.php');
}

$pdo = init_database();
$stmt = $pdo->query('SELECT COUNT(*) FROM users');
$nb_users = (int) $stmt->fetchColumn();
$stmt = $pdo->query('SELECT COUNT(*) FROM demandes');
$nb_demandes = (int) $stmt->fetchColumn();
$stmt = $pdo->query('SELECT COUNT(*) FROM messages');
$nb_messages = (int) $stmt->fetchColumn();
?>
<div class="card">
    <h1>Administration</h1>
    <p>Utilisateurs : <?= $nb_users ?></p>
    <p>Demandes : <?= $nb_demandes ?></p>
    <p>Messages : <?= $nb_messages ?></p>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
