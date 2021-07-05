<?php
    $ri = query("SELECT * FROM user WHERE email = '$s'")[0];
    $role_id = $ri['role_id'];
    $menu = query("SELECT * FROM user_access_menu 
                    JOIN user_menu 
                    ON user_access_menu.menu_id = user_menu.id  
                    WHERE user_access_menu.role_id = '$role_id'");
    
?>
========== Left Sidebar Start ========== -->
            <div class="left side-menu ">
                <div class="sidebar-inner slimscrollleft m-t-20">

                  

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                            <?php foreach ($menu as $m) : ?>
                                <li class="text-muted menu-title"><?= $m['menu']  ?></li>
                                <?php
                                    $menuId = $m['id']; 
                                    $subMenu =  query("SELECT * FROM user_sub_menu 
                                                WHERE menu_id = '$menuId' 
                                                AND is_active = 1");
                                 ?>
                                <?php foreach ($subMenu as $sm) : ?>
                                    <?php if ($sm['model_menu'] == 1): ?>
                                        <li>
                                            <a href="../admin" class="waves-effect"><i class="<?= $sm['icon']; ?>"></i> <span> <?= $sm['title']; ?> <?= $sm['id']  ?></span> </a>
                                        </li>
                                    <?php else : ?>
                                        <li class="has_sub">
                                            <a href="javascript:void(0);" class="waves-effect"><i class="<?= $sm['icon']; ?>"></i> <span> <?= $sm['title']; ?> <?= $sm['id']  ?></span> <span class="menu-arrow"></span></a>
                                            <ul class="list-unstyled">
                                                <?php
                                                    $submenu2Id = $sm['id']; 
                                                    $subMenu2 =  query("SELECT * FROM user_sub_menu2 
                                                                WHERE menu_id = '$submenu2Id' 
                                                                AND is_active = 1");
                                                 ?>
                                                <?php foreach ($subMenu2 as $sm2) : ?>
                                                <li><a href="<?= $sm2['url']  ?>"><?= $sm2['halaman']  ?></a></li>
                                                <?php endforeach; ?>
                                                
                                            </ul>
                                        </li>
                                    <?php endif ; ?>
                                <?php endforeach; ?>        
                            <?php endforeach; ?>
                            <li>
                                <a href="../logout" class="waves-effect"><i class="zmdi zmdi-power"></i> <span> Log Out </span> </a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End