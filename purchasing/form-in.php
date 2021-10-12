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
require '../controller/c_barangmasuk.php';
$bagian = "Purchasing";
$juhal = "Form In";
$kodeoutlet = $_SESSION['kodeoutlet'];
$form = query("SELECT * FROM form_po JOIN supplier ON form_po.kodesupplier = supplier.kodesupplier WHERE form_po.kodeoutlet = '$kodeoutlet' and (form_po.status_ck='2' and form_po.status_ot='1')");
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
                        <div class="col-lg-4">
                            <form action="" method="POST">
                                <label>Pilih No PO Atau Nama Supplier</label>
                                <select onchange="this.form.submit()" class="form-control select2" name="keyword_bahan_masuk">
                                    <option>PILIH NO PO ATAU NAMA SUPPLIER</option>
                                    <?php foreach ($form as $f) : ?>
                                        <option value="<?= $f['No_form']; ?>"> <?= $f['No_form']; ?> || <?= $f['namasupplier']; ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </form>
                        </div>
                        <div class="col-lg-8">
                            <form class="form-horizontal" role="formpo" method="POST" action="../models/input.php">
                                <div class="col-lg-6 m-b-10">

<label>Tanggal Barang Datang</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="tanggal_manual"
                                        placeholder="<?= date("m/d/Y"); ?>" id="datepicker-autoclose1">

                                        <span class="input-group-addon bg-primary b-0 text-white"><i
                                                class="ti-calendar"></i></span>

                                    </div><!-- input-group -->

                                </div>

                                <div class="col-lg-6 m-b-10">


<label>Tanggal jatuh tempo</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="tgl_tempo"
                                        placeholder="<?= jatuhtempo(date("Y-m-d"), '14', 'days') ?>"  id="datepicker-autoclose">

                                        <span class="input-group-addon bg-primary b-0 text-white"><i
                                                class="ti-calendar"></i></span>

                                    </div><!-- input-group -->
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 " style="margin-top: 10px;">
                            
                                <input type="hidden" name="inputformin">
                                <div class="card-box" style="height:400px; overflow-y: auto;">
                                    <div class="col-lg-12">
                                        <div class="responsive-table-plugin">
                                            <div class="table-rep-plugin">
                                                <div class="table-responsive" data-pattern="priority-columns">
                                                    <!-- <h4 class="header-title m-t-0 m-b-20">Detail PO</h4> -->
                                                    <div class="col-6 m-b-25">
                                                        <?php if (isset($detail)) : ?>
                                                            <table class="">
                                                                <tr>
                                                                    <td style="font-weight: 600; width:100px">No Form PO</td>
                                                                    <td>: <?= $detail['No_form']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-weight: 600; width:100px">Supplier</td>
                                                                    <td>: <?= $detail['namasupplier']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-weight: 600; width:100px">Alamat</td>
                                                                    <td>: <?= $detail['alamatsupplier']; ?></td>
                                                                </tr>
                                                            </table>
                                                        <?php endif ?>
                                                    </div>
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
                                                            <?php if (isset($item_po)) : ?>
                                                                <?php foreach ($item_po as $item) : ?>
                                                                    <tr>
                                                                        <input type="hidden" name="noform" value="<?= $detail['No_form']; ?>">
                                                                        <input type="hidden" name="kodesupplier" value="<?= $detail['kodesupplier']; ?>">
                                                                        <input type="hidden" name="kodebahan[]" value="<?= $item["kodebarang"]; ?>">
                                                                        <input type="hidden" name="unit[]" value="<?= $item["unit"]; ?>">
                                                                        <th><input readonly type="text" class="form-control" value="<?= $item['namabarang']; ?>"></th>
                                                                        <td><input type="text" name="harga[]" class="form-control harga" value="<?= $item['harga']; ?>"></td>
                                                                        <td><input readonly type="text" class="form-control " value="<?= $item['namaunit']; ?>"></td>
                                                                        <td><input type="number" id="qty" step="0.0001" name="qty[]" class="form-control qty" value="<?= $item['qty']; ?>"></td>
                                                                        <td><input readonly name="subtotal[]" type="text" class="form-control subtotal" value=" <?= $item['subtotal']; ?>"></td>
                                                                        <td><button class="btn btn-icon waves-effect waves-light btn-danger m-b-5 delete">
                                                                                <i class="fa fa-remove"></i> </button></td>
                                                                    </tr>
                                                                <?php endforeach ?>
                                                            <?php endif ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card-box" style="height:130px; ">
                                <div class="form-group">
                                    <label class="col-sm-1 control-label" name="total_keseluruhan">Total</label>
                                    <div class="col-sm-11">
                                        <input type="text" readonly name="total_keseluruhan" id="total-harga" class="form-control">
                                        <!-- <p class="form-control-static" id="total-harga" name="total_keseluruhan"></p> -->
                                    </div>
                                </div>
                                <div class="form-group  text-center" style="margin-top: 10px;">
                                    <?php if ($_SESSION['kodeoutlet'] != 'OUT001') : ?>
                                        <button type="submit" class="btn btn-purple waves-effect waves-light mr-1 m-t-10" id="simpan">
                                            <span>Simpan</span>
                                        </button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>

                        </form>

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
    <script>
        $(document).ready(function() {
            
            totalharga();

            $(document).on("input", ".harga", function() {
                var harga = parseInt($(this).val());
                var jumlah = parseInt($(this).closest("tr").find(".qty").val());
                var total = jumlah * harga;
                $(this).closest("tr").find("input.subtotal").val(total);
                totalharga();
            });
            $(document).on("input", ".qty", function() {
                var jumlah = parseFloat($(this).val());
                var harga = parseFloat($(this).closest("tr").find(".harga").val());
                var total = jumlah * harga;
                $(this).closest("tr").find("input.subtotal").val(total);
                totalharga();
            });
            $(document).on("click", ".delete", function() {
                $(this).closest("tr").remove();
                totalharga();
            });
            $(document).on("click", "#simpan", function() {
                console.log($(this).serialize());
            });
        })

        function totalharga() {
            var sum = 0;
            $(".subtotal").each(function() {
                sum += parseFloat($(this).val());
            })
            $("#total-harga").val('Rp. ' + sum);
        }

        function sweetfunction() {

            const msg = $('#msg').data('msg');
            if (msg == 1) {
                swal({
                    title: "Input Berhasil!",
                    type: "success",
                    //text: "I will close in 2 seconds.",
                    timer: 1100,
                    showConfirmButton: false
                })
            } else if (msg < 1) {
                swal("Input Gagal!", "", "error")
            }
        }
    </script>
</body>

</html>

<script>
</script>