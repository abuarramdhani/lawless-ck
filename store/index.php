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
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="portfolioFilter">

                                        <a href="#" data-filter="*" class="current waves-effect waves-primary">All</a>
                                        <?php foreach ($k_produk as $kp) : ?>
                                        <a href="#" data-filter=".<?= $kp['kodekategoriproduk']; ?>"
                                            class=" text-capitalize waves-effect waves-primary"><?= $kp['namakategoriproduk']; ?></a>
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
                                                <button type="submit"
                                                    class="btn waves-effect waves-light btn-primary"><i
                                                        class="fa fa-search"></i></button>
                                            </span>
                                            <input type="text" id="search" name="keyword" class="form-control"
                                                placeholder="Search">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-12" style="margin-top: 10px;">
                                    <div class="card-box" style="height:550px; overflow-y: auto; ">
                                        <div class="port mb-2">
                                            <div class="portfolioContainer" id="list-produk">
                                                <?php foreach ($produk as $p) : ?>
                                                <div
                                                    class="col-md-6 col-xl-3 col-lg-4 <?= $p['kodekategoriproduk']; ?>">
                                                    <div class="gal-detail thumb">
                                                        <a href="../assets/images/products/<?= $p['gambar']; ?>"
                                                            class="image-popup" title="Screenshot-3">
                                                            <img src="../assets/images/products/<?= $p['gambar']; ?>"
                                                                class="thumb-img img-fluid" alt="work-thumbnail">
                                                        </a>
                                                        <div class="text-center">
                                                            <a href="javascript:;" id="add"
                                                                data-nama="<?= $p['namaproduk'] ?>"
                                                                data-harga="<?= $p['harga'] ?>">
                                                                <h4 class="text-capitalize"><?= $p['namaproduk']; ?>
                                                                </h4>
                                                            </a>
                                                            <p class="font-15 text-muted mb-2"><span
                                                                    class="label label-primary"><?= $p['harga']; ?></span>
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
                                                <input type="text" readonly name="total_keseluruhan" id="total-harga"
                                                    class="form-control" value="Rp. 0">
                                                <!-- <p class="form-control-static" id="total-harga" name="total_keseluruhan"></p> -->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Outlet</label>
                                            <div class="col-sm-10">
<<<<<<< Updated upstream
                                                <input type="text" readonly name="outlet" id="outlet"
                                                    class="form-control" value="">
=======
                                                <input type="text" readonly name="outlet" id="outlet" class="form-control" value="<?= $_SESSION['outlet']; ?>">
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
function totalharga() {
    var sum = 0;
    $(".total").each(function() {
        sum += parseFloat($(this).val());
    });
    $("#total-harga").val('Rp. ' + sum);
}
=======
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
                html = '<div class="col-md-6 col-xl-3 col-lg-4 ' + res.kodekategoriproduk + '"><div class="gal-detail thumb">';
                html += '<a href="../assets/images/products/' + res.gambar + '" class="image-popup" title="Screenshot-3">';
                html += '<img src="../assets/images/products/' + res.gambar + '" class="thumb-img img-fluid" alt="work-thumbnail"></a>';
                html += '<div class="text-center "><a href="javascript:;" id="add" data-nama="' + res.namaproduk + '" data-harga="' + res.harga + '">';
                html += '<h4 class="text-capitalize">' + res.namaproduk + '</h4></a>';
                html += '<p class="font-15 text-muted mb-2"><span class="label label-primary">' + res.harga + '</span></p></div></div></div>';

                $("#list-produk").append(html);
            });
>>>>>>> Stashed changes

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

<<<<<<< Updated upstream
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
=======
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
>>>>>>> Stashed changes
</script>