<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location:../index"); // jika belum login, maka dikembalikan ke index
    exit;
}
require '../include/fungsi.php';
require '../include/header.php';
require '../include/fungsi_rupiah.php';
require '../include/fungsi_indotgl.php';
require '../controller/c_store.php';
$bagian = "Store";
$juhal = "Store";
?>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <?php require '../include/topbar.php';?>

        <?php require '../include/sidebar.php';?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6">
                            <!-- SECTION FILTER ================================================== -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 ">
                                    <div class="portfolioFilter">
                                        <a href="#" data-filter="*" class="current waves-effect waves-custom">All</a>
                                        <a href="#" data-filter=".natural" class="waves-effect waves-custom">Food</a>
                                        <a href="#" data-filter=".creative"
                                            class="waves-effect waves-custom">Baverage</a>
                                        <a href="#" data-filter=".personal" class="waves-effect waves-custom">Saos</a>
                                        <a href="#" data-filter=".photography"
                                            class="waves-effect waves-custom">Snack</a>
                                    </div>
                                </div>
                            </div>

                            <div class="row port m-b-20">
                                <div class="portfolioContainer">
                                    <div class="col-sm-6 col-lg-4 col-md-4 natural personal">
                                        <div class="gal-detail thumb">
                                            <a href="../assets/images/gallery/1.jpg" class="image-popup"
                                                title="Screenshot-1">
                                                <img src="../assets/images/gallery/1.jpg" class="thumb-img"
                                                    alt="work-thumbnail">
                                            </a>
                                            <h4>Nature Image</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-4 col-md-4 creative personal photography">
                                        <div class="gal-detail thumb">
                                            <a href="../assets/images/gallery/2.jpg" class="image-popup"
                                                title="Screenshot-2">
                                                <img src="../assets/images/gallery/2.jpg" class="thumb-img"
                                                    alt="work-thumbnail">
                                            </a>
                                            <h4>Gallary Image</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-4 col-md-4 natural creative">
                                        <div class="gal-detail thumb">
                                            <a href="../assets/images/gallery/3.jpg" class="image-popup"
                                                title="Screenshot-3">
                                                <img src="../assets/images/gallery/3.jpg" class="thumb-img"
                                                    alt="work-thumbnail">
                                            </a>
                                            <h4>Gallary Image</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-4 col-md-4 personal photography">
                                        <div class="gal-detail thumb">
                                            <a href="../assets/images/gallery/4.jpg" class="image-popup"
                                                title="Screenshot-4">
                                                <img src="../assets/images/gallery/4.jpg" class="thumb-img"
                                                    alt="work-thumbnail">
                                            </a>
                                            <h4>Gallary Image</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-4 col-md-4 creative photography">
                                        <div class="gal-detail thumb">
                                            <a href="../assets/images/gallery/5.jpg" class="image-popup"
                                                title="Screenshot-5">
                                                <img src="../assets/images/gallery/5.jpg" class="thumb-img"
                                                    alt="work-thumbnail">
                                            </a>
                                            <h4>Gallary Image</h4>


                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-4 col-md-4 natural photography">
                                        <div class="gal-detail thumb">
                                            <a href="../assets/images/gallery/6.jpg" class="image-popup"
                                                title="Screenshot-6">
                                                <img src="../assets/images/gallery/6.jpg" class="thumb-img"
                                                    alt="work-thumbnail">
                                            </a>
                                            <h4>Gallary Image</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-4 col-md-4 personal photography creative">
                                        <div class="gal-detail thumb">
                                            <a href="../assets/images/gallery/7.jpg" class="image-popup"
                                                title="Screenshot-7">
                                                <img src="../assets/images/gallery/7.jpg" class="thumb-img"
                                                    alt="work-thumbnail">
                                            </a>
                                            <h4>Gallary Image</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-4 col-md-4 creative photography natural">
                                        <div class="gal-detail thumb">
                                            <a href="../assets/images/gallery/8.jpg" class="image-popup"
                                                title="Screenshot-8">
                                                <img src="../assets/images/gallery/8.jpg" class="thumb-img"
                                                    alt="work-thumbnail">
                                            </a>
                                            <h4>Gallary Image</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-4 col-md-4 natural personal">
                                        <div class="gal-detail thumb">
                                            <a href="../assets/images/gallery/9.jpg" class="image-popup"
                                                title="Screenshot-9">
                                                <img src="../assets/images/gallery/9.jpg" class="thumb-img"
                                                    alt="work-thumbnail">
                                            </a>
                                            <h4>Gallary Image</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-4 col-md-4 photography creative">
                                        <div class="gal-detail thumb">
                                            <a href="../assets/images/gallery/10.jpg" class="image-popup"
                                                title="Screenshot-10">
                                                <img src="../assets/images/gallery/10.jpg" class="thumb-img"
                                                    alt="work-thumbnail">
                                            </a>
                                            <h4>Gallary Image</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-4 col-md-4 creative photography">
                                        <div class="gal-detail thumb">
                                            <a href="../assets/images/gallery/11.jpg" class="image-popup"
                                                title="Screenshot-11">
                                                <img src="../assets/images/gallery/11.jpg" class="thumb-img"
                                                    alt="work-thumbnail">
                                            </a>
                                            <h4>Gallary Image</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-4 col-md-4 natural creative personal">
                                        <div class="gal-detail thumb">
                                            <a href="../assets/images/gallery/12.jpg" class="image-popup"
                                                title="Screenshot-12">
                                                <img src="../assets/images/gallery/12.jpg" class="thumb-img"
                                                    alt="work-thumbnail">
                                            </a>
                                            <h4>Gallary Image</h4>

                                        </div>
                                    </div>

                                </div><!-- end portfoliocontainer-->
                            </div> <!-- End row -->
                        </div>
                    </div>
                </div> <!-- container -->



            </div> <!-- content -->

            <?php require '../include/footer.php';?>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

        <?php require '../include/rightsidebar.php';?>



    </div>
    <!-- END wrapper -->

    <?php require '../include/scriptfooter.php';?>

