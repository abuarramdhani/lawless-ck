<?php
require '../include/fungsi.php';

if (isset($_POST['login'])) {
    //var_dump($_POST);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $kodeoutlet = $_POST['kodeoutlet'];
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes

    $ceklogin = mysqli_query($conn, "SELECT * FROM admin WHERE email ='$email' ");


    //cek password
    if (mysqli_num_rows($ceklogin) === 1) {

        // $_SESSION['email'] = $email;
        //cek password
        $row = mysqli_fetch_assoc($ceklogin);
        if (password_verify($password, $row["password"])) {
<<<<<<< Updated upstream
                        
            $datauser = query("SELECT * FROM admin WHERE email = '$email' ")[0];            
            $userlevel = $datauser['userlevel'];            
            $useroutlet = $datauser['outlet'];

            if($userlevel!=0){
                if($kodeoutlet!=$useroutlet){
                    echo 4;
                }else{
=======

            $datauser = query("SELECT * FROM admin WHERE email = '$email' ")[0];
            $userlevel = $datauser['userlevel'];



            if ($userlevel != 0) {
                if ($company['kodeoutlet'] != $kodeoutlet) {
                    echo 4;
                } else {
>>>>>>> Stashed changes
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['userlevel'] = $datauser['userlevel'];
                    $dataoutlet = query("SELECT * FROM companypanel WHERE kodeoutlet = '$kodeoutlet' ")[0];
                    $_SESSION['outlet'] = $dataoutlet['nama'];
<<<<<<< Updated upstream
                    echo 3;    
                }
                
            }else{
=======
                    echo 3;
                }
            } else {
>>>>>>> Stashed changes
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['userlevel'] = $datauser['userlevel'];
                $dataoutlet = query("SELECT * FROM companypanel WHERE kodeoutlet = '$kodeoutlet' ")[0];
                $_SESSION['outlet'] = $dataoutlet['nama'];
                echo 3;
            }
        } else {
            echo 2;
        }
    } else {
        echo 1;
    }
}
