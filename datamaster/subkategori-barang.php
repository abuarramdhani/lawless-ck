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
require '../controller/c_subkategori-barang.php';
$bagian = "Data Master";
$juhal = "Sub Kategori Barang";
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
                                    <!-- <h4 class="header-title m-t-0">Kode subkatbarang : <?php echo $kp; ?></h4> -->
                                </div>

                                <h4 class="header-title m-t-0">Input Sub Kategori Barang <br></h4>
                                <br>
                                <form class="form-horizontal group-border-dashed" id="formsubkatbarang">
                                    <input type="hidden" value="inputsubkatbarang" id="inputsubkatbarang" name="inputsubkatbarang">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Kategori Barang</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2" name="nkategoribarang" id="nkategoribarang">
                                                <option>Pilih Kategori</option>
                                                <?php foreach ($kodekategoribarang as $row) : ?>
                                                    <option value="<?= $row["kodekategoribarang"] ?>">
                                                        <?= ucwords($row["namakategoribarang"]) ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Nama Sub Kategori Barang</label>
                                        <div class="col-sm-8">
                                            <input autofocus type="text" class="form-control" required name="nsubkatbarang" id="nsubkatbarang" placeholder="Nama Sub Kategori barang"></input>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-6 m-t-15">
                                            <button type="submit" class="btn btn-success waves-effect waves-light" name="tombol-subkatbarang" id="tombol-subkatbarang">
                                                Simpan
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

                                <h4 class="header-title m-t-0 m-b-30">Daftar Sub Kategori Barang</h4>

                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori Barang</th>
                                            <th>Kode Sub Kategori Barang</th>
                                            <th>Sub Kategori Barang</th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($kodesubkatbarang as $row) : ?>
                                            <tr>
                                                <td width="2%" ;><?= $i ?></td>
                                                <td>
                                                    <?php
                                                    $kodekategoribarang = $row["kodekategoribarang"];
                                                    $ka = "SELECT namakategoribarang FROM kategoribarang WHERE kodekategoribarang ='$kodekategoribarang'"; //perintah untuk menjumlahkan
                                                    $hasilka = mysqli_query($conn, $ka); //melakukan query dengan varibel $jumlahkan
                                                    $tampil = mysqli_fetch_array($hasilka); //menyimpan hasil query ke variabel $t
                                                    echo $tampilkode = $tampil['namakategoribarang'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?= $row["kodesubkatbarang"] ?></td>

                                                <td><?= ucwords($row["namasubkatbarang"]) ?></td>
                                                <td>
                                                    <a class="on-default edit-row badge badge-success tombol-edit" data-id="<?= $row["id"]; ?>" data-nama="<?= $row["namasubkatbarang"]; ?>"><i class="fa fa-pencil"></i></a>
                                                    <input type="hidden" class="delete_id_value" value="<?= $row["id"] ?>">
                                                    <?php if ($_SESSION['userlevel'] == 0) : ?>
                                                        | <a class="on-default remove-row badge badge-danger tombol-deletesubkatbarang"><i class="fa fa-trash-o"></i></a>
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
                    <h2 class="modal-title">Edit Kategori barang</h2>
                </div>
                <form id="formupdate">
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" class="id" name="update-skbarang">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="namasubkatbarang" class="control-label">Nama Sub
                                            Kategori barang</label>
                                        <input type="text" class="form-control nama" id="unamakbarang" name="unamaskbarang">
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
        $('#tombol-subkatbarang').click(function(e) {

            e.preventDefault();
            var dataform = $('#formsubkatbarang')[0];
            var data = new FormData(dataform);

            var inputsubkatbarang = $('#inputsubkatbarang').val();
            var nsubkatbarang = $('#nsubkatbarang').val();

            if (nsubkatbarang == "") {
                swal("Nama subkatbarang belum di isi!", "", "error")
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
                        $('.spinn').hide();
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
                            swal("Kategori barang Sudah Terdaftar!", "", "error")
                        }
                    }
                });
            }
        })

        // $('.tombol-edit').on('click', function() {
        $('#datatable').on('click', '.tombol-edit', function() {


            const id = $(this).data('id');
            const nama = $(this).data('nama');


            $('.id').val(id);
            $('.nama').val(nama);
            $('#modaledit').modal('show');
        });

        $('#tombol-update').click(function(e) {

            // alert('ok');
            e.preventDefault();
            var dataform = $('#formupdate')[0];
            var data = new FormData(dataform);
            // console.log(data);

            var unamakbarang = $('#unamakbarang').val();

            // console.log(unamakbarang);


            if (unamakbarang == "") {
                swal("Kategori barang belum di isi!", "", "error")
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
                        // $('.spinn').show();
                        $('.rowspin').css('display', 'flex');
                    },
                    success: function(hasil) {
                        $('.spinn').hide();
                        // alert(hasil);
                        // console.log(hasil);
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

        // $('.tombol-deletesubkatbarang').click(function(e) {
        $('#datatable').on('click', '.tombol-deletesubkatbarang', function(e) {
            e.preventDefault();
            //alert('hapus');
            //var delete = 'delete';
            var tabel = 'subkatbarang';
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