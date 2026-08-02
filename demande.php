<?php

require_once "config/config.php";
require_once "config/fonctions.php";

obligerConnexion();


$message = "";


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


    if(isset($_FILES['document']) 
    && $_FILES['document']['error']==0){


        $nomFichier = time()."_".$_FILES['document']['name'];


        $chemin = "uploads/".$nomFichier;


        move_uploaded_file(
            $_FILES['document']['tmp_name'],
            $chemin
        );


        $document = $nomFichier;

    }



    $req = $pdo->prepare(

    "INSERT INTO demandes
    (utilisateur_id,montant,duree,taux,mensualite,objet,document)
    VALUES (?,?,?,?,?,?,?)"

    );



    $req->execute([

        $_SESSION['id'],
        $montant,
        $duree,
        $taux,
        $mensualite,
        $objet,
        $document

    ]);



    $message = "Votre demande a été envoyée avec succès.";

}



include "includes/header.php";
include "includes/navbar.php";

?>



<div class="container py-5">


<div class="row justify-content-center">


<div class="col-md-7">


<div class="card shadow p-5">


<h2 class="text-center mb-4">

<i class="fas fa-hand-holding-dollar"></i>

Demande de prêt

</h2>



<?php if($message): ?>

<div class="alert alert-success">

<?= $message ?>

</div>

<?php endif; ?>



<form method="POST"
enctype="multipart/form-data">



<div class="mb-3">

<label>
Montant demandé (FCFA)
</label>


<input type="number"
name="montant"
class="form-control"
required>

</div>



<div class="mb-3">

<label>
Durée du remboursement
</label>


<select name="duree"
class="form-control">


<option value="6">
6 mois
</option>


<option value="12">
12 mois
</option>


<option value="24">
24 mois
</option>


<option value="36">
36 mois
</option>


</select>


</div>



<div class="mb-3">

<label>
Objet du prêt
</label>


<textarea name="objet"
class="form-control"
rows="4"
placeholder="Expliquez votre projet..."
required></textarea>


</div>



<div class="mb-3">

<label>
Document justificatif (PDF/JPG/PNG)
</label>


<input type="file"
name="document"
class="form-control">


</div>



<button class="btn btn-smart w-100"
name="envoyer">

Envoyer ma demande

</button>



</form>


</div>


</div>


</div>


</div>



<?php

include "includes/footer.php";

?>