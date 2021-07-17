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
require '../controller/c_jabatan.php';
$bagian = "Data Master";
$juhal = "Jabatan";
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

                    <div class="row">
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-box">
                                <div class="dropdown pull-right">
                                    <!-- <h4 class="header-title m-t-0">Kode jabatan : <?php echo $kp ; ?></h4> -->
                                </div>

                                <h4 class="header-title m-t-0">Input Jabatan <br></h4>
                                <br>
                                <form class="form-horizontal group-border-dashed" id="formjabatan">
                                    <input type="hidden" value="inputjabatan" id="inputjabatan" name="inputjabatan">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Nama Jabatan</label>
                                        <div class="col-sm-8">
                                            <input autofocus type="text" class="form-control" required name="njabatan"
                                                id="njabatan" placeholder="Nama Jabatan"></input>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-6 m-t-15">
                                            <button type="submit" class="btn btn-success waves-effect waves-light"
                                                name="tombol-jabatan" id="tombol-jabatan">
                                                Input Jabatan
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

                                <h4 class="header-title m-t-0 m-b-30">Daftar Jabatan</h4>

                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Jabatan</th>
                                            <th>Nama Jabatan</th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($kodejabatan as $row ) : ?>
                                        <tr>
                                            <td width="2%" ;><?= $i ?></td>
                                            <td><?= $row["kodejabatan"] ?></td>
                                            <td><?= ucwords($row["namajabatan"]) ?></td>
                                            <td>
                                                <a class="on-default edit-row badge badge-success" data-toggle="modal"
                                                    data-target="#edit<?= $row["id"] ?>"><i
                                                        class="fa fa-pencil"></i></a> |
                                                <input type="hidden" class="delete_id_value" value="<?=$row["id"]?>">
                                                <a
                                                    class="on-default remove-row badge badge-danger tombol-deletejabatan"><i
                                                        class="fa fa-trash-o"></i></a>
                                            </td>
                                            <div id="edit<?= $row["id"] ?>" class="modal fade" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                                style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×</button>
                                                            <h2 class="modal-title">Edit jabatan
                                                                <?= $row["kodejabatan"] ?></h2>
                                                        </div>
                                                        <form method="post" action="">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <input type="hidden" value="updatejabatan"
                                                                        id="updatejabatan" name="updatejabatan">
                                                                    <input type="hidden" value="<?= $row["id"] ?>"
                                                                        id="idjabatan" name="idjabatan">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="namajabatan"
                                                                                    class="control-label">Nama
                                                                                    Jabatan</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="<?= $row["namajabatan"] ?>"
                                                                                    id="namajabatan" name="namajabatan">
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>

                                                            </div>


                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-success waves-effect"
                                                                    id="tombol-updatejabatan"
                                                                    name="tombol-updatejabatan">Save</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div><!-- /.modal -->
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
    $('#tombol-jabatan').click(function(e) {

        e.preventDefault();
        var dataform = $('#formjabatan')[0];
        var data = new FormData(dataform);

        var inputjabatan = $('#inputjabatan').val();
        var njabatan = $('#njabatan').val();

        if (njabatan == "") {
            swal("Nama jabatan belum di isi!", "", "error")
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

    $('.tombol-deletejabatan').click(function(e) {
        e.preventDefault();
        //alert('hapus');
        //var delete = 'delete';
        var tabel = 'jabatan';
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