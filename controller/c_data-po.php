<?php

$data_po = query("SELECT *
FROM form_po
JOIN supplier
ON form_po.kodesupplier = supplier.kodesupplier
ORDER BY form_po.id DESC");
