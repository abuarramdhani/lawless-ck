<?php
$No_form = $_GET['No_form'];
$item_storebahan = query("SELECT sp.*, p.namabahan FROM item_storebahan as sp
    JOIN bahan as p
    ON p.kodebahan = sp.kodebahan 
    WHERE sp.No_form = '$No_form'");

$detail = query("SELECT *
    FROM form_storebahan as sp
    JOIN companypanel as cp
    ON sp.kodeoutlet = cp.kodeoutlet
    WHERE sp.No_form = '$No_form'")[0];
