<?php

$data = query("SELECT fsb.*,cp.nama
FROM form_storebahan as  fsb
JOIN companypanel as cp
ON fsb.kodeoutlet = cp.kodeoutlet
ORDER BY fsb.id DESC");
