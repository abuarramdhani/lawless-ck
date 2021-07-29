<?php

// require_once __DIR__ . 'vendor/autoload.php';
// require_once "../vendor/autoload.php";
include "../vendor/autoload.php";
$nama_dokumen = 'Surat Penawaran'; //Beri nama file PDF hasil.

$mpdf = new \Mpdf\Mpdf();
ob_start();

//query mengambil data dari database
$hostname = 'localhost';
$dbname = 'db_template';
$dbuser = 'root';
$dbpass = '';

$mysqli = new mysqli($hostname, $dbuser, $dbpass, $dbname);

$templates = $mysqli->query('SELECT * FROM template');

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
    <title>template-pdf</title>
</head>

<body>
    <p>Jakarta, 22 Februari 2021</p>
    <table class="table-borderless">
        <tr>
            <th>Kepada Yth.</th>
        </tr>
        <tr>
            <th>Bpk Budi</th>
        </tr>
        <tr>
            <th>Toko Abadi</th>
        </tr>
        <tr>
            <th>Jakarta</th>
        </tr>
    </table>
    <p class="mt-3">Hal : Penawaran Harga</p>
    <p class="mb-0">Dengan hormat,</p>
    <p class="indent"> Permintaan Bapak tentang pengadaan Unit di Toko Abadi Jakarta, bersama ini
        kami sampaikan penawaran harga sebagai berikut :</p>

    <table class="table table-bordered border-none">
        <thead>
            <tr>
                <th scope="col" class="text-center">NO</th>
                <th scope="col" class="text-center" width="45%">DESCRIPTION</th>
                <th scope="col" colspan="2" class="text-center">QTY</th>
                <th scope="col" class="text-center">NEW</th>
                <th scope="col" class="text-center">SECOND</th>

            </tr>
        </thead>
        <tbody>

            <?php
            $i = 1;
            foreach ($templates as $template) { ?>
                <tr>
                    <th scope="row" class="text-center"><?= $i++ ?></th>
                    <td><?= $template['desc']; ?></td>
                    <td class="text-center"><?= $template['qyt_nilai']; ?></td>
                    <td class="text-center"><?= $template['qyt_satuan']; ?></td>
                    <td class="text-right"><?= number_format($template['new'], 0, ".", "."); ?></td>
                    <td class="text-right"><?= number_format($template['second'], 0, ".", ".");  ?></td>
                </tr>
            <?php
            } ?>
            <tr>
                <th scope="row" class="text-center"></th>
                <td></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <th scope="row" class="text-center"></th>
                <td></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <th></th>
                <th>#Noted</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th></th>
                <td>Jasa</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th class="border-none" colspan="4"></th>
                <th class="text-left">Total New</th>
                <th class="text-left">Total Second</th>
            </tr>
            <tr>
                <th class="border-none" colspan="4"></th>
                <th class="text-right">144,350,000</th>
                <th class="text-right">55,250,000</th>
            </tr>
        </tbody>
    </table>


    <p class="mb-0">Cara Pembayaran : </p>
    <p class="mb-0 indent">1. Uang muka 50 % setelah PO kami terima</p>
    <p class="mb-0 indent">2. Pelunasan 50 % setelah terkirim ( Berita Acara )</p>
    <p class="indent">Demikian surat penawaran ini kami sampaikan, atas perhatian serta kerjasamanya kami ucapkan terima kasih.</p>

    <table class="table table-borderless">
        <tr>
            <td height="150px" width="65%">Hormat kami,</td>
            <td height="150px">Menyetujui,</td>
        </tr>
        <tr>
            <td>Direktur</td>
            <td>Pak Budi</td>
        </tr>

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
            'content' => '<img src="img/logo.png">',
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
