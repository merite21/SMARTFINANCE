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
        <h1>Demandes</h1>
        <a href="index.php" class="btn btn-secondary mb-3">Retour au tableau de bord</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Durée</th>
                    <th>Mensualité</th>
                    <th>Statut</th>
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
                        <td><?= (int) $demande['duree'] ?> mois</td>
                        <td><?= number_format((float) $demande['mensualite'], 2, ',', ' ') ?> FCFA</td>
                        <td>
                            <span class="badge bg-<?= $demande['statut'] === 'Approuvé' ? 'success' : ($demande['statut'] === 'Refusé' ? 'danger' : 'warning') ?>">
                                <?= e($demande['statut']) ?>
                            </span>
                        </td>
                        <td>
                            <form method="post" class="d-flex gap-1">
                                <?= csrf_field() ?>
                                <input type="hidden" name="demande_id" value="<?= (int) $demande['id'] ?>">
                                <select name="statut" class="form-select form-select-sm">
                                    <option value="En attente" <?= $demande['statut'] === 'En attente' ? 'selected' : '' ?>>En attente</option>
                                    <option value="Approuvé" <?= $demande['statut'] === 'Approuvé' ? 'selected' : '' ?>>Approuvé</option>
                                    <option value="Refusé" <?= $demande['statut'] === 'Refusé' ? 'selected' : '' ?>>Refusé</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Mettre à jour</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($demandes)): ?>
                    <tr><td colspan="7">Aucune demande pour le moment.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
