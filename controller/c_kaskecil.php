<?php
$saldo_kas = query("SELECT saldo FROM kas WHERE id=1")[0];
$saldo_mutasi = $saldo_kas['saldo'];
$kaskecil = query("SELECT * FROM kas ORDER BY id DESC");

$kodeakune = query("SELECT * FROM kodeakun WHERE kodeakun2='52' OR kodeakun2='51' AND kodeakun3!='526' ORDER BY ketkode3 ASC");
$kodeakunp = query("SELECT * FROM kodeakun WHERE kodeakun3='433' OR kodeakun3='434' ORDER BY id ASC");

$bulansebelumnya = date('m', strtotime('-1 month', strtotime(date('Y-m-d'))));
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kas ")) === 1) {

    $kass = query("SELECT * FROM kas WHERE month(tanggal) ='03' ORDER BY id DESC LIMIT 1")[0];
    $saldokass = $kass["saldo"];
} else {
    $saldokass = 0;
}

if (isset($_POST["tampilkan"])) {
    $bulan = $_POST["bulan"];
    $tahun = $_POST["tahun"];

    if ($bulan === "Bulan") {
        header("location:index");
    }

    $kary = query("SELECT * FROM karyawan ORDER BY id ASC");
    $kaskecil = query("SELECT * FROM kas WHERE month(tanggal) ='$bulan' AND year(tanggal) ='$tahun' ORDER BY id DESC");
    $kas = query("SELECT * FROM kas WHERE month(tanggal) ='$bulan' AND year(tanggal) ='$tahun' ORDER BY id DESC LIMIT 1")[0];
    $saldokas = $kas["saldo"];    

    $jumlahi = "SELECT SUM(input) AS total_i FROM kas WHERE month(tanggal) ='$bulan' AND year(tanggal) ='$tahun'"; //perintah untuk menjumlahkan
    $hasili = mysqli_query($conn, $jumlahi); //melakukan query dengan varibel $jumlahkan
    $inp = mysqli_fetch_array($hasili); //menyimpan hasil query ke variabel $t
    $totali = $inp['total_i'];

    $jumlaho = "SELECT SUM(output) AS total_o FROM kas WHERE month(tanggal) ='$bulan' AND year(tanggal) ='$tahun'"; //perintah untuk menjumlahkan
    $hasilo = mysqli_query($conn, $jumlaho); //melakukan query dengan varibel $jumlahkan
    $out = mysqli_fetch_array($hasilo); //menyimpan hasil query ke variabel $t
    $totalo = $out['total_o'];

    if ($bulan != $month) {
        $jumlahsaldo = $totali - $totalo;
    } else {
        
        $kas = query("SELECT * FROM kas WHERE month(tanggal) ='$bulansebelumnya' ORDER BY id DESC LIMIT 1")[0];
        $saldokas = $kas["saldo"];
        $jumlahsaldo = $saldokas + ($totali - $totalo);
    }
} else {
    $jumlahi = "SELECT SUM(input) AS total_i FROM kas WHERE month(tanggal) ='$month' AND year(tanggal) ='$year'"; //perintah untuk menjumlahkan
    $hasili = mysqli_query($conn, $jumlahi); //melakukan query dengan varibel $jumlahkan
    $inp = mysqli_fetch_array($hasili); //menyimpan hasil query ke variabel $t
    $totali = $saldokass + $inp['total_i'];

    $jumlaho = "SELECT SUM(output) AS total_o FROM kas WHERE month(tanggal) ='$month' AND year(tanggal) ='$year'"; //perintah untuk menjumlahkan
    $hasilo = mysqli_query($conn, $jumlaho); //melakukan query dengan varibel $jumlahkan
    $out = mysqli_fetch_array($hasilo); //menyimpan hasil query ke variabel $t
    $totalo = $out['total_o'];

    $jumlahsaldo = $totali - $totalo;
}