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

                <li class="has_sub">

                    <?php 
                            if($bagian==$row["menu"]){
                                $class = "waves-effect active";                                
                            }else{
                                $class = "waves-effect";                                
                            }
                            ?>
                    <a href="javascript:void(0);" class="<?= $class ?>"><i class="zmdi zmdi-invert-colors"></i> <span>
                            <?= ucwords($row["menu"]) ?> </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">

                        <?php
                            $menu_id = $row["id"];                        
                            $kodeusersubmenu = query("SELECT * FROM user_sub_menu WHERE menu_id ='$menu_id' ORDER BY menu_id ASC ");
                        ?>

                        <?php foreach ($kodeusersubmenu as $row1) : ?>
                        <?php
                            $submenu_halaman = $row1['title'];                        
                            $kodeusersubmenu2 = query("SELECT * FROM user_sub_menu2 WHERE halaman ='$submenu_halaman' ORDER BY id ASC ")[0];                            
                        ?>
                        <?php 
                            if($juhal === $kodeusersubmenu2["halaman"]){
                                $class1 = "waves-effect active";                                
                            }else{
                                $class1 = "waves-effect";                                
                            }
                            ?>
                        <li class="<?= $class1 ?>"><a href="<?= $kodeusersubmenu2["url"] ?>"><?= $submenu_halaman ?></a>
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
<!-- Left Sidebar End -->