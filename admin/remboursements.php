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
        <h1>Remboursements</h1>
        <a href="index.php" class="btn btn-secondary mb-3">Retour au tableau de bord</a>
        <table class="table table-striped">
            <thead>
                <tr><th>Client</th><th>Montant payé</th><th>Date</th><th>Statut</th></tr>
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
                    <tr><td colspan="4">Aucun remboursement enregistré.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="card p-4">
        <h2>Enregistrer un remboursement</h2>
        <?php if (empty($demandes_approuvees)): ?>
            <p>Aucune demande approuvée pour le moment.</p>
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
                    <input type="number" step="0.01" name="montant" class="form-control" placeholder="Montant payé" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
