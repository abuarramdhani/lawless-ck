<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "lawlessburgerbar_lb";
// $db_host = "localhost";
// $db_user = "lawlessburgerbar_lbba";
// $db_pass = "22e9j=V9r#A_";
// $db_name = "lawlessburgerbar_lb";
//koneksi database
$conn = mysqli_connect('localhost', 'root', '', 'lawlessburgerbar_lb');

try {
	$koneksi = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch (PDOException $error) {
	die("Terjadi kesalahan: " . $error->getMessage());
}
