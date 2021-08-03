<?php
$No_form = $_GET['No_form'];
$item_po = query("SELECT * FROM item_in 
    JOIN bahan 
    ON item_in.kodebahan = bahan.kodebahan 
    WHERE No_form = '$No_form'");

$detail = query("SELECT *
    FROM form_in
    JOIN supplier
    ON form_in.kodesupplier = supplier.kodesupplier
    WHERE No_form = '$No_form'")[0];
$sot = $detail['status_ot'];
$sck = $detail['status_ck'];
