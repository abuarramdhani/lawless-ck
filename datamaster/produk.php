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
include '../controller/c_produk.php';
$bagian = "Data Master";
$juhal = "Produk";
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
                                    <!-- <h4 class="header-title m-t-0">Kode Unit : <?php echo $kp; ?></h4> -->
                                </div>

                                <h4 class="header-title m-t-0">Input Produk<br></h4>
                                <br>
                                <form class="form-horizontal group-border-dashed" id="formproduk" enctype="multipart/form-data">
                                    <input type="hidden" value="inputproduk" id="inputproduk" name="inputproduk">

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Nama produk</label>
                                        <div class="col-sm-8">
                                            <input autofocus type="text" class="form-control" required name="nproduk" id="nproduk" placeholder="Nama produk"></input>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Kategori produk</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2" name="nkategoriproduk" id="nkategoriproduk">
                                                <option>Pilih Kategori</option>
                                                <?php foreach ($kodekategoriproduk as $row) : ?>
                                                    <option value="<?= $row["kodekategoriproduk"] ?>">
                                                        <?= ucwords($row["namakategoriproduk"]) ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Harga Jual</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" required name="nharga" id="nharga" placeholder="Harga Jual"></input>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Gambar</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="ngambar" id="ngambar" class="dropify" data-height="100" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-6 m-t-15">
                                            <button type="submit" class="btn btn-success waves-effect waves-light" name="tombol-produk" id="tombol-produk">
                                                Input produk
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

                                <h4 class="header-title m-t-0 m-b-30">Daftar produk</h4>

                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Produk</th>
                                            <th>Kategori</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Jual</th>
                                            <th>Stok</th>
                                            <th>Min Stok</th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($kodeproduk as $row) : ?>
                                            <tr>
                                                <td width="2%" ;><?= $i ?></td>
                                                <td><?= $row["kodeproduk"] ?></td>
                                                <td>
                                                    <?php
                                                    $kodekategorip = $row["kodekategoriproduk"];
                                                    // echo $kodekategoriproduk;
                                                    $ka = "SELECT * FROM kategoriproduk WHERE kodekategoriproduk ='$kodekategorip'"; //perintah untuk menjumlahkan
                                                    $hasilka = mysqli_query($conn, $ka); //melakukan query dengan varibel $jumlahkan
                                                    $tampil = mysqli_fetch_array($hasilka); //menyimpan hasil query ke variabel $t
                                                    echo $tampilkode = ucwords($tampil['namakategoriproduk']);
                                                    ?>
                                                </td>
                                                <td><?= ucwords($row["namaproduk"]) ?></td>
                                                <td><?= $row["harga"] ?></td>
                                                <td><?= $row["stok"] ?></td>
                                                <td><?= $row["minstok"] ?></td>
                                                <td>
                                                    <a class="on-default edit-row badge badge-success tombol-edit" data-kodekproduk="<?= $row['kodekategoriproduk']; ?>" data-kode="<?= $row['kodeproduk']; ?>" data-nama="<?= $row['namaproduk']; ?>" data-harga="<?= $row['harga']; ?>" data-minstok="<?= $row['minstok']; ?>"><i class="fa fa-pencil"></i></a> |
                                                    <input type="hidden" class="delete_id_value" value="<?= $row["id"] ?>">
                                                    <a class="on-default remove-row badge badge-danger tombol-deleteproduk"><i class="fa fa-trash-o"></i></a>
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


    <!-- modaledit -->
    <div id="modaledit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2 class="modal-title">Edit Menu</h2>
                </div>

                <form id="formupdate">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="kode" name="update-produk">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unama" class="control-label">Nama Produk</label>
                                        <input type="text" class="form-control unama" id="unama" name="unama">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uhargaj" class="control-label">Harga Jual</label>
                                        <input type="text" class="form-control uhargaj" id="uhargaj" name="uhargaj">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uminstok" class="control-label">Min Stok</label>
                                        <input type="text" class="form-control uminstok" id="uminstok" name="uminstok">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kodekproduk" class="control-label">Kategori Produk</label>
                                        <select class="form-control select2 kodekproduk" name="kodekproduk" id="kodekproduk">
                                            <option>Pilih Kategori</option>
                                            <?php foreach ($kodekategoriproduk as $row) : ?>
                                                <option value="<?= $row['kodekategoriproduk']; ?>">
                                                    <?= ucwords($row["namakategoriproduk"]) ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="namamenu" class="control-label">gambar</label>
                                        <input type="file" name="ugambar" id="ugambar" class="dropify" data-height="100" />
                                        <!-- <input type="text" class="form-control url" id="ugambar" name="ugambar"> -->
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
    <!-- akhir modal edit -->

    <?php require '../include/scriptfooter.php'; ?>

</body>

</html>

<script>
    $(document).ready(function() {
        $('#tombol-produk').click(function(e) {

            e.preventDefault();
            var dataform = $('#formproduk')[0];
            var data = new FormData(dataform);

            var inputproduk = $('#inputproduk').val();
            var nkategoriproduk = $('#nkategoriproduk').val();
            var nproduk = $('#nproduk').val();
            var nharga = $('#nharga').val();
            var ngambar = $('#ngambar').val();

            // console.log(ngambar);
            //alert(ngambar)
            if (nkategoriproduk == "Pilih Kategori") {
                swal("Nama produk belum di isi!", "", "error")
            } else if (nharga == "") {
                swal("Harga belum di isi!", "", "error")
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
                            swal("UKURAN FILE TERLALU BESAR!", "", "error")
                        } else if (hasil == 5) {
                            swal("Tipe File tidak diperbolehkan!", "", "error")
                        } else if (hasil == 6) {
                            swal("Nama Produk sudah Terdaftar!", "", "error")
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

        $('.tombol-edit').on('click', function() {


            const nama = $(this).data('nama');
            const harga = $(this).data('harga');
            const minstok = $(this).data('minstok');
            const kode = $(this).data('kode');
            const kodekproduk = $(this).data('kodekproduk');



            $('.kode').val(kode);
            $('.kodekproduk').val(kodekproduk);
            $('.unama').val(nama);
            $('.uhargaj').val(harga);
            $('.uminstok').val(minstok);
            $('#modaledit').modal('show');
        });

        $('#tombol-update').click(function(e) {


            e.preventDefault();
            var dataform = $('#formupdate')[0];
            var data = new FormData(dataform);
            // console.log(data);

            var unama = $('#unama').val();
            var uhargaj = $('#uhargaj').val();
            // console.log(namabahan);
            // console.log(mstok);
            // console.log(harga);



            if (unama == "") {
                swal("nama produk belum di isi!", "", "error")
            } else if (uhargaj == "") {
                swal("harga jual belum di isi!", "", "error")
            } else if (kodekproduk == "Pilih Kategori") {
                swal("Kateogri Produk Belum dipilih!", "", "error")
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

                        } else if (hasil == 4) {
                            swal("UKURAN FILE TERLALU BESAR!", "", "error")
                        } else if (hasil == 5) {
                            swal("Tipe File tidak diperbolehkan!", "", "error")
                        }
                    }
                });
            }
        })

        $('.tombol-deleteproduk').click(function(e) {
            e.preventDefault();
            //alert('hapus');
            //var delete = 'delete';
            var tabel = 'produk';
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