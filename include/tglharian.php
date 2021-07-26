<?php if ($_SESSION['kodeoutlet']=="OUT001" OR $_SESSION['kodeoutlet']=="OUT000")   : ?>
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
    <div class="col-md-5">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
            <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
        </div><!-- input-group -->
    </div>
</div>

<?php else : ?>
<div class="dropdown pull-centre">
    <input type="hidden" value="<?= $_SESSION['kodeoutlet'] ?>" id="kodeoutlet" name="kodeoutlet">
    <div class="col-md-4">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
            <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
        </div><!-- input-group -->
    </div>
</div>

<?php endif ; ?>
<button class="btn btn-primary waves-effect waves-light btn-sm m-b-5" name="tampilkan">Tampilkan</button>