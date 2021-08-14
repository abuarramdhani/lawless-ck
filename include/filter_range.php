<?php
if (isset($_POST['filter_range'])) {

    $start = explode(' - ', $_POST['start']);
    $end = explode(' - ', $_POST['end']);
    $newStart = date("Y-m-d", strtotime($start[0]));
    $newEnd = date("Y-m-d", strtotime($end[0]));


    $laporan = $_POST['laporan'];
    // var_dump($newStart);
    // var_dump($end[0]);

    $data = query("SELECT *, SUM(qty) as total, SUM(subtotal) as subtotalmasuk
    FROM item_$laporan as i$laporan 
    JOIN form_$laporan as f$laporan
    ON i$laporan.No_form = f$laporan.No_form
    JOIN $tabel_filter as b ON i$laporan.kode$tabel_filter = b.kode$tabel_filter
    WHERE f$laporan.date  BETWEEN date('$newStart') AND date('$newEnd')
    GROUP BY i$laporan.kode$tabel_filter");

    if ($data == null) {

        $_SESSION["msg"] = "2";
    }
}
