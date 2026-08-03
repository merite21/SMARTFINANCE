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
        $message = t('admin_mdp_trop_court');
    } else {
        $hash = password_hash($nouveau, PASSWORD_DEFAULT);
        $maj = $pdo->prepare('UPDATE utilisateurs SET mot_de_passe = ? WHERE id = ?');
        $maj->execute([$hash, $_SESSION['user']['id']]);
        $message = t('admin_mdp_maj_succes');
    }
}

require_once __DIR__ . '/../includes/header.php';
?>
<div class="container mt-4">
    <div class="card p-4">
        <h1><?= t('admin_parametres_titre') ?></h1>
        <a href="index.php" class="btn btn-secondary mb-3"><?= t('admin_retour') ?></a>

        <?php if ($message): ?>
            <div class="alert alert-info"><?= e($message) ?></div>
        <?php endif; ?>

        <h2 class="h5 mt-4"><?= t('admin_infos_site') ?></h2>
        <p><strong><?= t('admin_nom_site') ?> :</strong> <?= e(SITE_NAME) ?></p>
        <p><strong><?= t('admin_url_site') ?> :</strong> <?= e(SITE_URL) ?></p>

        <h2 class="h5 mt-4"><?= t('admin_changer_mdp') ?></h2>
        <form method="post" class="col-md-6">
            <?= csrf_field() ?>
            <input type="password" name="nouveau_mot_de_passe" class="form-control mb-2"
                   placeholder="<?= e(t('admin_nouveau_mdp')) ?>" minlength="6" required>
            <button type="submit" class="btn btn-primary"><?= t('admin_mettre_a_jour') ?></button>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
