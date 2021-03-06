<?php
session_start();
// echo $sesikodeoutlet = $_SESSION['kodeoutlet'];
// $sesioutlet = $_SESSION['outlet'];
// $sesijabatan = $_SESSION['jabatan'];

// echo "          
//             <script>
//             alert('$sesikodeoutlet');
//                 // alert('$sesioutlet');
//                 // alert('$sesijabatan');
//             </script>
//             ";

if (!isset($_SESSION['email'])) {
    header("location:index"); // jika belum login, maka dikembalikan ke index
    exit;
} elseif (!isset($_SESSION['kodeoutlet']) or !isset($_SESSION['outlet']) or !isset($_SESSION['jabatan'])) {
    header("location:maintenance.php");
    exit;
} else {
    require 'include/fungsi.php';
    require 'controller/c_sidebar.php';
    
    // if ($_SESSION['userlevel'] != 0) {
    //     if ($_SESSION['kodeoutlet'] == "OUT000" or $_SESSION['kodeoutlet'] == "OUT001") {
    //         if ($_SESSION['jabatan'] == "JAB001") {
    //             $kodeusermenu = query("SELECT * FROM user_menu WHERE id<7 ORDER BY id ASC ");
    //         } else if ($_SESSION['jabatan'] == "JAB002") {
    //             $kodeusermenu = query("SELECT * FROM user_menu WHERE id NOT IN (6,8) ORDER BY id ASC ");
    //         } else if ($_SESSION['jabatan'] == "JAB003") {
    //             $kodeusermenu = query("SELECT * FROM user_menu WHERE id=1 OR id=2 ORDER BY id ASC ");
    //         } else if ($_SESSION['jabatan'] == "JAB004") {
    //             $kodeusermenu = query("SELECT * FROM user_menu WHERE id=2 OR id=3 OR id=7 ORDER BY id ASC ");
    //         }
    //     }   else if ($_SESSION['kodeoutlet'] == "OUT002" ) {
    //             if ($_SESSION['jabatan'] == "JAB001") {
    //                 $kodeusermenu = query("SELECT * FROM user_menu WHERE id NOT IN (6,8) ORDER BY id ASC ");
    //             } else if ($_SESSION['jabatan'] == "JAB002") {
    //                 $kodeusermenu = query("SELECT * FROM user_menu WHERE id=1 OR id=2 OR id=3 OR id=4 OR id=5 OR id=7 ORDER BY id ASC ");
    //             } else if ($_SESSION['jabatan'] == "JAB003") {
    //                 $kodeusermenu = query("SELECT * FROM user_menu WHERE id=1 OR id=2 ORDER BY id ASC ");
    //             } else if ($_SESSION['jabatan'] == "JAB004") {
    //                 $kodeusermenu = query("SELECT * FROM user_menu WHERE id=2 OR id=3 OR id=7 ORDER BY id ASC ");
    //             }
    //     } else {
    //         if ($_SESSION['jabatan'] == "JAB001") {
    //             $kodeusermenu = query("SELECT * FROM user_menu WHERE id NOT IN (3,6,8) ORDER BY id ASC ");
    //         } else if ($_SESSION['jabatan'] == "JAB002") {
    //             $kodeusermenu = query("SELECT * FROM user_menu WHERE id NOT IN (3,6,8) ORDER BY id ASC ");
    //         } else if ($_SESSION['jabatan'] == "JAB003") {
    //             $kodeusermenu = query("SELECT * FROM user_menu WHERE id=1 OR id=2 ORDER BY id ASC ");
    //         } else if ($_SESSION['jabatan'] == "JAB004") {
    //             $kodeusermenu = query("SELECT * FROM user_menu WHERE id=2 OR id=7 ORDER BY id ASC ");
    //         }
    //     }
    // } else {
    //     $kodeusermenu = query("SELECT * FROM user_menu WHERE id<8 ");
    // }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- App Favicon -->
    <link rel="shortcut icon" href="assets/images/big/lawless-logo.jpg">

    <!-- App title -->
    <title><?= $company['nama']; ?></title>

    <!-- App CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    <script src="assets/js/modernizr.min.js"></script>

</head>

<body>



    <div class="account-pages-menu"></div>
    <div class="clearfix"></div>

    <!-- HOME -->
    <section>
        <div class="container-alt">
            <div class="wrapper-page">
                <div class="text-center">

                    <img src="assets/images/big/lawless-logo.jpg" width="25%">


                </div>
            </div>
            <!-- end wrapper page -->
            <div class="row">



                <?php foreach ($kodeusermenu as $row) : ?>
                <div class="col-lg-3">
                    <div class="panel panel-color panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center"><?= $row['menu']; ?></h3>
                        </div>
                        <div class="panel-body text-center">
                            <a href="<?= $row['url']; ?>/index.php"><img src="assets/images/<?= $row['gambar']; ?>"
                                    style="width: 125px;" class="img-circle"></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>




            </div>
    </section>
    <!-- END HOME -->



    <script>
    var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

</body>

</html>