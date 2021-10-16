<?php
$No_form = $_GET['No_form'];
$item_produk = query("SELECT * FROM item_produkmasuk as pm 
    JOIN barang as b ON pm.kodeproduk = b.kodebarang 
    JOIN unit as u ON pm.unit = u.kodeunit
    WHERE pm.No_form = '$No_form' AND b.kodeoutlet='OUT002'");

$detail = query("SELECT *
    FROM form_produkmasuk
    WHERE No_form = '$No_form'")[0];
    
$grand_total =  query("SELECT sum(subtotal) as grand_total FROM item_produkmasuk WHERE No_form = '$No_form' ")[0];
