<?php
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
$url = "https://";
else
$url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];

$url;
//echo "<br>";
$pan = explode("/", $url);
//var_dump($panel);
$bh = $pan[3];
$bh1 = explode(".", $bh);
$basehost = $bh1[0];

//koneksi database
$conn = mysqli_connect('localhost', 'root', '', 'lawlessburgerbar_lb');
// if (!$conn) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }
// echo "Koneksi berhasil";
// mysqli_close($conn);

$company = query("SELECT * FROM companypanel WHERE baseurl = '$basehost' ")[0];

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function queryy($queryy)
{
    global $conn;
    $resultt = mysqli_query($conn, $queryy);
    $rowss = [];
    while ($roww = mysqli_fetch_assoc($resultt)) {
        $rowss[] = $roww;
    }
    return $rowss;
}

$year = date('Y');  
$month = date('m');