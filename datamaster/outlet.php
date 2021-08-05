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
require '../controller/c_outlet.php';
$bagian = "Data Master";
$juhal = "Outlet";
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
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-box">
                                <div class="dropdown pull-right">
                                    <!-- <h4 class="header-title m-t-0">Kode outlet : <?php echo $kp; ?></h4> -->
                                </div>

                                <h4 class="header-title m-t-0">Input Outlet <br></h4>
                                <br>
                                <form class="form-horizontal group-border-dashed" id="formoutlet">
                                    <input type="hidden" value="inputoutlet" id="inputoutlet" name="inputoutlet">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Nama Outlet</label>
                                        <div class="col-sm-8">
                                            <input autofocus type="text" class="form-control" required name="noutlet" id="noutlet" placeholder="Nama Outlet"></input>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-6 m-t-15">
                                            <button type="submit" class="btn btn-success waves-effect waves-light" name="tombol-outlet" id="tombol-outlet">
                                                Input Outlet
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

                                <h4 class="header-title m-t-0 m-b-30">Daftar Outlet</h4>
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Outlet</th>
                                            <th>Nama Outlet</th>
                                            <th>No Telp</th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($kodeoutlet as $row) : ?>
                                            <tr>
                                                <td width="2%" ;><?= $i ?></td>
                                                <td>
                                                    <?= $row["kodeoutlet"] ?></td>
                                                <td><?= ucwords($row["nama"]) ?></td>
                                                <td><?= $row["notelp"] ?></td>
                                                <td>
                                                    <a class="on-default edit-row badge badge-success tombol-edit" data-kode="<?= $row['kodeoutlet']; ?>" data-nama="<?= $row['nama']; ?>" data-notelp="<?= $row['notelp']; ?>"><i class="fa fa-pencil"></i></a>
                                                    <input type="hidden" class="delete_id_value" value="<?= $row["id"] ?>">
                                                    <?php if ($_SESSION['userlevel'] == 0) : ?>
                                                        | <a class="on-default remove-row badge badge-danger tombol-deleteoutlet"><i class="fa fa-trash-o"></i></a>
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
                    <h2 class="modal-title">Edit outlet</h2>
                </div>
                <form id="formupdate">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="kode" name="update-outlet">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unama" class="control-label">Nama Outlet</label>
                                        <input type="text" class="form-control" id="unama" name="unama">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unotelp" class="control-label">No Telp.</label>
                                        <input type="text" class="form-control" id="unotelp" name="unotelp">
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
        $('#tombol-outlet').click(function(e) {

            e.preventDefault();
            var dataform = $('#formoutlet')[0];
            var data = new FormData(dataform);

            var inputoutlet = $('#inputoutlet').val();
            var noutlet = $('#noutlet').val();

            if (noutlet == "") {
                swal("Nama outlet belum di isi!", "", "error")
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
                                timer: 2000,
                                showConfirmButton: false
                            })
                            location.reload();

                        } else if (hasil == 4) {
                            swal("Nama Outlet Sudah Terdaftar!", "", "error")
                        }
                    }
                });
            }
        })

        // $('#tombol-updatesupplier').click(function(e) {
        //     //alert("klik");
        //     e.preventDefault();
        //     var dataform = $('#formupdatesupplier')[0];
        //     var data = new FormData(dataform);

        //     var updatesupplier = $('#updatesupplier').val();
        //     var idsupplier = $('#idsupplier').val();
        //     var namasupplier = $('#namasupplier').val();
        //     var nohpsupplier = $('#nohpsupplier').val();
        //     var alamatsupplier = $('#alamatsupplier').val();
        //     //alert(nsupplier);

        //     if (namasupplier == " ") {
        //         swal("Nama Supplier belum di isi!", "", "error")
        //     } else {
        //         $.ajax({
        //             url: '../models/edit.php',
        //             type: 'post',
        //             data: data,
        //             enctype: 'multipart/form-data',
        //             processData: false,
        //             contentType: false,
        //             cache: false,
        //             beforeSend: function() {
        //                 $('.spinn').show();
        //             },
        //             success: function(hasil) {
        //                 // alert(hasil);
        //                 console.log(hasil);
        //                 //sukses
        //                 if (hasil == 1) {
        //                     swal("Input Gagal!", "", "error")

        //                 } else if (hasil == 3) {
        //                     swal({
        //                         title: "Edit Berhasil!",
        //                         type: "success",
        //                         //text: "I will close in 2 seconds.",
        //                         timer: 2000,
        //                         showConfirmButton: false
        //                     })
        //                     location.reload();
        //                 }
        //             }
        //         });
        //     }
        // })

        $('#datatable').on('click', '.tombol-edit', function() {

            const nama = $(this).data('nama');
            const kode = $(this).data('kode');
            const notelp = $(this).data('notelp');


            $('#unama').val(nama);
            $('#kode').val(kode);
            $('#unotelp').val(notelp);
            $('#modaledit').modal('show');
        });

        $('#tombol-update').click(function(e) {


            e.preventDefault();
            var dataform = $('#formupdate')[0];
            var data = new FormData(dataform);
            // console.log(data);

            var namajabatan = $('#namajabatan').val();
            // console.log(namabahan);
            // console.log(mstok);
            // console.log(harga);



            if (namajabatan == "") {
                swal("nama jabatan belum di isi!", "", "error")
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

        // $('.tombol-deleteoutlet').click(function(e) {
        $('#datatable').on('click', '.tombol-deleteoutlet', function(e) {
            e.preventDefault();
            //alert('hapus');
            //var delete = 'delete';
            var tabel = 'companypanel';
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