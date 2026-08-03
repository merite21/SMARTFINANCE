<?php

require_once "config/config.php";
require_once "config/fonctions.php";
require_once "config/mail.php";

obligerConnexion();


$message = "";
$succes = false;


if(isset($_POST['envoyer'])){


    $montant = securiser($_POST['montant']);
    $duree = securiser($_POST['duree']);
    $objet = securiser($_POST['objet']);



    // Calcul mensualité

    $taux = 10;

    $interet = ($montant * $taux * $duree) / (100 * 12);

    $total = $montant + $interet;

    $mensualite = $total / $duree;



    // Gestion fichier

    $document = "";
    $erreurFichier = "";


    if(isset($_FILES['document'])
    && $_FILES['document']['error']==0){


        $extensionsAutorisees = ['pdf','jpg','jpeg','png'];
        $tailleMaxOctets = 5 * 1024 * 1024; // 5 Mo

        $extension = strtolower(pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION));

        if(!in_array($extension, $extensionsAutorisees, true)){

            $erreurFichier = t('demande_erreur_format');

        }elseif($_FILES['document']['size'] > $tailleMaxOctets){

            $erreurFichier = t('demande_erreur_taille');

        }else{

            if(!is_dir("uploads")){
                mkdir("uploads", 0755, true);
            }

            $nomFichier = time()."_".bin2hex(random_bytes(4)).".".$extension;

            $chemin = "uploads/".$nomFichier;

            move_uploaded_file(
                $_FILES['document']['tmp_name'],
                $chemin
            );

            $document = $nomFichier;

        }

    }



    if($erreurFichier){

        $message = $erreurFichier;

    }else{

        $req = $pdo->prepare(

        "INSERT INTO demandes
        (utilisateur_id,montant,duree,taux,mensualite,objet,document)
        VALUES (?,?,?,?,?,?,?)"

        );



        $req->execute([

            $_SESSION['user']['id'],
            $montant,
            $duree,
            $taux,
            $mensualite,
            $objet,
            $document

        ]);



        $message = t('demande_succes');
        $succes = true;

        notifierProprietaire(
            "Nouvelle demande de prêt sur SmartFinance",
            "<h3>Nouvelle demande de prêt</h3>
            <p><strong>Client :</strong> " . e($_SESSION['user']['prenom']) . " " . e($_SESSION['user']['nom']) . "</p>
            <p><strong>Email :</strong> " . e($_SESSION['user']['email']) . "</p>
            <p><strong>Montant :</strong> " . e($montant) . " FCFA</p>
            <p><strong>Durée :</strong> " . e($duree) . " mois</p>
            <p><strong>Objet :</strong> " . e($objet) . "</p>"
        );

    }

}



include "includes/header.php";

?>



<div class="container py-5">


<div class="row justify-content-center">


<div class="col-md-7">


<div class="card shadow p-5">


<h2 class="text-center mb-4">

<i class="fas fa-hand-holding-dollar"></i>

<?= t('demande_titre') ?>

</h2>



<?php if($message): ?>

<div class="alert alert-<?= $succes ? 'success' : 'danger' ?>">

<?= e($message) ?>

</div>

<?php endif; ?>



<form method="POST"
enctype="multipart/form-data">



<div class="mb-3">

<label>
<?= t('demande_montant_label') ?>
</label>


<input type="number"
name="montant"
class="form-control"
required>

</div>



<div class="mb-3">

<label>
<?= t('demande_duree_label') ?>
</label>


<select name="duree"
class="form-control">


<option value="6">
6 <?= t('unite_mois') ?>
</option>


<option value="12">
12 <?= t('unite_mois') ?>
</option>


<option value="24">
24 <?= t('unite_mois') ?>
</option>


<option value="36">
36 <?= t('unite_mois') ?>
</option>


</select>


</div>



<div class="mb-3">

<label>
<?= t('demande_objet_label') ?>
</label>


<textarea name="objet"
class="form-control"
rows="4"
placeholder="<?= e(t('demande_objet_placeholder')) ?>"
required></textarea>


</div>



<div class="mb-3">

<label>
<?= t('demande_document_label') ?>
</label>


<input type="file"
name="document"
class="form-control">


</div>



<button class="btn btn-smart w-100"
name="envoyer">

<?= t('demande_envoyer') ?>

</button>



</form>


</div>


</div>


</div>


</div>



<?php

include "includes/footer.php";

?>
