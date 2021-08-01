<?php
require_once "../vendor/autoload.php";
// require "include/fungsi.php";
// include 'pesan.php';

use PHPMailer\PHPMailer\PHPMailer;


// $token = MD5($email . $this->secret);
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPSecure = 'ssl';
$mail->Host = "$mailhost1";
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "$username1";
$mail->Password = "$password1";
$mail->SetFrom($username1, $setfrom1);
$mail->addAddress($email); // email tujuan
// $mail->addAddress($email);
$mail->Subject = "$subject";
$mail->isHTML(true);
$mail->addBCC($username1, "Notif '.$setfrom1.'");
$mail->Body = "$pesan";
// $mail->Body = "Silakan klik tautan berikut untuk mengaktifkan akun anda https://lawlessburgerbarasia.net/confirm?email=". $email ."&token=" . $token;

// $mail->send();
