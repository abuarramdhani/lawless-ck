<?php
$kodeklienn = query("SELECT id, kodeklien, namaklien FROM klien ORDER BY namaklien ASC ");
$kp = $_GET["kp"];

$detpro = query("SELECT * FROM maintenance WHERE noproyek = '$kp' ")[0];
$noproyek = $detpro['noproyek'];
$kodeproyek = substr($detpro['noproyek'],0,7)."/SKUTRS/PP/".substr($detpro['noproyek'],7,2)."/".substr($detpro['noproyek'],9,2);
$kodeklien = $detpro["namaklien"];
$ka = query("SELECT * FROM klien WHERE kodeklien ='$kodeklien' ")[0];
$namaklien = $ka['namaklien'];

$bayarproyek = query("SELECT * FROM maintenance WHERE noproyek = '$kp' ")[0];

$jumlahi = "SELECT SUM(input) AS total_i FROM pembayaran WHERE kodeproyek ='$kp'"; //perintah untuk menjumlahkan
$hasili = mysqli_query($conn, $jumlahi); //melakukan query dengan varibel $jumlahkan
$inp = mysqli_fetch_array($hasili); //menyimpan hasil query ke variabel $t
$totali = $inp['total_i'];

$jumlahp = "SELECT SUM(output) AS total_p FROM pembayaran  WHERE kodeproyek ='$kp'"; //perintah untuk menjumlahkan
$hasilp = mysqli_query($conn, $jumlahp); //melakukan query dengan varibel $jumlahkan
$inpp = mysqli_fetch_array($hasilp); //menyimpan hasil query ke variabel $t
$totalp = $inpp['total_p'];

$dp = query("SELECT * FROM pembayaran WHERE kodeproyek = '$kp' ORDER BY tanggal DESC");
$cekpembayaran = mysqli_query($conn, "SELECT * FROM pembayaran WHERE kodekas = 'KBMP' AND kodeproyek = '$kp'");
$jumlahpembayaran = mysqli_num_rows($cekpembayaran);
$noUrut = (int) $jumlahpembayaran;
$noUrut++;
$nktr = sprintf("%01s", $noUrut);

if ($nktr == "01") {
    $ktr = "I";
} elseif ($nktr == "02") {
    $ktr = "II";
} elseif ($nktr == "03") {
    $ktr = "III";
} elseif ($nktr == "04") {
    $ktr = "IV";
} elseif ($nktr == "05") {
    $ktr = "V";
} elseif ($nktr == "06") {
    $ktr = "VI";
} elseif ($nktr == "07") {
    $ktr = "VII";
} elseif ($nktr == "08") {
    $ktr = "VIII";
} elseif ($nktr == "09") {
    $ktr = "IX";
} elseif ($nktr == "10") {
    $ktr = "X";
} elseif ($nktr == "11") {
    $ktr = "XI";
} elseif ($nktr == "12") {
    $ktr = "XII";
}