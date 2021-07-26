<?php
$kodekategoriproduk = query("SELECT * FROM kategoriproduk ORDER BY namakategoriproduk ASC ");
$kodeproduk = query("SELECT * FROM produk ORDER BY id DESC ");

if (isset($_POST["updateproduk"])) {
    //var_dump($_POST);
    $idproduk = $_POST["idproduk"];
    $nproduk = strtolower(htmlspecialchars($_POST["namaproduk"]));
    $hargabeli = htmlspecialchars($_POST["hargabeli"]);
    $hargajual = htmlspecialchars($_POST["hargajual"]);
    
    $query = "UPDATE produk SET
                namaproduk = '$nproduk',
                harga = '$hargabeli',
                hargaj = '$hargajual'
        WHERE id = $idproduk
    ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {
        echo "<script >
            alert('edit berhasil');
                document.location.href = 'produk';
            </script>";
        //echo 3;
    } else {
        echo "<script>
                alert('gagal');
                document.location.href = 'produk';
            </script>";
        //echo 1;
    }
}   