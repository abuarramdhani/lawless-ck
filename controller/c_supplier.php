<?php
$kodeoutlet = $_SESSION['kodeoutlet'];
$bank = query("SELECT * FROM namabank ORDER BY namabank asc ");
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
