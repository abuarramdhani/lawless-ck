<?php
require '../include/fungsi.php';

$nopo = $_POST['noform'];
$kodebahan = $_POST['kodebahan'];
$harga = $_POST['harga'];
$qty = $_POST['qty'];
$subtotal = $_POST['subtotal'];
$kodesupplier = $_POST['kodesupplier'];
$tanggal = date('Y-m-d');
$noin = str_replace("PO","IN",$nopo);

mysqli_query($conn, "INSERT INTO form_in (No_form, kodeoutlet, kodesupplier, date) VALUES ('$noin', 'OUT005', '$kodesupplier', '$tanggal')");
for($i=0;$i<count($kodebahan); $i++){
    mysqli_query($conn, "UPDATE bahan SET harga='$harga[$i]' WHERE kodebahan='$kodebahan[$i]'");
    mysqli_query($conn, "INSERT INTO item_in (NO_form, kodebahan, qty, harga, subtotal) VALUE ('$noin', '$kodebahan[$i]', '$qty[$i]', '$harga[$i]', '$subtotal[$i]')");
}

header("Location: barangmasuk.php?msg=" . urlencode('1'));
?>