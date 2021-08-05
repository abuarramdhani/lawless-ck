<?php
include "classes/class.phpmailer.php";
$mail = new PHPMailer;
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl';
$mail->Host = "mail.lawlessburgerbarasia.net"; //hostname masing-masing provider email
$mail->SMTPDebug = 2;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "admin@lawlessburgerbarasia.net"; //user email
$mail->Password = "Oq4eRi0][$b0"; //password email
$mail->SetFrom("admin@lawlessburgerbarasia.net","Lawless"); //set email pengirim
$mail->Subject = "Pemberitahuan Email dari Lawless"; //subyek email
$mail->AddAddress("sgendenk@gmail.com","Lawless"); //tujuan email
$mail->MsgHTML("Pengiriman Email Dari Lawless");
if($mail->Send()) echo "Message has been sent";
else echo "Failed to sending message";
?>