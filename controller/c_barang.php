<?php

$kodeoutlet = $_SESSION['kodeoutlet'];
$databarang = query("SELECT * FROM barang ORDER BY namabarang ASC");
$barang = query("SELECT * FROM barang ORDER BY id DESC");

// var_dump($outstok);die;
$kategoribarang = query("SELECT * FROM kategoribarang ORDER BY id ASC");
$subkatbarang = query("SELECT * FROM subkatbarang ORDER BY id ASC");
$unit = query("SELECT * FROM unit ORDER BY namaunit ASC");


// if (isset($_POST["updatebahan"])) {
//     //var_dump($_POST);
//     $idbahan = $_POST["idbahan"];
//     $nbahan = strtolower(htmlspecialchars($_POST["namabahan"]));
//     $hargabeli = htmlspecialchars($_POST["hargabeli"]);
//     $hargajual = htmlspecialchars($_POST["hargajual"]);
//     $minstok = htmlspecialchars($_POST["minstok"]);
    
//     $query = "UPDATE bahan SET
//                 namabahan = '$nbahan',
//                 harga = '$hargabeli',
//                 hargaj = '$hargajual',
//                 minstok = '$minstok'
//         WHERE id = $idbahan
//     ";
//     $masuk_data = mysqli_query($conn, $query);
//     if ($masuk_data) {
//         echo "<script >
//             alert('edit berhasil');
//                 document.location.href = 'item-bahan';
//             </script>";
//         //echo 3;
//     } else {
//         echo "<script>
//                 alert('gagal');
//                 document.location.href = 'item-bahan';
//             </script>";
//         //echo 1;
//     }
// }   