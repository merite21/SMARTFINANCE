function calculerPret(){


let montant = document.getElementById("montant").value;

let duree = document.getElementById("duree").value;


if(!montant || montant <= 0){
    document.getElementById("resultat").innerHTML = "";
    return;
}


// taux annuel

let taux = 10;


// conversion

let interet = (montant * taux * duree) / (100 * 12);


let total = Number(montant) + Number(interet);


let mensualite = total / duree;


let i18n = window.i18nSimulateur || {
    resultatTitre: "Résultat de votre simulation",
    montant: "Montant demandé :",
    duree: "Durée :",
    taux: "Taux :",
    mensualite: "Mensualité estimée :",
    mois: "mois"
};


document.getElementById("resultat").innerHTML = `

<div class="alert alert-success">

<h4>${i18n.resultatTitre}</h4>


<p>
${i18n.montant}
<strong>${Number(montant).toLocaleString()} FCFA</strong>
</p>


<p>
${i18n.duree}
<strong>${duree} ${i18n.mois}</strong>
</p>


<p>
${i18n.taux}
<strong>${taux}%</strong>
</p>


<p>
${i18n.mensualite}
<strong>
${Math.round(mensualite).toLocaleString()} FCFA
</strong>
</p>


</div>

`;

}


document.addEventListener("DOMContentLoaded", function(){

    const champMontant = document.getElementById("montant");
    const champDuree = document.getElementById("duree");

    if(champMontant && champDuree){
        champMontant.addEventListener("input", calculerPret);
        champDuree.addEventListener("change", calculerPret);
    }

});
