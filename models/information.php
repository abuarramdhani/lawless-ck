<?php
$kodeoutlet = $_SESSION['kodeoutlet'];
$check = query("SELECT COUNT(status_ck AND status_ot) AS informasi FROM form_po WHERE status_ck = 0 AND status_ot = 0 and kodeoutlet = '$kodeoutlet'")[0];
$c_admin = query("SELECT COUNT(status_ck AND status_ot) AS informasi FROM form_po WHERE status_ck = 0 AND status_ot = 1 and kodeoutlet = '$kodeoutlet'")[0];
$c_manager = query("SELECT COUNT(status_ck AND status_ot) AS informasi FROM form_po WHERE status_ck = 1 AND status_ot = 1 and kodeoutlet = '$kodeoutlet'")[0];
$delivery = query("SELECT COUNT(status_ck AND status_ot) AS informasi FROM form_po WHERE status_ck = 2 AND status_ot = 1 and kodeoutlet = '$kodeoutlet'")[0];
$delivered = query("SELECT COUNT(status_ck AND status_ot) AS informasi FROM form_po WHERE status_ck = 2 AND status_ot = 2 and kodeoutlet = '$kodeoutlet'")[0];
