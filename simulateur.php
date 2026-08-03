<?php

include "includes/header.php";

?>


<div class="container py-5">


<div class="row justify-content-center">


<div class="col-md-7">


<div class="card shadow p-5">


<h2 class="text-center mb-4">

<i class="fas fa-calculator"></i>

<?= t('sim_titre') ?>

</h2>


<form id="simulationForm">


<div class="mb-3">

<label>
<?= t('sim_montant_label') ?>
</label>

<input type="number"
id="montant"
class="form-control"
placeholder="Ex: 500000"
required>

</div>



<div class="mb-3">

<label>
<?= t('sim_duree_label') ?>
</label>


<select id="duree"
class="form-control">

<option value="6">6 <?= t('unite_mois') ?></option>

<option value="12">
12 <?= t('unite_mois') ?>
</option>

<option value="24">
24 <?= t('unite_mois') ?>
</option>

<option value="36">
36 <?= t('unite_mois') ?>
</option>

<option value="48">
48 <?= t('unite_mois') ?>
</option>

</select>

</div>



<button type="button"
onclick="calculerPret()"
class="btn btn-smart w-100">

<?= t('sim_calculer') ?>

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


<script>
window.i18nSimulateur = {
    resultatTitre: <?= json_encode(t('sim_resultat_titre')) ?>,
    montant: <?= json_encode(t('sim_resultat_montant')) ?>,
    duree: <?= json_encode(t('sim_resultat_duree')) ?>,
    taux: <?= json_encode(t('sim_resultat_taux')) ?>,
    mensualite: <?= json_encode(t('sim_resultat_mensualite')) ?>,
    mois: <?= json_encode(t('unite_mois')) ?>
};
</script>
<script src="assets/js/simulateur.js"></script>


<?php

include "includes/footer.php";

?>
