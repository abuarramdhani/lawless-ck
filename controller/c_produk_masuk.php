<?php
// session_start();
require '../include/fungsi.php';
$keyword = $_POST["keyword_form-po"];
//$kodeoutlet = $_SESSION['kodeoutlet'];

if (isset($keyword)) {

    $produk = query("SELECT * FROM barang as b
    JOIN unit as u ON b.unitbeli = u.kodeunit
<<<<<<< HEAD
    WHERE b.namabarang LIKE '%" . $keyword . "%' AND (b.kategoribarang = 'KAB001' AND b.status = '0' AND b.kodeoutlet='OUT002')
=======
    WHERE b.namabarang LIKE '%" . $keyword . "%' AND (b.kategoribarang = 'KAB001' AND b.status = '0' AND b.kodeoutlet = 'OUT002')
>>>>>>> 9ef7094637ed761909998bd7a33369af68bcc0c2
    ORDER BY b.id DESC ");
    // $bahan = query("SELECT * FROM produk 
    // WHERE kodeoutlet = '$kodeoutlet' AND (namabahan LIKE '%" . $keyword . "%' OR kodebahan like '%" . $keyword . "%')
    // ORDER BY id DESC ");
    echo json_encode($produk);
}