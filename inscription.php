<?php

require_once "config/config.php";
require_once "config/fonctions.php";
require_once "config/mail.php";


$message = "";


if(isset($_POST['inscription'])){


    $nom = securiser($_POST['nom']);
    $prenom = securiser($_POST['prenom']);
    $email = securiser($_POST['email']);
    $telephone = securiser($_POST['telephone']);


    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

        $message = "Adresse email invalide.";

    }elseif(strlen($_POST['password']) < 6){

        $message = "Le mot de passe doit contenir au moins 6 caractères.";

    }else{

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);



    // Vérifier si email existe

    $verification = $pdo->prepare(
        "SELECT id FROM utilisateurs WHERE email=?"
    );

    $verification->execute([$email]);


    if($verification->rowCount() > 0){


        $message = "Cette adresse email existe déjà";


    }else{


        $req = $pdo->prepare(

            "INSERT INTO utilisateurs
            (nom,prenom,email,telephone,mot_de_passe)
            VALUES (?,?,?,?,?)"

        );


        $req->execute([
            $nom,
            $prenom,
            $email,
            $telephone,
            $password
        ]);


        // Connexion automatique + redirection vers le tableau de bord
        $nouvelUtilisateur = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $nouvelUtilisateur->execute([$email]);
        $_SESSION['user'] = $nouvelUtilisateur->fetch();

        notifierProprietaire(
    "Nouvelle inscription sur SmartFinance",
    "<h3>Nouveau compte créé</h3>
    <p><strong>Nom :</strong> " . $nom . " " . $prenom . "</p>
    <p><strong>Email :</strong> " . $email . "</p>
    <p><strong>Téléphone :</strong> " . $telephone . "</p>"
); 

        redirect("dashboard.php");


    }

    }


}



?>


<?php require_once "includes/header.php"; ?>

<div class="container py-5">
    <div class="auth-card shadow-sm col-md-6 mx-auto">

        <h2 class="text-center mb-4">
            <i class="fas fa-user-plus text-primary"></i>
            <?= t('inscription_titre') ?>
        </h2>

        <?php if($message): ?>
            <div class="alert alert-<?= str_contains($message, 'succès') ? 'success' : 'info' ?>">
                <?= e($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <input
            class="form-control mb-3"
            type="text"
            name="nom"
            placeholder="<?= t('inscription_nom') ?>"
            required>

            <input
            class="form-control mb-3"
            type="text"
            name="prenom"
            placeholder="<?= t('inscription_prenom') ?>"
            required>

            <input
            class="form-control mb-3"
            type="email"
            name="email"
            placeholder="<?= t('inscription_email') ?>"
            required>

            <input
            class="form-control mb-3"
            type="text"
            name="telephone"
            placeholder="<?= t('inscription_telephone') ?>">

            <input
            class="form-control mb-3"
            type="password"
            name="password"
            placeholder="<?= t('inscription_mdp') ?>"
            minlength="6"
            required>

            <button
            class="btn btn-smart w-100"
            name="inscription">
                <?= t('inscription_bouton') ?>
            </button>

        </form>

        <p class="text-center text-muted mt-4 mb-0">
            <?= t('inscription_deja_compte') ?>
            <a href="connexion.php" class="fw-semibold"><?= t('inscription_se_connecter') ?></a>
        </p>

    </div>
</div>

<?php require_once "includes/footer.php"; ?>