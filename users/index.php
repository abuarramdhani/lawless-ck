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

$bagian = "Users";
$juhal = "User Management";


?>



<body class="fixed-left" onload="sweetfunction()">

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

                                <form id="add-user" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="name" parsley-trigger="change" placeholder="Nama" class="form-control" id="name">
                                    </div>

                                    <div class="form-group">

                                        <input type="email" name="email" parsley-trigger="change" required="" placeholder="Email" class="form-control" id="emailAddress">

                                    </div>

                                    <div class="form-group">

                                        <select class="select2 form-control" id="outlet" name="outlet">
                                            <option></option>
                                            <?php foreach ($outlet as $o) : ?>

                                                <option value="<?= $o['kodeoutlet'] ?>"><?= ucwords($o['nama']) ?>
                                                </option>

                                            <?php endforeach; ?>

                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <select class="select2 form-control" id="jabatan" name="jabatan">
                                            <option></option>
                                            <?php foreach ($jabatan as $j) : ?>
                                                <option value="<?= $j['kodejabatan'] ?>">
                                                    <?= ucwords($j['namajabatan']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
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

                                <!--<h4 class="header-title m-t-0">Daftar User</h4>-->

                                <!--<hr>-->

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
                                                    <a id="edit" data-id="<?= $user['id'] ?>" data-menu="<?= $user['access_menu_id'] ?>" data-nama="<?= $user['username'] ?>" data-email="<?= $user['email'] ?>" data-outlet="<?= $user['companypanel_id'] ?>" data-jabatan="<?= $user['jabatan_id'] ?>" class="on-default edit-row badge badge-warning"><i class="fa fa-pencil"></i></a> |
                                                    <a id="delete" data-id="<?= $user['id'] ?>" class="on-default remove-row badge badge-danger"><i class="fa fa-trash-o"></i></a>
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

    <div id="edit-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                    <h4 class="modal-title" id="myModalLabel">Edit User</h4>

                </div>

                <form id="editForm" method="POST">

                    <div class="modal-body">

                        <div class="form-group">

                            <input type="text" name="name" parsley-trigger="change" placeholder="Nama" class="form-control" id="name-edit" data-parsley-id="6" required>

                        </div>

                        <div class="form-group">

                            <input type="email" name="email" parsley-trigger="change" required="" placeholder="Email" class="form-control" id="email-edit" data-parsley-id="6" readonly>

                        </div>

                        <div class="form-group">

                            <select class="select2 form-control" id="outlet-edit" name="outlet">

                                <?php foreach ($data['outlets'] as $outlet) : ?>

                                    <option value="<?= $outlet['id'] ?>">
                                        <?= $outlet['kodeoutlet'] . ' - ' . ucwords($outlet['nama']) ?></option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <div class="form-group">

                            <select class="select2 form-control" id="jabatan-edit" name="jabatan">

                                <?php foreach ($data['jabatans'] as $jabatan) : ?>

                                    <option value="<?= $jabatan['id'] ?>">
                                        <?= $jabatan['kodejabatan'] . ' - ' . ucwords($jabatan['namajabatan']) ?></option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <input type="hidden" id="id" name="id">

                        <input type="hidden" id="menu" name="menu_id">

                        <input type="hidden" name="update">

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Batal</button>

                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>

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
                            $('.spinn').show();
                        },
                        success: function(hasil) {
                            // alert(hasil);
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