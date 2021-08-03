<?php

require '../include/fungsi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$date = new DateTime();

if (isset($_POST["updateproyek"])) {
    //var_dump($_POST);
    $noproyek = htmlspecialchars($_POST["noproyek"]);
    $namaklien = htmlspecialchars($_POST["kodeklien"]);
    $outlet = htmlspecialchars($_POST["outlet"]);
    $tempat = htmlspecialchars($_POST["tempat"]);
    $nilaiproyek = htmlspecialchars($_POST["nilaiproyek"]);
    $pekerjaan = htmlspecialchars($_POST["pekerjaan"]);
    $keterangan = htmlspecialchars($_POST["keterangan"]);

    $idp = query("SELECT id FROM proyek WHERE noproyek ='$noproyek'")[0];
    $idd = $idp['id'];

    $query = "UPDATE proyek SET
                namaklien = '$namaklien',
                outlet = '$outlet',
                tempat = '$tempat',
                pekerjaan = '$pekerjaan',
                keterangan = '$keterangan',
                nilaiproyek = '$nilaiproyek'
        WHERE id = $idd
    ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST["updatemaintenance"])) {
    //var_dump($_POST);
    $noproyek = htmlspecialchars($_POST["noproyek"]);
    $namaklien = htmlspecialchars($_POST["kodeklien"]);
    $outlet = htmlspecialchars($_POST["outlet"]);
    $tempat = htmlspecialchars($_POST["tempat"]);
    $nilaiproyek = htmlspecialchars($_POST["nilaiproyek"]);
    $pekerjaan = htmlspecialchars($_POST["pekerjaan"]);
    $keterangan = htmlspecialchars($_POST["keterangan"]);

    $idp = query("SELECT id FROM maintenance WHERE noproyek ='$noproyek'")[0];
    $idd = $idp['id'];

    $query = "UPDATE maintenance SET
                namaklien = '$namaklien',
                outlet = '$outlet',
                tempat = '$tempat',
                pekerjaan = '$pekerjaan',
                keterangan = '$keterangan',
                nilaiproyek = '$nilaiproyek'
        WHERE id = $idd
    ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} elseif (isset($_POST["updatemenu"])) {
    $id = $_POST['updatemenu'];
    $menu = $_POST['unama'];
    $url = $_POST['uurl'];

    // var_dump($url);
    $idmenu = query("SELECT id FROM user_menu WHERE id ='$id'")[0];
    $id = $idmenu['id'];

    $query = "UPDATE user_menu SET
                menu = '$menu',
                url = '$url'
        WHERE id = '$id'";

    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {
        echo 2;
    } else {
        echo 1;
    }
} else if (isset($_POST["update-supplier"])) {
    $namasupplier = $_POST['unama'];
    $nohpsupplier = $_POST['unohp'];
    $alamatsupplier = $_POST['ualamat'];
    $id = $_POST['update-supplier'];

    // var_dump($namasupplier);
    // var_dump($nohpsupplier);
    // var_dump($alamatsupplier);
    // die;

    // $id = $_POST['updatemenu'];
    // $menu = $_POST['unama'];
    // $url = $_POST['uurl'];

    $query = "UPDATE supplier SET
                     namasupplier = '$namasupplier',
                     nohp = '$nohpsupplier',
                     alamatsupplier = '$alamatsupplier'
             WHERE id = $id
      ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {
        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST["update-kproduk"])) {
    $nama = $_POST['unamakproduk'];
    $id = $_POST['update-kproduk'];

    // var_dump($namasupplier);
    // var_dump($nohpsupplier);
    // var_dump($alamatsupplier);
    // die;

    // $id = $_POST['updatemenu'];
    // $menu = $_POST['unama'];
    // $url = $_POST['uurl'];

    $query = "UPDATE kategoriproduk SET
                     namakategoriproduk = '$nama'
             WHERE id = $id
      ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {
        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST["updatebahan"])) {

    $kodeoutlet = $_SESSION['kodeoutlet'];
    $kodebahan = $_POST['updatebahan'];
    $namabahan = $_POST['namabahan'];
    $mstok = $_POST['mstok'];
    $harga = $_POST['harga'];
    $hargaj = $_POST['hargaj'];

    // var_dump($kodeoutlet);
    // die;

    $query = "UPDATE bahan SET
    kodeoutlet ='$kodeoutlet',
                     kodebahan = '$kodebahan',
                     namabahan = '$namabahan',
                     minstok = '$mstok',
                     harga = '$harga',
                     hargaj = '$hargaj'
             WHERE kodebahan = '$kodebahan'
      ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {
        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST["update-jabatan"])) {


    $kodejabatan = $_POST['update-jabatan'];
    $namajabatan = $_POST['namajabatan'];

    // var_dump($kodeoutlet);
    // die;

    $query = "UPDATE jabatan SET
                     namajabatan = '$namajabatan',
                     status = '1'
             WHERE kodejabatan = '$kodejabatan'
      ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {
        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST["update-produk"])) {

    // $kodeoutlet = $_SESSION['kodeoutlet'];

    $kodeproduk = $_POST['update-produk'];
    $kodekproduk = $_POST['kodekproduk'];
    $namaproduk = $_POST['unama'];
    $hargaj = $_POST['uhargaj'];
    $mstok = $_POST['uminstok'];
    $kodekategoriproduk = 'KAP001';

    // var_dump($kodeproduk);
    // var_dump($namaproduk);
    // var_dump($hargaj);
    // var_dump($mstok);
    // die;
    $ugambar = $_FILES["ugambar"];
    $ekstensi_diperbolehkan    = array('png', 'jpg', 'jpeg');

    if ($ugambar['name'] != "") {
        $gambar = $ugambar['name'];
    } else {
        $gambar = "no_image.jpg";
    }
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));


    $gambar = uniqid();
    $gambar .= '.';
    $gambar .=   $ekstensi;

    $ukuran    = $ngambar['size'];
    $file_tmp = $ugambar['tmp_name'];

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 2044070) {
            move_uploaded_file($file_tmp, '../assets/images/products/' . $gambar);
            $query = "UPDATE produk SET
    kodekategoriproduk = '$kodekproduk',
                     namaproduk = '$namaproduk',
                     minstok = '$mstok',
                     harga = '$hargaj'
             WHERE kodeproduk = '$kodeproduk'
      ";
            $masuk_data = mysqli_query($conn, $query);
            if ($masuk_data) {
                echo 3;
            } else {
                echo 1;
            }
        } else {
            echo 4;
        }
    } else {
        echo 5;
    }
} elseif (isset($_POST["update-user"])) {
    // var_dump('ok');
    $id = $_POST['update-user'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $outlet = $_POST['outlet'];
    $jabatan = $_POST['jabatan'];

    // var_dump($id);
    // var_dump($name);
    // var_dump($email);
    // var_dump($outlet);
    // var_dump($jabatan);
    // die;
    $query = "UPDATE admin SET
    username = '$name',
    email = '$email',
    outlet = 'OUT00$outlet',
    jabatan = 'JAB00$jabatan'
    WHERE id = $id
                ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {
        echo 3;
    } else {
        echo 1;
    }
} elseif (isset($_POST["update-outlet"])) {
    // var_dump('ok');
    $kode = $_POST['update-outlet'];
    $name = $_POST['unama'];
    $notelp = $_POST['unotelp'];

    // var_dump($kode);
    // var_dump($name);
    // var_dump($notelp);
    // var_dump($outlet);
    // var_dump($jabatan);
    // die;
    $query = "UPDATE companypanel SET
    nama = '$name',
    notelp = '$notelp'
    WHERE kodeoutlet = '$kode'
                ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {
        echo 3;
    } else {
        var_dump($masuk_data);
        echo 1;
    }
}
