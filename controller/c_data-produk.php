<?php

$data_produk = query("SELECT *
FROM form_produkmasuk
ORDER BY id DESC");
// $data_produk = query("SELECT *
// FROM form_dataproduk
// JOIN supplier
// ON form_po.kodesupplier = supplier.kodesupplier
// ORDER BY form_po.id DESC");
