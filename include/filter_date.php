<?php
$kodeoutlet = $_SESSION['kodeoutlet'];
if(isset($_POST['kdoutlet'])) {
    $kdl = $_POST['kdoutlet'];
    $bln = $_POST['bulan'];
    if($kdl =="00") {
        $kdoutlet = '';
    } else {
        $kdoutlet = "$tabel.kodeoutlet = '$kdl' AND";
    }
    
}
if ($_SESSION['kodeoutlet'] == "OUT001" or $_SESSION['kodeoutlet'] == "OUT000") {
    if (isset($_POST['filter-date'])) {
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        
        $data = query("SELECT *, $tabel.status as status_form 
        FROM $tabel
        JOIN $tabel_join
        ON $tabel.kode$kode = $tabel_join.kode$kode
        WHERE date 
        WHERE $tabel.kodeoutlet ='$kdoutlet' AND date 
        LIKE '$tahun-$bulan%'
        ORDER BY $tabel.date DESC, $tabel.No_form DESC
        ");
    } else {
        $data = query("SELECT *
        FROM $tabel
        JOIN $tabel_join
        ON $tabel.kode$kode = $tabel_join.kode$kode
        WHERE $tabel.kodeoutlet ='$kdoutlet' AND $tabel.data LIKE '$year-$month%'
        ORDER BY $tabel.date DESC, $tabel.No_form DESC");
    }
} else {
    if (isset($_POST['filter-date'])) {
        
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];

        $data = query("SELECT * 
        FROM $tabel
        JOIN $tabel_join
        ON $tabel.kode$kode = $tabel_join.kode$kode
        WHERE $kdoutlet 
        $tabel.date LIKE '$tahun-$bulan%'
        ORDER BY $tabel.date DESC, $tabel.No_form DESC
        ");
    } else if (!isset($_POST['filter-date'])) {
        if ($tabel_join == 'companypanel') {
            $data = query("SELECT $tabel.*, $tabel_join.nama
            FROM $tabel
            JOIN $tabel_join
            ON $tabel.kode$kode = $tabel_join.kode$kode
            ORDER BY $tabel.date DESC, $tabel.No_form DESC");
        } else {
            $data = query("SELECT $tabel.*, $tabel_join.namasupplier
            FROM $tabel
            JOIN $tabel_join
            ON $tabel.kode$kode = $tabel_join.kode$kode
            WHERE $tabel.date LIKE '%$year-$month%'
            ORDER BY $tabel.date DESC, $tabel.No_form DESC");
        }
    }
}