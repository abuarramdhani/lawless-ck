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
require '../controller/c_detailproyek.php';
$bagian = "Project";
$juhal = "Project";
?>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <?php require '../include/topbar.php';?>

        <?php require '../include/sidebar.php';?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                    <h2 class="modal-title">Pengeluaran Proyek
                                        <?php echo $kodeproyek . $kodebulan . $kodetransaksi;  ?></h2>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="field-5" class="control-label">Tanggal :</label>
                                                    <input type="text" class="form-control" id="datepicker-autoclose"
                                                        name="tanggal">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Pay To</label>
                                                    <input type="text" class="form-control" name="payto">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Kode Akun</label>
                                                    <select class="form-control select2" name="kodeakun" id="kodeakun">
                                                        <option></option>
                                                        <?php $item = query("SELECT * FROM kodeakun WHERE kodeakun3 ='521' OR kodeakun3 ='522' OR kodeakun3 ='519' OR kodeakun3 ='516' OR kodeakun3 ='5201' "); ?>
                                                        <?php foreach ($item as $row) : ?>
                                                        <option value="<?= $row['kodeakun3'] ?>"><?= $row["ketkode3"] ?>
                                                        </option>
                                                        <?php endforeach; ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Keterangan</label>
                                                    <input type="text" class="form-control" name="keterangan">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Jumlah</label>
                                                    <input type="text" class="form-control" placeholder="Rp."
                                                        name="jumlahpembayaran">
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default waves-effect"
                                            name="belanjaproyek">Input Pengeluaran</button>
                                        <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal -->

                    <div id="output-close-modal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                    <h2 class="modal-title">Pembayaran Proyek</h2>

                                </div>
                                <form id="formpembayaranproyek">
                                    <div class="modal-body">
                                        <input type="hidden" value="pembayaranproyek" id="pembayaranproyek"
                                            name="pembayaranproyek">
                                        <input type="hidden" value="<?php echo $noproyek;  ?>" id="noproyek"
                                            name="noproyek">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="datepicker-autoclose1"
                                                        class="control-label">Tanggal</label>
                                                    <input type="text" class="form-control" id="datepicker-autoclose1"
                                                        value="<?=date('m/d/Y')?>" name="tanggal" id="tanggal">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="field-5" class="control-label">Rekening</label>
                                                    <select class="form-control" name="payto" id="payto">

                                                        <option value="SkutRS">Skut RS</option>
                                                        <option value="Hasan">Hasan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Pembayaran Ke :</label>
                                                    <select class="form-control" name="pk" id="pk">
                                                        <option><?= $ktr ?></option>
                                                        <option>Pelunasan</option>
                                                        <option>Discount</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Jumlah</label>
                                                    <input type="text" class="form-control" id="jumlahinput"
                                                        name="jumlahinput">
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default waves-effect"
                                            id="tombol-pembayaranproyek">Input Pembayaran</button>
                                        <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal -->

                    <div id="bon-close-modal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                    <h2 class="modal-title">Edit Proyek</h2>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <div class="row">

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-5" class="control-label">Nama Klien</label>
                                                    <select class="form-control select2" name="kodeklien"
                                                        id="kodeklien">
                                                        <option value="<?= $kodeklien ?>"><?= ucwords($namaklien) ?>
                                                        </option>
                                                        <?php foreach ($kodeklienn as $rowr ) : ?>
                                                        <option value="<?= $rowr['kodeklien'] ?>">
                                                            <?= $rowr['namaklien'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-3" class="control-label">Outlet</label>
                                                    <input type="text" class="form-control" id="outlet"
                                                        value="<?= ucwords($detpro['outlet']) ?>" name="outlet">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-3" class="control-label">Alamat / Tempat</label>
                                                    <input type="text" class="form-control" id="tempat"
                                                        value="<?= ucwords($detpro['tempat']) ?>" name="tempat">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Nilai Proyek</label>
                                                    <input type="text" class="form-control" id="nilaiproyek"
                                                        name="nilaiproyek" value="<?= $detpro['nilaiproyek'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Discount</label>
                                                    <input type="text" class="form-control" id="diskon" name="diskon"
                                                        value="<?= $detpro['diskon'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Total Proyek</label>
                                                    <input type="text" class="form-control"
                                                        value="Rp. <?php echo number_format($detpro['nilaiproyek'] - $detpro['diskon']) ?>"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default waves-effect"
                                            name="editproyek">Input</button>
                                        <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal -->
                    <div id="add-close-modal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                    <h2 class="modal-title">Add Unit Proyek</h2>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Tanggal</label>
                                                    <input type="text" class="form-control" id="datepicker-autoclose2"
                                                        placeholder="Tanggal" name="tanggal">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label for="field-5" class="control-label">Nama Unit</label>
                                                    <select class="form-control select2" name="namaunit">
                                                        <option>Pilih Nama Unit</option>
                                                        <?php foreach ($kodeunitt as $row) : ?>
                                                        <option value="<?= $row['kodeunit'] ?>">
                                                            <?= ucwords($row["namaunit"]) ?> - (L)<?= $row['panjang'] ?>
                                                            x (W)<?= $row['lebar'] ?> x (H)<?= $row['tinggi'] ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Qty </label>
                                                    <input type="text" class="form-control" id="jumlah"
                                                        placeholder="Jumlah" name="jumlah">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="field-5" class="control-label">Merk</label>
                                                    <select class="form-control select2" name="merk">
                                                        <option>Pilih Merk</option>
                                                        <?php foreach ($kodemerkk as $row) : ?>
                                                        <option value="<?= $row['kodemerk'] ?>">
                                                            <?= strtoupper($row["merk"]) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="field-5" class="control-label">Harga</label>
                                                    <input type="text" class="form-control" id="field-5"
                                                        placeholder="Harga Unit" name="harga">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default waves-effect"
                                            name="addunit">Input</button>
                                        <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal -->
                    <!-- Forms -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="row">

                                    <div class="col-md-6">
                                        <form class="form-horizontal" role="form" id="formupdateproyek">
                                            <input type="hidden" value="updateproyek" id="updateproyek"
                                                name="updateproyek">
                                            <input type="hidden" value="<?= $noproyek;?>" id="noproyek" name="noproyek">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Kode
                                                    Proyek</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" readonly=""
                                                        value="<?= $kodeproyek;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="noproyek" class="col-sm-2 control-label">Nama Klien</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control select2" name="kodeklien"
                                                        id="kodeklien">
                                                        <option value="<?= $kodeklien ?>"><?= ucwords($namaklien) ?>
                                                        </option>
                                                        <?php foreach ($kodeklienn as $rowr ) : ?>
                                                        <option value="<?= $rowr['kodeklien'] ?>">
                                                            <?= $rowr['namaklien'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="pekerjaaan" class="col-sm-2 control-label">Pekerjaan</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control select2" name="pekerjaan"
                                                        id="pekerjaan">
                                                        <?php if($detpro['pekerjaan']=="1") :?>
                                                        <option value="<?= $detpro['pekerjaan']; ?>">Cold Storage
                                                        </option>
                                                        <?php elseif($detpro['pekerjaan']=="2") :?>
                                                        <option value="<?= $detpro['pekerjaan']; ?>">Konstruksi
                                                        </option>
                                                        <?php elseif($detpro['pekerjaan']=="3") :?>
                                                        <option value="<?= $detpro['pekerjaan']; ?>">Listrik</option>
                                                        <?php elseif($detpro['pekerjaan']=="4") :?>
                                                        <option value="<?= $detpro['pekerjaan']; ?>">Unit</option>
                                                        <?php endif;?>
                                                        <option value="1">Cold Storage</option>
                                                        <option value="2">Konstruksi</option>
                                                        <option value="3">Listrik</option>
                                                        <option value="4">Unit</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="outlet" class="col-sm-2 control-label">Outlet</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="outlet" name="outlet"
                                                        value="<?php echo ucwords($detpro['outlet']); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tempat" class="col-sm-2 control-label">Tempat</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="tempat" name="tempat"
                                                        value="<?php echo ucwords($detpro['tempat']); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nilaiproyek" class="col-sm-2 control-label">Nilai
                                                    Proyek</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="nilaiproyek"
                                                        name="nilaiproyek"
                                                        value="<?php echo $detpro['nilaiproyek']  ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan"
                                                    class="col-sm-2 control-label">Keterangan</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="keterangan"
                                                        name="keterangan"><?= $detpro['keterangan'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan" class="col-sm-2 control-label"></label>
                                                <div class="col-sm-10">
                                                    <button type="submit"
                                                        class="btn btn-purple waves-effect waves-light"
                                                        id="tombol-updateproyek" name="tombol-updateproyek">Update
                                                        Proyek</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div><!-- end col -->

                                    <div class="col-md-6">
                                        <!-- <h4 class="m-t-0 header-title"><b>Rekapan</b></h4> -->

                                        <button type="submit" data-toggle="modal" data-target="#output-close-modal"
                                            class="btn btn-info waves-effect waves-light">Pembayaran</button>
                                        <button type="submit" data-toggle="modal" data-target="#con-close-modal"
                                            class="btn btn-danger waves-effect waves-light">Pengeluaran</button>
                                        <!-- <button type="submit" data-toggle="modal" data-target="#add-close-modal"
                                            class="btn btn-success waves-effect waves-light">Add Unit</button> -->
                                        <br><br>
                                        <form class="form-horizontal" role="form">
                                            <?php
                                    $persen = number_format(((($totali / ($detpro['nilaiproyek'] - $detpro['diskon']))) * 100));
                                    $persenos = number_format((((($detpro['nilaiproyek'] - $detpro['diskon']) - $totali) / ($detpro['nilaiproyek'] - $detpro['diskon'])) * 100));
                                    ?>
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Jumlah
                                                    Pembayaran</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputEmail3" readonly=""
                                                        value="Rp. <?= number_format($totali);  ?> - <?= $persen  ?> %">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword3"
                                                    class="col-sm-3 control-label">OutStanding</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputPassword3"
                                                        readonly=""
                                                        value="Rp. <?= number_format(($detpro['nilaiproyek'] - $detpro['diskon']) - $totali);  ?> - <?= $persenos  ?> %">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword4" class="col-sm-3 control-label">Jumlah
                                                    Pengeluaran</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputPassword4"
                                                        readonly="" value="Rp. <?= number_format($totalp);  ?>">
                                                </div>
                                            </div>
                                            <!--<div class="form-group">-->
                                            <!--    <label for="inputPassword4" class="col-sm-5 control-label" >-->
                                            <?php
                                    //if (($totali-$totalp)>0) {
                                    //echo "Laba";
                                    //}else{echo "Rugi";}
                                    ?>

                                            <!--          </label>-->
                                            <!--          <div class="col-sm-7">-->
                                            <!--            <input type="text" class="form-control" id="inputPassword4" readonly="" value="Rp. <?= number_format($totali - $totalp);  ?>">-->
                                            <!--          </div>-->
                                            <!--</div>-->

                                            <!-- <div class="form-group m-b-0">
		                                            <div class="col-sm-offset-3 col-sm-9">
		                                              <button type="submit" class="btn btn-info waves-effect waves-light">Sign in</button>
		                                            </div>
		                                        </div> -->
                                        </form>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <div class="dropdown pull-right">

                                    <!-- <a href="cetakoutstandingproyek.php?mod=report&act=pdf&kp=<?= $kp; ?>"
                                        target="_blank" class="btn btn-primary waves-effect waves-light">Cetak PDF</a> -->
                                </div>
                                <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>No Voucher</th>
                                            <th>Kode Akun</th>
                                            <th>Keterangan</th>
                                            <th>Rekening</th>
                                            <th>Input</th>
                                            <th>Output</th>


                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($dp as $row) : ?>
                                        <tr>
                                            <td width="5%"><?= $i ?></td>
                                            <td>
                                                <?php
                                            $t = $row['tanggal'];
                                            $ta = substr($t, 8, 2);
                                            $bu = "/" . substr($t, 5, 2) . "/";
                                            $tah = substr($t, 0, 4);

                                            echo $ta . $bu . $tah;
                                            ?>
                                            </td>


                                            <?php if ($row["kodekas"] != "KBMP") : ?>
                                            <td class="text-danger">
                                                <?= $row["kodekas"] . $row["kodebulan"] . $row["kodetr"] ?></td>
                                            <?php else : ?>
                                            <td class="text-primary">
                                                <?= $row["kodekas"] . $row["kodebulan"] . $row["kodetr"] ?></td>
                                            <?php endif; ?>
                                            <td>
                                                <?php
                                            $kodeakun = $row["kodeakun"];
                                            $ka = "SELECT * FROM kodeakun WHERE kodeakun3 ='$kodeakun'"; //perintah untuk menjumlahkan
                                            $hasilka = mysqli_query($conn, $ka); //melakukan query dengan varibel $jumlahkan
                                            $tampil = mysqli_fetch_array($hasilka); //menyimpan hasil query ke variabel $t
                                            $tampilkode = $tampil['ketkode3'];

                                            ?>
                                                <?= ucwords($tampilkode);  ?>
                                            </td>

                                            <td><?= $row["keterangan"] ?></td>
                                            <td><?= $row["payto"] ?></td>
                                            <td>Rp. <?= number_format($row["input"]) ?></td>
                                            <td>Rp. <?= number_format($row["output"]) ?></td>

                                            <!-- <td>
                                                    <a href="pembayaranproyek.php?id=<?php //$row["id"] 
                                                                                        ?>" class="on-default remove-row badge badge-success" ><i class="fa fa-dollar"></i></a> |
                                                    <a href="add/hapusproyekjt.php?id=<?php //$row["id"] 
                                                                                        ?>" onClick="if(confirm('Apakah anda yakin menghapus transaksi ini ?')){return true}else{return false}" class="on-default remove-row badge badge-danger" ><i class="fa fa-trash-o"></i></a> 
                                                    <a href="editkaryawan.php?id=" class="on-default edit-row badge badge-warning"><i class="fa fa-pencil"></i></a> 
                                                    
                                                </td> -->










                                        </tr>
                                        <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>

                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->

            <?php require '../include/footer.php';?>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

        <?php require '../include/rightsidebar.php';?>



    </div>
    <!-- END wrapper -->

    <?php require '../include/scriptfooter.php';?>

</body>

</html>

<script>
$(document).ready(function() {
    $('#tombol-pembayaranproyek').click(function(e) {

        e.preventDefault();
        var dataform = $('#formpembayaranproyek')[0];
        var data = new FormData(dataform);

        var pembayaranproyek = $('#pembayaranproyek').val();
        var noproyek = $('#noproyek').val();
        var tanggal = $('#tanggal').val();
        var payto = $('#payto').val();
        var pk = $('#pk').val();
        var jumlah = $('#jumlahinput').val();

        if (tanggal == " ") {
            swal("Tanggal Belum di Isi!", "", "error")
        } else if (payto == " ") {
            swal("Rekening Belum di Pilih!", "", "error")
        } else if (pk == " ") {
            swal("Pembayaran Ke Belum di Pilih!", "", "error")
        } else if (pk == " ") {
            swal("Jumlah Pembayaran Belum di Isi!", "", "error")
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

    $('#tombol-updateproyek').click(function(e) {

        e.preventDefault();
        var dataform = $('#formupdateproyek')[0];
        var data = new FormData(dataform);

        var updateproyek = $('#updateproyek').val();
        var kodeklien = $('#kodeklien').val();
        var pekerjaan = $('#pekerjaan').val();
        var outlet = $('#outlet').val();
        var tempat = $('#tempat').val();
        var nilaiproyek = $('#nilaiproyek').val();


        if (kodeklien == "000") {
            swal("Nama Klien Belum di Pilih!", "", "error")
        } else if (pekerjaan == "") {
            swal("Pekerjaan Belum di Isi!", "", "error")
        } else if (outlet == "") {
            swal("Outlet Belum di Isi!", "", "error")
        } else if (tempat == "") {
            swal("Tempat Belum di Isi!", "", "error")
        } else if (nilaiproyek == "") {
            swal("Nilai Proyek Belum di Isi!", "", "error")
        } else {
            $.ajax({
                url: '../models/edit.php',
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

                    } else if (hasil == 3) {
                        swal({
                            title: "Edit Berhasil!",
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

    $('.tombol-deleteproyek').click(function(e) {
        e.preventDefault();
        //alert('hapus');
        //var delete = 'delete';
        var tabel = 'proyek';
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