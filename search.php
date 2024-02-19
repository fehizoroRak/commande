<?php
// Connexion à la base de données (utilisez vos informations de connexion)
$host = "localhost";
$dbname = "commande_sambos";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    die();
}

// Récupérer le terme de recherche depuis l'URL
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Requête SQL pour récupérer les résultats de la recherche
$sql = "SELECT * FROM commandes WHERE
        semaine LIKE :searchTerm OR
        date LIKE :searchTerm OR
        heure LIKE :searchTerm OR
        journee LIKE :searchTerm OR
        adresse LIKE :searchTerm OR
        cp LIKE :searchTerm OR
        ville LIKE :searchTerm OR
        tel LIKE :searchTerm OR
        infossupp LIKE :searchTerm OR
        total LIKE :searchTerm";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Affichage des résultats de la recherche -->
<div class="container">
    <?php
    if (count($rows) > 0) {
        foreach ($rows as $row) {
            ?>
            <table>
              
            <!-- Ligne 1 -->
            <tr>
                <th colspan="2">
                    <label for="semaine">SEMAINE: <?= $row['semaine']  ?></label>

                </th>
                <th colspan="4" style="background-color:#ffa0a0;">
                    <?php
// Création d'un objet DateTime à partir de la date de la base de données
$dateObj = DateTime::createFromFormat('Y-m-d',  $row['date']);

$dateConvertie = $dateObj->format('l j F Y');
//echo $dateConvertie;

$daysEnglish = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
$daysFrench = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

$monthsEnglish = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
$monthsFrench = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

// Remplacement des jours et des mois en anglais par leurs équivalents en français
$dateConvertie = str_replace($daysEnglish, $daysFrench, $dateConvertie);
$dateConvertie = str_replace($monthsEnglish, $monthsFrench, $dateConvertie);


    ?>
                    <p style="font-size: 20px;  font-weight:bold; text-transform:uppercase;" for="date">DATE: <?= $dateConvertie  ?></p>

                </th>

                <th colspan="2">
                    <label for="heure">Heure:<?= $row['heure']  ?></label>

                </th>

                <th colspan="2">
                    <label for="journee"><?= $row['journee']  ?></label>
                </th>

                <th colspan="4" style="background-color: #a7ffa7; font-size:24px;">TOTAL : <?= $row['total']  ?> €</th>
</div>


</tr>
<!-- Ligne 2 -->
<tr>
<th colspan="14">
    <p for="adresse" style="text-align: left;">
        <?= $row['adresse']  ?> , <?= $row['cp']  ?> , <?= $row['ville']  ?>
    </p>
</th>

</tr>
<!-- Ligne 3 -->

<tr>
<?php
        if (!empty($row['infossupp'])) {
?>
    <td colspan="14">
        <label style="float: left;" for="infossupp"> <?= $row['infossupp']  ?></label>
    </td>
<?php
        }
?>

</tr>
<!-- Ligne 4 -->
<tr>
<td colspan="2">
    <label for="tel">Numero de tel:<?= $row['tel']  ?></label>

</td>

</tr>
<!-- Ligne 5 -->
<tr>

<td class="manta">MANTA</td>

<?php
        if (!empty($row['sv_pim_manta'])) {
?>
    <td class="manta">
        <?= $row['sv_pim_manta'] ?> SV PIM
    </td>
<?php
        }
?>

<?php
        if (!empty($row['sv_manta'])) {
?>
    <td class="manta">
        <?= $row['sv_manta'] ?> SV
    </td>
<?php
        }



?>

<?php
        if (!empty($row['sp_manta'])) {
?>
    <td class="manta">
        <?= $row['sp_manta'] ?> SP
    </td>
<?php
        }
?>

<?php
        if (!empty($row['sf_manta'])) {
?>
    <td class="manta">
        <?= $row['sf_manta'] ?> SF
    </td>
<?php
        }
?>

<?php
        if (!empty($row['sl_manta'])) {
?>
    <td class="manta">
        <?= $row['sl_manta'] ?> SL
    </td>
<?php
        }
?>


<?php
        if (!empty($row['nv_manta'])) {
?>
    <td class="manta">
        <?= $row['nv_manta'] ?> NV
    </td>
<?php
        }
?>
<?php
        if (!empty($row['nb_manta'])) {
?>
    <td class="manta">
        <?= $row['nb_manta'] ?> NB
    </td>
<?php
        }
?>
<?php
        if (!empty($row['np_manta'])) {
?>
    <td class="manta">
        <?= $row['np_manta'] ?> NP
    </td>
<?php
        }
?>

<?php
        if (!empty($row['mangue'])) {
?>
    <td style="background-color: yellow; font-weight:bold;">LASARY MANGUE :<?= $row['mangue'] ?> kg</td>
<?php
        }
?>

<?php
        if (!empty($row['gasy'])) {
?>
    <td style="background-color: orange;font-weight:bold;">LASARY GASY : <?= $row['gasy'] ?> kg</td>
<?php
        }
?>
<?php
        if (!empty($row['museau'])) {
?>
    <td style="background-color: green;font-weight:bold;">SALADE DE MUSEAU : <?= $row['museau'] ?> kg</td>
<?php
        }
?>

<?php
        if (!empty($row['mb'])) {
?>
    <td style="background-color: brown;font-weight:bold;">MOFO BAOLINA : <?= $row['mb'] ?></td>
<?php
        }
?>

<?php
        if (!empty($row['sakay'])) {
?>
    <td style="background-color: purple;font-weight:bold;">SAKAY : <?= $row['sakay'] ?></td>
<?php
        }
?>
</tr>
<!-- Ligne 6 -->
<tr colspan="14">


<td class="masaka">MASAKA</td>



<?php
        if (!empty($row['sv_pim_masaka'])) {
?>
    <td class="masaka">
        <?= $row['sv_pim_masaka'] ?> SV PIM
    </td>
<?php
        }
?>

<?php
        if (!empty($row['sv_masaka'])) {
?>
    <td class="masaka">
        <?= $row['sv_masaka'] ?> SV
    </td>
<?php
        }
?>

<?php
        if (!empty($row['sp_masaka'])) {
?>
    <td class="masaka">
        <?= $row['sp_masaka'] ?> SP
    </td>
<?php
        }
?>

<?php
        if (!empty($row['sf_masaka'])) {
?>
    <td class="masaka">
        <?= $row['sf_masaka'] ?> SF
    </td>
<?php
        }
?>

<?php
        if (!empty($row['sl_masaka'])) {
?>
    <td class="masaka">
        <?= $row['sl_masaka'] ?> SL
    </td>
<?php
        }
?>

<?php
        if (!empty($row['nv_masaka'])) {
?>
    <td class="masaka">
        <?= $row['nv_masaka'] ?> NV
    </td>
<?php
        }
?>

<?php
        if (!empty($row['nb_masaka'])) {
?>
    <td class="masaka">
        <?= $row['nb_masaka'] ?> NB
    </td>
<?php
        }
?>

<?php
        if (!empty($row['np_masaka'])) {
?>
    <td class="masaka">
        <?= $row['np_masaka'] ?> NP
    </td>
<?php
        }
?>

</tr>
</table>

<?php
        }
    } else {
        echo "<p>Aucun résultat trouvé.</p>";
    }
?>
</div>
