<?php

$kodeoutlet = query("SELECT * FROM companypanel ORDER BY id ASC ");

if (isset($_POST["updateoutlet"])) {
    //var_dump($_POST);
    $idoutlet = $_POST["idoutlet"];
    $noutlet = strtolower(htmlspecialchars($_POST["namaoutlet"]));
    
    
    $query = "UPDATE companypanel SET
                nama = '$noutlet'
        WHERE id = $idoutlet
    ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {
        echo "<script >
            alert('edit berhasil');
                document.location.href = 'outlet';
            </script>";
        //echo 3;
    } else {
        echo "<script>
                alert('gagal');
                document.location.href = 'outlet';
            </script>";
        //echo 1;
    }
}   