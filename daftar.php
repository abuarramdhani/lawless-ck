<?php 

session_start();
if (!isset($_SESSION["email"])) {
    header("location: index");
    exit;
}
 
require 'include/fungsi.php';


//cek apakah tombol submit sudah di tekan atau belum
//if( isset($_POST["sign"]) ) {    
    $email = htmlspecialchars("hsn.mstqm@gmail.com");
    $username = strtolower(stripcslashes("Hasan"));
    $password = "hasanskut";    
    $userlevel = htmlspecialchars("2");
    $userrole = htmlspecialchars("direktur");
    
    //cek  email sudah ada atau belum
    $cekemail = mysqli_query($conn, "SELECT email FROM admin WHERE email = '$email'");
    if (mysqli_fetch_assoc($cekemail)) {
        echo "<script>
                alert('email sudah terdaftar');
                document.location.href = 'utem';
            </script>";
        return false;

    }
    
    //cek username sudah ada atau belum
    $cekusername = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username'");
    if (mysqli_fetch_assoc($cekusername)) {
        echo "<script>
                alert('username sudah terdaftar');
                document.location.href = 'signin';
            </script>";
        return false;

    }

    //enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //query tambah member
    $query = "INSERT INTO admin 
                VALUES 
                ('','$email','$username','$userlevel','$password','$userrole')
            ";
    mysqli_query($conn, $query);
    
     

    //cek apakh data berhasil di tambahkan
    if( mysqli_affected_rows($conn) > 0 ) {
        echo "
            <script>                
                document.location.href = 'utem';           
            </script>
            ";
    } else {
        echo "
            <script>      
            alert('input user gagal');          
                document.location.href = 'daftar';                
            </script>
            ";
    }
//}