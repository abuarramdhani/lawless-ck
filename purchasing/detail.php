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
// require '../controller/c_kaskecil.php';
require '../controller/c_data-po.php';
$bagian = "Purchasing";
$juhal = "Detail PO";
?>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <?php require '../include/topbar.php'; ?>

        <?php require '../include/sidebar.php'; ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">

                                <h4 class="header-title m-t-0 m-b-20">Detail PO</h4>
                                <div class="col-6 m-b-25">
                                    <table class="">
                                        <tr>
                                            <td style="font-weight: 600; width:100px">No Form PO</td>
                                            <td>PO2107170001</td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 600; width:100px">Supplier</td>
                                            <td>Sejahterah Sayur</td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 600; width:100px">Status</td>
                                            <td><span class="label label-success">Konfirmasi</span></td>
                                        </tr>
                                    </table>
                                </div>

                                <table id="" class="table table-striped table-bordered m-t-5">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Ice Cofee</td>
                                            <td>Rp. 20.000</td>
                                            <td>3</td>
                                            <td>Rp. 60.000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Ice Cofee</td>
                                            <td>Rp. 20.000</td>
                                            <td>3</td>
                                            <td>Rp. 60.000</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Total</td>
                                            <td>Rp. 120.000</td>
                                        </tr>

                                    </tbody>
                                </table>
                                <a href="index" class="btn btn-primary"><i class="fa fa-angle-left" style="margin-right: 8px;"></i>Back</a>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->

            <?php require '../include/footer.php'; ?>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

        <?php require '../include/rightsidebar.php'; ?>



    </div>
    <!-- END wrapper -->

    <?php require '../include/scriptfooter.php'; ?>

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