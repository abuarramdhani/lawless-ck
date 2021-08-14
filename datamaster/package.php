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
require '../controller/c_package.php';
$bagian = "Data Master";
$juhal = "Package";
?>


<body class="fixed-left">
    <div class="rowspin">
        <div class="spinn">
            <i class="fa fa-spin fa-circle-o-notch spinn2"></i>
        </div>
    </div>
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
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-box">
                                <div class="dropdown pull-right">
                                    <!-- <h4 class="header-title m-t-0">Kode Unit : <?php echo $kp; ?></h4> -->
                                </div>

                                <h4 class="header-title m-t-0">Input Package <br></h4>
                                <br>
                                <form class="form-horizontal group-border-dashed" id="formpackage">
                                    <input type="hidden" name="inputpackage">

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Nama Package</label>
                                        <div class="col-sm-8">
                                            <input autofocus type="text" class="form-control" required name="npackage" id="npackage" placeholder="Nama Package"></input>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Kategori Package</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2" name="nunit" id="nunit">
                                                <option>Pilih Unit</option>
                                                <?php foreach ($unit as $row) : ?>
                                                    <option value="<?= $row["kodeunit"] ?>">
                                                        <?= ucwords($row["namaunit"]) ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Harga Beli</label>
                                        <div class="col-sm-8">
                                            <input autofocus type="text" class="form-control" required name="nhargabeli" id="nhargabeli" placeholder="Harga Beli"></input>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-6 m-t-15">
                                            <button type="submit" class="btn btn-success waves-effect waves-light" name="tombol-package" id="tombol-package">
                                                Input Package
                                            </button>
                                            <!-- <button type="reset" class="btn btn-default waves-effect m-l-5">
                                                    Cancel
                                                </button> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- end col -->

                        <div class="col-lg-8">
                            <div class="card-box table-responsive">
                                <!-- <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="zmdi zmdi-more-vert"></i>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div> -->

                                <h4 class="header-title m-t-0 m-b-30">Daftar package</h4>


                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode package</th>
                                            <th>Nama package</th>
                                            <th>Unit</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Stok</th>
                                            <th>Min Stok</th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($kodepackage as $row) : ?>
                                            <tr>
                                                <td width="2%" ;><?= $i ?></td>
                                                <td><?= $row["kodepackage"] ?></td>
                                                <td><?= ucwords($row["namapackage"]) ?></td>
                                                <td><?= $row["namaunit"] ?></td>
                                                <td><?= $row["harga"] ?></td>
                                                <td><?= $row["hargaj"] ?></td>
                                                <td><?= $row["stok"] ?></td>
                                                <td><?= $row["minstok"] ?></td>
                                                <td>
                                                    <a class="on-default edit-row badge badge-success tombol-edit" data-kodeunit="<?= $row['kodeunit']; ?>" data-kodepackage="<?= $row["kodepackage"] ?>" data-namapackage="<?= $row['namapackage']; ?>" data-harga="<?= $row['harga']; ?>" data-hargaj="<?= $row["hargaj"] ?>" data-stok="<?= $row['stok']; ?>" data-mstok="<?= $row['minstok']; ?>"><i class="fa fa-pencil"></i></a>
                                                    <input type="hidden" class="delete_id_value" value="<?= $row["id"] ?>">
                                                    <?php if ($_SESSION['userlevel'] == 0) : ?>
                                                        | <a class="on-default remove-row badge badge-danger tombol-deletepackage"><i class="fa fa-trash-o"></i></a>
                                                    <?php endif ?>
                                                </td>

                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
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

    <div id="modaledit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2 class="modal-title">Edit Item package</h2>
                </div>
                <form id="formupdate">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="kodepackage" name="updatepackage">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="namapackage" class="control-label">Nama
                                            package</label>
                                        <input type="text" class="form-control namapackage" id="namapackage" name="namapackage">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stok" class="control-label">
                                            Stok</label>
                                        <input type="text" class="form-control stok" id="stok" name="stok">
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="minstok" class="control-label">Minimal
                                            Stok</label>
                                        <input type="text" class="form-control mstok" id="mstok" name="mstok">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nunit" class="control-label">Unit</label>
                                        <select class="form-control select2 kodeunit" id="kodeunit" name="uunit">
                                            <option>Pilih Unit</option>
                                            <?php foreach ($unit as $row) : ?>
                                                <option value="<?= $row["kodeunit"] ?>">
                                                    <?= ucwords($row["namaunit"]) ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hargabeli" class="control-label">Harga
                                            Beli</label>
                                        <input type="text" class="form-control harga" id="harga" name="harga">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hargajual" class="control-label">Harga
                                            Jual</label>
                                        <input type="text" class="form-control hargaj" id="hargaj" name="hargaj">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success waves-effect" id="tombol-update">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div><!-- /.modal -->

    <?php require '../include/scriptfooter.php'; ?>

