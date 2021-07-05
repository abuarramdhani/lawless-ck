<?php
$kodeklienn = query("SELECT id, kodeklien, namaklien FROM klien ORDER BY namaklien ASC ");

if( isset($_POST["tp"]) ) {
    $tampilkanbulan = $_POST["bulan"];
    $tahun = $_POST["tahun"];

    $proyek = query("SELECT * FROM proyek WHERE noproyek != '' AND month(tanggalpjt) ='$tampilkanbulan' AND year(tanggalpjt) ='$tahun' ORDER BY id DESC");

    $jumlahi = "SELECT SUM(nilaiproyek) AS total_i FROM proyek WHERE noproyek != '' AND month(tanggalpjt) ='$tampilkanbulan' AND year(tanggalpjt) ='$tahun' "; //perintah untuk menjumlahkan
    $hasili = mysqli_query($conn, $jumlahi) ;//melakukan query dengan varibel $jumlahkan
    $inp = mysqli_fetch_array($hasili); //menyimpan hasil query ke variabel $t
    $totali = $inp['total_i'];

    $jumlahot = "SELECT SUM(input) AS total_ot FROM kasbesar WHERE kodekas ='KBMP' WHERE noproyek != '' AND month(tanggalpjt) ='$tampilkanbulan' AND year(tanggalpjt) ='$tahun' "; //perintah untuk menjumlahkan
    $hasilot = mysqli_query($conn, $jumlahot) ;//melakukan query dengan varibel $jumlahkan
    $inpot = mysqli_fetch_array($hasilot); //menyimpan hasil query ke variabel $t
    $totalot = $totali-$inpot['total_ot'];

    $jumlahsaldo = $totali;


}else{
    $proyek = query("SELECT * FROM proyek WHERE noproyek != '' ORDER BY id DESC");

    $jumlahi = "SELECT SUM(nilaiproyek) AS total_i FROM proyek   "; //perintah untuk menjumlahkan
    $hasili = mysqli_query($conn, $jumlahi) ;//melakukan query dengan varibel $jumlahkan
    $inp = mysqli_fetch_array($hasili); //menyimpan hasil query ke variabel $t
    $totali = $inp['total_i'];

    $jumlahot = "SELECT SUM(input) AS total_ot FROM pembayaran WHERE kodekas ='KBMP'"; //perintah untuk menjumlahkan
    $hasilot = mysqli_query($conn, $jumlahot) ;//melakukan query dengan varibel $jumlahkan
    $inpot = mysqli_fetch_array($hasilot); //menyimpan hasil query ke variabel $t
    $totalot = $totali-$inpot['total_ot'];
}