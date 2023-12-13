
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from $_POST
    $semaine = $_POST["semaine"];
    $date = $_POST["date"];
    $heure = $_POST["heure"];
    $journee = $_POST["journee"];
    $adresse = $_POST["adresse"];
    $cp = $_POST["cp"];
    $ville = $_POST["ville"];
    $infossupp = $_POST["infossupp"];
    $tel = $_POST["tel"];
    
    // Retrieve values from the table
    $sv_pim_manta = $_POST["sv_pim_manta"];
    $sv_manta = $_POST["sv_manta"];
    $sp_manta = $_POST["sp_manta"];
    $sf_manta = $_POST["sf_manta"];
    $sl_manta = $_POST["sl_manta"];
    $nv_manta = $_POST["nv_manta"];
    $nb_manta = $_POST["nb_manta"];
    $np_manta = $_POST["np_manta"];
    
    $sv_pim_masaka = $_POST["sv_pim_masaka"];
    $sv_masaka = $_POST["sv_masaka"];
    $sp_masaka = $_POST["sp_masaka"];
    $sf_masaka = $_POST["sf_masaka"];
    $sl_masaka = $_POST["sl_masaka"];
    $nv_masaka = $_POST["nv_masaka"];
    $nb_masaka = $_POST["nb_masaka"];
    $np_masaka = $_POST["np_masaka"];
    
    $mangue = $_POST["mangue"];
    $gasy = $_POST["gasy"];
    $museau = $_POST["museau"];
    $mb = $_POST["mb"];
    $sakay = $_POST["sakay"];

    // Do something with the retrieved data, e.g., store it in a database
    // ...

    // You can also echo or print the values for testing purposes
    echo "Semaine: $semaine<br>";
    echo "Date: $date<br>";
    echo "Heure: $heure<br>";
    echo "Journee: $journee<br>";
    echo "Adresse: $adresse<br>";
    echo "Code Postale: $cp<br>";
    echo "Ville: $ville<br>";
    echo "Infos supplementaires: $infossupp<br>";
    echo "Numero de tel: $tel<br>";
    
    echo "SV PIM Manta: $sv_pim_manta<br>";
    echo "SV Manta: $sv_manta<br>";
    echo "SP Manta: $sp_manta<br>";
    echo "SF Manta: $sf_manta<br>";
    echo "SL Manta: $sl_manta<br>";
    echo "NV Manta: $nv_manta<br>";
    echo "NB Manta: $nb_manta<br>";
    echo "NP Manta: $np_manta<br>";

    echo "SV PIM Masaka: $sv_pim_masaka<br>";
    echo "SV Masaka: $sv_masaka<br>";
    echo "SP Masaka: $sp_masaka<br>";
    echo "SF Masaka: $sf_masaka<br>";
    echo "SL Masaka: $sl_masaka<br>";
    echo "NV Masaka: $nv_masaka<br>";
    echo "NB Masaka: $nb_masaka<br>";
    echo "NP Masaka: $np_masaka<br>";

    echo "Mangue: $mangue<br>";
    echo "Gasy: $gasy<br>";
    echo "Museau: $museau<br>";
    echo "MB: $mb<br>";
    echo "Sakay: $sakay<br>";


        // Calcul du total pour les produits _manta
        $total_manta = (
            (float)$_POST["sv_pim_manta"] + (float)$_POST["sv_manta"] +
            (float)$_POST["sp_manta"] + (float)$_POST["sf_manta"] +
            (float)$_POST["sl_manta"] + (float)$_POST["nv_manta"] +
            (float)$_POST["nb_manta"] + (float)$_POST["np_manta"]
        ) * 0.40;
    
        // Calcul du total pour les produits _masaka
        $total_masaka = (
            (float)$_POST["sv_pim_masaka"] + (float)$_POST["sv_masaka"] +
            (float)$_POST["sp_masaka"] + (float)$_POST["sf_masaka"] +
            (float)$_POST["sl_masaka"] + (float)$_POST["nv_masaka"] +
            (float)$_POST["nb_masaka"] + (float)$_POST["np_masaka"]
        ) * 0.50;
    
        // Calcul du total pour les autres produits
        $total_mangue = (float)$_POST["mangue"] * 12;
        $total_gasy = (float)$_POST["gasy"] * 12;
        $total_museau = (float)$_POST["museau"] * 12;
        $total_mb = (float)$_POST["mb"] * 0.50;
        $total_sakay = (float)$_POST["sakay"] * 5;
    
        // Calcul du grand total
        $grand_total = $total_manta + $total_masaka + $total_mangue + $total_gasy + $total_museau + $total_mb + $total_sakay;
    
        // Afficher le grand total
        echo "Grand Total: $grand_total euros";
  


}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau HTML</title>
    <style>
        table {
            border-collapse: separate;
            border-spacing: 4px;
            width: 100%;
            margin-top: 80px;
           
        }

        table,
        th,
        td {
        
            border: 1px solid black;
          
        }

        td input[type="number"] {
            width: 60px;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            
        }
 

        th {
            background-color: #f2f2f2;
        }

        button {
            margin: 50px 700px;
            width: 300px;
            height: 40px;
            background-color: #4caf50;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <form id="myForm" action="" method="POST">
        <table>
            <!-- Ligne 1 -->
            <tr>
                <th colspan="6">
                    <label for="semaine">SEMAINE:</label>
                    <input type="week" id="semaine" name="semaine">
                </th>
                <th colspan="4">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date">
                </th>

                <th colspan="4">
                    <label for="heure">Heure:</label>
                    <input type="time" id="heure" name="heure">
                </th>
                <th colspan="4">
                    <label for="journee">Journee:</label>
                    <select name="journee" id="journee">
                        <option value="">----</option>
                        <option value="MATIN">MATIN</option>
                        <option value="APRES MIDI">APRES MIDI</option>
                        <option value="SOIR">SOIR</option>
                    </select>
                </th>
                <th colspan="4">TOTAL :  <div id="grandTotal"></div> </th>
                      
            </tr>
            <!-- Ligne 2 -->
            <tr>
                <th colspan="10">
                    <label for="adresse">Adresse:</label>
                    <input type="text" id="adresse" name="adresse">
                </th>
                <th colspan="5">
                    <label for="cp">Code postale:</label>
                    <input type="text" id="cp" name="cp">
                </th>
                <th colspan="7">
                    <label for="ville">Ville:</label>
                    <input type="text" id="ville" name="ville">
                </th>
            </tr>
            <!-- Ligne 3 -->
            <tr>
                <td colspan="22">
                    <label style="float: left;" for="infossupp">Infos supplementaires:</label>
                    <input style="float: left;" type="text" id="infossupp" name="infossupp">
                </td>

            </tr>
            <!-- Ligne 4 -->
            <tr>
                <td colspan="6">
                    <label for="tel">Numero de tel:</label>
                    <input type="tel" id="tel" name="tel">
                </td>

            </tr>
            <!-- Ligne 5 -->
            <tr colspan="22">

                <td>MANTA</td>

                <td><input type="number" name="sv_pim_manta"></td>
                <td rowspan="2">SV PIM</td>

                <td><input type="number" name="sv_manta"></td>
                <td rowspan="2">SV</td>

                <td><input type="number" name="sp_manta"></td>
                <td rowspan="2">SP</td>

                <td><input type="number" name="sf_manta"></td>
                <td rowspan="2">SF</td>

                <td><input type="number" name="sl_manta"></td>
                <td rowspan="2">SL</td>

                <td><input type="number" name="nv_manta"></td>
                <td rowspan="2">NV</td>

                <td><input type="number" name="nb_manta"></td>
                <td rowspan="2">NB</td>

                <td><input type="number" name="np_manta"></td>
                <td rowspan="2">NP</td>

                <td>LASARY MANGUE</td>
                <td>LASARY GASY</td>
                <td>SALADE DE MUSEAU</td>
                <td>MOFO BAOLINA</td>
                <td>SAKAY</td>




            </tr>
            <!-- Ligne 6 -->
            <tr colspan="22">

                <td>MASAKA</td>

                <td><input type="number" name="sv_pim_masaka"></td>
                <td><input type="number" name="sv_masaka"></td>
                <td><input type="number" name="sp_masaka"></td>
                <td><input type="number" name="sf_masaka"></td>
                <td><input type="number" name="sl_masaka"></td>
                <td><input type="number" name="nv_masaka"></td>
                <td><input type="number" name="nb_masaka"></td>
                <td><input type="number" name="np_masaka"></td>

                <td><input type="number" name="mangue"></td>
                <td><input type="number" name="gasy"></td>
                <td><input type="number" name="museau"></td>

                <td><input type="number" name="mb"></td>
                <td><input type="number" name="sakay"></td>
            </tr>
        </table>

        <script>
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
        </script>

  



        <button type="submit">Envoyer</button>
    </form>
</body>



</html>

