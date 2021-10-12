<?php
$kaskecil = query("SELECT * FROM produk ORDER BY id DESC");


//$totalsupplier = mysqli_num_rows(query("SELECT COUNT(id) FROM supplier "))[0];
// $totalbahan = query("SELECT COUNT(*) FROM bahan ")[0];
// $totalproduk = query("SELECT COUNT(*) FROM produk ")[0];

$sql="SELECT COUNT(id) FROM supplier";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$totalsupplier = $row[0];

$sql="SELECT COUNT(id) FROM barang WHERE kategoribarang = 'KAB001' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$totalproduct = $row[0];

$sql="SELECT COUNT(id) FROM barang WHERE kategoribarang = 'KAB002' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$totalmaterial = $row[0];

$sql="SELECT COUNT(id) FROM barang WHERE kategoribarang = 'KAB003' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$totalsupplies = $row[0];
