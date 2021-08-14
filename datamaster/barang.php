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
require '../controller/c_barang.php';
$bagian = "Data Master";
$juhal = "Barang";
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
                        <div class="col-lg-12">
                            <div class="card-box">
                                <!-- <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown"
                                    aria-expanded="false">
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

                                <h4 class="header-title m-t-0 m-b-30">Form Input Barang</h4>

                                <div class="row">
                                    <form id="formbarang">
                                        <input type="hidden" value="inputbarang" id="inputbarang" name="inputbarang">
                                        <input type="hidden" value="<?= $kodeoutlet; ?>" id="kodeoutlet" name="kodeoutlet">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kategori Barang</label>
                                                <select class="form-control select2" id="kategoribarang" name="kategoribarang">
                                                    <option>Pilih Kategori</option>
                                                    <?php foreach ($kategoribarang as $row) : ?>
                                                        <option value="<?= $row["kodekategoribarang"] ?>">
                                                            <?= ucwords($row['namakategoribarang'])  ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Sub Kategori Barang</label>
                                                <select class="form-control select2" id="subkategoribarang" name="subkategoribarang">
                                                    <option>Pilih Kategori</option>
                                                    <?php foreach ($subkatbarang as $row) : ?>
                                                        <option value="<?= $row["kodesubkatbarang"] ?>">
                                                            <?= ucwords($row['namasubkatbarang'])  ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama barang</label>
                                                <input autofocus type="text" class="form-control" required name="nbarang" id="nbarang" placeholder="Nama barang"></input>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Harga Beli</label>
                                                <input type="text" class="form-control" required name="hargabeli" id="hargabeli" placeholder="Harga Beli"></input>
                                            </div>
                                            <div class="form-group">
                                                <label>Unit Beli</label>
                                                <select class="form-control select2" name="nunit" id="nunit">
                                                    <option>Pilih Unit</option>
                                                    <?php foreach ($unit as $row) : ?>
                                                        <option value="<?= $row["kodeunit"] ?>">
                                                            <?= ucwords($row['namaunit'])  ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Stok</label>
                                                <input type="text" class="form-control" required name="stok" id="stok" placeholder="Jumlah Stok"></input>
                                            </div>

                                        </div><!-- end col -->

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Harga Jual 1</label>
                                                <input type="text" class="form-control" required name="hargajual1" id="hargajual1" placeholder="Harga Jual 1"></input>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga Jual 2</label>
                                                <input type="text" class="form-control" required name="hargajual2" id="hargajual2" placeholder="Harga Jual 2"></input>
                                            </div>
                                            <div class="form-group">
                                                <label>Unit Jual</label>
                                                <select class="form-control select2" name="nunitjual" id="nunitjual">
                                                    <option>Pilih Unit</option>
                                                    <?php foreach ($unit as $row) : ?>
                                                        <option value="<?= $row["kodeunit"] ?>">
                                                            <?= ucwords($row['namaunit'])  ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Minimal Stok</label>
                                                <input type="text" class="form-control" required name="minstok" id="minstok" placeholder="Minimal Stok"></input>
                                            </div>

                                            <div class="form-group m-b-0">
                                                <button type="submit" class="btn btn-success waves-effect waves-light" id="tambah-barang">
                                                    Input Barang
                                                </button>
                                            </div>
                                        </div><!-- end col -->
                                    </form>
                                </div><!-- end row -->

                            </div>
                        </div><!-- end col -->

                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
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

                                <h4 class="header-title m-t-0 m-b-30">Daftar Bahan</h4>

                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Sub Kat</th>
                                            <th>Nama Barang</th>
                                            <th>Stok</th>
                                            <th>Harga Beli</th>
                                            <th>Unit Beli</th>
                                            <th>Jual 1</th>
                                            <th>Jual 2</th>
                                            <th>Unit Jual</th>
                                            <th>Min Stok</th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($barang as $row) : ?>
                                            <tr>
                                                <td width="2%" ;><?= $i ?></td>
                                                <td>
                                                    <?php
                                                    $kodekategoribarang = $row["kategoribarang"];
                                                    $ka = "SELECT namakategoribarang FROM kategoribarang WHERE kodekategoribarang ='$kodekategoribarang'"; //perintah untuk menjumlahkan
                                                    $hasilka = mysqli_query($conn, $ka); //melakukan query dengan varibel $jumlahkan
                                                    $tampil = mysqli_fetch_array($hasilka); //menyimpan hasil query ke variabel $t
                                                    echo $tampilkode = $tampil['namakategoribarang'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $kodesubkatbarang = $row["subkatbarang"];
                                                    $ka = "SELECT namasubkatbarang FROM subkatbarang WHERE kodesubkatbarang ='$kodesubkatbarang'"; //perintah untuk menjumlahkan
                                                    $hasilka = mysqli_query($conn, $ka); //melakukan query dengan varibel $jumlahkan
                                                    $tampil = mysqli_fetch_array($hasilka); //menyimpan hasil query ke variabel $t
                                                    echo $tampilkode = $tampil['namasubkatbarang'];
                                                    ?>
                                                </td>
                                                <td><?= $row["namabarang"] ?></td>
                                                <td><?= $row["stok"] ?></td>
                                                <td><?= $row["hargabeli"] ?></td>
                                                <td>
                                                    <?php
                                                    $kodeunit = $row["unitbeli"];
                                                    $ka = "SELECT namaunit FROM unit WHERE kodeunit ='$kodeunit'"; //perintah untuk menjumlahkan
                                                    $hasilka = mysqli_query($conn, $ka); //melakukan query dengan varibel $jumlahkan
                                                    $tampil = mysqli_fetch_array($hasilka); //menyimpan hasil query ke variabel $t
                                                    echo $tampilkode = $tampil['namaunit'];
                                                    ?>
                                                </td>
                                                <td><?= $row["hargajual1"] ?></td>
                                                <td><?= $row["hargajual2"] ?></td>
                                                <td>
                                                    <?php
                                                    $kodeunit = $row["unitbeli"];
                                                    $ka = "SELECT namaunit FROM unit WHERE kodeunit ='$kodeunit'"; //perintah untuk menjumlahkan
                                                    $hasilka = mysqli_query($conn, $ka); //melakukan query dengan varibel $jumlahkan
                                                    $tampil = mysqli_fetch_array($hasilka); //menyimpan hasil query ke variabel $t
                                                    echo $tampilkode = $tampil['namaunit'];
                                                    ?>
                                                </td>
                                                <td><?= $row["minstok"] ?></td>
                                                <td>
                                                    <a class="on-default edit-row badge badge-success tombol-edit" data-kodebarang="<?= $row['kodebarang']; ?>" data-unitbeli="<?= $row['unitbeli']; ?>" data-unitjual="<?= $row['unitjual']; ?>" data-kategoribarang="<?= $kodekategoribarang ?>" data-subkategoribarang="<?= $kodesubkatbarang ?>" data-namabarang="<?= $row['namabarang']; ?>" data-harga="<?= $row['hargabeli']; ?>" data-hargajual1="<?= $row["hargajual1"] ?>" data-hargajual2="<?= $row["hargajual2"] ?>" data-stok="<?= $row['stok']; ?>" data-mstok="<?= $row['minstok']; ?>"><i class="fa fa-pencil"></i></a>
                                                    <input type="hidden" class="delete_id_value" value="<?= $row["id"] ?>">
                                                    <?php if ($_SESSION['userlevel'] == 0) : ?>
                                                        | <a class="on-default remove-row badge badge-danger tombol-deletebahan"><i class="fa fa-trash-o"></i></a>
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
                    <h2 class="modal-title">Edit Barang</h2>
                </div>
                <form id="formupdate">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="updatebarang">
                            <input type="hidden" name="kodebarang" id="kodebarang">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kategori Barang</label>
                                    <select class="form-control select2" name="ukategoribarang" id="ukategoribarang">
                                        <option>Pilih Kategori</option>
                                        <?php foreach ($kategoribarang as $row) : ?>
                                            <option value="<?= $row["kodekategoribarang"] ?>">
                                                <?= ucwords($row['namakategoribarang'])  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sub Kategori Barang</label>
                                    <select class="form-control select2" name="usubkategoribarang" id="usubkategoribarang">
                                        <option>Pilih Kategori</option>
                                        <?php foreach ($subkatbarang as $row) : ?>
                                            <option value="<?= $row["kodesubkatbarang"] ?>">
                                                <?= ucwords($row['namasubkatbarang'])  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama barang</label>
                                    <input autofocus type="text" class="form-control" required name="unamabarang" id="unamabarang" placeholder="Nama barang"></input>
                                </div>
                            </div><!-- end col -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input type="text" class="form-control" required name="uhargabeli" id="uhargabeli" placeholder="Harga Beli"></input>
                                </div>
                                <div class="form-group">
                                    <label>Unit Beli</label>
                                    <select class="form-control select2" name="uunitbeli" id="uunitbeli">
                                        <option>Pilih Unit</option>
                                        <?php foreach ($unit as $row) : ?>
                                            <option value="<?= $row["kodeunit"] ?>">
                                                <?= ucwords($row['namaunit'])  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="text" class="form-control" required name="ustok" id="ustok" placeholder="Jumlah Stok"></input>
                                </div>

                            </div><!-- end col -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Harga Jual 1</label>
                                    <input type="text" class="form-control" required name="uhargajual1" id="uhargajual1" placeholder="Harga Jual 1"></input>
                                </div>
                                <div class="form-group">
                                    <label>Harga Jual 2</label>
                                    <input type="text" class="form-control" required name="uhargajual2" id="uhargajual2" placeholder="Harga Jual 2"></input>
                                </div>
                                <div class="form-group">
                                    <label>Unit Jual</label>
                                    <select class="form-control select2" name="uunitjual" id="uunitjual">
                                        <option>Pilih Unit</option>
                                        <?php foreach ($unit as $row) : ?>
                                            <option value="<?= $row["kodeunit"] ?>">
                                                <?= ucwords($row['namaunit'])  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div><!-- end col -->

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Min Stok</label>
                                    <input type="text" class="form-control" required name="uminstok" id="uminstok" placeholder="Minimal Stok"></input>
                                </div>
                            </div><!-- end col -->
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
        $('#tambah-barang').click(function(e) {
            e.preventDefault();
            var dataform = $('#formbarang')[0];
            var data = new FormData(dataform);

            var kategoribarang = $('#kategoribarang').val();
            var subkategoribarang = $('#subkategoribarang').val();
            var nbarang = $('#nbarang').val();
            var nunit = $('#nunit').val();
            var nunitjual = $('#nunitjual').val();



            if (kategoribarang == "Pilih Kategori") {
                swal("Kategori Belum di isi!", "", "error")
            } else if (subkategoribarang == "Pilih Kategori") {
                swal("Sub Kategori belum di Pilih!", "", "error")
            } else if (nbarang == "") {
                swal("Nama Barang belum di Pilih!", "", "error")
            } else if (nunit == "Pilih Unit") {
                swal("Nama Unit belum di Pilih!", "", "error")
            } else if (nunitjual == "Pilih Unit") {
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
                            swal("Nama Bahan Sudah Terdaftar!", "", "error")
                        }
                    }
                });
            }
        })

        // $('.tombol-edit').on('click', function() {
        $('#datatable').on('click', '.tombol-edit', function() {

            const unitbeli = $(this).data('unitbeli');
            const unitjual = $(this).data('unitjual');
            const kategoribarang = $(this).data('kategoribarang');
            const subkategoribarang = $(this).data('subkategoribarang');
            const namabarang = $(this).data('namabarang');
            const harga = $(this).data('harga');
            const hargajual1 = $(this).data('hargajual1');
            const hargajual2 = $(this).data('hargajual2');
            const stok = $(this).data('stok');
            const mstok = $(this).data('mstok');
            const kodebarang = $(this).data('kodebarang');


            $('#uunitbeli').val(unitbeli);
            $('#uunitbeli').trigger('change');
            $('#uunitjual').val(unitjual);
            $('#uunitjual').trigger('change');
            $('#ukategoribarang').val(kategoribarang);
            $('#ukategoribarang').trigger('change');
            $('#usubkategoribarang').val(subkategoribarang);
            $('#usubkategoribarang').trigger('change');
            $('#unamabarang').val(namabarang);
            $('#uhargabeli').val(harga);
            $('#uhargajual1').val(hargajual1);
            $('#uhargajual2').val(hargajual2);
            $('#ustok').val(stok);
            $('#uminstok').val(mstok);
            $('#kodebarang').val(kodebarang);

            $('#modaledit').modal('show');
        });

        $('#tombol-update').click(function(e) {


            e.preventDefault();
            var dataform = $('#formupdate')[0];
            var data = new FormData(dataform);
            // console.log(data);

            var ukategoribarang = $('#ukategoribarang').val();
            var usubkategoribarang = $('#usubkategoribarang').val();
            var ubarang = $('#unamabarang').val();
            var uunit = $('#uunit').val();
            var uunitjual = $('#uunitjual').val();
            // console.log(namabahan);
            // console.log(mstok);
            // console.log(harga);
            // console.log(hargaj);
            // alert(hargaj);

            if (ukategoribarang == "Pilih Kategori") {
                swal("Kategori belum di isi!", "", "error")
            } else if (usubkategoribarang == "Pilih Kategori") {
                swal("Sub Kategori belum di isi!", "", "error")
            } else if (ubarang == "") {
                swal("Nama Barang belum di isi!", "", "error")
            } else if (uunit == "") {
                swal("Nama Unit belum di isi!", "", "error")
            } else if (uunitjual == "") {
                swal("Nama Unit jual belum di isi!", "", "error")
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
                        // alert(hasil);
                        $('.spinn').hide();
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

        // $('.tombol-deletebahan').click(function(e) {
        $('#datatable').on('click', '.tombol-deletebahan', function(e) {

            e.preventDefault();
            //alert('hapus');
            //var delete = 'delete';
            var tabel = 'barang';
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