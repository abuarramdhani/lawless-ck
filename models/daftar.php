<?php 
session_start();
require '../include/fungsi.php';
date_default_timezone_set('Asia/Jakarta');
$date = new DateTime();

// var_dump($_POST);

if (isset($_POST['inputusers'])) {
    
    $nnama = strtolower(htmlspecialchars($_POST["nnama"]));
    $nemail = htmlspecialchars($_POST["nemail"]);
    $noutlet = htmlspecialchars($_POST["noutlet"]);
    $njabatan = htmlspecialchars($_POST["njabatan"]);
    
    $ceknama = mysqli_query($conn, "SELECT * FROM admin WHERE email ='$nemail' ");

    if (mysqli_fetch_assoc($ceknama)) {
        echo "<script>
                alert('email sudah terdaftar');
                document.location.href = 'user/index';
            </script>";
        return false;
    }

    //query insert data
    $query = "INSERT INTO admin 
                VALUES 
                ('','$nemail','$nnama','','1','1','$noutlet','$njabatan')
            ";

    $masuk_data = mysqli_query($conn, $query);
    $kodeoutlet = query("SELECT * FROM companypanel WHERE kodeoutlet = '$noutlet'");
        echo $urloutlet = $kodeoutlet['baseurl'];

    // if ($masuk_data) {
    //     // echo 3;
    //     $kodeoutlet = query("SELECT * FROM companypanel WHERE kodeoutlet = '$noutlet'");
    //     echo $urloutlet = $kodeoutlet['baseurl'];

    //     $secret = '#$eCr37';
    //     $token = MD5($email . $secret);
    //     $linkhref = "https://".$urloutlet.".net//confirm?email=$email&token=$token";

        
    //     // if ($mail->send()) {
    //     //     echo 3;
    //     // } else {
    //     //     echo 2;
    //     // }
    // }
    
    
    
}
?>