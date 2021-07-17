<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="../menu"><img src="../assets/images/big/lawless-logo1.png" width="25%"></a>
        <a href="../index" class="logo"><span>Central <span>Kitchen</span></span><i class="zmdi zmdi-layers"></i></a>

    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">

            <!-- Page title -->
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <button class="button-menu-mobile open-left">
                        <i class="zmdi zmdi-menu"></i>
                    </button>
                </li>
                <li>
                    <h4 class="page-title"><?= $juhal  ?></h4>
                </li>
            </ul>

            <!-- RightNotification and Searchbox -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <div class="page-title">
                        <?php //foreach ($user as $row): ?>
                        <ul class="list-inline m-b-0">
                            <li>
                                <h5 class="page-title"><a href=""><?= strtoupper($username); ?> </a> </h5>
                                <!-- <h5 class="page-title"><a href="profil"><?=$ul;?> </a> </h5> -->
                            </li>
                        </ul>
                        <?php ///endforeach;?>
                    </div>

                </li>
                <li>
                    <div class="page-title">
                        <ul class="list-inline m-b-0">
                            <li>
                                <a href=""><i class="fa fa-user"></i></a>
                            </li>
                        </ul>
                    </div>

                </li>

                <li>
                    <div class="page-title">
                        <ul class="list-inline m-b-0">
                            <li>
                                <a href="../utem"><i class="zmdi zmdi-power"></i></a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

        </div><!-- end container -->
    </div><!-- end navbar -->
</div>
<!-- Top Bar End -->