<?php
require 'include/fungsi.php';
require_once 'models/user.php';
$secret = '#$eCr37';

if (!isset($_GET['email']) || !isset($_GET['token'])) {
    header("Location:index");
}


$email = $_GET['email'];
$token = $_GET['token'];
if (md5($email . $secret) != $token) {
    header("Location:index");
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
    <title>Lawless CK</title>

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

    <!-- Sweetalert2 -->
    <link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.css">

    <!-- jQuery library -->
    <script src="assets/js/jquery.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="assets/js/bootstrap.js"></script>

    <!-- Sweetalert2 -->
    <script type="text/javascript" charset="utf8" src="assets/sweetalert2/sweetalert2.js"></script>

</head>

<body>

    <div class="account-pages"></div>
    <div class="clearfix"></div>

    <div class="wrapper-page">
        <div class="text-center">
            <!-- <h4 class="text-uppercase font-bold m-b-0">Sign In</h4> -->
            <img src="assets/images/big/lawless-logo.jpg" width="25%">
        </div>

        <div class="m-t-40 card-box">
            <div class="text-center">

                <a href="index.html" class="logo"><span><?= ucwords($company['nama']); ?> <span></span></span></a>

            </div>

            <div class="panel-body">
                <p class="m-b-0 text-center">Silahkan Isikan Password Anda</p>
                <form class="form-horizontal m-t-20" id="form-password">
                    <input type="hidden" id="email" name="_email" value="<?= $email ?>">
                    <input type="hidden" name="_token" value="<?= $token ?>">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" required="" type="password" id="password" name="password" placeholder="Enter your password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" required="" type="password" id="password-confirm" placeholder="Confirm your password">
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required" id="error-message"></li>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" name="create-password">
                    <div class="form-group text-center m-t-30">
                        <div class="col-xs-12">
                            <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit" id="tombol-simpan">Simpan Password</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- end card-box-->
    </div>
    <!-- end wrapper page -->

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
    <script>
        $(document).ready(function() {
            $("#password-confirm").on("input", function() {
                if ($("#password-confirm").val() != $("#password").val()) {
                    $("#password-confirm").addClass("parsley-error");
                    $("#error-message").text("password tidak sama");
                    $("#tombol-simpan").prop('disabled', true);
                } else {
                    $("#password-confirm").removeClass("parsley-error");
                    $("#error-message").empty();
                    $("#tombol-simpan").prop('disabled', false);
                }
            });
            $("#form-password").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'models/input.php',
                    data: $(this).serialize(),
                    type: 'POST'
                }).done(function(result) {
                    if (result) {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil menyimpan password",
                            showConfirmButton: false,
                            timer: 3000
                        });
                        window.location.replace('/');
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Gagal menyimpan password"
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>