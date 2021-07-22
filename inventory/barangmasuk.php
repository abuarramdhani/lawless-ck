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
$bagian = "Inventory";
$juhal = "Bahan Masuk";

$form = query("SELECT * FROM form_po JOIN supplier ON form_po.kodesupplier = supplier.kodesupplier");

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

                    <div class="row">
                        <div class="col-lg-6">
                            <form action="" method="POST">
                                <select onchange="this.form.submit()" class="form-control select2" name="keyword_bahan_masuk">

                                    <option>PILIH NO PO ATAU NAMA SUPPLIER</option>
                                    <?php foreach ($form as $f) : ?>
                                        <option value="<?= $f['No_form']; ?>"> <?= $f['No_form']; ?> || <?= $f['namasupplier']; ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 " style="margin-top: 10px;">
                            <form class="form-horizontal" role="formpo" method="POST" action="input.php">
                                <div class="card-box" style="height:450px; overflow-y: auto;">
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
                                                                <th data-priority="3">Jumlah</th>
                                                                <th data-priority="1">Subtotal</th>
                                                                <th data-priority="1">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (isset($item_po)) : ?>
                                                                <?php foreach ($item_po as $item) : ?>
                                                                    <tr>
                                                                        <th><input readonly type="text" class="form-control" value="<?= $item['namabahan']; ?>"></th>
                                                                        <td><input type="text" class="form-control" value="<?= $item['harga']; ?>"></td>
                                                                        <td><input type="number" class="form-control" value="<?= $item['qty']; ?>"></td>
                                                                        <td><input readonly type="text" class="form-control" value=" <?= $item['subtotal']; ?>"></td>
                                                                        <td><button class="btn btn-icon waves-effect waves-light btn-danger m-b-5">
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
                            <div class="card-box" style="height:150px; ">
                                <div class="form-group">
                                    <label class="col-sm-1 control-label" name="total_keseluruhan">Total</label>
                                    <div class="col-sm-11">
                                        <input type="text" readonly name="total_keseluruhan" id="total-harga" class="form-control" value="Rp. 0">
                                        <!-- <p class="form-control-static" id="total-harga" name="total_keseluruhan"></p> -->
                                    </div>
                                </div>


                                <div class="form-group  text-center" style="margin-top: 10px;">

                                    <button class="btn btn-purple waves-effect waves-light mr-1 m-t-10" id="simpan">
                                        <span>Simpan</span>
                                    </button>
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

</body>

</html>

<script>
</script>