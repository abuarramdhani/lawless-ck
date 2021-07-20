<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!-- User -->
        <!-- <div class="user-box">
            <div class="user-img">
                <img src="../assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme"
                    class="img-circle img-thumbnail img-responsive">
                <div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
            </div>
            <h5><a href="#">Mat Helme</a> </h5>
            <ul class="list-inline">
                <li>
                    <a href="#">
                        <i class="zmdi zmdi-settings"></i>
                    </a>
                </li>

                <li>
                    <a href="#" class="text-custom">
                        <i class="zmdi zmdi-power"></i>
                    </a>
                </li>
            </ul>
        </div> -->
        <!-- End User -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <br>
            <ul>
                <?php if($bagian=="Purchasing"): ?>
                <li class="text-muted menu-title"><?= $bagian  ?></li>
                <!-- <li>
                    <a href="../menu" class="waves-effect"><i class="zmdi zmdi-format-underlined"></i>
                        <span> Menu </span> </a>
                </li> -->
                <li>
                    <a href="form-po" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span> Form PO</span> </a>
                </li>
                <li>
                    <a href="index" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span> Data PO</span> </a>
                </li>

                <li class="has_sub">

                    <a class="waves-effect"><i class="zmdi zmdi-local-library"></i> <span>
                            Data Master </span> <span class="menu-arrow"></span></a>

                    <ul class="list-unstyled">
                        <li><a href="../datamaster/supplier">Supplier</a></li>
                        <li><a href="../datamaster/item-bahan">Item Bahan</a></li>
                        <li><a href="../datamaster/unit">Unit</a></li>
                    </ul>
                </li>
                <a href="../inventory">
                    <li class="text-muted menu-title">Inventory</li>
                </a>
                <a href="../production">
                    <li class="text-muted menu-title">Production</li>
                </a>
                <a href="../store">
                    <li class="text-muted menu-title">Store</li>
                </a>
                <a href="../Report">
                    <li class="text-muted menu-title">Report</li>
                </a>
                <a href="../user">
                    <li class="text-muted menu-title">User</li>
                </a>
                <a href="../datamaster">
                    <li class="text-muted menu-title">Data Master</li>
                </a>
                <?php elseif ($bagian=="Inventory") : ?>
                <a href="../purchasing">
                    <li class="text-muted menu-title">Purchasing</li>
                </a>
                <li class="text-muted menu-title"><?= $bagian  ?></li>
                <li>
                    <a href="barangmasuk" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>Barang Masuk</span> </a>
                </li>
                <li>
                    <a href="index" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>Data Bahan</span> </a>
                </li>
                <a href="../production">
                    <li class="text-muted menu-title">Production</li>
                </a>
                <a href="../store">
                    <li class="text-muted menu-title">Store</li>
                </a>
                <a href="../Report">
                    <li class="text-muted menu-title">Report</li>
                </a>
                <a href="../user">
                    <li class="text-muted menu-title">User</li>
                </a>
                <a href="../datamaster">
                    <li class="text-muted menu-title">Data Master</li>
                </a>
                <?php elseif ($bagian=="Production") : ?>
                <a href="../purchasing">
                    <li class="text-muted menu-title">Purchasing</li>
                </a>
                <a href="../inventory">
                    <li class="text-muted menu-title">Inventory</li>
                </a>
                <li class="text-muted menu-title"><?= $bagian  ?></li>

                <a href="../store">
                    <li class="text-muted menu-title">Store</li>
                </a>
                <a href="../Report">
                    <li class="text-muted menu-title">Report</li>
                </a>
                <a href="../user">
                    <li class="text-muted menu-title">User</li>
                </a>
                <a href="../datamaster">
                    <li class="text-muted menu-title">Data Master</li>
                </a>
                <?php elseif ($bagian=="Store") : ?>
                <a href="../purchasing">
                    <li class="text-muted menu-title">Purchasing</li>
                </a>
                <a href="../inventory">
                    <li class="text-muted menu-title">Inventory</li>
                </a>
                <a href="../production">
                    <li class="text-muted menu-title">Production</li>
                </a>
                <li class="text-muted menu-title"><?= $bagian  ?></li>
                <li>
                    <a href="index" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>Store</span> </a>
                </li>
                <li>
                    <a href="storebahan" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>Store Bahan</span> </a>
                </li>
                <a href="../Report">
                    <li class="text-muted menu-title">Report</li>
                </a>
                <a href="../user">
                    <li class="text-muted menu-title">User</li>
                </a>
                <a href="../datamaster">
                    <li class="text-muted menu-title">Data Master</li>
                </a>
                <?php elseif ($bagian=="Report") : ?>

                <?php elseif ($bagian=="User") : ?>
                <a href="../purchasing">
                    <li class="text-muted menu-title">Purchasing</li>
                </a>
                <a href="../inventory">
                    <li class="text-muted menu-title">Inventory</li>
                </a>
                <a href="../production">
                    <li class="text-muted menu-title">Production</li>
                </a>
                <a href="../store">
                    <li class="text-muted menu-title">Store</li>
                </a>
                <a href="../Report">
                    <li class="text-muted menu-title">Report</li>
                </a>
                <li class="text-muted menu-title"><?= $bagian  ?></li>
                <li>
                    <a href="profile" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>Profile</span> </a>
                </li>
                <li>
                    <a href="user" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>User</span> </a>
                </li>
                <li>
                    <a href="../datamaster/outlet" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>Outlet</span> </a>
                </li>
                <li>
                    <a href="../datamaster/jabatan" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>Jabatan</span> </a>
                </li>
                <a href="../datamaster">
                    <li class="text-muted menu-title">Data Master</li>
                </a>
                <?php elseif ($bagian=="Data Master") : ?>
                <a href="../purchasing">
                    <li class="text-muted menu-title">Purchasing</li>
                </a>
                <a href="../inventory">
                    <li class="text-muted menu-title">Inventory</li>
                </a>
                <a href="../production">
                    <li class="text-muted menu-title">Production</li>
                </a>

                <a href="../store">
                    <li class="text-muted menu-title">Store</li>
                </a>
                <a href="../Report">
                    <li class="text-muted menu-title">Report</li>
                </a>
                <a href="../user">
                    <li class="text-muted menu-title">User</li>
                </a>
                <li class="text-muted menu-title"><?= $bagian  ?></li>
                <li>
                    <a href="supplier" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>Supplier</span> </a>
                </li>
                <li>
                    <a href="unit" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>Unit</span> </a>
                </li>
                <li>
                    <a href="kategori-produk" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>Kategori Produk</span> </a>
                </li>
                <li>
                    <a href="produk" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>Produk</span> </a>
                </li>
                <li>
                    <a href="item-bahan" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>Item Bahan</span> </a>
                </li>
                <li>
                    <a href="outlet" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>Outlet</span> </a>
                </li>
                <li>
                    <a href="jabatan" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i>
                        <span>Jabatan</span> </a>
                </li>
                <?php endif ; ?>



            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- Left Sidebar End -->