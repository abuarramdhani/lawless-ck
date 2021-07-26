<?php

$data_po = query("SELECT *
FROM form_in as fi
JOIN supplier as s
ON fi.kodesupplier = s.kodesupplier
ORDER BY fi.id DESC");
