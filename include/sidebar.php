<?php
if ($_SESSION['userlevel'] != 0) {
    if ($_SESSION['jabatan'] === "JAB001") {
        $kodeusermenu = query("SELECT * FROM user_menu WHERE id<7 ORDER BY id ASC ");
    } else if ($_SESSION['jabatan'] === "JAB002") {
        $kodeusermenu = query("SELECT * FROM user_menu WHERE id NOT IN (6,8) ORDER BY id ASC ");
    } else if ($_SESSION['jabatan'] === "JAB003") {
        $kodeusermenu = query("SELECT * FROM user_menu WHERE id=1 OR id=2 ORDER BY id ASC ");
    } else if ($_SESSION['jabatan'] === "JAB004") {
        $kodeusermenu = query("SELECT * FROM user_menu WHERE id=2 OR id=3 ORDER BY id ASC ");
    }
} else {
    $kodeusermenu = query("SELECT * FROM user_menu ORDER BY id ASC ");
}
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
                            $kodeusersubmenu = query("SELECT * FROM user_sub_menu WHERE menu_id ='$menu_id' ORDER BY menu_id ASC ");
                            ?>

                            <?php foreach ($kodeusersubmenu as $row1) : ?>
                                <?php
                                if ($juhal === $row1["title"]) {
                                    $class1 = "waves-effect active";
                                } else {
                                    $class1 = "waves-effect";
                                }
                                ?>

                                <li class="<?= $class1 ?>"><a href="<?= "../" . $row["url"] ?>/<?= $row1["url"] ?>"><?= $row1['title'] ?></a>
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