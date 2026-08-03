<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/fonctions.php';

obligerAdmin();

$message = '';

// Changer le mot de passe admin
if (isset($_POST['nouveau_mot_de_passe'])) {
    verifier_csrf();
    $nouveau = $_POST['nouveau_mot_de_passe'];

    if (strlen($nouveau) < 6) {
        $message = "Le mot de passe doit contenir au moins 6 caractères.";
    } else {
        $hash = password_hash($nouveau, PASSWORD_DEFAULT);
        $maj = $pdo->prepare('UPDATE utilisateurs SET mot_de_passe = ? WHERE id = ?');
        $maj->execute([$hash, $_SESSION['user']['id']]);
        $message = "Mot de passe mis à jour avec succès.";
    }
}

require_once __DIR__ . '/../includes/header.php';
?>
<div class="container mt-4">
    <div class="card p-4">
        <h1>Paramètres</h1>
        <a href="index.php" class="btn btn-secondary mb-3">Retour au tableau de bord</a>

        <?php if ($message): ?>
            <div class="alert alert-info"><?= e($message) ?></div>
        <?php endif; ?>

        <h2 class="h5 mt-4">Informations du site</h2>
        <p><strong>Nom :</strong> <?= e(SITE_NAME) ?></p>
        <p><strong>URL :</strong> <?= e(SITE_URL) ?></p>

        <h2 class="h5 mt-4">Changer le mot de passe administrateur</h2>
        <form method="post" class="col-md-6">
            <?= csrf_field() ?>
            <input type="password" name="nouveau_mot_de_passe" class="form-control mb-2"
                   placeholder="Nouveau mot de passe" minlength="6" required>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
