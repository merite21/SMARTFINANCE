<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/fonctions.php';

obligerConnexion();

$stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE id = ?');
$stmt->execute([$_SESSION['user']['id']]);
$user = $stmt->fetch();

$messagePwd = "";
$succesPwd = "";

if(isset($_POST['changer_mdp'])){

    verifier_csrf();

    $ancien = $_POST['ancien_mot_de_passe'] ?? '';
    $nouveau = $_POST['nouveau_mot_de_passe'] ?? '';
    $confirmation = $_POST['confirmation_mot_de_passe'] ?? '';

    if(!password_verify($ancien, $user['mot_de_passe'])){

        $messagePwd = "Le mot de passe actuel est incorrect.";

    }elseif(strlen($nouveau) < 6){

        $messagePwd = "Le nouveau mot de passe doit contenir au moins 6 caractères.";

    }elseif($nouveau !== $confirmation){

        $messagePwd = "La confirmation ne correspond pas au nouveau mot de passe.";

    }elseif(password_verify($nouveau, $user['mot_de_passe'])){

        $messagePwd = "Le nouveau mot de passe doit être différent de l'ancien.";

    }else{

        $nouveauHash = password_hash($nouveau, PASSWORD_DEFAULT);

        $maj = $pdo->prepare('UPDATE utilisateurs SET mot_de_passe = ? WHERE id = ?');
        $maj->execute([$nouveauHash, $user['id']]);

        // On recharge l'utilisateur pour que le hash en session soit à jour
        $stmt->execute([$user['id']]);
        $user = $stmt->fetch();
        $_SESSION['user'] = $user;

        $succesPwd = "Votre mot de passe a été modifié avec succès.";

    }

}

require_once __DIR__ . '/includes/header.php';
?>
<div class="container mt-4">
    <div class="card p-4">
        <h1>Profil</h1>

        <h5 class="mt-3 mb-2 text-primary"><i class="fas fa-user"></i> Informations personnelles</h5>
        <p><strong>Prénom :</strong> <?= e($user['prenom'] ?? '') ?></p>
        <p><strong>Nom :</strong> <?= e($user['nom'] ?? '') ?></p>
        <p><strong>Email :</strong> <?= e($user['email'] ?? '') ?></p>
        <p><strong>Téléphone :</strong> <?= e($user['telephone'] ?? '') ?></p>
        <p><strong>Date de naissance :</strong> <?= e($user['date_naissance'] ?? '') ?></p>
        <p><strong>Sexe :</strong> <?= e($user['sexe'] ?? '') ?></p>
        <p><strong>Rôle :</strong> <?= e($user['role'] ?? 'client') ?></p>

        <h5 class="mt-4 mb-2 text-primary"><i class="fas fa-location-dot"></i> Adresse</h5>
        <p><strong>Adresse :</strong> <?= e($user['adresse'] ?? '') ?></p>
        <p><strong>Ville :</strong> <?= e($user['ville'] ?? '') ?></p>
        <p><strong>Pays :</strong> <?= e($user['pays'] ?? '') ?></p>

        <h5 class="mt-4 mb-2 text-primary"><i class="fas fa-briefcase"></i> Situation professionnelle</h5>
        <p><strong>Profession :</strong> <?= e($user['profession'] ?? '') ?></p>
        <p><strong>Employeur :</strong> <?= e($user['employeur'] ?? '') ?></p>
        <p><strong>Revenu mensuel :</strong> <?= e($user['revenu'] ?? '') ?></p>

        <h5 class="mt-4 mb-2 text-primary"><i class="fas fa-lock"></i> Changer le mot de passe</h5>

        <?php if($messagePwd): ?>
            <div class="alert alert-danger"><?= e($messagePwd) ?></div>
        <?php endif; ?>

        <?php if($succesPwd): ?>
            <div class="alert alert-success"><?= e($succesPwd) ?></div>
        <?php endif; ?>

        <form method="POST" autocomplete="off">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Mot de passe actuel</label>
                <input
                class="form-control"
                type="password"
                name="ancien_mot_de_passe"
                autocomplete="current-password"
                required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nouveau mot de passe</label>
                <input
                class="form-control"
                type="password"
                name="nouveau_mot_de_passe"
                minlength="6"
                autocomplete="new-password"
                required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmer le nouveau mot de passe</label>
                <input
                class="form-control"
                type="password"
                name="confirmation_mot_de_passe"
                minlength="6"
                autocomplete="new-password"
                required>
            </div>

            <button class="btn btn-smart" name="changer_mdp">
                Mettre à jour le mot de passe
            </button>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
