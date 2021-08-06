<?php

// $mail = new PHPMailer;
// $mail->IsSMTP();
// $mail->SMTPSecure = 'tls';
// $mail->Host = $mailhost1; //host masing2 provider email
// //$mail->SMTPDebug = 3;
// $mail->Debugoutput = 'html';
// $mail->Port = 465;
// $mail->SMTPAuth = true;
// $mail->Username = $username1; //user email
// $mail->Password = $password1; //password email 
// $mail->SetFrom($username1, $setfrom1); //set email pengirim
// $mail->Subject = $SubjectMsg; //subyek email
// $mail->AddAddress($cEmail);  //tujuan email
// $mail->AddBCC($username1, "Lawless Burgerbar");
// $mail->MsgHTML($bodyMsg);

include "../classes/class.phpmailer.php";

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
$mail->Subject = "Pendaftaran "; //subyek email
$mail->addAddress($cEmail); //tujuan email
$mail->AddBCC("office@lawlessburgerbarasia.net", "Lawless Burgerbar");
$mail->MsgHTML("lawless");
if($mail->Send()) echo "Message has been sent";
else echo "Failed to sending message";
?>