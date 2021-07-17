<?php

$kodejabatan = query("SELECT * FROM jabatan ORDER BY id DESC ");
$kodeoutlet = query("SELECT * FROM companypanel ORDER BY id ASC ");
$kodeadmin = query("SELECT * FROM admin ORDER BY id ASC ");

if (isset($_POST["updatejabatan"])) {
    //var_dump($_POST);
    $idjabatan = $_POST["idjabatan"];
    $njabatan = strtolower(htmlspecialchars($_POST["namajabatan"]));
    
    
    $query = "UPDATE jabatan SET
                namajabatan = '$njabatan'
        WHERE id = $idjabatan
    ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {
        echo "<script >
            alert('edit berhasil');
                document.location.href = 'jabatan';
            </script>";
        //echo 3;
    } else {
        echo "<script>
                alert('gagal');
                document.location.href = 'jabatan';
            </script>";
        //echo 1;
    }
}   