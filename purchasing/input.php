<?php
//membuat koneksi
//koneksi database
require '../include/fungsi.php';


//memasukkan data ke array

$namabarang       = $_POST['namabarang'];
$harga         = $_POST['harga'];
$jumlah     = $_POST['jumlah'];
$subtotal    = $_POST['subtotal'];
$kodesupplier    = $_POST['supplier'];
$total_keseluruhan    = $_POST['total_keseluruhan'];

// var_dump($supplier);

$total = count($namabarang);
$dt_input = date('Y-m-d');
$date = date('ymd');

// isi noform

$result_noform = mysqli_query($conn, "SELECT id,No_form FROM form_po ORDER BY No_form DESC");
$ambil_noform = mysqli_fetch_row($result_noform);
$pecah_po = substr($ambil_noform["1"], 0, 8);
$pecah_po_b = substr($ambil_noform["1"], 8);


if ($pecah_po == "PO$date") {
    $pecah_po_b += 1;
    $pecah_po_b = sprintf("%03d", $pecah_po_b);
    $No_form = 'PO' . $date . $pecah_po_b;
} else {
    $No_form = 'PO' . $date . '001';
}
//akhir isi noform
// echo $No_form;
// die;

// bahan
foreach ($namabarang as $row) {

    $sql = "SELECT * 
        FROM bahan 
        WHERE namabahan = '$row'
        ";
    $result = mysqli_query($conn, $sql);

    while ($d = mysqli_fetch_array($result)) {
        $kodebahan[] = $d['kodebahan'];
        // echo $kodebahan;
    }
}

// var_dump($kodebahan);
// die;
// input ke tabel form po


mysqli_query($conn, "insert into form_po set
            No_form    = '$No_form',
            kodeoutlet      = 'OUT005',
            kodesupplier = '$kodesupplier',
            date ='$dt_input',
            status = '1'
        ");

// input ke tabel item po
for ($i = 0; $i < $total; $i++) {

    mysqli_query($conn, "insert into item_po set
            No_form    = '$No_form',
            kodebahan      = '$kodebahan[$i]',
            qty = '$jumlah[$i]',
            harga ='$harga[$i]',
            subtotal = '$subtotal[$i]'
        ");
}

//kembali ke halaman sebelumnya

header("Location: form-po.php?msg=" . urlencode('1'));

// header("location: form-po.php");
