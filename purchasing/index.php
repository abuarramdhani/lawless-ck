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
$tabel = 'form_po';
$tabel_join = 'supplier';
$kode = 'supplier';
include '../models/information.php';
include '../include/filter_date.php';
$bagian = "Purchasing";
$juhal = "Data PO";
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

                    

                    <!-- <div class="row">
                        <form method="post" enctype="multipart/form-data" action="../models/importexcel.php">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">Import Excel</label>
                                    <input type="hidden" name="importpo">
                                    <div>
                                        <input type="file" name="import" class="dropify" data-height="100" />
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-purple">Import</button>
                            </div>
                        </form>
                    </div> -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card-box">
                                <div class="dropdown pull-right">
                                    <!--  <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modalproyek">Input Proyek</button> -->
                                </div>
                                <div class="dropdown pull-centre">
                                    <a class="btn btn-danger  waves-effect waves-light">Check : <?= $check['informasi'] ?>
                                    </a>
                                    <a class="btn  btn-custom waves-effect waves-light">
                                        Checked by Manager : <?= $c_admin['informasi'] ?></a>
                                    <?php if($kodeoutlet != 'OUT002'):?>
                                    <a class="btn  btn-info waves-effect waves-light">
                                        Checked by CK : <?= $c_manager['informasi'] ?></a>
                                    <?php endif ?>
                                    <a class="btn  btn-primary waves-effect waves-light">
                                        Delivery : <?= $delivery['informasi'] ?></a>
                                    <a class="btn  btn-success waves-effect waves-light">
                                        Delivered : <?= $delivered['informasi'] ?></a>
                                </div>

                            </div>
                        </div><!-- end col -->

                        <div class="col-lg-6">
                            <div class="card-box">
                            
                                <form method="post" action="">
                                    <input type="hidden" name="filter-date">

                                    <?php require '../include/tgltahun.php'; ?>

                                </form>

</div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <?php //var_dump($data) ?> 
                                <h4 class="header-title m-t-0 m-b-30">Data PO</h4>
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>No. Form PO</th>
                                            <th>Supplier</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        
                                        <?php if (isset($data)) : ?>
                                            <?php $i = 1 ?>

                                            <?php foreach ($data as $dp) : ?>
                                                <?php if ($dp['kodeoutlet'] == $kodeoutlet) : ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td><?= tgl_indo($dp['date']); ?></td>
                                                        <td><?= $dp['No_form']; ?></td>
                                                        <td><?= ucwords($dp['namasupplier']) ?></td>

                                                        <?php if ($dp['status_ot'] == 0 && $dp['status_ck'] == 0) : ?>
                                                            <td><span class="label label-danger">Confirm</span>
                                                            </td>
                                                        <?php elseif ($dp['status_ot'] == 1 && $dp['status_ck'] == 0) : ?>
                                                            <td><span class="label label-default">Checked by Manager</span></td>
                                                        <?php elseif ($dp['status_ot'] == 1 && $dp['status_ck'] == 1) : ?>
                                                            <td><span class="label label-info">Checked by CK</span></td>
                                                        <?php elseif ($dp['status_ot'] == 1 && $dp['status_ck'] == 2) : ?>
                                                            <td><span class="label label-primary">Delivery</span></td>
                                                        <?php elseif ($dp['status_ot'] == 2 && $dp['status_ck'] == 2) : ?>
                                                            <td><span class="label label-success">Delivered</span></td>
                                                        <?php endif ?>

                                                        <td><a href="detail.php?No_form=<?= $dp['No_form']; ?>" class="btn btn-icon waves-effect waves-light btn-primary btn-xs m-b-5">Details</a>
                                                        </td>
                                                    </tr>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php endif ?>

                                    </tbody>
                                </table>
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