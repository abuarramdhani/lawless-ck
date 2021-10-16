    <?php if ($_SESSION['kodeoutlet'] == "OUT001" or $_SESSION['kodeoutlet'] == "OUT000") : ?>
    <?php $ko = query("SELECT * FROM companypanel WHERE kodeoutlet != 'OUT001'ORDER BY id ASC "); ?>
    <div class="dropdown pull-centre">
        <div class="col-md-4">
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
            <select class="form-control select2" id="bulan" name="bulan">
                <option value="<?= $month ?>"><?= date('M') ?></option>
                <option value="00">Semua</option>
                <option value="01">Jan</option>
                <option value="02">Feb</option>
                <option value="03">Maret</option>
                <option value="04">Apr</option>
                <option value="05">Mei</option>
                <option value="06">Jun</option>
                <option value="07">Jul</option>
                <option value="08">Aug</option>
                <option value="09">Sept</option>
                <option value="10">Okt</option>
                <option value="11">Nov</option>
                <option value="12">Des</option>
            </select>
        </div>
    </div>
    <div class="dropdown pull-centre">
        <div class="col-md-3">
            <select class="form-control select2" id="tahun" name="tahun">
                <option value="<?= $year ?>"><?= date('Y') ?></option>
                <option value="00">Semua</option>

                <?php
                $tahunpertama = 2019;
                $tahunSekarang = date('Y');
                $jt = ($tahunSekarang - $tahunpertama) + 1;
                $tg_awal = date('Y') - $jt;
                $tg_akhir = date('Y');
                ?>
                <?php for ($i = $tg_akhir; $i >= $tg_awal; $i--) : ?>
                    <option><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>
<?php else : ?>

    <div class="dropdown pull-centre">
        <input type="hidden" value="<?= $_SESSION['kodeoutlet'] ?>" id="kodeoutlet" name="kodeoutlet">
        <div class="col-md-3">
            <select class="form-control input-sm" id="bulan" name="bulan">
                <option value="<?= $month ?>"><?= date('M') ?></option>
                <option value="00">Semua</option>
                <option value="01">Jan</option>
                <option value="02">Feb</option>
                <option value="03">Maret</option>
                <option value="04">Apr</option>
                <option value="05">Mei</option>
                <option value="06">Jun</option>
                <option value="07">Jul</option>
                <option value="08">Aug</option>
                <option value="09">Sept</option>
                <option value="10">Okt</option>
                <option value="11">Nov</option>
                <option value="12">Des</option>
            </select>
        </div>
    </div>
    <div class="dropdown pull-centre">
        <div class="col-md-3">
            <select class="form-control input-sm" id="tahun" name="tahun">
                <option value="<?= $year ?>"><?= date('Y') ?></option>
                <option value="00">Semua</option>

                <?php
                $tahunpertama = 2019;
                $tahunSekarang = date('Y');
                $jt = ($tahunSekarang - $tahunpertama) + 1;
                $tg_awal = date('Y') - $jt;
                $tg_akhir = date('Y');
                ?>
                <?php for ($i = $tg_akhir; $i >= $tg_awal; $i--) : ?>
                    <option><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>
<?php endif; ?>
<button class="btn btn-primary waves-effect waves-light btn-sm m-b-5" name="tampilkan">Tampilkan</button>