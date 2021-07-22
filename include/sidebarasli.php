<?php 
$kodeusermenu = query("SELECT * FROM user_menu ORDER BY id ASC ");
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <br>

            <ul>
                <?php foreach ($kodeusermenu as $row) : ?>
                <a href="../<?= $row["menu"] ?>">
                    <li class="text-muted menu-title"><?= ucwords($row["menu"]) ?></li>
                </a>
                <?php if($bagian==$row["menu"]): ?>
                <?php
                            $menu_id = $row["id"];                        
                            $kodeusersubmenu = query("SELECT * FROM user_sub_menu WHERE menu_id ='$menu_id' ORDER BY menu_id ASC ");
                        ?>
                <?php foreach ($kodeusersubmenu as $row1) : ?>
                <li>
                    <?php
                            $submenu_id = $row1["menu_id"];                        
                            $kodeusersubmenu2 = query("SELECT * FROM user_sub_menu2 WHERE menu_id ='$menu_id' AND submenu_id ='$submenu_id' ORDER BY submenu_id ASC ")[0];
                        ?>

                    <a href="<?= $kodeusersubmenu2["url"] ?>" class="waves-effect active"><i
                            class="zmdi zmdi-view-dashboard"></i>
                        <span> <?= $row1["title"] ?></span> </a>

                </li>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- Left Sidebar End -->