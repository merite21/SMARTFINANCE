function calculerPret(){


let montant = document.getElementById("montant").value;

let duree = document.getElementById("duree").value;


// taux annuel

let taux = 10;


// conversion

let interet = (montant * taux * duree) / (100 * 12);


let total = Number(montant) + Number(interet);


let mensualite = total / duree;



document.getElementById("resultat").innerHTML = `

<div class="alert alert-success">

<h4>Résultat de votre simulation</h4>


<p>
Montant demandé :
<strong>${Number(montant).toLocaleString()} FCFA</strong>
</p>


<p>
Durée :
<strong>${duree} mois</strong>
</p>


<p>
Taux :
<strong>${taux}%</strong>
</p>


<p>
Mensualité estimée :
<strong>
${Math.round(mensualite).toLocaleString()} FCFA
</strong>
</p>


</div>

`;

}