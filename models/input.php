<?php
session_start();
require '../include/fungsi.php';
date_default_timezone_set('Asia/Jakarta');
$date = new DateTime();

// var_dump($_POST);

if (isset($_POST['kasmasuk'])) {
    //var_dump($_POST);

    $butl = substr($date->format('Y-m-d'), 5, 2);
    $thl = substr($date->format('Y-m-d'), 2, 2);
    $kodekas = "KM";
    $kodebulan = $thl . $butl;

    $kodeakun = $_POST["kodeakun"];
    $tangg = $_POST["tanggal"];
    $tanggal = date('Y-m-d', strtotime($tangg));
    $butli = date('m', strtotime($tangg));

    if ($butli != $butl) {
        echo 2;
        return false;
    }



    $kas = query("SELECT * FROM kas WHERE kodekas ='KM' ORDER BY id DESC LIMIT 1")[0];
    if ($kas['kodekas'] . $kas['kodebulan'] != $kodekas . $thl . $butl) {
        $newkodetr = "0001";
    } else {
        $lastkode = query("SELECT * FROM kas WHERE kodekas ='KM' ORDER BY id DESC LIMIT 1")[0];
        $lk = $lastkode['kodetr'];
        $noUrut = (int) $lastkode['kodetr'];
        $noUrut++;
        $newkodetr = sprintf("%04s", $noUrut);
    }

    $payto = htmlspecialchars($_POST["payto"]);
    $keterangan = htmlspecialchars($_POST["keterangan"]);
    $input = htmlspecialchars($_POST["jumlahinput"]);
    $output = 0;
    $saldokas = query("SELECT saldo FROM kas ORDER BY id DESC LIMIT 1")[0];
    $saldo = $saldokas['saldo'] + $input;


    //query insert data
    $query = "INSERT INTO kas 
                VALUES 
                ('','$tanggal','$kodekas','$kodebulan','$newkodetr','$payto','$keterangan','$input','$output','$saldo','$kodeakun')
            ";

    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST['kaskeluar'])) {

    $butl = substr($date->format('Y-m-d'), 5, 2);
    $thl = substr($date->format('Y-m-d'), 2, 2);
    $kodekas = "KK";
    $kodebulan = $thl . $butl;

    $kodeakun = $_POST["kodeakunout"];
    $tangg = $_POST["tanggalout"];
    $tanggal = date('Y-m-d', strtotime($tangg));
    $butli = date('m', strtotime($tangg));

    if ($butli != $butl) {
        echo 2;
        return false;
    }



    $kas = query("SELECT * FROM kas WHERE kodekas ='$kodekas' ORDER BY id DESC LIMIT 1")[0];
    if ($kas['kodekas'] . $kas['kodebulan'] != $kodekas . $thl . $butl) {
        $newkodetr = "0001";
    } else {
        $lastkode = query("SELECT * FROM kas WHERE kodekas ='$kodekas' ORDER BY id DESC LIMIT 1")[0];
        $lk = $lastkode['kodetr'];
        $noUrut = (int) $lastkode['kodetr'];
        $noUrut++;
        $newkodetr = sprintf("%04s", $noUrut);
    }

    $payto = htmlspecialchars($_POST["paytoout"]);
    $keterangan = htmlspecialchars($_POST["keteranganout"]);
    $input = 0;
    $output = htmlspecialchars($_POST["jumlahoutput"]);
    $saldokas = query("SELECT saldo FROM kas ORDER BY id DESC LIMIT 1")[0];
    $saldo = $saldokas['saldo'] - $output;


    //query insert data
    $query = "INSERT INTO kas 
                VALUES 
                ('','$tanggal','$kodekas','$kodebulan','$newkodetr','$payto','$keterangan','$input','$output','$saldo','$kodeakun')
            ";

    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST["klien"])) {
    $kodeklien = query("SELECT * FROM klien ORDER BY id DESC LIMIT 1")[0];
    $kodem = substr($kodeklien['kodeklien'], 1);
    $noUrut = (int) $kodem;
    $noUrut++;
    $newkodetr = sprintf("%03s", $noUrut);

    $kode = "K";
    $km = $kode . $newkodetr;

    $nklien = htmlspecialchars($_POST["nklien"]);
    $nama = "0";
    $alamat = "0";
    $nohp = "0";
    $bank = "0";
    $norek = "0";

    //query insert data
    $query = "INSERT INTO klien 
                VALUES 
                ('','$km','$nklien','$nama','$alamat','$nohp','$bank','$norek')
            ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST["proyek"])) {

    $tangg = $_POST["tanggal"];
    $tanggal = date('Y-m-d', strtotime($tangg));
    $bul = date('m', strtotime($tangg));
    $t = substr(date('Y', strtotime($tangg)), 2, 2);

    $butl = substr($date->format('Y-m-d'), 5, 2);
    $thl = substr($date->format('Y-m-d'), 2, 2);
    $kodeproyek = "PSRS";
    $kodebulan = $bul . $t;

    $cekdata = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM proyek"));
    if ($cekdata > 0) {

        $kas = query("SELECT * FROM proyek WHERE month(tanggalpjt) ='$bul' ORDER BY id DESC LIMIT 1")[0];

        if (substr($kas['noproyek'], 7, 2) != 04) {
            $newkodetr = "001";
        } else {
            $lastkode = query("SELECT * FROM proyek WHERE month(tanggalpjt) ='$bul' ORDER BY id DESC LIMIT 1")[0];
            $lk = substr($lastkode['noproyek'], 4, 3);
            $noUrut = (int) $lk;
            $noUrut++;
            $newkodetr = sprintf("%03s", $noUrut);
        }
    } else {
        $newkodetr = "001";
    }

    $tanggalpro = $tanggal;
    $tanggalpjt = $tanggal;
    $noproposal = "PRO" . $kodebulan . $newkodetr;
    $noproyek = "PSRS" . $newkodetr . $kodebulan;

    //$novoucher = htmlspecialchars($_POST["nv"]);
    $namaklien = htmlspecialchars($_POST["kodeklien"]);
    $outlet = htmlspecialchars($_POST["outlet"]);
    $tempat = htmlspecialchars($_POST["tempat"]);
    $nilaiproyek = htmlspecialchars($_POST["nilaiproyek"]);
    $pekerjaan = htmlspecialchars($_POST["pekerjaan"]);
    $keterangan = "";
    $status = "";
    $diskon = "";

    //query insert data
    $query = "INSERT INTO proyek 
                VALUES 
                ('','$tanggalpro','$tanggalpjt','$noproposal','$noproyek','$namaklien','$outlet','$tempat','$pekerjaan','$nilaiproyek','$keterangan','$status','$diskon')
            ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST['pembayaranproyek'])) {
    //var_dump($_POST);

    $pk = htmlspecialchars($_POST["pk"]);
    $kodeproyek = htmlspecialchars($_POST["noproyek"]);
    $payto = $_POST["payto"];
    $kodeakun = 411;
    $tangg = $_POST["tanggal"];
    $tanggal = date('Y-m-d', strtotime($tangg));
    $input = htmlspecialchars($_POST["jumlahinput"]);

    $butl = substr($date->format('Y-m-d'), 5, 2);
    $thl = substr($date->format('Y-m-d'), 2, 2);
    $kodekas = "KBMP";
    $kodebulan = $thl . $butl;

    $cekdata = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pembayaran WHERE kodekas = '$kodekas' AND kodebulan ='$kodebulan' "));

    if ($cekdata) {
        $kas = query("SELECT * FROM pembayaran WHERE kodekas = '$kodekas' AND kodebulan ='$kodebulan' ORDER BY id DESC LIMIT 1")[0];
        if ($kas['kodekas'] . $kas['kodebulan'] != $kodekas . $kodebulan) {
            $newkodetr = "0001";
        } else {
            $lastkode = query("SELECT * FROM pembayaran  WHERE kodekas = '$kodekas' AND kodebulan ='$kodebulan' ORDER BY id DESC LIMIT 1")[0];
            $lk = $lastkode['kodetr'];
            $noUrut = (int) $lastkode['kodetr'];
            $noUrut++;
            $newkodetr = sprintf("%04s", $noUrut);
        }
    } else {
        $newkodetr = "0001";
    }

    $detpro = query("SELECT * FROM proyek WHERE noproyek = '$kodeproyek' ")[0];

    $kodeklien = $detpro['namaklien'];
    $detklien = query("SELECT * FROM klien WHERE kodeklien = '$kodeklien' ")[0];
    $nk = $detklien['namaklien'];
    $ok = $detpro['outlet'];
    $keterangan = $nk . " / " . $ok . " " . "-" . " " . $pk;
    $saldokas = query("SELECT saldo FROM pembayaran ORDER BY id DESC LIMIT 1")[0];
    $output = 0;
    $saldo = $saldokas['saldo'] + $input;

    $saldodp = $kodekas . $kodebulan . $newkodetr;

    $query = "INSERT INTO pembayaran 
                VALUES 
                ('','$tanggal','$kodekas','$kodebulan','$newkodetr','$kodeproyek','$payto','$kodeakun','$keterangan','$input','$output','$saldo')
            ";

    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST["maintenance"])) {

    $tangg = $_POST["tanggal"];
    $tanggal = date('Y-m-d', strtotime($tangg));
    $bul = date('m', strtotime($tangg));
    $t = substr(date('Y', strtotime($tangg)), 2, 2);

    $butl = substr($date->format('Y-m-d'), 5, 2);
    $thl = substr($date->format('Y-m-d'), 2, 2);
    $kodeproyek = "MSRS";
    $kodebulan = $bul . $t;

    $cekdata = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM maintenance"));
    if ($cekdata > 0) {
        $kas = query("SELECT * FROM maintenance WHERE month(tanggalpjt) ='$bul' ORDER BY id DESC LIMIT 1")[0];

        if (substr($kas['noproyek'], 7, 2) != $bul) {
            $newkodetr = "001";
        } else {
            $lastkode = query("SELECT * FROM maintenance WHERE month(tanggalpjt) ='$bul' ORDER BY id DESC LIMIT 1")[0];
            $lk = substr($lastkode['noproyek'], 4, 3);
            $noUrut = (int) $lk;
            $noUrut++;
            $newkodetr = sprintf("%03s", $noUrut);
        }
    } else {
        $newkodetr = "001";
    }


    $tanggalpro = $tanggal;
    $tanggalpjt = $tanggal;
    $noproposal = "PRO" . $kodebulan . $newkodetr;
    $noproyek = "MSRS" . $newkodetr . $kodebulan;

    //$novoucher = htmlspecialchars($_POST["nv"]);
    $namaklien = htmlspecialchars($_POST["kodeklien"]);
    $outlet = htmlspecialchars($_POST["outlet"]);
    $tempat = htmlspecialchars($_POST["tempat"]);
    $nilaiproyek = htmlspecialchars($_POST["nilaiproyek"]);
    $pekerjaan = htmlspecialchars($_POST["pekerjaan"]);
    $keterangan = "";
    $status = "";
    $diskon = "";

    //query insert data
    $query = "INSERT INTO maintenance 
                VALUES 
                ('','$tanggalpro','$tanggalpjt','$noproposal','$noproyek','$namaklien','$outlet','$tempat','$pekerjaan','$nilaiproyek','$keterangan','$status','$diskon')
            ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST['pembayaranmaintenance'])) {
    //var_dump($_POST);

    $pk = htmlspecialchars($_POST["pk"]);
    $kodeproyek = htmlspecialchars($_POST["noproyek"]);
    $payto = $_POST["payto"];
    $kodeakun = 411;
    $tangg = $_POST["tanggal"];
    $tanggal = date('Y-m-d', strtotime($tangg));
    $input = htmlspecialchars($_POST["jumlahinput"]);

    $butl = substr($date->format('Y-m-d'), 5, 2);
    $thl = substr($date->format('Y-m-d'), 2, 2);
    $kodekas = "KBMP";
    $kodebulan = $thl . $butl;

    $cekdata = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pembayaran WHERE kodekas = '$kodekas' AND kodebulan ='$kodebulan' "));

    if ($cekdata) {
        $kas = query("SELECT * FROM pembayaran WHERE kodekas = '$kodekas' AND kodebulan ='$kodebulan' ORDER BY id DESC LIMIT 1")[0];
        if ($kas['kodekas'] . $kas['kodebulan'] != $kodekas . $kodebulan) {
            $newkodetr = "0001";
        } else {
            $lastkode = query("SELECT * FROM pembayaran  WHERE kodekas = '$kodekas' AND kodebulan ='$kodebulan' ORDER BY id DESC LIMIT 1")[0];
            $lk = $lastkode['kodetr'];
            $noUrut = (int) $lastkode['kodetr'];
            $noUrut++;
            $newkodetr = sprintf("%04s", $noUrut);
        }
    } else {
        $newkodetr = "0001";
    }

    $detpro = query("SELECT * FROM maintenance WHERE noproyek = '$kodeproyek' ")[0];

    $kodeklien = $detpro['namaklien'];
    $detklien = query("SELECT * FROM klien WHERE kodeklien = '$kodeklien' ")[0];
    $nk = $detklien['namaklien'];
    $ok = $detpro['outlet'];
    $keterangan = $nk . " / " . $ok . " " . "-" . " " . $pk;
    $saldokas = query("SELECT saldo FROM pembayaran ORDER BY id DESC LIMIT 1")[0];
    $output = 0;
    $saldo = $saldokas['saldo'] + $input;

    $saldodp = $kodekas . $kodebulan . $newkodetr;

    $query = "INSERT INTO pembayaran 
                VALUES 
                ('','$tanggal','$kodekas','$kodebulan','$newkodetr','$kodeproyek','$payto','$kodeakun','$keterangan','$input','$output','$saldo')
            ";

    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST['inputsupplier'])) {

    $cekdata = mysqli_query($conn, "SELECT * FROM supplier ");
    //cek ada data?
    if (mysqli_num_rows($cekdata) > 0) {
        $kodesupplier = query("SELECT * FROM supplier ORDER BY id DESC LIMIT 1")[0];
        $kodes = substr($kodesupplier['kodesupplier'], 3);
        $noUrut = (int) $kodes;
        $noUrut++;
        $newkodetr = sprintf("%03s", $noUrut);
    } else {
        $newkodetr = "001";
    }

    $kode = "SUP";
    $kp = $kode . $newkodetr;
    $kodeoutlet = htmlspecialchars($_POST["kodeoutlet"]);
    $nsupplier = strtolower(htmlspecialchars($_POST["nsupplier"]));
    $nohp = htmlspecialchars($_POST["nohp"]);
    $alamat = htmlspecialchars($_POST["alamat"]);

    $ceknama = mysqli_query($conn, "SELECT * FROM supplier WHERE namasupplier ='$nsupplier' ");

    if (mysqli_fetch_assoc($ceknama)) {
        echo "<script>
                alert('nama supplier sudah terdaftar');
                document.location.href = 'supplier';
            </script>";
        return false;
    }

    //query insert data
    $query = "INSERT INTO supplier 
                VALUES 
                ('','$kodeoutlet','$kp','$nsupplier','$nohp','$alamat')
            ";

    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST['inputunit'])) {

    $cekdata = mysqli_query($conn, "SELECT * FROM unit ");
    //cek ada data?
    if (mysqli_num_rows($cekdata) > 0) {
        $kodeunit = query("SELECT * FROM unit ORDER BY id DESC LIMIT 1")[0];
        $kodes = substr($kodeunit['kodeunit'], 3);
        $noUrut = (int) $kodes;
        $noUrut++;
        $newkodetr = sprintf("%03s", $noUrut);
    } else {
        $newkodetr = "001";
    }

    $kode = "SAT";
    $kp = $kode . $newkodetr;

    $nunit = strtolower(htmlspecialchars($_POST["nunit"]));


    $ceknama = mysqli_query($conn, "SELECT * FROM unit WHERE namaunit ='$nunit' ");

    if (mysqli_fetch_assoc($ceknama)) {
        echo "<script>
                alert('nama unit sudah terdaftar');
                document.location.href = 'unit';
            </script>";
        return false;
    }

    //query insert data
    $query = "INSERT INTO unit 
                VALUES 
                ('','$kp','$nunit')
            ";

    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST['inputbahan'])) {

    $cekdata = mysqli_query($conn, "SELECT * FROM bahan ");
    //cek ada data?
    if (mysqli_num_rows($cekdata) > 0) {
        $kodebahan = query("SELECT * FROM bahan ORDER BY id DESC LIMIT 1")[0];
        $kodes = substr($kodebahan['kodebahan'], 3);
        $noUrut = (int) $kodes;
        $noUrut++;
        $newkodetr = sprintf("%03s", $noUrut);
    } else {
        $newkodetr = "001";
    }

    $kode = "BAH";
    $kp = $kode . $newkodetr;

    $kodeoutlet = htmlspecialchars($_POST["kodeoutlet"]);
    $nbahan = strtolower(htmlspecialchars($_POST["nbahan"]));


    $ceknama = mysqli_query($conn, "SELECT * FROM bahan WHERE namabahan ='$nbahan' ");

    if (mysqli_fetch_assoc($ceknama)) {
        echo "<script>
                alert('nama bahan sudah terdaftar');
                document.location.href = 'bahan';
            </script>";
        return false;
    }

    //query insert data
    $query = "INSERT INTO bahan 
                VALUES 
                ('','$kodeoutlet','$kp','$nbahan','','')
            ";

    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST['inputoutlet'])) {

    $cekdata = mysqli_query($conn, "SELECT * FROM companypanel ");
    //cek ada data?
    if (mysqli_num_rows($cekdata) > 0) {
        $kodeoutlet = query("SELECT * FROM companypanel ORDER BY id DESC LIMIT 1")[0];
        $kodes = substr($kodeoutlet['kodeoutlet'], 3);
        $noUrut = (int) $kodes;
        $noUrut++;
        $newkodetr = sprintf("%03s", $noUrut);
    } else {
        $newkodetr = "001";
    }

    $kode = "OUT";
    $kp = $kode . $newkodetr;

    $noutlet = strtolower(htmlspecialchars($_POST["noutlet"]));


    $ceknama = mysqli_query($conn, "SELECT * FROM companypanel WHERE nama ='$noutlet' ");

    if (mysqli_fetch_assoc($ceknama)) {
        echo "<script>
                alert('nama outlet sudah terdaftar');
                document.location.href = 'outlet';
            </script>";
        return false;
    }

    //query insert data
    $query = "INSERT INTO companypanel 
                VALUES 
                ('','$kp','$noutlet','','','','1')
            ";

    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST['inputjabatan'])) {

    $cekdata = mysqli_query($conn, "SELECT * FROM jabatan ");
    //cek ada data?
    if (mysqli_num_rows($cekdata) > 0) {
        $kodejabatan = query("SELECT * FROM jabatan ORDER BY id DESC LIMIT 1")[0];
        $kodes = substr($kodejabatan['kodejabatan'], 3);
        $noUrut = (int) $kodes;
        $noUrut++;
        $newkodetr = sprintf("%03s", $noUrut);
    } else {
        $newkodetr = "001";
    }

    $kode = "JAB";
    $kp = $kode . $newkodetr;

    $njabatan = strtolower(htmlspecialchars($_POST["njabatan"]));


    $ceknama = mysqli_query($conn, "SELECT * FROM jabatan WHERE namajabatan ='$njabatan' ");

    if (mysqli_fetch_assoc($ceknama)) {
        echo "<script>
                alert('nama jabatan sudah terdaftar');
                document.location.href = 'jabatan';
            </script>";
        return false;
    }

    //query insert data
    $query = "INSERT INTO jabatan 
                VALUES 
                ('','$kp','$njabatan','1')
            ";

    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST['inputkategoriproduk'])) {

    $cekdata = mysqli_query($conn, "SELECT * FROM kategoriproduk ");
    //cek ada data?
    if (mysqli_num_rows($cekdata) > 0) {
        $kodekategoriproduk = query("SELECT * FROM kategoriproduk ORDER BY id DESC LIMIT 1")[0];
        $kodes = substr($kodekategoriproduk['kodekategoriproduk'], 3);
        $noUrut = (int) $kodes;
        $noUrut++;
        $newkodetr = sprintf("%03s", $noUrut);
    } else {
        $newkodetr = "001";
    }

    $kode = "KAP";
    $kp = $kode . $newkodetr;

    $nkategoriproduk = strtolower(htmlspecialchars($_POST["nkategoriproduk"]));


    $ceknama = mysqli_query($conn, "SELECT * FROM kategoriproduk WHERE namakategoriproduk ='$nkategoriproduk' ");

    if (mysqli_fetch_assoc($ceknama)) {
        echo "<script>
                alert('nama kategoriproduk sudah terdaftar');
                document.location.href = 'kategoriproduk';
            </script>";
        return false;
    }

    //query insert data
    $query = "INSERT INTO kategoriproduk 
                VALUES 
                ('','$kp','$nkategoriproduk')
            ";

    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST['inputproduk'])) {

    $cekdata = mysqli_query($conn, "SELECT * FROM produk ");
    //cek ada data?
    if (mysqli_num_rows($cekdata) > 0) {
        $kodeproduk = query("SELECT * FROM produk ORDER BY id DESC LIMIT 1")[0];
        $kodes = substr($kodeproduk['kodeproduk'], 3);
        $noUrut = (int) $kodes;
        $noUrut++;
        $newkodetr = sprintf("%03s", $noUrut);
    } else {
        $newkodetr = "001";
    }

    $kode = "PRO";
    $kp = $kode . $newkodetr;

    $nkategoriproduk = htmlspecialchars($_POST["nkategoriproduk"]);
    $nproduk = strtolower(htmlspecialchars($_POST["nproduk"]));
    $nharga = htmlspecialchars($_POST["nharga"]);
    $ngambar = $_FILES["ngambar"];
    // var_dump($ngambar);

    $ekstensi_diperbolehkan    = array('png', 'jpg', 'jpeg');

    if ($ngambar['name'] != "") {
        $gambar = $ngambar['name'];
    } else {
        $gambar = "no_image.jpg";
    }
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));


    $gambar = uniqid();
    $gambar .= '.';
    $gambar .=   $ekstensi;






    $ukuran    = $ngambar['size'];
    $file_tmp = $ngambar['tmp_name'];

    // var_dump($gambar);
    // var_dump($x);
    // var_dump($ekstensi);
    // // var_dump($ukuran);
    // // var_dump($file_tmp);
    // die;


    $ceknama = mysqli_query($conn, "SELECT * FROM produk WHERE namaproduk ='$nproduk' ");

    if (mysqli_fetch_assoc($ceknama)) {
        echo 6;
        return false;
    }

    //query insert data


    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 2044070) {
            move_uploaded_file($file_tmp, '../assets/images/products/' . $gambar);
            $query = "INSERT INTO produk VALUES ('','$kp','$nkategoriproduk','$nproduk','$nharga','$gambar')";
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
} else if (isset($_POST['inputformpo'])) {

    $namabarang       = $_POST['namabarang'];
    $harga         = $_POST['harga'];
    $jumlah     = $_POST['jumlah'];
    $subtotal    = $_POST['subtotal'];
    $kodesupplier    = $_POST['supplier'];
    $total_keseluruhan    = $_POST['total_keseluruhan'];
    $namaoutlet = $_SESSION['outlet'];

    $kodeoutlet = query("SELECT kodeoutlet FROM companypanel WHERE nama = '$namaoutlet'")[0]['kodeoutlet'];
    // $outlet['kodeoutlet'];


    $total = count($namabarang);
    $dt_input = date('Y-m-d');
    $date = date('ymd');

    // isi noform

    // $result_noform = mysqli_query($conn, "SELECT id,No_form FROM form_po ORDER BY No_form DESC");
    // $ambil_noform = mysqli_fetch_row($result_noform);

    $ambil_noform = query("SELECT id,No_form FROM form_po ORDER BY No_form DESC");
    $pecah_po = substr($ambil_noform["0"]['No_form'], 0, 9);
    $pecah_po_b = substr($ambil_noform["0"]['No_form'], 9);


    // var_dump($ambil_noform);
    // var_dump($pecah_po);
    // var_dump($pecah_po_b);
    // die;


    if ($pecah_po == "FPO$date") {
        $pecah_po_b += 1;
        $pecah_po_b = sprintf("%03d", $pecah_po_b);
        $No_form = 'FPO' . $date . $pecah_po_b;
    } else {
        $No_form = 'FPO' . $date . '001';
    }
    //akhir isi noform
    // echo $No_form;
    // die;

    // bahan
    foreach ($namabarang as $row) {

        $sql = "SELECT * 
        FROM bahan 
        WHERE namabahan = '$row'
        ";
        $result = mysqli_query($conn, $sql);

        while ($d = mysqli_fetch_array($result)) {
            $kodebahan[] = $d['kodebahan'];
            // echo $kodebahan;
        }
    }

    // var_dump($kodebahan);
    // die;
    // input ke tabel form po


    mysqli_query($conn, "insert into form_po set
            No_form    = '$No_form',
            kodeoutlet      = '$kodeoutlet',
            kodesupplier = '$kodesupplier',
            date ='$dt_input',
            status = '1'
        ");

    // input ke tabel item po
    for ($i = 0; $i < $total; $i++) {

        mysqli_query($conn, "insert into item_po set
            No_form    = '$No_form',
            kodebahan      = '$kodebahan[$i]',
            qty = '$jumlah[$i]',
            harga ='$harga[$i]',
            subtotal = '$subtotal[$i]'
        ");
    }

    $result = mysqli_affected_rows($conn);



    //kembali ke halaman sebelumnya
    $_SESSION["msg"] = "$result";
    // header("Location: form-po.php?msg=" . urlencode('1'));

    header("location: ../purchasing/form-po.php");
} else if (isset($_POST['inputmenu'])) {

    $menu = $_POST['nmenu'];
    $url = $_POST['nurl'];

    $cekdata = mysqli_query($conn, "SELECT * FROM user_menu WHERE menu = '$menu'");

    if (mysqli_num_rows($cekdata) > 0) {
        echo 1;
    } else {
        $cekurl = mysqli_query($conn, "SELECT * FROM user_menu WHERE url = '$url'");
        if (mysqli_num_rows($cekurl) > 0) {
            echo 2;
        } else {
            $query = "INSERT INTO user_menu 
                        VALUES 
                        ('','$menu','$url','','')
                     ";
            $masuk_data = mysqli_query($conn, $query);
            if ($masuk_data) {
                echo 4;
            } else {
                echo 3;
            }
        }
    }
} else if (isset($_POST['inputsubmenu'])) {

    $mparent = $_POST['mparent'];
    $menu = $_POST['nmenu'];
    $url = $_POST['nurl'];


    $cekdata = mysqli_query($conn, "SELECT * FROM user_sub_menu WHERE title = '$menu'");

    if (mysqli_num_rows($cekdata) > 0) {
        echo 1;
    } else {
        $cekurl = mysqli_query($conn, "SELECT * FROM user_sub_menu WHERE url = '$url'");
        if (mysqli_num_rows($cekurl) > 0) {
            echo 2;
        } else {
            $query = "INSERT INTO user_sub_menu 
                        VALUES 
                        ('','$mparent','$menu','$url','','','')
                     ";
            $masuk_data = mysqli_query($conn, $query);
            if ($masuk_data) {
                echo 4;
            } else {
                echo 3;
            }
        }
    }
} else if (isset($_POST['inputformstore'])) {
    $namabarang       = $_POST['namabarang'];
    $harga         = $_POST['harga'];
    $jumlah     = $_POST['jumlah'];
    $subtotal    = $_POST['subtotal'];
    $total_keseluruhan    = $_POST['total_keseluruhan'];
    $namaoutlet = $_SESSION['outlet'];


    // var_dump($namabarang);
    // var_dump($harga);
    // var_dump($jumlah);
    // var_dump($subtotal);
    // die;
    $kodeoutlet = query("SELECT kodeoutlet FROM companypanel WHERE nama = '$namaoutlet'")[0]['kodeoutlet'];
    // $outlet['kodeoutlet'];


    $total = count($namabarang);
    $dt_input = date('Y-m-d');
    $date = date('ymd');

    // isi noform

    // $result_noform = mysqli_query($conn, "SELECT id,No_form FROM form_po ORDER BY No_form DESC");
    // $ambil_noform = mysqli_fetch_row($result_noform);

    $ambil_noform = query("SELECT id,No_form FROM form_storeproduk ORDER BY No_form DESC");
    $pecah_po = substr($ambil_noform["0"]['No_form'], 0, 9);
    $pecah_po_b = substr($ambil_noform["0"]['No_form'], 9);


    // var_dump($ambil_noform);
    // var_dump($pecah_po);
    // var_dump($pecah_po_b);
    // die;


    if ($pecah_po == "FSP$date") {
        $pecah_po_b += 1;
        $pecah_po_b = sprintf("%03d", $pecah_po_b);
        $No_form = 'FSP' . $date . $pecah_po_b;
    } else {
        $No_form = 'FSP' . $date . '001';
    }
    //akhir isi noform
    // echo $No_form;
    // die;

    // bahan
    foreach ($namabarang as $row) {

        $sql = "SELECT * 
        FROM produk 
        WHERE namaproduk = '$row'
        ";
        $result = mysqli_query($conn, $sql);

        while ($d = mysqli_fetch_array($result)) {
            $kodeproduk[] = $d['kodeproduk'];
            // echo $kodebahan;
        }
    }

    // var_dump($kodebahan);
    // die;
    // input ke tabel form po


    mysqli_query($conn, "insert into form_storeproduk set
            No_form    = '$No_form',
            kodeoutlet      = '$kodeoutlet',
            date ='$dt_input',
            status = '1'
        ");

    // input ke tabel item po
    for ($i = 0; $i < $total; $i++) {

        mysqli_query($conn, "insert into item_storeproduk set
            No_form    = '$No_form',
            kodeproduk      = '$kodeproduk[$i]',
            qty = '$jumlah[$i]',
            harga ='$harga[$i]',
            subtotal = '$subtotal[$i]'
        ");
    }

    $result = mysqli_affected_rows($conn);



    //kembali ke halaman sebelumnya
    $_SESSION["msg"] = "$result";
    // header("Location: form-po.php?msg=" . urlencode('1'));

    header("location: ../store/");
} else if (isset($_POST['inputformstorebahan'])) {

    $namabarang       = $_POST['namabarang'];
    $harga         = $_POST['harga'];
    $jumlah     = $_POST['jumlah'];
    $subtotal    = $_POST['subtotal'];
    $kodesupplier    = $_POST['supplier'];
    $total_keseluruhan    = $_POST['total_keseluruhan'];
    $namaoutlet = $_SESSION['outlet'];
    $kodeoutlet = $_SESSION['kodeoutlet'];


    // var_dump($kodeoutlet);
    var_dump($namabarang);
    // var_dump($harga);
    // var_dump($jumlah);
    // var_dump($subtotal);
    // var_dump($kodesupplier);

    // die;
    // $kodeoutlet = query("SELECT kodeoutlet FROM companypanel WHERE nama = '$namaoutlet'")[0]['kodeoutlet'];
    // $outlet['kodeoutlet'];


    $total = count($namabarang);
    $dt_input = date('Y-m-d');
    $date = date('ymd');

    // isi noform

    // $result_noform = mysqli_query($conn, "SELECT id,No_form FROM form_po ORDER BY No_form DESC");
    // $ambil_noform = mysqli_fetch_row($result_noform);

    $ambil_noform = query("SELECT id,No_form FROM form_storebahan ORDER BY No_form DESC");
    $pecah_po = substr($ambil_noform["0"]['No_form'], 0, 9);
    $pecah_po_b = substr($ambil_noform["0"]['No_form'], 9);


    // var_dump($ambil_noform);
    // var_dump($pecah_po);
    // var_dump($pecah_po_b);
    // die;


    if ($pecah_po == "FSB$date") {
        $pecah_po_b += 1;
        $pecah_po_b = sprintf("%03d", $pecah_po_b);
        $No_form = 'FSB' . $date . $pecah_po_b;
    } else {
        $No_form = 'FSB' . $date . '001';
    }
    //akhir isi noform
    var_dump($No_form);
    // die;


    // bahan
    foreach ($namabarang as $row) {

        $sql = "SELECT * 
        FROM bahan 
        WHERE namabahan = '$row'
        ";
        $result = mysqli_query($conn, $sql);

        while ($d = mysqli_fetch_array($result)) {
            $kodebahan[] = $d['kodebahan'];
            // echo $kodebahan;
        }
    }

    // var_dump($kodeproduk);

    // input ke tabel form po


    mysqli_query($conn, "insert into form_storebahan set
            No_form    = '$No_form',
            kodeoutlet      = '$kodeoutlet',
            kodesupplier = '$kodesupplier',
            Form_po = '0',
            date ='$dt_input'
            
        ");



    // var_dump($No_form);
    // var_dump($kodeoutlet);
    // var_dump($kodesupplier);
    // var_dump($dt_input);
    // die;
    // var_dump($No_form);


    // input ke tabel item po
    for ($i = 0; $i < $total; $i++) {

        mysqli_query($conn, "insert into item_storebahan set
            No_form    = '$No_form',
            kodebahan      = '$kodebahan[$i]',
            qty = '$jumlah[$i]',
            harga ='$harga[$i]',
            subtotal = '$subtotal[$i]'
        ");
    }

    $result = mysqli_affected_rows($conn);
    // var_dump($result);
    // die;


    //kembali ke halaman sebelumnya
    $_SESSION["msg"] = "$result";
    // header("Location: form-po.php?msg=" . urlencode('1'));

    header("location: ../store/store-bahan");
} elseif (isset($_POST['inputprodukmasuk'])) {
    $namaproduk       = $_POST['namaproduk'];
    $harga         = $_POST['harga'];
    $jumlah     = $_POST['jumlah'];
    $subtotal    = $_POST['subtotal'];
    // $kodesupplier    = $_POST['supplier'];
    $total_keseluruhan    = $_POST['total_keseluruhan'];
    $namaoutlet = $_SESSION['outlet'];

    $kodeoutlet = query("SELECT kodeoutlet FROM companypanel WHERE nama = '$namaoutlet'")[0]['kodeoutlet'];
    // $outlet['kodeoutlet'];
    // var_dump($kodeoutlet);


    $total = count($namaproduk);
    $dt_input = date('Y-m-d');
    $date = date('ymd');

    // isi noform

    // $result_noform = mysqli_query($conn, "SELECT id,No_form FROM form_po ORDER BY No_form DESC");
    // $ambil_noform = mysqli_fetch_row($result_noform);

    $ambil_noform = query("SELECT id,No_form FROM form_produkmasuk ORDER BY No_form DESC");
    $pecah_po = substr($ambil_noform["0"]['No_form'], 0, 9);
    $pecah_po_b = substr($ambil_noform["0"]['No_form'], 9);


    // var_dump($ambil_noform);
    // var_dump($pecah_po);
    // var_dump($pecah_po_b);
    // die;


    if ($pecah_po == "FPM$date") {
        $pecah_po_b += 1;
        $pecah_po_b = sprintf("%03d", $pecah_po_b);
        $No_form = 'FPM' . $date . $pecah_po_b;
    } else {
        $No_form = 'FPM' . $date . '001';
    }
    //akhir isi noform
    // echo $No_form;
    // die;

    // bahan
    foreach ($namaproduk as $row) {

        $sql = "SELECT * 
        FROM produk 
        WHERE namaproduk = '$row'
        ";
        $result = mysqli_query($conn, $sql);

        while ($d = mysqli_fetch_array($result)) {
            $kodeproduk[] = $d['kodeproduk'];
            // echo $kodebahan;
        }
    }

    // var_dump($kodebahan);
    // die;
    // input ke tabel form po


    mysqli_query($conn, "insert into form_produkmasuk set
            No_form    = '$No_form',
            date ='$dt_input',
            status = '1'
        ");

    // input ke tabel item po
    for ($i = 0; $i < $total; $i++) {
        mysqli_query($conn, "insert into item_produkmasuk set
            No_form    = '$No_form',
            kodeproduk      = '$kodeproduk[$i]',
            qty = '$jumlah[$i]',
            harga ='$harga[$i]',
            subtotal = '$subtotal[$i]'
        ");
    }

    $result = mysqli_affected_rows($conn);


    //kembali ke halaman sebelumnya
    $_SESSION["msg"] = "$result";
    // header("Location: form-po.php?msg=" . urlencode('1'));

    header("location: ../production/produk-masuk.php");
}
