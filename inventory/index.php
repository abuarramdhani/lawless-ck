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
// require '../controller/c_data_in.php';
$tabel = 'form_in';
$tabel_join = 'supplier';
$kode = 'supplier';
include '../include/filter_date.php';
$bagian = "Inventory";
$juhal = "Data Bahan";
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

                    <div id="input-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h2 class="modal-title">Transaksi Pemasukan Kas</h2>
                                </div>
                                <form id="formkasmasuk">
                                    <div class="modal-body">
                                        <div class="row">
                                            <input type="hidden" value="kasmasuk" id="kasmasuk" name="kasmasuk">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kodeakun" class="control-label">Kode Transaksi</label>
                                                    <select class="form-control select2" name="kodeakun" id="kodeakun">
                                                        <option value="000">Kode Akun</option>
                                                        <?php foreach ($kodeakunp as $row) : ?>
                                                            <option value="<?= $row['kodeakun3'] ?>">
                                                                <?= ucwords($row["ketkode3"]) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="datepicker-autoclose" class="control-label">Tanggal</label>
                                                    <input type="text" class="form-control" id="datepicker-autoclose" value="<?= date('m/d/Y') ?>" name="tanggal">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="keterangan" class="control-label">Keterangan</label>
                                                    <input type="text" class="form-control" id="keterangan" placeholder="Keterangan Transaksi" name="keterangan">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="payto" class="control-label">Pay to / Recieved</label>
                                                    <input type="text" class="form-control" id="payto" placeholder="Pay to / Recieved" name="payto">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jumlahinput" class="control-label">Jumlah</label>
                                                    <input type="text" class="form-control" id="jumlahinput" name="jumlahinput">
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default waves-effect" id="tombol-kasmasuk">Input</button>
                                        <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal -->

                    <div id="output-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h2 class="modal-title">Transaksi Pengeluaran Kas</h2>
                                </div>
                                <form id="formkaskeluar">
                                    <div class="modal-body">
                                        <div class="row">
                                            <input type="hidden" value="kaskeluar" id="kaskeluar" name="kaskeluar">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kodeakunout" class="control-label">Kode
                                                        Transaksi</label>
                                                    <select class="form-control select2" name="kodeakunout" id="kodeakunout">
                                                        <option value="000">Kode Akun</option>
                                                        <?php foreach ($kodeakune as $row) : ?>
                                                            <option value="<?= $row['kodeakun3'] ?>">
                                                                <?= ucwords($row["ketkode3"]) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="datepicker-autoclose1" class="control-label">Tanggal</label>
                                                    <input type="text" class="form-control" id="datepicker-autoclose1" value="<?= date('m/d/Y') ?>" name="tanggalout">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="keteranganout" class="control-label">Keterangan</label>
                                                    <input type="text" class="form-control" id="keteranganout" placeholder="Keterangan Transaksi" name="keteranganout">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paytoout" class="control-label">Pay to /
                                                        Recieved</label>
                                                    <input type="text" class="form-control" id="paytoout" placeholder="Pay to / Recieved" name="paytoout">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Jumlah</label>
                                                    <input type="text" class="form-control" id="jumlahoutput" name="jumlahoutput">
                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default waves-effect" id="tombol-kaskeluar">Input</button>
                                        <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div><!-- /.modal -->


                    <div class="row">
                        <div class="col-lg-7">
                            <div class="card-box">

                                <div class="dropdown pull-right">

                                    <!--  <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modalproyek">Input Proyek</button> -->
                                </div>
                                <div class="dropdown pull-centre">
                                    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#input-close-modal">Pemasukan : Rp. 0
                                    </button>
                                    <button class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#output-close-modal">
                                        Pengeluaran : Rp. 0</button>

                                    <!-- <button class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#output-close-modal">
                                        Saldo Kas : Rp. 0</button> -->

                                    <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#output-close-modal">
                                        Saldo Kas : Rp. 0</button>
                                </div>

                            </div>
                        </div><!-- end col -->

                        <div class="col-lg-5">
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

                                <h4 class="header-title m-t-0 m-b-30">Data Inventory</h4>
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>No. Form IN</th>
                                            <th>No. Form PO</th>
                                            <th>Supplier</th>
                                            <!-- <th>Status</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (isset($data)) : ?>
                                            <?php $i = 1 ?>
                                            <?php foreach ($data as $dp) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $dp['date']; ?></td>
                                                    <td><?= $dp['No_form']; ?></td>
                                                    <td><?= $dp['Form_po']; ?></td>

                                                    <td><?= $dp['namasupplier'] ?></td>
                                                    <!-- <?php if ($dp['status_ot'] == 0 && $dp['status_ck'] == 0) : ?>
                                                        <td><span class="label label-danger">Confirm</span></td>
                                                    <?php elseif ($dp['status_ot'] == 1 && $dp['status_ck'] == 0) : ?>
                                                        <td><span class="label label-info">Confirmed</span></td>
                                                    <?php elseif ($dp['status_ot'] == 2 && $dp['status_ck'] == 0) : ?>
                                                        <td><span class="label label-success">Checked by Manager</span></td>
                                                    <?php elseif ($dp['status_ot'] == 2 && $dp['status_ck'] == 1) : ?>
                                                        <td><span class="label label-success">Checked by CK</span></td>
                                                    <?php elseif ($dp['status_ot'] == 2 && $dp['status_ck'] == 2) : ?>
                                                        <td><span class="label label-primary">Delivery</span></td>
                                                    <?php endif ?> -->

                                                    <td><a href="detail.php?No_form=<?= $dp['No_form']; ?>" class="btn btn-icon waves-effect waves-light btn-xs btn-primary m-b-5">Details</a>
                                                    </td>
                                                </tr>
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