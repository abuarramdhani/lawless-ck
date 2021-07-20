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
$bagian = "Store";
$juhal = "Store";
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
                <div class="container" style="margin-top: 5px;">
                    <div class="col-lg-6">
                        <div class="col-lg-6">
                            <div class="portfolioFilter">
                                <a href="#" data-filter="*" class="current waves-effect waves-primary">All</a>
                                <a href="#" data-filter=".natural" class="waves-effect waves-primary">Beverage</a>
                                <a href="#" data-filter=".creative" class="waves-effect waves-primary">Foods</a>
                                <a href="#" data-filter=".personal" class="waves-effect waves-primary">Snacks</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
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

                        <div class="col-lg-12">
                            <div class="card-box" style="height:550px; overflow-y: auto; ">
                                <div class="port mb-2">
                                    <div class="portfolioContainer">
                                        <div class="col-md-6 col-xl-3 col-lg-4 natural">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/products/no_image.jpg" class="image-popup"
                                                    title="Screenshot-3">
                                                    <img src="../assets/images/products/no_image.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Name Product</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">20.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 natural">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/products/no_image.jpg" class="image-popup"
                                                    title="Screenshot-3">
                                                    <img src="../assets/images/products/no_image.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Name Product</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">20.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 natural">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/products/no_image.jpg" class="image-popup"
                                                    title="Screenshot-3">
                                                    <img src="../assets/images/products/no_image.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Name Product</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 creative">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/products/no_image.jpg" class="image-popup"
                                                    title="Screenshot-2">

                                                    <img src="../assets/images/products/no_image.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Name Product</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">25.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 creative">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/products/no_image.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/products/no_image.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Name Product</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">55.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/products/no_image.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/products/no_image.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Name Product</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/products/no_image.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/products/no_image.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Name Product</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/products/no_image.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/products/no_image.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Name Product</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/products/no_image.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/products/no_image.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Name Product</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/products/no_image.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/products/no_image.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Name Product</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/products/no_image.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/products/no_image.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Name Product</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/products/no_image.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/products/no_image.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Name Product</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-xl-3 col-lg-4 personal">
                                            <div class="gal-detail thumb">
                                                <a href="../assets/images/products/no_image.jpg" class="image-popup"
                                                    title="Screenshot-2">
                                                    <img src="../assets/images/products/no_image.jpg"
                                                        class="thumb-img img-fluid" alt="work-thumbnail">
                                                </a>
                                                <div class="text-center">
                                                    <h4>Name Product</h4>
                                                    <p class="font-13 text-muted mb-2"><span
                                                            class="badge badge-primary badge-pill">15.000</span></p>
                                                </div>
                                            </div>
                                        </div>






                                    </div><!-- end portfoliocontainer-->
                                </div> <!-- End row -->
                            </div> <!-- card box -->
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <form class="form-horizontal" role="formpo" method="POST" action="input.php">
                                <div class="card-box" style="height:400px; overflow-y: auto;">
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
                                            <input type="text" readonly name="outlet" id="outlet" class="form-control"
                                                value="outlet">
                                        </div>
                                    </div>

                                    <div class="form-group  text-center" style="margin-top: 10px;">
                                        <button class="btn btn-danger waves-effect waves-light mr-1">
                                            <span>Batal</span>
                                        </button>
                                        <button class="btn btn-purple waves-effect waves-light mr-1" id="simpan">
                                            <span>Kirim Order</span>
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
function loadData() {
    $("#barang>tbody").empty();
    var search = $("#search").val();
    $.ajax({
        url: '../controller/c_form-po.php',
        data: {
            'keyword_form-po': search
        },
        type: 'POST'
    }).done(function(response) {
        var result = JSON.parse(response);
        var i = 1;
        result.forEach(res => {
            html = '<tr><td>' + i + '</td><td>' + res.kodebahan + '</td><td>' + res.namabahan + '</td>';
            html += '<td><button id="add" data-id="' + res.id + '" data-nama="' + res.namabahan +
                '" data-harga="' + res.harga +
                '" class="btn btn-icon waves-effect waves-light btn-success m-b-5"><i class="fa fa-plus"></i></button></td></tr>';
            i++;
            $("#barang>tbody").append(html);
        });
    });
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
        var jumlah = 1;

        // html = '<tr><td class="item_nama">' + nama + '</td><td class="harga item">' + harga + '</td><td class="item"><input id="jumlah" type="number" name="jumlah[]" value="' + jumlah + '"></td><td class="total item">' + harga + '</td>';
        // html += '<td><button id="remove" class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i> </button></td></tr>';
        // $("#order>tbody").append(html);
        // totalharga();
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
</script>