<?php
if ($_SESSION['userlevel'] != 0) {
    if ($_SESSION['kodeoutlet'] == "OUT000" or $_SESSION['kodeoutlet'] == "OUT001") {
        if ($_SESSION['jabatan'] === "JAB001") {
            $kodeusermenu = query("SELECT * FROM user_menu WHERE id<8 ORDER BY id ASC ");
        } else if ($_SESSION['jabatan'] === "JAB002") {
            $kodeusermenu = query("SELECT * FROM user_menu WHERE id NOT IN (6,8) ORDER BY id ASC ");
        } else if ($_SESSION['jabatan'] === "JAB003") {
            $kodeusermenu = query("SELECT * FROM user_menu WHERE id=1 OR id=2 ORDER BY id ASC ");
        } else if ($_SESSION['jabatan'] === "JAB004") {
            $kodeusermenu = query("SELECT * FROM user_menu WHERE id=2 OR id=3 OR id=7 ORDER BY id ASC ");
        }
    } else if ($_SESSION['kodeoutlet'] == "OUT002") {
        if ($_SESSION['jabatan'] === "JAB001") {
            $kodeusermenu = query("SELECT * FROM user_menu WHERE id NOT IN (6,8) ORDER BY id ASC ");
        } else if ($_SESSION['jabatan'] === "JAB002") {
            $kodeusermenu = query("SELECT * FROM user_menu WHERE id NOT IN (6,8) ORDER BY id ASC ");
        } else if ($_SESSION['jabatan'] === "JAB003") {
            $kodeusermenu = query("SELECT * FROM user_menu WHERE id=1 OR id=2 OR id=4 OR id=7 ORDER BY id ASC ");
        } else if ($_SESSION['jabatan'] === "JAB004") {
            $kodeusermenu = query("SELECT * FROM user_menu WHERE id=2 OR id=3 OR id=7 ORDER BY id ASC ");
        }
    } else {
        if ($_SESSION['jabatan'] === "JAB001") {
            $kodeusermenu = query("SELECT * FROM user_menu WHERE id NOT IN (3,6,8) ORDER BY id ASC ");
        } else if ($_SESSION['jabatan'] === "JAB002") {
            $kodeusermenu = query("SELECT * FROM user_menu WHERE id NOT IN (3,6,8) ORDER BY id ASC ");
        } else if ($_SESSION['jabatan'] === "JAB003") {
            $kodeusermenu = query("SELECT * FROM user_menu WHERE id=1 OR id=2 ORDER BY id ASC ");
        } else if ($_SESSION['jabatan'] === "JAB004") {
            $kodeusermenu = query("SELECT * FROM user_menu WHERE id=2 OR id=7 ORDER BY id ASC ");
        }
    }
} else {
    $kodeusermenu = query("SELECT * FROM user_menu WHERE id<8 ");
}