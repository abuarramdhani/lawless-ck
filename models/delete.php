<?php
require '../include/fungsi.php';
//var_dump($_POST);
// if (isset($_POST['deletebank'])) {
$tabel = $_POST['tabel'];
$id = $_POST['delete_id'];
$hapus_data = mysqli_query($conn, "DELETE FROM $tabel WHERE id = $id");
if ($hapus_data) {
    echo 3;
} else {
    echo 2;
}
// }
