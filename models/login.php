<?php
require '../include/fungsi.php';

if (isset($_POST['login'])) {
    //var_dump($_POST);
    $email = $_POST['email'];
    $password = $_POST['password'];

    $ceklogin = mysqli_query($conn, "SELECT * FROM admin WHERE email ='$email' ");


    //cek password
    if (mysqli_num_rows($ceklogin) === 1) {

        // $_SESSION['email'] = $email;
        //cek password
        $row = mysqli_fetch_assoc($ceklogin);
        if (password_verify($password, $row["password"])) {
            session_start();
            $_SESSION['email'] = $email;
            echo 3;
        } else {
            echo 2;
        }
    } else {
        echo 1;
    }
}