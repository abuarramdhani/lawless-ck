<?php

require_once "../vendor/autoload.php";

session_start();

if (!isset($_SESSION['email'])) {

    header("location:../index");

    exit;

}

require_once '../include/connection.php';

require_once '../include/fungsi.php';

require_once '../include/header.php';

include '../models/user.php';

$bagian = "Users";

$juhal = "User Management";



$userObj = new User($koneksi);

$users = $userObj->getUsers();

$data = $userObj->index();

?>



<body class="fixed-left">

    <div id="wrapper">

        <?php require_once '../include/topbar.php';?>

        <?php require_once '../include/sidebar.php';?>

        <div class="content-page">

            <div class="content">

                <div class="container">

                    <div class="row">

                        <div class="col-lg-4">

                            <div class="card-box">

                                <!--<h4 class="header-title m-t-0">Tambah User</h4>-->

                                <!--<hr>-->

                                <form id="add-user" method="POST">

                                    <div class="form-group">

                                        <input type="text" name="name" parsley-trigger="change" placeholder="Nama"
                                            class="form-control" id="name" data-parsley-id="6" required>

                                    </div>

                                    <div class="form-group">

                                        <input type="email" name="email" parsley-trigger="change" required=""
                                            placeholder="Email" class="form-control" id="emailAddress"
                                            data-parsley-id="6" required>

                                    </div>

                                    <div class="form-group">

                                        <select class="select2 form-control" id="outlet" name="outlet">

                                            <option></option>

                                            <?php foreach($data['outlets'] as $outlet):?>

                                            <option value="<?= $outlet['id'] ?>"><?= ucwords($outlet['nama']) ?>
                                            </option>

                                            <?php endforeach;?>

                                        </select>

                                    </div>

                                    <div class="form-group">

                                        <select class="select2 form-control" id="jabatan" name="jabatan">

                                            <option></option>

                                            <?php foreach($data['jabatans'] as $jabatan):?>

                                            <option value="<?=$jabatan['id']?>"><?= ucwords($jabatan['namajabatan'])?>
                                            </option>

                                            <?php endforeach;?>

                                        </select>

                                    </div>

                                    <input type="hidden" name="submit">

                                    <div class="form-group text-right m-b-0">

                                        <button type="submit"
                                            class="btn btn-success waves-effect waves-light">Simpan</button>

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

                                        <?php $i=1;?>

                                        <?php foreach($users as $user):?>

                                        <tr>

                                            <th><?= $i++ ?></th>

                                            <td><?= ucwords($user['username']) ?></td>

                                            <td><?= ucwords($user['email']) ?></td>

                                            <td><?= ucwords($user['nama']) ?></td>

                                            <td><?= ucwords($user['namajabatan']) ?></td>

                                            <td class="actions">

                                                <a id="edit" data-id="<?=$user['id']?>"
                                                    data-menu="<?=$user['access_menu_id']?>"
                                                    data-nama="<?=$user['username']?>" data-email="<?=$user['email']?>"
                                                    data-outlet="<?=$user['companypanel_id']?>"
                                                    data-jabatan="<?=$user['jabatan_id']?>"
                                                    class="on-default edit-row badge badge-warning"><i
                                                        class="fa fa-pencil"></i></a> |

                                                <a id="delete" data-id="<?=$user['id']?>"
                                                    class="on-default remove-row badge badge-danger"><i
                                                        class="fa fa-trash-o"></i></a>

                                            </td>

                                        </tr>

                                        <?php endforeach;?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <?php require_once '../include/footer.php';?>

        </div>

    </div>

    <div id="edit-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                    <h4 class="modal-title" id="myModalLabel">Edit User</h4>

                </div>

                <form id="editForm" method="POST">

                    <div class="modal-body">

                        <div class="form-group">

                            <input type="text" name="name" parsley-trigger="change" placeholder="Nama"
                                class="form-control" id="name-edit" data-parsley-id="6" required>

                        </div>

                        <div class="form-group">

                            <input type="email" name="email" parsley-trigger="change" required="" placeholder="Email"
                                class="form-control" id="email-edit" data-parsley-id="6" readonly>

                        </div>

                        <div class="form-group">

                            <select class="select2 form-control" id="outlet-edit" name="outlet">

                                <?php foreach($data['outlets'] as $outlet):?>

                                <option value="<?= $outlet['id'] ?>">
                                    <?= $outlet['kodeoutlet'].' - '.ucwords($outlet['nama']) ?></option>

                                <?php endforeach;?>

                            </select>

                        </div>

                        <div class="form-group">

                            <select class="select2 form-control" id="jabatan-edit" name="jabatan">

                                <?php foreach($data['jabatans'] as $jabatan):?>

                                <option value="<?=$jabatan['id']?>">
                                    <?= $jabatan['kodejabatan'].' - '.ucwords($jabatan['namajabatan'])?></option>

                                <?php endforeach;?>

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

    <?php require_once '../include/scriptfooter.php';?>

    <script>
    $(document).ready(function() {

        $('#datatable').dataTable();

        $('#outlet').select2({

            placeholder: "Pilih Outlet",

            allowClear: true

        });

        $('#jabatan').select2({

            placeholder: "Pilih Jabatan",

            allowClear: true

        });

        $("#add-user").on("submit", function(e) {

            $.ajax({

                url: 'add.php',

                data: $(this).serialize(),

                type: 'POST',

            }).done(function(result) {

                if (result == 1) {

                    swal("Email sudah terdaftar!", "", "error")

                } else if (result == 2) {

                    swal("Gagal menambahkan user!", "", "error")

                } else if (result == 3) {

                    swal({

                        title: "Berhasil menambahkan user!",

                        type: "success",

                        timer: 1000,

                        showConfirmButton: false

                    });

                    location.reload();

                }

            });

            e.preventDefault();

        });

        $(document).on("click", "#edit", function() {

            var id = $(this).data("id");

            var menu = $(this).data("menu");

            var nama = $(this).data("nama");

            var email = $(this).data("email");

            var outlet = $(this).data("outlet");

            var jabatan = $(this).data("jabatan");

            $("#edit-user").modal("show");

            $("#name-edit").val(nama);

            $("#email-edit").val(email);

            $("#outlet-edit").val(outlet);

            $("#id").val(id);

            $("#menu").val(menu);

            $("#outlet-edit").trigger("change");

            $("#jabatan-edit").val(jabatan);

            $("#jabatan-edit").trigger("change");

        });

        $(document).on("click", "#delete", function(e) {

            var id = $(this).data("id");

            swal({

                title: "Are you sure?",

                text: "Data yang telah dihapus tidak dapat dikembalikan!",

                type: "warning",

                showCancelButton: true,

                confirmButtonClass: 'btn-danger waves-effect waves-light',

                confirmButtonText: 'Hapus'

            }, function(hapus) {

                if (hapus) {

                    $.ajax({

                        url: 'add.php',

                        data: {
                            'id': id,
                            'delete': true
                        },

                        type: 'POST'

                    }).done(function(result) {

                        if (!result) {

                            swal("Gagal menghapus data!", "", "error")

                        } else {

                            swal({

                                title: "Berhasil menghapus data!",

                                type: "success",

                                timer: 1000,

                                showConfirmButton: false

                            });

                            location.reload();

                        }

                    });

                    e.preventDefault();

                }

            });

        });

        $("#editForm").on("submit", function(e) {

            $.ajax({

                url: 'add.php',

                data: $(this).serialize(),

                type: 'POST',

            }).done(function(result) {

                if (!result) {

                    swal("Gagal mengubah data!", "", "error")

                } else {

                    swal({

                        title: "Berhasil mengubah data!",

                        type: "success",

                        timer: 1000,

                        showConfirmButton: false

                    });

                    location.reload();

                }

            });

            e.preventDefault();

        });



    });
    </script>

