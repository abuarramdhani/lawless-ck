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
$nama_dokumen = 'Report'; //Beri nama file PDF hasil.

$mpdf = new \Mpdf\Mpdf();
ob_start();
include '../controller/c_detail_storebahan.php'

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
    </style>
    <title>REPORT</title>
</head>

<body class="">
    <table class="mb-3">
        <tr>
            <th>No Form</th>
            <td>: <?= $detail['No_form']; ?></td>
        </tr>
        <tr>
            <th>Outlet</th>
            <td>: <?= $detail['nama']; ?></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>: <?= $detail['date']; ?></td>
        </tr>

        <tr>
            <th>Status</th>
            <?php if ($detail['status_ck'] == 1) : ?>
                <td>: <span class="badge badge-success">KONFIRMASI</span></td>
            <?php else : ?>
                <td>: <span class="badge badge-warning">:Belum di Konfirmasi</span></td>
            <?php endif; ?>
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

$header = array(
    'odd' => array(
        'L' => array(
            'content' => '<img src="../assets/images/logo.png">',
        ), 'C' => array(
            'content' => 'Lawless Burger',
            'font-size' => 17,
            'font-style' => 'B',
            'color' => '#000000'
        ),
        'R' => array(
            'content' => 'PURCHASE ORDER',
            'font-size' => 10,
            // 'font-style' => 'B',
            // 'font-family' => 'serif',
            'color' => '#000000'
        ),
        'line' => 0,
    ),
    'even' => array()
);
$mpdf->SetHeader($header);
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();

//ukuran A4
$mpdf->AddPage("P", "", "", "", "", "15", "15", "35", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
//Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
$mpdf->WriteHTML($html);
$mpdf->Output($nama_dokumen . ".pdf", 'I');
exit;
