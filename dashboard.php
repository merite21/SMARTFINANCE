<?php

require_once "../config/fonctions.php";


obligerConnexion();


$user = $_SESSION['user'];

?>


<!DOCTYPE html>

<html lang="fr">


<head>

<meta charset="UTF-8">

<title>Dashboard</title>


<link 
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">


</head>


<body>


<nav class="navbar navbar-dark bg-primary">

<div class="container">


<a class="navbar-brand">
SMARTFINANCE
</a>


<a href="../deconnexion.php"
class="btn btn-light">

Déconnexion

</a>


</div>

</nav>



<div class="container mt-5">


<h1>
Bienvenue <?= $user['prenom'] ?>
</h1>


<div class="row mt-4">


<div class="col-md-4">

<div class="card shadow p-4">

<h4>
Simulation
</h4>

<p>
Calculez votre prêt.
</p>

<a href="simulateur.php"
class="btn btn-primary">

Simuler

</a>


</div>

</div>




<div class="col-md-4">

<div class="card shadow p-4">

<h4>
Demande de prêt
</h4>

<p>
Faire une demande.
</p>


</div>

</div>



<div class="col-md-4">

<div class="card shadow p-4">

<h4>
Historique
</h4>

<p>
Voir vos demandes.
</p>


</div>

</div>



</div>


</div>


</body>

</html>