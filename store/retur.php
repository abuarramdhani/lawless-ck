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
// require '../controller/c_storebahan.php';
$bagian = "Store";
$juhal = "Retur";

$tabel = 'form_storebahan';
$tabel_join = 'companypanel';
$kode = 'outlet';
include '../include/filter_date.php';

?>



<body class="fixed-left" onload="sweetfunction()">

    <!-- Begin page -->
    <div id="wrapper">

        <?php require '../include/topbar.php'; ?>

        <?php require '../include/sidebar.php'; ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- terima msg -->
            <?php if (isset($_SESSION['msg'])) : ?>
                <div id="msg" data-msg="<?= $_SESSION["msg"] ?>"></div>
                <?php unset($_SESSION['msg']); ?>
            <?php endif ?>
            <!-- akhir terima msg -->
            <?php if ($_SESSION['kodeoutlet'] == "OUT002" or $_SESSION['kodeoutlet'] == "OUT001") : ?>

                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-7">
                                <div class="card-box">

                                    <!-- <div class="dropdown pull-right">
                                 <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modalproyek">Input Proyek</button>
                            </div> -->
                                    <div class="dropdown pull-centre">
                                        <h4 class="header-title m-t-0 m-b-30">Data Order Bahan</h4>
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


                                    <table id="datatable-buttons" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>No. Form order bahan</th>
                                                <th>Outlet</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1 ?>
                                            <?php foreach ($data as $dp) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $dp['date']; ?></td>
                                                    <td><?= $dp['No_form']; ?></td>
                                                    <td><?= $dp['nama'] ?></td>
                                                    <?php if ($dp['status_ot'] == 0 && $dp['status_ck'] == 0) : ?>
                                                        <td><span class="label label-danger">Confirm</span></td>
                                                    <?php elseif ($dp['status_ot'] == 1 && $dp['status_ck'] == 0) : ?>
                                                        <td><span class="label label-info">Confirmed</span></td>
                                                    <?php elseif ($dp['status_ot'] == 2 && $dp['status_ck'] == 0) : ?>
                                                        <td><span class="label label-success">Checked by Manager</span></td>
                                                    <?php elseif ($dp['status_ot'] == 2 && $dp['status_ck'] == 1) : ?>
                                                        <td><span class="label label-success">Checked by CK</span></td>
                                                    <?php elseif ($dp['status_ot'] == 2 && $dp['status_ck'] == 2) : ?>
                                                        <td><span class="label label-primary">Delivery</span></td>
                                                    <?php endif ?>

                                                    <td><a href="detail_storebahan.php?No_form=<?= $dp['No_form']; ?>" class="btn btn-primary waves-effect waves-light btn-xs m-b-5">Details</a>
                                                    </td>
                                                </tr>

                                            <?php endforeach ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->
            <?php else : ?>
                <!-- Start content -->
                <!-- terima msg -->
                <?php if (isset($_SESSION['msg'])) : ?>
                    <div id="msg" data-msg="<?= $_SESSION["msg"] ?>"></div>
                    <?php unset($_SESSION['msg']); ?>
                <?php endif ?>
                <!-- akhir terima msg -->

                <div class="content">
                    <div class="container" style="margin-top: 5px;">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <select class="form-control select2" name="pilihretur" id="pilihretur">
                                        <option>Pilih Retur</option>
                                        <option value="produk">Produk</option>
                                        <option value="bahan">Bahan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-12" style=" margin-top: 10px;">
                                    <form>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn waves-effect waves-light btn-primary"><i class="fa fa-search"></i></button>
                                            </span>
                                            <input type="text" id="search" name="keyword_form-po" class="form-control" placeholder="Search" oninput="loadData();">
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive" style=" margin-top: 10px;">

                                        <?php $i = 1 ?>
                                        <table id="barang" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode</th>
                                                    <th>Item</th>
                                                    <th>Harga</th>
                                                    <th>Stok</th>
                                                    <th data-priority="1">Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <form class="form-horizontal" role="formpo" method="POST" action="../models/input.php">
                                    <input type="hidden" name="inputformretur">
                                    <div class="card-box" style="height:350px; overflow-y: auto;">
                                        <div class="col-lg-12">
                                            <div class="responsive-table-plugin">
                                                <div class="table-rep-plugin">
                                                    <div class="table-responsive" data-pattern="priority-columns">
                                                        <table id="order" class="table table-striped mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nama Barang</th>
                                                                    <th data-priority="1">Harga</th>
                                                                    <th data-priority="3">Jumlah</th>
                                                                    <th data-priority="1">Subtotal</th>
                                                                    <th data-priority="1">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card-box" style="height:170px; ">


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" name="total_keseluruhan">Total</label>
                                            <div class="col-sm-10">
                                                <input type="text" readonly name="total_keseluruhan" id="total-harga" class="form-control" value="Rp. 0">
                                                <!-- <p class="form-control-static" id="total-harga" name="total_keseluruhan"></p> -->
                                            </div>
                                        </div>
                                        <!-- <?php $kodesupplierr = query("SELECT * FROM supplier ORDER BY id DESC "); ?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Supplier</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="supplier">
                                                    <option>Pilih Supplier</option>
                                                    <?php foreach ($kodesupplierr as $row) : ?>
                                                        <option value="<?= $row["kodesupplier"] ?>">
                                                            <?= ucwords($row["namasupplier"]) ?></option>
                                                    <?php endforeach; ?>

                                                </select>

                                            </div>
                                        </div> -->

                                        <div class="form-group  text-center" style="margin-top: 10px;">
                                            <!-- <button class="btn btn-danger waves-effect waves-light mr-1">
                                                <span>Batal</span>
                                            </button> -->
                                            <button type="submit" class="btn btn-purple waves-effect waves-light mr-1" id="">
                                                <span>Simpan</span>
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- container -->


            <?php endif; ?>


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

    function loadData() {
        $("#barang>tbody").empty();
        var search = $("#search").val();
        var pilihretur = $("#pilihretur").val();
        console.log(pilihretur)
        if (pilihretur == 'bahan') {
            if (search != '') {
                $.ajax({
                    url: '../controller/c_retur.php',
                    data: {
                        'keyword_form-po': search,
                        'pilihretur': pilihretur
                    },
                    type: 'POST'
                }).done(function(response) {
                    var result = JSON.parse(response);
                    var i = 1;
                    result.forEach(res => {
                        html = '<tr><td>' + i + '</td><td>' + res.kodebahan + '</td><td>' + res.namabahan +
                            '</td><td>' + res.hargaj + '</td><td>' + res.stok + '</td>';
                        html += '<td><button id="add" data-kode="' + res.kodebahan + '" data-stok="' + res.stok + '" data-id="' + res.id + '" data-nama="' + res.namabahan +
                            '" data-harga="' + res.hargaj +
                            '" class="btn btn-icon waves-effect waves-light btn-success m-b-5"><i class="fa fa-plus"></i></button></td></tr>';
                        i++;

                        $("#barang>tbody").append(html);

                    });
                });
            }
        } else if (pilihretur == 'produk') {
            if (search != '') {
                $.ajax({
                    url: '../controller/c_retur.php',
                    data: {
                        'keyword_form-po': search,
                        'pilihretur': pilihretur
                    },
                    type: 'POST'
                }).done(function(response) {
                    var result = JSON.parse(response);
                    var i = 1;
                    result.forEach(res => {
                        html = '<tr><td>' + i + '</td><td>' + res.kodeproduk + '</td><td>' + res.namaproduk +
                            '</td><td>' + res.harga + '</td><td>' + res.stok + '</td>';
                        html += '<td><button id="add" data-stok="' + res.stok + '" data-id="' + res.id + '" data-nama="' + res.namaproduk +
                            '" data-harga="' + res.hargaj +
                            '" class="btn btn-icon waves-effect waves-light btn-success m-b-5"><i class="fa fa-plus"></i></button></td></tr>';
                        i++;

                        $("#barang>tbody").append(html);

                    });
                });
            }
        }


    }

    function totalharga() {
        var sum = 0;
        $(".total").each(function() {
            sum += parseFloat($(this).val());
        });
        $("#total-harga").val('Rp. ' + sum);
    }
    $(document).ready(function() {


        $(document).on("click", "#add", function() {
            var id = $(this).data("id");
            var nama = $(this).data("nama");
            var harga = $(this).data("harga");
            var stok = $(this).data("stok");
            var kode = $(this).data("kode");
            var jumlah = 1;
            var check = document.getElementsByClassName(id)[0];
            // html = '<tr><td class="item_nama">' + nama + '</td><td class="harga item">' + harga + '</td><td class="item"><input id="jumlah" type="number" name="jumlah[]" value="' + jumlah + '"></td><td class="total item">' + harga + '</td>';
            // html += '<td><button id="remove" class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i> </button></td></tr>';
            // $("#order>tbody").append(html);
            // totalharga();
            if (check != null) {
                var qty = check.value;
                var newQty = parseInt(qty) + parseInt(jumlah);
                check.value = newQty;
                var price = parseInt(document.getElementsByClassName("hrg-" + id)[0].value);
                var newPrice = price * newQty;
                document.getElementsByClassName("sub-" + id)[0].value = newPrice;
            } else {
                if (stok == 0) {
                    swal("Stok Kosong!!!", "", "error")
                } else {
                    html =
                        '<tr><td><input readonly type="hidden" name="kodebarang[]"  class="form-control"  value="' +
                        kode +
                        '"><input readonly type="text" name="namabarang[]"  class="form-control"  value="' +
                        nama +
                        '"></td><td ><input type="text"  readonly  class="form-control harga hrg-' + id + '"  name="harga[]"  value="' +
                        harga +
                        '"></td><td><input id="jumlah" class="form-control ' + id + '" type="number" name="jumlah[]" value="' +
                        jumlah +
                        '"></td><td class=""><input type="text" readonly name="subtotal[]" class="form-control total sub-' + id + '" id="subtotal_item" value="' +
                        harga + '" ></td>';
                    html +=
                        '<td><button id="remove" class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i> </button></td></tr>';
                    $("#order>tbody").append(html);

                }

            }
            totalharga();



        });

        $(document).on("click", "#remove", function() {
            $(this).closest("tr").remove();
            totalharga();
        });
        $(document).on("input", "#jumlah", function() {
            var jumlah = parseInt($(this).val());
            var harga = parseInt($(this).closest("tr").find(".harga").val());
            var total = jumlah * harga;
            // var coba = $(this).closest("tr").find(".total").text(total);
            // console.log($(this).closest("tr").find(".total").text(total));
            // $(this).closest("tr").find("input#subtotal_item").val(total);
            $(this).closest("tr").find("input#subtotal_item").val(total);
            // $(this).closest("tr").find(".total_val").val(total);

            totalharga();
        });



    })
</script>