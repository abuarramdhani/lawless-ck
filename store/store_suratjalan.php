<?php

// require_once __DIR__ . 'vendor/autoload.php';
// require_once "../vendor/autoload.php";
session_start();
if (!isset($_SESSION['email'])) {
    header("location:../index"); // jika belum login, maka dikembalikan ke index
    exit;
}
include "../vendor/autoload.php";
require '../include/fungsi.php';
include '../controller/c_detail_storebahan.php';
$nama_dokumen = 'Surat Jalan-' . $detail['No_form']; //Beri nama file PDF hasil.

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '../assets/fonts/',
    ]),
    'fontdata' => $fontData + [
        'mistral' => [
            'R' => 'MISTRAL.TTF',
        ]
    ],
]);
ob_start();

// var_dump($item_po);
// die;
//query mengambil data dari database


?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap');

        @font-face {
            font-family: 'mistral';
            /*memberikan nama bebas untuk font*/
            src: url('../assets/fonts/MISTRAL.TTF');
            /*memanggil file font eksternalnya di folder nexa*/
        }

        .indent {
            text-indent: 45px;
        }

        table.border-none,
        th.border-none,
        td.border-none {
            border: none !important;
        }

        .table-borderless td {
            border: 0 !important;
        }

        td.center {
            text-align: center;
        }

        .w-33 {
            width: 33.333%;
        }

        .w-50 {
            width: 50%;
        }

        .w-25 {
            width: 25%;
        }

        .w-100 {
            width: 100%;
        }

        .head {
            text-align: middle;
            margin-bottom: 10px;
        }

        .mistral {
            font-family: 'mistral';
            font-size: 38px;
            font-weight: bolder;
        }

        .height {
            height: 30px;
            display: block;
            /* background-color: aqua; */
        }

        .mt-100 {
            margin-top: 100px;
        }
    </style>
    <title>REPORT</title>
</head>

<body>
    <!-- 
    <table class="table table-borderless w-100 ">
        <tr>
            <td class=" w-25" style="vertical-align: top;"><img src="../assets/images/logo.png"></td>
            <td class="center w-50 mistral">LAWLESS BURGERBAR</td>
            <td class="center w-25" style="vertical-align: bottom;">PURCHASE ORDER</td>

        </tr>
    </table> -->

    <table class="mb-3 mt-100">
        <tr>
            <th>No Form</th>
            <td>: <?= $detail['No_form']; ?></td>
        </tr>
        <tr>
            <th>Supplier</th>
            <td>: <?= $detail['nama']; ?></td>
        </tr>
        <tr>
            <th>Date</th>
            <td>: <?= $detail['date']; ?></td>
        </tr>
        <tr>
            <th>Status</th>

            <td>: <span class="badge badge-success">KONFIRMASI</span></td>

        </tr>
    </table>





    <table class="table table-bordered border-none">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1 ?>

            <?php foreach ($item_storebahan as $item) : ?>
                <tr>
                    <td><?= $i++;  ?></td>
                    <td><?= $item['namabahan']; ?></td>
                    <td><?= $item['harga']; ?></td>
                    <td><?= $item['qty']  ?></td>
                    <td><?= $item['subtotal']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>

<?php

// $mpdf->SetHeader('<img src="img/logo.png" alt="" class="mb-3">|tengah|');

// $header = array(
//     'odd' => array(
//         'L' => array(
//             'content' => '<img src="../assets/images/logo.png">',
//         ), 'C' => array(
//             'content' => 'Lawless burger',
//             'font-size' => 10,
//             'font-style' => 'B',
//             'color' => '#000000'
//         ),
//         'R' => array(
//             'content' => 'PURCHASE ORDER',
//             'font-size' => 10,
//             // 'font-style' => 'B',
//             // 'font-family' => 'serif',
//             'color' => '#000000'
//         ),
//         'line' => 0,
//     ),
//     'even' => array()
// );
// $mpdf->SetHeader($header);
$mpdf->SetHTMLHeader('

<table class="table table-borderless w-100 ">
        <tr>
            <td class=" w-25" style="vertical-align: top;"><img src="../assets/images/logo.png"></td>
            <td class="center w-50 mistral">LAWLESS BURGERBAR</td>
            <td class="center w-25"  style="vertical-align: bottom;">SURAT JALAN</td>
            
        </tr>
    </table>
', 'O');
// $mpdf->SetHTMLHeader('<div style="border-bottom: 10px solid #000000;">My document</div>', 'E');

$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();

//ukuran A4
$mpdf->AddPage("P", "", "", "", "", "15", "15", "42", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
//Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
$mpdf->WriteHTML($html);
$mpdf->Output($nama_dokumen . ".pdf", 'I');
exit;