</body>

</html>

<script>
$(document).ready(function() {
    $('#tombol-kasmasuk').click(function(e) {

        e.preventDefault();
        var dataform = $('#formkasmasuk')[0];
        var data = new FormData(dataform);

        var kasmasuk = $('#kasmasuk').val();
        var kodeakun = $('#kodeakun').val();
        var tanggal = $('#tanggal').val();
        var keterangan = $('#keterangan').val();
        var payto = $('#payto').val();
        var jumlah = $('#jumlahinput').val();

        if (kodeakun == "000") {
            swal("Kode Akun Belum di Pilih!", "", "error")
        } else if (tanggal == " ") {
            swal("Tanggal Belum di Isi!", "", "error")
        } else if (keterangan == "") {
            swal("Keterangan Belum di Isi!", "", "error")
        } else if (payto == "") {
            swal("Payto Belum di Isi!", "", "error")
        } else if (jumlah == "") {
            swal("Jumlah Belum di Isi!", "", "error")
        } else {
            $.ajax({
                url: '../models/input.php',
                type: 'post',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $('.spinn').show();
                },
                success: function(hasil) {
                    // alert(hasil);
                    console.log(hasil);
                    //sukses
                    if (hasil == 1) {
                        swal("Input Gagal!", "", "error")
                    } else if (hasil == 2) {
                        swal("Tanggal tidak sesuai dengan bulan ini!", "", "error")
                    } else if (hasil == 3) {
                        swal({
                            title: "Input Berhasil!",
                            type: "success",
                            //text: "I will close in 2 seconds.",
                            timer: 1000,
                            showConfirmButton: false
                        })
                        location.reload();

                    }
                }
            });
        }
    })

    $('#tombol-kaskeluar').click(function(e) {

        e.preventDefault();
        var dataform = $('#formkaskeluar')[0];
        var data = new FormData(dataform);

        var kaskeluar = $('#kaskeluar').val();
        var kodeakunout = $('#kodeakunout').val();
        var tanggalout = $('#tanggalout').val();
        var keteranganout = $('#keteranganout').val();
        var paytoout = $('#paytoout').val();
        var jumlahout = $('#jumlahoutput').val();

        if (kodeakunout == "000") {
            swal("Kode Akun Belum di Pilih!", "", "error")
        } else if (tanggalout == " ") {
            swal("Tanggal Belum di Isi!", "", "error")
        } else if (keteranganout == "") {
            swal("Keterangan Belum di Isi!", "", "error")
        } else if (paytoout == "") {
            swal("Payto Belum di Isi!", "", "error")
        } else if (jumlahout == "") {
            swal("Jumlah Belum di Isi!", "", "error")
        } else {
            $.ajax({
                url: '../models/input.php',
                type: 'post',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $('.spinn').show();
                },
                success: function(hasil) {
                    // alert(hasil);
                    console.log(hasil);
                    //sukses
                    if (hasil == 1) {
                        swal("Input Gagal!", "", "error")
                    } else if (hasil == 2) {
                        swal("Tanggal tidak sesuai dengan bulan ini!", "", "error")
                    } else if (hasil == 3) {
                        swal({
                            title: "Input Berhasil!",
                            type: "success",
                            //text: "I will close in 2 seconds.",
                            timer: 1000,
                            showConfirmButton: false
                        })
                        location.reload();

                    }
                }
            });
        }
    })

    $('.tombol-deletekas').click(function(e) {
        e.preventDefault();
        //alert('hapus');
        //var delete = 'delete';
        var tabel = 'kas';
        var iddelete = $(this).closest('tr').find('.delete_id_value').val();
        swal({
            title: "Apakah Anda Yakin?",
            text: "Data Anda Akan Terhapus!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {


                $.ajax({
                    url: '../models/delete.php',
                    type: 'post',
                    data: {
                        'tabel': tabel,
                        'delete_id': iddelete
                    },
                    success: function(hasil) {
                        // alert(hasil);
                        console.log(hasil);
                        //sukses
                        if (hasil == 2) {

                        } else if (hasil == 3) {
                            swal("Deleted!",
                                "Hapus Data Berhasil.",
                                "success");
                            location.reload();

                        }
                    }
                });
            } else {
                swal("Cancelled", "", "error");
            }
        });
    });
})
</script>