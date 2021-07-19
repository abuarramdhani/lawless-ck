<?php

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
        $kodes = substr($kodesupplier['kodesupplier'], 1);
        $noUrut = (int) $kodes;
        $noUrut++;
        $newkodetr = sprintf("%03s", $noUrut);
    } else {
        $newkodetr = "001";
    }

    $kode = "S";
    $kp = $kode . $newkodetr;

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
                ('','$kp','$nsupplier','$nohp','$alamat')
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
                ('','$kp','$nbahan')
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
}
