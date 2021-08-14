<?php
$unit = query("SELECT * FROM unit ORDER BY namaunit ASC");

$kodepackage = query("SELECT p.*, u.kodeunit,u.namaunit  FROM package as p
JOIN unit as u
ON p.unit = u.kodeunit
ORDER BY p.id DESC ");
