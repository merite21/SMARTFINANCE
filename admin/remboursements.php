<?php
require_once __DIR__ . '/../config/connexion.php';
require_once __DIR__ . '/../includes/header.php';

if (!is_admin()) {
    redirect('index.php');
}
?>
<div class="card">
    <h1>Remboursements</h1>
    <p>Cette section pourra accueillir la gestion des remboursements à venir.</p>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
