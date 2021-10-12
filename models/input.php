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
    $bank = htmlspecialchars($_POST["bank"]);
    $norek = htmlspecialchars($_POST["norek"]);

    $ceknama = mysqli_query($conn, "SELECT * FROM supplier WHERE namasupplier ='$nsupplier' and kodeoutlet ='$kodeoutlet' ");

    if (mysqli_fetch_assoc($ceknama)) {
        echo 4;
        return false;
    }

    //query insert data
    $query = "INSERT INTO supplier 
                VALUES 
                ('','$kodeoutlet','$kp','$nsupplier','$nohp','$alamat','$bank','$norek')
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
    $nhargabeli = strtolower(htmlspecialchars($_POST["nhargabeli"]));
    $nunit = $_POST["nunit"];


    $ceknama = mysqli_query($conn, "SELECT * FROM bahan WHERE namabahan ='$nbahan' and kodeoutlet ='$kodeoutlet' ");

    if (mysqli_fetch_assoc($ceknama)) {
        echo 4;
        return false;
    }

    //query insert data
    // $query = "INSERT INTO bahan 
    //             value 
    //             ('','$kodeoutlet','$kp','$nbahan','$nhargabeli','0','0','0')
    //         ";
    $query = "INSERT INTO bahan SET 
              kodeoutlet ='$kodeoutlet',
              kodebahan  = '$kp',
              namabahan = '$nbahan',
              unit = '$nunit',
              hargaj = '0',
              harga = '$nhargabeli',
              stok = '0',
              minstok = '0'

            ";

    $masuk_data = mysqli_query($conn, $query);
    // var_dump($masuk_data);
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
        echo 4;
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
        echo 2;
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
        echo 4;
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
    $nunit = htmlspecialchars($_POST["nunit"]);

    $ceknama = mysqli_query($conn, "SELECT * FROM produk WHERE namaproduk ='$nproduk' ");

    if (mysqli_fetch_assoc($ceknama)) {
        echo 6;
        return false;
    }

    $ngambar = $_FILES["ngambar"];
    if ($ngambar['name'] != "") {
        $gambar = $ngambar['name'];
    } else {
        $gambar = "no_image.jpg";
    }
    if (!empty($_FILES["ugambar"]['name'])) {

        // var_dump($ngambar);

        $ekstensi_diperbolehkan    = array('png', 'jpg', 'jpeg');


        $x = explode('.', $gambar);
        $ekstensi = strtolower(end($x));


        $gambar = uniqid();
        $gambar .= '.';
        $gambar .=   $ekstensi;

        $ukuran    = $ngambar['size'];
        $file_tmp = $ngambar['tmp_name'];
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            // if ($ukuran < 2044070) {
            if ($ukuran > 0) {
                move_uploaded_file($file_tmp, '../assets/images/products/' . $gambar);
                $query = "INSERT INTO produk VALUES ('','$kp','$nkategoriproduk','$nproduk','$nharga','$gambar','0','0','$nunit')";
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
    } else {
        $query = "INSERT INTO produk VALUES ('','$kp','$nkategoriproduk','$nproduk','$nharga','0','$gambar','0','0','$nunit')";
        $masuk_data = mysqli_query($conn, $query);
        if ($masuk_data) {
            echo 3;
        } else {
            echo 1;
        }
    }

    //query insert data



} else if (isset($_POST['inputformpo'])) {

    $namabarang       = $_POST['namabarang'];
    $kodebahan       = $_POST['kodebarang'];
    $harga         = $_POST['harga'];
    $jumlah     = $_POST['jumlah'];
    $unitbeli     = $_POST['unitbeli'];
    $subtotal    = $_POST['subtotal'];
    $kodesupplier    = $_POST['supplier'];
    $total_keseluruhan    = $_POST['total_keseluruhan'];
    $namaoutlet = $_SESSION['outlet'];

    $tanggal_manual = $_POST['tanggal_manual'];


    $kodeoutlet = query("SELECT kodeoutlet FROM companypanel WHERE nama = '$namaoutlet'")[0]['kodeoutlet'];
    // $outlet['kodeoutlet'];


    $total = count($namabarang);

    if ($tanggal_manual == null) {
        //tanggal auto
        $dt_input = date('Y-m-d');
        $date = date('ymd');
        //$dt_input = '2021-09-15';
        //$date = '210915';
    } else {
        // tanggal manual
        $tm = explode("/", $tanggal_manual);
        $dt_input = $tm[2] . '-' . $tm[0] . '-' . $tm[1];
        $tm_kata = str_split($tm[2]);
        $date = $tm_kata[2] . $tm_kata[3] . $tm[0] . $tm[1];
    }

    // isi noform


    // $ambil_noform = query("SELECT id,No_form FROM form_po ORDER BY No_form DESC");
    $ambil_noform = query("SELECT id,No_form,kodeoutlet FROM form_po where kodeoutlet = '$kodeoutlet' and No_form like 'FPO$date%' ORDER BY No_form DESC");
    $pecah_po = substr($ambil_noform["0"]['No_form'], 0, 9);
    $pecah_po_b = substr($ambil_noform["0"]['No_form'], 9);


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
    // foreach ($namabarang as $row) {

    //     $sql = "SELECT * 
    //     FROM bahan 
    //     WHERE namabahan = '$row'
    //     ";
    //     $result = mysqli_query($conn, $sql);

    //     while ($d = mysqli_fetch_array($result)) {
    //         $kodebahan[] = $d['kodebahan'];
    //         // echo $kodebahan;
    //     }
    // }
    //   ambil stok
    // foreach ($kodebahan as $row) {

    //     $sql = "SELECT stok 
    //     FROM barang 
    //     WHERE kodebarang = '$row'
    // ";
    //     $result = mysqli_query($conn, $sql);

    //     while ($d = mysqli_fetch_array($result)) {
    //         $stok[] = $d['stok'];
    //         // echo $kodebahan;
    //     }
    // }

    // for ($i = 0; $i < count($jumlah); $i++) {
    //     $t_stok[] = $stok[$i] + $jumlah[$i];
    // }
    // akhir stok

    // var_dump($kodebahan);
    // die;
    // input ke tabel form po

    // input ke tabel item po
    for ($i = 0; $i < $total; $i++) {

        // mysqli_query($conn, "UPDATE barang SET 
        // stok= '$t_stok[$i]' 
        // WHERE kodebarang='$kodebahan[$i]'");

        mysqli_query($conn, "insert into item_po set
                No_form    = '$No_form',
                kodeoutlet      = '$kodeoutlet',
                kodebahan      = '$kodebahan[$i]',
                qty = '$jumlah[$i]',
                harga ='$harga[$i]',
                unit ='$unitbeli[$i]',
                subtotal = '$subtotal[$i]'
            ");

        // var_dump($insert);die;
    }


    mysqli_query($conn, "insert into form_po set
                No_form    = '$No_form',
                kodeoutlet      = '$kodeoutlet',
                kodesupplier = '$kodesupplier',
                date ='$dt_input',
                status_ck = '2',
                status_ot = '1'
            ");



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
            $query = "INSERT INTO user_menu SET 
                       menu ='$menu',
                       url  = '$url'
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
    $kodebarang       = $_POST['kodebarang'];
    $harga         = $_POST['harga'];
    $jumlah     = $_POST['jumlah'];
    $unitbeli    = $_POST['unitbeli'];
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
    // foreach ($namabarang as $row) {

    //     $sql = "SELECT * 
    //     FROM produk 
    //     WHERE namaproduk = '$row'
    //     ";
    //     $result = mysqli_query($conn, $sql);

    //     while ($d = mysqli_fetch_array($result)) {
    //         $kodeproduk[] = $d['kodeproduk'];
    //         // echo $kodebahan;
    //     }
    // }

    //   ambil stok
    foreach ($kodebarang as $row) {

        $sql = "SELECT stok 
        FROM barang 
        WHERE kodebarang = '$row'
    ";
        $result = mysqli_query($conn, $sql);

        while ($d = mysqli_fetch_array($result)) {
            $stok[] = $d['stok'];
            // echo $kodebahan;
        }
    }

    for ($i = 0; $i < count($jumlah); $i++) {
        $t_stok[] = $stok[$i] - $jumlah[$i];
    }
    // akhir stok


    mysqli_query($conn, "insert into form_storeproduk set
            No_form    = '$No_form',
            kodeoutlet      = '$kodeoutlet',
            date ='$dt_input',
            status_ck = '0',
            status_ot = '0'
        ");

    // input ke tabel item po
    for ($i = 0; $i < $total; $i++) {

        mysqli_query($conn, "UPDATE barang SET 
        stok= '$t_stok[$i]' 
        WHERE kodebarang='$kodebarang[$i]'");

        mysqli_query($conn, "insert into item_storeproduk set
            No_form    = '$No_form',
            kodeproduk      = '$kodebarang[$i]',
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
    $unitjual    = $_POST['unitjual'];
    $kodebahan    = $_POST['kodebarang'];
    $kodesupplier = 'SUP000';
    $total_keseluruhan    = $_POST['total_keseluruhan'];
    $namaoutlet = $_SESSION['outlet'];
    $kodeoutlet = $_POST['outlet'];


    $tanggal_manual = $_POST['tanggal_manual'];

    if ($tanggal_manual == null) {
        //tanggal auto
        $dt_input = date('Y-m-d');
        $date = date('ymd');
        //$dt_input = '2021-09-15';
        //$date = '210915';
    } else {
        // tanggal manual
        $tm = explode("/", $tanggal_manual);
        $dt_input = $tm[2] . '-' . $tm[0] . '-' . $tm[1];
        $tm_kata = str_split($tm[2]);
        $date = $tm_kata[2] . $tm_kata[3] . $tm[0] . $tm[1];
    }


    $total = count($namabarang);
    // $dt_input = date('Y-m-d');
    // $date = date('ymd');

    // isi noform

    // $result_noform = mysqli_query($conn, "SELECT id,No_form FROM form_po ORDER BY No_form DESC");
    // $ambil_noform = mysqli_fetch_row($result_noform);

    $ambil_noform = query("SELECT id,No_form,kodeoutlet FROM form_po where kodeoutlet = '$kodeoutlet' and No_form like 'FPO$date%' ORDER BY No_form DESC");
    $pecah_po = substr($ambil_noform["0"]['No_form'], 0, 9);
    $pecah_po_b = substr($ambil_noform["0"]['No_form'], 9);


    if ($pecah_po == "FPO$date") {
        $pecah_po_b += 1;
        $pecah_po_b = sprintf("%03d", $pecah_po_b);
        $No_form = 'FPO' . $date . $pecah_po_b;
    } else {
        $No_form = 'FPO' . $date . '001';
    }
    //akhir isi noform
    // var_dump($ambil_noform);
    // die;


    // bahan
    // foreach ($namabarang as $row) {

    //     $sql = "SELECT * 
    //     FROM bahan 
    //     WHERE namabahan = '$row'
    //     ";
    //     $result = mysqli_query($conn, $sql);

    //     while ($d = mysqli_fetch_array($result)) {
    //         $kodebahan[] = $d['kodebahan'];
    //         // echo $kodebahan;
    //     }
    // }

    //   ambil stok
    // foreach ($kodebahan as $row) {

    //     $sql = "SELECT stok 
    //     FROM barang 
    //     WHERE kodebarang = '$row'
    // ";
    //     $result = mysqli_query($conn, $sql);

    //     while ($d = mysqli_fetch_array($result)) {
    //         $stok[] = $d['stok'];
    //         // echo $kodebahan;
    //     }
    // }

    // for ($i = 0; $i < count($jumlah); $i++) {
    //     $t_stok[] = $stok[$i] - $jumlah[$i];
    // }
    // akhir stok

    // // input ke tabel item po
    for ($i = 0; $i < $total; $i++) {

        // mysqli_query($conn, "UPDATE barang SET 
        // stok= '$t_stok[$i]' 
        // WHERE kodebarang='$kodebahan[$i]'");

        mysqli_query($conn, "insert into item_po set
No_form    = '$No_form',
 kodeoutlet      = '$kodeoutlet',
kodebahan      = '$kodebahan[$i]',
qty = '$jumlah[$i]',
harga ='$harga[$i]',
unit ='$unitjual[$i]',
subtotal = '$subtotal[$i]'
");
    }
    // input ke tabel form storebahan
    mysqli_query($conn, "insert into form_po set
    No_form    = '$No_form',
    kodeoutlet      = '$kodeoutlet',
    kodesupplier = '$kodesupplier',
    date ='$dt_input',
    status_ck = '2',
    status_ot = '1'
");

    $result = mysqli_affected_rows($conn);
    // var_dump($result);
    // die;

    // if ($result) {
    //     $subject = "Request Bahan";
    //     $email = 'admin@lawless-ck.net';
    //     include '../mail/storebahan.php';
    //     include '../models/sendmail.php';
    //     $mail->send();
    // }

    //kembali ke halaman sebelumnya
    $_SESSION["msg"] = "$result";
    // header("Location: form-po.php?msg=" . urlencode('1'));

    header("location: ../store/store-bahan");
} else if (isset($_POST['inputprodukmasuk'])) {
    $namabarang       = $_POST['namabarang'];
    $kodebarang       = $_POST['kodebarang'];
    $harga         = $_POST['harga'];
    $jumlah     = $_POST['jumlah'];
    $subtotal    = $_POST['subtotal'];
    $unitbeli    = $_POST['unitbeli'];
    $total_keseluruhan    = $_POST['total_keseluruhan'];

    $tanggal_manual = $_POST['tanggal_manual'];

    $namaoutlet = $_SESSION['outlet'];

    $kodeoutlet = query("SELECT kodeoutlet FROM companypanel WHERE nama = '$namaoutlet'")[0]['kodeoutlet'];


    if ($tanggal_manual == null) {
        //tanggal auto
        $dt_input = date('Y-m-d');
        $date = date('ymd');
        //$dt_input = '2021-09-15';
        //$date = '210915';
    } else {
        // tanggal manual
        $tm = explode("/", $tanggal_manual);
        $dt_input = $tm[2] . '-' . $tm[0] . '-' . $tm[1];
        $tm_kata = str_split($tm[2]);
        $date = $tm_kata[2] . $tm_kata[3] . $tm[0] . $tm[1];
    }

    $total = count($namabarang);
    // $dt_input = date('Y-m-d');
    // $date = date('ymd');
    // $dt_input = '2021-09-01';
    // $date = '210901';

    // isi noform

    // $result_noform = mysqli_query($conn, "SELECT id,No_form FROM form_po ORDER BY No_form DESC");
    // $ambil_noform = mysqli_fetch_row($result_noform);

    // $ambil_noform = query("SELECT id,No_form FROM form_produkmasuk ORDER BY No_form DESC");
    // $pecah_po = substr($ambil_noform["0"]['No_form'], 0, 9);
    // $pecah_po_b = substr($ambil_noform["0"]['No_form'], 9);

    //$tgl = strtotime("10/01/2021");
    //$date = date("ymd", $tgl);
    // echo $tgl = date("ymd", $tgl);
    $nopo = "FPM" . $date;
    $formpo = "SELECT * FROM form_produkmasuk WHERE kodeoutlet = '$kodeoutlet' AND No_form LIKE '%$nopo%'  ORDER BY id DESC LIMIT 1";
    $query = mysqli_query($conn, $formpo);
    $row = mysqli_fetch_array($query);

    $potong = substr($row['No_form'], 0, 9);
    $pecah_po_b = substr($row['No_form'], 9);
    $pecah_po_b += 1;
    $pecah_po_b = sprintf("%03d", $pecah_po_b);

    if ($row['No_form'] == "") {
        $No_form = 'FPM' . $date . '001';
    } else {
        $No_form = $nopo . $pecah_po_b;
    }
    // foreach ($formpo as $row) {
    //     $row['No_form'];
    //     $potong = substr($row['No_form'], 0, 9);
    //     $pecah_po_b = substr($row['No_form'], 9);
    //     $pecah_po_b += 1;
    //     $pecah_po_b = sprintf("%03d", $pecah_po_b);


    // }



    // if ($pecah_po == "FPM$date") {
    //     $pecah_po_b += 1;
    //     $pecah_po_b = sprintf("%03d", $pecah_po_b);
    //     $No_form = 'FPM' . $date . $pecah_po_b;
    // } else {
    //     $No_form = 'FPM' . $date . '001';
    // }
    //akhir isi noform
    // echo $No_form;
    // die;

    // bahan
    // foreach ($namaproduk as $row) {

    //     $sql = "SELECT * 
    //     FROM produk 
    //     WHERE namaproduk = '$row'
    //     ";
    //     $result = mysqli_query($conn, $sql);

    //     while ($d = mysqli_fetch_array($result)) {
    //         $kodeproduk[] = $d['kodeproduk'];
    //         // echo $kodebahan;
    //     }
    // }

    //   ambil stok
    foreach ($kodebarang as $row) {

        $sql = "SELECT stok 
        FROM barang 
        WHERE kodebarang = '$row'
    ";
        $result = mysqli_query($conn, $sql);

        while ($d = mysqli_fetch_array($result)) {
            $stok[] = $d['stok'];
            // echo $kodeproduk;
        }
    }

    for ($i = 0; $i < count($jumlah); $i++) {
        $t_stok[] = $stok[$i] + $jumlah[$i];
    }
    // akhir stok

    // var_dump($kodebahan);
    // die;
    // input ke tabel form po
    // input ke tabel item po
    for ($i = 0; $i < $total; $i++) {

        mysqli_query($conn, "UPDATE barang SET 
    stok= '$t_stok[$i]' 
    WHERE kodebarang='$kodebarang[$i]'");

        mysqli_query($conn, "insert into item_produkmasuk set
        No_form    = '$No_form',
        kodeproduk      = '$kodebarang[$i]',
        qty = '$jumlah[$i]',
        harga ='$harga[$i]',
        unit ='$unitbeli[$i]',
        subtotal = '$subtotal[$i]'
    ");
    }

    mysqli_query($conn, "insert into form_produkmasuk set
            No_form    = '$No_form',
            date ='$dt_input',
            kodeoutlet = '$kodeoutlet ',
            status_ot = '0',
            status_ck = '0'
        ");



    $result = mysqli_affected_rows($conn);


    //kembali ke halaman sebelumnya
    $_SESSION["msg"] = "$result";
    // header("Location: form-po.php?msg=" . urlencode('1'));

    header("location: ../production/produk-masuk.php");
} elseif (isset($_POST['inputformin'])) {

    $nopo = $_POST['noform'];
    $kodebahan = $_POST['kodebahan'];
    $harga = $_POST['harga'];
    $qty = $_POST['qty'];
    $unit = $_POST['unit'];
    $subtotal = $_POST['subtotal'];
    $kodesupplier = $_POST['kodesupplier'];

    $tgl_tempo = $_POST['tgl_tempo'];
    $tanggal_manual = $_POST['tanggal_manual'];

    if ($tgl_tempo == null) {
        if ($tanggal_manual == null) {
            //TANGGAL AUTO
            $tgl_tempo = date('Y-m-d');
        } else {
            //TANGGAL MANUAL
            $tm = explode("/", $tanggal_manual);
            $tgl_tempo = $tm[2] . '-' . $tm[0] . '-' . $tm[1];
        }

        $jatuhtempo = date('Y-m-d', strtotime('+14 days', strtotime($tgl_tempo)));
    } else {
        $day = explode('/', $tgl_tempo);
        $day1 = $day[1];
        $dt = array($day[2], $day[0], $day[1]);
        $jatuhtempo = implode("-", $dt);
    }


    //cek apakah harga terjadi perubahan
    for ($i = 0; $i < count($harga); $i++) {
        $cekharga[] =  query("SELECT hargabeli FROM barang WHERE kodebarang = '$kodebahan[$i]'");
        if ($cekharga[$i][0]['hargabeli'] > $harga) {
            $harga = $cekharga[$i]['hargabeli'];
        } else {
            $harga = $harga;
        }
    }
    // akhir cek




    // $total = count($namabarang);

    // $noin = str_replace("PO", "IN", $nopo);
    $namaoutlet = $_SESSION['outlet'];

    $kodeoutlet = query("SELECT kodeoutlet FROM companypanel WHERE nama = '$namaoutlet'")[0]['kodeoutlet'];

    //tanggal manual
    if ($tanggal_manual == null) {
        // tanggal auto
        $dt_input = date('Y-m-d');
        $date = date('ymd');
    } else {
        // tanggal manual
        $tm = explode("/", $tanggal_manual);
        $dt_input = $tm[2] . '-' . $tm[0] . '-' . $tm[1];
        $tm_kata = str_split($tm[2]);
        $date = $tm_kata[2] . $tm_kata[3] . $tm[0] . $tm[1];
    }

    //ambil noform 
    $ambil_noform = query("SELECT id,No_form,kodeoutlet FROM form_in where kodeoutlet = '$kodeoutlet' and No_form like 'FIN$date%' ORDER BY No_form DESC");
    $pecah_po = substr($ambil_noform["0"]['No_form'], 0, 9);
    $pecah_po_b = substr($ambil_noform["0"]['No_form'], 9);


    if ($pecah_po == "FIN$date") {

        $pecah_po_b += 1;
        $pecah_po_b = sprintf("%03d", $pecah_po_b);
        $No_form = 'FIN' . $date . $pecah_po_b;
    } else {
        $No_form = 'FIN' . $date . '001';
    }
    // akhir ambil no form

    //   ambil stok
    foreach ($kodebahan as $row) {

        $sql = "SELECT stok 
        FROM barang 
        WHERE kodebarang = '$row'
    ";
        $result = mysqli_query($conn, $sql);

        while ($d = mysqli_fetch_array($result)) {
            $stok[] = $d['stok'];
            // echo $kodebahan;
        }
    }

    for ($i = 0; $i < count($qty); $i++) {
        $t_stok[] = $qty[$i] + $stok[$i];
    }
    // akhir stok
    for ($i = 0; $i < count($kodebahan); $i++) {
        mysqli_query($conn, "UPDATE barang SET hargabeli='$harga[$i]', stok= '$t_stok[$i]' WHERE kodebarang='$kodebahan[$i]'");
        mysqli_query($conn, "INSERT INTO item_in SET
         No_form = '$No_form' ,
         kodeoutlet = '$kodeoutlet',
         kodebahan = '$kodebahan[$i]', 
         qty = '$qty[$i]', 
         harga = '$harga[$i]', 
         subtotal = '$subtotal[$i]',
         unit = '$unit[$i]'
         ");
    }
    mysqli_query($conn, "insert into form_in set
            No_form    = '$No_form',
            Form_po = '$nopo',
            kodeoutlet = '$kodeoutlet',
            kodesupplier = '$kodesupplier',
            date ='$dt_input',
            jatuhtempo ='$jatuhtempo',
            status_ot = '0',
            status_ck = '0'
        ");

    // var_dump($nopo);
    // die;

    $result = mysqli_affected_rows($conn);

    if ($result) {
        mysqli_query($conn, "UPDATE form_po SET status_ot='2' WHERE No_form='$nopo'");
    }

    //kembali ke halaman sebelumnya
    $_SESSION["msg"] = "$result";
    header("Location: ../purchasing/index");
} else if (isset($_POST['tambah-user'])) {


    $name = $_POST['name'];
    $email = $_POST['email'];
    $outlet = $_POST['outlet'];
    $jabatan = $_POST['jabatan'];


    $cekdata = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'");

    if (mysqli_num_rows($cekdata) > 0) {
        echo 1;
    } else {
        $query = "INSERT INTO admin SET 
                       username ='$name',
                       email  = '$email',
                       outlet = '$outlet',
                       jabatan = '$jabatan',
                       userlevel = '1'
                     ";
        $result = mysqli_query($conn, $query);



        if ($result) {
            // echo 3;
            $subject = "PENDAFTARAN AKUN";
            $email = $email;

            $mailhost1 = "mail.lawless-ck.net";
            $username1 = "admin@lawless-ck.net";
            $password1 = "ck123!!@@##";
            $setfrom1 = "Lawless HO Office";



            $secret = '#$eCr37';
            $token = MD5($email . $secret);
            $link = query("SELECT baseurl FROM companypanel WHERE kodeoutlet = '$outlet'")[0]['baseurl'];
            // var_dump($_SERVER['HTTP_HOST']);
            // var_dump($link);
            // die;
            if ($_SERVER['HTTP_HOST'] != "localhost") {
                $linkhref = "https://$link.net/confirm?email=$email&token=$token";
            } else {
                $linkhref = "localhost/lawless-ck/confirm?email=$email&token=$token";
            }


            include '../mail/mail_confirmpass.php';
            include '../models/sendmail.php';
            if ($mail->send()) {
                echo 3;
            } else {
                echo 2;
            }
        }
    }
} elseif (isset($_POST['create-password'])) {
    $email = $_POST['_email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $update = mysqli_query($conn, "UPDATE admin SET password='$password' WHERE email='$email'");
    if ($update) {
        echo true;
    } else {
        echo false;
    }
} elseif (isset($_POST['reset-password'])) {
    $email = $_POST['email'];
    $outlet = $_POST['kodeoutlet'];
    //var_dump($outlet);

    // $mailhost1 = "mail.lawless-ck.net";
    // $username1 = "admin@lawless-ck.net";
    // $password1 = "ck123!!@@##";
    // $setfrom1 = "Lawless HO Office";
    $mailer = query("SELECT * FROM mailer WHERE kodeoutlet = '$outlet'")[0];
    $mailhost1 = $mailer['mailhost1'];
    $username1 = $mailer['username1'];
    $password1 = $mailer['password1'];
    $setfrom1 = $mailer['setfrom1'];


    $check = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        $subject = "RESET PASSWORD";
        $key = '#$eCr37';
        $token = md5($email . $key);

        $link = query("SELECT baseurl FROM companypanel WHERE kodeoutlet = '$outlet'")[0]['baseurl'];

        var_dump($link);
        $linkhref = "localhost/lawless-ck/confirm?email=$email&token=$token";
        if ($_SERVER['HTTP_HOST'] != "localhost") {
            $linkhref = "https://$link.net/confirm?email=$email&token=$token";
        } else {
            $linkhref = "localhost/lawless-ck/confirm?email=$email&token=$token";
        }

        include '../mail/recovery.php';
        include '../models/sendmail.php';
        if ($mail->send()) {
            echo 1;
        } else {
            echo 2;
        }
    } else {
        echo 3;
    }
} elseif (isset($_POST['requestbahan'])) {
    $namabahan = $_POST['namabahan'];
    $harga         = $_POST['harga'];
    $jumlah     = $_POST['jumlah'];
    $subtotal    = $_POST['subtotal'];
    $kodebarang    = $_POST['kodebarang'];
    $unit    = $_POST['kodeunit'];
    // $kodeoutlet = 'OUT002';
    $namaoutlet = $_SESSION['outlet'];
    $kodeoutlet = query("SELECT kodeoutlet FROM companypanel WHERE nama = '$namaoutlet'")[0]['kodeoutlet'];
    $tanggal_manual = $_POST['tanggal_manual'];

    if ($tanggal_manual == null) {
        //tanggal auto
        $dt_input = date('Y-m-d');
        $date = date('ymd');
        //$dt_input = '2021-09-15';
        //$date = '210915';
    } else {
        // tanggal manual
        $tm = explode("/", $tanggal_manual);
        $dt_input = $tm[2] . '-' . $tm[0] . '-' . $tm[1];
        $tm_kata = str_split($tm[2]);
        $date = $tm_kata[2] . $tm_kata[3] . $tm[0] . $tm[1];
    }

    $total = count($namabahan);
    // $dt_input = date('Y-m-d');
    // $date = date('ymd');


    // isi noform
    $nopo = "FSB" . $date;
    $ambil_noform = "SELECT * FROM form_storebahan WHERE kodeoutlet = '$kodeoutlet' AND No_form LIKE '%$nopo%'  ORDER BY id DESC LIMIT 1";
    $query = mysqli_query($conn, $ambil_noform);
    $row = mysqli_fetch_array($query);

    $potong = substr($row['No_form'], 0, 9);
    $pecah_po_b = substr($row['No_form'], 9);
    $pecah_po_b += 1;
    $pecah_po_b = sprintf("%03d", $pecah_po_b);

    if ($row['No_form'] == "") {
        $No_form = 'FSB' . $date . '001';
    } else {
        $No_form = $nopo . $pecah_po_b;
    }

    // $ambil_noform = query("SELECT id,No_form FROM form_storebahan ORDER BY No_form DESC");
    // $pecah_po = substr($ambil_noform["0"]['No_form'], 0, 9);
    // $pecah_po_b = substr($ambil_noform["0"]['No_form'], 9);


    // if ($pecah_po == "FSB$date") {
    //     $pecah_po_b += 1;
    //     $pecah_po_b = sprintf("%03d", $pecah_po_b);
    //     $No_form = 'FSB' . $date . $pecah_po_b;
    // } else {
    //     $No_form = 'FSB' . $date . '001';
    // }
    //akhir isi noform


    // bahan
    // foreach ($namabahan as $row) {

    //     $sql = "SELECT * 
    //     FROM bahan 
    //     WHERE namabahan = '$row'
    //     ";
    //     $result = mysqli_query($conn, $sql);

    //     while ($d = mysqli_fetch_array($result)) {
    //         $kodebahan[] = $d['kodebahan'];
    //         // echo $kodebahan;
    //     }
    // }

    //   ambil stok
    foreach ($kodebarang as $row) {

        $sql = "SELECT stok 
        FROM barang 
        WHERE kodebarang = '$row'
    ";
        $result = mysqli_query($conn, $sql);

        while ($d = mysqli_fetch_array($result)) {
            $stok[] = $d['stok'];
            // echo $kodebahan;
        }
    }

    for ($i = 0; $i < count($jumlah); $i++) {
        $t_stok[] = $stok[$i] - $jumlah[$i];
    }

    
    // akhir stok
    

    // input ke tabel item po
    for ($i = 0; $i < $total; $i++) {
        // var_dump($No_form);
        // var_dump($kodebarang[$i]);
        // var_dump($t_stok[$i]);
        // var_dump($jumlah[$i]);
        // var_dump($harga[$i]);
        // var_dump($unit[$i]);
        // var_dump($subtotal[$i]);
        // die;

        mysqli_query($conn, "UPDATE barang SET 
        stok= '$t_stok[$i]' 
        WHERE kodebarang='$kodebarang[$i]'");

        mysqli_query($conn, "insert into item_storebahan set
            No_form    = '$No_form',
            kodebahan      = '$kodebarang[$i]',
            qty = '$jumlah[$i]',
            harga ='$harga[$i]',
            unit ='$unit[$i]',
            subtotal = '$subtotal[$i]'
        ");
    }
    // input ke tabel form storebahan
    mysqli_query($conn, "insert into form_storebahan set
     No_form    = '$No_form',
     kodeoutlet      = '$kodeoutlet',
     Form_po = '0',
     date ='$dt_input',
     status_ot ='0',
     status_ck ='0'
     
 ");

    $result = mysqli_affected_rows($conn);

    // if ($result) {
    //     $subject = "Request Bahan";
    //     $email = 'admin@lawless-ck.net';
    //     include '../mail/storebahan.php';
    //     include '../models/sendmail.php';
    //     $mail->send();
    // }

    //kembali ke halaman sebelumnya
    $_SESSION["msg"] = "$result";
    // header("Location: form-po.php?msg=" . urlencode('1'));

    header("location: ../production/request-bahan");
} else if (isset($_POST['inputbank'])) {

    $cekdata = mysqli_query($conn, "SELECT * FROM namabank ");
    //cek ada data?
    if (mysqli_num_rows($cekdata) > 0) {
        $kodebank = query("SELECT * FROM namabank ORDER BY id DESC LIMIT 1")[0];
        $kodes = substr($kodebank['kodebank'], 3);
        $noUrut = (int) $kodes;
        $noUrut++;
        $newkodetr = sprintf("%03s", $noUrut);
    } else {
        $newkodetr = "001";
    }

    $kode = "BAN";
    $kp = $kode . $newkodetr;

    $nbank = htmlspecialchars($_POST["nbank"]);


    $ceknama = mysqli_query($conn, "SELECT * FROM namabank WHERE namabank ='$nbank' ");

    if (mysqli_fetch_assoc($ceknama)) {
        echo "<script>
                alert('nama unit sudah terdaftar');
                document.location.href = 'unit';
            </script>";
        return false;
    }

    //query insert data
    $query = "INSERT INTO namabank 
                VALUES 
                ('','$kp','$nbank')
            ";

    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST['inputpackage'])) {

    $cekdata = mysqli_query($conn, "SELECT * FROM package ");
    //cek ada data?
    if (mysqli_num_rows($cekdata) > 0) {
        $kodepackage = query("SELECT * FROM package ORDER BY id DESC LIMIT 1")[0];
        $kodes = substr($kodepackage['kodepackage'], 3);
        $noUrut = (int) $kodes;
        $noUrut++;
        $newkodetr = sprintf("%03s", $noUrut);
    } else {
        $newkodetr = "001";
    }

    $kode = "PAC";
    $kp = $kode . $newkodetr;

    $npackage = strtolower(htmlspecialchars($_POST["npackage"]));
    $nhargabeli = strtolower(htmlspecialchars($_POST["nhargabeli"]));
    $nunit = $_POST["nunit"];


    $ceknama = mysqli_query($conn, "SELECT * FROM package WHERE namapackage ='$npackage'");

    if (mysqli_fetch_assoc($ceknama)) {
        echo 4;
        return false;
    }

    //query insert data
    // $query = "INSERT INTO package 
    //             value 
    //             ('','$kodeoutlet','$kp','$npackage','$nhargabeli','0','0','0')
    //         ";
    $query = "INSERT INTO package SET 
              kodepackage  = '$kp',
              namapackage = '$npackage',
              unit = '$nunit',
              hargaj = '0',
              harga = '$nhargabeli',
              stok = '0',
              minstok = '0'

            ";

    $masuk_data = mysqli_query($conn, $query);
    // var_dump($masuk_data);
    if ($masuk_data) {
        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST['inputformstorepackage'])) {

    $namapackage       = $_POST['namapackage'];
    $harga         = $_POST['harga'];
    $jumlah     = $_POST['jumlah'];
    $subtotal    = $_POST['subtotal'];
    $total_keseluruhan    = $_POST['total_keseluruhan'];
    $namaoutlet = $_SESSION['outlet'];
    $kodeoutlet = $_SESSION['kodeoutlet'];

    $kodepackage = $_POST['kodepackage'];

    $total = count($namapackage);
    $dt_input = date('Y-m-d');
    $date = date('ymd');

    $ambil_noform = query("SELECT id,No_form FROM form_storepackage ORDER BY No_form DESC");
    $pecah_po = substr($ambil_noform["0"]['No_form'], 0, 9);
    $pecah_po_b = substr($ambil_noform["0"]['No_form'], 9);


    if ($pecah_po == "FSK$date") {
        $pecah_po_b += 1;
        $pecah_po_b = sprintf("%03d", $pecah_po_b);
        $No_form = 'FSK' . $date . $pecah_po_b;
    } else {
        $No_form = 'FSK' . $date . '001';
    }


    //   ambil stok
    foreach ($kodepackage as $row) {

        $sql = "SELECT stok 
        FROM package 
        WHERE kodepackage = '$row'
    ";
        $result = mysqli_query($conn, $sql);

        while ($d = mysqli_fetch_array($result)) {
            $stok[] = $d['stok'];
            // echo $kodebahan;
        }
    }

    for ($i = 0; $i < count($jumlah); $i++) {
        $t_stok[] = $stok[$i] - $jumlah[$i];
    }
    // akhir stok

    // // input ke tabel item po
    for ($i = 0; $i < $total; $i++) {

        mysqli_query($conn, "UPDATE package SET 
        stok= '$t_stok[$i]' 
        WHERE kodepackage='$kodepackage[$i]'");

        mysqli_query($conn, "insert into item_storepackage set
            No_form    = '$No_form',
            kodepackage      = '$kodepackage[$i]',
            qty = '$jumlah[$i]',
            harga ='$harga[$i]',
            subtotal = '$subtotal[$i]'
        ");
    }
    // input ke tabel form storebahan
    mysqli_query($conn, "insert into form_storepackage set
         No_form    = '$No_form',
         kodeoutlet      = '$kodeoutlet',
         date ='$dt_input',
         status ='0'

     ");

    $result = mysqli_affected_rows($conn);
    // var_dump($result);
    // die;

    // if ($result) {
    //     $subject = "Request Bahan";
    //     $email = 'admin@lawless-ck.net';
    //     include '../mail/storebahan.php';
    //     include '../models/sendmail.php';
    //     $mail->send();
    // }

    //kembali ke halaman sebelumnya
    $_SESSION["msg"] = "$result";
    // header("Location: form-po.php?msg=" . urlencode('1'));

    header("location: ../store/storepackage");
} else if (isset($_POST['inputformretur'])) {

    $namabarang       = $_POST['namabarang'];
    $kodebahan       = $_POST['kodebarang'];
    $harga         = $_POST['harga'];
    $jumlah     = $_POST['jumlah'];
    $subtotal    = $_POST['subtotal'];
    // $kodesupplier    = $_POST['supplier'];
    $total_keseluruhan    = $_POST['total_keseluruhan'];
    $namaoutlet = $_SESSION['outlet'];
    $kodeoutlet = $_SESSION['kodeoutlet'];

    $total = count($namabarang);
    $dt_input = date('Y-m-d');
    $date = date('ymd');

    // var_dump($total);
    $ambil_noform = query("SELECT id,No_form,kodeoutlet FROM form_returbahan WHERE kodeoutlet = '$kodeoutlet' and No_form like 'FRB$date%' ORDER BY No_form DESC");
    $pecah_po = substr($ambil_noform["0"]['No_form'], 0, 9);
    $pecah_po_b = substr($ambil_noform["0"]['No_form'], 9);


    if ($pecah_po == "FRB$date") {
        $pecah_po_b += 1;
        $pecah_po_b = sprintf("%03d", $pecah_po_b);
        $No_form = 'FRB' . $date . $pecah_po_b;
    } else {
        $No_form = 'FRB' . $date . '001';
    }


    //   ambil stok
    foreach ($kodebahan as $row) {

        $sql = "SELECT stok 
        FROM bahan 
        WHERE kodebahan = '$row'
    ";
        $result = mysqli_query($conn, $sql);

        while ($d = mysqli_fetch_array($result)) {
            $stok[] = $d['stok'];
            // echo $kodebahan;
        }
    }
    //   ambil stok
    for ($i = 0; $i < $total; $i++) {

        $result = mysqli_query($conn, "SELECT stok FROM bahan 
        WHERE kodeoutlet='$kodeoutlet' and namabahan='$namabarang[$i]'");
        while ($d = mysqli_fetch_array($result)) {
            $stokk[] = $d['stok'];
            // echo $kodebahan;
        }
    }


    for ($i = 0; $i < count($jumlah); $i++) {
        $t_stok[] = $stok[$i] + $jumlah[$i];
    }
    // akhir stok
    for ($i = 0; $i < count($jumlah); $i++) {
        $tkurang_stok[] = $stokk[$i] - $jumlah[$i];
    }
    // akhir stok


    // // input ke tabel item po
    for ($i = 0; $i < $total; $i++) {

        mysqli_query($conn, "UPDATE bahan SET 
        stok= '$t_stok[$i]' 
        WHERE kodebahan='$kodebahan[$i]'");

        mysqli_query($conn, "UPDATE bahan SET 
          stok= '$tkurang_stok[$i]' 
          WHERE kodeoutlet='$kodeoutlet' and namabahan='$namabarang[$i]'");

        mysqli_query($conn, "insert into item_returbahan set
            No_form    = '$No_form',
            kodeoutlet      = '$kodeoutlet',
            kodebahan      = '$kodebahan[$i]',
            qty = '$jumlah[$i]',
            harga ='$harga[$i]',
            subtotal = '$subtotal[$i]'
        ");
    }
    // input ke tabel form storebahan
    mysqli_query($conn, "insert into form_returbahan set
         No_form    = '$No_form',
         kodeoutlet      = '$kodeoutlet',
         Form_po = '0',
         date ='$dt_input',
         status_ot ='0',
         status_ck ='0'

     ");

    $result = mysqli_affected_rows($conn);
    // var_dump($result);
    // die;

    // if ($result) {
    //     $subject = "Request Bahan";
    //     $email = 'admin@lawless-ck.net';
    //     include '../mail/storebahan.php';
    //     include '../models/sendmail.php';
    //     $mail->send();
    // }

    //kembali ke halaman sebelumnya
    $_SESSION["msg"] = "$result";
    // header("Location: form-po.php?msg=" . urlencode('1'));

    header("location: ../store/retur");
} else if (isset($_POST['inputbarang'])) {

    // $data = [
    //     'kodeoutlet'       => $_POST['kodeoutlet'],
    //     'kategoribarang'       => $_POST['kategoribarang'],
    //     'subkategoribarang'       => $_POST['subkategoribarang'],
    //     'nbarang'       => $_POST['nbarang'],
    //     'hargabeli'       => $_POST['hargabeli'],
    //     'nunit'       => $_POST['nunit'],
    //     'stok'       => $_POST['stok'],
    //     'hargajual1'       => $_POST['hargajual1'],
    //     'hargajual2'       => $_POST['hargajual2'],
    //     'nunitjual'       => $_POST['nunitjual'],
    //     'minstok'       => $_POST['minstok']
    // ];
    // print_r($_POST);die;
    $kodeoutlet       = $_POST['kodeoutlet'];
    $kategoribarang       = $_POST['kategoribarang'];
    $subkategoribarang       = $_POST['subkategoribarang'];
    $nbarang       = $_POST['nbarang'];
    $hargabeli       = $_POST['hargabeli'];
    $nunit       = $_POST['nunit'];
    $stok       = $_POST['stok'];
    $hargajual1       = $_POST['hargajual1'];
    $hargajual2       = $_POST['hargajual2'];
    $nunitjual       = $_POST['nunitjual'];
    $minstok       = $_POST['minstok'];
    $status       = $_POST['status'];
    // echo $status;die;
    $cekdata = mysqli_query($conn, "SELECT * FROM barang ");
    //cek ada data?
    if (mysqli_num_rows($cekdata) > 0) {
        $kodeproduk = query("SELECT * FROM barang ORDER BY id DESC LIMIT 1")[0];
        $kodes = substr($kodeproduk['kodebarang'], 3);
        $noUrut = (int) $kodes;
        $noUrut++;
        $newkodetr = sprintf("%03s", $noUrut);
    } else {
        $newkodetr = "001";
    }

    $kode = "BAR";
    $kb = $kode . $newkodetr;

    $query = "INSERT INTO barang SET 
    kodeoutlet = '$kodeoutlet',
    kategoribarang = '$kategoribarang',
    subkatbarang = '$subkategoribarang',
    kodebarang = '$kb',
    namabarang = '$nbarang',
    hargabeli = '$hargabeli',
    unitbeli = '$nunit',
    stok = '$stok',
    hargajual1 = '$hargajual1',
    hargajual2 = '$hargajual2',
    unitjual = '$nunitjual',
    minstok = '$minstok',
    status = '$status'

 ";

    $masuk_data = mysqli_query($conn, $query);
    // var_dump($query);die;
    if ($masuk_data) {
        echo 3;
    } else {
        echo 1;
    }
} elseif (isset($_POST['inputkategoribarang'])) {
    $cekdata = mysqli_query($conn, "SELECT * FROM kategoribarang");
    if (mysqli_num_rows($cekdata) > 0) {
        $kodekategoribarang = query("SELECT * FROM kategoribarang ORDER BY id DESC LIMIT 1")[0];
        $kodes = substr($kodekategoribarang['kodekategoribarang'], 3);
        $noUrut = (int) $kodes;
        $noUrut++;
        $newkodetr = sprintf("%03s", $noUrut);
    } else {
        $newkodetr = "001";
    }

    $kode = "KAB";
    $kb = $kode . $newkodetr;

    $nkategoribarang = strtolower(htmlspecialchars($_POST['nkategoribarang']));
    $ceknama = mysqli_query($conn, "SELECT * FROM kategoribarang WHERE namakategoribarang = '$nkategoribarang'");
    if (mysqli_fetch_assoc($ceknama)) {
        echo 4;
        return false;
    }

    $query = "INSERT INTO kategoribarang VALUE ('', '$kb', '$nkategoribarang')";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {
        echo 3;
    } else {
        echo 1;
    }
} elseif (isset($_POST['inputsubkatbarang'])) {
    $nkategoribarang = $_POST['nkategoribarang'];
    $nsubkatbarang = strtolower(htmlspecialchars($_POST['nsubkatbarang']));

    $kategoribarang = query("SELECT * FROM kategoribarang WHERE kodekategoribarang ='$nkategoribarang'")[0];
    $kodekat = substr($kategoribarang['namakategoribarang'], 0, 1);
    $kode = "CK" . $kodekat;
    $kodecek = $kode . "%";

    $cekdata = mysqli_query($conn, "SELECT * FROM subkatbarang WHERE kodesubkatbarang LIKE '$kodecek'");

    if (mysqli_num_rows($cekdata) > 0) {
        $kodesubkategoribarang = query("SELECT * FROM subkatbarang WHERE kodesubkatbarang LIKE '$kodecek' ORDER BY id DESC LIMIT 1")[0];
        $kodes = substr($kodesubkategoribarang['kodesubkatbarang'], 3);
        $noUrut = (int) $kodes;
        $noUrut++;
        $newkodetr = sprintf("%03s", $noUrut);
    } else {
        $newkodetr = "001";
    }

    $ksb = $kode . $newkodetr;

    $ceknama = mysqli_query($conn, "SELECT * FROM subkatbarang WHERE namasubkatbarang = '$nsubkatbarang'");
    if (mysqli_fetch_assoc($ceknama)) {
        echo 4;
        return false;
    }

    $query = "INSERT INTO subkatbarang VALUE ('', '$nkategoribarang', '$ksb', '$nsubkatbarang')";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {
        echo 3;
    } else {
        echo 1;
    }
}