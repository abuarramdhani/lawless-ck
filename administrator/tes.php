<?php
require '../include/fungsi.php';
// $ipm = query("select b.kodebarang AS kode, ipm.kodeproduk, b.stok AS stok_b, sum(ipm.qty) AS qty_ipm from item_produkmasuk 
// ipm inner join barang b ON ipm.kodeproduk=b.kodebarang GROUP by ipm.kodeproduk");

// foreach ($ipm as $row) {
//     echo $kode = $row['kode'] . " " .
//         $stok_b = $row['stok_b'] . " " .
//         $qty_ipm = $row['qty_ipm'] . " " .
//         $stok_restore = $row['stok_b'] - $row['qty_ipm'];
//     echo "<br>";
// }

// echo "<a href='?update=yes'>Update</a>";
// if (isset($_GET['update']) == "yes") {
//     foreach ($ipm as $row1) {
//         $kode = $row1['kode'];
//         $stok_b = $row1['stok_b'];
//         $qty_ipm = $row1['qty_ipm'];
//         $stok_restore = $row1['stok_b'] - $row1['qty_ipm'];

//         $update = query("update barang SET stok='" . $stok_restore . "' WHERE kodebarang='" . $kode . "'");
//         // $truncate = query("TRUNCATE item_produkmasuk");
//     }
//     echo "<a href='?'>Back</a>";
// }
// $tgl = strtotime("10/01/2021");
// echo $tgl = date("ymd", $tgl);
// echo "<br>";
// $nopo = "FPM" . $tgl;
// $formpo = query("SELECT * FROM form_produkmasuk WHERE kodeoutlet = 'OUT002' AND No_form LIKE '$nopo%'  ORDER BY id DESC LIMIT 1");
// foreach ($formpo as $row) {
//     $row['No_form'];
//     $potong = substr($row['No_form'], 0, 9);


//     // if ($potong == $nopo) {
//     //     echo $potong;
//     //     echo "<br>";
//     //     $
//     // }
//     $pecah_po_b = substr($row['No_form'], 9);
//     $pecah_po_b += 1;
//     $pecah_po_b = sprintf("%03d", $pecah_po_b);
//     echo $No_form = $nopo . $pecah_po_b;
//     echo "<br>";
// }

// $tgl = strtotime("10/01/2021");
// $date = date("ymd", $tgl);
// // echo $tgl = date("ymd", $tgl);
// $nopo = "FPM" . $date;
// $formpo = "SELECT * FROM form_produkmasuk WHERE kodeoutlet = 'OUT002' AND No_form LIKE '$nopo%'  ORDER BY id DESC LIMIT 1";
// $query = mysqli_query($conn, $formpo);
// $row = mysqli_fetch_array($query);
// $jml = mysqli_num_rows($query);
// $totalberikutnya = $jml + 1;

// $potong = substr($row['No_form'], 0, 9);
// $pecah_po_b = substr($row['No_form'], 9);
// $pecah_po_b += 1;
// $pecah_po_b = sprintf("%03d", $pecah_po_b);

// // if ($row['No_form'] == "") {
// //     echo $No_form = 'FPM' . $date . '001';
// // } else {
// //     echo $No_form = $nopo . $pecah_po_b;
// // }
// // $data = substr($formpo["0"]['No_form'], 0, 9);
// // $tambah = substr($formpo["0"]['No_form'], 9);
// // var_dump($tambah);
// // if ($data == $nopo) {
// //     $tambah += 1;
// //     $tambah = sprintf("%03d", $tambah);
// //     $cetak = $nopo . $tambah;
// //     echo $cetak;
// // }

// $form =  query("SELECT * FROM form_produkmasuk WHERE kodeoutlet = 'OUT002' ORDER BY date DESC, No_form DESC ");

// foreach ($form as $row) {
//     echo $row['date'] . " - " . $row['No_form'];
//     echo "<br>";
// }

// echo "<br>";

// //echo date("Y-m-d");
// echo date("m/d/Y");

$BB =  query("SELECT * FROM barang WHERE id > '1451' ");

foreach ($BB as $row) {
    $kb = $row['kodebarang'];
    $row['kodebarang'] . " - " . $row['namabarang'];
    // echo "<br>";

    $cekkb = mysqli_query($conn, "SELECT * FROM item_in WHERE kodebahan ='$kb' AND id > '660' ");

    if (mysqli_num_rows($cekkb) > 0) {
        $II =  query("SELECT * FROM item_in WHERE id > '660' ");

        foreach ($II as $row1) {
            echo $row['kodebarang'] . " - " . $row['namabarang'] . " | " . $row1['kodebahan'] . " - " . $row1['qty'];
            echo "<br>";
        }
    }
}