<?php
require 'include/fungsi.php';
include 'include/fungsi_rupiah.php';
include 'include/fungsi_bulat.php';
require_once __DIR__ . '/vendor/autoload.php';

$module = $_GET['mod'];
$act = $_GET['act'];

if ($module != 'report' && $act != 'pdf') {
	exit();
}

$kp = $_GET['kp'];
$detpro = query("SELECT * FROM proyekjt WHERE noproyek = '$kp' ")[0];

$jumlahi = "SELECT SUM(input) AS total_i FROM pembayaranpmr WHERE kodeproyek ='$kp'"; //perintah untuk menjumlahkan
$hasili = mysqli_query($conn, $jumlahi); //melakukan query dengan varibel $jumlahkan
$inp = mysqli_fetch_array($hasili); //menyimpan hasil query ke variabel $t
$totali = $inp['total_i'];

$dp = query("SELECT * FROM pembayaranpmr WHERE kodeproyek = '$kp' ORDER BY tanggal ASC");


$html = '
	<html lang="en">
	<head>
		<title>Laporan</title>

	</head>
		<body>
		<table style="border-bottom: 3px solid #000000; padding-bottom: 10px; width: 283mm;">
		<tr valign="top">
		    <td style="width: 283mm;" valign="middle">
		        <div style="font-weight: bold; padding-bottom: 5px; font-size: 13pt;">
		            
		            <img src="img/LOGO1.png" width="90mm" />
		        </div>
		        <span style="font-size: 10pt;">Jl. Serua Raya No.9, Serua Bojongsari, Kota Depok, Jawa Barat 16517, <br> Telp. +62 821 1132 5711, Email: jt@javatechnic.co.id</span>
		    </td>
		</tr>
		</table>
            <p style="text-align: center; width: 206mm; font-size: 10pt;"><b><u>Outstanding Proyek ' . $kp . '</u></b></p>
                        
            <pre style="text-align:justify; font-family: serif; width: 206mm; font-size: 10pt;">
Kode Proyek  : ' . $kp . '
Nama Klien   : ' . ucwords($detpro["namaklien"]) . '
Outlet         : ' . ucwords($detpro["outlet"]) . '
Alamat         : ' . ucwords($detpro["tempat"]) . '
Pekerjaan      : ' . ucwords($detpro["pekerjaan"]) . '
Nilai Proyek  : Rp. ' . format_rupiah($detpro["nilaiproyek"]) . '
            </pre>

			<table cellpadding="0" cellspacing="0" style="width: 206mm;">
				<tr>
					<th colspan="2" style="border-bottom: 2px solid #000000; border-right: 2px solid #000000; width: 60mm; padding: 5px 0px 5px 0px; font-size: 10pt; text-align: center;">Total Pembayaran</th>
					
					<th colspan="2" style="border-bottom: 2px solid #000000; width: 60mm; padding: 5px 0px 5px 0px; font-size: 10pt; text-align:center;">Outstanding</th>
				</tr>
				<tr>
					<td style="border-bottom: 2px solid #000000; padding: 5px 0px 5px 0px; font-size: 10pt; text-align: center;"><b>Rp</td>
								
					<td style="border-bottom: 2px solid #000000; border-right: 2px solid #000000; padding: 5px 0px 5px 0px; font-size: 10pt; text-align: center;"><b> ' . format_rupiah($totali) . ' </td>
					<td style="border-bottom: 2px solid #000000; padding: 5px 0px 5px 0px; font-size: 10pt; text-align: center;"><b> Rp</td>
								
					<td style="border-bottom: 2px solid #000000; padding: 5px 0px 5px 0px; font-size: 10pt; text-align: center;"><b> ' . format_rupiah($detpro['nilaiproyek'] - $totali) . ' </td>
				</tr>

				
            </table>
            <br>
			<table >
		        
		            <tr>
		                <th style="border-bottom: 2px solid #000000; padding: 5px 0px 5px 0px; font-size: 12pt;">No</th>
                        <th style="border-bottom: 2px solid #000000; width: 20mm; padding: 5px 0px 5px 0px; font-size: 12pt;"> Tanggal</th>
                        
                        <th style="border-bottom: 2px solid #000000; width: 35mm; padding: 5px 0px 5px 0px; font-size: 12pt;">No Pembayaran</th>
                        <th style="border-bottom: 2px solid #000000; width: 40mm; padding: 5px 0px 5px 0px; font-size: 12pt;">Kode Akun</th>
		                <th style="border-bottom: 2px solid #000000; width: 110mm; padding: 5px 0px 5px 0px; font-size: 12pt;">Keterangan</th>
		                
                        <th style="border-bottom: 2px solid #000000; width: 30mm; padding: 5px 0px 5px 0px; font-size: 12pt;">Rekening</th>
                        <th style="border-bottom: 2px solid #000000; width: 5mm; padding: 5px 0px 5px 0px; font-size: 12pt;"></th>
		                <th style="border-bottom: 2px solid #000000; width: 25mm; padding: 5px 0px 5px 0px; font-size: 12pt;">Jumlah</th>
	                    
		                
		            </tr>';
$i = 1;
foreach ($dp as $row) {
	$t = $row['tanggal'];
	$ta = substr($t, 8, 2);
	$bu = "/" . substr($t, 5, 2) . "/";
	$tah = substr($t, 0, 4);

	$kodeakun = $row["kodeakun"];
	$ka = "SELECT * FROM kodeakun WHERE kodeakun3 ='$kodeakun'"; //perintah untuk menjumlahkan
	$hasilka = mysqli_query($conn, $ka); //melakukan query dengan varibel $jumlahkan
	$tampil = mysqli_fetch_array($hasilka); //menyimpan hasil query ke variabel $t
	$tampilkode = $tampil['ketkode3'];

	$html .= '<tr>
		        		<td style="border-bottom: 1px solid #000000; font-size: 11pt;">' . $i++ . '</td>
                        <td style="border-bottom: 1px solid #000000; font-size: 11pt;">' . $ta . $bu . $tah . '</td>
                        
                        <td style="border-bottom: 1px solid #000000; font-size: 11pt; text-align: center;">' . $row["kodekas"] . $row["kodebulan"] . $row["kodetr"] . '</td>
                        <td style="border-bottom: 1px solid #000000; font-size: 11pt; text-align: center;">' . strtoupper($tampilkode) . '</td>
		                <td style="border-bottom: 1px solid #000000; font-size: 11pt;">' . strtoupper($row["keterangan"]) . '</td>
		                
                        <td style="border-bottom: 1px solid #000000; font-size: 11pt; text-align: left;">' . strtoupper($row["payto"]) . '</td>
                        <td style="border-bottom: 1px solid #000000; font-size: 11pt;">Rp.</td>
		                <td style="border-bottom: 1px solid #000000; font-size: 11pt; text-align: right;">' . format_rupiah($row["input"]) . '</td>
	                    
	                    
	                    
		        	</tr>';
}

$html .= '</table >
		</body>
			
	</html>
';

$namafile = ucwords($detpro["outlet"]) . ' No : ' . $kp . '.pdf';

//iki editanku
if ($_GET['format'] == 'html') {
	echo $html;
	exit();
}

$mpdf = new \Mpdf\Mpdf();


$mpdf->SetWatermarkImage('img/wmjt.png');
$mpdf->showWatermarkImage = true;
$mpdf->WriteHTML($html);
$mpdf->Output($namafile, \Mpdf\Output\Destination::INLINE);
