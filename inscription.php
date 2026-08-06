<?php

require_once "config/config.php";
require_once "config/fonctions.php";
require_once "config/mail.php";


$message = "";


if(isset($_POST['inscription'])){

verifier_csrf();

$nom = securiser($_POST['nom']);
$prenom = securiser($_POST['prenom']);
$email = securiser($_POST['email']);
$telephone = securiser($_POST['telephone']);

$date_naissance = $_POST['date_naissance'];
$sexe = securiser($_POST['sexe']);
$adresse = securiser($_POST['adresse']);
$ville = securiser($_POST['ville']);
$pays = securiser($_POST['pays']);
$profession = securiser($_POST['profession']);
$employeur = securiser($_POST['employeur']);
$revenu = $_POST['revenu'];


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


        $req = $pdo->prepare("
INSERT INTO utilisateurs
(
nom,
prenom,
email,
telephone,
date_naissance,
sexe,
adresse,
ville,
pays,
profession,
employeur,
revenu,
mot_de_passe
)
VALUES
(?,?,?,?,?,?,?,?,?,?,?,?,?)
");
        
$req->execute([
    $nom,
    $prenom,
    $email,
    $telephone,
    $date_naissance,
    $sexe,
    $adresse,
    $ville,
    $pays,
    $profession,
    $employeur,
    $revenu,
    $password
]);


        $nouvelUtilisateur = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $nouvelUtilisateur->execute([$email]);
        $user = $nouvelUtilisateur->fetch();

       notifierProprietaire(
    "Nouvelle inscription sur SmartFinance",
    "<h3>Nouveau compte créé</h3>
    <p><strong>Nom :</strong> " . e($nom) . " " . e($prenom) . "</p>
    <p><strong>Email :</strong> " . e($email) . "</p>
    <p><strong>Téléphone :</strong> " . e($telephone) . "</p>"
);

        // Connexion automatique + redirection vers le tableau de bord
        $_SESSION['user'] = $user;
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

        <form method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <h5 class="mt-4 mb-3 text-primary">
    <i class="fas fa-user"></i> <?= t('inscription_infos_perso') ?>
</h5>

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
type="date"
name="date_naissance"
required>

<select
class="form-control mb-3"
name="sexe"
required>
    <option value=""><?= t('inscription_sexe_choisir') ?></option>
    <option value="Homme"><?= t('inscription_sexe_homme') ?></option>
    <option value="Femme"><?= t('inscription_sexe_femme') ?></option>
</select>

<h5 class="mt-4 mb-3 text-primary">
    <i class="fas fa-location-dot"></i> <?= t('inscription_adresse_titre') ?>
</h5>
<input
class="form-control mb-3"
type="text"
name="adresse"
placeholder="<?= t('inscription_adresse') ?>"
required>

<input
class="form-control mb-3"
type="text"
name="ville"
placeholder="<?= t('inscription_ville') ?>"
required>

<input
class="form-control mb-3"
type="text"
name="pays"
placeholder="<?= t('inscription_pays') ?>"
required>
        
<h5 class="mt-4 mb-3 text-primary">
    <i class="fas fa-briefcase"></i> <?= t('inscription_pro_titre') ?>
</h5>
<select
class="form-control mb-3"
name="profession"
id="profession"
required>

    <option value=""><?= t('inscription_profession_choisir') ?></option>
    <option value="Salarié"><?= t('inscription_profession_salarie') ?></option>
    <option value="Fonctionnaire"><?= t('inscription_profession_fonctionnaire') ?></option>
    <option value="Indépendant"><?= t('inscription_profession_independant') ?></option>
    <option value="Commerçant"><?= t('inscription_profession_commercant') ?></option>
    <option value="Étudiant"><?= t('inscription_profession_etudiant') ?></option>
    <option value="Sans emploi"><?= t('inscription_profession_sans_emploi') ?></option>
    <option value="Retraité"><?= t('inscription_profession_retraite') ?></option>

</select>
            
<input
class="form-control mb-3"
type="text"
name="employeur"
id="employeur"
placeholder="<?= t('inscription_employeur') ?>">

<input
class="form-control mb-3"
type="number"
name="revenu"
placeholder="<?= t('inscription_revenu') ?>"
required>

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
<script>

const profession = document.getElementById("profession");
const employeur = document.getElementById("employeur");

function verifierEmployeur(){

    if(
        profession.value === "Salarié" ||
        profession.value === "Fonctionnaire" ||
        profession.value === "Indépendant" ||
        profession.value === "Commerçant"
    ){
        employeur.style.display = "block";
        employeur.required = true;
    }else{
        employeur.style.display = "none";
        employeur.required = false;
        employeur.value = "";
    }

}

profession.addEventListener("change", verifierEmployeur);

verifierEmployeur();

</script>
<?php require_once "includes/footer.php"; ?>