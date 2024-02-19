<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau HTML</title>
    <link rel="stylesheet" href="style.css">

</head>
<div class="navbar">
    <a style="border-right: 3px solid #fff;" href="index.php">Home</a>
    <a style="border-right: 3px solid #fff;" href="display.php">All Orders</a>
    <a style="border-right: 3px solid #fff;" href="semaine50.php">Semaine 11 au 17 DEC</a>
    <a style="border-right: 3px solid #fff;" href="semaine51.php">Semaine 18 au 24 DEC</a>
    <a style="border-right: 3px solid #fff;" href="semaine52.php">Semaine 25 au 31 DEC</a>
</div>


<?php

// Database configuration
$host = "localhost";
$dbname = "commande_sambos";
$username = "root";
$password = "";

// // Unique identifier for the record to be edited
//  if (!isset($_GET['id']) || empty($_GET['id'])) {
//     die("Invalid request. Please provide a valid ID.");
//  }




if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

        echo $grand_total;



    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

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
    $id = $_POST['id'];
    //$grand_total = $_POST['total'];

    $statement = $pdo->prepare("UPDATE commandes SET
semaine = ?,
date = ?,
heure = ?,
journee = ?,
adresse = ?,
cp = ?,
ville = ?,
infossupp = ?,
tel = ?,
sv_pim_manta = ?,
sv_manta = ?,
sp_manta = ?,
sf_manta = ?,
sl_manta = ?,
nv_manta = ?,
nb_manta = ?,
np_manta = ?,
sv_pim_masaka = ?,
sv_masaka = ?,
sp_masaka = ?,
sf_masaka = ?,
sl_masaka = ?,
nv_masaka = ?,
nb_masaka = ?,
np_masaka = ?,
mangue = ?,
gasy = ?,
museau = ?,
mb = ?,
sakay = ?,
total = ?
WHERE id = ?");

    $statement->execute([
        $semaine, $date, $heure, $journee, $adresse, $cp, $ville, $infossupp, $tel,
        $sv_pim_manta, $sv_manta, $sp_manta, $sf_manta, $sl_manta, $nv_manta, $nb_manta, $np_manta,
        $sv_pim_masaka, $sv_masaka, $sp_masaka, $sf_masaka, $sl_masaka, $nv_masaka, $nb_masaka, $np_masaka,
        $mangue, $gasy, $museau, $mb, $sakay, $grand_total,
        $id
    ]);

    // Output success message or handle errors
    if ($statement->rowCount() > 0) {
        echo '<p id="successMessage" style="color:green; background-color:#a7ffa7; width:500px; height:50px;margin:20px auto;text-align:center; font-size:20px; font-weight:bold; line-height:50px;">COMMANDE BIEN MISE A JOUR !</p>';
    }
}  

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    var_dump($id);

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    // Fetch the existing record to be edited
    $stmt = $pdo->prepare("SELECT * FROM commandes WHERE id = ?");
    $stmt->execute([$id]);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$records) {
        die("Record not found with the provided ID.");
    }


