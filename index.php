
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $semaine = $_POST["semaine"];
    $date = $_POST["date"];
    $heure = $_POST["heure"];
    $journee = $_POST["journee"];
    $adresse = $_POST["adresse"];
    $cp = $_POST["cp"];
    $ville = $_POST["ville"];
    $infossupp = $_POST["infossupp"];
    $tel = $_POST["tel"];
    

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

    $host = "localhost";
    $dbname = "commande_sambos";
    $username = "root";
    $password = "";
    
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

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    

        $stmt = $pdo->prepare("INSERT INTO commandes (
            semaine, date, heure, journee, adresse, cp, ville, infossupp, tel, 
            sv_pim_manta, sv_manta, sp_manta, sf_manta, sl_manta, nv_manta, nb_manta, np_manta, sv_pim_masaka, sv_masaka, sp_masaka, sf_masaka, sl_masaka, nv_masaka, nb_masaka, np_masaka, 
            mangue, gasy, museau, mb, sakay,total) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, 
            ?, ?, ?, ?, ?, ?, ?, ?, 
            ?, ?, ?, ?, ?, ?, ?, ?, 
            ?, ?, ?, ?, ?, ?)");
    
        $stmt->execute([
            $semaine, $date, $heure, $journee, $adresse, $cp, $ville, $infossupp, $tel, $sv_pim_manta, $sv_manta, $sp_manta, $sf_manta, $sl_manta, $nv_manta, $nb_manta, $np_manta, 
            $sv_pim_masaka, $sv_masaka, $sp_masaka, $sf_masaka, $sl_masaka, $nv_masaka, $nb_masaka, $np_masaka, 
            $mangue, $gasy, $museau, $mb, $sakay,$grand_total]);
    
        // Output success message or handle errors
        if ($stmt->rowCount() > 0) {
            echo "Data inserted successfully into the commandes table.";
        } else {
            echo "Error inserting data into the commandes table.";
        }
    
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

     

        <button type="submit">Envoyer</button>
    </form>

    <script src="script.js"></script>
</body>
</html>


<?php
// Initialize totals
$total_sv_pim_manta = 0;
$total_sv_manta = 0;
$total_sp_manta = 0;
$total_sf_manta = 0;
$total_sl_manta = 0;
$total_nv_manta = 0;
$total_nb_manta = 0;
$total_np_manta = 0;

$total_sv_pim_masaka = 0;
$total_sv_masaka = 0;
$total_sp_masaka = 0;
$total_sf_masaka = 0;
$total_sl_masaka = 0;
$total_nv_masaka = 0;
$total_nb_masaka = 0;
$total_np_masaka = 0;

$total_mangue = 0;
$total_gasy = 0;
$total_museau = 0;
$total_mb = 0;
$total_sakay = 0;

