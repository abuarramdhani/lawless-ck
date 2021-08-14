<?php

require_once "../vendor/autoload.php";
session_start();
if (!isset($_SESSION['email'])) {
    header("location:../index");
    exit;
}

require_once '../include/fungsi.php';
require_once '../include/header.php';
include '../controller/c_users.php';
include '../models/user.php';

$bagian = "User";
$juhal = "Users";


?>



<body class="fixed-left" onload="sweetfunction()">
    <div class="rowspin">
        <div class="spinn">
            <i class="fa fa-spin fa-circle-o-notch spinn2"></i>
        </div>
    </div>
    <div id="wrapper">
        <?php require_once '../include/topbar.php'; ?>
        <?php require_once '../include/sidebar.php'; ?>
        <div class="content-page">
            <!-- terima msg -->
            <?php if (isset($_SESSION['msg'])) : ?>
                <div id="msg" data-msg="<?= $_SESSION["msg"] ?>"></div>
                <?php unset($_SESSION['msg']); ?>
            <?php endif ?>
            <!-- akhir terima msg -->

            <div class="content">


                <div class="container">

                    <div class="row">

                        <div class="col-lg-4">

                            <div class="card-box">

                                <!--<h4 class="header-title m-t-0">Tambah User</h4>-->

                                <!--<hr>-->

                                <form id="add-user" class="form-horizontal group-border-dashed" method="POST">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Nama</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="name" placeholder="Nama" class="form-control" id="name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Email</label>
                                        <div class="col-sm-8">

                                            <input type="email" name="email" parsley-trigger="change" required="" placeholder="Email" class="form-control" id="emailAddress">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Outlet</label>
                                        <div class="col-sm-8">
                                            <select class="select2 form-control" id="outlet" name="outlet">
                                                <option>Pilih Outlet</option>
                                                <?php foreach ($outlet as $o) : ?>

                                                    <option value="<?= $o['kodeoutlet'] ?>"><?= ucwords($o['nama']) ?>
                                                    </option>

                                                <?php endforeach; ?>

                                            </select>
                                        </div>


                                    </div>
                                    <?php $jab = query("SELECT * from jabatan "); ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">jabatan</label>
                                        <div class="col-sm-8">
                                            <select class="select2 form-control" id="jabatan" name="jabatan">
                                                <option>Pilih Jabatan</option>
                                                <?php foreach ($jab as $j) : ?>
                                                    <option value="<?= $j['kodejabatan'] ?>">
                                                        <?= ucwords($j['namajabatan']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    </div>
                                    <input type="hidden" name="tambah-user">
                                    <div class="form-group text-right m-b-0">
                                        <button type="submit" id="tombol-simpan" class="btn btn-success waves-effect waves-light">Simpan</button>
                                    </div>
                                </form>

                            </div>

                        </div>

                        <div class="col-lg-8">
                            <div class="card-box">
                                <table id="datatable" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Outlet</th>
                                            <th>Jabatan</th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>

                                        <?php $i = 1; ?>

                                        <?php foreach ($users as $user) : ?>
                                            <tr>
                                                <th><?= $i++ ?></th>
                                                <td><?= ucwords($user['username']) ?></td>
                                                <td><?= $user['email'] ?></td>
                                                <td>
                                                    <?php
                                                    $kodeoutlet = $user['outlet'];
                                                    if ($kodeoutlet != "OUT000") {
                                                        $ka = "SELECT * FROM companypanel WHERE kodeoutlet ='$kodeoutlet'"; //perintah untuk menjumlahkan
                                                        $hasilka = mysqli_query($conn, $ka); //melakukan query dengan varibel $jumlahkan
                                                        $tampil = mysqli_fetch_array($hasilka); //menyimpan hasil query ke variabel $t
                                                        echo $tampilkode = ucwords($tampil['nama']);
                                                    } else {;
                                                        echo "Super Outlet";
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <?php
                                                    $kodejabatan = $user['jabatan'];
                                                    if ($kodejabatan != "JAB000") {
                                                        $ka = "SELECT * FROM jabatan WHERE kodejabatan ='$kodejabatan'"; //perintah untuk menjumlahkan
                                                        $hasilka = mysqli_query($conn, $ka); //melakukan query dengan varibel $jumlahkan
                                                        $tampil = mysqli_fetch_array($hasilka); //menyimpan hasil query ke variabel $t
                                                        echo $tampilkode = ucwords($tampil['namajabatan']);
                                                    } else {;
                                                        echo "Super User";
                                                    }
                                                    ?>
                                                </td>

                                                <td class="actions">
                                                    <a id="tombol-edit" data-id="<?= $user['id'] ?>" data-nama="<?= $user['username'] ?>" data-outlet="<?= $user['outlet'] ?>" data-jabatan="<?= $user['jabatan'] ?>" data-email="<?= $user['email'] ?>" class="on-default edit-row badge badge-warning"><i class="fa fa-pencil"></i></a>
                                                    <a id="tombol-hapus" data-id="<?= $user['id'] ?>" class="on-default remove-row badge badge-danger "><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php require_once '../include/footer.php'; ?>

        </div>

    </div>

    <div id="modaledit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                </div>
                <form id="editForm">

                    <div class="modal-body">

                        <div class="form-group">
                            <input type="text" name="name" parsley-trigger="change" placeholder="Nama" class="form-control" id="name-edit" data-parsley-id="6" required>
                        </div>

                        <div class="form-group">

                            <input type="email" name="email" parsley-trigger="change" required="" placeholder="Email" class="form-control" id="email-edit" data-parsley-id="6" readonly>

                        </div>

                        <div class="form-group">
                            <select class="select2 form-control" id="outlet-edit" name="outlet">

                                <?php foreach ($outlet as $row) : ?>
                                    <option value="<?= $row['kodeoutlet']; ?>">
                                        <?= ucwords($row["nama"]) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="select2 form-control" id="jabatan-edit" name="jabatan">

                                <?php foreach ($jab as $row) : ?>
                                    <option value="<?= $row['kodejabatan']; ?>">
                                        <?= ucwords($row["namajabatan"]) ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <!-- <input type="hidden" id="id" name="id"> -->
                        <input type="hidden" id="id" name="update-user">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="tombol-update">Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

    </div><!-- /.modal -->

    <?php require_once '../include/scriptfooter.php'; ?>

    <script>
        // $("#total-harga").val('Rp. ' + sum)
        function sweetfunction() {

            const msg = $('#msg').data('msg');

            if (msg == 1) {
                swal({
                    title: "Input Berhasil!",
                    type: "success",
                    //text: "I will close in 2 seconds.",
                    timer: 1500,
                    showConfirmButton: false

                })
                // // sleep(1000);
                // setTimeout(function() {
                //     window.location.replace("../purchasing/");
                // }, 1300);

            } else if (msg == 2) {
                swal("Kode Akun Belum di Pilih!", "", "error")
            }

        }
        $(document).ready(function() {

            // tambah data
            $('#tombol-simpan').click(function(e) {

                e.preventDefault();
                var dataform = $('#add-user')[0];
                var data = new FormData(dataform);

                var name = $('#name').val();
                var emailAddress = $('#emailAddress').val();
                var outlet = $('#outlet').val();
                var jabatan = $('#jabatan').val();
                //alert(ngambar)
                if (name == "") {
                    swal("Nama belum di isi!", "", "error")
                } else if (emailAddress == "") {
                    swal("Email belum di isi!", "", "error")
                } else if (outlet == "") {
                    swal("Outlet belum di isi!", "", "error")
                } else if (jabatan == "") {
                    swal("jabatan belum di isi!", "", "error")
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
                                swal("Email sudah terdaftar", "", "error")
                            } else if (hasil == 2) {
                                swal("Input Gagal!", "", "error")
                            } else if (hasil == 3) {
                                swal({
                                    title: "Input Berhasil!",
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
            // akhir tambah data

            // awal update
            $('#datatable').on('click', '#tombol-edit', function(e) {

                var id = $(this).data("id");
                var nama = $(this).data("nama");
                var email = $(this).data("email");
                var outlet = $(this).data("outlet");
                var jabatan = $(this).data("jabatan");

                console.log(id)
                console.log(nama)
                console.log(email)
                console.log(outlet)
                console.log(jabatan)

                $("#name-edit").val(nama);
                $("#email-edit").val(email);
                $("#outlet-edit").val(outlet);
                $("#id").val(id);
                $("#outlet-edit").trigger("change");
                $("#jabatan-edit").val(jabatan);
                $("#jabatan-edit").trigger("change");
                // $('.id').val(id);
                // $('.menu').val(menu);
                // $('.url').val(url);
                $('#modaledit').modal('show');
            });

            $('#tombol-update').click(function(e) {

                e.preventDefault();
                var dataform = $('#editForm')[0];
                var data = new FormData(dataform);

                var uemail = $('#email-edit').val();
                var uoutlet = $('#outlet-edit').val();
                var uname = $('#name-edit').val();
                var ujabatan = $('#jabatan-edit').val();

                //alert(nsupplier);

                if (uemail == " ") {
                    swal("Email belum di isi!", "", "error")
                } else {
                    $.ajax({
                        url: '../models/edit.php',
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

                            } else if (hasil == 3) {
                                swal({
                                    title: "Edit Berhasil!",
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
            // akhir update

            // awal hapus data
            $('#datatable').on('click', '#tombol-hapus', function(e) {
                e.preventDefault();
                const tabel = 'admin';
                const id = $(this).data('id');
                const href = $(this).attr('href');
                swal({
                    title: 'Anda Yakin ingin menghapus?',
                    text: "Data Akan Dihapus",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya',
                    cancelButtonText: `Tidak`
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: '../models/delete.php',
                            type: 'post',
                            data: {
                                'tabel': tabel,
                                'delete_id': id
                            },
                            success: function(hasil) {
                                // alert(hasil);
                                console.log(hasil);
                                //sukses
                                if (hasil == 2) {

                                } else if (hasil == 3) {
                                    swal("Deleted!",
                                        "Hapus Data Berhasil.",
                                        "success")
                                    location.reload()

                                }
                            }
                        });
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
            });
            // akhir hapus data


            // $('#datatable').dataTable();

            // $('#outlet').select2({

            //     placeholder: "Pilih Outlet",

            //     allowClear: true

            // });

            // $('#jabatan').select2({

            //     placeholder: "Pilih Jabatan",

            //     allowClear: true

            // });

            // $("#add-user").on("submit", function(e) {

            //     $.ajax({

            //         url: 'add.php',

            //         data: $(this).serialize(),

            //         type: 'POST',

            //     }).done(function(result) {

            //         if (result == 1) {

            //             swal("Email sudah terdaftar!", "", "error")

            //         } else if (result == 2) {

            //             swal("Gagal menambahkan user!", "", "error")

            //         } else if (result == 3) {

            //             swal({

            //                 title: "Berhasil menambahkan user!",

            //                 type: "success",

            //                 timer: 1000,

            //                 showConfirmButton: false

            //             });

            //             location.reload();

            //         }

            //     });

            //     e.preventDefault();

            // });

            // $(document).on("click", "#edit", function() {

            //     var id = $(this).data("id");

            //     var menu = $(this).data("menu");

            //     var nama = $(this).data("nama");

            //     var email = $(this).data("email");

            //     var outlet = $(this).data("outlet");

            //     var jabatan = $(this).data("jabatan");

            //     $("#edit-user").modal("show");

            //     $("#name-edit").val(nama);

            //     $("#email-edit").val(email);

            //     $("#outlet-edit").val(outlet);

            //     $("#id").val(id);

            //     $("#menu").val(menu);

            //     $("#outlet-edit").trigger("change");

            //     $("#jabatan-edit").val(jabatan);

            //     $("#jabatan-edit").trigger("change");

            // });

            // $(document).on("click", "#delete", function(e) {

            //     var id = $(this).data("id");

            //     swal({

            //         title: "Are you sure?",

            //         text: "Data yang telah dihapus tidak dapat dikembalikan!",

            //         type: "warning",

            //         showCancelButton: true,

            //         confirmButtonClass: 'btn-danger waves-effect waves-light',

            //         confirmButtonText: 'Hapus'

            //     }, function(hapus) {

            //         if (hapus) {

            //             $.ajax({

            //                 url: 'add.php',

            //                 data: {
            //                     'id': id,
            //                     'delete': true
            //                 },

            //                 type: 'POST'

            //             }).done(function(result) {

            //                 if (!result) {

            //                     swal("Gagal menghapus data!", "", "error")

            //                 } else {

            //                     swal({

            //                         title: "Berhasil menghapus data!",

            //                         type: "success",

            //                         timer: 1000,

            //                         showConfirmButton: false

            //                     });

            //                     location.reload();

            //                 }

            //             });

            //             e.preventDefault();

            //         }

            //     });

            // });

            // $("#editForm").on("submit", function(e) {

            //     $.ajax({

            //         url: 'add.php',

            //         data: $(this).serialize(),

            //         type: 'POST',

            //     }).done(function(result) {

            //         if (!result) {

            //             swal("Gagal mengubah data!", "", "error")

            //         } else {

            //             swal({

            //                 title: "Berhasil mengubah data!",

            //                 type: "success",

            //                 timer: 1000,

            //                 showConfirmButton: false

            //             });

            //             location.reload();

            //         }

            //     });

            //     e.preventDefault();

            // });



        });
    </script>

</body>