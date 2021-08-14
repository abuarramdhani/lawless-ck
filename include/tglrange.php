<?php if ($_SESSION['kodeoutlet'] == "OUT001" or $_SESSION['kodeoutlet'] == "OUT000") : ?>
    <?php $ko = query("SELECT * FROM companypanel WHERE kodeoutlet != 'OUT001'ORDER BY id ASC "); ?>
    <div class="dropdown pull-centre">
        <div class="col-md-3">
            <select class="form-control select2" id="kodeoutlet" name="kodeoutlet">
                <option value="00">Pilih Outlet</option>
                <?php foreach ($ko as $row) : ?>
                    <option value="<?= $row["kodeoutlet"] ?>">
                        <?= ucwords($row["nama"]) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="dropdown pull-centre">
        <div class="col-md-3">
            <select class="form-control select2" id="laporan" name="laporan">
                <option value="00">Jenis Laporan</option>

                <option>Laporan Masuk</option>
                <option>Laporan Keluar</option>


            </select>
        </div>
    </div>
    <div class="dropdown pull-centre">
        <div class="col-md-5">
            <div class="input-group">
                <div class="input-daterange input-group" id="date-range">
                    <input type="date" class="form-control" name="start" autocomplete="off">
                    <span class="input-group-addon bg-primary b-0 text-white">to</span>
                    <input type="date" class="form-control" name="end" autocomplete="off">
                </div>
            </div><!-- input-group -->
        </div>
    </div>

<?php else : ?>
    <?php $newjuhal = explode(" ", $juhal, 3); ?>

    <div class="dropdown pull-centre">
        <div class="col-md-4">
            <select class="form-control select2" name="laporan">
                <option value="00">Jenis Laporan</option>

                <?php if ($newjuhal[2] == "Bahan") : ?>
                    <option value="in">Laporan <?= $newjuhal[2]; ?> Masuk</option>
                    <option value="storebahan">Laporan <?= $newjuhal[2]; ?> Keluar</option>
                <?php elseif ($newjuhal[2] == "Produk") : ?>
                    <option value="produkmasuk">Laporan <?= $newjuhal[2]; ?> Masuk</option>
                    <option value="storeproduk">Laporan <?= $newjuhal[2]; ?> Keluar</option>
                <?php elseif ($newjuhal[2] == "Package") : ?>
                    <option value="produkmasuk">Laporan <?= $newjuhal[2]; ?> Masuk</option>
                    <option value="storeproduk">Laporan <?= $newjuhal[2]; ?> Keluar</option>
                <?php endif ?>
            </select>
        </div>
    </div>
    <div class="dropdown pull-centre">
        <input type="hidden" value="<?= $_SESSION['kodeoutlet'] ?>" id="kodeoutlet" name="kodeoutlet">
        <div class="col-md-4">
            <div class="input-group">
                <div class="input-daterange input-group" id="date-range">
                    <input type="text" class="form-control" name="start" autocomplete="off" />
                    <span class="input-group-addon bg-primary b-0 text-white">to</span>
                    <input type="text" class="form-control" name="end" utocomplete="off" />
                </div>
            </div><!-- input-group -->
        </div>
    </div>

<?php endif; ?>
<button class="btn btn-primary waves-effect waves-light btn-sm m-b-5" name="tampilkan">Tampilkan</button>