<?php
require '../include/fungsi.php';

if (isset($_POST['login'])) {
    //var_dump($_POST);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $kodeoutlet = $_POST['kodeoutlet'];

    $ceklogin = mysqli_query($conn, "SELECT * FROM admin WHERE email ='$email' ");


    //cek password
    if (mysqli_num_rows($ceklogin) === 1) {

        // $_SESSION['email'] = $email;
        //cek password
        $row = mysqli_fetch_assoc($ceklogin);
        if (password_verify($password, $row["password"])) {

            $datauser = query("SELECT * FROM admin WHERE email = '$email' ")[0];
            $userlevel = $datauser['userlevel'];
            $useroutlet = $datauser['outlet'];

            if ($userlevel != 0) {
                if ($kodeoutlet != $useroutlet) {
                    echo 4;
                } else {
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['userlevel'] = $datauser['userlevel'];
                    $_SESSION['jabatan'] = $datauser['jabatan'];
                    $dataoutlet = query("SELECT * FROM companypanel WHERE kodeoutlet = '$kodeoutlet' ")[0];
                    $_SESSION['outlet'] = $dataoutlet['nama'];
                    $_SESSION['kodeoutlet'] = $kodeoutlet;
                    echo 3;
                }
            } else {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['userlevel'] = $datauser['userlevel'];
                $_SESSION['jabatan'] = $datauser['jabatan'];
                $dataoutlet = query("SELECT * FROM companypanel WHERE kodeoutlet = '$kodeoutlet' ")[0];
                $_SESSION['outlet'] = $dataoutlet['nama'];
                $_SESSION['kodeoutlet'] = $kodeoutlet;
                echo 3;
            }
        } else {
            echo 2;
        }
    } else {
        echo 1;
    }
}