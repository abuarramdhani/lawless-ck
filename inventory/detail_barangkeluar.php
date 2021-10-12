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
// require '../controller/c_data-po.php';
$bagian = "Inventory";
$juhal = "Bahan Keluar";
require '../controller/c_detail-barangkeluar.php';

$tabel = 'form_storebahan';
include '../models/cek.php';



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

                                <h4 class="header-title m-t-0 m-b-20">Detail Bahan Order</h4>

                                <div class="pull-left m-b-20">
                                    <table class="">
                                        <tr>
                                            <td style="font-weight: 600; width:100px">No Form</td>
                                            <td><?= $detail['No_form']; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 600; width:100px">Outlet</td>
                                            <td><?= ucwords($detail['nama']); ?></td>
                                        </tr>
                                        <!-- <tr>
                                            <td style="font-weight: 600; width:100px">Alamat</td>
                                            <td><?= $detail['alamatsupplier']; ?></td>
                                        </tr> -->
                                        <!--<tr>-->
                                        <!--    <td style="font-weight: 600; width:100px">Status</td>-->
                                        <!--    <form method="POST">-->
                                        <!--        <input type="hidden" name="status">-->
                                        <!--        <input type="hidden" name="No_form" value="<?= $detail['No_form']; ?>">-->
                                        <!--        <?php if ($sot == 0 && $sck == 0) : ?>-->
                                        <!--            <td><a><button type="submit" value="<?= $sot ?>" name="sot" class="btn btn-danger waves-effect waves-light btn-xs m-b-5">Confirm</button></a>-->
                                        <!--            </td>-->
                                        <!--        <?php elseif ($sot == 1 && $sck == 0) : ?>-->
                                        <!--            <td><a> <button type="submit" value="<?= $sot; ?>" name="sot" class="btn btn-info waves-effect waves-light btn-xs m-b-5">Confirmed</button></a>-->
                                        <!--            </td>-->
                                        <!--        <?php elseif ($sot == 2 && $sck == 0) : ?>-->
                                        <!--            <td><button type="submit" value="<?= $sck; ?>" name="sck" class="btn btn-success waves-effect waves-light btn-xs m-b-5">Checked by Manager</button>-->
                                        <!--            </td>-->
                                        <!--        <?php elseif ($sot == 2  && $sck == 1) : ?>-->
                                        <!--            <td><button type="submit" value="<?= $sck; ?>" name="sck" class="btn btn-success waves-effect waves-light btn-xs m-b-5">Checked by CK</button>-->
                                        <!--            </td>-->
                                        <!--        <?php elseif ($sot == 2  && $sck == 2) : ?>-->
                                        <!--            <td><button class="btn btn-primary waves-effect waves-light btn-xs m-b-5">Delivery</button>-->
                                        <!--            </td>-->
                                        <!--        <?php endif ?>-->
                                        <!--    </form>-->
                                        <!--</tr>-->
                                    </table>
                                </div>
                                <div class="pull-right">
                                    <a href="report_detail-barangkeluar?No_form=<?= $No_form; ?>" target="_blank" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print m-r-5"></i>Cetak</a>
                                    <!-- <?php if ($sot == 2 and $sck == 2) : ?>
                                        <a href="surat_jalan?No_form=<?= $No_form; ?>" target="_blank" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print m-r-5"></i>Cetak Surat Jalan</a>
                                    <?php else : ?>
                                        <a href="report?No_form=<?= $No_form; ?>" target="_blank" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print m-r-5"></i>Cetak</a>
                                    <?php endif; ?> -->
                                </div>


                                <table id="" class="table table-striped table-bordered m-t-5">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Unit</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <?php $i = 1; ?>
                                    <tbody>
                                        <?php foreach ($item_po as $item) : ?>
                                            <tr>
                                                <td><?= $i++;  ?></td>
                                                <td><?= $item['namabarang']; ?></td>
                                                <td>Rp. <?= format_rupiah($item['harga']); ?></td>
                                                        <td><?= $item['qty']  ?></td>
                                                        <td><?= $item['namaunit']  ?></td>
                                                        <td>Rp. <?= format_rupiah($item['subtotal']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                                    <th colspan="5" class="text-center">TOTAL</th>
                                                    <th>Rp. <?= format_rupiah($grand_total['grand_total']) ?></th>
                                                </tr>

                                    </tbody>
                                </table>
                                <a href="barangkeluar" class="btn btn-primary"><i class="fa fa-angle-left" style="margin-right: 8px;"></i>Back</a>
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