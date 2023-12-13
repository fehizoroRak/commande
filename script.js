
// Fonction pour calculer et afficher le total
function updateTotal() {
  
// Retrieve the values of the input fields
var sv_pim_manta = parseFloat(document.getElementsByName("sv_pim_manta")[0].value) || 0;
var sv_manta = parseFloat(document.getElementsByName("sv_manta")[0].value) || 0;
var sp_manta = parseFloat(document.getElementsByName("sp_manta")[0].value) || 0;
var sf_manta = parseFloat(document.getElementsByName("sf_manta")[0].value) || 0;

// Repeat the process for _manta - additional fields
var sl_manta = parseFloat(document.getElementsByName("sl_manta")[0].value) || 0;
var nv_manta = parseFloat(document.getElementsByName("nv_manta")[0].value) || 0;
var nb_manta = parseFloat(document.getElementsByName("nb_manta")[0].value) || 0;
var np_manta = parseFloat(document.getElementsByName("np_manta")[0].value) || 0;

// Repeat the process for _masaka - additional fields
var sv_pim_masaka = parseFloat(document.getElementsByName("sv_pim_masaka")[0].value) || 0;
var sv_masaka = parseFloat(document.getElementsByName("sv_masaka")[0].value) || 0;
var sp_masaka = parseFloat(document.getElementsByName("sp_masaka")[0].value) || 0;
var sf_masaka = parseFloat(document.getElementsByName("sf_masaka")[0].value) || 0;
var sl_masaka = parseFloat(document.getElementsByName("sl_masaka")[0].value) || 0;
var nv_masaka = parseFloat(document.getElementsByName("nv_masaka")[0].value) || 0;
var nb_masaka = parseFloat(document.getElementsByName("nb_masaka")[0].value) || 0;
var np_masaka = parseFloat(document.getElementsByName("np_masaka")[0].value) || 0;

// Repeat the process for other input fields
var mangue = parseFloat(document.getElementsByName("mangue")[0].value) || 0;
var gasy = parseFloat(document.getElementsByName("gasy")[0].value) || 0;
var museau = parseFloat(document.getElementsByName("museau")[0].value) || 0;
var mb = parseFloat(document.getElementsByName("mb")[0].value) || 0;
var sakay = parseFloat(document.getElementsByName("sakay")[0].value) || 0;

    // Calculer le total pour _manta
    var totalManta = (sv_pim_manta + sv_manta + sp_manta + sf_manta + sl_manta + nv_manta + nb_manta + np_manta) * 0.40;

    // Répétez le processus pour _masaka et les autres produits
    var totalMasaka = (sv_pim_masaka + sv_masaka + sp_masaka + sf_masaka + sl_masaka + nv_masaka + nb_masaka + np_masaka) * 0.50;
    // Calculer le grand total
    var grandTotal = totalManta + totalMasaka + (mangue * 12) + (gasy * 12) + (museau * 12) + (mb * 0.50) + (sakay * 5);
// Update the display of the total
document.getElementById("grandTotal").innerText =  grandTotal.toFixed(2) + " EUROS";
}

// Add event listeners on input fields
var inputs = document.querySelectorAll('input[type="number"]');
inputs.forEach(function (input) {
input.addEventListener('input', updateTotal);
});
