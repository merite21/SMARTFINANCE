<?php

require_once "config/database.php";
require_once "config/fonctions.php";


$message = "";


if(isset($_POST['inscription'])){


    $nom = securiser($_POST['nom']);
    $prenom = securiser($_POST['prenom']);
    $email = securiser($_POST['email']);
    $telephone = securiser($_POST['telephone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);



    // Vérifier si email existe

    $verification = $pdo->prepare(
        "SELECT id FROM utilisateurs WHERE email=?"
    );

    $verification->execute([$email]);


    if($verification->rowCount() > 0){


        $message = "Cette adresse email existe déjà";


    }else{


        $req = $pdo->prepare(

            "INSERT INTO utilisateurs
            (nom,prenom,email,telephone,password)
            VALUES (?,?,?,?,?)"

        );


        $req->execute([
            $nom,
            $prenom,
            $email,
            $telephone,
            $password
        ]);


        $message = "Compte créé avec succès";


    }


}



?>


<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Inscription - SmartFinance</title>

<link 
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>


<body class="bg-light">


<div class="container mt-5">


<div class="col-md-6 mx-auto card p-4 shadow">


<h2 class="text-center">
Créer un compte
</h2>


<?php if($message): ?>

<div class="alert alert-info">
<?= $message ?>
</div>

<?php endif; ?>


<form method="POST">


<input 
class="form-control mb-3"
type="text"
name="nom"
placeholder="Nom"
required>



<input 
class="form-control mb-3"
type="text"
name="prenom"
placeholder="Prénom"
required>



<input 
class="form-control mb-3"
type="email"
name="email"
placeholder="Email"
required>



<input 
class="form-control mb-3"
type="text"
name="telephone"
placeholder="Téléphone">



<input 
class="form-control mb-3"
type="password"
name="password"
placeholder="Mot de passe"
required>



<button
class="btn btn-primary w-100"
name="inscription">

Créer mon compte

</button>


</form>


</div>


</div>


</body>

</html>