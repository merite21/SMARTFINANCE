<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/fonctions.php';

obligerAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifier_csrf();
}

// Traitement du changement de statut
if (isset($_POST['demande_id'], $_POST['statut'])) {
    $statuts_valides = ['En attente', 'Approuvé', 'Refusé'];
    $nouveau_statut = $_POST['statut'];

    if (in_array($nouveau_statut, $statuts_valides, true)) {
        $maj = $pdo->prepare('UPDATE demandes SET statut = ? WHERE id = ?');
        $maj->execute([$nouveau_statut, (int) $_POST['demande_id']]);
    }
}

$demandes = $pdo->query(
    "SELECT demandes.*, utilisateurs.nom, utilisateurs.prenom, utilisateurs.email
     FROM demandes
     JOIN utilisateurs ON utilisateurs.id = demandes.utilisateur_id
     ORDER BY demandes.id DESC"
)->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>
<div class="container mt-4">
    <div class="card p-4">
        <h1><?= t('admin_demandes_titre') ?></h1>
        <a href="index.php" class="btn btn-secondary mb-3"><?= t('admin_retour') ?></a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= t('admin_client') ?></th>
                    <th><?= t('admin_montant') ?></th>
                    <th><?= t('admin_duree') ?></th>
                    <th><?= t('admin_mensualite') ?></th>
                    <th><?= t('admin_statut') ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($demandes as $demande): ?>
                    <tr>
                        <td><?= (int) $demande['id'] ?></td>
                        <td><?= e($demande['prenom'] . ' ' . $demande['nom']) ?><br>
                            <small class="text-muted"><?= e($demande['email']) ?></small></td>
                        <td><?= number_format((float) $demande['montant'], 2, ',', ' ') ?> FCFA</td>
                        <td><?= (int) $demande['duree'] ?> <?= t('admin_mois') ?></td>
                        <td><?= number_format((float) $demande['mensualite'], 2, ',', ' ') ?> FCFA</td>
                        <td>
                            <span class="badge bg-<?= $demande['statut'] === 'Approuvé' ? 'success' : ($demande['statut'] === 'Refusé' ? 'danger' : 'warning') ?>">
                                <?php if ($demande['statut'] === 'Approuvé'): ?>
                                    <?= t('admin_statut_approuve') ?>
                                <?php elseif ($demande['statut'] === 'Refusé'): ?>
                                    <?= t('admin_statut_refuse') ?>
                                <?php else: ?>
                                    <?= t('admin_statut_attente') ?>
                                <?php endif; ?>
                            </span>
                        </td>
                        <td>
                            <form method="post" class="d-flex gap-1">
                                <?= csrf_field() ?>
                                <input type="hidden" name="demande_id" value="<?= (int) $demande['id'] ?>">
                                <select name="statut" class="form-select form-select-sm">
                                    <option value="En attente" <?= $demande['statut'] === 'En attente' ? 'selected' : '' ?>><?= t('admin_statut_attente') ?></option>
                                    <option value="Approuvé" <?= $demande['statut'] === 'Approuvé' ? 'selected' : '' ?>><?= t('admin_statut_approuve') ?></option>
                                    <option value="Refusé" <?= $demande['statut'] === 'Refusé' ? 'selected' : '' ?>><?= t('admin_statut_refuse') ?></option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary"><?= t('admin_mettre_a_jour') ?></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($demandes)): ?>
                    <tr><td colspan="7"><?= t('admin_aucune_demande') ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
