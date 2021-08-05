<?php
require_once "../vendor/autoload.php";
// include "../include/fungsi.php";
// include 'pesan.php';

// echo $kodeoutlet = "OUT001";
// $kodemailer = query("SELECT * FROM mailer WHERE kodeoutlet = '$kodeoutlet' ")[0];
// $mailhost1 = $kodemailer['mailhost1'];
// echo $username1 = $kodemailer['username1'];
// $password1 = $kodemailer['password1'];
// $setfrom1 = $kodemailer['setfrom1'];

// $email = "ammarwaliyuddin@gmail.com";
// $subject = "Tes Email Lawless";
// $pesan = "ammar mengirim pesan";

use PHPMailer\PHPMailer\PHPMailer;


// $token = MD5($email . $this->secret);
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPSecure = 'ssl';
$mail->SMTPKeepAlive = true;
$mail->Mailer = 'smtp'; // don't change the quotes!
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

// if ($mail->Send()) {

//     echo '
//             <script>
//             alert("berhasil");
                              
//             </script>
//             ';
// } else {
//     echo "Mail Error - >" . $mail->ErrorInfo;
// }
