<?php

require_once "config/database.php";
require_once "config/fonctions.php";


$message="";


if(isset($_POST['connexion'])){


$email = securiser($_POST['email']);

$password = $_POST['password'];



$req = $pdo->prepare(

"SELECT * FROM utilisateurs WHERE email=?"

);


$req->execute([$email]);


$user = $req->fetch();



if($user && password_verify($password,$user['password'])){


$_SESSION['user'] = $user;



if($user['role']=="admin"){


header("Location: admin/dashboard.php");


}else{


header("Location: utilisateur/dashboard.php");


}


exit;



}else{


$message="Email ou mot de passe incorrect";


}


}


?>


<!DOCTYPE html>

<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Connexion</title>


<link 
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>



<body class="bg-light">


<div class="container mt-5">


<div class="card shadow p-4 col-md-5 mx-auto">


<h2 class="text-center">
Connexion
</h2>



<?php if($message): ?>

<div class="alert alert-danger">
<?= $message ?>
</div>

<?php endif; ?>



<form method="POST">


<input
class="form-control mb-3"
type="email"
name="email"
placeholder="Email"
required>



<input
class="form-control mb-3"
type="password"
name="password"
placeholder="Mot de passe"
required>


<button
class="btn btn-primary w-100"
name="connexion">

Se connecter

</button>


</form>


</div>


</div>


</body>

</html>