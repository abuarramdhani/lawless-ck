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
$juhal = "Store Product";

// $tabel = 'form_storebahan';
$tabel_join = 'companypanel';
$kode = 'outlet';
$tabel = 'form_po';
// $tabel_join = 'supplier';
// $kode = 'supplier';
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


            <?php //if ($_SESSION['kodeoutlet'] == "OUT002" or $_SESSION['kodeoutlet'] == "OUT001") : ?>

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
                                    <h4 class="header-title m-t-0 m-b-30">Data Order Product</h4>
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
                                            <th>No. Form Order Product</th>
                                            <th>Outlet</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($data as $dp) : ?>
                                        <?php if ($dp['kodesupplier'] == 'SUP000') : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= tgl_indo($dp['date']); ?></td>
                                            <td><?= $dp['No_form']; ?></td>
                                            <td><?= ucwords($dp['nama']) ?></td>

                                            <?php if ($dp['status_ot'] == 0 && $dp['status_ck'] == 0) : ?>
                                            <td><span class="label label-danger">Confirm</span>
                                            </td>
                                            <?php elseif ($dp['status_ot'] == 1 && $dp['status_ck'] == 0) : ?>
                                            <td><span class="label label-default">Checked by Manager</span></td>
                                            <?php elseif ($dp['status_ot'] == 1 && $dp['status_ck'] == 1) : ?>
                                            <td><span class="label label-info">Checked by CK</span></td>
                                            <?php elseif ($dp['status_ot'] == 1 && $dp['status_ck'] == 2) : ?>
                                            <td><span class="label label-primary">Delivery</span></td>
                                            <?php elseif ($dp['status_ot'] == 2 && $dp['status_ck'] == 2) : ?>
                                            <td><span class="label label-success">Delivered</span></td>
                                            <?php endif ?>



                                            <td><a href="detail_storebahan.php?No_form=<?= $dp['No_form']; ?>&kodeoutlet=<?= $dp['kodeoutlet'];?>"
                                                    class="btn btn-primary waves-effect waves-light btn-xs m-b-5">Details</a>
                                            </td>
                                        </tr>
                                        <?php endif ?>

                                        <?php endforeach ?>

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->
            <?php //else : ?>
            <!-- Start content -->
            <!-- terima msg -->
            <?php if (isset($_SESSION['msg'])) : ?>
            <div id="msg" data-msg="<?= $_SESSION["msg"] ?>"></div>
            <?php unset($_SESSION['msg']); ?>
            <?php endif ?>
            <!-- akhir terima msg -->

            <div class="content">
                <div class="container" style="margin-top: 5px;">
                    <div class="col-lg-5 col-md-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <form>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn waves-effect waves-light btn-primary"><i
                                                    class="fa fa-search"></i></button>
                                        </span>
                                        <input type="text" id="search" name="keyword_form-po" class="form-control"
                                            placeholder="Search" oninput="loadData();">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- <?php var_dump($bahan); ?> -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive" style=" margin-top: 10px;">
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
                                    </div>

                                    <h4 class="header-title m-t-0 m-b-30">Default Example</h4> -->
                                    <?php $i = 1 ?>
                                    <table id="barang" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                           
                                                <th>Item</th>
                                                <th>Harga</th>
                                                <th>Unit</th>
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
                    <div class="col-lg-7 col-md-12">
                        <div class="row">
                            <form class="form-horizontal" role="formpo" method="POST" action="../models/input.php">
                                <div class="col-lg-12 m-b-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="tanggal_manual" value="<?= date("m/d/Y"); ?>" id="datepicker-autoclose">
                                    <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                </div><!-- input-group -->
                                </div>
                                <input type="hidden" name="inputformstorebahan">
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

                                                                <th data-priority="1">Unit</th>
                                                                <th data-priority="3">Jumlah</th>
                                                                <th data-priority="1">Subtotal</th>
                                                                <th data-priority="1">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- <tr>
                                                                <th><input readonly type="text" name="kodesupplier[]" id="" value="1202929"></th>
                                                                <td>20000</td>
                                                                <td width="5"><input type="number" width="5"></td>
                                                                <td>40000</td>
                                                                <td><button class="btn btn-icon waves-effect waves-light btn-danger m-b-5">
                                                                        <i class="fa fa-remove"></i> </button></td>
                                                            </tr>
                                                            <tr>
                                                                <th><input readonly type="text" name="kodesupplier[]" id="" value="9002929"></th>
                                                                <td>20000</td>
                                                                <td width="5"><input type="number" width="5"></td>
                                                                <td>40000</td>
                                                                <td><button class="btn btn-icon waves-effect waves-light btn-danger m-b-5">
                                                                        <i class="fa fa-remove"></i> </button></td>
                                                            </tr> -->
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
                                            <input type="text" readonly name="total_keseluruhan" id="total-harga"
                                                class="form-control" value="Rp. 0">
                                            <!-- <p class="form-control-static" id="total-harga" name="total_keseluruhan"></p> -->
                                        </div>
                                    </div>
                                    <?php $kodeoutlet = query("SELECT * FROM companypanel ORDER BY id DESC "); ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Outlet</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="outlet" id="outlet">
                                                <option>Pilih Outlet</option>
                                                <?php foreach ($kodeoutlet as $row) : ?>
                                                <option value="<?= $row["kodeoutlet"] ?>">
                                                    <?= ucwords($row["nama"]) ?></option>
                                                <?php endforeach; ?>

                                            </select>

                                        </div>
                                    </div>



                                    <div class="form-group  text-center" style="margin-top: 10px;">
                                        <!-- <button class="btn btn-danger waves-effect waves-light mr-1">
                                                <span>Batal</span>
                                            </button> -->
                                        <button type="submit" class="btn btn-purple waves-effect waves-light mr-1"
                                            id="simpan">
                                            <span>Simpan</span>
                                        </button>
                                    </div>



                                    <!-- <div class="form-group">
                                    <label class="col-sm-2 control-label">Total</label>
                                    <div class="col-sm-10">
                                        <p class="form-control-static">Rp. 90.000.00</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Suplier</label>
                                    <div class="col-sm-10">
                                        <select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group  text-center" style="margin-top: 10px;">
                                    <button class="btn btn-danger waves-effect waves-light mr-1">
                                        <span>Cancel</span>
                                    </button>
                                    <button class="btn btn-purple waves-effect waves-light mr-1"> <span>Save</span>
                                    </button> -->

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->


            <?php //endif; ?>


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
    if (search != '') {
        $.ajax({
            url: '../controller/c_storebahan.php',
            data: {
                'keyword_form-po': search
            },
            type: 'POST'
        }).done(function(response) {
            var result = JSON.parse(response);
            var i = 1;
            result.forEach(res => {
                <?php if ($_SESSION['kodeoutlet'] != "OUT007") : ?>
                html = '<tr><td>' + i + '</td><td>' + res.namabarang +
                    '</td><td>' + res.hargajual1 + '</td><td>' + res.namaunit + '</td><td>' + res.stok +
                    '</td>';
                html += '<td><button id="add" data-status="' + res.status +
                    '" data-kodebarang="' + res.kodebarang +
                    '" data-namaunit="' + res.namaunit + '"  data-unitjual="' + res.unitjual +
                    '" data-stok="' + res.stok + '" data-id="' + res.id + '" data-nama="' + res
                    .namabarang +
                    '" data-harga="' + res.hargajual1 +
                    '" class="btn btn-icon waves-effect waves-light btn-success m-b-5"><i class="fa fa-plus"></i></button></td></tr>';
                i++;
                <?php else : ?>
                html = '<tr><td>' + i + '</td><td>' + res.kodebarang + '</td><td>' + res.namabarang +
                    '</td><td>' + res.hargajual2 + '</td><td>' + res.namaunit + '</td><td>' + res.stok +
                    '</td>';
                html += '<td><button id="add" data-kodebarang="' + res.kodebarang +
                    '" data-namaunit="' + res.namaunit + '" data-unitjual="' + res.unitjual +
                    '" data-stok="' + res.stok + '" data-id="' + res.id + '" data-nama="' + res
                    .namabarang +
                    '" data-harga="' + res.hargajual2 +
                    '" class="btn btn-icon waves-effect waves-light btn-success m-b-5"><i class="fa fa-plus"></i></button></td></tr>';
                i++;
                <?php endif ?>

                $("#barang>tbody").append(html);

            });
        });
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
    $('#simpan').click(function(e) {


        var outlet = $('#outlet').val();


        if (outlet == "Pilih Outlet") {

            swal("Outlet belum di pilih!", "", "error")
            e.preventDefault();
        } else {

            $('form#formdinamis').submit();
        }
    })

    $(document).on("click", "#add", function() {
        var id = $(this).data("id");
        var nama = $(this).data("nama");
        var harga = $(this).data("harga");
        var status = $(this).data("status");
        // console.log(status);
        var namaunit = $(this).data("namaunit");
        var kodebarang = $(this).data("kodebarang");
        var unitjual = $(this).data("unitjual");
        var stok = $(this).data("stok");
        var jumlah = 1;
        var check = document.getElementsByClassName(kodebarang)[0];
        // console.log(check);
        // html = '<tr><td class="item_nama">' + nama + '</td><td class="harga item">' + harga + '</td><td class="item"><input id="jumlah" type="number" name="jumlah[]" value="' + jumlah + '"></td><td class="total item">' + harga + '</td>';
        // html += '<td><button id="remove" class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i> </button></td></tr>';
        // $("#order>tbody").append(html);
        // totalharga();
        if (check != null) {
            var qty = check.value;
            // console.log(qty);
            var newQty = parseFloat(qty) + parseFloat(jumlah);
             check.value = newQty;
                var price = parseFloat(document.getElementsByClassName("hrg-" + kodebarang)[0].value);
                var newPrice = price * newQty;
                document.getElementsByClassName("sub-" + kodebarang)[0].value = newPrice;
            // if (stok < newQty) {
            //     swal("Stok melebihi batas !!!", "", "error")
            // } else {
            //     check.value = newQty;
            //     var price = parseInt(document.getElementsByClassName("hrg-" + kodebarang)[0].value);
            //     var newPrice = price * newQty;
            //     document.getElementsByClassName("sub-" + kodebarang)[0].value = newPrice;
            // }

        } else {
            console.log(status)
            if (stok == 0 && status == 0 ) {
                swal("Stok Kosong!!!", "", "error")
            } else {
                html =
                    '<tr><td><input type="hidden" name="kodebarang[]"  class="form-control"  value="' +
                    kodebarang +
                    '"><input readonly type="text" name="namabarang[]"  class="form-control"  value="' +
                    nama +
                    '"></td><td ><input type="text"  readonly  class="form-control harga hrg-' +
                    kodebarang + '"  name="harga[]"  value="' +
                    harga +
                    '"></td><td><input class="form-control " type="hidden" name="unitjual[]" value="' +
                    unitjual +
                    '"><input readonly class="form-control " type="text"  value="' +
                    namaunit +
                    '"></td><td><input id="jumlah" step="0.0001" min="1" class="form-control ' +
                    kodebarang + '" type="number" name="jumlah[]" value="' +
                    jumlah +
                    '"></td><td class=""><input type="text" readonly name="subtotal[]" class="form-control total sub-' +
                    kodebarang + '" id="subtotal_item" value="' +
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
        var jumlah = parseFloat($(this).val());
        var harga = parseFloat($(this).closest("tr").find(".harga").val());
        var total = jumlah * harga;
        // var coba = $(this).closest("tr").find(".total").text(total);
        // console.log($(this).closest("tr").find(".total").text(total));
        // $(this).closest("tr").find("input#subtotal_item").val(total);
        $(this).closest("tr").find("input#subtotal_item").val(total);
        // $(this).closest("tr").find(".total_val").val(total);

        totalharga();
    });



    $('#tombol-kasmasuk').click(function(e) {

        e.preventDefault();
        var dataform = $('#formkasmasuk')[0];
        var data = new FormData(dataform);

        var kasmasuk = $('#kasmasuk').val();
        var kodeakun = $('#kodeakun').val();
        var tanggal = $('#tanggal').val();
        var keterangan = $('#keterangan').val();
        var payto = $('#payto').val();
        var jumlah = $('#jumlahinput').val();

        if (kodeakun == "000") {
            swal("Kode Akun Belum di Pilih!", "", "error")
        } else if (tanggal == " ") {
            swal("Tanggal Belum di Isi!", "", "error")
        } else if (keterangan == "") {
            swal("Keterangan Belum di Isi!", "", "error")
        } else if (payto == "") {
            swal("Payto Belum di Isi!", "", "error")
        } else if (jumlah == "") {
            swal("Jumlah Belum di Isi!", "", "error")
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
                            timer: 1000,
                            showConfirmButton: false
                        })
                        location.reload();

                    }
                }
            });
        }
    })

    $('#tombol-kaskeluar').click(function(e) {

        e.preventDefault();
        var dataform = $('#formkaskeluar')[0];
        var data = new FormData(dataform);

        var kaskeluar = $('#kaskeluar').val();
        var kodeakunout = $('#kodeakunout').val();
        var tanggalout = $('#tanggalout').val();
        var keteranganout = $('#keteranganout').val();
        var paytoout = $('#paytoout').val();
        var jumlahout = $('#jumlahoutput').val();

        if (kodeakunout == "000") {
            swal("Kode Akun Belum di Pilih!", "", "error")
        } else if (tanggalout == " ") {
            swal("Tanggal Belum di Isi!", "", "error")
        } else if (keteranganout == "") {
            swal("Keterangan Belum di Isi!", "", "error")
        } else if (paytoout == "") {
            swal("Payto Belum di Isi!", "", "error")
        } else if (jumlahout == "") {
            swal("Jumlah Belum di Isi!", "", "error")
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
                            timer: 1000,
                            showConfirmButton: false
                        })
                        location.reload();

                    }
                }
            });
        }
    })

    $('.tombol-deletekas').click(function(e) {
        e.preventDefault();
        //alert('hapus');
        //var delete = 'delete';
        var tabel = 'kas';
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