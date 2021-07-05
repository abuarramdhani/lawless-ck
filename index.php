<?php 
session_start();

if (isset($_SESSION["email"])) {
    header("location: menu");
    exit;
}
require 'include/fungsi.php';
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
            <!-- <div class="text-center">
                <a href="index.html" class="logo"><span> <span>Central </span>Kitchen</span></a>
            </div> -->
            <div class="panel-body">
                <form class="form-horizontal m-t-20" id="formmasuk">
                    <input type="hidden" id="login" name="login" value="login">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" required="" type="email" id="email" name="email"
                                placeholder="Enter your email">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" type="password" id="password"
                                name="password" placeholder="Enter your password">
                        </div>
                    </div>

                    <!-- <div class="form-group ">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-custom">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup">
                                    Remember me
                                </label>
                            </div>

                        </div>
                    </div> -->

                    <div class="form-group text-center m-t-30">
                        <div class="col-xs-12">
                            <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit"
                                id="tombol-simpan" name="tombol-simpan">Log In</button>
                        </div>
                    </div>

                    <!-- <div class="form-group m-t-30 m-b-0">
                        <div class="col-sm-12">
                            <a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot
                                your password?</a>
                        </div>
                    </div> -->
                </form>

            </div>
        </div>
        <!-- end card-box-->

        <!-- <div class="row">
            <div class="col-sm-12 text-center">
                <p class="text-muted">Don't have an account? <a href="page-register.html"
                        class="text-primary m-l-5"><b>Sign Up</b></a></p>
            </div>
        </div> -->

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

</body>

</html>

<script>
$(document).ready(function() {
    $('#tombol-simpan').click(function(e) {
        e.preventDefault();
        var dataform = $('#formmasuk')[0];
        var data = new FormData(dataform);

        //var input_foto = $('#input_foto').val();
        var login = $('#login').val();
        var email = $('#email').val();
        var password = $('#password').val();

        if (email == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Email belum diisi !'
            })
        } else if (password == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password belum diisi !'
            })
        } else {
            $.ajax({
                url: 'models/login.php',
                type: 'post',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                success: function(hasil) {

                    //sukses
                    if (hasil == 1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal...',
                            text: 'Email Belum terdaftar'
                        });

                    } else if (hasil == 2) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal...',
                            text: 'Password Salah'
                        });
                    } else if (hasil == 3) {
                        Swal.fire({
                            position: "top-end",
                            type: "success",
                            title: "Login Berhasil",
                            showConfirmButton: !1,
                            timer: 1500
                        }).then(function() {
                            //location.reload();
                            document.location.href = 'menu';
                        });

                    }
                }
            });
        }
    })
});
</script>