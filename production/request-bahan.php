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
//require '../controller/c_form-po.php';
$bagian = "Production";
$juhal = "Request Bahan";
$kodeoutlet = $_SESSION['kodeoutlet'];
$kodesupplierr = query("SELECT * FROM supplier WHERE kodeoutlet = '$kodeoutlet' ORDER BY id DESC");
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
                                                <!--<th>Kode</th>-->
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
                                <?php if ($kondisi['status'] != 1) : ?>
                                <input type="hidden" name="tanggal_manual" value="<?= date("m/d/Y"); ?>">
                                <?php else : ?>
                                <div class="col-lg-12 m-b-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="tanggal_manual"
                                            value="<?php echo date("m/d/Y"); ?>" id="datepicker-autoclose">
                                        <span class="input-group-addon bg-primary b-0 text-white"><i
                                                class="ti-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div>
                                <?php endif; ?>
                                <input type="hidden" name="requestbahan">
                                <div class="card-box" style="height:350px; overflow-y: auto;">
                                    <div class="col-lg-12">
                                        <div class="responsive-table-plugin">
                                            <div class="table-rep-plugin">
                                                <div class="table-responsive" data-pattern="priority-columns">
                                                    <table id="order" class="table table-striped mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama Produk</th>
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
                                    <!-- awal supplier -->
                                    <!-- <div class="form-group">
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
                                    <!-- akhir supplier -->


                                    <div class="form-group  text-center" style="margin-top: 10px;">
                                        <!-- <button class="btn btn-danger waves-effect waves-light mr-1">
                                            <span>Batal</span>
                                        </button> -->
                                        <?php if ($_SESSION['kodeoutlet'] != 'OUT001') : ?>
                                        <button type="submit" class="btn btn-purple waves-effect waves-light mr-1"
                                            id="">
                                            <span>Simpan</span>
                                        </button>
                                        <?php endif ?>
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
        // sleep(1000);
        setTimeout(function() {
            window.location.replace("../inventory/barangkeluar");
        }, 1300);

    } else if (msg < 1) {
        swal("INPUT GAGAL!", "", "error")
    }

}

function loadData() {
    $("#barang>tbody").empty();
    var search = $("#search").val();
    if (search != '') {
        $.ajax({
            url: '../controller/c_requestbahan.php',
            data: {
                'keyword_form-po': search
            },
            type: 'POST'
        }).done(function(response) {
            var result = JSON.parse(response);
            var i = 1;
            result.forEach(res => {
                html = '<tr><td>' + i + '</td><td>' + res.namabarang + '</td><td>' + res.hargabeli +
                    '</td><td>' + res.namaunit + '</td><td>' + res.stok + '</td>';
                html += '<td><button id="add" data-namaunit="' + res.namaunit + '" data-kodeunit="' +
                    res.kodeunit + '" data-kode="' + res.kodebarang + '" data-stok="' + res.stok +
                    '" data-id="' + res.id + '" data-nama="' + res.namabarang +
                    '" data-harga="' + res.hargabeli +
                    '" class="btn btn-icon waves-effect waves-light btn-success m-b-5"><i class="fa fa-plus"></i></button></td></tr>';
                i++;
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

    $(document).on("click", "#add", function() {
        var id = $(this).data("id");
        var nama = $(this).data("nama");
        var harga = $(this).data("harga");
        var stok = $(this).data("stok");
        var kodebarang = $(this).data("kode");
        var kodeunit = $(this).data("kodeunit");
        var namaunit = $(this).data("namaunit");
        var jumlah = 1;

        var today = new Date();
        var jam = today.getHours();
        var jam = 12
        //  console.log(jam)


        // html = '<tr><td class="item_nama">' + nama + '</td><td class="harga item">' + harga + '</td><td class="item"><input id="jumlah" type="number" name="jumlah[]" value="' + jumlah + '"></td><td class="total item">' + harga + '</td>';
        // html += '<td><button id="remove" class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i> </button></td></tr>';
        // $("#order>tbody").append(html);
        // totalharga();
        var check = document.getElementsByClassName(kodebarang)[0];

        if (jam < 4 || jam >= 16) {
            swal("Waktu Pemesanan sampai Jam 4 Sore ", "", "error")
        } else {
            if (check != null) {
                var qty = check.value;
                var newQty = parseFloat(qty) + parseFloat(jumlah);
                check.value = newQty;
                var price = parseInt(document.getElementsByClassName("hrg-" + kodebarang)[0].value);
                var newPrice = price * newQty;
                document.getElementsByClassName("sub-" + kodebarang)[0].value = newPrice;
            } else {
                if (stok == 0) {
                    swal("Stok Kosong!!!", "", "error")
                } else {


                    html =
                        '<tr><td><input type="hidden" name="kodebarang[]"  class="form-control"  value="' +
                        kodebarang +
                        '"><input readonly type="text" name="namabahan[]"  class="form-control"  value="' +
                        nama +
                        '"></td><td ><input type="text"  readonly  class="form-control harga hrg-' +
                        kodebarang + '"  name="harga[]"  value="' +
                        harga +
                        '"></td><td><input readonly class="form-control " type="hidden" name="kodeunit[]" value="' +
                        kodeunit +
                        '"><input readonly class="form-control " type="text"  value="' +
                        namaunit +
                        '"></td><td><input id="jumlah" step="0.0001" min="0" class="form-control ' +
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

        }



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
    $(document).on("input", "#harga", function() {
        var harga = parseInt($(this).val());
        var jumlah = parseInt($(this).closest("tr").find(".jumlah").val());
        var total = jumlah * harga;
        $(this).closest("tr").find("input#subtotal_item").val(total);

        totalharga();
    });



})
</script>