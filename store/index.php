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
require '../controller/c_store.php';
$bagian = "Store";
$juhal = "Store Produk";

$tabel = 'form_storeproduk';
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
            <!-- Start content -->
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
                                        <h4 class="header-title m-t-0 m-b-30">Data Order Produk</h4>
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
                                                <th>No. Form Store produk</th>
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
                                                    <td><?= $dp['kodeoutlet'] ?></td>
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

                                                    <td><a href="detail_storeproduk.php?No_form=<?= $dp['No_form']; ?>" class="btn btn-primary waves-effect waves-light btn-xs m-b-5">Details</a>
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
                <div class="content">
                    <div class="container" style="margin-top: 5px;">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="portfolioFilter">

                                            <a href="#" data-filter="*" class="current waves-effect waves-primary">All</a>
                                            <?php foreach ($k_produk as $kp) : ?>
                                                <a href="#" data-filter=".<?= $kp['kodekategoriproduk']; ?>" class=" text-capitalize waves-effect waves-primary"><?= $kp['namakategoriproduk']; ?></a>
                                            <?php endforeach ?>
                                            <!-- <a href="#" data-filter=".natural" class="waves-effect waves-primary">Beverage</a> -->
                                            <!-- <a href="#" data-filter=".creative" class="waves-effect waves-primary">Foods</a>
                                        <a href="#" data-filter=".personal" class="waves-effect waves-primary">Snacks</a> -->
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <form>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn waves-effect waves-light btn-primary"><i class="fa fa-search"></i></button>
                                                </span>
                                                <input type="text" id="search" name="keyword" class="form-control" placeholder="Search">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-12" style="margin-top: 10px;">
                                        <div class="card-box" style="height:550px; overflow-y: auto; ">
                                            <div class="port mb-2">
                                                <div class="portfolioContainer" id="list-produk">
                                                    <?php foreach ($produk as $p) : ?>
                                                        <div class="col-md-6 col-xl-3 col-lg-4 <?= $p['kodekategoriproduk']; ?>">
                                                            <div class="gal-detail thumb">
                                                                <a href="../assets/images/products/<?= $p['gambar']; ?>" class="image-popup" title="Screenshot-3">
                                                                    <img src="../assets/images/products/<?= $p['gambar']; ?>" class="thumb-img img-fluid" style="height: 220px;" alt="work-thumbnail">
                                                                </a>
                                                                <div class="text-center">
                                                                    <a href="javascript:;" id="add" data-id="<?= $p['id'] ?>" data-nama="<?= $p['namaproduk'] ?>" data-harga="<?= $p['harga'] ?>">
                                                                        <h4 class="text-capitalize"><?= $p['namaproduk']; ?>
                                                                        </h4>
                                                                    </a>
                                                                    <p class="font-15 text-muted mb-2"><span class="label label-primary"><?= $p['harga']; ?></span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach ?>

                                                </div><!-- end portfoliocontainer-->
                                            </div> <!-- End row -->
                                        </div> <!-- card box -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <form class="form-horizontal" role="formpo" method="POST" action="../models/input.php">
                                        <input type="hidden" name="inputformstore">
                                        <div class="card-box" style="height:400px; overflow-y: auto;">
                                            <div class="col-lg-12">
                                                <div class="responsive-table-plugin">
                                                    <div class="table-rep-plugin">
                                                        <div class="table-responsive" data-pattern="priority-columns">
                                                            <table id="order" class="table table-striped mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Nama Produk</th>
                                                                        <th data-priority="1">Harga</th>
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
                                                    <input type="text" readonly name="total_keseluruhan" id="total-harga" class="form-control" value="Rp. 0">
                                                    <!-- <p class="form-control-static" id="total-harga" name="total_keseluruhan"></p> -->
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Outlet</label>
                                                <div class="col-sm-10">

                                                    <input type="text" readonly name="outlet" id="outlet" class="form-control" value="<?= $_SESSION['outlet']; ?>">

                                                </div>
                                            </div>

                                            <div class="form-group  text-center" style="margin-top: 10px;">
                                                <button class="btn btn-purple waves-effect waves-light mr-1" id="simpan">
                                                    <span>Order</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container -->
        </div> <!-- content -->

    <?php endif; ?>

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

    function totalharga() {
        var sum = 0;
        $(".total").each(function() {
            sum += parseFloat($(this).val());
        });
        $("#total-harga").val('Rp. ' + sum);
    }

    $(document).ready(function() {
        $(document).on("input", "#search", function() {
            var query = $("#search").val();
            var data = '<?php echo json_encode($produk); ?>';
            var product = JSON.parse(data);
            var result;
            if (query == '') {
                result = product;
            } else {
                result = product.filter(p => p.namaproduk.toLowerCase().indexOf(query) > -1);
            }
            $('#list-produk').empty();
            console.log(result);
            result.forEach(res => {
                html = '<div class="col-md-6 col-xl-3 col-lg-4 ' + res.kodekategoriproduk +
                    '"><div class="gal-detail thumb">';
                html += '<a href="../assets/images/products/' + res.gambar +
                    '" class="image-popup" title="Screenshot-3">';
                html += '<img src="../assets/images/products/' + res.gambar +
                    '" class="thumb-img img-fluid" alt="work-thumbnail"></a>';
                html += '<div class="text-center "><a href="javascript:;" id="add" data-nama="' +
                    res.namaproduk + '" data-harga="' + res.harga + '">';
                html += '<h4 class="text-capitalize">' + res.namaproduk + '</h4></a>';
                html += '<p class="font-15 text-muted mb-2"><span class="label label-primary">' +
                    res.harga + '</span></p></div></div></div>';

                $("#list-produk").append(html);
            });
        });

        $(document).ready(function() {
            $(document).on("input", "#search", function() {
                var query = $("#search").val();
                var data = '<?php echo json_encode($produk); ?>';
                var product = JSON.parse(data);
                var result;
                if (query == '') {
                    result = product;
                } else {
                    result = product.filter(p => p.namaproduk.toLowerCase().indexOf(query) > -1);
                }
                $('#list-produk').empty();
                console.log(result);
                result.forEach(res => {
                    html = '<div class="col-md-6 col-xl-3 col-lg-4 ' + res
                        .kodekategoriproduk +
                        '"><div class="gal-detail thumb">';
                    html += '<a href="../assets/images/products/' + res.gambar +
                        '" class="image-popup" title="Screenshot-3">';
                    html += '<img src="../assets/images/products/' + res.gambar +
                        '" class="thumb-img img-fluid" alt="work-thumbnail"></a>';
                    html +=
                        '<div class="text-center "><a href="javascript:;" id="add" data-nama="' +
                        res.namaproduk + '" data-harga="' + res.harga + '">';
                    html += '<h4 class="text-capitalize">' + res.namaproduk + '</h4></a>';
                    html +=
                        '<p class="font-15 text-muted mb-2"><span class="label label-primary">' +
                        res.harga + '</span></p></div></div></div>';

                    $("#list-produk").append(html);
                });

            });
            $(document).on("click", "#add", function() {
                var id = $(this).data("id");
                var nama = $(this).data("nama");
                var harga = $(this).data("harga");
                console.log(id)
                console.log(nama)
                console.log(harga)
                var jumlah = 1;
                var check = document.getElementsByClassName(id)[0];
                if (check != null) {
                    var qty = check.value;
                    var newQty = parseInt(qty) + parseInt(jumlah);
                    check.value = newQty;
                    var price = parseInt(document.getElementsByClassName("hrg-" + id)[0].value);
                    var newPrice = price * newQty;
                    document.getElementsByClassName("sub-" + id)[0].value = newPrice;
                } else {
                    html =
                        '<tr><td><input readonly type="text" name="namabarang[]"  class="form-control"  value="' +
                        nama +
                        '"></td><td ><input type="text"  readonly  class="form-control harga hrg-' +
                        id + '"  name="harga[]"  value="' +
                        harga +
                        '"></td><td><input id="jumlah" class="form-control ' + id +
                        '" type="number" name="jumlah[]" value="' +
                        jumlah +
                        '"></td><td class=""><input type="text" readonly name="subtotal[]" class="form-control total sub-' +
                        id + '" id="subtotal_item" value="' +
                        harga + '" ></td>';
                    html +=
                        '<td><button id="remove" class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i> </button></td></tr>';
                    $("#order>tbody").append(html);
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
    });
</script>