</body>

</html>

<script>
    $(document).ready(function() {
        $('#tombol-package').click(function(e) {

            // alert('ok')

            e.preventDefault();
            var dataform = $('#formpackage')[0];
            var data = new FormData(dataform);


            var npackage = $('#npackage').val();
            var nhargabeli = $('#nhargabeli').val();
            var nunit = $('#nunit').val();


            if (npackage == "") {
                swal("Nama package belum di isi!", "", "error")
            } else if (nunit == "Pilih Unit") {
                swal("Nama Unit belum di Pilih!", "", "error")
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
                        // $('.spinn').show();
                        $('.rowspin').css('display', 'flex');
                    },
                    success: function(hasil) {
                        // alert(hasil);
                        $('.spinn').hide();
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
                                timer: 2000,
                                showConfirmButton: false
                            })
                            location.reload();

                        } else if (hasil == 4) {
                            swal("Nama package Sudah Terdaftar!", "", "error")
                        }
                    }
                });
            }
        })

        // $('.tombol-edit').on('click', function() {
        $('#datatable').on('click', '.tombol-edit', function() {

            const kodepackage = $(this).data('kodepackage');
            const namapackage = $(this).data('namapackage');
            const harga = $(this).data('harga');
            const hargaj = $(this).data('hargaj');
            const stok = $(this).data('stok');
            const mstok = $(this).data('mstok');
            const kodeunit = $(this).data('kodeunit');


            $('.kodeunit').val(kodeunit);
            $('#kodeunit').trigger('change');
            $('.kodepackage').val(kodepackage);
            $('.namapackage').val(namapackage);
            $('.harga').val(harga);
            $('.hargaj').val(hargaj);
            $('.stok').val(stok);
            $('.mstok').val(mstok);
            $('#modaledit').modal('show');
        });

        $('#tombol-update').click(function(e) {


            e.preventDefault();
            var dataform = $('#formupdate')[0];
            var data = new FormData(dataform);
            // console.log(data);

            var namapackage = $('#namapackage').val();
            var mstok = $('#mstok').val();
            var harga = $('#harga').val();
            var hargaj = $('#hargaj').val();
            var stok = $('#stok').val();
            // console.log(namapackage);
            // console.log(mstok);
            // console.log(harga);
            // console.log(hargaj);
            // alert(hargaj);

            if (namapackage == "") {
                swal("package belum di isi!", "", "error")
            } else {

                $.ajax({
                    url: '../models/edit.php',
                    // url: '../controller/c_supplier.php',
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
                            swal("Tidak Berhasil ditambahkan!", "", "error")
                        } else if (hasil == 3) {
                            swal({
                                title: "Update Berhasil!",
                                type: "success",
                                //text: "I will close in 2 seconds.",
                                timer: 2000,
                                showConfirmButton: false
                            })
                            location.reload();

                        }
                    }
                });
            }
        })



        // $('.tombol-deletebahan').click(function(e) {
        $('#datatable').on('click', '.tombol-deletepackage', function(e) {


            e.preventDefault();
            //alert('hapus');
            //var delete = 'delete';
            var tabel = 'package';
            var iddelete = $(this).closest('tr').find('.delete_id_value').val();


            console.log(tabel)
            console.log(iddelete)
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