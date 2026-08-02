<?php

require_once "../config/database.php";
require_once "../config/fonctions.php";


obligerConnexion();


$user = $_SESSION['user'];


$message="";


if(isset($_POST['envoyer'])){


$montant = $_POST['montant'];

$duree = $_POST['duree'];

$revenu = $_POST['revenu'];

$motif = securiser($_POST['motif']);



$req=$pdo->prepare(

"INSERT INTO demandes_pret
(user_id,montant,duree,revenu,motif)
VALUES(?,?,?,?,?)"

);


$req->execute([

$user['id'],
$montant,
$duree,
$revenu,
$motif

]);



$message="Votre demande a été envoyée";


}


?>


<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Demande prêt</title>


<link 
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>


<body class="bg-light">


<div class="container mt-5">


<div class="card shadow p-4 col-md-6 mx-auto">


<h2>
Demande de prêt
</h2>



<?php if($message): ?>

<div class="alert alert-success">

<?= $message ?>

</div>

<?php endif; ?>



<form method="POST">


<input
class="form-control mb-3"
type="number"
name="montant"
placeholder="Montant demandé"
required>


<input
class="form-control mb-3"
type="number"
name="duree"
placeholder="Durée (mois)"
required>


<input
class="form-control mb-3"
type="number"
name="revenu"
placeholder="Votre revenu mensuel"
required>


<textarea
class="form-control mb-3"
name="motif"
placeholder="Motif du prêt">
</textarea>


<button
class="btn btn-primary w-100"
name="envoyer">

Envoyer la demande

</button>


</form>


</div>


</div>


</body>

</html>