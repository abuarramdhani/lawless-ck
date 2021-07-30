<?php
$users = query("SELECT * FROM admin");
$outlet = query("SELECT id,kodeoutlet,nama from companypanel");
$jabatan = query("SELECT id,kodejabatan,namajabatan from jabatan ");
