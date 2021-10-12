<?php
require '../controller/c_sidebar.php';
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <br>

            <ul>
                <?php foreach ($kodeusermenu as $row) : ?>

                <li class="has_sub">

                    <?php
                        if ($bagian == $row["menu"]) {
                            $class = "waves-effect active";
                        } else {
                            $class = "waves-effect";
                        }
                        ?>
                    <a href="javascript:void(0);" class="<?= $class ?>"><i class="<?= $row["icon"] ?>"></i>
                        <span>
                            <?= ucwords($row["menu"]) ?> </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">

                        <?php
                            $menu_id = $row["id"];
                            if ($_SESSION['userlevel'] != 0) {
                                if ($_SESSION['kodeoutlet'] == 'OUT000' or $_SESSION['kodeoutlet'] == 'OUT001' or $_SESSION['kodeoutlet'] == 'OUT002') {
                                    if ($_SESSION['jabatan'] == "JAB000" or $_SESSION['jabatan'] == "JAB001") {
                                        $kodeusersubmenu = query("SELECT * FROM user_sub_menu WHERE menu_id ='$menu_id' AND is_active=1 ORDER BY menu_id ASC ");
                                    } else if ($_SESSION['jabatan'] == "JAB004") {
                                        $kodeusersubmenu = query("SELECT * FROM user_sub_menu WHERE menu_id ='$menu_id' AND id NOT IN (6,12,13) AND is_active=1 ORDER BY menu_id ASC ");
                                    } else {
                                        $kodeusersubmenu = query("SELECT * FROM user_sub_menu WHERE menu_id ='$menu_id' AND id NOT IN (12,13) AND is_active=1 ORDER BY menu_id ASC ");
                                    }
                                } else if ($_SESSION['kodeoutlet'] == 'OUT002') {
                                    if ($_SESSION['jabatan'] == "JAB000" ) {
                                        $kodeusersubmenu = query("SELECT * FROM user_sub_menu WHERE menu_id ='$menu_id' AND is_active=1 ORDER BY menu_id ASC ");
                                    } else if ($_SESSION['jabatan'] == "JAB001") {
                                        $kodeusersubmenu = query("SELECT * FROM user_sub_menu WHERE menu_id ='$menu_id' AND id NOT IN (12,13) AND is_active=1 ORDER BY menu_id ASC ");
                                    } else if ($_SESSION['jabatan'] == "JAB004") {
                                        $kodeusersubmenu = query("SELECT * FROM user_sub_menu WHERE menu_id ='$menu_id' AND id NOT IN (6,12,13) AND is_active=1 ORDER BY menu_id ASC ");
                                    } else {
                                        $kodeusersubmenu = query("SELECT * FROM user_sub_menu WHERE menu_id ='$menu_id' AND id NOT IN (12,13) AND is_active=1 ORDER BY menu_id ASC ");
                                    }                                
                                } else {
                                    if ($_SESSION['jabatan'] == "JAB000" or $_SESSION['jabatan'] == "JAB001") {
                                        $kodeusersubmenu = query("SELECT * FROM user_sub_menu WHERE menu_id ='$menu_id' AND id NOT IN (5,9,10,12,13) AND is_active=1 ORDER BY menu_id ASC ");
                                    } else if ($_SESSION['jabatan'] == "JAB004") {
                                        $kodeusersubmenu = query("SELECT * FROM user_sub_menu WHERE menu_id ='$menu_id' AND id NOT IN (5,9,10,6,12,13) AND is_active=1 ORDER BY menu_id ASC ");
                                    } else {
                                        $kodeusersubmenu = query("SELECT * FROM user_sub_menu WHERE menu_id ='$menu_id' AND id NOT IN (5,9,10,12,13) AND is_active=1 ORDER BY menu_id ASC ");
                                    }
                                }
                            } else {
                                $kodeusersubmenu = query("SELECT * FROM user_sub_menu WHERE menu_id ='$menu_id' AND is_active=1 ORDER BY menu_id ASC ");
                            }



                            ?>

                        <?php foreach ($kodeusersubmenu as $row1) : ?>
                        <?php
                                if ($juhal === $row1["title"]) {
                                    $class1 = "waves-effect active";
                                } else {
                                    $class1 = "waves-effect";
                                }
                                ?>

                        <li class="<?= $class1 ?>"><a
                                href="<?= "../" . $row["url"] ?>/<?= $row1["url"] ?>"><?= $row1['title'] ?></a>
                        </li>

                        <?php endforeach; ?>


                    </ul>

                </li>


                <?php endforeach; ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>