foreach ($records as $record) {

?>





    <form id="myForm" style="display: flex; flex-direction:column; align-items:center;margin:0 40px;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <table>
            <!-- Ligne 1 -->
            <tr>
                <input type="hidden" name="id" value="<?= $record['id']; ?>">

                <th colspan="4">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" value="<?= $record['date']; ?>" required>
                </th>
                <th colspan="6">
                    <label for="semaine">SEMAINE:</label>
                    <input type="number" id="semaine" name="semaine" value="<?= $record['semaine']; ?>" required>
                </th>


                <th colspan="4">
                    <label for="heure">Heure:</label>
                    <input type="time" id="heure" name="heure" value="<?= $record['heure']; ?>">
                </th>
                <th colspan="4">
                    <label for="journee">Journee:</label>
                    <select name="journee" id="journee">
                        <option value="">----</option>
                        <option value="MATIN" <?= ($record['journee'] === 'MATIN') ? 'selected' : '' ?>>MATIN</option>
                        <option value="APRES MIDI" <?= ($record['journee'] === 'APRES MIDI') ? 'selected' : '' ?>>APRES MIDI</option>
                        <option value="SOIR" <?= ($record['journee'] === 'SOIR') ? 'selected' : '' ?>>SOIR</option>
                    </select>

                </th>
                <th colspan="4" style="background-color: #a7ffa7;">TOTAL :
                    <input type="number" id="total" name="total"  value="<?php echo $grand_total ?>" step="0.01"><?= $record['total'] ?>
                    <div id="grandTotal"></div>
                </th>

            </tr>
            <!-- Ligne 2 -->
            <tr>
                <th colspan="10">
                    <label for="adresse">Adresse:</label>
                    <input type="text" id="adresse" name="adresse" value="<?= $record['adresse']; ?>" required>
                </th>
                <th colspan="5">
                    <label for="cp">Code postale:</label>
                    <input type="text" id="cp" name="cp" value="<?= $record['cp']; ?>">
                </th>
                <th colspan="7">
                    <label for="ville">Ville:</label>
                    <input type="text" id="ville" name="ville" value="<?= $record['ville']; ?>">
                </th>
            </tr>
            <!-- Ligne 3 -->
            <tr>
                <td colspan="22">
                    <label style="float: left;" for="infossupp">Infos supplementaires:</label>
                    <input style="float: left;" type="text" id="infossupp" name="infossupp" value="<?= $record['infossupp']; ?>">
                </td>

            </tr>
            <!-- Ligne 4 -->
            <tr>
                <td colspan="6">
                    <label for="tel">Numero de tel:</label>
                    <input type="tel" id="tel" name="tel" value="<?= $record['tel']; ?>" required>
                </td>

            </tr>
            <!-- Ligne 5 -->
            <tr colspan="22">

                <td class="manta">MANTA</td>

                <td class="manta"><input type="number" name="sv_pim_manta" value="<?= $record['sv_pim_manta']; ?>"></td>
                <td rowspan="2">SV PIM</td>

                <td class="manta"><input type="number" name="sv_manta" value="<?= $record['sv_manta']; ?>"></td>
                <td rowspan="2">SV</td>

                <td class="manta"><input type="number" name="sp_manta" value="<?= $record['sp_manta']; ?>"></td>
                <td rowspan="2">SP</td>

                <td class="manta"><input type="number" name="sf_manta" value="<?= $record['sf_manta']; ?>"></td>
                <td rowspan="2">SF</td>

                <td class="manta"><input type="number" name="sl_manta" value="<?= $record['sl_manta']; ?>"></td>
                <td rowspan="2">SL</td>

                <td class="manta"><input type="number" name="nv_manta" value="<?= $record['nv_manta']; ?>"></td>
                <td rowspan="2">NV</td>

                <td class="manta"><input type="number" name="nb_manta" value="<?= $record['nb_manta']; ?>"></td>
                <td rowspan="2">NB</td>

                <td class="manta"><input type="number" name="np_manta" value="<?= $record['np_manta']; ?>"></td>
                <td rowspan="2">NP</td>

                <td style="background-color: yellow; font-weight:bold;">LASARY MANGUE</td>
                <td style="background-color: orange;font-weight:bold;">LASARY GASY</td>
                <td style="background-color: green;font-weight:bold;">SALADE DE MUSEAU</td>
                <td style="background-color: brown;font-weight:bold;">MOFO BAOLINA</td>
                <td style="background-color: purple;font-weight:bold;">SAKAY</td>




            </tr>
            <!-- Ligne 6 -->
            <tr colspan="22">

                <td class="masaka">MASAKA</td>

                <td class="masaka"><input style="width: 100px;" type="number" name="sv_pim_masaka" value="<?= $record['sv_pim_masaka']; ?>"></td>
                <td class="masaka"><input type="number" name="sv_masaka" value="<?= $record['sv_masaka']; ?>"></td>
                <td class="masaka"><input type="number" name="sp_masaka" value="<?= $record['sp_masaka']; ?>"></td>
                <td class="masaka"><input type="number" name="sf_masaka" value="<?= $record['sf_masaka']; ?>"></td>
                <td class="masaka"><input type="number" name="sl_masaka" value="<?= $record['sl_masaka']; ?>"></td>
                <td class="masaka"><input type="number" name="nv_masaka" value="<?= $record['nv_masaka']; ?>"></td>
                <td class="masaka"><input type="number" name="nb_masaka" value="<?= $record['nb_masaka']; ?>"></td>
                <td class="masaka"><input type="number" name="np_masaka" value="<?= $record['np_masaka']; ?>"></td>

                <td style="background-color: yellow; font-weight:bold;"><input type="number" name="mangue" step="0.01" value="<?= $record['mangue']; ?>"></td>
                <td style="background-color: orange;font-weight:bold;"><input type="number" name="gasy" step="0.01" value="<?= $record['gasy']; ?>"></td>
                <td style="background-color: green;font-weight:bold;"><input type="number" name="museau" step="0.01" value="<?= $record['museau']; ?>"></td>

                <td style="background-color: brown;font-weight:bold;"><input type="number" name="mb" value="<?= $record['mb']; ?>"></td>
                <td style="background-color: purple;font-weight:bold;"><input type="number" name="sakay" value="<?= $record['sakay']; ?>"></td>
            </tr>
        </table>
        <button type="submit" name="inserer">MODIFIER</button>
    </form>



<?php
}
}
?>

<script src="script.js"></script>