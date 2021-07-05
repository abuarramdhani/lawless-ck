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
require '../controller/c_maintenance.php';
$bagian = "Maintenance";
$juhal = "Maintenance";
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

                    <div id="modalklien" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                    <h2 class="modal-title">Input Klien</h2>
                                </div>
                                <form id="formklien">
                                    <div class="modal-body">
                                        <input type="hidden" value="klien" id="klien" name="klien">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nklien" class="control-label">Nama</label>
                                                    <input type="text" class="form-control" name="nklien" id="nklien"
                                                        placeholder="Nama klien"></input>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary waves-effect" id="tombol-klien"
                                            name="tombol-klien">Input Klien</button>
                                        <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal -->

                    <div id="modalproyek" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                    <h2 class="modal-title"><?= $juhal  ?></h2>
                                </div>
                                <form id="formproyek">
                                    <div class="modal-body">
                                        <input type="hidden" value="maintenance" id="maintenance" name="maintenance">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="datepicker-autoclose1"
                                                        class="control-label">Tanggal</label>
                                                    <input type="text" class="form-control" id="datepicker-autoclose1"
                                                        value="<?=date('m/d/Y')?>" name="tanggal">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-5" class="control-label">Nama Klien</label>
                                                    <select class="form-control select2" name="kodeklien"
                                                        id="kodeklien">
                                                        <option value="000">-- Pilih Klien --</option>
                                                        <?php foreach ($kodeklienn as $rowr ) : ?>
                                                        <option value="<?= $rowr['kodeklien'] ?>">
                                                            <?= $rowr['namaklien'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="outlet" class="control-label">Outlet</label>
                                                    <input type="text" class="form-control" id="outlet"
                                                        placeholder="Outlet" name="outlet">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="outlet" class="control-label">Alamat Tempat</label>
                                                    <input type="text" class="form-control" id="outlet"
                                                        placeholder="Tempat" name="tempat">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-2" class="control-label">Pekerjaan</label>
                                                    <select class="form-control select2" name="pekerjaan">

                                                        <option value="5">Maintenance</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nilaiproyek" class="control-label">Nilai
                                                        <?= $juhal  ?></label>
                                                    <input type="text" class="form-control" id="nilaiproyek"
                                                        name="nilaiproyek" placeholder="Rp.">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info waves-effect" id="tombol-proyek"
                                            name="tombol-proyek">Input <?= $juhal  ?></button>
                                        <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal -->


                    <div class="row">
                        <div class="col-lg-7">
                            <div class="card-box">

                                <div class="dropdown pull-right">

                                    <!--  <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modalproyek">Input Proyek</button> -->
                                </div>
                                <div class="dropdown pull-centre">
                                    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                                        data-target="#input-close-modal">Total <?= $juhal  ?> : Rp.
                                        <?= format_rupiah($totali); ?>
                                    </button>
                                    <button class="btn btn-info waves-effect waves-light" data-toggle="modal"
                                        data-target="#output-close-modal">
                                        Outstanding : Rp. <?= format_rupiah($totalot); ?></button>

                                </div>
                            </div>
                        </div><!-- end col -->

                        <div class="col-lg-5">
                            <div class="card-box">

                                <form method="post" action="">
                                    <?php require '../include/tgltahun.php';?>
                                </form>

                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->




                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <div class="dropdown pull-right">
                                    <button class="btn btn-primary waves-effect waves-light btn-xs m-b-5"
                                        data-toggle="modal" data-target="#modalklien">Input Klien</button>
                                    <button class="btn btn-info waves-effect waves-light btn-xs m-b-5"
                                        data-toggle="modal" data-target="#modalproyek">Input <?= $juhal  ?></button>
                                </div>
                                <h4 class="header-title m-t-0 m-b-30">Data <?= $juhal  ?></h4>
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>No <?= $juhal  ?></th>
                                            <th>Nama Klien</th>
                                            <th>Outlet</th>
                                            <th>Tempat</th>
                                            <th>Pekerjaan</th>
                                            <th>Nilai <?= $juhal  ?></th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($proyek as $row ) : ?>
                                        <tr>
                                            <td width="5%"><?= $i ?></td>
                                            <td>
                                                <?php 
                                                        $t = $row['tanggalpjt'];
                                                        $ta = substr($t,8,2);
                                                        $bu = "/".substr($t,5,2)."/";
                                                        $tah = substr($t,0,4);
                                                        
                                                        echo $ta.$bu.$tah ;
                                                    ?>
                                            </td>


                                            <td class="text-success">
                                                <?php $kodeurut = substr($row['noproyek'],0,3) ?>
                                                <a href="detailmaintenance.php?kp=<?= $row['noproyek']?>"
                                                    target="_blank"><?php echo substr($row['noproyek'],0,7)?><?php echo substr($row['noproyek'],7,2)?><?php echo substr($row['noproyek'],9,2)?></a>
                                            </td>

                                            <td width="10%" ;>
                                                <?php
$kodeklien = $row["namaklien"];
$ka = "SELECT * FROM klien WHERE kodeklien ='$kodeklien'"; //perintah untuk menjumlahkan
$hasilka = mysqli_query($conn, $ka); //melakukan query dengan varibel $jumlahkan
$tampil = mysqli_fetch_array($hasilka); //menyimpan hasil query ke variabel $t
$tampilkode = $tampil['namaklien'];
echo ucwords($tampilkode);
?>

                                            </td>
                                            <td><?= $row['outlet'] ?></td>
                                            <td><?= $row['tempat'] ?></td>
                                            <td>
                                                <?php if ($row['pekerjaan']!=""): ?>

                                                <?php 
                                                            if ($row['pekerjaan']=='1') {
                                                                echo "Cold Storage" ;
                                                            }elseif ($row['pekerjaan']=='2') {
                                                                echo "Konstruksi";
                                                            }elseif ($row['pekerjaan']=='3') {
                                                                echo "Listrik";
                                                            }elseif ($row['pekerjaan']=='4') {
                                                                echo "Unit";
                                                            }else{
                                                                echo "AC";
                                                            }
                                                        ?>
                                                <?php endif ; ?>
                                            </td>
                                            <td align="right"><?= format_rupiah($row['nilaiproyek']) ?></td>
                                            <td>
                                                <a href="detailmaintenance.php?kp=<?= $row['noproyek']?>"
                                                    target="_blank" class="on-default edit-row badge badge-info"><i
                                                        class="fa fa-pencil"></i></a> |
                                                <input type="hidden" class="delete_id_value" value="<?=$row["id"]?>">
                                                <a
                                                    class="on-default remove-row badge badge-danger tombol-deletemaintenance"><i
                                                        class="fa fa-trash-o"></i></a>
                                            </td>
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
    $('#tombol-klien').click(function(e) {

        e.preventDefault();
        var dataform = $('#formklien')[0];
        var data = new FormData(dataform);

        var klien = $('#klien').val();
        var nklien = $('#nklien').val();

        if (nklien == " ") {
            swal("Nama klien Belum di Isi!", "", "error")
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

    $('#tombol-proyek').click(function(e) {

        e.preventDefault();
        var dataform = $('#formproyek')[0];
        var data = new FormData(dataform);

        var maintenance = $('#maintenance').val();
        var kodeklien = $('#kodeklien').val();
        var tanggal = $('#tanggal').val();
        var outlet = $('#outlet').val();
        var tempat = $('#tempat').val();
        var pekerjaan = $('#pekerjaan').val();
        var nilaiproyek = $('#nilaiproyek').val();

        if (tanggal == "") {
            swal("Kode Akun Belum di Pilih!", "", "error")
        } else if (kodeklien == "000") {
            swal("Nama Klien Belum di Pilih!", "", "error")
        } else if (outlet == "") {
            swal("Keterangan Belum di Isi!", "", "error")
        } else if (outlet == "") {
            swal("Outlet Belum di Isi!", "", "error")
        } else if (pekerjaan == "000") {
            swal("Pekerjaan Belum di Pilih!", "", "error")
        } else if (nilaiproyek == "") {
            swal("Nilai Proyek Belum di Isi!", "", "error")
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

    $('.tombol-deletemaintenance').click(function(e) {
        e.preventDefault();
        //alert('hapus');
        //var delete = 'delete';
        var tabel = 'maintenance';
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