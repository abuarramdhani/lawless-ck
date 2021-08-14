<?php
require '../include/fungsi.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if (isset($_POST['importpo'])) {
    if (isset($_FILES['import']['name']) && in_array($_FILES['import']['type'], $file_mimes)) {

        $arr_file = explode('.', $_FILES['import']['name']);
        $extension = end($arr_file);


        if ('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['import']['tmp_name']);
        // $kode = 'coba';


        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        // var_dump(count($sheetData));
        for ($i = 1; $i < count($sheetData); $i++) {
            $no = $sheetData[$i]['1'];
            $form_cek = sprintf("%03d", $no);
            $kodeoutlet = $sheetData[$i]['2'];
            $kodesupplier = $sheetData[$i]['3'];
            $date = $sheetData[$i]['4'];
            $status = $sheetData[$i]['5'];
            $kodebahan = $sheetData[$i]['6'];
            $jumlah = $sheetData[$i]['7'];
            $harga = $sheetData[$i]['8'];
            $subtotal = $sheetData[$i]['9'];
            $kel = $sheetData[$i]['10'];

            $ambil_noform = query("SELECT id,No_form FROM form_po ORDER BY No_form DESC");

            // var_dump($ambil_noform);
            // die;
            if ($ambil_noform != NULL) {
                $ambil = $ambil_noform["0"]['No_form'];
                $pecah_po = substr($ambil_noform["0"]['No_form'], 0, 9);
                $pecah_po_b = substr($ambil_noform["0"]['No_form'], 9);
            } else {
                $ambil = null;
                $pecah_po = null;
            }

            $date = explode("-", $date, 3);
            $date = implode("", $date);
            $date =  substr($date, 2);

            $excelcek = $date . $form_cek;
            $ambilexcel = 'FPO' . $date . $form_cek;
            var_dump($ambilexcel);

            if ($pecah_po == "FPO$date") {
                if ($ambil == $ambilexcel) {
                    $pecah_po_b += 1;
                    $pecah_po_b = sprintf("%03d", $pecah_po_b);
                    $dbcek = $date . sprintf("%03d", $pecah_po_b);
                    $No_form = $ambil;
                } else {
                    $pecah_po_b += 1;
                    $pecah_po_b = sprintf("%03d", $pecah_po_b);
                    $dbcek = $date . sprintf("%03d", $pecah_po_b);
                    $No_form = 'FPO' . $date . $pecah_po_b;
                }
            } else {
                $No_form = 'FPO' . $date . '001';
                $dbcek = $date . '001';
            }

            mysqli_query($conn, "INSERT into item_po set
            No_form    = '$No_form',
            kodebahan  = '$kodebahan',
            qty = '$jumlah',
            harga ='$harga',
            subtotal = '$subtotal'");

            if ($excelcek == $dbcek) {
                mysqli_query($conn, "INSERT into form_po set
                No_form    = '$No_form',
                kodeoutlet      = '$kodeoutlet',
                kodesupplier = '$kodesupplier',
                date ='$date',
                status = '$status'");
            }
        }
        // var_dump(mysqli_affected_rows($conn));
        header("Location: ../purchasing/index.php");
    }
}
