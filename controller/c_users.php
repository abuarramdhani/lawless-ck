<?php
$users = query("SELECT * FROM admin WHERE userlevel != 0");
$outlet = query("SELECT id,kodeoutlet,nama from companypanel");
$jabatan = query("SELECT * from jabatan ");