<?php
$kodeoutlet = $_SESSION['kodeoutlet'];
if ($_SESSION['kodeoutlet'] == "OUT001" or $_SESSION['kodeoutlet'] == "OUT000") {
    if (isset($_POST['filter-date'])) {
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];


        $data = query("SELECT *, $tabel.status as status_form 
        FROM $tabel
        JOIN $tabel_join
        ON $tabel.kode$kode = $tabel_join.kode$kode
        WHERE date 
        WHERE $tabel.kodeoutlet ='$kodeoutlet' AND date 
        LIKE '$tahun-$bulan%'
        ORDER BY $tabel.id DESC
        ");
    } else {
        $data = query("SELECT *
        FROM $tabel
        JOIN $tabel_join
        ON $tabel.kode$kode = $tabel_join.kode$kode
        WHERE $tabel.kodeoutlet ='$kodeoutlet'
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
        if ($tabel_join == 'companypanel') {
            $data = query("SELECT $tabel.*, $tabel_join.nama
            FROM $tabel
            JOIN $tabel_join
            ON $tabel.kode$kode = $tabel_join.kode$kode
            -- WHERE $tabel.kodeoutlet ='$kodeoutlet'
            ORDER BY $tabel.id DESC");
        } else {
            $data = query("SELECT $tabel.*, $tabel_join.namasupplier
            FROM $tabel
            JOIN $tabel_join
            ON $tabel.kode$kode = $tabel_join.kode$kode
            -- WHERE $tabel.kodeoutlet ='$kodeoutlet'
            ORDER BY $tabel.id DESC");
        }
    }
}
