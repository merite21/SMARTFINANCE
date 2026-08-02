<?php

require_once "../config/fonctions.php";

obligerConnexion();


$resultat = "";


if(isset($_POST['calculer'])){


    $montant = $_POST['montant'];
    $duree = $_POST['duree'];

    // taux fixe exemple 5%
    $taux = 0.05;


    $interet = $montant * $taux;

    $total = $montant + $interet;


    $mensualite = $total / $duree;


    $resultat = number_format($mensualite,0," "," ");

}


?>


<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Simulateur</title>


<link 
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>


<body class="bg-light">


<div class="container mt-5">


<div class="card shadow p-4 col-md-6 mx-auto">


<h2 class="text-center">
Simulation de prêt
</h2>


<form method="POST">


<input 
class="form-control mb-3"
type="number"
name="montant"
placeholder="Montant du prêt"
required>



<input 
class="form-control mb-3"
type="number"
name="duree"
placeholder="Durée en mois"
required>



<button 
class="btn btn-primary w-100"
name="calculer">

Calculer

</button>


</form>



<?php if($resultat): ?>


<div class="alert alert-success mt-3">

Votre mensualité estimée est :

<b><?= $resultat ?> FCFA</b>

</div>


<a href="demande.php"
class="btn btn-success w-100">

Faire une demande

</a>


<?php endif; ?>


</div>


</div>


</body>

</html>