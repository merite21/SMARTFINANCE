<?php

include "includes/header.php";
include "includes/navbar.php";

?>


<div class="container py-5">


<div class="row justify-content-center">


<div class="col-md-7">


<div class="card shadow p-5">


<h2 class="text-center mb-4">

<i class="fas fa-calculator"></i>

Simulateur de prêt SMARTFINANCE

</h2>


<form id="simulationForm">


<div class="mb-3">

<label>
Montant du prêt (FCFA)
</label>

<input type="number"
id="montant"
class="form-control"
placeholder="Ex: 500000"
required>

</div>



<div class="mb-3">

<label>
Durée (mois)
</label>


<select id="duree"
class="form-control">

<option value="6">6 mois</option>

<option value="12">
12 mois
</option>

<option value="24">
24 mois
</option>

<option value="36">
36 mois
</option>

<option value="48">
48 mois
</option>

</select>

</div>



<button type="button"
onclick="calculerPret()"
class="btn btn-smart w-100">

Calculer

</button>


</form>


<hr>


<div id="resultat"
class="text-center mt-4">

</div>


</div>


</div>


</div>


</div>



<script src="assets/js/simulateur.js"></script>


<?php

include "includes/footer.php";

?>