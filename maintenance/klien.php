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
require '../controller/c_klien.php';
$bagian = "Maintenance";
$juhal = "Klien";


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

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-box">
                                <div class="dropdown pull-right">
                                    <h4 class="header-title m-t-0">Kode Klien : <?php echo $km ; ?></h4>
                                </div>

                                <h4 class="header-title m-t-0">Input Klien <br></h4>


                                <form class="form-horizontal group-border-dashed" id="formklien">
                                    <input type="hidden" value="klien" id="klien" name="klien">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Nama Klien</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nklien" id="nklien"
                                                placeholder="Nama klien"></input>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-6 m-t-15">
                                            <button type="submit" class="btn btn-primary waves-effect" id="tombol-klien"
                                                name="tombol-klien">Input Klien</button>
                                            <!-- <button type="reset" class="btn btn-default waves-effect m-l-5">
                                                    Cancel
                                                </button> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- end col -->

                        <div class="col-lg-8">
                            <div class="card-box table-responsive">
                                <!-- <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="zmdi zmdi-more-vert"></i>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div> -->

                                <h4 class="header-title m-t-0 m-b-30">Daftar Klien</h4>

                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Klien</th>
                                            <th>Nama Klien </th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($kodeklienn as $row ) : ?>
                                        <tr>
                                            <td width="2%" ;><?= $i ?></td>
                                            <td><?= $row["kodeklien"] ?></td>
                                            <td><?= $row["namaklien"] ?></td>
                                            <td>
                                                <!-- <a href="detailproyek.php?kp=<?= $row['noproyek']?>" target="_blank"
                                                    class="on-default edit-row badge badge-info"><i
                                                        class="fa fa-pencil"></i></a> |
                                                <input type="hidden" class="delete_id_value" value="<?=$row["id"]?>">
                                                <a class="on-default remove-row badge badge-danger tombol-deleteproyek"><i
                                                        class="fa fa-trash-o"></i></a> -->
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


})
</script>