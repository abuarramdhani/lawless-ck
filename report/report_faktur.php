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
require '../controller/c_reportfaktur.php';
$tabel_filter = 'produk';
include '../include/report_range.php';



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
include '../controller/c_detail_in.php';
require '../include/fungsi_indotgl.php';
require '../include/fungsi_rupiah.php';

$nama_dokumen = 'REPORT FAKTUR ' . $_GET['start'] . ' s/d '. $_GET['end']; //Beri nama file PDF hasil.
$judul_dokumen = 'REPORT FAKTUR LAWLESS CK<br />' . $_GET['start'] . ' s/d '. $_GET['end'];

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

    .sj {
        font-size: 18px;
        font-weight: bold;
    }
    .sj2 {
        font-size: 14px;
    }

    .ttl {
        text-align: center;
        font-weight: bold;
    }
    </style>
    <style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
    overflow:hidden;padding:3px 5px;word-break:normal;}
    .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
    font-weight:normal;overflow:hidden;padding:5px 5px;word-break:normal; font-weight :bold;}
    .tg .tg-kiri{text-align:left;vertical-align:top}
    .tg .tg-kanan{text-align:right;vertical-align:top}
    .tg .tg-tengah{text-align:center;vertical-align:top}
    </style>

    <title><?= $nama_dokumen ?></title>
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


    <table class="tg table table-bordered border-none">
        <thead>
            <tr>
                <th width="30px">No</th>
                <th>Tanggal</th>
                <th>No FIN</th>
                <th width="200px">Barang</th>
                <th>Outlet</th>
                <th>Supplier</th>
                <th width="100px">Subtotal (Rp.)</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1 ?>

            <?php foreach ($datafaktur as $row) : ?>
            <?php
            $ii = 1;
            $noform = $row['No_form'];
            $detailfaktur = query("SELECT * FROM item_in WHERE No_form = '$noform' ORDER BY id ASC");

            $jumlahi = "SELECT SUM(subtotal) AS total_i FROM item_in WHERE No_form = '$noform'"; //perintah untuk menjumlahkan
            $hasili = mysqli_query($conn, $jumlahi); //melakukan query dengan varibel $jumlahkan
            $inp = mysqli_fetch_array($hasili); //menyimpan hasil query ke variabel $t
            $totali = $inp['total_i'];
            
            ?>
            <tr>
                <td class="tg-kiri"><?= $i++;  ?></td>
                <td class="tg-kiri"><?= $row['date']; ?></td>
                <td class="tg-kiri"><?= $row['No_form']; ?></td>
                <td class="tg-kiri">
                    <?php
                        $detailbarang = query("SELECT ii.*, nb.kodebarang, nb.namabarang FROM item_in ii
                        INNER JOIN barang nb ON ii.kodebahan=nb.kodebarang
                        WHERE ii.No_form = '".$row['No_form']."' 
                        AND nb.kodeoutlet='".$kodeoutlet."' 
                        ORDER BY ii.id ASC");
                        $no=1;
                        foreach ($detailbarang as $rowbarang) {
                    ?>
                        <p><?php echo $no; ?>. <?php echo $rowbarang['namabarang']; ?></p>
                    <?php
                        $no++; }
                    ?>
                </td>
                <td class="tg-kiri">
                    <?php
                        $kodeoutlet = $row["kodeoutlet"];
                        $ka = "SELECT nama FROM companypanel WHERE kodeoutlet ='$kodeoutlet'"; //perintah untuk menjumlahkan
                        $hasilka = mysqli_query($conn, $ka); //melakukan query dengan varibel $jumlahkan
                        $tampil = mysqli_fetch_array($hasilka); //menyimpan hasil query ke variabel $t
                        echo $tampilkode = ucwords($tampil['nama']);
                    ?>
                </td>
                <td class="tg-kiri">
                    <?php
                        $kodesupplier = $row["kodesupplier"];
                        $ka = "SELECT namasupplier FROM supplier WHERE kodesupplier ='$kodesupplier'"; //perintah untuk menjumlahkan
                        $hasilka = mysqli_query($conn, $ka); //melakukan query dengan varibel $jumlahkan
                        $tampil = mysqli_fetch_array($hasilka); //menyimpan hasil query ke variabel $t
                        echo $tampilkode = ucwords($tampil['namasupplier']);
                ?>
                </td>
                <td class="tg-kanan"><?= format_rupiah($totali) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6" class="ttl">TOTAL  (Rp.)</td>
                <td class="tg-kanan ttl"><?= format_rupiah($totalfaktur) ?></td>
            </tr>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
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
            <td  rowspan="2" class=" w-25" style="vertical-align: top;"><img src="../assets/images/logo.png"></td>
            <td class="center w-50 mistral">LAWLESS BURGERBAR</td>
            <td  rowspan="2" class="center w-25" style="vertical-align: bottom;"><p>TOTAL <br/> Rp. '.format_rupiah($totalfaktur).'</p></td>
        </tr>
         <tr>
            <td class="center w-50 sj2">'.$judul_dokumen.' <br />
            
            </td>
        </tr>
        <tr><td></td></tr>
        
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