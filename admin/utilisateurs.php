<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/fonctions.php';

obligerAdmin();

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifier_csrf();
}

// Activer / désactiver un utilisateur
if (isset($_POST['action']) && $_POST['action'] === 'statut' && isset($_POST['utilisateur_id'], $_POST['statut'])) {
    $statuts_valides = ['actif', 'inactif'];
    if (in_array($_POST['statut'], $statuts_valides, true)) {
        $maj = $pdo->prepare('UPDATE utilisateurs SET statut = ? WHERE id = ?');
        $maj->execute([$_POST['statut'], (int) $_POST['utilisateur_id']]);
    }
}

// Supprimer un utilisateur
if (isset($_POST['action']) && $_POST['action'] === 'supprimer' && isset($_POST['utilisateur_id'])) {
    try {
        $suppr = $pdo->prepare('DELETE FROM utilisateurs WHERE id = ? AND role != "admin"');
        $suppr->execute([(int) $_POST['utilisateur_id']]);
    } catch (PDOException $e) {
        $erreur = t('admin_erreur_suppression');
    }
}

$utilisateurs = $pdo->query('SELECT * FROM utilisateurs ORDER BY id DESC')->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>
<div class="container mt-4">
    <div class="card p-4">
        <h1><?= t('admin_utilisateurs_titre') ?></h1>
        <a href="index.php" class="btn btn-secondary mb-3"><?= t('admin_retour') ?></a>

        <?php if ($erreur): ?>
            <div class="alert alert-danger"><?= e($erreur) ?></div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= t('admin_nom') ?></th>
                    <th><?= t('admin_email') ?></th>
                    <th><?= t('admin_role') ?></th>
                    <th><?= t('admin_statut') ?></th>
                    <th><?= t('admin_actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td><?= e($utilisateur['prenom'] . ' ' . $utilisateur['nom']) ?></td>
                        <td><?= e($utilisateur['email']) ?></td>
                        <td><?= e($utilisateur['role']) ?></td>
                        <td><?= e($utilisateur['statut']) ?></td>
                        <td>
                            <?php if ($utilisateur['role'] !== 'admin'): ?>
                                <div class="d-flex gap-2">
                                    <form method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="action" value="statut">
                                        <input type="hidden" name="utilisateur_id" value="<?= (int) $utilisateur['id'] ?>">
                                        <input type="hidden" name="statut" value="<?= $utilisateur['statut'] === 'actif' ? 'inactif' : 'actif' ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-<?= $utilisateur['statut'] === 'actif' ? 'warning' : 'success' ?>">
                                            <?= $utilisateur['statut'] === 'actif' ? t('admin_desactiver') : t('admin_activer') ?>
                                        </button>
                                    </form>

                                    <form method="post" onsubmit="return confirm('<?= e(t('admin_confirmer_suppression')) ?>');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="action" value="supprimer">
                                        <input type="hidden" name="utilisateur_id" value="<?= (int) $utilisateur['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <?= t('admin_supprimer') ?>
                                        </button>
                                    </form>
                                </div>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
