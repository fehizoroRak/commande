<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<div class="navbar">
        <a style="border-right: 3px solid #fff;" href="index.php">Home</a>
        <a style="border-right: 3px solid #fff;" href="display.php">All Orders</a>
        
    
        <form action="" method="GET">
        <input type="text" name="search" placeholder="Rechercher...">
        <button type="submit">Rechercher</button>
    </form>
    
    </div>


        <!-- Filter Form -->
<form id="dateFilterForm">
    <label for="filterDate">Filter by Date:</label>
    <input type="date" id="filterDate" name="filterDate">
    <button type="button" onclick="filterOrders()">Apply Filter</button>
</form>

<div class="container">
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

    $totalAmount = 0;

    try {
        $host = "localhost";
        $dbname = "commande_sambos";
        $username = "root";
        $password = "";
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM commandes WHERE 
            semaine LIKE '%$searchKeyword%' OR 
            date LIKE '%$searchKeyword%' OR 
            heure LIKE '%$searchKeyword%' OR 
            journee LIKE '%$searchKeyword%' OR 
            adresse LIKE '%$searchKeyword%' OR 
            cp LIKE '%$searchKeyword%' OR 
            ville LIKE '%$searchKeyword%' OR 
            infossupp LIKE '%$searchKeyword%' OR 
            tel LIKE '%$searchKeyword%' OR 
            mangue LIKE '%$searchKeyword%' OR 
            gasy LIKE '%$searchKeyword%' OR 
            museau LIKE '%$searchKeyword%' OR 
            mb LIKE '%$searchKeyword%' OR 
            sakay LIKE '%$searchKeyword%'";
        $statement = $pdo->query($sql);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        function highlightSearchTerm($text, $searchTerm) {
            $lowerText = strtolower($text);
            $lowerSearchTerm = strtolower($searchTerm);
        
            $pos = stripos($lowerText, $lowerSearchTerm);
        
            if ($pos !== false) {
                $highlightedText = substr($text, 0, $pos);
                $highlightedText .= '<span style="background-color: yellow;">' . substr($text, $pos, strlen($searchTerm)) . '</span>';
                $highlightedText .= substr($text, $pos + strlen($searchTerm));
                return $highlightedText;
            }
        
            return $text;
        }
        
        
        
        
        $counter = 0;

        // Output the results (you might want to format this better in a real application)
        foreach ($rows as $row) {

     $counter++
  
    ?>
    <p style="font-size:25px; font-weight:bolder;color:blue;"><?php echo $counter; ?> </p>
<p><?= $row['id']  ?></p>


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
            <?= highlightSearchTerm($row['adresse'], $searchKeyword)  ?> , <?= highlightSearchTerm($row['cp'], $searchKeyword)  ?> ,  <?= highlightSearchTerm($row['ville'], $searchKeyword)   ?>
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

<a href="edit.php?id=<?= $row['id']; ?>">Edit Record</a>



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

            $totalAmount += $row['total'];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>


<h1 style="text-align: center;">TOTAL</h1>
<table>

    <!-- Ligne 6 -->
    <tr colspan="14" style="background-color: #a7ffa7;font-size:20px; font-weight:bold;">
        <td>MANTA</td>
        <td><?= $total_sv_pim_manta ?> SV PIM,</td>
        <td><?= $total_sv_manta ?> SV</td>
        <td><?= $total_sp_manta ?> SP</td>
        <td> <?= $total_sf_manta ?> SF</td>
        <td><?= $total_sl_manta ?> SL</td>
        <td> <?= $total_nv_manta ?> NV</td>
        <td> <?= $total_nb_manta ?> NB</td>
        <td> <?= $total_np_manta ?> NP</td>

        <td>LASARY MANGUE</td>
        <td>LASARY GASY</td>
        <td>SALADE DE MUSEAU</td>
        <td>MOFO BAOLINA</td>
        <td>SAKAY</td>
    </tr>
    <!-- Ligne 6 -->
    <tr colspan="14" style="background-color: #a7ffa7;font-size:20px; font-weight:bold;">
        <td>MASAKA</td>
        <td><?= $total_sv_pim_masaka ?></td>
        <td> <?= $total_sv_masaka ?></td>
        <td> <?= $total_sp_masaka ?></td>
        <td> <?= $total_sf_masaka ?></td>
        <td> <?= $total_sl_masaka ?></td>
        <td> <?= $total_nv_masaka ?></td>
        <td> <?= $total_nb_masaka ?></td>
        <td> <?= $total_np_masaka ?></td>

        <td> <?= $total_mangue ?></td>
        <td> <?= $total_gasy ?></td>
        <td> <?= $total_museau ?></td>
        <td> <?= $total_mb ?></td>
        <td> <?= $total_sakay ?></td>
    </tr>

    <tr colspan="14" style="background-color: orange;font-size:20px; font-weight:bold;">
        <td>GRAND TOTAL</td>
        <td><?= $total_sv_pim_masaka + $total_sv_pim_manta  ?></td>
        <td> <?= $total_sv_masaka + $total_sv_manta ?></td>
        <td> <?= $total_sp_masaka + $total_sp_manta ?></td>
        <td> <?= $total_sf_masaka + $total_sf_manta ?></td>
        <td> <?= $total_sl_masaka + $total_sl_manta ?></td>
        <td> <?= $total_nv_masaka + $total_nv_manta ?></td>
        <td> <?= $total_nb_masaka + $total_nb_manta ?></td>
        <td> <?= $total_np_masaka + $total_np_manta ?></td>

        <td> <?= $total_mangue ?></td>
        <td> <?= $total_gasy ?></td>
        <td> <?= $total_museau ?></td>
        <td> <?= $total_mb ?></td>
        <td> <?= $total_sakay ?></td>
    </tr>

    <tr>
        <td colspan="14" style="background-color: green;font-size:30px; font-weight:bold;">
            TOTAL (€): <?php echo  $totalAmount ?>
        </td>

    </tr>
</table>
</div>















<!-- JavaScript for filtering orders -->
<script>
    function filterOrders() {
        // Get the selected date from the input field
        var selectedDate = $("#filterDate").val();

        // Make an AJAX request to fetch filtered orders
        $.ajax({
            type: "POST",
            url: "filter_orders.php", // Replace with the actual file handling the filter logic
            data: { selectedDate: selectedDate },
            success: function (data) {
                // Update the orders container with the filtered content
                $(".container").html(data);
            }
        });
    }
</script>