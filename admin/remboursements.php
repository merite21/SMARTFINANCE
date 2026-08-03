<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/fonctions.php';

obligerAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifier_csrf();
}

// Enregistrer un remboursement
if (isset($_POST['demande_id'], $_POST['montant'], $_POST['action']) && $_POST['action'] === 'ajouter') {
    $ajout = $pdo->prepare(
        "INSERT INTO remboursements (demande_id, montant, date_paiement, statut)
         VALUES (?, ?, CURDATE(), 'Payé')"
    );
    $ajout->execute([(int) $_POST['demande_id'], (float) $_POST['montant']]);
}

$remboursements = $pdo->query(
    "SELECT remboursements.*, utilisateurs.nom, utilisateurs.prenom
     FROM remboursements
     JOIN demandes ON demandes.id = remboursements.demande_id
     JOIN utilisateurs ON utilisateurs.id = demandes.utilisateur_id
     ORDER BY remboursements.id DESC"
)->fetchAll();

$demandes_approuvees = $pdo->query(
    "SELECT demandes.id, demandes.montant, utilisateurs.nom, utilisateurs.prenom
     FROM demandes
     JOIN utilisateurs ON utilisateurs.id = demandes.utilisateur_id
     WHERE demandes.statut = 'Approuvé'
     ORDER BY demandes.id DESC"
)->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>
<div class="container mt-4">
    <div class="card p-4 mb-4">
        <h1><?= t('admin_remboursements_titre') ?></h1>
        <a href="index.php" class="btn btn-secondary mb-3"><?= t('admin_retour') ?></a>
        <table class="table table-striped">
            <thead>
                <tr><th><?= t('admin_client') ?></th><th><?= t('admin_montant_paye') ?></th><th><?= t('admin_date') ?></th><th><?= t('admin_statut') ?></th></tr>
            </thead>
            <tbody>
                <?php foreach ($remboursements as $r): ?>
                    <tr>
                        <td><?= e($r['prenom'] . ' ' . $r['nom']) ?></td>
                        <td><?= number_format((float) $r['montant'], 2, ',', ' ') ?> FCFA</td>
                        <td><?= e($r['date_paiement']) ?></td>
                        <td><span class="badge bg-success"><?= e($r['statut']) ?></span></td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($remboursements)): ?>
                    <tr><td colspan="4"><?= t('admin_aucun_remboursement') ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="card p-4">
        <h2><?= t('admin_enregistrer_remboursement') ?></h2>
        <?php if (empty($demandes_approuvees)): ?>
            <p><?= t('admin_aucune_demande_approuvee') ?></p>
        <?php else: ?>
            <form method="post" class="row g-2">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="ajouter">
                <div class="col-md-6">
                    <select name="demande_id" class="form-select" required>
                        <?php foreach ($demandes_approuvees as $d): ?>
                            <option value="<?= (int) $d['id'] ?>">
                                #<?= (int) $d['id'] ?> — <?= e($d['prenom'] . ' ' . $d['nom']) ?>
                                (<?= number_format((float) $d['montant'], 2, ',', ' ') ?> FCFA)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" step="0.01" name="montant" class="form-control" placeholder="<?= e(t('admin_montant_paye')) ?>" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100"><?= t('admin_enregistrer') ?></button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
