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
$bagian = "Report";
$juhal = "Laporan Order Produk";

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

            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card-box">
                                <form method="post" action="">
                                    <?php require '../include/tglharian.php'; ?>
                                </form>
                            </div>
                        </div><!-- end col -->
                        <div class="col-lg-6">
                            <div class="card-box">
                                <form method="post" action="">
                                    <?php require '../include/tglrange.php'; ?>
                                </form>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card-box">
                                <form method="post" action="">
                                    <input type="hidden" name="filter-date">
                                    <?php require '../include/tgltahun.php'; ?>
                                </form>
                            </div>
                        </div><!-- end col -->

                    </div>
                    <!-- end row -->
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

                                                <td><a href="detail-produk.php?No_form=<?= $dp['No_form']; ?>" class="btn btn-primary waves-effect waves-light btn-xs m-b-5">Details</a>
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

                var nama = $(this).data("nama");
                var harga = $(this).data("harga");
                var jumlah = 1;

                html =
                    '<tr><td><input readonly type="text" name="namabarang[]"  class="form-control"  value="' +
                    nama +
                    '"></td><td ><input type="text"  readonly  class="form-control harga"  name="harga[]"  value="' +
                    harga +
                    '"></td><td><input id="jumlah" class="form-control" type="number" name="jumlah[]" value="' +
                    jumlah +
                    '"></td><td class=""><input type="text" readonly name="subtotal[]" class="form-control total" id="subtotal_item" value="' +
                    harga + '" ></td>';
                html +=
                    '<td><button id="remove" class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i> </button></td></tr>';
                $("#order>tbody").append(html);
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