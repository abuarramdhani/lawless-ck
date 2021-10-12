<?php
$kodeoutlet = $_SESSION['kodeoutlet'];
$bank = query("SELECT * FROM namabank ORDER BY namabank asc ");

// include '../include/fungsi.php';
if(isset ($_POST['reportfilter_range'])){
    $start = explode(' - ', $_POST['start']);
    $end = explode(' - ', $_POST['end']);
    $newStart = date("Y-m-d", strtotime($start[0]));
    $newEnd = date("Y-m-d", strtotime($end[0]));
    
    
    $datafaktur = query("SELECT * FROM form_in WHERE date  BETWEEN date('$newStart') AND date('$newEnd') ORDER BY date ASC");
    
    $jumlahi = "SELECT SUM(subtotal) AS total_i FROM item_in as ii JOIN form_in as fi ON fi.No_form = ii.No_form WHERE date BETWEEN date('$newStart') AND date('$newEnd')  "; //perintah untuk menjumlahkan
    $hasili = mysqli_query($conn, $jumlahi); //melakukan query dengan varibel $jumlahkan
    $inp = mysqli_fetch_array($hasili); //menyimpan hasil query ke variabel $t
    $totalfaktur = $inp['total_i'];

}else{
    
$datafaktur = query("SELECT * FROM form_in ORDER BY date ASC");

$jumlahi = "SELECT SUM(subtotal) AS total_i FROM item_in "; //perintah untuk menjumlahkan
$hasili = mysqli_query($conn, $jumlahi); //melakukan query dengan varibel $jumlahkan
$inp = mysqli_fetch_array($hasili); //menyimpan hasil query ke variabel $t
$totalfaktur = $inp['total_i'];

}






$databarang = query("SELECT * FROM barang ORDER BY namabarang ASC");
$data = query("SELECT * FROM form_in as fo JOIN item_in as io ON fo.No_form = io.No_form WHERE fo.kodeoutlet ='$kodeoutlet' ORDER BY fo.No_form ASC");

// var_dump($kodeoutlet);
// die;





if ($kodeoutlet != "OUT000") {
    $kodesupplierr = query("SELECT * FROM supplier as s
    JOIN namabank as nb
    ON s.kodebank = nb.kodebank
    WHERE s.kodeoutlet = '$kodeoutlet' ORDER BY s.id DESC ");
} else {
    $kodesupplierr = query("SELECT * FROM supplier as s
    JOIN namabank as nb
    ON s.kodebank = nb.kodebank
    ORDER BY s.id DESC ");
}


// if (isset($_POST["updatesupplier"])) {
//     //var_dump($_POST);
//     $idsupplier = $_POST["idsupplier"];
//     $nsupplier = strtolower(htmlspecialchars($_POST["namasupplier"]));
//     $nohp = htmlspecialchars($_POST["nohpsupplier"]);
//     $alamat = htmlspecialchars($_POST["alamatsupplier"]);

//     $query = "UPDATE supplier SET
//                 namasupplier = '$nsupplier',
//                 nohp = '$nohp',
//                 alamatsupplier = '$alamat'
//         WHERE id = $idsupplier
//     ";
//     $masuk_data = mysqli_query($conn, $query);
//     if ($masuk_data) {
//         echo "<script >
//             alert('edit berhasil');
//                 document.location.href = 'supplier';
//             </script>";
//         //echo 3;
//     } else {
//         echo "<script>
//                 alert('gagal');
//                 document.location.href = 'supplier';
//             </script>";
//         //echo 1;
//     }
// }