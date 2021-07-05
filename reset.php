<?php
require 'include/fungsi.php';

$username = "dwi";


$passwordb = "dwi5758";
$passwordb2 = "dwi5758";

//cek username  email sudah ada atau belum
$cekemail = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
if (mysqli_num_rows($cekemail) === 1) {


    // cek konfirmasi passqord
    if ($passwordb !== $passwordb2) {
        echo "<script>
                    alert('konfirmasi password tidak sesuai');
                    document.location.href = 'reset';
                </script>
                ";
        return false;
    }
}



//$error = true;

//enskripsi password
$passwordb = password_hash($passwordb, PASSWORD_DEFAULT);


//query edit data
$query = "UPDATE admin SET
                
                password = '$passwordb'                
                WHERE username = '$username'
            ";
mysqli_query($conn, $query);

//cek apakah data berhasil di edit
if (mysqli_affected_rows($conn) > 0) {
    echo "          
            <script>
                alert('password $username berhasil diperbarui');
                document.location.href = 'utem';
            </script>
            ";
} else {
    echo "
            <script>
                alert('ubah password $username gagal');
                document.location.href = 'reset';
            </script>
            ";
}