<?php
$No_form = $_GET['No_form'];
$item_po = query("SELECT * FROM item_po
JOIN bahan
ON item_po.kodebahan = bahan.kodebahan
WHERE No_form = '$No_form'");

$detail = query("SELECT *
FROM form_po
JOIN supplier
ON form_po.kodesupplier = supplier.kodesupplier
WHERE No_form = '$No_form'")[0];
