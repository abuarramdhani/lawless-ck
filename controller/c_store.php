<?php

$k_produk = query("SELECT * FROM kategoriproduk");
$produk = query("SELECT *FROM produk");

// $data_produk = query("SELECT *
// FROM form_storeproduk as sp
// JOIN companypanel as cp
// ON sp.kodeoutlet = cp.kodeoutlet
// ORDER BY sp.id DESC");
