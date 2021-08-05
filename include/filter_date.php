<?php
$kodeoutlet = $_SESSION['kodeoutlet'];
if ($_SESSION['kodeoutlet'] == "OUT001" or $_SESSION['kodeoutlet'] == "OUT000") {
    if (isset($_POST['filter-date'])) {
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];


        $data = query("SELECT * 
        FROM $tabel
        JOIN $tabel_join
        ON $tabel.kode$kode = $tabel_join.kode$kode
        WHERE $tabel.kodeoutlet ='$kodeoutlet' AND date 
        LIKE '$tahun-$bulan%'
        ORDER BY $tabel.id DESC
        ");
    } else {
        $data = query("SELECT *
        FROM $tabel
        JOIN $tabel_join
        ON $tabel.kode$kode = $tabel_join.kode$kode
        ORDER BY $tabel.id DESC");
    }
} else {
    if (isset($_POST['filter-date'])) {
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        $data = query("SELECT * 
        FROM $tabel
        JOIN $tabel_join
        ON $tabel.kode$kode = $tabel_join.kode$kode
        WHERE  $tabel.kodeoutlet ='$kodeoutlet' and date 
        LIKE '$tahun-$bulan%'
        ORDER BY $tabel.id DESC
        ");
    } else if (!isset($_POST['filter-date'])) {
        $data = query("SELECT *
        FROM $tabel
        JOIN $tabel_join
        ON $tabel.kode$kode = $tabel_join.kode$kode
        WHERE $tabel.kodeoutlet ='$kodeoutlet'
        ORDER BY $tabel.id DESC");
    }
}
