<?php 
require '../include/fungsi.php';
$formpo = query("SELECT * FROM form_po WHERE kodeoutlet = 'OUT004' ORDER BY id ASC ");
$jabatan = query("SELECT * from jabatan ");
?>
<?php foreach ($jabatan as $j) : ?>
<option value="<?= $j['kodejabatan'] ?>">
    <?= ucwords($j['namajabatan']) ?>
</option>
<?php endforeach; ?>

Test