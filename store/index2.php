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
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="portfolioFilter">
                                        <a href="#" data-filter="*" class="current waves-effect waves-primary">All</a>
                                        <a href="#" data-filter=".natural"
                                            class="waves-effect waves-primary">Beverage</a>
                                        <a href="#" data-filter=".creative" class="waves-effect waves-primary">Foods</a>
                                        <a href="#" data-filter=".personal"
                                            class="waves-effect waves-primary">Snacks</a>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn waves-effect waves-light btn-primary"><i
                                                    class="fa fa-search"></i></button>
                                        </span>
                                        <input type="text" id="example-input1-group2" name="example-input1-group2"
                                            class="form-control" placeholder="Search">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card-box" style="height:500px; overflow-y: auto; ">
                                <div class="port mb-2">
                                    <div class="portfolioContainer">
                                        <div class="col-md-6 col-xl-3 col-lg-4 natural">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/products/no_image.jpg" class="image-popup"
                                                    title="Screenshot-3">
                                                    <img src="../assets/images/products/no_image.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Ice Coffee</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">20.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 natural">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/food/es kopi 3.jpg" class="image-popup"
                                                    title="Screenshot-3">
                                                    <img src="../assets/images/food/es kopi 3.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Ice Coffee</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">20.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 natural">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/food/es kopi 5.jpg" class="image-popup"
                                                    title="Screenshot-3">
                                                    <img src="../assets/images/food/es kopi 5.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Hot Coffee</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 creative">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/food/Rice Bowl.jpg" class="image-popup"
                                                    title="Screenshot-2">

                                                    <img src="../assets/images/food/Rice Bowl.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Rice Bowl</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">25.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 creative">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/food/steak.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/food/steak.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Steak</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">55.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/food/Kue Sus.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/food/Kue Sus.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Sous Cake</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/food/Donuts.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/food/Donuts.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Donuts</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/food/Donuts.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/food/Donuts.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Donuts</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/food/Donuts.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/food/Donuts.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Donuts</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/food/Donuts.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/food/Donuts.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Donuts</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/food/Donuts.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/food/Donuts.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Donuts</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/food/Donuts.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/food/Donuts.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Donuts</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/food/Donuts.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/food/Donuts.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Donuts</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>






                                    </div><!-- end portfoliocontainer-->
                                </div> <!-- End row -->
                            </div> <!-- card box -->
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="card-box" style="height:350px; overflow-y: auto;">
                                <div class="col-lg-12">
                                    <div class="responsive-table-plugin">
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Barang</th>
                                                            <th data-priority="1">Harga</th>

                                                            <th data-priority="3">Jumlah</th>
                                                            <th data-priority="1">Subtotal</th>
                                                            <th data-priority="1">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th>Ice Coffee</span></th>
                                                            <td>20000</td>
                                                            <td width="5"><input type="number" width="5"></td>
                                                            <td>40000</td>
                                                            <td>X</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Rice Bowl</span></th>
                                                            <td>25000</td>
                                                            <td width="5"><input type="number" width="5"></td>
                                                            <td>50000</td>
                                                            <td>X</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Ice Coffee</span></th>
                                                            <td>20000</td>
                                                            <td width="5"><input type="number" width="5"></td>
                                                            <td>40000</td>
                                                            <td>X</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Rice Bowl</span></th>
                                                            <td>25000</td>
                                                            <td width="5"><input type="number" width="5"></td>
                                                            <td>50000</td>
                                                            <td>X</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Ice Coffee</span></th>
                                                            <td>20000</td>
                                                            <td width="5"><input type="number" width="5"></td>
                                                            <td>40000</td>
                                                            <td>X</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Rice Bowl</span></th>
                                                            <td>25000</td>
                                                            <td width="5"><input type="number" width="5"></td>
                                                            <td>50000</td>
                                                            <td>X</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Ice Coffee</span></th>
                                                            <td>20000</td>
                                                            <td width="5"><input type="number" width="5"></td>
                                                            <td>40000</td>
                                                            <td>X</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Rice Bowl</span></th>
                                                            <td>25000</td>
                                                            <td width="5"><input type="number" width="5"></td>
                                                            <td>50000</td>
                                                            <td>X</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-box" style="height:170px; ">

                                <div class="form-group row">
                                    <div class="col-sm-4">

                                        <label class="  col-form-label" for="example-input-normal">Total</label><br>
                                        <label class="  col-form-label" for="example-input-normal">Discount
                                        </label><br>
                                        <label class="  col-form-label" for="example-input-normal">Tax</label>
                                    </div>
                                    <div class="col-sm-3">

                                        <label class="  col-form-label" for="example-input-normal">: Rp 90.000
                                        </label><br>
                                        <label class="  col-form-label" for="example-input-normal">: ....
                                        </label><br>
                                        <label class="  col-form-label" for="example-input-normal">: .... </label>
                                    </div>
                                    <div class="col-sm-5">
                                        <button class="btn btn-primary waves-effect waves-light btn-lg">
                                            <!-- <i class="far fa-money-bill-alt ml-1"></i> --> PAY
                                        </button><br>
                                        <label class="  col-form-label" for="example-input-normal">Changes : ....
                                        </label><br>
                                    </div>
                                </div>
                                <div class="form-group row text-center">
                                    <button class="btn btn-danger waves-effect waves-light mr-1">
                                        <span>Cancel</span>
                                    </button>
                                    <button class="btn btn-purple waves-effect waves-light mr-1"> <span>Save</span>
                                    </button>
                                    <button class="btn btn-purple waves-effect waves-light mr-1"> <span>Notes</span>
                                    </button>
                                    <button class="btn btn-purple waves-effect waves-light mr-1">
                                        <span>Discount</span>
                                    </button>
                                    <button class="btn btn-purple waves-effect waves-light mr-1">
                                        <span>Reprint</span>
                                    </button>
                                </div>
                            </div>
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