<?php

require_once "../config/database.php";
require_once "../config/fonctions.php";


obligerConnexion();


$user=$_SESSION['user'];



$req=$pdo->prepare(

"SELECT * FROM demandes_pret 
WHERE user_id=? 
ORDER BY date_demande DESC"

);


$req->execute([$user['id']]);


$demandes=$req->fetchAll();


?>


<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Historique</title>


<link 
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>


<body>


<div class="container mt-5">


<h2>
Mes demandes
</h2>



<table class="table table-bordered">


<tr>

<th>Montant</th>

<th>Durée</th>

<th>Statut</th>

<th>Date</th>

</tr>



<?php foreach($demandes as $d): ?>


<tr>

<td>
<?= $d['montant'] ?> FCFA
</td>


<td>
<?= $d['duree'] ?> mois
</td>


<td>

<?php if($d['statut']=="Acceptée"): ?>

<span class="badge bg-success">
Acceptée
</span>


<?php elseif($d['statut']=="Refusée"): ?>

<span class="badge bg-danger">
Refusée
</span>


<?php else: ?>

<span class="badge bg-warning">
En attente
</span>


<?php endif; ?>


</td>


<td>
<?= $d['date_demande'] ?>
</td>


</tr>


<?php endforeach; ?>


</table>


</div>


</body>

</html>