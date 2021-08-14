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
$bagian = "Report";
$juhal = "Laporan Order Bahan";

// $tabel = 'form_storebahan';
// $tabel_join = 'companypanel';
// $kode = 'outlet';
// include '../include/filter_date.php';

$tabel_filter = 'bahan';
include '../include/filter_range.php';
$kodeoutlet = $_SESSION['kodeoutlet'];

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
            <div class="content">
                <div class="container">

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card-box">
                                <form method="post" action="">
                                    <input type="hidden" name="filter_range">
                                    <?php require '../include/tglrange.php'; ?>

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
                                            <th>Nama Bahan</th>
                                            <?php if (isset($_POST['laporan'])) : ?>
                                                <?php if ($_POST['laporan'] != 'in') : ?>
                                                    <th>OUT</th>
                                                <?php else : ?>
                                                    <th>IN</th>
                                                <?php endif ?>
                                            <?php else : ?>
                                                <th>IN</th>
                                            <?php endif ?>
                                            <th>Total</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php if (isset($_POST['filter_range'])) : ?>
                                            <?php foreach ($data as $row) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $row['date']; ?></td>
                                                    <td><?= $row['namabahan']; ?></td>
                                                    <td><?= $row['total']; ?></td>
                                                    <td><?= $row['subtotalmasuk'] ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->




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
            swal("Tidak ada Data", "", "error")
        }

    }

    function loadData() {
        $("#barang>tbody").empty();
        var search = $("#search").val();
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
                html = '<tr><td>' + i + '</td><td>' + res.kodebahan + '</td><td>' + res.namabahan +
                    '</td><td>' + res.hargaj + '</td>';
                html += '<td><button id="add" data-id="' + res.id + '" data-nama="' + res.namabahan +
                    '" data-harga="' + res.hargaj +
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