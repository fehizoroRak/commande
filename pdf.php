<?php
session_start();
require 'dompdf/autoload.inc.php';




// Récupérer le contenu HTML depuis la session
$html = isset($_SESSION['html_content']) ? $_SESSION['html_content'] : '';

// Instancier Dompdf
// $options = new Options();
// $options->set('isHtml5ParserEnabled', true);
// $options->set('isPhpEnabled', true);
// $dompdf = new Dompdf($options);

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();