</body>

=======
<?php
require_once "../vendor/autoload.php";
session_start();
if (!isset($_SESSION['email'])) {
    header("location:../index");
    exit;
}
require_once '../include/connection.php';
require_once '../include/fungsi.php';
require_once '../include/header.php';
include '../models/user.php';
$bagian = "Users";
$juhal = "User Management";

$userObj = new User($koneksi);
$users = $userObj->getUsers();
$data = $userObj->index();
?>

<body class="fixed-left">
    <div id="wrapper">
        <?php require_once '../include/topbar.php';?>
        <?php require_once '../include/sidebar.php';?>
        <div class="content-page">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-box">
                                <!--<h4 class="header-title m-t-0">Tambah User</h4>-->
                                <!--<hr>-->
                                <form id="add-user" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="name" parsley-trigger="change" placeholder="Nama"
                                            class="form-control" id="name" data-parsley-id="6" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" parsley-trigger="change" required=""
                                            placeholder="Email" class="form-control" id="emailAddress"
                                            data-parsley-id="6" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="select2 form-control" id="outlet" name="outlet">
                                            <option></option>
                                            <?php foreach($data['outlets'] as $outlet):?>
                                            <option value="<?= $outlet['kodeoutlet'] ?>"><?= ucwords($outlet['nama']) ?>
                                            </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="select2 form-control" id="jabatan" name="jabatan">
                                            <option></option>
                                            <?php foreach($data['jabatans'] as $jabatan):?>
                                            <option value="<?=$jabatan['kodejabatan']?>">
                                                <?= ucwords($jabatan['namajabatan'])?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="submit">
                                    <div class="form-group text-right m-b-0">
                                        <button type="submit"
                                            class="btn btn-success waves-effect waves-light">Simpan</button>
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
                                        <?php $i=1;?>
                                        <?php foreach($users as $user):?>
                                        <tr>
                                            <th><?= $i++ ?></th>
                                            <td><?= ucwords($user['username']) ?></td>
                                            <td><?= ucwords($user['email']) ?></td>
                                            <td><?= ucwords($user['nama']) ?></td>
                                            <td><?= ucwords($user['namajabatan']) ?></td>
                                            <td class="actions">
                                                <a id="edit" data-id="<?=$user['id']?>"
                                                    data-menu="<?=$user['access_menu_id']?>"
                                                    data-nama="<?=$user['username']?>" data-email="<?=$user['email']?>"
                                                    data-outlet="<?=$user['companypanel_id']?>"
                                                    data-jabatan="<?=$user['jabatan_id']?>"
                                                    class="on-default edit-row badge badge-warning"><i
                                                        class="fa fa-pencil"></i></a> |
                                                <a id="delete" data-id="<?=$user['id']?>"
                                                    class="on-default remove-row badge badge-danger"><i
                                                        class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once '../include/footer.php';?>
        </div>
    </div>
    <div id="edit-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                </div>
                <form id="editForm" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="name" parsley-trigger="change" placeholder="Nama"
                                class="form-control" id="name-edit" data-parsley-id="6" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" parsley-trigger="change" required="" placeholder="Email"
                                class="form-control" id="email-edit" data-parsley-id="6" readonly>
                        </div>
                        <div class="form-group">
                            <select class="select2 form-control" id="outlet-edit" name="outlet">
                                <?php foreach($data['outlets'] as $outlet):?>
                                <option value="<?= $outlet['id'] ?>">
                                    <?= $outlet['kodeoutlet'].' - '.ucwords($outlet['nama']) ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="select2 form-control" id="jabatan-edit" name="jabatan">
                                <?php foreach($data['jabatans'] as $jabatan):?>
                                <option value="<?=$jabatan['id']?>">
                                    <?= $jabatan['kodejabatan'].' - '.ucwords($jabatan['namajabatan'])?></option>
                                <?php endforeach;?>
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
    <?php require_once '../include/scriptfooter.php';?>
    <script>
    $(document).ready(function() {
        $('#datatable').dataTable();
        $('#outlet').select2({
            placeholder: "Pilih Outlet",
            allowClear: true
        });
        $('#jabatan').select2({
            placeholder: "Pilih Jabatan",
            allowClear: true
        });
        $("#add-user").on("submit", function(e) {
            $.ajax({
                url: 'add.php',
                data: $(this).serialize(),
                type: 'POST',
            }).done(function(result) {
                if (result == 1) {
                    swal("Email sudah terdaftar!", "", "error")
                } else if (result == 2) {
                    swal("Gagal menambahkan user!", "", "error")
                } else if (result == 3) {
                    swal({
                        title: "Berhasil menambahkan user!",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            });
            e.preventDefault();
        });
        $(document).on("click", "#edit", function() {
            var id = $(this).data("id");
            var menu = $(this).data("menu");
            var nama = $(this).data("nama");
            var email = $(this).data("email");
            var outlet = $(this).data("outlet");
            var jabatan = $(this).data("jabatan");
            $("#edit-user").modal("show");
            $("#name-edit").val(nama);
            $("#email-edit").val(email);
            $("#outlet-edit").val(outlet);
            $("#id").val(id);
            $("#menu").val(menu);
            $("#outlet-edit").trigger("change");
            $("#jabatan-edit").val(jabatan);
            $("#jabatan-edit").trigger("change");
        });
        $(document).on("click", "#delete", function(e) {
            var id = $(this).data("id");
            swal({
                title: "Are you sure?",
                text: "Data yang telah dihapus tidak dapat dikembalikan!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger waves-effect waves-light',
                confirmButtonText: 'Hapus'
            }, function(hapus) {
                if (hapus) {
                    $.ajax({
                        url: 'add.php',
                        data: {
                            'id': id,
                            'delete': true
                        },
                        type: 'POST'
                    }).done(function(result) {
                        if (!result) {
                            swal("Gagal menghapus data!", "", "error")
                        } else {
                            swal({
                                title: "Berhasil menghapus data!",
                                type: "success",
                                timer: 1000,
                                showConfirmButton: false
                            });
                            location.reload();
                        }
                    });
                    e.preventDefault();
                }
            });
        });
        $("#editForm").on("submit", function(e) {
            $.ajax({
                url: 'add.php',
                data: $(this).serialize(),
                type: 'POST',
            }).done(function(result) {
                if (!result) {
                    swal("Gagal mengubah data!", "", "error")
                } else {
                    swal({
                        title: "Berhasil mengubah data!",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            });
            e.preventDefault();
        });

    });
    </script>
</body>
>>>>>>> Stashed changes

</html>