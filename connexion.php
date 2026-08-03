<?php

require_once "config/config.php";
require_once "config/fonctions.php";


$message="";


if(isset($_POST['connexion'])){


$email = securiser($_POST['email']);

$password = $_POST['password'];



$req = $pdo->prepare(

"SELECT * FROM utilisateurs WHERE email=?"

);


$req->execute([$email]);


$user = $req->fetch();



if($user && password_verify($password,$user['mot_de_passe'])){


if(isset($user['statut']) && $user['statut'] === 'inactif'){

    $message = "Votre compte a été désactivé. Contactez l'administrateur.";

}else{


$_SESSION['user'] = $user;



if($user['role']=="admin"){


header("Location: admin/index.php");


}else{


header("Location: dashboard.php");


}


exit;


}


}else{


$message="Email ou mot de passe incorrect";


}


}


?>

<?php require_once "includes/header.php"; ?>

<div class="container py-5">
    <div class="auth-card shadow-sm col-md-5 mx-auto">

        <h2 class="text-center mb-4">
            <i class="fas fa-right-to-bracket text-primary"></i>
            Connexion
        </h2>

        <?php if($message): ?>
            <div class="alert alert-danger"><?= e($message) ?></div>
        <?php endif; ?>

        <form method="POST">

            <input
            class="form-control mb-3"
            type="email"
            name="email"
            placeholder="Email"
            required>

            <input
            class="form-control mb-3"
            type="password"
            name="password"
            placeholder="Mot de passe"
            required>

            <button
            class="btn btn-smart w-100"
            name="connexion">
                Se connecter
            </button>

        </form>

        <p class="text-center text-muted mt-4 mb-0">
            Pas encore de compte ?
            <a href="inscription.php" class="fw-semibold">Créer un compte</a>
        </p>

    </div>
</div>

<?php require_once "includes/footer.php"; ?>