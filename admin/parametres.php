<?php
require_once __DIR__ . '/../config/connexion.php';
require_once __DIR__ . '/../includes/header.php';

if (!is_admin()) {
    redirect('index.php');
}
?>
<div class="card">
    <h1>Paramètres</h1>
    <p>Les options de configuration du back-office seront ajoutées ici.</p>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
