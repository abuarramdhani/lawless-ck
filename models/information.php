<?php
$kodeoutlet = $_SESSION['kodeoutlet'];
$check = query("SELECT COUNT(status) FROM form_po WHERE STATUS = 0 and kodeoutlet = '$kodeoutlet'")[0];
$c_admin = query("SELECT COUNT(status) FROM form_po WHERE STATUS = 1 and kodeoutlet = '$kodeoutlet'")[0];
$c_manager = query("SELECT COUNT(status) FROM form_po WHERE STATUS = 2 and kodeoutlet = '$kodeoutlet'")[0];
$delivery = query("SELECT COUNT(status) FROM form_po WHERE STATUS = 3 and kodeoutlet = '$kodeoutlet'")[0];
$delivered = query("SELECT COUNT(status) FROM form_po WHERE (STATUS = 4 or  STATUS = 5) and kodeoutlet = '$kodeoutlet'")[0];