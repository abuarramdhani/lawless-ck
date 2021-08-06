<?php

// include "classes/class.phpmailer.php";

// $mail = new PHPMailer(true);
// $mail->isSMTP();
// $mail->SMTPSecure = 'ssl';
// $mail->Host = "mail.lawlessburgerbarasia.net"; //hostname masing-masing provider email
// $mail->SMTPDebug = 2;
// $mail->Port = 465;
// $mail->SMTPAuth = true;
// $mail->Username = "office@lawlessburgerbarasia.net"; //user email
// $mail->Password = "office123!!@@##"; //password email
// $mail->SetFrom("office@lawlessburgerbarasia.net","Lawless"); //set email pengirim
// $mail->Subject = "Pemberitahuan Email dari Lawless"; //subyek email
// $mail->addAddress("afsablenk@gmail.com","Lawless"); //tujuan email
// $mail->MsgHTML("Pengiriman Email Dari Lawless bro");
// if($mail->Send()) echo "Message has been sent";
// else echo "Failed to sending message";

// include "classes/class.phpmailer.php";

// $mail = new PHPMailer(true);
// $mail->isSMTP();
// $mail->SMTPSecure = 'ssl';
// $mail->Host = "mail.lawless-ck.net"; //hostname masing-masing provider email
// $mail->SMTPDebug = 2;
// $mail->Port = 465;
// $mail->SMTPAuth = true;
// $mail->Username = "office@lawless-ck.net"; //user email
// $mail->Password = "officeck123!!@@##"; //password email
// $mail->SetFrom("office@lawless-ck.net","Lawless"); //set email pengirim
// $mail->Subject = "Pendaftaran "; //subyek email
// $mail->addAddress($cEmail); //tujuan email
// $mail->AddBCC("office@lawlessburgerbarasia.net");
// $mail->MsgHTML("lawless");
// if($mail->Send()) echo "Message has been sent";
// else echo "Failed to sending message";

include "classes/class.phpmailer.php";

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPSecure = 'ssl';
$mail->Host = "mail.lawless-ck.net"; //hostname masing-masing provider email
$mail->SMTPDebug = 2;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "office@lawless-ck.net"; //user email
$mail->Password = "officeck123!!@@##"; //password email
$mail->SetFrom("office@lawless-ck.net","Lawless"); //set email pengirim
$mail->Subject = "Pemberitahuan Email dari Lawless"; //subyek email
$mail->addAddress("afsablenk@gmail.com","Lawless"); //tujuan email
$mail->AddBCC("office@lawless-ck.net");
$mail->MsgHTML("Pengiriman Email Dari Lawless bro");
if($mail->Send()) echo "Message has been sent";
else echo "Failed to sending message";
?>