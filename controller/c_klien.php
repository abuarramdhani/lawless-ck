<?php 
$kodeklienn = query("SELECT * FROM klien ORDER BY id DESC ");
$cekdata = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM klien"));
if($cekdata>0){
    $kodeklien = query("SELECT * FROM klien ORDER BY id DESC LIMIT 1")[0];
    $kodem = substr($kodeklien['kodeklien'],1);
    $noUrut = (int) $kodem;
    $noUrut++;    
    $newkodetr = sprintf("%03s", $noUrut);
}else{
    $newkodetr = "001";
}
    
$kode = "K";
$km = $kode.$newkodetr;
?>