<?php

$kodekategoriproduk = query("SELECT * FROM kategoriproduk ORDER BY id DESC ");

if (isset($_POST["updatekategoriproduk"])) {
    //var_dump($_POST);
    $idkategoriproduk = $_POST["idkategoriproduk"];
    $nkategoriproduk = strtolower(htmlspecialchars($_POST["namakategoriproduk"]));
    
    
    $query = "UPDATE kategoriproduk SET
                namakategoriproduk = '$nkategoriproduk'
        WHERE id = $idkategoriproduk
    ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {
        echo "<script >
            alert('edit berhasil');
                document.location.href = 'kategori-produk';
            </script>";
        //echo 3;
    } else {
        echo "<script>
                alert('gagal');
                document.location.href = 'kategori-produk';
            </script>";
        //echo 1;
    }
}   