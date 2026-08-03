<?php

require_once "config/config.php";
require_once "config/fonctions.php";

obligerConnexion();


$id_client = $_SESSION['user']['id'];



$req = $pdo->prepare(

"SELECT * FROM demandes 
WHERE utilisateur_id = ?
ORDER BY date_demande DESC"

);


$req->execute([$id_client]);


$demandes = $req->fetchAll();



include "includes/header.php";

?>


<div class="container py-5">


<h2 class="mb-4 text-center">

<i class="fas fa-clock"></i>

Historique de mes demandes

</h2>



<div class="card shadow p-4">


<?php if(count($demandes) > 0): ?>


<div class="table-responsive">


<table class="table table-bordered table-hover">


<thead class="table-primary">


<tr>

<th>#</th>

<th>Montant</th>

<th>Durée</th>

<th>Mensualité</th>

<th>Date</th>

<th>Statut</th>

</tr>


</thead>



<tbody>


<?php foreach($demandes as $demande): ?>


<tr>


<td>
<?= $demande['id']; ?>
</td>


<td>
<?= number_format($demande['montant'],0,' ',' '); ?> FCFA
</td>


<td>
<?= $demande['duree']; ?> mois
</td>


<td>
<?= number_format($demande['mensualite'],0,' ',' '); ?> FCFA
</td>


<td>
<?= date("d/m/Y",strtotime($demande['date_demande'])); ?>
</td>



<td>


<?php if($demande['statut']=="Approuvé"): ?>


<span class="badge bg-success">
Approuvé
</span>


<?php elseif($demande['statut']=="Refusé"): ?>


<span class="badge bg-danger">
Refusé
</span>


<?php else: ?>


<span class="badge bg-warning text-dark">
En attente
</span>


<?php endif; ?>


</td>


</tr>



<?php endforeach; ?>


</tbody>


</table>


</div>



<?php else: ?>


<div class="alert alert-info text-center">

Vous n'avez encore effectué aucune demande de prêt.

</div>


<?php endif; ?>


</div>


</div>



<?php

include "includes/footer.php";

?>