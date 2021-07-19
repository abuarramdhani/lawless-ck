<?php
//membuat koneksi
//koneksi database
require '../include/fungsi.php';


//memasukkan data ke array

$namabarang       = $_POST['namabarang'];
$harga         = $_POST['harga'];
$jumlah     = $_POST['jumlah'];
$subtotal    = $_POST['subtotal'];
$supplier    = $_POST['supplier'];
$total_keseluruhan    = $_POST['total_keseluruhan'];

$total = count($namabarang);
$dt_input = date('Y-m-d');
$date = date('ymd');
$No_form = 'PO' . $date . '001';

//supplier


$sql = "SELECT * 
        FROM supplier 
        WHERE namasupplier = '$supplier'
        ";
$result = mysqli_query($conn, $sql);

while ($d = mysqli_fetch_array($result)) {
    $kodesupplier = $d['kodesupplier'];
    // echo $kodebahan;
}
// var_dump($kodesupplier);
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
header("location: form-po.php");