try {
    $host = "localhost";
    $dbname = "commande_sambos";
    $username = "root";
    $password = "";
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->query("SELECT * FROM commandes");
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Output the results (you might want to format this better in a real application)
    foreach ($rows as $row) {
    
?>
        <table>
            <p><?= $row['id']  ?></p>
            <!-- Ligne 1 -->
            <tr>
                <th colspan="3">
                    <label for="semaine">SEMAINE: <?= $row['semaine']  ?></label>
                
                </th>
                <th colspan="3">
                    <label for="date">Date: <?= $row['date']  ?></label>
          
                </th>

                <th colspan="3">
                    <label for="heure">Heure:<?= $row['heure']  ?></label>
            
                </th>
                <th colspan="3">
                    <label for="journee">Journee:<?= $row['journee']  ?></label>
             
                </th>
                <th colspan="2">TOTAL :  <?= $row['total']  ?></div> </th>
                      
            </tr>
            <!-- Ligne 2 -->
            <tr>
                <th colspan="10">
                    <label for="adresse">Adresse:<?= $row['adresse']  ?></label>
                </th>
                <th colspan="2">
                    <label for="cp">Code postale:<?= $row['cp']  ?></label>
                </th>
                <th colspan="2">
                    <label for="ville">Ville:<?= $row['ville']  ?></label>
        
                </th>
            </tr>
            <!-- Ligne 3 -->
            <tr>
                <td colspan="14">
                    <label style="float: left;" for="infossupp">Infos supplementaires:<?= $row['infossupp']  ?></label>
       
                </td>

            </tr>
            <!-- Ligne 4 -->
            <tr>
                <td colspan="6">
                    <label for="tel">Numero de tel:<?= $row['tel']  ?></label>
               
                </td>

            </tr>
            <!-- Ligne 5 -->
            <tr colspan="14">

                <td>MANTA</td>

                <td>
                    <?= $row['sv_pim_manta'] ?> SV PIM,
        
                </td>

                <td><?= $row['sv_manta']?> SV</td>
                <td><?= $row['sp_manta']?> SP</td>
                <td><?= $row['sf_manta']?> SF</td>
                <td><?= $row['sl_manta']?> SL</td>
                <td><?= $row['nv_manta']?> NV</td>
                <td><?= $row['nb_manta']?> NB</td>
                <td><?= $row['np_manta']?> NP</td>
                
                <td>LASARY MANGUE</td>
                <td>LASARY GASY</td>
                <td>SALADE DE MUSEAU</td>
                <td>MOFO BAOLINA</td>
                <td>SAKAY</td>




            </tr>
            <!-- Ligne 6 -->
            <tr colspan="14">

                <td>MASAKA</td>
                <td><?= $row['sv_pim_masaka'] ?></td>
                <td><?= $row['sv_masaka'] ?></td>
                <td><?= $row['sp_masaka'] ?></td>
                <td><?= $row['sf_masaka'] ?></td>
                <td><?= $row['sl_masaka'] ?></td>
                <td><?= $row['nv_masaka'] ?></td>
                <td><?= $row['nb_masaka'] ?></td>
                <td><?= $row['np_masaka'] ?></td>


                <td><?= $row['mangue'] ?></td>
                <td><?= $row['gasy'] ?></td>
                <td><?= $row['museau'] ?></td>

                <td><?= $row['mb'] ?></td>
                <td><?= $row['sakay'] ?></td>
            </tr>
        </table> 
<?php
    // Increment the totals
    $total_sv_pim_manta += $row['sv_pim_manta'];
    $total_sv_manta += $row['sv_manta'];
    $total_sp_manta += $row['sp_manta'];
    $total_sf_manta += $row['sf_manta'];
    $total_sl_manta += $row['sl_manta'];
    $total_nv_manta += $row['nv_manta'];
    $total_nb_manta += $row['nb_manta'];
    $total_np_manta += $row['np_manta'];

    $total_sv_pim_masaka += $row['sv_pim_masaka'];
    $total_sv_masaka += $row['sv_masaka'];
    $total_sp_masaka += $row['sp_masaka'];
    $total_sf_masaka += $row['sf_masaka'];
    $total_sl_masaka += $row['sl_masaka'];
    $total_nv_masaka += $row['nv_masaka'];
    $total_nb_masaka += $row['nb_masaka'];
    $total_np_masaka += $row['np_masaka'];

    $total_mangue += $row['mangue'];
    $total_gasy += $row['gasy'];
    $total_museau += $row['museau'];
    $total_mb += $row['mb'];
    $total_sakay += $row['sakay'];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<?php

// Output the totals
echo "<h1>TOTAL</h1>";
?>
<table>
    <tr colspan="14">
        <!-- ... Your existing HTML code ... -->
    </tr>
    <!-- Ligne 6 -->
    <tr colspan="14">
        <td>MANTA</td>
        <td>TOTAL <?= $total_sv_pim_manta ?> SV PIM,</td>
        <td>TOTAL <?= $total_sv_manta ?> SV</td>
        <td>TOTAL <?= $total_sp_manta ?> SP</td>
        <td>TOTAL <?= $total_sf_manta ?> SF</td>
        <td>TOTAL <?= $total_sl_manta ?> SL</td>
        <td>TOTAL <?= $total_nv_manta ?> NV</td>
        <td>TOTAL <?= $total_nb_manta ?> NB</td>
        <td>TOTAL <?= $total_np_manta ?> NP</td>

        <td>LASARY MANGUE</td>
        <td>LASARY GASY</td>
        <td>SALADE DE MUSEAU</td>
        <td>MOFO BAOLINA</td>
        <td>SAKAY</td>
    </tr>
    <!-- Ligne 6 -->
    <tr colspan="14">
        <td>MASAKA</td>
        <td>TOTAL <?= $total_sv_pim_masaka ?></td>
        <td>TOTAL <?= $total_sv_masaka ?></td>
        <td>TOTAL <?= $total_sp_masaka ?></td>
        <td>TOTAL <?= $total_sf_masaka ?></td>
        <td>TOTAL <?= $total_sl_masaka ?></td>
        <td>TOTAL <?= $total_nv_masaka ?></td>
        <td>TOTAL <?= $total_nb_masaka ?></td>
        <td>TOTAL <?= $total_np_masaka ?></td>

        <td>TOTAL <?= $total_mangue ?></td>
        <td>TOTAL <?= $total_gasy ?></td>
        <td>TOTAL <?= $total_museau ?></td>
        <td>TOTAL <?= $total_mb ?></td>
        <td>TOTAL <?= $total_sakay ?></td>
    </tr>
</table>
